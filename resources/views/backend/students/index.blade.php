@extends('backend.layouts.app')
@section('title', 'Student Applications')
@section('main')
<div class="main-content"><section class="section">
    <div class="section-header"><h1>Student Applications</h1><div class="section-header-breadcrumb"><div class="breadcrumb-item active">Administration</div><div class="breadcrumb-item">Student Applications</div></div></div>
    <div class="section-body">
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        <div class="row mb-3">
            <div class="col-12"><div class="card"><div class="card-body">
                <form method="GET" class="form-row align-items-end">
                    <div class="form-group col-md-5"><label>Search student</label><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Name, email, Student ID or Application No."></div>
                    <div class="form-group col-md-3"><label>Account status</label><select class="form-control" name="status"><option value="">All statuses</option>@foreach(['pending','approved','rejected','suspended','inactive','verification_required'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ ucwords(str_replace('_',' ',$status)) }}</option>@endforeach</select></div>
                    <div class="form-group col-md-2"><button class="btn btn-primary btn-block">Filter</button></div>
                    <div class="form-group col-md-2"><a href="{{ route('admin.student-applications.index') }}" class="btn btn-light btn-block">Reset</a></div>
                </form>
            </div></div></div>
        </div>
        <div class="card"><div class="card-header"><h4>Student Verification Queue</h4><div class="card-header-action">{{ $students->total() }} accounts</div></div><div class="card-body p-0"><div class="table-responsive">
            <table class="table table-striped mb-0"><thead><tr><th>Student</th><th>Application / Student ID</th><th>Academic Details</th><th>Submitted</th><th>Status</th><th style="min-width:350px">Update Status</th></tr></thead><tbody>
            @forelse($students as $student)<tr>
                <td><strong>{{ $student->name }}</strong><br><small>{{ $student->email }}</small></td>
                <td><small>App: {{ $student->application_number ?: '—' }}</small><br><small>ID: {{ $student->student_id ?: '—' }}</small></td>
                <td>{{ $student->institution_name ?: '—' }}<br><small>{{ $student->academicDepartment?->name ?: 'Department —' }} · {{ $student->student_batch ?: 'Batch —' }} · Sem {{ $student->semester ?: '—' }}</small></td>
                <td>{{ optional($student->application_submitted_at ?: $student->created_at)->format('d M Y') }}</td>
                <td><span class="badge badge-{{ $student->account_status==='approved'?'success':($student->account_status==='rejected'?'danger':($student->account_status==='pending'?'warning':'secondary')) }}">{{ ucwords(str_replace('_',' ',$student->account_status)) }}</span></td>
                <td><form method="POST" action="{{ route('admin.student-applications.status',$student) }}">@csrf @method('PUT')<div class="input-group input-group-sm mb-1"><select class="form-control" name="account_status">@foreach(['pending','approved','rejected','suspended','inactive','verification_required'] as $status)<option value="{{ $status }}" @selected($student->account_status===$status)>{{ ucwords(str_replace('_',' ',$status)) }}</option>@endforeach</select><div class="input-group-append"><button class="btn btn-primary">Save</button></div></div><input class="form-control form-control-sm mb-1" name="rejection_reason" placeholder="Rejection reason (when rejecting)" value="{{ $student->rejection_reason }}"><input class="form-control form-control-sm" name="verification_note" placeholder="Verification request / note" value="{{ $student->verification_note }}"></form></td>
            </tr>@empty<tr><td colspan="6" class="text-center p-4">No student applications found.</td></tr>@endforelse
            </tbody></table>
        </div></div><div class="card-footer">{{ $students->links() }}</div></div>
    </div>
</section></div>
@endsection
