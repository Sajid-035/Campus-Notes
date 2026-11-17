<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentApprovalController extends Controller
{
    public function index(Request $request): View
    {
        $students = User::with(['academicDepartment', 'semesterOption'])
            ->whereDoesntHave('roles', fn ($q) => $q->whereIn('name', ['Super Admin', 'Admin']))
            ->when($request->filled('status'), fn ($q) => $q->where('account_status', $request->status))
            ->when(in_array($request->input('account_type'), ['student', 'teacher', 'staff'], true), fn ($q) => $q->where('account_type', $request->account_type))
            ->when($request->filled('q'), fn ($q) => $q->where(function ($sub) use ($request) {
                $term = trim($request->string('q')->toString());
                $sub->where('name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('student_id', 'like', "%{$term}%")
                    ->orWhere('institutional_id_number', 'like', "%{$term}%")
                    ->orWhere('application_number', 'like', "%{$term}%");
            }))
            ->latest()->paginate(20)->withQueryString();
        return view('backend.students.index', compact('students'));
    }

    public function updateStatus(User $user, Request $request): RedirectResponse
    {
        abort_if($user->hasRole('Super Admin') || $user->hasRole('Admin'), 403);
        $data = $request->validate([
            'account_status' => ['required', 'in:pending,approved,rejected,suspended,inactive,verification_required'],
            'rejection_reason' => ['nullable', 'string', 'max:3000'],
            'verification_note' => ['nullable', 'string', 'max:3000'],
        ]);

        $user->account_status = $data['account_status'];
        if ($data['account_status'] === 'approved') {
            $user->verified_at = now();
            $user->rejection_reason = null;
            $identity = str_pad((string) $user->id, 5, '0', STR_PAD_LEFT);
            if (!$user->student_id) $user->student_id = 'CN-' . now()->format('Y') . '-' . $identity;
            if (!$user->application_number) $user->application_number = 'APP-' . now()->format('Y') . '-' . $identity;
            $user->verification_note = null;
        } elseif ($data['account_status'] === 'rejected') {
            $user->rejection_reason = $data['rejection_reason'] ?? 'Your application did not meet the current verification requirements.';
            $user->verified_at = null;
        } elseif ($data['account_status'] === 'verification_required') {
            $user->verification_note = $data['verification_note'] ?? 'Please submit additional institutional information.';
            $user->verified_at = null;
        } elseif (in_array($data['account_status'], ['pending', 'suspended', 'inactive'], true)) {
            $user->verified_at = null;
        }
        $user->save();

        $memberType = ucfirst($user->account_type ?: 'student');
        $messages = [
            'approved' => "Your CampusNotes {$memberType} account has been approved. Your full member dashboard and membership card are now available.",
            'rejected' => "Your {$memberType} account application was rejected. Please review the reason shown on your application status page.",
            'verification_required' => "Additional information is required to complete your {$memberType} account verification.",
            'suspended' => 'Your CampusNotes account has been suspended. Contact support if you need assistance.',
            'inactive' => 'Your CampusNotes account is currently inactive.',
            'pending' => "Your {$memberType} account is pending verification.",
        ];
        $user->studentNotifications()->create([
            'title' => 'Account status updated',
            'message' => $messages[$data['account_status']],
            'type' => $data['account_status'] === 'approved' ? 'success' : 'account',
        ]);

        return back()->with('success', 'Member account status updated successfully.');
    }
}
