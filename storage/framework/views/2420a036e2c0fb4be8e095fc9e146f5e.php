

<?php $__env->startSection('title', 'General Dashboard'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/jqvmap/dist/jqvmap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/all.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-md-12">
                        <div class="card shadow-lg" id="list1"
                            style="border-radius: 20px; background: linear-gradient(120deg, #1f3b73, #3d80b4);">
                            <div class="card-body py-4 px-4 px-md-5">
                                <div class="text-center mt-3 mb-4 pb-3">
                                    <p class="h4 text-light position-relative d-inline-block"
                                        style="font-weight: 700; font-family: 'Poppins', sans-serif; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
                                        <i class="fas fa-tasks me-2 " style="color: #FFC107;"></i>
                                        <span
                                            style="background: linear-gradient(90deg, #ff6b6b, #f7b42c); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">To-Do
                                            List</span>
                                        <span class="underline"></span>
                                    </p>
                                </div>


                                <!-- Task Form -->
                                <div class="">
                                    <div class="card border-0 shadow-sm"
                                        style="background-color: rgba(255, 255, 255, 0.1); border-radius: 15px;">
                                        <div class="card-body">
                                            <form action="<?php echo e(route('todo.store')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="row g-1">
                                                    <div class="col-md-4">
                                                        <input type="text" name="name"
                                                            class="form-control form-control-lg bg-light text-dark"
                                                            placeholder="Task name..." />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="time" name="time"
                                                            class="form-control form-control-lg bg-light text-dark" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="date" name="date"
                                                            class="form-control form-control-lg bg-light text-dark" />
                                                    </div>
                                                    <div class="col-md-2 d-grid">
                                                        <button type="submit" class="btn btn-success btn-lg">Add
                                                            Task</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php if($errors->any()): ?>
                                                <ul class="mt-3 text-danger">
                                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($error); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4 text-light">

                                <!-- Task List Header -->
                                <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded shadow-sm"
                                    style="background-color: rgba(255, 255, 255, 0.3);">
                                    <p class="small mb-0 fs-5 text-light w-50">Tasks</p>
                                    <div class="d-flex justify-content-between w-50">
                                        <p class="small mb-0 fs-5 text-light">Time</p>
                                        <p class="small mb-0 fs-5 text-light">Due Date</p>
                                        <p class="small mb-0 fs-5 text-light text-end">Actions</p>
                                    </div>
                                </div>

                                <!-- Task List -->
                                <div class="rows mt-3">
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="task-item d-flex justify-content-between align-items-center mb-3 p-3 rounded shadow-sm"
                                            style="background-color: rgba(255, 255, 255, 0.2);">
                                            <div class="d-flex align-items-center" style="gap: 1rem;">
                                                <!-- Gap for number and name -->
                                                <span class="badge bg-light text-dark"><?php echo e($index + 1); ?></span>
                                                <p class="lead fw-normal mb-0 text-light"><?php echo e($dt->name); ?></p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-50">
                                                <span class="badge bg-info text-dark p-2">
                                                    <?php echo e(\Carbon\Carbon::parse($dt->time)->format('h:i A')); ?>

                                                    <!-- Time in 12-hour format -->
                                                </span>
                                                <span class="badge bg-warning text-dark p-2">
                                                    <?php echo e(\Carbon\Carbon::parse($dt->date)->format('j F Y')); ?>

                                                    <!-- Date in "1 January 2000" format -->
                                                </span>

                                                <div class="d-flex align-items-center gap-3">
                                                    <!-- Edit Button with Icon Only -->
                                                    <a href="<?php echo e(route('todo.edit', $dt->id)); ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                                    </a>

                                                    <!-- Delete Button with Icon Only -->
                                                    <form action="<?php echo e(route('todo.destroy', $dt->id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('delete'); ?>
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash-alt"></i> <!-- Trash Icon for Delete -->
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <!-- JS Libraies -->
    <script src="<?php echo e(asset('backend/library/simpleweather/jquery.simpleWeather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/chart.js/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/jqvmap/dist/jquery.vmap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/library/chocolat/dist/js/jquery.chocolat.min.js')); ?>"></script>

    <!-- Page Specific JS File -->
    <script src="<?php echo e(asset('backend/js/page/index-0.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>