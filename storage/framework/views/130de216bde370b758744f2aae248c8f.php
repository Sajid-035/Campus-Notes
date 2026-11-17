
<?php $__env->startSection('title', 'Banner Settings'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/datatables/media/css/jquery.dataTables.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Banner Setting</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Settings</a></div>
                    <div class="breadcrumb-item">Banner Settings</div>
                </div>
            </div>
            <form action="<?php echo e(route('settings.imageStore')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card-body card card-primary">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label><b>Hero Image*</b></label>
                            <div>
                                <div class="custom-file ">
                                    <input type="file" class="custom-file-input" id="imageFiles" name="image">
                                    <label class="custom-file-label" for="imageFiles">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Title</b></label>
                            <input type="text" class="form-control"  name="title">
                        </div>

                        <div class="form-group col-md-4">
                            <label><b>Sub Title</b></label>
                            <input type="text" class="form-control" name="sub_title">
                        </div>
                        <div class="form-group col-md-4">
                            <label><b>Button Text</b></label>
                            <input type="text" class="form-control" name="button_text">
                        </div>
                        <div class="form-group col-md-4">
                            <label><b>Button Link</b></label>
                            <input type="text" class="form-control" name="button_link">
                        </div>
                    </div>
                    <div class="card-left text-left my-1">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table " id="table">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Hero Images</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $heroimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $heroimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td> <?php echo e($index + 1); ?> </td>
                                                    <td>
                                                        <?php if($heroimage->image): ?>
                                                            <img src="<?php echo e(asset('backend/' . $heroimage->image)); ?>" width="120px"
                                                                height="40px">
                                                        <?php else: ?>
                                                            <img src="" height="50px" width="70px">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <?php echo e($heroimage->title); ?></td>
                                                    <td> <?php echo e($heroimage->sub_title); ?></td>
                                                    <td>
                                                        <form action="<?php echo e(route('settings.destroy', $heroimage->id)); ?>"
                                                            method="Post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <button class="btn btn-danger btn-sm btn-action"
                                                                data-toggle="tooltip" title="Delete"
                                                                onclick="return confirm('Are you sure?')"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><div>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('backend/library/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/page/modules-datatables.js')); ?>"></script>
    <script>
        $(function() {
            $("#table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/backend/settings/banner.blade.php ENDPATH**/ ?>