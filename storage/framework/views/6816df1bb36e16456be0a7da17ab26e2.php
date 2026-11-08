<?php $__env->startSection('title', 'View Profile'); ?>
<?php $__env->startSection('panel-content'); ?>
<div class="student-page-heading"><div><span class="student-kicker">MY PROFILE</span><h1>Student Profile</h1><p>Your CampusNotes student membership and academic information.</p></div><div style="display:flex;gap:8px;flex-wrap:wrap"><a class="btn outline" href="<?php echo e(route('student.id-card')); ?>">Digital Student ID</a><a class="btn primary" href="<?php echo e(route('student.profile.edit')); ?>">✎ Edit Profile</a></div></div>
<div class="student-profile-grid">
    <div class="card form-card">
        <?php if(session('success')): ?><div class="flash success"><?php echo e(session('success')); ?></div><?php endif; ?>
        <div class="student-profile-heading">
            <div class="student-profile-avatar student-avatar-frame">
                <?php if($user->avatar_url): ?><img src="<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->name); ?> profile photo"><?php else: ?><?php echo e(strtoupper(substr($user->name,0,1))); ?><?php endif; ?>
            </div>
            <div><h3><?php echo e($user->name); ?></h3><span class="status approved">✓ Verified Student</span></div>
        </div><div class="info-row"><span>Student ID</span><strong><?php echo e($user->student_id); ?></strong></div><div class="info-row"><span>Email</span><strong><?php echo e($user->email); ?></strong></div><div class="info-row"><span>Phone</span><strong><?php echo e($user->phone ?: 'Not provided'); ?></strong></div><div class="info-row"><span>Institution</span><strong><?php echo e($user->institution_name ?: 'Not provided'); ?></strong></div><div class="info-row"><span>Department</span><strong><?php echo e($user->academicDepartment?->name ?: 'Not provided'); ?></strong></div><div class="info-row"><span>Batch</span><strong><?php echo e($user->student_batch ?: 'Not provided'); ?></strong></div><div class="info-row"><span>Semester</span><strong><?php echo e($user->semester ?: 'Not provided'); ?></strong></div><div class="info-row"><span>Member since</span><strong><?php echo e(optional($user->verified_at ?: $user->created_at)->format('d M Y')); ?></strong></div><?php if($user->profile_bio): ?><div style="padding-top:15px"><strong>About Me</strong><p class="muted" style="font-size:12px;line-height:1.7"><?php echo e($user->profile_bio); ?></p></div><?php endif; ?></div>
    <div class="student-profile-side"><div class="card student-identity-summary"><span class="student-kicker">MEMBERSHIP STATUS</span><h3>✓ Verified</h3><p class="muted small">Your account has been approved by the CampusNotes team.</p><a class="btn primary" style="width:100%" href="<?php echo e(route('student.id-card')); ?>">Download ID Card</a></div><div class="card student-identity-summary"><h3>Account Privacy</h3><p class="muted small">Manage whether your profile and leaderboard information are visible to other students.</p><a href="<?php echo e(route('student.settings')); ?>" class="student-table-action">Privacy Settings →</a></div></div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>.student-avatar-frame{overflow:hidden;flex:0 0 auto;border-radius:50%;}.student-avatar-frame img{display:block;width:100%;height:100%;object-fit:cover;border-radius:inherit;}</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.student.layouts.panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/frontend/student/profile-show.blade.php ENDPATH**/ ?>