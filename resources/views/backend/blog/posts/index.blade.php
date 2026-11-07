@extends('backend.layouts.app')

@section('title', 'Blog Posts')

@push('style')
<style>
.blog-admin .card{border-radius:12px}.blog-admin .stat-card{border:0;box-shadow:0 5px 24px rgba(24,38,67,.06)}.blog-admin .stat-number{font-size:25px;font-weight:800;color:#26324b}.blog-admin .table td{vertical-align:middle}.blog-admin .post-thumb{width:54px;height:44px;object-fit:cover;border-radius:8px;background:#f1f3f8}.blog-admin .post-title{font-weight:700;color:#26324b}.blog-admin .post-slug{font-size:11px;color:#9098aa;display:block;max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.blog-admin .badge{font-weight:700}.blog-admin .filter-form{display:flex;gap:8px;flex-wrap:wrap}.blog-admin .filter-form .form-control{min-width:145px}.blog-admin .empty-state{padding:50px 20px;text-align:center;color:#8a93a8}
@media(max-width:575px){.blog-admin .section-header{flex-wrap:wrap;height:auto;gap:10px}.blog-admin .section-header h1{font-size:20px}.blog-admin .filter-form>*{width:100%}.blog-admin .filter-form .form-control{min-width:0}.blog-admin .table-responsive{font-size:12px}.blog-admin .post-thumb{width:42px;height:38px}}
</style>
@endpush

@section('main')
<div class="main-content blog-admin">
    <section class="section">
        <div class="section-header">
            <h1><i class="far fa-newspaper mr-2 text-primary"></i>Blog Posts</h1>
            <div class="section-header-button ml-auto">
                @can('blog-create')<a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> New Post</a>@endcan
            </div>
        </div>

        @if(session('success'))<div class="alert alert-success alert-has-icon"><div class="alert-icon"><i class="far fa-check-circle"></i></div><div class="alert-body">{{ session('success') }}</div></div>@endif

        <div class="row">
            @foreach(['all'=>'All Posts','published'=>'Published','scheduled'=>'Scheduled','draft'=>'Drafts'] as $key=>$label)
            <div class="col-6 col-md-3"><div class="card stat-card"><div class="card-body py-3"><div class="text-muted text-small">{{ $label }}</div><div class="stat-number">{{ $stats[$key] }}</div></div></div></div>
            @endforeach
        </div>

        <div class="card">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <h4>Content library</h4>
                <a href="{{ route('admin.blog.categories.index') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-folder mr-1"></i> Manage categories</a>
            </div>
            <div class="card-body">
                <form method="GET" class="filter-form mb-4">
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search title, slug or keyphrase">
                    <select name="status" class="form-control"><option value="">All statuses</option>@foreach(['published'=>'Published','scheduled'=>'Scheduled','draft'=>'Draft'] as $value=>$label)<option value="{{ $value }}" @selected(request('status')===$value)>{{ $label }}</option>@endforeach</select>
                    <select name="category" class="form-control"><option value="">All categories</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected((string)request('category')===(string)$category->id)>{{ $category->name }}</option>@endforeach</select>
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <a href="{{ route('admin.blog.posts.index') }}" class="btn btn-light">Reset</a>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead><tr><th style="min-width:280px">Post</th><th>Category</th><th>Status</th><th>SEO</th><th>Updated</th><th class="text-right">Actions</th></tr></thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($post->featured_image)<img src="{{ asset('storage/'.$post->featured_image) }}" alt="" class="post-thumb mr-3">@else<div class="post-thumb mr-3 d-flex align-items-center justify-content-center"><i class="far fa-image text-muted"></i></div>@endif
                                        <div>@can('blog-edit')<a class="post-title" href="{{ route('admin.blog.posts.edit',$post) }}">{{ $post->title }}</a>@else<strong class="post-title">{{ $post->title }}</strong>@endcan<span class="post-slug">/{{ $post->slug }}</span>@if($post->is_cornerstone)<span class="badge badge-info mt-1">Cornerstone</span>@endif</div>
                                    </div>
                                </td>
                                <td>{{ $post->category?->name ?? 'Uncategorized' }}</td>
                                <td>
                                    @if($post->status==='published' || ($post->status==='scheduled' && $post->published_at && $post->published_at->isPast()))<span class="badge badge-success">Published</span>
                                    @elseif($post->status==='scheduled')<span class="badge badge-warning">Scheduled</span>
                                    @else<span class="badge badge-secondary">Draft</span>@endif
                                </td>
                                <td><span class="text-muted small">{{ $post->focus_keyphrase ?: 'No keyphrase' }}</span><br><span class="text-muted small">{{ $post->robots_index ? 'Index' : 'Noindex' }} / {{ $post->robots_follow ? 'Follow' : 'Nofollow' }}</span></td>
                                <td class="text-muted small">{{ $post->updated_at->format('d M Y') }}</td>
                                <td class="text-right text-nowrap">
                                    @if($post->status==='published' || ($post->status==='scheduled' && $post->published_at && $post->published_at->isPast()))<a href="{{ route('blog.show',$post->slug) }}" target="_blank" class="btn btn-sm btn-light" title="View"><i class="fas fa-external-link-alt"></i></a>@endif
                                    @can('blog-edit')<a href="{{ route('admin.blog.posts.edit',$post) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>@endcan
                                    @can('blog-delete')<form action="{{ route('admin.blog.posts.destroy',$post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post? This cannot be undone.');">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button></form>@endcan
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6"><div class="empty-state"><i class="far fa-newspaper fa-3x mb-3"></i><h5>No blog posts yet</h5><p>Create your first post and optimize it for search engines.</p>@can('blog-create')<a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary">Create first post</a>@endcan</div></td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">{{ $posts->links() }}</div>
            </div>
        </div>
    </section>
</div>
@endsection
