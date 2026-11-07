<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f7f8ff">
    <meta name="description" content="@yield('meta_description', 'Campus Notes helps you keep your learning, ideas and everyday study tasks in one clear space.')">
    <meta name="robots" content="@yield('meta_robots', 'index,follow')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    <title>@yield('meta_title', trim($__env->yieldContent('title', 'Study smarter')) . ' · Campus Notes')</title>
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Campus Notes">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Study smarter')) . ' · Campus Notes')">
    <meta property="og:description" content="@yield('og_description', 'Keep your learning, ideas and everyday study tasks in one clear space.')">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    @if(trim($__env->yieldContent('og_image')) !== '')<meta property="og:image" content="@yield('og_image')">@endif
    <meta name="twitter:card" content="{{ trim($__env->yieldContent('twitter_image', $__env->yieldContent('og_image'))) !== '' ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="@yield('twitter_title', trim($__env->yieldContent('title', 'Study smarter')) . ' · Campus Notes')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Keep your learning, ideas and everyday study tasks in one clear space.')">
    <link rel="alternate" type="application/rss+xml" title="Campus Notes Blog" href="{{ route('blog.feed') }}">
    @if(trim($__env->yieldContent('twitter_image', $__env->yieldContent('og_image'))) !== '')<meta name="twitter:image" content="@yield('twitter_image', $__env->yieldContent('og_image'))">@endif
    @stack('seo')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
    @stack('styles')
</head>
<body>
    @include('frontend.partials.navbar')

    <main id="main-content">
        @yield('content')
    </main>

    @include('frontend.partials.footer')
    <script src="{{ asset('frontend/js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
