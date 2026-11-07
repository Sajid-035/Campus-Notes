<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogPostSlugRedirect;
use App\Models\BlogTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(Request $request): View
    {
        $query = BlogPost::with(['category', 'author'])->withCount('tags')->latest('updated_at');

        if ($request->filled('q')) {
            $term = trim($request->string('q')->toString());
            $query->where(function ($builder) use ($term) {
                $builder->where('title', 'like', "%{$term}%")
                    ->orWhere('slug', 'like', "%{$term}%")
                    ->orWhere('focus_keyphrase', 'like', "%{$term}%");
            });
        }

        if ($request->status === 'published') {
            $query->where(function ($builder) {
                $builder->where('status', 'published')->orWhere(function ($scheduled) {
                    $scheduled->where('status', 'scheduled')->whereNotNull('published_at')->where('published_at', '<=', now());
                });
            });
        } elseif ($request->status === 'scheduled') {
            $query->where('status', 'scheduled')->where('published_at', '>', now());
        } elseif ($request->status === 'draft') {
            $query->where('status', 'draft');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->integer('category'));
        }

        $posts = $query->paginate(15)->withQueryString();
        $categories = BlogCategory::orderBy('name')->get();
        $stats = [
            'all' => BlogPost::count(),
            'published' => BlogPost::published()->count(),
            'scheduled' => BlogPost::where('status', 'scheduled')->where('published_at', '>', now())->count(),
            'draft' => BlogPost::where('status', 'draft')->count(),
        ];

        return view('backend.blog.posts.index', compact('posts', 'categories', 'stats'));
    }

    public function create(): View
    {
        $post = new BlogPost(['status' => 'draft', 'robots_index' => true, 'robots_follow' => true, 'schema_type' => 'BlogPosting']);
        $categories = BlogCategory::orderBy('name')->get();
        return view('backend.blog.posts.form', compact('post', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['author_id'] = $request->user()->id;
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['content'] = $this->cleanHtml($data['content']);
        $data['published_at'] = $this->resolvePublishedAt($data['status'], $data['published_at'] ?? null);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        $tags = $data['tags'] ?? '';
        unset($data['tags']);

        $post = BlogPost::create($data);
        $post->tags()->sync($this->syncTags($tags));

        if ($request->user()->can('blog-edit')) {
            return redirect()->route('admin.blog.posts.edit', $post)->with('success', 'Blog post created successfully.');
        }
        return $request->user()->can('blog-list')
            ? redirect()->route('admin.blog.posts.index')->with('success', 'Blog post created successfully.')
            : redirect()->route('admin.blog.posts.create')->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $post): View
    {
        $post->load('tags');
        $categories = BlogCategory::orderBy('name')->get();
        return view('backend.blog.posts.form', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $post): RedirectResponse
    {
        $data = $this->validatedData($request, $post);
        $previousSlug = $post->slug;
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $post->id);
        $data['content'] = $this->cleanHtml($data['content']);
        $wasAlreadyPublished = in_array($post->status, ['published', 'scheduled'], true)
            && $post->published_at
            && $post->published_at->isPast();
        $data['published_at'] = $data['status'] === 'published' && $wasAlreadyPublished
            ? $post->published_at->toDateTimeString()
            : $this->resolvePublishedAt($data['status'], $data['published_at'] ?? null);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        if ($request->boolean('remove_featured_image') && !$request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = null;
        }

        $tags = $data['tags'] ?? '';
        unset($data['tags'], $data['remove_featured_image']);

        $post->update($data);
        $post->tags()->sync($this->syncTags($tags));

        if ($previousSlug && $previousSlug !== $post->slug) {
            BlogPostSlugRedirect::updateOrCreate(
                ['old_slug' => $previousSlug],
                ['blog_post_id' => $post->id]
            );
            // A newly assigned current slug must no longer redirect away from itself.
            BlogPostSlugRedirect::where('old_slug', $post->slug)->delete();
        }

        return redirect()->route('admin.blog.posts.edit', $post)->with('success', 'Blog post updated successfully.');
    }

    public function uploadInlineImage(Request $request): \Illuminate\Http\JsonResponse
    {
        abort_unless($request->user()->can('blog-create') || $request->user()->can('blog-edit'), 403);
        $request->validate(['image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120']]);
        $path = $request->file('image')->store('blog/content', 'public');
        return response()->json(['url' => Storage::disk('public')->url($path)]);
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();
        $destination = auth()->user()->can('blog-list') ? route('admin.blog.posts.index') : route('dashboard');
        return redirect($destination)->with('success', 'Blog post moved out of the blog.');
    }

    private function validatedData(Request $request, ?BlogPost $post = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:190', Rule::unique('blog_posts', 'slug')->ignore($post?->id)],
            'category_id' => ['nullable', 'integer', 'exists:blog_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'published', 'scheduled'])],
            'published_at' => ['nullable', 'date'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:5120'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'is_cornerstone' => ['nullable', 'boolean'],
            'tags' => ['nullable', 'string', 'max:1000'],
            'focus_keyphrase' => ['nullable', 'string', 'max:191'],
            'keyphrase_synonyms' => ['nullable', 'string', 'max:500'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'canonical_url' => ['nullable', 'url', 'max:2048'],
            'robots_index' => ['nullable', 'boolean'],
            'robots_follow' => ['nullable', 'boolean'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:320'],
            'og_image' => ['nullable', 'url', 'max:2048'],
            'twitter_title' => ['nullable', 'string', 'max:255'],
            'twitter_description' => ['nullable', 'string', 'max:320'],
            'twitter_image' => ['nullable', 'url', 'max:2048'],
            'schema_type' => ['required', Rule::in(['BlogPosting', 'Article', 'NewsArticle'])],
            'remove_featured_image' => ['nullable', 'boolean'],
        ]);

        foreach (['is_featured', 'is_cornerstone', 'robots_index', 'robots_follow'] as $booleanField) {
            $data[$booleanField] = $request->boolean($booleanField);
        }

        if ($data['status'] === 'scheduled' && (empty($data['published_at']) || !now()->parse($data['published_at'])->isFuture())) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'published_at' => 'Choose a future date and time for a scheduled post.',
            ]);
        }

        return $data;
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'blog-post';
        $slug = $base;
        $counter = 2;
        while (BlogPost::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $counter++;
        }
        return $slug;
    }

    private function resolvePublishedAt(string $status, mixed $date): ?string
    {
        if ($status === 'draft') {
            return null;
        }
        if ($status === 'published') {
            return now()->toDateTimeString();
        }
        return $date ? now()->parse($date)->toDateTimeString() : now()->addDay()->toDateTimeString();
    }

    private function syncTags(?string $input): array
    {
        $names = collect(explode(',', (string) $input))
            ->map(fn ($name) => trim($name))
            ->filter()
            ->unique(fn ($name) => strtolower($name))
            ->take(20);

        return $names->map(function ($name) {
            $base = Str::slug($name) ?: Str::random(8);
            $slug = $base;
            $suffix = 2;
            while (BlogTag::where('slug', $slug)->where('name', '!=', $name)->exists()) {
                $slug = $base . '-' . $suffix++;
            }
            $tag = BlogTag::firstOrCreate(['slug' => $slug], ['name' => $name]);
            return $tag->id;
        })->all();
    }

    private function cleanHtml(string $html): string
    {
        // Keep encoded markup as text and restrict HTML to a safe article-formatting allowlist.
        $html = preg_replace('#<(script|style|iframe|object|embed|form|input|button|svg|math)[^>]*>.*?</\1>#is', '', $html) ?? '';
        $allowedTags = '<p><br><div><span><h1><h2><h3><h4><h5><h6><strong><b><em><i><u><s><ul><ol><li><blockquote><a><img><figure><figcaption><table><thead><tbody><tr><th><td><hr><pre><code><small><sub><sup><mark>';
        $html = strip_tags($html, $allowedTags);
        $html = preg_replace('/\s(on[a-z]+|style|srcdoc|srcset|formaction|target)\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html) ?? '';
        $html = preg_replace_callback('/\b(href|src)\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|([^\s>]+))/is', function ($match) {
            $rawValue = $match[2] !== '' ? $match[2] : ($match[3] !== '' ? $match[3] : ($match[4] ?? ''));
            $value = html_entity_decode($rawValue, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $normalized = preg_replace('/[\x00-\x20\x7f]+/u', '', $value) ?? $value;
            if (preg_match('/^(?:javascript|vbscript|data):/i', $normalized)) {
                $value = '#';
            }
            return $match[1] . '="' . htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '"';
        }, $html) ?? '';
        return $html;
    }
}
