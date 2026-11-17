<?php $__env->startSection('title', 'Profile Settings'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header"><h1>Profile Settings</h1></div>

        <div class="card card-primary">
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if($errors->any()): ?><div class="alert alert-danger">Please check the form errors below.</div><?php endif; ?>

                <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo e($user->email); ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" name="avatar" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                        <small class="form-text text-muted">JPG, PNG or WebP, maximum 5 MB.</small>
                        <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php if($user->avatar_url): ?>
                            <img src="<?php echo e($user->avatar_url); ?>" width="120" height="120" style="object-fit:cover;border-radius:50%" class="mt-2" alt="Current profile photo">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-success">Update Profile</button>
                    <a href="<?php echo e(route('profile.show')); ?>" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/backend/profile/index.blade.php ENDPATH**/ ?>