<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use App\Models\AcademicResource;
use App\Models\ResourceReview;
use App\Models\StudentDownload;
use App\Models\StudentPointTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AcademicResourceController extends Controller
{
    public function index(Request $request): View
    {
        $resources = AcademicResource::approved()->with(['department', 'uploader'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim($request->string('q')->toString());
                $query->where(function ($sub) use ($term) {
                    $sub->where('title', 'like', "%{$term}%")
                        ->orWhere('subject', 'like', "%{$term}%")
                        ->orWhere('course_code', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('department'), fn ($q) => $q->whereHas('department', fn ($d) => $d->where('slug', $request->department)->orWhere('code', $request->department)))
            ->when($request->filled('semester'), fn ($q) => $q->where('semester', $request->integer('semester')))
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->when($request->boolean('verified'), fn ($q) => $q->where('is_verified', true));

        match ($request->input('sort', 'latest')) {
            'downloads' => $resources->orderByDesc('downloads_count'),
            'rating' => $resources->orderByDesc('rating_average'),
            'oldest' => $resources->oldest(),
            default => $resources->latest(),
        };

        $resources = $resources->paginate(12)->withQueryString();
        $departments = AcademicDepartment::where('is_active', true)->withCount(['resources' => fn ($q) => $q->approved()])->orderBy('sort_order')->orderBy('name')->get();
        $categories = $this->categories();

        return view('frontend.resources.browse', compact('resources', 'departments', 'categories'));
    }

    public function departments(): View
    {
        $departments = AcademicDepartment::where('is_active', true)
            ->withCount(['resources' => fn ($q) => $q->approved()])
            ->orderBy('sort_order')->orderBy('name')->get();

        return view('frontend.pages.departments', compact('departments'));
    }

    public function department(AcademicDepartment $department): View
    {
        abort_unless($department->is_active, 404);
        $resources = $department->resources()->approved()->with('uploader')->latest()->paginate(12);
        return view('frontend.resources.department', compact('department', 'resources'));
    }

    public function questions(Request $request): View
    {
        $request->merge(['category' => 'Previous Questions']);
        return $this->categoryPage($request, 'Previous Questions', 'frontend.resources.questions');
    }

    public function assignments(Request $request): View
    {
        $request->merge(['category' => 'Assignments']);
        return $this->categoryPage($request, 'Assignments', 'frontend.resources.assignments');
    }

    private function categoryPage(Request $request, string $category, string $view): View
    {
        $resources = AcademicResource::approved()->with(['department', 'uploader'])
            ->where('category', $category)
            ->when($request->filled('q'), fn ($q) => $q->where(function ($sub) use ($request) {
                $term = trim($request->string('q')->toString());
                $sub->where('title', 'like', "%{$term}%")->orWhere('subject', 'like', "%{$term}%");
            }))
            ->latest()->paginate(12)->withQueryString();
        $departments = AcademicDepartment::where('is_active', true)->orderBy('name')->get();
        return view($view, compact('resources', 'departments', 'category'));
    }

    public function show(AcademicResource $resource): View
    {
        abort_unless($resource->status === 'approved', 404);
        $resource->load(['department', 'uploader', 'reviews.user']);
        $relatedResources = AcademicResource::approved()->where('id', '!=', $resource->id)
            ->where(function ($q) use ($resource) {
                $q->where('department_id', $resource->department_id)->orWhere('category', $resource->category);
            })->latest()->take(4)->get();
        $isBookmarked = auth()->check() && auth()->user()->bookmarkedResources()->whereKey($resource->id)->exists();

        return view('frontend.resources.show', compact('resource', 'relatedResources', 'isBookmarked'));
    }

    public function download(AcademicResource $resource): RedirectResponse|StreamedResponse
    {
        abort_unless($resource->status === 'approved', 404);
        if (!$resource->file_path || !Storage::disk('public')->exists($resource->file_path)) {
            return back()->with('error', 'A downloadable file has not been attached to this demo resource yet.');
        }
        $resource->increment('downloads_count');
        if (auth()->check()) {
            StudentDownload::create([
                'user_id' => auth()->id(),
                'academic_resource_id' => $resource->id,
                'downloaded_at' => now(),
            ]);
        }
        if ($resource->uploader_id) {
            StudentPointTransaction::create([
                'user_id' => $resource->uploader_id,
                'points' => 1,
                'source_type' => 'resource_download',
                'source_id' => $resource->id,
                'description' => 'A student downloaded: ' . $resource->title,
            ]);
        }
        return Storage::disk('public')->download($resource->file_path, $resource->file_name ?: basename($resource->file_path));
    }

    public function uploadForm(): View|RedirectResponse
    {
        abort_unless(auth()->check(), 403);
        if (auth()->user()->account_status !== 'approved') {
            return redirect()->route('student.application-status');
        }
        $departments = AcademicDepartment::where('is_active', true)->orderBy('name')->get();
        return view('frontend.resources.upload', compact('departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->account_status !== 'approved') {
            return redirect()->route('student.application-status');
        }
        $isDraft = $request->input('action') === 'save_draft';
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:220'],
            'subject' => ['required', 'string', 'max:180'],
            'course_code' => ['nullable', 'string', 'max:50'],
            'department_id' => ['required', 'exists:academic_departments,id'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:20'],
            'category' => ['required', 'in:Class Notes,Previous Questions,Assignments,Lab Reports,Lecture Slides'],
            'description' => ['nullable', 'string', 'max:10000'],
            'document' => [$isDraft ? 'nullable' : 'required', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:25600'],
        ]);

        $file = $request->file('document');
        $path = $file ? $file->store('academic-resources', 'public') : null;
        $slugBase = Str::slug($validated['title']);
        $slug = $slugBase . '-' . Str::lower(Str::random(6));

        AcademicResource::create([
            'department_id' => $validated['department_id'],
            'uploader_id' => $request->user()->id,
            'uploader_name' => $request->user()->name,
            'title' => $validated['title'],
            'slug' => $slug,
            'subject' => $validated['subject'],
            'course_code' => $validated['course_code'] ?? null,
            'semester' => $validated['semester'] ?? null,
            'category' => $validated['category'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_name' => $file?->getClientOriginalName(),
            'mime_type' => $file?->getClientMimeType(),
            'file_size' => $file?->getSize(),
            'status' => $isDraft ? 'draft' : 'pending',
        ]);

        return $isDraft
            ? redirect()->route('student.resources', ['status' => 'draft'])->with('success', 'Your resource draft has been saved.')
            : redirect()->route('student.dashboard')->with('success', 'Your resource has been submitted and is waiting for moderator approval.');
    }

    public function bookmark(AcademicResource $resource): RedirectResponse
    {
        abort_unless($resource->status === 'approved', 404);
        if (request()->user()->account_status !== 'approved') {
            return redirect()->route('student.application-status');
        }
        $user = request()->user();
        $user->bookmarkedResources()->toggle($resource->id);
        return back()->with('success', 'Your bookmark list has been updated.');
    }

    public function review(Request $request, AcademicResource $resource): RedirectResponse
    {
        abort_unless($resource->status === 'approved', 404);
        if ($request->user()->account_status !== 'approved') {
            return redirect()->route('student.application-status');
        }
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);
        ResourceReview::updateOrCreate(
            ['user_id' => $request->user()->id, 'academic_resource_id' => $resource->id],
            ['rating' => $validated['rating'], 'comment' => $validated['comment'] ?? null]
        );
        $resource->update([
            'rating_average' => round($resource->reviews()->avg('rating') ?: 0, 2),
            'rating_count' => $resource->reviews()->count(),
        ]);
        return back()->with('success', 'Thank you. Your review has been saved.');
    }

    private function categories(): array
    {
        return ['Class Notes', 'Previous Questions', 'Assignments', 'Lab Reports', 'Lecture Slides'];
    }
}
