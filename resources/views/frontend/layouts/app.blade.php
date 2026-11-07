<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f7f8ff">
    <meta name="description" content="Campus Notes helps you keep your learning, ideas and everyday study tasks in one clear space.">
    <title>@yield('title', 'Study smarter') · Campus Notes</title>
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
