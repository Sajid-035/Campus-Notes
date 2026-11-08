@extends('frontend.student.layouts.panel')
@section('title', 'My Downloads')
@section('panel-content')
<div class="student-page-heading"><div><span class="student-kicker">MY ACADEMIC SPACE</span><h1>My Downloads</h1><p>Review the study materials you have downloaded from CampusNotes.</p></div><a class="btn outline" href="{{ route('resources.index') }}">Browse Resources →</a></div>
<div class="card table-wrap student-table"><table><thead><tr><th>Resource</th><th>Department</th><th>Category</th><th>Downloaded</th><th>Action</th></tr></thead><tbody>
@forelse($downloads as $download)<tr><td><strong>{{ $download->resource?->title ?: 'Resource unavailable' }}</strong><div class="muted small">{{ $download->resource?->subject }}</div></td><td>{{ $download->resource?->department?->code ?: '—' }}</td><td>{{ $download->resource?->category ?: '—' }}</td><td>{{ $download->downloaded_at?->format('d M Y, h:i A') }}</td><td>@if($download->resource && $download->resource->status==='approved')<a class="student-table-action" href="{{ route('resources.show',$download->resource) }}">View again</a>@else—@endif</td></tr>
@empty<tr><td colspan="5" class="student-table-empty"><h3>No downloads yet</h3><p class="muted">Downloaded notes and questions will appear here.</p><a class="btn primary" href="{{ route('resources.index') }}">Browse Resources</a></td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $downloads->links() }}</div>
@endsection
