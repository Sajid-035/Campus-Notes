<?php

namespace App\Services;

use App\Models\AcademicResource;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Todo;
use App\Models\User;

class AdminDashboardData
{
    /**
     * Build permission-aware data for the existing admin dashboard.
     * The dashboard remains compatible with users who only have access to
     * a subset of the admin modules.
     */
    public function make(User $user): array
    {
        $memberQuery = User::query()->whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Super Admin', 'Admin']);
        });

        $canManageMembers = $user->can('user-list');
        $canManageResources = $user->can('resources-list');
        $canManageBlogs = $user->can('blog-list');
        $canManageMessages = $user->can('contact-messages-list');

        $stats = [
            'members_total' => 0,
            'members_pending' => 0,
            'members_approved' => 0,
            'members_students' => 0,
            'members_teachers' => 0,
            'members_staff' => 0,
            'resources_total' => 0,
            'resources_pending' => 0,
            'resources_approved' => 0,
            'resources_downloads' => 0,
            'blogs_total' => 0,
            'blogs_pending' => 0,
            'blogs_published' => 0,
            'messages_new' => 0,
        ];

        $pendingMembers = collect();
        $recentMembers = collect();
        $pendingResources = collect();
        $pendingBlogs = collect();

        if ($canManageMembers) {
            $stats['members_total'] = (clone $memberQuery)->count();
            $stats['members_pending'] = (clone $memberQuery)->where('account_status', 'pending')->count();
            $stats['members_approved'] = (clone $memberQuery)->where('account_status', 'approved')->count();
            $stats['members_students'] = (clone $memberQuery)->where('account_type', 'student')->count();
            $stats['members_teachers'] = (clone $memberQuery)->where('account_type', 'teacher')->count();
            $stats['members_staff'] = (clone $memberQuery)->where('account_type', 'staff')->count();

            $pendingMembers = (clone $memberQuery)
                ->with('academicDepartment')
                ->where('account_status', 'pending')
                ->latest()
                ->take(6)
                ->get();

            $recentMembers = (clone $memberQuery)
                ->with('academicDepartment')
                ->latest()
                ->take(6)
                ->get();
        }

        if ($canManageResources) {
            $stats['resources_total'] = AcademicResource::count();
            $stats['resources_pending'] = AcademicResource::where('status', 'pending')->count();
            $stats['resources_approved'] = AcademicResource::where('status', 'approved')->count();
            $stats['resources_downloads'] = (int) AcademicResource::sum('downloads_count');

            $pendingResources = AcademicResource::with(['uploader', 'department'])
                ->where('status', 'pending')
                ->latest()
                ->take(6)
                ->get();
        }

        if ($canManageBlogs) {
            $stats['blogs_total'] = BlogPost::count();
            $stats['blogs_pending'] = BlogPost::where('status', 'pending')->count();
            $stats['blogs_published'] = BlogPost::published()->count();

            $pendingBlogs = BlogPost::with('author')
                ->where('status', 'pending')
                ->latest()
                ->take(6)
                ->get();
        }

        if ($canManageMessages) {
            $stats['messages_new'] = ContactMessage::where('status', 'new')->count();
        }

        return [
            'dashboardStats' => $stats,
            'pendingMembers' => $pendingMembers,
            'recentMembers' => $recentMembers,
            'pendingResources' => $pendingResources,
            'pendingBlogs' => $pendingBlogs,
            // Keep the existing To-Do feature and its $data variable intact.
            'data' => Todo::orderBy('date')->orderBy('time')->get(),
        ];
    }
}
