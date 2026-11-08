@extends('frontend.layouts.app')
@section('title', 'Assignments')
@section('meta_description', 'Explore assignment briefs, practice exercises and coursework resources shared by students.')
@section('content')
<div class="container">
    <div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / <a href="{{ route('resources.index') }}">Browse</a> / Assignments</div><span class="eyebrow">ACADEMIC LIBRARY</span><h1>Assignments</h1><p class="muted">Explore assignment briefs, practice exercises and coursework resources shared by students.</p></div>
    <form class="browse-tools" action="{{ request()->url() }}" method="GET"><span class="muted">{{ $resources->total() }} resources found</span><input class="field" name="q" value="{{ request('q') }}" placeholder="Search assignments..." style="max-width:300px"><button class="btn primary">Search</button><a class="btn outline" href="{{ request()->url() }}">Clear</a></form>
    <div class="resource-grid">
        @forelse($resources as $resource)
            @include('frontend.partials.resource-card', ['resource' => $resource])
        @empty
            <div class="card empty-state"><div class="empty-icon">▤</div><h3>No assignments found</h3><p class="muted">Share the first useful assignment resource for your classmates.</p><a href="{{ route('resources.upload') }}" class="btn primary">＋ Upload now</a></div>
        @endforelse
    </div>
    <div class="pagination">{{ $resources->links() }}</div>
</div>
@endsection
