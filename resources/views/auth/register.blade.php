@extends('auth.layouts.campus')

@section('title', 'Create a student account')

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
            <p>Create your student profile to discover useful academic materials, share what you know and build your learning journey with CampusNotes.</p>
            <div class="auth-feature-list">
                <div class="auth-feature"><span class="auth-feature-icon">＋</span><span><strong>Share your knowledge</strong><small>Upload notes, questions and assignments</small></span></div>
                <div class="auth-feature"><span class="auth-feature-icon">▣</span><span><strong>Your own academic space</strong><small>Track uploads, downloads and bookmarks</small></span></div>
                <div class="auth-feature"><span class="auth-feature-icon">✓</span><span><strong>Student account verification</strong><small>Get full access after your application is approved</small></span></div>
            </div>
        </div>

        <div class="auth-visual-foot">© {{ date('Y') }} CampusNotes · Built by students, for students.</div>
    </aside>

    <main class="auth-main">
        <a class="auth-top-link" href="{{ route('frontend.home') }}">← Back to website</a>
        <section class="auth-form-wrap auth-form-wide" aria-labelledby="register-heading">
            <span class="auth-kicker">Create your account</span>
            <h1 class="auth-heading" id="register-heading">Join CampusNotes</h1>
            <p class="auth-subtitle">Enter your student details below. Your application will be reviewed before full dashboard access is enabled.</p>

            @if($errors->any())
                <div class="auth-error" role="alert">
                    <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form class="auth-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="auth-grid">
                    <div class="auth-field">
                        <label for="name">Full name *</label>
                        <input class="auth-control" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" maxlength="255" placeholder="Your full name">
                    </div>
                    <div class="auth-field">
                        <label for="email">Email address *</label>
                        <input class="auth-control" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="you@university.edu">
                    </div>
                    <div class="auth-field full">
                        <label for="institution_name">University / Institution *</label>
                        <input class="auth-control" id="institution_name" type="text" name="institution_name" value="{{ old('institution_name') }}" required maxlength="190" placeholder="University or institution name">
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
                    <div class="auth-field">
                        <label for="student_batch">Batch *</label>
                        <input class="auth-control" id="student_batch" type="text" name="student_batch" value="{{ old('student_batch') }}" required maxlength="30" placeholder="e.g. 2025–2026">
                    </div>
                    <div class="auth-field full">
                        <label for="semester">Current semester *</label>
                        <select class="auth-control" id="semester" name="semester" required>
                            <option value="">Choose your current semester</option>
                            @for($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" @selected(old('semester') == $i)>{{ $i }}{{ $i === 1 ? 'st' : ($i === 2 ? 'nd' : ($i === 3 ? 'rd' : 'th')) }} Semester</option>
                            @endfor
                        </select>
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
                <button class="auth-submit" type="submit">Submit student application&nbsp; →</button>
            </form>

            <p class="auth-switch">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            <div class="auth-legal">By creating an account, you confirm that the student information submitted is accurate.</div>
        </section>
    </main>
</div>
@endsection
