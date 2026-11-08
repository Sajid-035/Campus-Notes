<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <a class="brand" href="{{ route('frontend.home') }}" style="color:white"><span class="logo" style="background:#2563eb">C</span>CampusNotes</a>
                <p>One organized space for notes, questions and academic resources. Built by students, for students.</p>
            </div>
            <div><h4>Explore</h4><a href="{{ route('resources.index') }}">Browse resources</a><a href="{{ route('departments.index') }}">Departments</a><a href="{{ route('questions.index') }}">Previous questions</a><a href="{{ route('assignments.index') }}">Assignments</a></div>
            <div><h4>Community</h4><a href="{{ route('frontend.community') }}">Community</a><a href="{{ route('frontend.contributors') }}">Contributors</a><a href="{{ route('blog.index') }}">Study blog</a><a href="{{ route('frontend.faq') }}">FAQ</a></div>
            <div><h4>Support</h4><a href="{{ route('frontend.about') }}">About us</a><a href="{{ route('frontend.contact') }}">Contact us</a><a href="{{ route('login') }}">Sign in</a><a href="{{ route('register') }}">Create account</a></div>
        </div>
        <div class="copyright">© {{ date('Y') }} CampusNotes. All rights reserved. · <a href="{{ route('blog.sitemap') }}" style="display:inline">Sitemap</a></div>
    </div>
</footer>
