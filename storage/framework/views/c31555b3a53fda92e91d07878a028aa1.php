
<?php $__env->startSection('title', 'View User'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>View User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('users.index')); ?>">Users</a></div>
                <div class="breadcrumb-item">View User</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <strong>Name:</strong>
                                <p><?php echo e($user->name); ?></p>
                            </div>

                            <div class="form-group mb-3">
                                <strong>Email:</strong>
                                <p><?php echo e($user->email); ?></p>
                            </div>

                            <div class="form-group">
                                <strong>Roles:</strong>
                                <br/>
                                <?php if(!empty($user->getRoleNames())): ?>
                                    <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-success text-light"><?php echo e($role); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <p>No roles assigned</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-footer text-left">
                            <a class="btn btn-primary" href="<?php echo e(route('users.index')); ?>">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/users/show.blade.php ENDPATH**/ ?>