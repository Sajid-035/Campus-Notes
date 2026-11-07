@extends('backend.layouts.app')
@section('title', 'Edit Blog Category')

@section('main')
<div class="main-content"><section class="section"><div class="section-header"><h1>Edit Category</h1></div>
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="card"><div class="card-header"><h4>{{ $category->name }}</h4></div><div class="card-body"><form action="{{ route('admin.blog.categories.update',$category) }}" method="POST" class="row">@csrf @method('PUT')
        <div class="form-group col-md-6"><label>Name *</label><input name="name" class="form-control" required maxlength="120" value="{{ old('name',$category->name) }}"></div>
        <div class="form-group col-md-6"><label>Slug</label><input name="slug" class="form-control" maxlength="160" value="{{ old('slug',$category->slug) }}"></div>
        <div class="form-group col-12"><label>Description</label><textarea name="description" class="form-control" rows="3">{{ old('description',$category->description) }}</textarea></div>
        <div class="form-group col-md-6"><label>SEO title</label><input name="seo_title" class="form-control" maxlength="255" value="{{ old('seo_title',$category->seo_title) }}"></div>
        <div class="form-group col-md-6"><label>Meta description</label><textarea name="meta_description" class="form-control" rows="2" maxlength="320">{{ old('meta_description',$category->meta_description) }}</textarea></div>
        <div class="col-12 d-flex justify-content-between">@if(auth()->user()->can('blog-list'))<a href="{{ route('admin.blog.categories.index') }}" class="btn btn-light">Back</a>@else<a href="{{ route('dashboard') }}" class="btn btn-light">Back to dashboard</a>@endif<button class="btn btn-primary">Save category</button></div>
    </form></div></div>
</section></div>
@endsection
