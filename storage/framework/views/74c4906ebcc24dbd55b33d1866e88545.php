<?php $__env->startSection('title', 'Student Applications'); ?>
<?php $__env->startSection('main'); ?>
<div class="main-content"><section class="section">
    <div class="section-header"><h1>Student Applications</h1><div class="section-header-breadcrumb"><div class="breadcrumb-item active">Administration</div><div class="breadcrumb-item">Student Applications</div></div></div>
    <div class="section-body">
        <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
        <?php if($errors->any()): ?><div class="alert alert-danger"><?php echo e($errors->first()); ?></div><?php endif; ?>
        <div class="row mb-3">
            <div class="col-12"><div class="card"><div class="card-body">
                <form method="GET" class="form-row align-items-end">
                    <div class="form-group col-md-5"><label>Search student</label><input class="form-control" name="q" value="<?php echo e(request('q')); ?>" placeholder="Name, email, Student ID or Application No."></div>
                    <div class="form-group col-md-3"><label>Account status</label><select class="form-control" name="status"><option value="">All statuses</option><?php $__currentLoopData = ['pending','approved','rejected','suspended','inactive','verification_required']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($status); ?>" <?php if(request('status')===$status): echo 'selected'; endif; ?>><?php echo e(ucwords(str_replace('_',' ',$status))); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
                    <div class="form-group col-md-2"><button class="btn btn-primary btn-block">Filter</button></div>
                    <div class="form-group col-md-2"><a href="<?php echo e(route('admin.student-applications.index')); ?>" class="btn btn-light btn-block">Reset</a></div>
                </form>
            </div></div></div>
        </div>
        <div class="card"><div class="card-header"><h4>Student Verification Queue</h4><div class="card-header-action"><?php echo e($students->total()); ?> accounts</div></div><div class="card-body p-0"><div class="table-responsive">
            <table class="table table-striped mb-0"><thead><tr><th>Student</th><th>Application / Student ID</th><th>Academic Details</th><th>Submitted</th><th>Status</th><th style="min-width:350px">Update Status</th></tr></thead><tbody>
            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr>
                <td><strong><?php echo e($student->name); ?></strong><br><small><?php echo e($student->email); ?></small></td>
                <td><small>App: <?php echo e($student->application_number ?: '—'); ?></small><br><small>ID: <?php echo e($student->student_id ?: '—'); ?></small></td>
                <td><?php echo e($student->institution_name ?: '—'); ?><br><small><?php echo e($student->academicDepartment?->name ?: 'Department —'); ?> · <?php echo e($student->student_batch ?: 'Batch —'); ?> · Sem <?php echo e($student->semester ?: '—'); ?></small></td>
                <td><?php echo e(optional($student->application_submitted_at ?: $student->created_at)->format('d M Y')); ?></td>
                <td><span class="badge badge-<?php echo e($student->account_status==='approved'?'success':($student->account_status==='rejected'?'danger':($student->account_status==='pending'?'warning':'secondary'))); ?>"><?php echo e(ucwords(str_replace('_',' ',$student->account_status))); ?></span></td>
                <td><form method="POST" action="<?php echo e(route('admin.student-applications.status',$student)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?><div class="input-group input-group-sm mb-1"><select class="form-control" name="account_status"><?php $__currentLoopData = ['pending','approved','rejected','suspended','inactive','verification_required']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($status); ?>" <?php if($student->account_status===$status): echo 'selected'; endif; ?>><?php echo e(ucwords(str_replace('_',' ',$status))); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select><div class="input-group-append"><button class="btn btn-primary">Save</button></div></div><input class="form-control form-control-sm mb-1" name="rejection_reason" placeholder="Rejection reason (when rejecting)" value="<?php echo e($student->rejection_reason); ?>"><input class="form-control form-control-sm" name="verification_note" placeholder="Verification request / note" value="<?php echo e($student->verification_note); ?>"></form></td>
            </tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" class="text-center p-4">No student applications found.</td></tr><?php endif; ?>
            </tbody></table>
        </div></div><div class="card-footer"><?php echo e($students->links()); ?></div></div>
    </div>
</section></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/backend/students/index.blade.php ENDPATH**/ ?>