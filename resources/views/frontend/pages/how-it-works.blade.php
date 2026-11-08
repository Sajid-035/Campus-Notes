@extends('frontend.layouts.app')
@section('title', 'How CampusNotes works')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / How it works</div><h1>Simple for everyone. Useful every day.</h1><p class="muted">Find academic material, contribute your own and keep your study library organized.</p></div>
    <div class="page-grid">
        <article class="card info-tile"><div class="dept-code">01</div><h3>Find what you need</h3><p>Browse the resource library or filter by department, semester and academic category.</p></article>
        <article class="card info-tile"><div class="dept-code">02</div><h3>Open and learn</h3><p>Review the resource details, read available PDF previews, check ratings and download the document.</p></article>
        <article class="card info-tile"><div class="dept-code">03</div><h3>Save helpful material</h3><p>Sign in to bookmark useful notes and return to your saved resources from the student dashboard.</p></article>
        <article class="card info-tile"><div class="dept-code">04</div><h3>Share your knowledge</h3><p>Upload your own notes or academic documents with a clear title, subject, course code and description.</p></article>
        <article class="card info-tile"><div class="dept-code">05</div><h3>Wait for review</h3><p>Your upload enters a pending queue. A moderator checks it before it is made public in the library.</p></article>
        <article class="card info-tile"><div class="dept-code">06</div><h3>Help your campus</h3><p>Approved resources help other students prepare, while your dashboard tracks downloads and contributions.</p></article>
    </div>
    <div class="cta" style="margin-bottom:60px"><h2>Ready to get started?</h2><p>Create your student account and explore the academic library.</p><a class="btn" style="background:white;color:#142b55" href="{{ route('register') }}">Create free account →</a></div>
</div>
@endsection
