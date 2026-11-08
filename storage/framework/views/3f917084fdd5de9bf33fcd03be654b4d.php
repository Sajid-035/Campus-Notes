

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
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>Create a mobile app</td>
                                                <td class="align-middle">
                                                    <div class="progress" data-height="4" data-toggle="tooltip"
                                                        title="100%">
                                                        <div class="progress-bar bg-success" data-width="100%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-5.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Wildan Ahdian">
                                                </td>
                                                <td>2018-01-20</td>
                                                
                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>Redesign homepage</td>
                                                <td class="align-middle">
                                                    <div class="progress" data-height="4" data-toggle="tooltip"
                                                        title="0%">
                                                        <div class="progress-bar" data-width="0"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-1.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Nur Alpiana">
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-3.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Hariono Yusup">
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-4.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Bagus Dwi Cahya">
                                                </td>
                                                <td>2018-04-10</td>
                                               
                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>Backup database</td>
                                                <td class="align-middle">
                                                    <div class="progress" data-height="4" data-toggle="tooltip"
                                                        title="70%">
                                                        <div class="progress-bar bg-warning" data-width="70%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-1.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Rizal Fakhri">
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-2.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Hasan Basri">
                                                </td>
                                                <td>2018-01-29</td>
                                               
                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>Input data</td>
                                                <td class="align-middle">
                                                    <div class="progress" data-height="4" data-toggle="tooltip"
                                                        title="100%">
                                                        <div class="progress-bar bg-success" data-width="100%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-2.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Rizal Fakhri">
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-5.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Isnap Kiswandi">
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-4.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Yudi Nawawi">
                                                    <img alt="image" src="<?php echo e(asset('img/avatar/avatar-1.png')); ?>"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="Khaerul Anwar">
                                                </td>
                                                <td>2018-01-16</td>
                                               
                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                            </tr>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\blog\resources\views/pages/blog-list.blade.php ENDPATH**/ ?>