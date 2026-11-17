<?php $__env->startSection('title', 'Academic departments'); ?>
<?php $__env->startSection('content'); ?>
<div class="container"><div class="subhead"><div class="crumb"><a href="<?php echo e(route('frontend.home')); ?>">Home</a> / Departments</div><h1>Explore departments</h1><p class="muted">Choose your department to find relevant notes, questions, assignments and study material.</p></div>
    <div class="department-grid">
        <?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a class="card department-card" href="<?php echo e(route('departments.show', $department)); ?>"><span class="dept-code"><?php echo e($department->code); ?></span><div><h3><?php echo e($department->name); ?></h3><p><?php echo e($department->description); ?></p><p style="margin-top:10px;color:var(--blue);font-weight:700"><?php echo e(number_format($department->resources_count)); ?> resources →</p></div></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="card empty-state"><h3>No departments available</h3></div><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/pages/departments.blade.php ENDPATH**/ ?>