<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::withCount('posts')->orderBy('name')->paginate(20);
        return view('backend.blog.categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateCategory($request);
        $data['slug'] = $this->makeSlug($data['slug'] ?: $data['name']);
        BlogCategory::create($data);
        $destination = $request->user()->can('blog-list') ? route('admin.blog.categories.index') : route('dashboard');
        return redirect($destination)->with('success', 'Category created successfully.');
    }

    public function update(Request $request, BlogCategory $category): RedirectResponse
    {
        $data = $this->validateCategory($request, $category);
        $data['slug'] = $this->makeSlug($data['slug'] ?: $data['name'], $category->id);
        $category->update($data);
        $destination = $request->user()->can('blog-list') ? route('admin.blog.categories.index') : route('admin.blog.categories.edit', $category);
        return redirect($destination)->with('success', 'Category updated successfully.');
    }

    public function edit(BlogCategory $category): View
    {
        return view('backend.blog.categories.edit', compact('category'));
    }

    public function destroy(BlogCategory $category): RedirectResponse
    {
        // Posts remain published and simply become uncategorized.
        $category->posts()->update(['category_id' => null]);
        $category->delete();
        $destination = auth()->user()->can('blog-list') ? route('admin.blog.categories.index') : route('dashboard');
        return redirect($destination)->with('success', 'Category deleted. Posts were kept.');
    }

    private function validateCategory(Request $request, ?BlogCategory $category = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:160', Rule::unique('blog_categories', 'slug')->ignore($category?->id)],
            'description' => ['nullable', 'string', 'max:2000'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:320'],
        ]);
    }

    private function makeSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'category';
        $slug = $base;
        $i = 2;
        while (BlogCategory::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
