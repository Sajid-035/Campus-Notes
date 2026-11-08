@extends('frontend.layouts.app')
@section('title', 'Campus community')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / Community</div><span class="eyebrow">LEARN TOGETHER</span><h1>Knowledge grows when it is shared.</h1><p class="muted">Discover new resources, meet helpful contributors and make your campus knowledge easier to find.</p></div>
    <div class="page-grid">
        <article class="card info-tile"><div class="stat-icon">▤</div><h3>Share knowledge</h3><p>Upload class notes, assignments, lab reports and previous exam questions for peer learning.</p><a href="{{ route('resources.upload') }}" class="btn primary">Upload a resource</a></article>
        <article class="card info-tile"><div class="stat-icon">⌕</div><h3>Discover materials</h3><p>Use department, semester, category and search filters to find the study material you need.</p><a href="{{ route('resources.index') }}" class="btn outline">Browse library</a></article>
        <article class="card info-tile"><div class="stat-icon">☆</div><h3>Recognize contributors</h3><p>Rate helpful resources and discover students who regularly support the community.</p><a href="{{ route('frontend.contributors') }}" class="btn outline">Meet contributors</a></article>
    </div>
    <div class="section-head"><div><h2>Helpful contributors</h2><p>Students with approved uploads in the CampusNotes library.</p></div><a href="{{ route('frontend.contributors') }}" class="btn outline">View all →</a></div>
    <div class="department-grid" style="margin-bottom:50px">@forelse($contributors as $person)<div class="card department-card"><div class="avatar-circle">{{ strtoupper(substr($person->name,0,1)) }}</div><div><h3>{{ $person->name }}</h3><p>{{ $person->approved_uploads }} approved uploads · {{ number_format($person->total_downloads ?? 0) }} downloads</p></div></div>@empty<div class="card empty-state">Contributor profiles will appear when student uploads are approved.</div>@endforelse</div>
    <div class="section-head"><div><h2>Latest community resources</h2><p>Recently approved contributions.</p></div><a href="{{ route('resources.index') }}" class="btn outline">Browse all →</a></div>
    <div class="resource-grid">@forelse($latestResources as $resource)@include('frontend.partials.resource-card',['resource'=>$resource])@empty<div class="card empty-state">No community uploads yet.</div>@endforelse</div>
</div>
@endsection
