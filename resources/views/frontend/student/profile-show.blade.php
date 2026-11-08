@extends('frontend.student.layouts.panel')
@section('title', 'View Profile')
@section('panel-content')
<div class="student-page-heading"><div><span class="student-kicker">MY PROFILE</span><h1>Student Profile</h1><p>Your CampusNotes student membership and academic information.</p></div><div style="display:flex;gap:8px;flex-wrap:wrap"><a class="btn outline" href="{{ route('student.id-card') }}">Digital Student ID</a><a class="btn primary" href="{{ route('student.profile.edit') }}">✎ Edit Profile</a></div></div>
<div class="student-profile-grid">
    <div class="card form-card">
        @if(session('success'))<div class="flash success">{{ session('success') }}</div>@endif
        <div class="student-profile-heading">
            <div class="student-profile-avatar student-avatar-frame">
                @if($user->avatar_url)<img src="{{ $user->avatar_url }}" alt="{{ $user->name }} profile photo">@else{{ strtoupper(substr($user->name,0,1)) }}@endif
            </div>
            <div><h3>{{ $user->name }}</h3><span class="status approved">✓ Verified Student</span></div>
        </div><div class="info-row"><span>Student ID</span><strong>{{ $user->student_id }}</strong></div><div class="info-row"><span>Email</span><strong>{{ $user->email }}</strong></div><div class="info-row"><span>Phone</span><strong>{{ $user->phone ?: 'Not provided' }}</strong></div><div class="info-row"><span>Institution</span><strong>{{ $user->institution_name ?: 'Not provided' }}</strong></div><div class="info-row"><span>Department</span><strong>{{ $user->academicDepartment?->name ?: 'Not provided' }}</strong></div><div class="info-row"><span>Batch</span><strong>{{ $user->student_batch ?: 'Not provided' }}</strong></div><div class="info-row"><span>Semester</span><strong>{{ $user->semester ?: 'Not provided' }}</strong></div><div class="info-row"><span>Member since</span><strong>{{ optional($user->verified_at ?: $user->created_at)->format('d M Y') }}</strong></div>@if($user->profile_bio)<div style="padding-top:15px"><strong>About Me</strong><p class="muted" style="font-size:12px;line-height:1.7">{{ $user->profile_bio }}</p></div>@endif</div>
    <div class="student-profile-side"><div class="card student-identity-summary"><span class="student-kicker">MEMBERSHIP STATUS</span><h3>✓ Verified</h3><p class="muted small">Your account has been approved by the CampusNotes team.</p><a class="btn primary" style="width:100%" href="{{ route('student.id-card') }}">Download ID Card</a></div><div class="card student-identity-summary"><h3>Account Privacy</h3><p class="muted small">Manage whether your profile and leaderboard information are visible to other students.</p><a href="{{ route('student.settings') }}" class="student-table-action">Privacy Settings →</a></div></div>
</div>
@endsection

@push('styles')
<style>.student-avatar-frame{overflow:hidden;flex:0 0 auto;border-radius:50%;}.student-avatar-frame img{display:block;width:100%;height:100%;object-fit:cover;border-radius:inherit;}</style>
@endpush
