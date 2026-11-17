
<?php $__env->startSection('title', 'Create New User'); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create New User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="<?php echo e(route('users.index')); ?>">Users</a></div>
                    <div class="breadcrumb-item">Create User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-10">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php echo Form::open(['route' => 'users.store', 'method' => 'POST']); ?>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><b>Name*</b></label>
                                        <?php echo Form::text('name', old('name'), ['placeholder' => 'Name', 'class' => 'form-control']); ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><b>Email*</b></label>
                                        <?php echo Form::text('email', old('email'), ['placeholder' => 'Email', 'class' => 'form-control']); ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><b>Password*</b></label>
                                        <?php echo Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']); ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><b>Confirm Password*</b></label>
                                        <?php echo Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']); ?>

                                    </div>
                                </div>
                              <div class="form-group">
    <label><b>Roles*</b></label>
    <div class="row">
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $roleName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="<?php echo e($id); ?>" 
                        <?php echo e((is_array(old('roles')) && in_array($id, old('roles'))) ? 'checked' : ''); ?>>
                    <label class="form-check-label"><?php echo e($roleName); ?></label>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/users/create.blade.php ENDPATH**/ ?>