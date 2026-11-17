

<?php $__env->startSection('title', 'Edit Blog'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet"
    href="<?php echo e(asset('library/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/jqvmap/dist/jqvmap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Blog</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Blogs</a></div>
                    <div class="breadcrumb-item"><a href="#">Blog List</a></div>
                    <div class="breadcrumb-item">Edit Blog</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="<?php echo e(route('blog.update', ['id' => $blogs->id])); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="card-body card card-primary">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label><b>Title*</b></label>
                                            <input type="text" class="form-control" name="title" value="<?php echo e(!empty($blogs) ? $blogs->title : ''); ?>">
                                        </div>                                    
                                        <div class="form-group col-md-6">
                                            <label><b>Sub Title</b></label>
                                            <input type="text" class="form-control" name="sub_title" value="<?php echo e(!empty($blogs) ? $blogs->sub_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label><b>Thumbnail*</b></label>
                                            <div>
                                                <div class="custom-file ">
                                                    <input type="file" class="custom-file-input" id="imageFiles" name="thumbnail" >
                                                    <label class="custom-file-label" for="imageFiles">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label><b>Images</b></label>
                                            <div>
                                                <div class="custom-file ">
                                                    <input type="file" class="custom-file-input" id="imageFile" name="image[]" multiple >
                                                    <label class="custom-file-label" for="imageFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label><b>Date*</b></label>
                                                <input type="text" name="blog_date"
                                                    class="form-control datepicker" value="<?php echo e(!empty($blogs) ? $blogs->date : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label><b>Description</b></label>
                                        <textarea class="form-control summernote" data-height="150" name="description"><?php echo e(!empty($blogs) ? $blogs->description : ''); ?></textarea>
                                    </div>
                                </div>
                                <div class="card-footer text-left my-5">
                                    <button type="submit" class="btn btn-primary">Update</button>
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

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\blog\resources\views/backend/blog/edit.blade.php ENDPATH**/ ?>