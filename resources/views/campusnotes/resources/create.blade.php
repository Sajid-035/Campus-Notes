@extends('campusnotes.layout')
@section('title','Upload Resource')
@section('content')
<div class="page-banner"><div class="container"><span class="eyebrow">CONTRIBUTE TO YOUR COMMUNITY</span><h1 class="fw-bold">Upload a resource</h1><p class="text-white-50 mb-0">Submissions enter the moderation queue before becoming public.</p></div></div>
<div class="container py-5"><div class="form-panel mx-auto" style="max-width:850px"><form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data">@csrf<div class="row g-3">
<div class="col-12"><label class="form-label">Resource title *</label><input name="title" class="form-control" value="{{ old('title') }}" required></div>
<div class="col-12"><label class="form-label">Description *</label><textarea name="description" rows="3" class="form-control" required>{{ old('description') }}</textarea></div>
<div class="col-md-6"><label class="form-label">Category *</label><select name="category" class="form-select" required><option value="">Select</option>@foreach(['Class Notes','Previous Questions','Assignments','Lab Reports','Lecture Slides','Books','Research Papers','Tutorials','Presentation Slides','Other Resources'] as $c)<option>{{ $c }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Department *</label><select name="department_id" class="form-select" required><option value="">Select</option>@foreach($departments as $d)<option value="{{ $d->id }}">{{ $d->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Subject *</label><input name="subject" class="form-control" required></div><div class="col-md-6"><label class="form-label">Subject code</label><input name="subject_code" class="form-control"></div>
<div class="col-md-6"><label class="form-label">Semester *</label><select name="semester" class="form-select" required><option value="">Select</option>@foreach(['1st Semester','2nd Semester','3rd Semester','4th Semester','5th Semester','6th Semester','7th Semester','8th Semester'] as $s)<option>{{ $s }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Academic year</label><input name="academic_year" class="form-control" placeholder="2025-26"></div>
<div class="col-12"><label class="form-label">PDF file * (maximum 10 MB)</label><input type="file" name="file" class="form-control" accept=".pdf,application/pdf" required></div>
</div><div class="text-end mt-4"><button class="btn btn-primary px-4">Submit for review</button></div></form></div></div>
@endsection
