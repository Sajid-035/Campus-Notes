@extends('frontend.layouts.app')
@section('title', 'About CampusNotes')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / About</div><span class="eyebrow">OUR PURPOSE</span><h1>Academic knowledge should be easier to find and share.</h1><p class="muted">CampusNotes brings student-created study resources into one searchable, organized library.</p></div>
    <div class="detail-layout" style="align-items:start"><div class="card" style="padding:30px"><h2 style="color:var(--navy);margin-top:0">Built by students, for students.</h2><p class="muted" style="line-height:1.9">Course materials are often scattered across chats, drives and individual devices. CampusNotes is designed to make useful study resources more discoverable, while giving students a simple way to contribute to their campus community.</p><p class="muted" style="line-height:1.9">We organize resources by department, semester, subject and category. Student contributions are reviewed before publication, and members can bookmark, rate and discuss the materials they find useful.</p><a class="btn primary" href="{{ route('resources.index') }}">Explore the library →</a></div>
        <aside class="card info-card"><h3 style="margin-top:0">What we value</h3><div class="info-row"><span>Community</span><b>Learn together</b></div><div class="info-row"><span>Clarity</span><b>Organized materials</b></div><div class="info-row"><span>Trust</span><b>Reviewed uploads</b></div><div class="info-row"><span>Access</span><b>Easy discovery</b></div></aside>
    </div>
</div>
@endsection
