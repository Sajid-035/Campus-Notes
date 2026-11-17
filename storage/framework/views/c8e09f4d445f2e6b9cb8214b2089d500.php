<?php $__env->startSection('title', 'Application Status'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $accountStatus = (string) ($user->account_status ?? 'pending');
    $memberType = ucfirst($user->account_type ?: 'student');
    $statusContent = [
        'pending' => [
            'title' => 'Your application is under review',
            'description' => 'Thanks for applying to CampusNotes. Our team is checking your institutional information. You can revisit this page to see updates.',
            'icon' => '◷',
        ],
        'approved' => [
            'title' => 'Your account is approved',
            'description' => 'You now have full access to your member dashboard and digital membership card.',
            'icon' => '✓',
        ],
        'rejected' => [
            'title' => 'Application not approved',
            'description' => 'You can sign in to review the decision and the reason provided by the CampusNotes team.',
            'icon' => '!',
        ],
        'suspended' => [
            'title' => 'Account suspended',
            'description' => 'Your account access is currently suspended. Please contact CampusNotes support for assistance.',
            'icon' => '!',
        ],
        'inactive' => [
            'title' => 'Account inactive',
            'description' => 'Your account is currently inactive. Please contact CampusNotes support if you believe this is a mistake.',
            'icon' => '◷',
        ],
        'verification_required' => [
            'title' => 'More information required',
            'description' => 'Please update the requested information below so our team can continue the verification.',
            'icon' => 'i',
        ],
    ];
    $currentStatus = $statusContent[$accountStatus] ?? $statusContent['pending'];
    $submittedAt = $user->application_submitted_at ?: $user->created_at;
?>

<div class="container application-status-page">
    <div class="application-status-card card">
        <a class="brand" href="<?php echo e(route('frontend.home')); ?>"><span class="logo">C</span>CampusNotes</a>

        <div class="application-status-icon <?php echo e($accountStatus); ?>"><?php echo e($currentStatus['icon']); ?></div>
        <span class="student-kicker"><?php echo e(strtoupper($memberType)); ?> ACCOUNT VERIFICATION</span>
        <h1><?php echo e($currentStatus['title']); ?></h1>
        <p class="muted"><?php echo e($currentStatus['description']); ?></p>

        <?php if(session('success')): ?>
            <div class="flash"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="application-reference-grid">
            <div><small>APPLICATION NUMBER</small><strong><?php echo e($user->application_number ?: 'Pending assignment'); ?></strong></div>
            <div><small>CAMPUS MEMBER ID</small><strong><?php echo e($user->student_id ?: 'Pending assignment'); ?></strong></div>
            <div><small>INSTITUTIONAL ID CARD NO.</small><strong><?php echo e($user->institutional_id_number ?: 'Not supplied'); ?></strong></div>
            <div><small>SUBMISSION DATE</small><strong><?php echo e($submittedAt ? $submittedAt->format('d M Y') : 'Not available'); ?></strong></div>
            <div><small>VERIFICATION STATUS</small><strong><span class="status <?php echo e($accountStatus); ?>"><?php echo e(ucwords(str_replace('_', ' ', $accountStatus))); ?></span></strong></div>
        </div>

        <?php if($accountStatus === 'rejected' && $user->rejection_reason): ?>
            <div class="application-reason"><strong>Rejection Reason</strong><p><?php echo e($user->rejection_reason); ?></p></div>
        <?php endif; ?>

        <?php if($accountStatus === 'verification_required'): ?>
            <div class="application-reason"><strong>Additional information requested</strong><p><?php echo e($user->verification_note ?: 'Please confirm your institutional details.'); ?></p></div>
            <form method="POST" action="<?php echo e(route('student.verification-details')); ?>" class="application-verification-form">
                <?php echo csrf_field(); ?>
                <label class="field-label" for="institution_name">University / Institution *</label>
                <input class="field" id="institution_name" name="institution_name" required value="<?php echo e(old('institution_name', $user->institution_name)); ?>">

                <label class="field-label" for="institutional_id_number">Institutional ID Card No. *</label>
                <input class="field" id="institutional_id_number" name="institutional_id_number" required maxlength="80" value="<?php echo e(old('institutional_id_number', $user->institutional_id_number)); ?>">

                <label class="field-label" for="academic_department_id">Department *</label>
                <select class="field" id="academic_department_id" name="academic_department_id" required>
                    <option value="">Choose department</option>
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>" <?php if(old('academic_department_id', $user->academic_department_id) == $department->id): echo 'selected'; endif; ?>><?php echo e($department->name); ?> (<?php echo e($department->code); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <?php if(($user->account_type ?: 'student') === 'student'): ?>
                    <label class="field-label" for="student_batch">Batch *</label>
                    <input class="field" id="student_batch" name="student_batch" required value="<?php echo e(old('student_batch', $user->student_batch)); ?>">

                    <label class="field-label" for="semester">Current Semester *</label>
                    <select class="field" id="semester" name="semester" required>
                        <option value="">Choose semester</option>
                        <?php $__currentLoopData = $semesters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($semester->number); ?>" <?php if(old('semester', $user->semester) == $semester->number): echo 'selected'; endif; ?>><?php echo e($semester->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <?php endif; ?>

                <label class="field-label" for="verification_note">Message (optional)</label>
                <textarea class="field" id="verification_note" rows="3" name="verification_note" placeholder="Add any clarification"><?php echo e(old('verification_note')); ?></textarea>
                <button class="btn primary" type="submit">Submit updated details →</button>
            </form>
        <?php endif; ?>

        <?php if($accountStatus === 'approved'): ?>
            <a class="btn primary" href="<?php echo e(route('student.dashboard')); ?>">Go to Member Dashboard →</a>
        <?php elseif(in_array($accountStatus, ['rejected', 'suspended', 'inactive'], true)): ?>
            <a class="btn primary" href="<?php echo e(route('student.support')); ?>">Contact Admin Support</a>
        <?php else: ?>
            <a class="btn outline" href="<?php echo e(route('student.application-status')); ?>">↻ Refresh Status</a>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('logout')); ?>" class="application-logout">
            <?php echo csrf_field(); ?>
            <button type="submit">Sign out</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/student/application-status.blade.php ENDPATH**/ ?>