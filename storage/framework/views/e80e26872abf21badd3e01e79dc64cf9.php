
<?php $__env->startSection('title', 'My Cart'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 class="mb-4 text-center">Shopping Cart</h2>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $cartItems ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($item->product->name); ?></td>
                <td>$<?php echo e($item->product->price); ?></td>
                <td><?php echo e($item->quantity); ?></td>
                <td>$<?php echo e($item->product->price * $item->quantity); ?></td>
                <td><a href="<?php echo e(url('/cart/remove/'.$item->id)); ?>" class="btn btn-sm btn-danger">Remove</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" class="text-center">Your cart is empty.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="text-end">
        <a href="<?php echo e(url('/checkout')); ?>" class="btn btn-success">Proceed to Checkout</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/frontend/cart.blade.php ENDPATH**/ ?>