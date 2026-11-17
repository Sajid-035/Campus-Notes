
<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="text-center my-5">
        <h1>Welcome to <span class="text-primary fw-bold">E-Shop</span></h1>
        <p class="lead">Find your favorite products at the best prices!</p>
        <a href="<?php echo e(url('/product')); ?>" class="btn btn-primary mt-2">Shop Now</a>
    </div>

    <h3 class="mb-4">Featured Products</h3>
    <div class="row">
        <?php $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <img src="<?php echo e(asset('uploads/products/'.$product->image)); ?>" class="card-img-top" alt="">
                <div class="card-body text-center">
                    <h6><?php echo e($product->name); ?></h6>
                    <p class="text-muted">$<?php echo e($product->price); ?></p>
                    <a href="#" class="btn btn-sm btn-outline-primary">Add to Cart</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/frontend/home.blade.php ENDPATH**/ ?>