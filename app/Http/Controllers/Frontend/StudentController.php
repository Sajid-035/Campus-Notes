<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicResource;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function dashboard(Request $request): View
    {
        $user = $request->user();
        $myResources = AcademicResource::where('uploader_id', $user->id)->latest()->get();
        $bookmarks = $user->bookmarkedResources()->with(['department', 'uploader'])->latest('resource_bookmarks.created_at')->take(6)->get();
        $activity = collect(range(5, 0))->map(function ($offset) use ($user) {
            $month = now()->subMonths($offset);
            return [
                'label' => $month->format('M'),
                'uploads' => AcademicResource::where('uploader_id', $user->id)->whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count(),
            ];
        });
        $stats = [
            'uploads' => $myResources->count(),
            'approved' => $myResources->where('status', 'approved')->count(),
            'pending' => $myResources->where('status', 'pending')->count(),
            'downloads' => (int) $myResources->sum('downloads_count'),
            'bookmarks' => $user->bookmarkedResources()->count(),
            'points' => $myResources->where('status', 'approved')->count() * 40 + (int) $myResources->sum('downloads_count'),
        ];
        return view('frontend.student.dashboard', compact('user', 'myResources', 'bookmarks', 'stats', 'activity'));
    }

    public function bookmarks(Request $request): View
    {
        $resources = $request->user()->bookmarkedResources()->with(['department', 'uploader'])->latest('resource_bookmarks.created_at')->paginate(12);
        return view('frontend.student.bookmarks', compact('resources'));
    }
}
