<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use App\Models\AcademicResource;
use App\Models\ContactMessage;
use App\Models\ResourceReview;
use App\Models\StudentDiscussion;
use App\Models\StudentDiscussionReply;
use App\Models\StudentNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function dashboard(Request $request): View|RedirectResponse
    {
        $user = $request->user();
        if ($user->account_status !== 'approved') {
            return $this->applicationStatus($request);
        }

        $myResources = AcademicResource::where('uploader_id', $user->id)->latest()->take(8)->get();
        $bookmarks = $user->bookmarkedResources()->with(['department', 'uploader'])->latest('resource_bookmarks.created_at')->take(4)->get();
        $activity = collect(range(5, 0))->map(function ($offset) use ($user) {
            $month = now()->subMonths($offset);
            return [
                'label' => $month->format('M'),
                'uploads' => AcademicResource::where('uploader_id', $user->id)
                    ->whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count(),
            ];
        });

        $stats = [
            'uploads' => AcademicResource::where('uploader_id', $user->id)->count(),
            'approved' => AcademicResource::where('uploader_id', $user->id)->where('status', 'approved')->count(),
            'pending' => AcademicResource::where('uploader_id', $user->id)->where('status', 'pending')->count(),
            'downloads' => (int) AcademicResource::where('uploader_id', $user->id)->sum('downloads_count'),
            'bookmarks' => $user->bookmarkedResources()->count(),
            'points' => (int) $user->pointTransactions()->sum('points'),
            'unread' => $user->studentNotifications()->whereNull('read_at')->count(),
        ];
        // Preserve a useful activity score for older installations before point transactions were introduced.
        if ($stats['points'] === 0 && $stats['approved'] > 0) {
            $stats['points'] = ($stats['approved'] * 40) + $stats['downloads'];
        }

        return view('frontend.student.dashboard', compact('user', 'myResources', 'bookmarks', 'stats', 'activity'));
    }

    public function applicationStatus(Request $request): View
    {
        $user = $request->user()->load('academicDepartment');
        $departments = AcademicDepartment::where('is_active', true)->orderBy('name')->get();
        return view('frontend.student.application-status', compact('user', 'departments'));
    }

    public function submitVerificationDetails(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->account_status === 'verification_required', 403);

        $data = $request->validate([
            'institution_name' => ['required', 'string', 'max:190'],
            'academic_department_id' => ['required', 'exists:academic_departments,id'],
            'student_batch' => ['required', 'string', 'max:30'],
            'semester' => ['required', 'integer', 'min:1', 'max:20'],
            'verification_note' => ['nullable', 'string', 'max:2000'],
        ]);
        $user->update($data + ['account_status' => 'pending', 'application_submitted_at' => now()]);
        $user->studentNotifications()->create([
            'title' => 'Verification details submitted',
            'message' => 'Your updated student information has been submitted for review.',
            'type' => 'info',
        ]);

        return redirect()->route('student.application-status')->with('success', 'Your updated details have been submitted for verification.');
    }

    public function profile(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $user = $request->user()->load('academicDepartment');
        return view('frontend.student.profile-show', compact('user'));
    }

    public function editProfile(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $user = $request->user()->load('academicDepartment');
        $departments = AcademicDepartment::where('is_active', true)->orderBy('name')->get();
        return view('frontend.student.profile', compact('user', 'departments'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $user = $request->user();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'institution_name' => ['nullable', 'string', 'max:190'],
            'academic_department_id' => ['nullable', 'exists:academic_departments,id'],
            'student_batch' => ['nullable', 'string', 'max:30'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:20'],
            'profile_bio' => ['nullable', 'string', 'max:1200'],
            'avatar' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        // Keep the UploadedFile out of the model's ordinary profile attributes.
        $avatarFile = $data['avatar'] ?? null;
        unset($data['avatar']);
        $user->fill($data);

        if ($avatarFile) {
            if (!$avatarFile->isValid()) {
                return back()->withErrors(['avatar' => 'The profile image could not be uploaded. Please choose the image again.'])
                    ->withInput();
            }

            $avatarDirectory = public_path('uploads/avatars');
            File::ensureDirectoryExists($avatarDirectory);

            $extension = strtolower($avatarFile->extension() ?: $avatarFile->getClientOriginalExtension());
            $filename = Str::uuid() . '.' . $extension;

            // Save the new file first so a failed upload never deletes the current avatar.
            $avatarFile->move($avatarDirectory, $filename);
            $newAvatarPath = $avatarDirectory . DIRECTORY_SEPARATOR . $filename;
            if (!is_file($newAvatarPath)) {
                return back()->withErrors(['avatar' => 'Could not save the profile image. Check write permission for public/uploads/avatars.'])
                    ->withInput();
            }

            $oldAvatar = $user->getOriginal('avatar');
            $user->avatar = $filename;
            $user->save();

            $oldAvatarFilename = $oldAvatar ? basename(str_replace('\\', '/', $oldAvatar)) : null;
            if ($oldAvatarFilename && $oldAvatarFilename !== $filename && is_file($avatarDirectory . DIRECTORY_SEPARATOR . $oldAvatarFilename)) {
                @unlink($avatarDirectory . DIRECTORY_SEPARATOR . $oldAvatarFilename);
            }

            return redirect()->route('student.profile')->with('success', 'Your profile and photo have been updated.');
        }

        $user->save();
        return redirect()->route('student.profile')->with('success', 'Your student profile has been updated.');
    }

    public function idCard(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $user = $request->user()->load('academicDepartment');
        return view('frontend.student.id-card', compact('user'));
    }

    public function resources(Request $request, ?string $status = null): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $status = $status ?: 'all';
        abort_unless(in_array($status, ['all', 'published', 'pending', 'rejected', 'draft'], true), 404);
        $query = AcademicResource::where('uploader_id', $request->user()->id)->with('department');
        if ($status === 'published') $query->where('status', 'approved');
        elseif ($status !== 'all') $query->where('status', $status);
        $resources = $query->latest()->paginate(12)->withQueryString();
        return view('frontend.student.resources', compact('resources', 'status'));
    }

    public function uploadHistory(Request $request): View|RedirectResponse
    {
        return $this->resources($request, 'all');
    }

    public function bookmarks(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $resources = $request->user()->bookmarkedResources()->with(['department', 'uploader'])
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->latest('resource_bookmarks.created_at')->paginate(12)->withQueryString();
        return view('frontend.student.bookmarks', compact('resources'));
    }

    public function downloads(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $downloads = $request->user()->studentDownloads()->with('resource.department')->latest('downloaded_at')->paginate(15);
        return view('frontend.student.downloads', compact('downloads'));
    }

    public function reviews(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $reviews = ResourceReview::where('user_id', $request->user()->id)->with('resource')->latest()->paginate(15);
        return view('frontend.student.reviews', compact('reviews'));
    }

    public function community(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $discussions = StudentDiscussion::with(['user', 'replies.user'])->where('status', 'published')->latest()->paginate(12);
        return view('frontend.student.community.index', compact('discussions'));
    }

    public function myQuestions(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $discussions = StudentDiscussion::where('user_id', $request->user()->id)->with('replies.user')->latest()->paginate(12);
        return view('frontend.student.community.questions', compact('discussions'));
    }

    public function myReplies(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $replies = StudentDiscussionReply::where('user_id', $request->user()->id)->with('discussion.user')->latest()->paginate(15);
        return view('frontend.student.community.replies', compact('replies'));
    }

    public function storeDiscussion(Request $request): RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $data = $request->validate(['title' => ['required', 'string', 'max:180'], 'body' => ['required', 'string', 'max:5000']]);
        $request->user()->discussions()->create($data + ['status' => 'published']);
        return redirect()->route('student.community.questions')->with('success', 'Your discussion has been posted.');
    }

    public function storeReply(Request $request, StudentDiscussion $discussion): RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        abort_unless($discussion->status === 'published', 404);
        $data = $request->validate(['body' => ['required', 'string', 'max:3000']]);
        $discussion->replies()->create(['user_id' => $request->user()->id, 'body' => $data['body'], 'status' => 'published']);
        $discussion->user->studentNotifications()->create([
            'title' => 'New reply to your discussion',
            'message' => $request->user()->name . ' replied to: ' . $discussion->title,
            'type' => 'community',
        ]);
        return back()->with('success', 'Your reply has been posted.');
    }

    public function points(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $user = $request->user();
        $transactions = $user->pointTransactions()->latest()->paginate(15);
        $totalPoints = (int) $user->pointTransactions()->sum('points');
        if ($totalPoints === 0) {
            $approved = AcademicResource::where('uploader_id', $user->id)->where('status', 'approved')->count();
            $downloads = (int) AcademicResource::where('uploader_id', $user->id)->sum('downloads_count');
            $totalPoints = ($approved * 40) + $downloads;
        }
        $leaders = \App\Models\User::where('account_status', 'approved')->where('show_in_leaderboard', true)
            ->withSum('pointTransactions as points_total', 'points')->orderByDesc('points_total')->limit(10)->get();
        $achievements = [
            ['title' => 'First Contribution', 'description' => 'Publish your first approved resource.', 'earned' => AcademicResource::where('uploader_id', $user->id)->where('status', 'approved')->exists()],
            ['title' => 'Helpful Contributor', 'description' => 'Reach 5 approved resources.', 'earned' => AcademicResource::where('uploader_id', $user->id)->where('status', 'approved')->count() >= 5],
            ['title' => 'Campus Mentor', 'description' => 'Generate 100 resource downloads.', 'earned' => AcademicResource::where('uploader_id', $user->id)->sum('downloads_count') >= 100],
        ];
        return view('frontend.student.points', compact('transactions', 'totalPoints', 'leaders', 'achievements'));
    }

    public function notifications(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $filter = $request->input('filter', 'all');
        abort_unless(in_array($filter, ['all', 'unread'], true), 404);
        $query = $request->user()->studentNotifications();
        if ($filter === 'unread') $query->whereNull('read_at');
        $notifications = $query->latest()->paginate(20)->withQueryString();
        return view('frontend.student.notifications', compact('notifications', 'filter'));
    }

    public function markNotificationRead(Request $request, StudentNotification $notification): RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        abort_unless($notification->user_id === $request->user()->id, 404);
        $notification->update(['read_at' => now()]);
        return back()->with('success', 'Notification marked as read.');
    }

    public function markAllNotificationsRead(Request $request): RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $request->user()->studentNotifications()->whereNull('read_at')->update(['read_at' => now()]);
        return back()->with('success', 'All notifications marked as read.');
    }

    public function settings(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        return view('frontend.student.settings', ['user' => $request->user()]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        if ($redirect = $this->approvedGate($request)) return $redirect;
        $user = $request->user();
        $data = $request->validate([
            'email' => ['required', 'email', 'max:190', Rule::unique('users', 'email')->ignore($user->id)],
            'current_password' => ['required_with:password', 'current_password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_public' => ['nullable', 'boolean'],
            'show_in_leaderboard' => ['nullable', 'boolean'],
        ]);
        if ($user->email !== $data['email']) {
            $user->email = $data['email'];
            $user->email_verified_at = null;
        }
        if (!empty($data['password'])) $user->password = Hash::make($data['password']);
        $user->profile_public = $request->boolean('profile_public');
        $user->show_in_leaderboard = $request->boolean('show_in_leaderboard');
        $user->save();
        return back()->with('success', 'Your account settings have been saved.');
    }

    public function support(Request $request): View|RedirectResponse
    {
        if ($request->user()->account_status === 'pending') {
            return redirect()->route('student.application-status');
        }
        return view('frontend.student.support');
    }

    public function storeSupport(Request $request): RedirectResponse
    {
        if ($request->user()->account_status === 'pending') {
            return redirect()->route('student.application-status');
        }
        $data = $request->validate(['subject' => ['required', 'string', 'max:200'], 'message' => ['required', 'string', 'max:5000']]);
        ContactMessage::create([
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'subject' => '[Student Support] ' . $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
        ]);
        return back()->with('success', 'Your support request has been sent to the CampusNotes team.');
    }

    private function approvedGate(Request $request): ?RedirectResponse
    {
        return $request->user()->account_status === 'approved'
            ? null
            : redirect()->route('student.application-status');
    }
}
