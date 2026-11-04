@extends('campusnotes.layout')
@section('title','Browse Resources')
@section('content')
<div class="page-banner"><div class="container"><span class="eyebrow">CAMPUS LIBRARY</span><h1 class="fw-bold">Browse resources</h1><p class="text-white-50 mb-0">Search and discover academic materials shared by your community.</p></div></div>
<div class="container py-5"><form class="filter row g-3 align-items-end mb-4" method="GET">
<div class="col-lg-5"><label class="form-label">Search</label><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Title, subject, course code..."></div>
<div class="col-md-4 col-lg-3"><label class="form-label">Department</label><select class="form-select" name="department"><option value="">All departments</option>@foreach($departments as $d)<option value="{{ $d->id }}" @selected(request('department')==$d->id)>{{ $d->name }}</option>@endforeach</select></div>
<div class="col-md-4 col-lg-2"><label class="form-label">Category</label><select class="form-select" name="category"><option value="">All categories</option>@foreach($categories as $c)<option @selected(request('category')==$c)>{{ $c }}</option>@endforeach</select></div>
<div class="col-md-4 col-lg-2 d-flex gap-2"><button class="btn btn-primary flex-grow-1">Filter</button><a class="btn btn-outline-secondary" href="{{ route('resources.index') }}">Reset</a></div></form>
<div class="d-flex justify-content-between mb-3"><small class="text-secondary">{{ $resources->total() }} resources found</small><a href="{{ route('resources.create') }}" class="btn btn-sm btn-primary">Upload resource</a></div>
<div class="row g-4">@forelse($resources as $resource)<div class="col-md-6 col-lg-4">@include('campusnotes.resources.card',['resource'=>$resource])</div>@empty<div class="col-12"><div class="empty">No resources match your search.</div></div>@endforelse</div><div class="mt-4">{{ $resources->links() }}</div></div>
@endsection
