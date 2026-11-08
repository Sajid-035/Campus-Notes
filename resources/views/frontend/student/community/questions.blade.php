@extends('frontend.student.layouts.panel')
@section('title', 'My Questions')
@section('panel-content')
<div class="student-page-heading"><div><span class="student-kicker">COMMUNITY</span><h1>My Questions</h1><p>Discussions you have started.</p></div><a class="btn outline" href="{{ route('student.community') }}">All Discussions →</a></div>
<div class="student-community-list">@forelse($discussions as $discussion)<article class="card student-discussion-card"><div class="student-discussion-meta"><span>{{ $discussion->created_at->format('d M Y') }}</span><span>{{ $discussion->replies->count() }} replies</span></div><h3>{{ $discussion->title }}</h3><p>{{ $discussion->body }}</p>@foreach($discussion->replies as $reply)<div class="student-reply-inline"><strong>{{ $reply->user->name }}</strong> · {{ $reply->body }}</div>@endforeach</article>@empty<div class="card empty-state"><h3>You have not asked a question yet</h3><p class="muted">Start a discussion to get help from other students.</p><a class="btn primary" href="{{ route('student.community') }}">Start a Discussion</a></div>@endforelse</div><div class="pagination">{{ $discussions->links() }}</div>
@endsection
