<?php $__env->startSection('title', 'Learn smarter. Share better.'); ?>
<?php $__env->startSection('meta_description', 'Explore class notes, previous questions, assignments and academic resources shared by students on CampusNotes.'); ?>
<?php $__env->startSection('content'); ?>
<section id="home" class="container hero">
    <div>
        <span class="eyebrow">✦ YOUR CAMPUS, YOUR KNOWLEDGE</span>
        <h1>Learn smarter.<br><span style="color:#2563eb">Share better.</span></h1>
        <p>One organized space for notes, previous questions, assignments and academic resources — built by students, for students.</p>
        <form class="searchbox" action="<?php echo e(route('resources.index')); ?>" method="GET">
            <input class="field" name="q" placeholder="Search notes, subjects, courses..." aria-label="Search resources">
            <select class="field" name="department"><option value="">Department</option><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($department->slug); ?>"><?php echo e($department->code); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
            <select class="field" name="semester"><option value="">Semester</option><?php for($i=1;$i<=8;$i++): ?><option value="<?php echo e($i); ?>"><?php echo e($i); ?></option><?php endfor; ?></select>
            <button class="btn primary" type="submit">⌕ Search</button>
        </form>
        <div class="hero-actions"><a class="btn primary" href="<?php echo e(route('resources.index')); ?>">Explore resources →</a><a class="btn outline" href="<?php echo e(route('resources.upload')); ?>">＋ Share a resource</a></div>
    </div>
    <div class="hero-art" aria-label="CampusNotes resource illustration">
        <div class="art-orbit"></div><div class="art-center"><b>✎</b><strong>Campus<br>Knowledge</strong></div>
        <div class="float-card one"><span style="color:#dc2626;font-size:11px;font-weight:800">▣ PDF DOCUMENT</span><h4>Data Structures</h4><small class="muted">CSE 201 · Class Notes</small></div>
        <div class="float-card two"><b>Microeconomics</b><p class="small gold">★ 4.8 · Student resource</p></div>
        <div class="float-card three"><span style="color:#dc2626;font-size:11px;font-weight:800">▣ STUDY MATERIAL</span><h4>Previous Questions</h4><small class="muted">Exam preparation</small></div>
    </div>
</section>
<div class="container stats">
    <div class="stat"><div class="stat-icon">♙</div><div><strong><?php echo e(number_format($stats['students'])); ?></strong><span>Registered Members</span></div></div>
    <div class="stat"><div class="stat-icon">▤</div><div><strong><?php echo e(number_format($stats['resources'])); ?></strong><span>Approved Resources</span></div></div>
    <div class="stat"><div class="stat-icon">⇩</div><div><strong><?php echo e(number_format($stats['downloads'])); ?></strong><span>Total Downloads</span></div></div>
    <div class="stat"><div class="stat-icon">⌂</div><div><strong><?php echo e(number_format($stats['departments'])); ?></strong><span>Departments</span></div></div>
</div>
<section class="container section" id="departments">
    <div class="section-head"><div><h2>Explore by department</h2><p>Find resources tailored to your field of study.</p></div><a href="<?php echo e(route('departments.index')); ?>" class="btn outline">All departments →</a></div>
    <div class="dept-grid">
        <?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('departments.show', $department)); ?>" class="card dept"><span class="dept-code"><?php echo e($department->code); ?></span><h3><?php echo e($department->name); ?></h3><p><?php echo e(number_format($department->resources_count)); ?> resources →</p></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="card empty-state"><h3>Departments are being prepared</h3><p class="muted">Please check back soon.</p></div>
        <?php endif; ?>
    </div>
</section>
<section class="container section">
    <div class="section-head"><div><h2>Latest resources</h2><p>Fresh notes and study materials shared by your campus community.</p></div><a href="<?php echo e(route('resources.index')); ?>" class="btn outline">Browse all →</a></div>
    <div class="resource-grid">
        <?php $__empty_1 = true; $__currentLoopData = $latestResources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php echo $__env->make('frontend.partials.resource-card', ['resource' => $resource], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="card empty-state"><h3>No resources published yet</h3><p class="muted">Be the first to share a helpful study resource.</p><a class="btn primary" href="<?php echo e(route('resources.upload')); ?>">Upload a resource</a></div><?php endif; ?>
    </div>
</section>
<div class="container"><div class="cta"><h2>Have notes that can help someone?</h2><p>Share your knowledge with students. Upload your notes, help your community and make learning better for everyone.</p><a href="<?php echo e(route('resources.upload')); ?>" class="btn" style="background:white;color:#142b55">＋ Upload a resource</a> <a href="<?php echo e(route('frontend.community')); ?>" class="btn outline" style="background:transparent;color:white;border-color:#ffffff66">Join the community</a></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/pages/home.blade.php ENDPATH**/ ?>