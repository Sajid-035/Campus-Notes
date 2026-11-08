@extends('frontend.student.layouts.panel')
@section('title', 'My Replies')
@section('panel-content')
<div class="student-page-heading"><div><span class="student-kicker">COMMUNITY</span><h1>My Replies</h1><p>Questions and discussions you have responded to.</p></div><a class="btn outline" href="{{ route('student.community') }}">Join Discussion →</a></div>
<div class="student-community-list">@forelse($replies as $reply)<article class="card student-discussion-card"><small class="muted">{{ $reply->created_at->format('d M Y, h:i A') }}</small><h3>{{ $reply->discussion?->title ?: 'Discussion unavailable' }}</h3><p>{{ $reply->body }}</p><span class="muted small">By you</span></article>@empty<div class="card empty-state"><h3>No replies yet</h3><p class="muted">Help another student by replying to a community discussion.</p><a class="btn primary" href="{{ route('student.community') }}">Browse Discussions</a></div>@endforelse</div><div class="pagination">{{ $replies->links() }}</div>
@endsection
