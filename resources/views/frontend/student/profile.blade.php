@extends('frontend.student.layouts.panel')
@section('title', 'Edit Profile')
@section('panel-content')
<div class="student-page-heading"><div><span class="student-kicker">MY PROFILE</span><h1>Edit Profile</h1><p>Update your academic identity and profile information.</p></div><div style="display:flex;gap:8px;flex-wrap:wrap"><a class="btn outline" href="{{ route('student.profile') }}">View Profile</a><a class="btn outline" href="{{ route('student.id-card') }}">Digital ID →</a></div></div>
<div class="student-profile-grid">
    <div class="card form-card"><form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">@csrf @method('PUT')
        @if($errors->any())<div class="flash error">Please review the highlighted information.<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <div class="student-profile-heading">
            <div class="student-profile-avatar student-avatar-frame" id="avatarPreviewFrame">
                @if($user->avatar_url)
                    <img id="avatarPreview" src="{{ $user->avatar_url }}" alt="{{ $user->name }} profile photo">
                @else
                    <img id="avatarPreview" src="" alt="Profile photo preview" hidden>
                    <span id="avatarInitial">{{ strtoupper(substr($user->name,0,1)) }}</span>
                @endif
            </div>
            <div><h3>{{ $user->name }}</h3><span class="status approved">✓ Verified Student</span><p class="muted small" style="margin:5px 0 0">Your profile photo appears on your student panel and membership card.</p></div>
        </div>
        <label class="field-label">Full Name *</label><input class="field" name="name" required value="{{ old('name',$user->name) }}">
        <label class="field-label">Phone Number</label><input class="field" name="phone" value="{{ old('phone',$user->phone) }}" placeholder="Your contact number">
        <label class="field-label">University / Institution</label><input class="field" name="institution_name" value="{{ old('institution_name',$user->institution_name) }}">
        <label class="field-label">Department</label><select class="field" name="academic_department_id"><option value="">Choose department</option>@foreach($departments as $department)<option value="{{ $department->id }}" @selected(old('academic_department_id',$user->academic_department_id)==$department->id)>{{ $department->name }} ({{ $department->code }})</option>@endforeach</select>
        <div class="profile-form-row"><div><label class="field-label">Batch</label><input class="field" name="student_batch" value="{{ old('student_batch',$user->student_batch) }}"></div><div><label class="field-label">Semester</label><select class="field" name="semester"><option value="">Choose semester</option>@for($i=1;$i<=20;$i++)<option value="{{ $i }}" @selected(old('semester',$user->semester)==$i)>Semester {{ $i }}</option>@endfor</select></div></div>
        <label class="field-label">About Me</label><textarea class="field" name="profile_bio" rows="4" placeholder="A short introduction">{{ old('profile_bio',$user->profile_bio) }}</textarea>
        <label class="field-label" for="avatarInput">Profile Photo</label>
        <input class="field" id="avatarInput" type="file" name="avatar" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
        <p class="muted small">Choose a JPG, PNG or WebP image, maximum 5 MB. The preview updates before you save.</p>
        @error('avatar')<p class="field-error" style="color:#dc2626;font-size:11px">{{ $message }}</p>@enderror
        <button class="btn primary">Save Profile</button>
    </form></div>
    <div class="student-profile-side"><div class="card student-identity-summary"><span class="student-kicker">CAMPUSNOTES IDENTITY</span><h3>{{ $user->student_id }}</h3><p class="muted small">Your unique CampusNotes student membership ID.</p><div class="info-row"><span>Application</span><strong>{{ $user->application_number }}</strong></div><div class="info-row"><span>Email</span><strong>{{ $user->email }}</strong></div><div class="info-row"><span>Account</span><span class="status approved">Approved</span></div><a class="btn outline" style="width:100%;margin-top:15px" href="{{ route('student.id-card') }}">Download ID Card</a></div>
        <div class="card student-identity-summary"><h3>Profile visibility</h3><p class="muted small">Control your profile and leaderboard visibility from Account Settings.</p><a href="{{ route('student.settings') }}" class="student-table-action">Open Account Settings →</a></div></div>
</div>
@endsection

@push('styles')
<style>
.student-avatar-frame{overflow:hidden;position:relative;flex:0 0 auto;border-radius:50%;}
.student-avatar-frame img{display:block;width:100%;height:100%;object-fit:cover;border-radius:inherit;}
.student-avatar-frame span{display:grid;width:100%;height:100%;place-items:center;}
.field-error{margin:6px 0 0;}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('avatarInput');
    const preview = document.getElementById('avatarPreview');
    const initial = document.getElementById('avatarInitial');
    if (!input || !preview) return;
    input.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;
        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
            this.value = '';
            alert('Please select a JPG, PNG or WebP image.');
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            this.value = '';
            alert('The image must be 5 MB or smaller.');
            return;
        }
        preview.src = URL.createObjectURL(file);
        preview.hidden = false;
        if (initial) initial.hidden = true;
    });
});
</script>
@endpush
