

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('style'); ?>
    
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

            
            <div class="row">
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total News</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalNewsCount ?? 0); ?> 
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Published News</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($publishedNewsCount ?? 0); ?> 
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending News</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($pendingNewsCount ?? 0); ?> 
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Draft News</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($draftNewsCount ?? 0); ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row">
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Breaking News</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($breakingNewsCount ?? 0); ?>

                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Featured News</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($featuredNewsCount ?? 0); ?>

                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-dark">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Categories</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalCategories ?? 0); ?>

                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Reporters</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalReporters ?? 0); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row">
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admins</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalAdminUsers ?? 0); ?>

                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Comments</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalComments ?? 0); ?>

                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-ad"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Ads</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalAdvertisements ?? 0); ?>

                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-light">
                            <i class="fas fa-chart-bar text-muted"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Other Metric</h4>
                            </div>
                            <div class="card-body">
                                N/A
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg" id="list1">
                        <div class="card-body py-4 px-4 px-md-5">
                            
                            <h2 class="section-title">To-Do List</h2>
                            <div class="todo-card">
                                
                                <form action="<?php echo e(route('todo.store')); ?>" method="POST" class="mb-3">
                                    <?php echo csrf_field(); ?>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Task name..." required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="time" name="time" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-success w-100">Add Task</button>
                                        </div>
                                    </div>
                                </form>

                                
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="task-item col-md-12">
                                        <div
                                            class="d-flex flex-column flex-md-row justify-content-between w-100 align-items-start align-items-md-center mb-2 p-2 border rounded">
                                            
                                            <div class="mb-1 mb-md-0">
                                                <span class="badge bg-light text-dark"><?php echo e($index + 1); ?></span>
                                                <span class="ms-2"><?php echo e($task->name); ?></span>
                                            </div>

                                            
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <span
                                                    class="badge bg-info"><?php echo e(\Carbon\Carbon::parse($task->time)->format('h:i A')); ?></span>
                                                <span
                                                    class="badge bg-warning"><?php echo e(\Carbon\Carbon::parse($task->date)->format('j F Y')); ?></span>
                                                <div class="d-flex">
                                                    <a href="<?php echo e(route('todo.edit', $task->id)); ?>"
                                                        class="btn btn-sm btn-primary me-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="<?php echo e(route('todo.destroy', $task->id)); ?>"
                                                        method="POST" class="m-0 p-0">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\portal\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>