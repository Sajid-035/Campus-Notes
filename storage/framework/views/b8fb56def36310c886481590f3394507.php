
<?php $__env->startSection('title', 'Create New Role'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create New Role</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('roles.index')); ?>">Roles</a></div>
                <div class="breadcrumb-item">Create Role</div>
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

                    <?php echo Form::open(['route' => 'roles.store','method'=>'POST']); ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <?php echo Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']); ?>

                            </div>

                            <div class="form-group">
                                <strong>Permission:</strong>
                                <br/>
                                <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label>
                                        <?php echo Form::checkbox('permission[]', $value->id, false, ['class' => 'name']); ?>

                                        <?php echo e($value->name); ?>

                                    </label>
                                    <br/>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/roles/create.blade.php ENDPATH**/ ?>