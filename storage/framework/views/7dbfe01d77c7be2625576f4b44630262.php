

<?php $__env->startSection('title', 'Products List'); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/library/datatables/media/css/jquery.dataTables.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Products</div>
                <div class="breadcrumb-item">Products List</div>
            </div>
        </div>

        <div class="section-body">
            <?php if($message = Session::get('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e($message); ?></p>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-left text-left my-1">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-create')): ?>
                                    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">Create New Product</a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="products-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL</th>
                                            <th>Name</th>
                                            <th>Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td></td> <!-- Serial number handled by DataTables -->
                                                <td><?php echo e($product->name); ?></td>
                                                <td><?php echo e($product->detail); ?></td>
                                                <td class="d-flex">
                                                    <a class="btn btn-info btn-sm mr-1" href="<?php echo e(route('products.show',$product->id)); ?>" title="Show"><i class="fa-solid fa-eye"></i></a>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-edit')): ?>
                                                        <a class="btn btn-primary btn-sm mr-1" href="<?php echo e(route('products.edit',$product->id)); ?>" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-delete')): ?>
                                                        <form action="<?php echo e(route('products.destroy',$product->id)); ?>" method="POST" style="display:inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                                <?php echo $products->links(); ?> <!-- Optional, DataTables pagination will override -->
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
    <script src="<?php echo e(asset('backend/library/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            var t = $('#products-table').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": 3 } // Disable sorting on Action column
                ]
            });

            // Add serial number dynamically
            t.on('order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\shop\resources\views/products/index.blade.php ENDPATH**/ ?>