
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
                        <input type="file" name="avatar" class="form-control-file">
                        <?php if($user->avatar): ?>
                            <img src="<?php echo e(asset('uploads/avatars/'.$user->avatar)); ?>" width="120" class="mt-2">
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

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\portal\resources\views/backend/profile/index.blade.php ENDPATH**/ ?>