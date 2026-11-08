@extends('frontend.layouts.app')
@section('title', 'Upload a resource')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / Upload resource</div><h1>Share a resource</h1><p class="muted">Upload useful academic material and help other students learn. Every upload is reviewed before publication.</p></div>
    <div class="card form-card" style="max-width:820px;margin:0 auto 60px">
        @if($errors->any())<div class="flash error">Please correct the highlighted fields and try again.<ul style="margin:8px 0 0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data">@csrf
            <div class="page-grid" style="grid-template-columns:1fr 1fr;gap:14px;padding:0">
                <div><label class="field-label">Resource title *</label><input class="field" name="title" value="{{ old('title') }}" required maxlength="220" placeholder="e.g. Data Structures — Class Notes"></div>
                <div><label class="field-label">Subject *</label><input class="field" name="subject" value="{{ old('subject') }}" required maxlength="180" placeholder="e.g. Data Structures"></div>
                <div><label class="field-label">Course code</label><input class="field" name="course_code" value="{{ old('course_code') }}" placeholder="e.g. CSE 201"></div>
                <div><label class="field-label">Department *</label><select class="field" name="department_id" required><option value="">Choose department</option>@foreach($departments as $department)<option value="{{ $department->id }}" @selected(old('department_id')==$department->id)>{{ $department->code }} — {{ $department->name }}</option>@endforeach</select></div>
                <div><label class="field-label">Semester</label><select class="field" name="semester"><option value="">Choose semester</option>@for($i=1;$i<=8;$i++)<option value="{{ $i }}" @selected(old('semester')==$i)>Semester {{ $i }}</option>@endfor</select></div>
                <div><label class="field-label">Resource category *</label><select class="field" name="category" required><option value="">Choose category</option>@foreach(['Class Notes','Previous Questions','Assignments','Lab Reports','Lecture Slides'] as $category)<option @selected(old('category')===$category)>{{ $category }}</option>@endforeach</select></div>
            </div>
            <label class="field-label">Description</label><textarea class="field" name="description" rows="5" placeholder="What does this resource cover?">{{ old('description') }}</textarea>
            <label class="field-label">Document file * (PDF, DOC, DOCX, PPT, PPTX · Max 25 MB)</label><input class="field" type="file" name="document" id="document" accept=".pdf,.doc,.docx,.ppt,.pptx" required><div class="muted small" id="selectedFileName" style="margin-top:7px">No file selected</div>
            <div class="flash" style="margin-top:16px">Your upload will be saved as <strong>Pending</strong> until a moderator reviews it. Do not upload copyrighted or personal/confidential material without permission.</div>
            <button class="btn primary" style="margin-top:8px">Submit for review →</button>
        </form>
    </div>
</div>
@endsection
