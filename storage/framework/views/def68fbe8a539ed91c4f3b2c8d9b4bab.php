
<?php $__env->startSection('title', 'View Product'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>View Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('products.index')); ?>">Products</a></div>
                <div class="breadcrumb-item">View Product</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-3"><?php echo e($product->name); ?></h3>
                            <p><?php echo e($product->detail); ?></p>
                        </div>
                        <div class="card-footer text-left">
                            <a class="btn btn-primary" href="<?php echo e(route('products.index')); ?>">Back</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/products/show.blade.php ENDPATH**/ ?>