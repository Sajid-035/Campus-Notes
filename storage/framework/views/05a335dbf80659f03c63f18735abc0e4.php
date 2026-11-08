

<?php $__env->startSection('title', 'Blog List'); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('library/datatables/media/css/jquery.dataTables.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blog List</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Blogs</a></div>
                    <div class="breadcrumb-item">Blog List</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    SL
                                                </th>
                                                <th>Thumbnail</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $serialNumber = 1;
                                            ?>
                                            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e($serialNumber++); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($blog->thumbnail): ?>
                                                            <img src="<?php echo e(asset($blog->thumbnail)); ?>" width="60px"
                                                                height="40px">
                                                        <?php else: ?>
                                                            <img src="https://assets-global.website-files.com/636ebb4d131625f3efdea089/64b5a7eecc3f96b2ac19d62b_shutterstock_1840661509.jpg"
                                                                height="50px" width="70px">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo e($blog->title); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($blog->sub_title); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo implode(' ', array_slice(explode(' ', $blog->description), 0,30)); ?><?php if(str_word_count($blog->description) > 20): ?>...<?php endif; ?>

                                                    </td>


                                                    <td class="d-flex">
                                                        <a href="<?php echo e(route('blog.view', $blog->id)); ?>" class="btn btn-info btn-action btn-sm mr-1"
                                                            data-toggle="tooltip" title="View"><i
                                                                class="fa-solid fa-eye"></i></a>
                                                        <a href="<?php echo e(route('blog.edit', $blog->id)); ?>"
                                                            class="btn btn-primary btn-action btn-sm mr-1" data-toggle="tooltip"
                                                            title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                        <form action="<?php echo e(route('blog.destroy', $blog->id)); ?>"
                                                            method="Post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <button class="btn btn-danger btn-sm btn-action" data-toggle="tooltip"
                                                                title="Delete"  onclick="return confirm('Are you sure?')"><i
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

            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('library/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/page/modules-datatables.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\blog\resources\views/blog/index.blade.php ENDPATH**/ ?>