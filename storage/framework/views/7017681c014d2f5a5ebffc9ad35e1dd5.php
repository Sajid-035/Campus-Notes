<?php $__env->startSection('content'); ?>
<div class="container student-area">
    <div class="student-shell">
        <?php echo $__env->make('frontend.student.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="student-content">
            <?php echo $__env->yieldContent('panel-content'); ?>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/frontend/student/layouts/panel.blade.php ENDPATH**/ ?>