
<?php $__env->startSection('title', 'All Products'); ?>
<?php $__env->startSection('content'); ?>

<div class="container py-5">
    <h2 class="mb-4 text-center">All Products</h2>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="<?php echo e(asset('uploads/products/'.$product->image)); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>">
                    <div class="card-body text-center">
                        <h6 class="card-title"><?php echo e($product->name); ?></h6>
                        <p class="text-muted">$<?php echo e(number_format($product->price, 2)); ?></p>
                        <a href="<?php echo e(route('cart.add', $product->id)); ?>" class="btn btn-sm btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <p class="text-center">No products found.</p>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="d-flex justify-content-center mt-4">
        <?php echo e($products->links() ?? ''); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/frontend/products.blade.php ENDPATH**/ ?>