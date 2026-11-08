<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicResource;
use App\Models\StudentPointTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class AcademicResourceController extends Controller
{
    public function index(Request $request): View
    {
        $resources = AcademicResource::with(['department', 'uploader'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('q'), fn ($q) => $q->where('title', 'like', '%' . $request->q . '%'))
            ->latest()->paginate(20)->withQueryString();
        return view('backend.resources.index', compact('resources'));
    }

    public function approve(AcademicResource $resource, Request $request): RedirectResponse
    {
        $resource->update([
            'status' => 'approved',
            'is_verified' => $request->boolean('is_verified'),
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
            'moderation_note' => null,
        ]);
        if ($resource->uploader_id) {
            StudentPointTransaction::firstOrCreate(
                ['user_id' => $resource->uploader_id, 'source_type' => 'resource_approved', 'source_id' => $resource->id],
                ['points' => 40, 'description' => 'Resource approved: ' . $resource->title]
            );
            $resource->uploader?->studentNotifications()->create([
                'title' => 'Resource approved',
                'message' => 'Your resource "' . $resource->title . '" has been approved and published.',
                'type' => 'success',
            ]);
        }
        return back()->with('success', 'Resource approved and published.');
    }

    public function reject(AcademicResource $resource, Request $request): RedirectResponse
    {
        $data = $request->validate(['moderation_note' => ['nullable', 'string', 'max:2000']]);
        $resource->update(['status' => 'rejected', 'moderation_note' => $data['moderation_note'] ?? null]);
        $resource->uploader?->studentNotifications()->create([
            'title' => 'Resource update required',
            'message' => 'Your resource "' . $resource->title . '" was not approved. ' . ($data['moderation_note'] ?? 'Please review the resource and contact support if you have questions.'),
            'type' => 'warning',
        ]);
        return back()->with('success', 'Resource was rejected.');
    }

    public function destroy(AcademicResource $resource): RedirectResponse
    {
        if ($resource->file_path) {
            Storage::disk('public')->delete($resource->file_path);
        }
        $resource->delete();
        return back()->with('success', 'Resource deleted.');
    }
}
