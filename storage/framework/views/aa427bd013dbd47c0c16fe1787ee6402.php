
<?php $__env->startSection('title', 'Edit Role'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Role</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Roles</a></div>
                <div class="breadcrumb-item"><a href="<?php echo e(route('roles.index')); ?>">Role List</a></div>
                <div class="breadcrumb-item">Edit Role</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Update Role Information</h4>
                        </div>

                        <div class="card-body">
                            
                            <?php if(count($errors) > 0): ?>
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul class="mb-0">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            
                            <?php echo Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]); ?>


                            <div class="form-group">
                                <label><b>Role Name</b></label>
                                <?php echo Form::text('name', old('name', $role->name), ['placeholder' => 'Enter Role Name','class' => 'form-control']); ?>

                            </div>

                            <div class="form-group mt-4">
                                <label><b>Assign Permissions</b></label>
                                <div class="row">
                                    <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6 col-lg-4 mb-2">
                                            <div class="form-check">
                                                <?php echo Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), ['class' => 'form-check-input', 'id' => 'perm_'.$value->id]); ?>

                                                <label class="form-check-label" for="perm_<?php echo e($value->id); ?>">
                                                    <?php echo e(ucfirst($value->name)); ?>

                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <div class="text-left mt-4">
                                <button type="submit" class="btn btn-primary">Update Role</button>
                                <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-secondary">Cancel</a>
                            </div>

                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/roles/edit.blade.php ENDPATH**/ ?>