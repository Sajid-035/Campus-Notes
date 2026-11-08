
<?php $__env->startSection('title', 'Edit Product'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('products.index')); ?>">Products</a></div>
                <div class="breadcrumb-item">Edit Product</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10">
                    <div class="card card-primary">
                        <div class="card-body">

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

                            <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <div class="form-group">
                                    <label><b>Name*</b></label>
                                    <input type="text" name="name" value="<?php echo e($product->name); ?>" class="form-control" placeholder="Enter Product Name">
                                </div>

                                <div class="form-group">
                                    <label><b>Detail*</b></label>
                                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Enter Product Detail"><?php echo e($product->detail); ?></textarea>
                                </div>

                                <div class="text-left mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a class="btn btn-secondary" href="<?php echo e(route('products.index')); ?>">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/products/edit.blade.php ENDPATH**/ ?>