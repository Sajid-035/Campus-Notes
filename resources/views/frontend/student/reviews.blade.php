@extends('frontend.student.layouts.panel')
@section('title', 'My Reviews')
@section('panel-content')
<div class="student-page-heading"><div><span class="student-kicker">MY CONTRIBUTIONS</span><h1>My Reviews</h1><p>All ratings and feedback you have submitted.</p></div><a class="btn outline" href="{{ route('resources.index') }}">Browse Resources →</a></div>
<div class="student-review-list">@forelse($reviews as $review)<article class="card student-review-item"><div><strong>{{ $review->resource?->title ?: 'Resource no longer available' }}</strong><div class="gold" style="margin:7px 0">{{ str_repeat('★',$review->rating) }}{{ str_repeat('☆',5-$review->rating) }} <span class="muted small">{{ $review->rating }}/5</span></div><p>{{ $review->comment ?: 'No written comment.' }}</p></div><time class="muted small">{{ $review->created_at->format('d M Y') }}</time></article>@empty<div class="card empty-state"><h3>No reviews submitted</h3><p class="muted">Share feedback on helpful notes and resources.</p><a class="btn primary" href="{{ route('resources.index') }}">Explore Resources</a></div>@endforelse</div><div class="pagination">{{ $reviews->links() }}</div>
@endsection
