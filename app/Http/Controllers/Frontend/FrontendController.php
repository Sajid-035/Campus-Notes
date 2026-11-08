<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use App\Models\AcademicResource;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(): View
    {
        $departments = AcademicDepartment::where('is_active', true)
            ->withCount(['resources' => fn ($query) => $query->approved()])
            ->orderBy('sort_order')->orderBy('name')->take(8)->get();
        $latestResources = AcademicResource::approved()->with(['department', 'uploader'])->latest()->take(4)->get();
        $stats = [
            'students' => (int) \App\Models\User::count(),
            'resources' => (int) AcademicResource::approved()->count(),
            'downloads' => (int) AcademicResource::approved()->sum('downloads_count'),
            'departments' => (int) AcademicDepartment::where('is_active', true)->count(),
        ];
        return view('frontend.pages.home', compact('departments', 'latestResources', 'stats'));
    }

    public function features(): View
    {
        return view('frontend.pages.features');
    }

    public function howItWorks(): View
    {
        return view('frontend.pages.how-it-works');
    }

    public function about(): View
    {
        return view('frontend.pages.about');
    }

    public function faq(): View
    {
        return view('frontend.pages.faq');
    }

    public function community(): View
    {
        $latestResources = AcademicResource::approved()->with(['department', 'uploader'])->latest()->take(8)->get();
        $contributors = \App\Models\User::whereHas('academicResources', fn ($q) => $q->approved())
            ->withCount(['academicResources as approved_uploads' => fn ($q) => $q->approved()])
            ->withSum(['academicResources as total_downloads' => fn ($q) => $q->approved()], 'downloads_count')
            ->orderByDesc('approved_uploads')->take(6)->get();
        return view('frontend.pages.community', compact('latestResources', 'contributors'));
    }

    public function contributors(): View
    {
        $contributors = \App\Models\User::whereHas('academicResources', fn ($q) => $q->approved())
            ->withCount(['academicResources as approved_uploads' => fn ($q) => $q->approved()])
            ->withSum(['academicResources as total_downloads' => fn ($q) => $q->approved()], 'downloads_count')
            ->orderByDesc('approved_uploads')->paginate(12);
        return view('frontend.pages.contributors', compact('contributors'));
    }
}
