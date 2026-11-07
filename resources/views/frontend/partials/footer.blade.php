<footer class="cn-footer">
    <div class="cn-container">
        <div class="cn-footer-top">
            <div class="cn-footer-brand-block">
                <a class="cn-brand cn-brand-footer" href="{{ route('frontend.home') }}">
                    <span class="cn-brand-mark" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 4.75A2.75 2.75 0 0 1 7.75 2H20v16.5H7.75A2.75 2.75 0 0 0 5 21.25V4.75Z"/><path d="M5 5v16.25M9 6h7M9 10h7"/></svg></span>
                    <span>Campus<span class="cn-brand-light">Notes</span></span>
                </a>
                <p>A calmer space for your notes, plans and everyday learning.</p>
            </div>
            <div class="cn-footer-links">
                <div><strong>Explore</strong><a href="{{ route('frontend.features') }}">Features</a><a href="{{ route('frontend.how-it-works') }}">How it works</a><a href="{{ route('blog.index') }}">Blog</a></div>
                <div><strong>Company</strong><a href="{{ route('frontend.about') }}">About us</a><a href="{{ route('frontend.contact') }}">Contact</a></div>
                <div><strong>Your space</strong><a href="{{ route('login') }}">Login</a><a href="{{ route('register') }}">Create account</a></div>
            </div>
        </div>
        <div class="cn-footer-bottom"><span>© {{ date('Y') }} Campus Notes. All rights reserved.</span><span>Made for curious minds <span class="cn-footer-heart">♥</span></span></div>
    </div>
</footer>
