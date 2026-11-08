@extends('frontend.student.layouts.panel')
@section('title', 'My Resources')
@section('panel-content')
<div class="student-page-heading"><div><span class="student-kicker">MY ACADEMIC SPACE</span><h1>{{ $status === 'all' ? 'My Resources' : ($status === 'published' ? 'Published Resources' : ucfirst($status) . ' Resources') }}</h1><p>Track your uploads and review decisions.</p></div><a class="btn primary" href="{{ route('resources.upload') }}">＋ Upload Resource</a></div>
<div class="student-filter-tabs">@foreach(['all'=>'All','published'=>'Published','pending'=>'Pending','rejected'=>'Rejected','draft'=>'Draft'] as $key=>$label)<a class="{{ $status===$key?'active':'' }}" href="{{ route('student.resources',['status'=>$key]) }}">{{ $label }}</a>@endforeach</div>
<div class="card table-wrap student-table"><table><thead><tr><th>Resource</th><th>Department</th><th>Category</th><th>Status</th><th>Downloads</th><th>Uploaded</th><th>Moderation note</th></tr></thead><tbody>
@forelse($resources as $resource)<tr><td><strong>{{ $resource->title }}</strong><div class="muted small">{{ $resource->subject }} · {{ $resource->course_code }}</div></td><td>{{ $resource->department?->code ?: '—' }}</td><td>{{ $resource->category }}</td><td><span class="status {{ $resource->status }}">{{ ucfirst($resource->status) }}</span></td><td>{{ number_format($resource->downloads_count) }}</td><td>{{ $resource->created_at->format('d M Y') }}</td><td>{{ $resource->moderation_note ?: '—' }}</td></tr>
@empty<tr><td colspan="7" class="student-table-empty">No resources in this section yet.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $resources->links() }}</div>
@endsection
