@extends('frontend.layouts.app')
@section('title', 'Sign in')
@section('content')
<div class="container"><div class="auth-wrap"><form class="card auth-card" method="POST" action="{{ route('login') }}">
    @csrf<span class="eyebrow">WELCOME BACK</span><h1>Sign in to CampusNotes</h1><p class="muted small">Access your resources, bookmarks and student dashboard.</p>
    @if($errors->any())<div class="flash error">{{ $errors->first() }}</div>@endif
    <label for="email">Email address *</label><input class="field" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="you@university.edu">
    <label for="password">Password *</label><input class="field" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;font-size:12px"><label style="margin:0;font-weight:500"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</label>@if(Route::has('password.request'))<a href="{{ route('password.request') }}" style="color:var(--blue)">Forgot password?</a>@endif</div>
    <button class="btn primary full">Sign in →</button><p class="small muted" style="text-align:center;margin-top:18px">Don't have an account? <a href="{{ route('register') }}" style="color:var(--blue)">Create account</a></p>
</form></div></div>
@endsection
