<?php $__env->startSection('title', 'Sign in'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <aside class="auth-visual">
        <a class="auth-brand" href="<?php echo e(route('frontend.home')); ?>">
            <span class="auth-logo">C</span>
            <span>CampusNotes</span>
        </a>

        <div class="auth-visual-copy">
            <span class="auth-chip">✦ Your campus, your knowledge</span>
            <h1>Welcome back to your academic space.</h1>
            <p>Pick up where you left off. Discover trusted study materials, keep your resources organised and learn together with your campus community.</p>
            <div class="auth-feature-list">
                <div class="auth-feature"><span class="auth-feature-icon">▤</span><span><strong>Your resources, in one place</strong><small>Notes, questions, assignments and downloads</small></span></div>
                <div class="auth-feature"><span class="auth-feature-icon">☆</span><span><strong>Save what matters</strong><small>Bookmarks, reviews and learning activity</small></span></div>
                <div class="auth-feature"><span class="auth-feature-icon">✓</span><span><strong>A verified student community</strong><small>Share knowledge with fellow students</small></span></div>
            </div>
        </div>

        <div class="auth-visual-foot">© <?php echo e(date('Y')); ?> CampusNotes · Built by students, for students.</div>
    </aside>

    <main class="auth-main">
        <a class="auth-top-link" href="<?php echo e(route('frontend.home')); ?>">← Back to website</a>
        <section class="auth-form-wrap" aria-labelledby="login-heading">
            <span class="auth-kicker">Welcome back</span>
            <h1 class="auth-heading" id="login-heading">Sign in to CampusNotes</h1>
            <p class="auth-subtitle">Enter your account details to continue to your resources and student dashboard.</p>

            <?php if($errors->any()): ?>
                <div class="auth-error" role="alert">
                    <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                </div>
            <?php endif; ?>

            <?php if(session('status')): ?>
                <div class="auth-success" role="status"><?php echo e(session('status')); ?></div>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="auth-field">
                    <label for="email">Email address</label>
                    <input class="auth-control" id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="email" placeholder="you@university.edu">
                </div>
                <div class="auth-field">
                    <label for="password">Password</label>
                    <input class="auth-control" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                </div>

                <div class="auth-row">
                    <label class="auth-check"><input type="checkbox" name="remember" value="1" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember me</label>
                    <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>">Forgot password?</a>
                    <?php endif; ?>
                </div>

                <button class="auth-submit" type="submit">Sign in to your account&nbsp; →</button>
            </form>

            <p class="auth-switch">New to CampusNotes? <a href="<?php echo e(route('register')); ?>">Create a student account</a></p>
            <div class="auth-legal">Your account information is protected and used to provide your CampusNotes student services.</div>
        </section>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.layouts.campus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/auth/login.blade.php ENDPATH**/ ?>