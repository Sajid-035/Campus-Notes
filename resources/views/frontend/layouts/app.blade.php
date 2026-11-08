<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#142b55">
    <meta name="description" content="@yield('meta_description', 'CampusNotes is a student-powered hub for class notes, previous questions, assignments and academic resources.')">
    <meta name="robots" content="@yield('meta_robots', 'index,follow')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    <title>@yield('meta_title', trim($__env->yieldContent('title', 'CampusNotes')) . ' · Academic Resource Hub')</title>
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="CampusNotes">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'CampusNotes')) . ' · Academic Resource Hub')">
    <meta property="og:description" content="@yield('og_description', 'Discover and share notes, assignments, previous questions and academic resources.')">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    @if(trim($__env->yieldContent('og_image')) !== '')<meta property="og:image" content="@yield('og_image')">@endif
    <meta name="twitter:card" content="{{ trim($__env->yieldContent('twitter_image', $__env->yieldContent('og_image'))) !== '' ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="@yield('twitter_title', trim($__env->yieldContent('title', 'CampusNotes')) . ' · Academic Resource Hub')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Discover and share notes, assignments, previous questions and academic resources.')">
    @if(trim($__env->yieldContent('twitter_image', $__env->yieldContent('og_image'))) !== '')<meta name="twitter:image" content="@yield('twitter_image', $__env->yieldContent('og_image'))">@endif
    <link rel="alternate" type="application/rss+xml" title="CampusNotes Blog" href="{{ route('blog.feed') }}">
    @stack('seo')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/campusnotes-template.css') }}">
    @stack('styles')
</head>
<body>
    @include('frontend.partials.navbar')
    <main id="main-content">@yield('content')</main>
    @include('frontend.partials.footer')
    <div class="toast" id="toast" role="status" aria-live="polite"></div>
    @if(session('success'))<div hidden data-toast-message="{{ session('success') }}"></div>@endif
    @if(session('error'))<div hidden data-toast-message="{{ session('error') }}"></div>@endif
    <script src="{{ asset('frontend/js/app.js') }}" defer></script>
    <script src="{{ asset('frontend/js/campusnotes.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
