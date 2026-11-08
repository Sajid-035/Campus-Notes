
<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('users.index')); ?>">Users</a></div>
                <div class="breadcrumb-item">Edit User</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Update User Information</h4>
                        </div>

                        <div class="card-body">
                            
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul class="mb-0">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            
                            <?php echo Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]); ?>


                            <div class="form-group">
                                <label><b>Name</b></label>
                                <?php echo Form::text('name', old('name', $user->name), ['placeholder' => 'Enter Name','class' => 'form-control']); ?>

                            </div>

                            <div class="form-group mt-3">
                                <label><b>Email</b></label>
                                <?php echo Form::text('email', old('email', $user->email), ['placeholder' => 'Enter Email','class' => 'form-control']); ?>

                            </div>

                            <div class="form-group mt-3">
                                <label><b>Password</b></label>
                                <?php echo Form::password('password', ['placeholder' => 'Password','class' => 'form-control']); ?>

                                <small class="text-muted">Leave blank if you do not want to change the password</small>
                            </div>

                            <div class="form-group mt-3">
                                <label><b>Confirm Password</b></label>
                                <?php echo Form::password('confirm-password', ['placeholder' => 'Confirm Password','class' => 'form-control']); ?>

                            </div>

                            <div class="form-group mt-3">
                                <label><b>Role</b></label>
                                <?php echo Form::select('roles[]', $roles, old('roles', $userRole), ['class' => 'form-control', 'multiple']); ?>

                            </div>

                            <div class="text-left mt-4">
                                <button type="submit" class="btn btn-primary">Update User</button>
                                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Cancel</a>
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

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/users/edit.blade.php ENDPATH**/ ?>