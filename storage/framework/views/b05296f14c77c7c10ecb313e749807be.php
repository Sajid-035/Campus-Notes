
<?php $__env->startSection('title', 'View Role'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>View Role</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('roles.index')); ?>">Roles</a></div>
                <div class="breadcrumb-item">View Role</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <strong>Role Name:</strong>
                                <p><?php echo e($role->name); ?></p>
                            </div>

                            <div class="form-group">
                                <strong>Permissions:</strong>
                                <br/>
                                <?php if(!empty($rolePermissions)): ?>
                                    <?php $__currentLoopData = $rolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-success text-light"><?php echo e($permission->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <p>No permissions assigned</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-footer text-left">
                            <a class="btn btn-primary" href="<?php echo e(route('roles.index')); ?>">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/roles/show.blade.php ENDPATH**/ ?>