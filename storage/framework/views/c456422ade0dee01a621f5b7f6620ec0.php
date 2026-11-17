

<?php $__env->startSection('title', 'Carousel'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    
    <link rel="stylesheet" href="<?php echo e(asset('library/chocolat/dist/css/chocolat.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blog View</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Blogs</a></div>
                    <div class="breadcrumb-item"><a href="#">Blog List</a></div>
                    <div class="breadcrumb-item">View</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-9 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-right">
                                <h6><?php echo e(date('d F, Y', strtotime($blogs->date))); ?></h6>
                            </div>
                            <div class="">
                                <h3>
                                    <?php echo e($blogs->title); ?>

                                </h3>
                            </div>
                            <div class="carousel-inner mt-4">
                                <div class="carousel-item active">
                                    <?php if($blogs->thumbnail): ?>
                                        <img src="<?php echo e(asset($blogs->thumbnail)); ?>" w-100>
                                    <?php else: ?>
                                        <img src="https://assets-global.website-files.com/636ebb4d131625f3efdea089/64b5a7eecc3f96b2ac19d62b_shutterstock_1840661509.jpg"
                                            height="50px" width="70px">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mt-5">
                                <h5>
                                    <?php echo e($blogs->sub_title); ?>

                                </h5>
                            </div>
                            <div class="mt-3">
                                <p>
                                    <?php echo $blogs->description; ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <h4>Images</h4>
                            </div>
                            <div class="gallery gallery-fw" data-item-height="150">
                                <?php $__currentLoopData = $blogimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="gallery-item gallery-md" data-image="<?php echo e(asset($blogimage->image)); ?>"
                                        data-title="Image"></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <!-- JS Libraies -->
    <script src="<?php echo e(asset('library/chocolat/dist/js/jquery.chocolat.min.js')); ?>"></script>
    <!-- Page Specific JS File -->
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\blog\resources\views/blog/view.blade.php ENDPATH**/ ?>