<?php $__env->startSection('title', 'Edit Profile'); ?>
<?php $__env->startSection('panel-content'); ?>
<div class="student-page-heading"><div><span class="student-kicker">MY PROFILE</span><h1>Edit Profile</h1><p>Update your academic identity and profile information.</p></div><div style="display:flex;gap:8px;flex-wrap:wrap"><a class="btn outline" href="<?php echo e(route('student.profile')); ?>">View Profile</a><a class="btn outline" href="<?php echo e(route('student.id-card')); ?>">Digital ID →</a></div></div>
<div class="student-profile-grid">
    <div class="card form-card"><form method="POST" action="<?php echo e(route('student.profile.update')); ?>" enctype="multipart/form-data"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <?php if($errors->any()): ?><div class="flash error">Please review the highlighted information.<ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div><?php endif; ?>
        <div class="student-profile-heading">
            <div class="student-profile-avatar student-avatar-frame" id="avatarPreviewFrame">
                <?php if($user->avatar_url): ?>
                    <img id="avatarPreview" src="<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->name); ?> profile photo">
                <?php else: ?>
                    <img id="avatarPreview" src="" alt="Profile photo preview" hidden>
                    <span id="avatarInitial"><?php echo e(strtoupper(substr($user->name,0,1))); ?></span>
                <?php endif; ?>
            </div>
            <div><h3><?php echo e($user->name); ?></h3><span class="status approved">✓ Verified Student</span><p class="muted small" style="margin:5px 0 0">Your profile photo appears on your student panel and membership card.</p></div>
        </div>
        <label class="field-label">Full Name *</label><input class="field" name="name" required value="<?php echo e(old('name',$user->name)); ?>">
        <label class="field-label">Phone Number</label><input class="field" name="phone" value="<?php echo e(old('phone',$user->phone)); ?>" placeholder="Your contact number">
        <label class="field-label">University / Institution</label><input class="field" name="institution_name" value="<?php echo e(old('institution_name',$user->institution_name)); ?>">
        <label class="field-label">Department</label><select class="field" name="academic_department_id"><option value="">Choose department</option><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($department->id); ?>" <?php if(old('academic_department_id',$user->academic_department_id)==$department->id): echo 'selected'; endif; ?>><?php echo e($department->name); ?> (<?php echo e($department->code); ?>)</option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
        <div class="profile-form-row"><div><label class="field-label">Batch</label><input class="field" name="student_batch" value="<?php echo e(old('student_batch',$user->student_batch)); ?>"></div><div><label class="field-label">Semester</label><select class="field" name="semester"><option value="">Choose semester</option><?php for($i=1;$i<=20;$i++): ?><option value="<?php echo e($i); ?>" <?php if(old('semester',$user->semester)==$i): echo 'selected'; endif; ?>>Semester <?php echo e($i); ?></option><?php endfor; ?></select></div></div>
        <label class="field-label">About Me</label><textarea class="field" name="profile_bio" rows="4" placeholder="A short introduction"><?php echo e(old('profile_bio',$user->profile_bio)); ?></textarea>
        <label class="field-label" for="avatarInput">Profile Photo</label>
        <input class="field" id="avatarInput" type="file" name="avatar" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
        <p class="muted small">Choose a JPG, PNG or WebP image, maximum 5 MB. The preview updates before you save.</p>
        <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error" style="color:#dc2626;font-size:11px"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <button class="btn primary">Save Profile</button>
    </form></div>
    <div class="student-profile-side"><div class="card student-identity-summary"><span class="student-kicker">CAMPUSNOTES IDENTITY</span><h3><?php echo e($user->student_id); ?></h3><p class="muted small">Your unique CampusNotes student membership ID.</p><div class="info-row"><span>Application</span><strong><?php echo e($user->application_number); ?></strong></div><div class="info-row"><span>Email</span><strong><?php echo e($user->email); ?></strong></div><div class="info-row"><span>Account</span><span class="status approved">Approved</span></div><a class="btn outline" style="width:100%;margin-top:15px" href="<?php echo e(route('student.id-card')); ?>">Download ID Card</a></div>
        <div class="card student-identity-summary"><h3>Profile visibility</h3><p class="muted small">Control your profile and leaderboard visibility from Account Settings.</p><a href="<?php echo e(route('student.settings')); ?>" class="student-table-action">Open Account Settings →</a></div></div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.student-avatar-frame{overflow:hidden;position:relative;flex:0 0 auto;border-radius:50%;}
.student-avatar-frame img{display:block;width:100%;height:100%;object-fit:cover;border-radius:inherit;}
.student-avatar-frame span{display:grid;width:100%;height:100%;place-items:center;}
.field-error{margin:6px 0 0;}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('avatarInput');
    const preview = document.getElementById('avatarPreview');
    const initial = document.getElementById('avatarInitial');
    if (!input || !preview) return;
    input.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;
        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
            this.value = '';
            alert('Please select a JPG, PNG or WebP image.');
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            this.value = '';
            alert('The image must be 5 MB or smaller.');
            return;
        }
        preview.src = URL.createObjectURL(file);
        preview.hidden = false;
        if (initial) initial.hidden = true;
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.student.layouts.panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/frontend/student/profile.blade.php ENDPATH**/ ?>