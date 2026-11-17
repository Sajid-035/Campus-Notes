@extends('backend.layouts.app')
@section('title', 'User Resources')
@push('style')
<style>
.user-resource-admin .table td{vertical-align:middle}
.user-resource-admin .resource-desc{max-width:260px;white-space:normal;color:#8390a5;font-size:12px}
.user-resource-admin .filter-form{display:flex;gap:8px;flex-wrap:wrap}
.user-resource-admin .filter-form .form-control{min-width:160px}
.user-resource-admin .stat-card{border:0;box-shadow:0 5px 24px rgba(24,38,67,.06)}
.user-resource-admin .stat-number{font-size:24px;font-weight:800;color:#26324b}
@media(max-width:575px){.user-resource-admin .filter-form>*{width:100%}.user-resource-admin .filter-form .form-control{min-width:0}}
</style>
@endpush
@section('main')
<div class="main-content user-resource-admin">
    <section class="section">
        <div class="section-header"><h1><i class="fas fa-book-open mr-2 text-primary"></i>User Resources</h1></div>
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        <div class="row">
            @foreach(['all'=>'All Submissions','pending'=>'Pending Review','approved'=>'Approved','rejected'=>'Rejected'] as $key=>$label)
                <div class="col-6 col-md-3"><div class="card stat-card"><div class="card-body py-3"><div class="text-muted text-small">{{ $label }}</div><div class="stat-number">{{ $resourceCounts[$key] ?? 0 }}</div></div></div></div>
            @endforeach
        </div>
        <div class="card">
            <div class="card-header"><h4>User-submitted academic resources</h4></div>
            <div class="card-body">
                <form class="filter-form mb-4" method="GET">
                    <input class="form-control" type="search" name="q" value="{{ request('q') }}" placeholder="Search title, subject or contributor">
                    <select class="form-control" name="status">
                        <option value="">All statuses</option>
                        @foreach(['pending','approved','rejected','draft'] as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary"><i class="fas fa-search mr-1"></i> Filter</button>
                    <a href="{{ route('admin.resources.index') }}" class="btn btn-light">Reset</a>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead><tr><th>Resource</th><th>Contributor</th><th>Department</th><th>Status</th><th>Submitted</th><th class="text-right">Actions</th></tr></thead>
                        <tbody>
                        @forelse($resources as $resource)
                            <tr>
                                <td>
                                    <strong>{{ $resource->title }}</strong>
                                    <div class="resource-desc">{{ $resource->subject }} · {{ $resource->category }} @if($resource->file_name)<br><i class="far fa-file mr-1"></i>{{ $resource->file_name }}@endif</div>
                                </td>
                                <td>{{ $resource->uploader?->name ?? $resource->uploader_name ?? '—' }}<div class="text-muted small">{{ $resource->uploader?->email }}</div></td>
                                <td>{{ $resource->department?->code ?? '—' }}</td>
                                <td><span class="badge badge-{{ $resource->status==='approved'?'success':($resource->status==='pending'?'warning':($resource->status==='rejected'?'danger':'secondary')) }}">{{ ucfirst($resource->status) }}</span></td>
                                <td>{{ $resource->created_at?->format('d M Y') ?? '—' }}</td>
                                <td class="text-right text-nowrap">
                                    @if($resource->file_path)
                                        <a class="btn btn-sm btn-light" href="{{ asset('storage/'.$resource->file_path) }}" target="_blank" rel="noopener" title="Open uploaded file"><i class="fas fa-external-link-alt"></i></a>
                                        <a class="btn btn-sm btn-light" href="{{ asset('storage/'.$resource->file_path) }}" download title="Download uploaded file"><i class="fas fa-download"></i></a>
                                    @endif
                                    @if(in_array($resource->status,['pending','rejected','draft']))
                                        @can('resources-approve')
                                            <form method="POST" action="{{ route('admin.resources.approve',$resource) }}" class="d-inline" data-resource-confirm="Approve and publish this user resource?">@csrf<button type="submit" class="btn btn-sm btn-success">Approve</button></form>
                                            <form method="POST" action="{{ route('admin.resources.reject',$resource) }}" class="d-inline" data-resource-confirm="Reject this user resource?">@csrf<input type="hidden" name="moderation_note" value="Please review and update this submission."><button type="submit" class="btn btn-sm btn-warning">Reject</button></form>
                                        @endcan
                                    @endif
                                    @can('resources-delete')
                                        <form method="POST" action="{{ route('admin.resources.destroy',$resource) }}" class="d-inline" data-resource-confirm="Permanently delete this user resource?">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button></form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted p-5">No user resources found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">{{ $resources->links() }}</div>
            </div>
        </div>
    </section>
</div>

<div id="resourceConfirmDialog" hidden role="dialog" aria-modal="true" aria-labelledby="resourceConfirmTitle" style="position:fixed;inset:0;z-index:2000;background:rgba(15,23,42,.55);padding:20px;align-items:center;justify-content:center;display:none">
    <div style="background:#fff;border-radius:16px;padding:24px;max-width:420px;width:100%;box-shadow:0 24px 80px rgba(15,23,42,.25)">
        <div style="width:44px;height:44px;border-radius:14px;background:#eff6ff;color:#2563eb;display:grid;place-items:center;font-size:20px;margin-bottom:14px"><i class="fas fa-shield-alt"></i></div>
        <h3 id="resourceConfirmTitle" style="font-size:18px;font-weight:700;margin-bottom:8px">Confirm action</h3>
        <p id="resourceConfirmMessage" class="text-muted mb-4">Are you sure you want to continue?</p>
        <div class="d-flex justify-content-end" style="gap:8px"><button type="button" class="btn btn-light" id="resourceConfirmCancel">Cancel</button><button type="button" class="btn btn-primary" id="resourceConfirmProceed">OK, continue</button></div>
    </div>
</div>
@push('scripts')
<script>
(function () {
    const dialog = document.getElementById('resourceConfirmDialog');
    const message = document.getElementById('resourceConfirmMessage');
    const cancelButton = document.getElementById('resourceConfirmCancel');
    const proceedButton = document.getElementById('resourceConfirmProceed');
    if (!dialog || !message || !cancelButton || !proceedButton) return;

    let pendingForm = null;

    function closeDialog() {
        dialog.hidden = true;
        dialog.style.display = 'none';
        pendingForm = null;
        proceedButton.disabled = false;
        proceedButton.textContent = 'OK, continue';
        cancelButton.disabled = false;
    }

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (!(form instanceof HTMLFormElement) || !form.matches('form[data-resource-confirm]')) return;
        event.preventDefault();
        pendingForm = form;
        message.textContent = form.getAttribute('data-resource-confirm') || 'Are you sure you want to continue?';
        dialog.hidden = false;
        dialog.style.display = 'flex';
        proceedButton.focus();
    }, true);

    cancelButton.addEventListener('click', closeDialog);
    proceedButton.addEventListener('click', function () {
        const form = pendingForm;
        if (!form || !form.isConnected) {
            closeDialog();
            return;
        }

        // Prevent duplicate clicks while the browser submits the POST request.
        proceedButton.disabled = true;
        proceedButton.textContent = 'Please wait...';
        cancelButton.disabled = true;

        // Submit the original form directly. This bypasses the confirmation listener
        // and preserves the form action, method and Laravel CSRF token.
        HTMLFormElement.prototype.submit.call(form);
    });

    dialog.addEventListener('click', function (event) {
        if (event.target === dialog) closeDialog();
    });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !dialog.hidden) closeDialog();
    });
})();
</script>
@endpush
@endsection
