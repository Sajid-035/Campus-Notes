@extends('frontend.layouts.app')
@section('title', 'Learn smarter. Share better.')
@section('meta_description', 'Explore class notes, previous questions, assignments and academic resources shared by students on CampusNotes.')
@section('content')
<section id="home" class="container hero">
    <div>
        <span class="eyebrow">✦ YOUR CAMPUS, YOUR KNOWLEDGE</span>
        <h1>Learn smarter.<br><span style="color:#2563eb">Share better.</span></h1>
        <p>One organized space for notes, previous questions, assignments and academic resources — built by students, for students.</p>
        <form class="searchbox" action="{{ route('resources.index') }}" method="GET">
            <input class="field" name="q" placeholder="Search notes, subjects, courses..." aria-label="Search resources">
            <select class="field" name="department"><option value="">Department</option>@foreach($departments as $department)<option value="{{ $department->slug }}">{{ $department->code }}</option>@endforeach</select>
            <select class="field" name="semester"><option value="">Semester</option>@for($i=1;$i<=8;$i++)<option value="{{ $i }}">{{ $i }}</option>@endfor</select>
            <button class="btn primary" type="submit">⌕ Search</button>
        </form>
        <div class="hero-actions"><a class="btn primary" href="{{ route('resources.index') }}">Explore resources →</a><a class="btn outline" href="{{ route('resources.upload') }}">＋ Share a resource</a></div>
    </div>
    <div class="hero-art" aria-label="CampusNotes resource illustration">
        <div class="art-orbit"></div><div class="art-center"><b>✎</b><strong>Campus<br>Knowledge</strong></div>
        <div class="float-card one"><span style="color:#dc2626;font-size:11px;font-weight:800">▣ PDF DOCUMENT</span><h4>Data Structures</h4><small class="muted">CSE 201 · Class Notes</small></div>
        <div class="float-card two"><b>Microeconomics</b><p class="small gold">★ 4.8 · Student resource</p></div>
        <div class="float-card three"><span style="color:#dc2626;font-size:11px;font-weight:800">▣ STUDY MATERIAL</span><h4>Previous Questions</h4><small class="muted">Exam preparation</small></div>
    </div>
</section>
<div class="container stats">
    <div class="stat"><div class="stat-icon">♙</div><div><strong>{{ number_format($stats['students']) }}</strong><span>Registered Members</span></div></div>
    <div class="stat"><div class="stat-icon">▤</div><div><strong>{{ number_format($stats['resources']) }}</strong><span>Approved Resources</span></div></div>
    <div class="stat"><div class="stat-icon">⇩</div><div><strong>{{ number_format($stats['downloads']) }}</strong><span>Total Downloads</span></div></div>
    <div class="stat"><div class="stat-icon">⌂</div><div><strong>{{ number_format($stats['departments']) }}</strong><span>Departments</span></div></div>
</div>
<section class="container section" id="departments">
    <div class="section-head"><div><h2>Explore by department</h2><p>Find resources tailored to your field of study.</p></div><a href="{{ route('departments.index') }}" class="btn outline">All departments →</a></div>
    <div class="dept-grid">
        @forelse($departments as $department)
            <a href="{{ route('departments.show', $department) }}" class="card dept"><span class="dept-code">{{ $department->code }}</span><h3>{{ $department->name }}</h3><p>{{ number_format($department->resources_count) }} resources →</p></a>
        @empty
            <div class="card empty-state"><h3>Departments are being prepared</h3><p class="muted">Please check back soon.</p></div>
        @endforelse
    </div>
</section>
<section class="container section">
    <div class="section-head"><div><h2>Latest resources</h2><p>Fresh notes and study materials shared by your campus community.</p></div><a href="{{ route('resources.index') }}" class="btn outline">Browse all →</a></div>
    <div class="resource-grid">
        @forelse($latestResources as $resource)@include('frontend.partials.resource-card', ['resource' => $resource])
        @empty<div class="card empty-state"><h3>No resources published yet</h3><p class="muted">Be the first to share a helpful study resource.</p><a class="btn primary" href="{{ route('resources.upload') }}">Upload a resource</a></div>@endforelse
    </div>
</section>
<div class="container"><div class="cta"><h2>Have notes that can help someone?</h2><p>Share your knowledge with students. Upload your notes, help your community and make learning better for everyone.</p><a href="{{ route('resources.upload') }}" class="btn" style="background:white;color:#142b55">＋ Upload a resource</a> <a href="{{ route('frontend.community') }}" class="btn outline" style="background:transparent;color:white;border-color:#ffffff66">Join the community</a></div></div>
@endsection
