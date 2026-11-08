

<?php $__env->startSection('title', 'basic'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/jqvmap/dist/jqvmap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/summernote/dist/summernote-bs4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Basic Settings</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Settings</a></div>
                    <div class="breadcrumb-item">Basic Settings</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="<?php echo e(route('settings.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                            <div class="card-body card card-primary">
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label><b>Site Title*</b></label>
                                        <input type="text" class="form-control" value="<?php echo e(!empty($basics) ? $basics->site_title : ''); ?>" name="site_title"> 
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label><b>Site Tagline</b></label>
                                        <input type="text" class="form-control" value="<?php echo e(!empty($basics) ? $basics->site_tagline : ''); ?>" name="site_tagline">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><b>Footer Text*</b></label>
                                        <input type="text" class="form-control" value="<?php echo e(!empty($basics) ? $basics->footer_text : ''); ?>" name="footer_text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Contact Phone No</b></label>
                                        <input type="text" class="form-control" value="<?php echo e(!empty($basics) ? $basics->phone : ''); ?>" name="phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Contact Email</b></label>
                                        <input type="email" class="form-control" value="<?php echo e(!empty($basics) ? $basics->email : ''); ?>" name="email">
                                    </div>
                                </div>
                                <label><b>Social Link</b></label>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><b>Facebook Link</b></label>
                                        <input type="text" class="form-control" value="<?php echo e(!empty($basics) ? $basics->facebook : ''); ?>" name="facebook">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Instagram Link</b></label>
                                        <input type="text" class="form-control" value="<?php echo e(!empty($basics) ? $basics->instagram : ''); ?>" name="instagram">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Twitter Link</b></label>
                                        <input type="text" class="form-control" value="<?php echo e(!empty($basics) ? $basics->twitter : ''); ?>" name="twitter">
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                            <div>
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
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
    <script src="<?php echo e(asset('library/simpleweather/jquery.simpleWeather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/chart.js/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/jqvmap/dist/jquery.vmap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
    <script src="<?php echo e(asset('library/summernote/dist/summernote-bs4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/chocolat/dist/js/jquery.chocolat.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- Page Specific JS File -->
    <script src="<?php echo e(asset('js/page/index-0.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\blog\resources\views/settings/basic.blade.php ENDPATH**/ ?>