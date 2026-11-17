@extends('auth.layouts.campus')

@section('title', 'Create a CampusNotes account')

@section('content')
<div class="auth-page">
    <aside class="auth-visual">
        <a class="auth-brand" href="{{ route('frontend.home') }}">
            <span class="auth-logo">C</span>
            <span>CampusNotes</span>
        </a>

        <div class="auth-visual-copy">
            <span class="auth-chip">✦ Join the campus community</span>
            <h1>Make your learning resources go further.</h1>
            <p>Create your member profile to discover useful academic materials, share what you know and build your campus community with CampusNotes.</p>
            <div class="auth-feature-list">
                <div class="auth-feature"><span class="auth-feature-icon">＋</span><span><strong>Share your knowledge</strong><small>Upload notes, questions and assignments</small></span></div>
                <div class="auth-feature"><span class="auth-feature-icon">▣</span><span><strong>Your own academic space</strong><small>Track uploads, downloads and bookmarks</small></span></div>
                <div class="auth-feature"><span class="auth-feature-icon">✓</span><span><strong>Account verification</strong><small>Students, teachers and staff get the same member workspace after approval</small></span></div>
            </div>
        </div>

        <div class="auth-visual-foot">© {{ date('Y') }} CampusNotes · Built for the campus community.</div>
    </aside>

    <main class="auth-main">
        <a class="auth-top-link" href="{{ route('frontend.home') }}">← Back to website</a>
        <section class="auth-form-wrap auth-form-wide" aria-labelledby="register-heading">
            <span class="auth-kicker">Create your account</span>
            <h1 class="auth-heading" id="register-heading">Join CampusNotes</h1>
            <p class="auth-subtitle">Choose your account type and enter your institution details. Your application will be reviewed before full dashboard access is enabled.</p>

            @if($errors->any())
                <div class="auth-error" role="alert">
                    <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form class="auth-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="auth-grid">
                    <div class="auth-field">
                        <label for="account_type">I am registering as *</label>
                        <select class="auth-control" id="account_type" name="account_type" required>
                            <option value="student" @selected(old('account_type', 'student') === 'student')>Student</option>
                            <option value="teacher" @selected(old('account_type') === 'teacher')>Teacher</option>
                            <option value="staff" @selected(old('account_type') === 'staff')>Staff</option>
                        </select>
                    </div>
                    <div class="auth-field">
                        <label for="name">Full name *</label>
                        <input class="auth-control" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" maxlength="255" placeholder="Your full name">
                    </div>
                    <div class="auth-field">
                        <label for="email">Email address *</label>
                        <input class="auth-control" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="you@university.edu">
                    </div>
                    <div class="auth-field">
                        <label for="institution_name">University / Institution *</label>
                        <input class="auth-control" id="institution_name" type="text" name="institution_name" value="{{ old('institution_name') }}" required maxlength="190" placeholder="University or institution name">
                    </div>
                    <div class="auth-field">
                        <label for="institutional_id_number">Institutional ID Card No. *</label>
                        <input class="auth-control" id="institutional_id_number" type="text" name="institutional_id_number" value="{{ old('institutional_id_number') }}" required maxlength="80" autocomplete="off" placeholder="Your student / teacher / staff ID number">
                    </div>
                    <div class="auth-field">
                        <label for="academic_department_id">Department *</label>
                        <select class="auth-control" id="academic_department_id" name="academic_department_id" required>
                            <option value="">Choose your department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" @selected(old('academic_department_id') == $department->id)>{{ $department->name }} ({{ $department->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="auth-field full" id="studentAcademicFields" @if(old('account_type', 'student') !== 'student') hidden @endif>
                        <div class="auth-grid">
                            <div class="auth-field">
                                <label for="student_batch">Batch *</label>
                                <input class="auth-control" id="student_batch" type="text" name="student_batch" value="{{ old('student_batch') }}" maxlength="30" placeholder="e.g. 2025–2026" @if(old('account_type', 'student') === 'student') required @endif>
                            </div>
                            <div class="auth-field">
                                <label for="semester">Current semester *</label>
                                <select class="auth-control" id="semester" name="semester" @if(old('account_type', 'student') === 'student') required @endif>
                                    <option value="">Choose your current semester</option>
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->number }}" @selected(old('semester') == $semester->number)>{{ $semester->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="auth-field">
                        <label for="password">Password *</label>
                        <input class="auth-control" id="password" type="password" name="password" required autocomplete="new-password" minlength="8" placeholder="At least 8 characters">
                    </div>
                    <div class="auth-field">
                        <label for="password-confirm">Confirm password *</label>
                        <input class="auth-control" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" minlength="8" placeholder="Re-enter your password">
                    </div>
                </div>

                <div class="auth-note"><span>ⓘ</span><span><strong>What happens next?</strong> Your application starts with <strong>Pending</strong> status. After submitting, you can track your application number and verification status on the CampusNotes Application Status page.</span></div>
                <button class="auth-submit" type="submit">Submit registration&nbsp; →</button>
            </form>

            <p class="auth-switch">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            <div class="auth-legal">By creating an account, you confirm that your institutional information is accurate.</div>
        </section>
    </main>
</div>
@endsection

@push('auth_scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('account_type');
    const studentFields = document.getElementById('studentAcademicFields');
    const batchInput = document.getElementById('student_batch');
    const semesterInput = document.getElementById('semester');

    function syncAccountFields() {
        const isStudent = typeSelect && typeSelect.value === 'student';
        if (studentFields) studentFields.hidden = !isStudent;
        [batchInput, semesterInput].forEach(function (field) {
            if (!field) return;
            field.required = Boolean(isStudent);
            if (!isStudent) field.value = '';
        });
    }

    if (typeSelect) {
        typeSelect.addEventListener('change', syncAccountFields);
        syncAccountFields();
    }
});
</script>
@endpush

@push('auth_styles')
<style>#studentAcademicFields[hidden]{display:none!important}</style>
@endpush
