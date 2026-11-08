<header class="topbar">
    <div class="container navrow">
        <a class="brand" href="{{ route('frontend.home') }}"><span class="logo">C</span>CampusNotes</a>
        <nav class="navlinks" id="navlinks" aria-label="Primary navigation">
            <a href="{{ route('frontend.home') }}" class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('resources.index') }}" class="{{ request()->routeIs('resources.*') || request()->routeIs('departments.show') ? 'active' : '' }}">Browse</a>
            <a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'active' : '' }}">Departments</a>
            <a href="{{ route('questions.index') }}" class="{{ request()->routeIs('questions.*') ? 'active' : '' }}">Questions</a>
            <a href="{{ route('assignments.index') }}" class="{{ request()->routeIs('assignments.*') ? 'active' : '' }}">Assignments</a>
            <a href="{{ route('frontend.community') }}" class="{{ request()->routeIs('frontend.community') ? 'active' : '' }}">Community</a>
            <a href="{{ route('frontend.contributors') }}" class="{{ request()->routeIs('frontend.contributors') ? 'active' : '' }}">Contributors</a>
            <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
            <div class="nav-dropdown">
                <button type="button" aria-haspopup="true">More <span>⌄</span></button>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('frontend.features') }}">Features</a>
                    <a href="{{ route('frontend.how-it-works') }}">How it works</a>
                    <a href="{{ route('frontend.faq') }}">FAQ</a>
                    <a href="{{ route('frontend.about') }}">About CampusNotes</a>
                    <a href="{{ route('frontend.contact') }}">Contact</a>
                </div>
            </div>
        </nav>
        <div class="nav-actions">
            <a class="iconbtn desktop" href="{{ route('resources.index') }}" title="Search resources" aria-label="Search resources">⌕</a>
            <button class="iconbtn desktop" type="button" onclick="toggleTheme()" title="Toggle dark mode" aria-label="Toggle dark mode">◐</button>
            @auth
                @can('dashboard-access')
                    <a class="btn outline desktop" href="{{ route('home') }}">Admin Panel</a>
                @else
                    <a class="btn outline desktop" href="{{ route('student.dashboard') }}">Dashboard</a>
                @endcan
                <a class="btn primary desktop" href="{{ route('resources.upload') }}">Upload +</a>
            @else
                <a class="btn outline desktop" href="{{ route('login') }}">Login</a>
                <a class="btn primary desktop" href="{{ route('register') }}">Join now</a>
            @endauth
            <button class="iconbtn mobile-menu" type="button" id="mobileMenuButton" aria-label="Open menu" aria-expanded="false">☰</button>
        </div>
    </div>
</header>
