@extends('auth.layouts.app')
@section('title','Create account')
@section('content')
<div class="auth-shell">
<aside class="visual"><a class="brand" href="{{ url('/') }}"><span class="brand-mark">✦</span> Campus Notes</a><div class="visual-copy"><div class="eyebrow" style="color:#c7d2fe">Start your journey</div><h1>Make room<br>for great<br>ideas.</h1><p>Create your free account and build a study space that works the way you do.</p><div class="feature"><span class="feature-icon">✧</span><div><strong>Made for students</strong><small>Simple tools for everyday learning.</small></div></div><div class="feature"><span class="feature-icon">✓</span><div><strong>Your space, your pace</strong><small>Get organized one note at a time.</small></div></div></div><div class="visual-foot">© {{ date('Y') }} Campus Notes · Built for curious minds</div></aside>
<main class="form-side"><div class="form-card"><a class="brand mobile-brand" href="{{ url('/') }}"><span class="brand-mark">✦</span> Campus Notes</a><div class="eyebrow">Get started for free</div><h2>Create your account</h2><p class="sub">Join Campus Notes and bring your learning together.</p>
@if ($errors->any())<div class="alert">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
<form method="POST" action="{{ route('register') }}">@csrf
<div class="field"><label for="name">Full name</label><input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required autofocus autocomplete="name">@error('name')<div class="field-error">{{ $message }}</div>@enderror</div>
<div class="field"><label for="email">Email address</label><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@university.edu" required autocomplete="email">@error('email')<div class="field-error">{{ $message }}</div>@enderror</div>
<div class="field"><label for="password">Password</label><input id="password" type="password" name="password" placeholder="At least 8 characters" required autocomplete="new-password">@error('password')<div class="field-error">{{ $message }}</div>@enderror</div>
<div class="field"><label for="password-confirm">Confirm password</label><input id="password-confirm" type="password" name="password_confirmation" placeholder="Re-enter your password" required autocomplete="new-password"></div>
<button class="submit" type="submit">Create account →</button></form><div class="switch">Already have an account? <a href="{{ route('login') }}">Sign in</a></div></div></main></div>
@endsection
