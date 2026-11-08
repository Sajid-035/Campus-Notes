
<?php $__env->startSection('title', 'Contact'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 class="text-center mb-4">Contact Us</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Your Email">
                </div>
                <div class="mb-3">
                    <label>Message</label>
                    <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
                </div>
                <button class="btn btn-primary w-100">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/frontend/contact.blade.php ENDPATH**/ ?>