@extends('frontend.layouts.app')
@section('title', 'CampusNotes features')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / Features</div><span class="eyebrow">BUILT FOR STUDENTS</span><h1>Everything you need to study smarter.</h1><p class="muted">A practical academic library with discovery, sharing and personal study tools in one place.</p></div>
    <div class="page-grid">
        <article class="card info-tile"><div class="stat-icon">⌕</div><h3>Smart resource search</h3><p>Search by title, subject or course code and narrow results by department, semester, category and verification status.</p></article>
        <article class="card info-tile"><div class="stat-icon">▤</div><h3>Academic resource library</h3><p>Browse class notes, previous questions, assignments, lab reports and lecture slides.</p></article>
        <article class="card info-tile"><div class="stat-icon">▣</div><h3>Document preview</h3><p>Open approved PDF documents in the browser, review resource information and download files.</p></article>
        <article class="card info-tile"><div class="stat-icon">☆</div><h3>Bookmarks and reviews</h3><p>Save resources to your personal list and share feedback through student ratings and comments.</p></article>
        <article class="card info-tile"><div class="stat-icon">♙</div><h3>Student dashboard</h3><p>Follow your uploads, approvals, downloads, saved resources and contribution activity.</p></article>
        <article class="card info-tile"><div class="stat-icon">✓</div><h3>Moderated publishing</h3><p>New contributions are reviewed before publishing, helping the library stay useful and trustworthy.</p></article>
    </div>
</div>
@endsection
