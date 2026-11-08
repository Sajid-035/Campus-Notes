@extends('frontend.layouts.app')

@section('title', 'Application Status')

@section('content')
@php
    $accountStatus = (string) ($user->account_status ?? 'pending');
    $statusContent = [
        'pending' => [
            'title' => 'Your application is under review',
            'description' => 'Thanks for applying to CampusNotes. Our team is checking your student information. You can revisit this page to see updates.',
            'icon' => '◷',
        ],
        'approved' => [
            'title' => 'Your account is approved',
            'description' => 'You now have full access to your student dashboard and digital membership card.',
            'icon' => '✓',
        ],
        'rejected' => [
            'title' => 'Application not approved',
            'description' => 'You can sign in to review the decision and the reason provided by the CampusNotes team.',
            'icon' => '!',
        ],
        'suspended' => [
            'title' => 'Account suspended',
            'description' => 'Your account access is currently suspended. Please contact CampusNotes support for assistance.',
            'icon' => '!',
        ],
        'inactive' => [
            'title' => 'Account inactive',
            'description' => 'Your account is currently inactive. Please contact CampusNotes support if you believe this is a mistake.',
            'icon' => '◷',
        ],
        'verification_required' => [
            'title' => 'More information required',
            'description' => 'Please update the requested information below so our team can continue the verification.',
            'icon' => 'i',
        ],
    ];
    $currentStatus = $statusContent[$accountStatus] ?? $statusContent['pending'];
    $submittedAt = $user->application_submitted_at ?: $user->created_at;
@endphp

<div class="container application-status-page">
    <div class="application-status-card card">
        <a class="brand" href="{{ route('frontend.home') }}"><span class="logo">C</span>CampusNotes</a>

        <div class="application-status-icon {{ $accountStatus }}">{{ $currentStatus['icon'] }}</div>
        <span class="student-kicker">STUDENT ACCOUNT VERIFICATION</span>
        <h1>{{ $currentStatus['title'] }}</h1>
        <p class="muted">{{ $currentStatus['description'] }}</p>

        @if(session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        <div class="application-reference-grid">
            <div><small>APPLICATION NUMBER</small><strong>{{ $user->application_number ?: 'Pending assignment' }}</strong></div>
            <div><small>STUDENT ID</small><strong>{{ $user->student_id ?: 'Pending assignment' }}</strong></div>
            <div><small>SUBMISSION DATE</small><strong>{{ $submittedAt ? $submittedAt->format('d M Y') : 'Not available' }}</strong></div>
            <div><small>VERIFICATION STATUS</small><strong><span class="status {{ $accountStatus }}">{{ ucwords(str_replace('_', ' ', $accountStatus)) }}</span></strong></div>
        </div>

        @if($accountStatus === 'rejected' && $user->rejection_reason)
            <div class="application-reason"><strong>Rejection Reason</strong><p>{{ $user->rejection_reason }}</p></div>
        @endif

        @if($accountStatus === 'verification_required')
            <div class="application-reason"><strong>Additional information requested</strong><p>{{ $user->verification_note ?: 'Please confirm your student details.' }}</p></div>
            <form method="POST" action="{{ route('student.verification-details') }}" class="application-verification-form">
                @csrf
                <label class="field-label" for="institution_name">University / Institution *</label>
                <input class="field" id="institution_name" name="institution_name" required value="{{ old('institution_name', $user->institution_name) }}">

                <label class="field-label" for="academic_department_id">Department *</label>
                <select class="field" id="academic_department_id" name="academic_department_id" required>
                    <option value="">Choose department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" @selected(old('academic_department_id', $user->academic_department_id) == $department->id)>{{ $department->name }} ({{ $department->code }})</option>
                    @endforeach
                </select>

                <label class="field-label" for="student_batch">Batch *</label>
                <input class="field" id="student_batch" name="student_batch" required value="{{ old('student_batch', $user->student_batch) }}">

                <label class="field-label" for="semester">Current Semester *</label>
                <select class="field" id="semester" name="semester" required>
                    @for($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}" @selected(old('semester', $user->semester) == $i)>Semester {{ $i }}</option>
                    @endfor
                </select>

                <label class="field-label" for="verification_note">Message (optional)</label>
                <textarea class="field" id="verification_note" rows="3" name="verification_note" placeholder="Add any clarification">{{ old('verification_note') }}</textarea>
                <button class="btn primary" type="submit">Submit updated details →</button>
            </form>
        @endif

        @if($accountStatus === 'approved')
            <a class="btn primary" href="{{ route('student.dashboard') }}">Go to Student Dashboard →</a>
        @elseif(in_array($accountStatus, ['rejected', 'suspended', 'inactive'], true))
            <a class="btn primary" href="{{ route('student.support') }}">Contact Admin Support</a>
        @else
            <a class="btn outline" href="{{ route('student.application-status') }}">↻ Refresh Status</a>
        @endif

        <form method="POST" action="{{ route('logout') }}" class="application-logout">
            @csrf
            <button type="submit">Sign out</button>
        </form>
    </div>
</div>
@endsection
