@extends('frontend.layouts.app')
@section('title', 'Student dashboard')
@section('content')
<div class="container">
    <div class="dashboard-banner"><span class="eyebrow" style="background:#ffffff20;color:white">STUDENT SPACE</span><h1>Welcome back, {{ $user->name }}!</h1><p style="color:#cbd5e1;margin:0">Track your uploads, bookmarks and contribution to the campus community.</p></div>
    <nav class="dashboard-nav"><a class="active" href="{{ route('student.dashboard') }}">Overview</a><a href="{{ route('resources.upload') }}">Upload resource</a><a href="{{ route('student.bookmarks') }}">My bookmarks</a><a href="{{ route('frontend.community') }}">Community</a></nav>
    <div class="dash-stats">
        <div class="stat"><div class="stat-icon">▤</div><div><strong>{{ $stats['uploads'] }}</strong><span>Total uploads</span></div></div>
        <div class="stat"><div class="stat-icon">✓</div><div><strong>{{ $stats['approved'] }}</strong><span>Approved</span></div></div>
        <div class="stat"><div class="stat-icon">◷</div><div><strong>{{ $stats['pending'] }}</strong><span>Pending review</span></div></div>
        <div class="stat"><div class="stat-icon">⇩</div><div><strong>{{ number_format($stats['downloads']) }}</strong><span>Resource downloads</span></div></div>
        <div class="stat"><div class="stat-icon">✧</div><div><strong>{{ number_format($stats['points']) }}</strong><span>Contribution points*</span></div></div>
        <div class="stat"><div class="stat-icon">☆</div><div><strong>{{ $stats['bookmarks'] }}</strong><span>Saved resources</span></div></div>
    </div>
    <div class="chart-grid" style="margin:20px 0 30px">
        <div class="card chart-card"><h3>Monthly upload activity</h3><div class="bars">
            @php($maxUploads = max(1, (int) $activity->max('uploads')))
            @foreach($activity as $month)<div class="bar" style="height:{{ max(12, (int)(100 * $month['uploads'] / $maxUploads)) }}%"><span>{{ $month['label'] }}</span></div>@endforeach
        </div><p class="muted small" style="margin-top:27px">Your uploads during the last six calendar months.</p></div>
        <div class="card chart-card"><h3>Contribution overview</h3><div style="display:grid;gap:18px;padding:15px 0">
            <div><div class="info-row"><span>Approved resources</span><strong>{{ $stats['approved'] }}</strong></div><div class="info-row"><span>Pending moderation</span><strong>{{ $stats['pending'] }}</strong></div><div class="info-row"><span>Total downloads generated</span><strong>{{ number_format($stats['downloads']) }}</strong></div></div>
            <a class="btn outline" href="{{ route('frontend.community') }}">Explore the community →</a>
        </div></div>
    </div>
    <div class="section-head"><div><h2>My recent uploads</h2><p>See which resources are public and which are waiting for review.</p></div><a class="btn primary" href="{{ route('resources.upload') }}">＋ New upload</a></div>
    <div class="card table-wrap" style="padding:10px;margin-bottom:30px"><table><thead><tr><th>Title</th><th>Category</th><th>Status</th><th>Downloads</th><th>Date</th><th>Action</th></tr></thead><tbody>
        @forelse($myResources as $resource)<tr><td><strong>{{ $resource->title }}</strong><div class="muted small">{{ $resource->subject }}</div></td><td>{{ $resource->category }}</td><td><span class="status {{ $resource->status }}">{{ ucfirst($resource->status) }}</span></td><td>{{ number_format($resource->downloads_count) }}</td><td>{{ $resource->created_at->format('d M Y') }}</td><td>@if($resource->status==='approved')<a href="{{ route('resources.show',$resource) }}" style="color:var(--blue)">View</a>@else<span class="muted">—</span>@endif</td></tr>
        @empty<tr><td colspan="6" style="text-align:center;padding:35px"><strong>No uploads yet</strong><p class="muted">Share your first note or study resource with the community.</p><a class="btn primary" href="{{ route('resources.upload') }}">Upload a resource</a></td></tr>@endforelse
    </tbody></table></div>
    <div class="section-head"><div><h2>Saved resources</h2><p>Your bookmarked study materials.</p></div><a class="btn outline" href="{{ route('student.bookmarks') }}">View all →</a></div>
    <div class="resource-grid">@forelse($bookmarks as $resource)@include('frontend.partials.resource-card',['resource'=>$resource])@empty<div class="card empty-state"><h3>No bookmarks yet</h3><p class="muted">Save resources from the Browse page to find them here.</p><a class="btn outline" href="{{ route('resources.index') }}">Browse resources</a></div>@endforelse</div>
    <p class="muted small" style="margin:18px 0 50px">* Contribution points are an indicative CampusNotes activity score, calculated from approved uploads and their downloads.</p>
</div>
@endsection
