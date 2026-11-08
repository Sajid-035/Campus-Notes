@extends('frontend.layouts.app')
@section('title', 'Create an account')
@section('content')
<div class="container"><div class="auth-wrap"><form class="card auth-card" method="POST" action="{{ route('register') }}">
    @csrf<span class="eyebrow">JOIN THE COMMUNITY</span><h1>Create your CampusNotes account</h1><p class="muted small">Save useful materials and share resources with your campus.</p>
    @if($errors->any())<div class="flash error">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
    <label for="name">Full name *</label><input class="field" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Your name">
    <label for="email">Email address *</label><input class="field" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="you@university.edu">
    <label for="password">Password *</label><input class="field" id="password" type="password" name="password" required autocomplete="new-password" placeholder="At least 8 characters">
    <label for="password-confirm">Confirm password *</label><input class="field" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter your password">
    <button class="btn primary full">Create account →</button><p class="small muted" style="text-align:center;margin-top:18px">Already have an account? <a href="{{ route('login') }}" style="color:var(--blue)">Sign in</a></p>
</form></div></div>
@endsection
