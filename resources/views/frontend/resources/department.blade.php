@extends('frontend.layouts.app')
@section('title', $department->name . ' resources')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / <a href="{{ route('departments.index') }}">Departments</a> / {{ $department->code }}</div><span class="eyebrow">{{ $department->code }}</span><h1>{{ $department->name }}</h1><p class="muted">{{ $department->description }}</p></div>
    <div class="section-head"><div><h2>Department resources</h2><p>{{ $resources->total() }} approved resources available.</p></div><a class="btn primary" href="{{ route('resources.upload') }}">＋ Upload resource</a></div>
    <div class="resource-grid">@forelse($resources as $resource)@include('frontend.partials.resource-card', ['resource' => $resource])@empty<div class="card empty-state"><h3>No resources in this department yet</h3><p class="muted">Help classmates by sharing your study materials.</p></div>@endforelse</div>
    <div class="pagination">{{ $resources->links() }}</div>
</div>
@endsection
