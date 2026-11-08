<?php $__env->startSection('title', 'Create a student account'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <aside class="auth-visual">
        <a class="auth-brand" href="<?php echo e(route('frontend.home')); ?>">
            <span class="auth-logo">C</span>
            <span>CampusNotes</span>
        </a>

        <div class="auth-visual-copy">
            <span class="auth-chip">✦ Join the campus community</span>
            <h1>Make your learning resources go further.</h1>
            <p>Create your student profile to discover useful academic materials, share what you know and build your learning journey with CampusNotes.</p>
            <div class="auth-feature-list">
                <div class="auth-feature"><span class="auth-feature-icon">＋</span><span><strong>Share your knowledge</strong><small>Upload notes, questions and assignments</small></span></div>
                <div class="auth-feature"><span class="auth-feature-icon">▣</span><span><strong>Your own academic space</strong><small>Track uploads, downloads and bookmarks</small></span></div>
                <div class="auth-feature"><span class="auth-feature-icon">✓</span><span><strong>Student account verification</strong><small>Get full access after your application is approved</small></span></div>
            </div>
        </div>

        <div class="auth-visual-foot">© <?php echo e(date('Y')); ?> CampusNotes · Built by students, for students.</div>
    </aside>

    <main class="auth-main">
        <a class="auth-top-link" href="<?php echo e(route('frontend.home')); ?>">← Back to website</a>
        <section class="auth-form-wrap auth-form-wide" aria-labelledby="register-heading">
            <span class="auth-kicker">Create your account</span>
            <h1 class="auth-heading" id="register-heading">Join CampusNotes</h1>
            <p class="auth-subtitle">Enter your student details below. Your application will be reviewed before full dashboard access is enabled.</p>

            <?php if($errors->any()): ?>
                <div class="auth-error" role="alert">
                    <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <div class="auth-grid">
                    <div class="auth-field">
                        <label for="name">Full name *</label>
                        <input class="auth-control" id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus autocomplete="name" maxlength="255" placeholder="Your full name">
                    </div>
                    <div class="auth-field">
                        <label for="email">Email address *</label>
                        <input class="auth-control" id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" placeholder="you@university.edu">
                    </div>
                    <div class="auth-field full">
                        <label for="institution_name">University / Institution *</label>
                        <input class="auth-control" id="institution_name" type="text" name="institution_name" value="<?php echo e(old('institution_name')); ?>" required maxlength="190" placeholder="University or institution name">
                    </div>
                    <div class="auth-field">
                        <label for="academic_department_id">Department *</label>
                        <select class="auth-control" id="academic_department_id" name="academic_department_id" required>
                            <option value="">Choose your department</option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($department->id); ?>" <?php if(old('academic_department_id') == $department->id): echo 'selected'; endif; ?>><?php echo e($department->name); ?> (<?php echo e($department->code); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="auth-field">
                        <label for="student_batch">Batch *</label>
                        <input class="auth-control" id="student_batch" type="text" name="student_batch" value="<?php echo e(old('student_batch')); ?>" required maxlength="30" placeholder="e.g. 2025–2026">
                    </div>
                    <div class="auth-field full">
                        <label for="semester">Current semester *</label>
                        <select class="auth-control" id="semester" name="semester" required>
                            <option value="">Choose your current semester</option>
                            <?php for($i = 1; $i <= 20; $i++): ?>
                                <option value="<?php echo e($i); ?>" <?php if(old('semester') == $i): echo 'selected'; endif; ?>><?php echo e($i); ?><?php echo e($i === 1 ? 'st' : ($i === 2 ? 'nd' : ($i === 3 ? 'rd' : 'th'))); ?> Semester</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="auth-field">
                        <label for="password">Password *</label>
                        <input class="auth-control" id="password" type="password" name="password" required autocomplete="new-password" minlength="8" placeholder="At least 8 characters">
                    </div>
                    <div class="auth-field">
                        <label for="password-confirm">Confirm password *</label>
                        <input class="auth-control" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" minlength="8" placeholder="Re-enter your password">
                    </div>
                </div>

                <div class="auth-note"><span>ⓘ</span><span><strong>What happens next?</strong> Your application starts with <strong>Pending</strong> status. After submitting, you can track your application number and verification status on the CampusNotes Application Status page.</span></div>
                <button class="auth-submit" type="submit">Submit student application&nbsp; →</button>
            </form>

            <p class="auth-switch">Already have an account? <a href="<?php echo e(route('login')); ?>">Sign in</a></p>
            <div class="auth-legal">By creating an account, you confirm that the student information submitted is accurate.</div>
        </section>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.layouts.campus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/auth/register.blade.php ENDPATH**/ ?>