@extends('backend.layouts.app')
@section('title', 'Blog Categories')

@push('style')
<style>
.category-admin .card{border-radius:12px;box-shadow:0 5px 24px rgba(24,38,67,.05)}.category-admin .form-control{font-size:13px}.category-admin .table td{vertical-align:middle}.category-admin .category-count{display:inline-flex;align-items:center;justify-content:center;min-width:30px;height:26px;padding:0 8px;border-radius:20px;background:#f0f2ff;color:#5b62c9;font-weight:800;font-size:11px}@media(max-width:575px){.category-admin .section-header{height:auto}.category-admin .section-header h1{font-size:20px}.category-admin .card-body{padding:15px}}
</style>
@endpush

@section('main')
<div class="main-content category-admin"><section class="section">
    <div class="section-header"><h1>Blog Categories</h1><div class="section-header-breadcrumb"><div class="breadcrumb-item"><a href="{{ route('admin.blog.posts.index') }}">Blog Posts</a></div><div class="breadcrumb-item active">Categories</div></div></div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="row">
        @can('blog-create')
        <div class="col-lg-4"><div class="card"><div class="card-header"><h4>Add category</h4></div><div class="card-body"><form action="{{ route('admin.blog.categories.store') }}" method="POST">@csrf
            <div class="form-group"><label>Name *</label><input name="name" value="{{ old('name') }}" class="form-control" required maxlength="120"></div>
            <div class="form-group"><label>Slug</label><input name="slug" value="{{ old('slug') }}" class="form-control" placeholder="auto-generated-from-name"></div>
            <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="3" maxlength="2000"></textarea></div>
            <div class="form-group"><label>SEO title</label><input name="seo_title" class="form-control" maxlength="255"></div>
            <div class="form-group"><label>Meta description</label><textarea name="meta_description" class="form-control" rows="2" maxlength="320"></textarea></div>
            <button class="btn btn-primary btn-block">Create category</button>
        </form></div></div></div>
        @endcan
        <div class="{{ auth()->user()->can('blog-create') ? 'col-lg-8' : 'col-12' }}"><div class="card"><div class="card-header"><h4>All categories</h4></div><div class="card-body"><div class="table-responsive"><table class="table table-hover"><thead><tr><th>Category</th><th>Slug</th><th>Posts</th><th class="text-right">Actions</th></tr></thead><tbody>
            @forelse($categories as $category)<tr><td><strong>{{ $category->name }}</strong><div class="text-muted small">{{ Str::limit($category->description, 80) }}</div></td><td><code>{{ $category->slug }}</code></td><td><span class="category-count">{{ $category->posts_count }}</span></td><td class="text-right text-nowrap">@can('blog-edit')<a href="{{ route('admin.blog.categories.edit',$category) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>@endcan @can('blog-delete')<form class="d-inline" method="POST" action="{{ route('admin.blog.categories.destroy',$category) }}" onsubmit="return confirm('Delete this category? Posts will be kept without a category.');">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>@endcan</td></tr>
            @empty<tr><td colspan="4" class="text-center text-muted py-5">No categories created yet.</td></tr>@endforelse
        </tbody></table></div>{{ $categories->links() }}</div></div></div>
    </div>
</section></div>
@endsection
