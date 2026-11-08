<header class="topbar">
    <div class="container navrow">
        <a class="brand" href="<?php echo e(route('frontend.home')); ?>"><span class="logo">C</span>CampusNotes</a>
        <nav class="navlinks" id="navlinks" aria-label="Primary navigation">
            <a href="<?php echo e(route('frontend.home')); ?>" class="<?php echo e(request()->routeIs('frontend.home') ? 'active' : ''); ?>">Home</a>
            <a href="<?php echo e(route('resources.index')); ?>" class="<?php echo e(request()->routeIs('resources.*') || request()->routeIs('departments.show') ? 'active' : ''); ?>">Browse</a>
            <a href="<?php echo e(route('departments.index')); ?>" class="<?php echo e(request()->routeIs('departments.*') ? 'active' : ''); ?>">Departments</a>
            <a href="<?php echo e(route('questions.index')); ?>" class="<?php echo e(request()->routeIs('questions.*') ? 'active' : ''); ?>">Questions</a>
            <a href="<?php echo e(route('assignments.index')); ?>" class="<?php echo e(request()->routeIs('assignments.*') ? 'active' : ''); ?>">Assignments</a>
            <a href="<?php echo e(route('frontend.community')); ?>" class="<?php echo e(request()->routeIs('frontend.community') ? 'active' : ''); ?>">Community</a>
            <a href="<?php echo e(route('frontend.contributors')); ?>" class="<?php echo e(request()->routeIs('frontend.contributors') ? 'active' : ''); ?>">Contributors</a>
            <a href="<?php echo e(route('blog.index')); ?>" class="<?php echo e(request()->routeIs('blog.*') ? 'active' : ''); ?>">Blog</a>
            <div class="nav-dropdown">
                <button type="button" aria-haspopup="true">More <span>⌄</span></button>
                <div class="nav-dropdown-menu">
                    <a href="<?php echo e(route('frontend.features')); ?>">Features</a>
                    <a href="<?php echo e(route('frontend.how-it-works')); ?>">How it works</a>
                    <a href="<?php echo e(route('frontend.faq')); ?>">FAQ</a>
                    <a href="<?php echo e(route('frontend.about')); ?>">About CampusNotes</a>
                    <a href="<?php echo e(route('frontend.contact')); ?>">Contact</a>
                </div>
            </div>
        </nav>
        <div class="nav-actions">
            <a class="iconbtn desktop" href="<?php echo e(route('resources.index')); ?>" title="Search resources" aria-label="Search resources">⌕</a>
            <button class="iconbtn desktop" type="button" onclick="toggleTheme()" title="Toggle dark mode" aria-label="Toggle dark mode">◐</button>
            <?php if(auth()->guard()->check()): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard-access')): ?>
                    <a class="btn outline desktop" href="<?php echo e(route('home')); ?>">Admin Panel</a>
                <?php else: ?>
                    <a class="btn outline desktop" href="<?php echo e(route('student.dashboard')); ?>">Dashboard</a>
                <?php endif; ?>
                <a class="btn primary desktop" href="<?php echo e(route('resources.upload')); ?>">Upload +</a>
            <?php else: ?>
                <a class="btn outline desktop" href="<?php echo e(route('login')); ?>">Login</a>
                <a class="btn primary desktop" href="<?php echo e(route('register')); ?>">Join now</a>
            <?php endif; ?>
            <button class="iconbtn mobile-menu" type="button" id="mobileMenuButton" aria-label="Open menu" aria-expanded="false">☰</button>
        </div>
    </div>
</header>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/frontend/partials/navbar.blade.php ENDPATH**/ ?>