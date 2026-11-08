
<?php $__env->startSection('title', 'basic'); ?>
<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/jqvmap/dist/jqvmap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.css')); ?>">
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
                        <div class="card-body card card-primary">
                            <form action="<?php echo e(route('settings.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><b>Site Title*</b></label>
                                        <input type="text" class="form-control"
                                            value="<?php echo e(!empty($basics) ? $basics->site_title : ''); ?>" name="site_title">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label><b>Site Tagline</b></label>
                                        <input type="text" class="form-control"
                                            value="<?php echo e(!empty($basics) ? $basics->site_tagline : ''); ?>" name="site_tagline">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label><b>logo</b></label>
                                        <div>
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input" id="imageFiles"
                                                    name="image">
                                                <label class="custom-file-label" for="imageFiles">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1 mt-4">
                                        <?php if($basics->image): ?>
                                        <img src="<?php echo e(asset( 'fontend/' . $basics->image)); ?>" alt="" width="100px"
                                            height="35px" class="row">
                                    <?php else: ?>
                                        <span></span>
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><b>Footer Text*</b></label>
                                        <input type="text" class="form-control"
                                            value="<?php echo e(!empty($basics) ? $basics->footer_text : ''); ?>" name="footer_text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Contact Phone No</b></label>
                                        <input type="text" class="form-control"
                                            value="<?php echo e(!empty($basics) ? $basics->phone : ''); ?>" name="phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Contact Email</b></label>
                                        <input type="email" class="form-control"
                                            value="<?php echo e(!empty($basics) ? $basics->email : ''); ?>" name="email">
                                    </div>
                                </div>
                                <label><b>Social Link</b></label>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><b>Facebook Link</b></label>
                                        <input type="text" class="form-control"
                                            value="<?php echo e(!empty($basics) ? $basics->facebook : ''); ?>" name="facebook">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Instagram Link</b></label>
                                        <input type="text" class="form-control"
                                            value="<?php echo e(!empty($basics) ? $basics->instagram : ''); ?>" name="instagram">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Twitter Link</b></label>
                                        <input type="text" class="form-control"
                                            value="<?php echo e(!empty($basics) ? $basics->twitter : ''); ?>" name="twitter">
                                    </div>
                                </div>
                                <div class=" card-left text-left my-1">
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
    <script src="<?php echo e(asset('backend/library/simpleweather/jquery.simpleWeather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/chart.js/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/jqvmap/dist/jquery.vmap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/chocolat/dist/js/jquery.chocolat.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- Page Specific JS File -->
    <script src="<?php echo e(asset('backend/js/page/index-0.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\blog\resources\views/fontend/settings/basic.blade.php ENDPATH**/ ?>