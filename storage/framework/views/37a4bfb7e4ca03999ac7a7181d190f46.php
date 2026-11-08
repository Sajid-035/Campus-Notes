<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="theme-color" content="#142b55">
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'CampusNotes is a student-powered hub for class notes, previous questions, assignments and academic resources.'); ?>">
    <meta name="robots" content="<?php echo $__env->yieldContent('meta_robots', 'index,follow'); ?>">
    <link rel="canonical" href="<?php echo $__env->yieldContent('canonical_url', url()->current()); ?>">
    <title><?php echo $__env->yieldContent('meta_title', trim($__env->yieldContent('title', 'CampusNotes')) . ' · Academic Resource Hub'); ?></title>
    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
    <meta property="og:site_name" content="CampusNotes">
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', trim($__env->yieldContent('title', 'CampusNotes')) . ' · Academic Resource Hub'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', 'Discover and share notes, assignments, previous questions and academic resources.'); ?>">
    <meta property="og:url" content="<?php echo $__env->yieldContent('canonical_url', url()->current()); ?>">
    <?php if(trim($__env->yieldContent('og_image')) !== ''): ?><meta property="og:image" content="<?php echo $__env->yieldContent('og_image'); ?>"><?php endif; ?>
    <meta name="twitter:card" content="<?php echo e(trim($__env->yieldContent('twitter_image', $__env->yieldContent('og_image'))) !== '' ? 'summary_large_image' : 'summary'); ?>">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title', trim($__env->yieldContent('title', 'CampusNotes')) . ' · Academic Resource Hub'); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description', 'Discover and share notes, assignments, previous questions and academic resources.'); ?>">
    <?php if(trim($__env->yieldContent('twitter_image', $__env->yieldContent('og_image'))) !== ''): ?><meta name="twitter:image" content="<?php echo $__env->yieldContent('twitter_image', $__env->yieldContent('og_image')); ?>"><?php endif; ?>
    <link rel="alternate" type="application/rss+xml" title="CampusNotes Blog" href="<?php echo e(route('blog.feed')); ?>">
    <?php echo $__env->yieldPushContent('seo'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/campusnotes-template.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <?php echo $__env->make('frontend.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main id="main-content"><?php echo $__env->yieldContent('content'); ?></main>
    <?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="toast" id="toast" role="status" aria-live="polite"></div>
    <?php if(session('success')): ?><div hidden data-toast-message="<?php echo e(session('success')); ?>"></div><?php endif; ?>
    <?php if(session('error')): ?><div hidden data-toast-message="<?php echo e(session('error')); ?>"></div><?php endif; ?>
    <script src="<?php echo e(asset('frontend/js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('frontend/js/campusnotes.js')); ?>" defer></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>