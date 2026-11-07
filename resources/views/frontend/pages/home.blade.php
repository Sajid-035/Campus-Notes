@extends('frontend.layouts.app')
@section('title', 'A clearer way to study')
@section('content')
<section class="cn-hero">
    <div class="cn-container cn-hero-grid">
        <div class="cn-hero-copy">
            <div class="cn-eyebrow"><span class="cn-eyebrow-dot"></span> YOUR SPACE TO LEARN AND GROW</div>
            <h1>Make space for<br><span>better thinking.</span></h1>
            <p class="cn-hero-lead">Bring your notes, study plans and little everyday ideas together. Campus Notes gives your learning a clearer place to live.</p>
            <div class="cn-hero-actions">
                <a class="cn-button cn-button-primary cn-button-large" href="{{ route('register') }}">Create your free account <span aria-hidden="true">→</span></a>
                <a class="cn-text-link" href="{{ route('frontend.how-it-works') }}">See how it works <span aria-hidden="true">↗</span></a>
            </div>
            <div class="cn-hero-proof"><div class="cn-proof-avatars"><span>A</span><span>S</span><span>M</span><span>+</span></div><div><strong>A fresh start for your study routine</strong><small>Simple, focused and made for students.</small></div></div>
        </div>
        <div class="cn-hero-art" aria-label="Illustration of a student notes workspace" role="img">
            <div class="cn-art-orbit cn-orbit-one"></div><div class="cn-art-orbit cn-orbit-two"></div>
            <div class="cn-art-spark cn-spark-one">✦</div><div class="cn-art-spark cn-spark-two">✧</div>
            <div class="cn-workspace-card">
                <div class="cn-workspace-top"><div class="cn-window-dots"><i></i><i></i><i></i></div><span>MY WORKSPACE</span><span class="cn-avatar">AR</span></div>
                <div class="cn-workspace-title"><div><small>MONDAY, 9:41 AM</small><h3>Your learning space</h3></div><span class="cn-wave">✳</span></div>
                <div class="cn-workspace-search"><span>⌕</span> Search your notes and ideas <kbd>⌘ K</kbd></div>
                <div class="cn-workspace-row"><span class="cn-row-icon cn-lilac">▤</span><div><strong>Biology — Cell structure</strong><small>Last edited 10 minutes ago</small></div><span class="cn-row-more">•••</span></div>
                <div class="cn-workspace-row"><span class="cn-row-icon cn-mint">✎</span><div><strong>Ideas for the next project</strong><small>Updated yesterday</small></div><span class="cn-row-more">•••</span></div>
                <div class="cn-workspace-bottom"><div><span class="cn-mini-check">✓</span><span><strong>Study plan</strong><small>3 tasks on your list</small></span></div><div class="cn-progress"><span></span></div></div>
            </div>
            <div class="cn-floating-note"><span class="cn-note-icon">✧</span><div><strong>Small steps add up.</strong><small>Keep showing up for your goals.</small></div></div>
            <div class="cn-floating-badge"><span>✦</span> Stay curious</div>
        </div>
    </div>
    <div class="cn-hero-bottom-glow"></div>
</section>

<section class="cn-section cn-benefit-strip">
    <div class="cn-container cn-benefit-grid"><div><span class="cn-benefit-symbol">⌘</span><span><strong>One clear workspace</strong><small>Keep learning essentials together</small></span></div><div><span class="cn-benefit-symbol">✎</span><span><strong>Capture your ideas</strong><small>Give every thought a home</small></span></div><div><span class="cn-benefit-symbol">✓</span><span><strong>Stay on track</strong><small>Make progress feel manageable</small></span></div></div>
</section>

<section class="cn-section cn-section-spacious">
    <div class="cn-container">
        <div class="cn-section-heading"><div class="cn-eyebrow">A BETTER STUDY FLOW</div><h2>Less scattered. <span>More focused.</span></h2><p>Studying gets easier when everything has a place. Start with a simple workspace that helps you stay organized without getting in your way.</p></div>
        <div class="cn-feature-grid cn-home-features">
            <article class="cn-feature-card"><div class="cn-feature-icon cn-icon-purple">✎</div><h3>Capture every idea</h3><p>Keep class notes, useful thoughts and quick reminders together in one place.</p><a href="{{ route('frontend.features') }}">Explore features <span>→</span></a></article>
            <article class="cn-feature-card"><div class="cn-feature-icon cn-icon-blue">▦</div><h3>Find your rhythm</h3><p>Build a study routine around your subjects, priorities and available time.</p><a href="{{ route('frontend.how-it-works') }}">See the workflow <span>→</span></a></article>
            <article class="cn-feature-card"><div class="cn-feature-icon cn-icon-green">✓</div><h3>Move forward daily</h3><p>Break bigger goals into smaller tasks and celebrate the progress you make.</p><a href="{{ route('frontend.features') }}">Discover more <span>→</span></a></article>
        </div>
    </div>
</section>

<section class="cn-cta-section"><div class="cn-container"><div class="cn-cta-card"><div><div class="cn-eyebrow cn-eyebrow-light">YOUR NEXT CHAPTER STARTS HERE</div><h2>Ready to make learning<br>feel a little lighter?</h2><p>Create your Campus Notes account and make your ideas easier to organize.</p></div><a href="{{ route('register') }}" class="cn-button cn-button-white">Get started for free <span>→</span></a><span class="cn-cta-decoration cn-cta-decoration-one"></span><span class="cn-cta-decoration cn-cta-decoration-two"></span></div></div></section>
@endsection
