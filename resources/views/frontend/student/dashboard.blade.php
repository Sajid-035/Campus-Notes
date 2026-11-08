@extends('frontend.student.layouts.panel')
@section('title', 'Student Dashboard')
@section('panel-content')
<div class="student-page-heading"><div><span class="student-kicker">STUDENT DASHBOARD</span><h1>Your Academic Space</h1><p>Manage your resources and learning activities.</p></div><a class="btn primary" href="{{ route('resources.upload') }}">＋ Upload Resource</a></div>
<div class="dashboard-banner student-welcome-banner">
    <div><span class="eyebrow" style="background:#ffffff20;color:white">CAMPUSNOTES · STUDENT PANEL</span><h2>Welcome back, {{ $user->name }}!</h2><p>ID: {{ $user->student_id ?: 'Not assigned' }} · {{ $user->academicDepartment?->code ?: 'Department not set' }} · Semester {{ $user->semester ?: '—' }}</p></div>
    <span class="student-verified-pill">✓ Verified</span>
</div>
<div class="dash-stats student-stat-grid" id="stats">
    <div class="stat"><div class="stat-icon">▤</div><div><strong>{{ $stats['uploads'] }}</strong><span>Total Uploads</span></div></div>
    <div class="stat"><div class="stat-icon">✓</div><div><strong>{{ $stats['approved'] }}</strong><span>Approved</span></div></div>
    <div class="stat"><div class="stat-icon">◷</div><div><strong>{{ $stats['pending'] }}</strong><span>Pending</span></div></div>
    <div class="stat"><div class="stat-icon">⇩</div><div><strong>{{ number_format($stats['downloads']) }}</strong><span>Downloads</span></div></div>
    <div class="stat"><div class="stat-icon">✧</div><div><strong>{{ number_format($stats['points']) }}</strong><span>Points Earned</span></div></div>
    <div class="stat"><div class="stat-icon">☆</div><div><strong>{{ $stats['bookmarks'] }}</strong><span>Bookmarks</span></div></div>
</div>
<div class="student-quick-actions card"><div><h3>Quick Actions</h3><p class="muted small">Continue your CampusNotes activity.</p></div><div class="student-quick-buttons"><a class="btn primary" href="{{ route('resources.upload') }}">＋ Upload Resource</a><a class="btn outline" href="{{ route('resources.index') }}">⌕ Browse Notes</a><a class="btn outline" href="{{ route('student.bookmarks') }}">☆ View Bookmarks</a></div></div>
<div class="student-id-preview-section"><div><span class="student-kicker">STUDENT MEMBERSHIP</span><h3>Your Digital Student ID Card</h3><p class="muted small">Your CampusNotes membership identity. It is not a replacement for your university ID card.</p></div><div class="student-id-preview-wrap">@include('frontend.student.partials.id-card-preview', ['user' => $user])<a class="btn outline" href="{{ route('student.id-card') }}">Download ID Card →</a></div></div>
<div class="chart-grid student-charts">
    <div class="card chart-card"><h3>Monthly Upload Activity</h3><div class="bars"><div class="student-chart-bars">@php($maxUploads = max(1, (int) $activity->max('uploads')))@foreach($activity as $month)<div class="bar" style="height:{{ max(8, (int)(100 * $month['uploads'] / $maxUploads)) }}%"><span>{{ $month['label'] }}</span></div>@endforeach</div></div><p class="muted small" style="margin-top:27px">Uploads over the last six months.</p></div>
    <div class="card chart-card"><h3>Contribution Overview</h3><div class="student-contribution-list"><div><span>Approved resources</span><strong>{{ $stats['approved'] }}</strong></div><div><span>Waiting for review</span><strong>{{ $stats['pending'] }}</strong></div><div><span>Downloads received</span><strong>{{ number_format($stats['downloads']) }}</strong></div><div><span>Saved resources</span><strong>{{ $stats['bookmarks'] }}</strong></div></div><a class="btn outline" href="{{ route('student.points') }}">View points & rewards →</a></div>
</div>
<div class="section-head student-table-heading"><div><h2>Recent Uploads</h2><p>Your latest academic resources and their review status.</p></div><a class="btn outline" href="{{ route('student.resources', ['status'=>'all']) }}">View all →</a></div>
<div class="card table-wrap student-table"><table><thead><tr><th>Resource</th><th>Category</th><th>Status</th><th>Downloads</th><th>Submitted</th><th>Action</th></tr></thead><tbody>
@forelse($myResources as $resource)<tr><td><strong>{{ $resource->title }}</strong><div class="muted small">{{ $resource->subject }}</div></td><td>{{ $resource->category }}</td><td><span class="status {{ $resource->status }}">{{ $resource->status === 'approved' ? 'Published' : ucfirst($resource->status) }}</span></td><td>{{ number_format($resource->downloads_count) }}</td><td>{{ $resource->created_at->format('d M Y') }}</td><td>@if($resource->status === 'approved')<a class="student-table-action" href="{{ route('resources.show', $resource) }}">View</a>@elseif($resource->status === 'rejected')<span class="muted" title="{{ $resource->moderation_note }}">Reason</span>@else<span class="muted">In review</span>@endif</td></tr>
@empty<tr><td colspan="6" class="student-table-empty"><strong>No uploads yet</strong><p class="muted">Share your first study resource with the CampusNotes community.</p><a class="btn primary" href="{{ route('resources.upload') }}">Upload Resource</a></td></tr>@endforelse
</tbody></table></div>
<div class="student-notice-row"><span>♧</span><div><strong>{{ $stats['unread'] }} unread notifications</strong><p>Stay up to date with resource approvals and community replies.</p></div><a href="{{ route('student.notifications') }}">View notifications →</a></div>
@endsection
