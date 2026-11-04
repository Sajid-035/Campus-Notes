@extends('auth.layouts.app')
@section('title','Sign in')
@section('content')
<div class="auth-shell">
<aside class="visual"><a class="brand" href="{{ url('/') }}"><span class="brand-mark">✦</span> Campus Notes</a><div class="visual-copy"><div class="eyebrow" style="color:#c7d2fe">Your learning space</div><h1>Every class.<br>Every idea.<br>One place.</h1><p>Keep your notes organized, stay on top of your studies, and make learning feel effortless.</p><div class="feature"><span class="feature-icon">✎</span><div><strong>Notes that make sense</strong><small>Bring your coursework together.</small></div></div><div class="feature"><span class="feature-icon">⌁</span><div><strong>Focus on what matters</strong><small>A calmer way to manage your study life.</small></div></div></div><div class="visual-foot">© {{ date('Y') }} Campus Notes · Built for curious minds</div></aside>
<main class="form-side"><div class="form-card"><a class="brand mobile-brand" href="{{ url('/') }}"><span class="brand-mark">✦</span> Campus Notes</a><div class="eyebrow">Welcome back</div><h2>Sign in to your account</h2><p class="sub">Enter your details to continue to your workspace.</p>
@if ($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('login') }}">@csrf
<div class="field"><label for="email">Email address</label><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@university.edu" required autofocus autocomplete="email">@error('email')<div class="field-error">{{ $message }}</div>@enderror</div>
<div class="field"><label for="password">Password</label><input id="password" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password">@error('password')<div class="field-error">{{ $message }}</div>@enderror</div>
<div class="form-row"><label class="check"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</label>@if(Route::has('password.request'))<a href="{{ route('password.request') }}">Forgot password?</a>@endif</div>
<button class="submit" type="submit">Sign in →</button></form><div class="switch">New to Campus Notes? <a href="{{ route('register') }}">Create an account</a></div></div></main></div>
@endsection
