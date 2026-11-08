@extends('backend.layouts.app')
@section('title', 'Academic Resources')
@push('style')
<style>.resource-admin .table td{vertical-align:middle}.resource-admin .resource-desc{max-width:270px;white-space:normal;color:#8390a5;font-size:12px}.resource-admin .filter-form{display:flex;gap:8px;flex-wrap:wrap}.resource-admin .filter-form .form-control{min-width:160px}@media(max-width:575px){.resource-admin .filter-form>*{width:100%}.resource-admin .filter-form .form-control{min-width:0}}</style>
@endpush
@section('main')
<div class="main-content resource-admin"><section class="section"><div class="section-header"><h1><i class="fas fa-book-open mr-2 text-primary"></i>Academic Resources</h1></div>
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="card"><div class="card-header"><h4>Resource moderation queue</h4></div><div class="card-body">
<form class="filter-form mb-4"><input class="form-control" type="search" name="q" value="{{ request('q') }}" placeholder="Search resource title"><select class="form-control" name="status"><option value="">All statuses</option>@foreach(['pending','approved','rejected'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ ucfirst($status) }}</option>@endforeach</select><button class="btn btn-primary">Filter</button><a href="{{ route('admin.resources.index') }}" class="btn btn-light">Reset</a></form>
<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Resource</th><th>Contributor</th><th>Department</th><th>Status</th><th>Submitted</th><th class="text-right">Actions</th></tr></thead><tbody>
@forelse($resources as $resource)<tr><td><strong>{{ $resource->title }}</strong><div class="resource-desc">{{ $resource->subject }} · {{ $resource->category }} @if($resource->file_name)<br>{{ $resource->file_name }}@endif</div></td><td>{{ $resource->uploader?->name ?? $resource->uploader_name ?? '—' }}</td><td>{{ $resource->department?->code ?? '—' }}</td><td><span class="badge badge-{{ $resource->status==='approved'?'success':($resource->status==='pending'?'warning':'danger') }}">{{ ucfirst($resource->status) }}</span></td><td>{{ $resource->created_at->format('d M Y') }}</td><td class="text-right text-nowrap">
@if(in_array($resource->status,['pending','rejected']))@can('resources-approve')<form method="POST" action="{{ route('admin.resources.approve',$resource) }}" class="d-inline">@csrf<button class="btn btn-sm btn-success" onclick="return confirm('Approve and publish this resource?')">Approve</button></form><form method="POST" action="{{ route('admin.resources.reject',$resource) }}" class="d-inline">@csrf<input type="hidden" name="moderation_note" value="Please review and update this submission."><button class="btn btn-sm btn-warning" onclick="return confirm('Reject this resource?')">Reject</button></form>@endcan @endif
@can('resources-delete')<form method="POST" action="{{ route('admin.resources.destroy',$resource) }}" class="d-inline" onsubmit="return confirm('Permanently delete this resource?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>@endcan
</td></tr>@empty<tr><td colspan="6" class="text-center text-muted p-5">No resources found.</td></tr>@endforelse
</tbody></table></div><div class="d-flex justify-content-end">{{ $resources->links() }}</div></div></div>
</section></div>
@endsection
