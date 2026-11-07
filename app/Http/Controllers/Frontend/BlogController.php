<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogPostSlugRedirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $posts = BlogPost::published()->with(['category', 'author', 'tags'])->latest('published_at');

        if ($request->filled('q')) {
            $term = trim($request->string('q')->toString());
            $posts->where(function ($query) use ($term) {
                $query->where('title', 'like', "%{$term}%")
                    ->orWhere('excerpt', 'like', "%{$term}%")
                    ->orWhere('content', 'like', "%{$term}%");
            });
        }

        if ($request->filled('category')) {
            $posts->whereHas('category', fn ($query) => $query->where('slug', $request->category));
        }

        $posts = $posts->paginate(9)->withQueryString();
        $categories = BlogCategory::withCount(['posts' => fn ($query) => $query->published()])->orderBy('name')->get();
        $featuredPost = ! $request->filled('q') && ! $request->filled('category')
            ? BlogPost::published()->where('is_featured', true)->with(['category', 'author'])->latest('published_at')->first()
            : null;

        return view('frontend.blog.index', compact('posts', 'categories', 'featuredPost'));
    }

    public function category(string $slug, Request $request): View
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $posts = BlogPost::published()->where('category_id', $category->id)
            ->with(['category', 'author', 'tags'])->latest('published_at')->paginate(9)->withQueryString();
        $categories = BlogCategory::withCount(['posts' => fn ($query) => $query->published()])->orderBy('name')->get();
        return view('frontend.blog.index', compact('posts', 'categories', 'category'));
    }

    public function show(string $slug): View|Response|RedirectResponse
    {
        $post = BlogPost::published()->with(['category', 'author', 'tags'])->where('slug', $slug)->first();

        if (!$post) {
            $redirect = BlogPostSlugRedirect::where('old_slug', $slug)->first();
            if ($redirect) {
                $target = BlogPost::published()->find($redirect->blog_post_id);
                if ($target) {
                    return redirect()->route('blog.show', $target->slug, 301);
                }
            }
            abort(404);
        }

        $relatedPosts = BlogPost::published()->where('id', '!=', $post->id)
            ->when($post->category_id, fn ($query) => $query->where('category_id', $post->category_id))
            ->with(['category'])->latest('published_at')->take(3)->get();

        return response()->view('frontend.blog.show', compact('post', 'relatedPosts'))
            ->header('X-Robots-Tag', ($post->robots_index ? 'index' : 'noindex') . ', ' . ($post->robots_follow ? 'follow' : 'nofollow'));
    }

    public function sitemap(): Response
    {
        $posts = BlogPost::published()->where('robots_index', true)->whereNull('canonical_url')->latest('published_at')->get(['slug', 'updated_at', 'published_at']);
        $categories = BlogCategory::whereHas('posts', fn ($query) => $query->published()->where('robots_index', true))->get(['slug', 'updated_at']);
        return response()->view('frontend.blog.sitemap', compact('posts', 'categories'), 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(): Response
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /home\n\nSitemap: " . url('/sitemap.xml') . "\n";
        return response($content, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function feed(): Response
    {
        $posts = BlogPost::published()->with(['category', 'author'])->latest('published_at')->take(20)->get();
        return response()->view('frontend.blog.feed', compact('posts'), 200)
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }
}
