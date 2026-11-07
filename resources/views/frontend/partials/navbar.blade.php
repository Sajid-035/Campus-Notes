<header class="cn-header">
    <div class="cn-container cn-nav-wrap">
        <a class="cn-brand" href="{{ route('frontend.home') }}" aria-label="Campus Notes home">
            <span class="cn-brand-mark" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 4.75A2.75 2.75 0 0 1 7.75 2H20v16.5H7.75A2.75 2.75 0 0 0 5 21.25V4.75Z"/><path d="M5 5v16.25M9 6h7M9 10h7"/></svg></span>
            <span>Campus<span class="cn-brand-light">Notes</span></span>
        </a>

        <button class="cn-menu-toggle" type="button" aria-label="Open navigation menu" aria-expanded="false" aria-controls="cn-primary-nav">
            <span></span><span></span><span></span>
        </button>

        <nav class="cn-nav" id="cn-primary-nav" aria-label="Main navigation">
            <a href="{{ route('frontend.home') }}" class="{{ request()->routeIs('frontend.home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('frontend.features') }}" class="{{ request()->routeIs('frontend.features') ? 'is-active' : '' }}">Features</a>
            <a href="{{ route('frontend.how-it-works') }}" class="{{ request()->routeIs('frontend.how-it-works') ? 'is-active' : '' }}">How it works</a>
            <a href="{{ route('frontend.about') }}" class="{{ request()->routeIs('frontend.about') ? 'is-active' : '' }}">About</a>
            <a href="{{ route('frontend.contact') }}" class="{{ request()->routeIs('frontend.contact') ? 'is-active' : '' }}">Contact</a>
            <div class="cn-nav-mobile-actions">
                @auth
                    <a class="cn-button cn-button-primary" href="{{ route('dashboard') }}">Open workspace <span aria-hidden="true">↗</span></a>
                @else
                    <a class="cn-login-link" href="{{ route('login') }}">Login</a>
                    <a class="cn-button cn-button-primary" href="{{ route('register') }}">Get started <span aria-hidden="true">↗</span></a>
                @endauth
            </div>
        </nav>

        <div class="cn-nav-actions">
            @auth
                <a class="cn-login-link" href="{{ route('dashboard') }}">Workspace</a>
                <a class="cn-button cn-button-primary" href="{{ route('dashboard') }}">Open app <span aria-hidden="true">↗</span></a>
            @else
                <a class="cn-login-link" href="{{ route('login') }}">Login</a>
                <a class="cn-button cn-button-primary" href="{{ route('register') }}">Get started <span aria-hidden="true">↗</span></a>
            @endauth
        </div>
    </div>
</header>
