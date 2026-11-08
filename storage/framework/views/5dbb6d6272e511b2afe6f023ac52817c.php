<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $__env->yieldContent('title', 'Market - Auto Parts'); ?></title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Custom Styles -->
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/header.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/footer.css')); ?>">

  <!-- Page-specific styles -->
  <?php echo $__env->yieldContent('style'); ?>
</head>
<body>

  
  <?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <main>
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  
  <?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH G:\laragon\www\demo\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>