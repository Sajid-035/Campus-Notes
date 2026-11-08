@extends('frontend.layouts.app')
@section('title', 'My bookmarks')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('student.dashboard') }}">Dashboard</a> / Bookmarks</div><h1>My saved resources</h1><p class="muted">Keep useful academic materials close at hand.</p></div>
    <nav class="dashboard-nav"><a href="{{ route('student.dashboard') }}">Overview</a><a class="active" href="{{ route('student.bookmarks') }}">My bookmarks</a><a href="{{ route('resources.upload') }}">Upload resource</a></nav>
    <div class="resource-grid">@forelse($resources as $resource)@include('frontend.partials.resource-card',['resource'=>$resource])@empty<div class="card empty-state"><h3>Your bookmark list is empty</h3><p class="muted">Browse resources and press the bookmark icon to save them.</p><a class="btn primary" href="{{ route('resources.index') }}">Browse resources</a></div>@endforelse</div>
    <div class="pagination">{{ $resources->links() }}</div>
</div>
@endsection
