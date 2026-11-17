<?php $__env->startSection('title', 'Write a Blog Post'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/library/bootstrap/dist/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.css')); ?>">
<style>
    .community-blog-form{max-width:900px;margin:auto}
    .community-blog-form .form-card{background:#fff;border:1px solid #e8edf4;border-radius:18px;padding:clamp(20px,4vw,34px);box-shadow:0 14px 45px rgba(17,38,75,.06);display:grid;gap:18px}
    .community-blog-form .form-field{display:grid;gap:8px;color:#203354;font-weight:700;font-size:14px}
    .community-blog-form .field{width:100%;border:1px solid #dfe6ef;border-radius:10px;padding:12px 14px;color:#24344e;background:#fff;font:inherit;font-weight:400}
    .community-blog-form .field:focus{outline:0;border-color:#4b7bec;box-shadow:0 0 0 3px rgba(75,123,236,.12)}
    .community-blog-form .help{font-size:12px;color:#7c8aa2;font-weight:400}
    .community-blog-form .image-preview{display:none;width:100%;max-height:270px;object-fit:cover;border-radius:12px;border:1px solid #e4eaf2}
    .community-blog-form .note-editor.note-frame{border:1px solid #dfe6ef;border-radius:10px;overflow:hidden}
    .community-blog-form .note-toolbar{background:#f7f9fc;border-bottom:1px solid #e9edf4}
    .community-blog-form .note-editable{min-height:300px;font-size:15px;line-height:1.8;color:#25344c}
    .community-blog-form .note-statusbar{display:none}
    .community-blog-form .form-actions{display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap}
    .community-blog-form .submit-btn{border:0;border-radius:10px;background:#2457c5;color:#fff;padding:13px 22px;font-weight:700;cursor:pointer}
    .community-blog-form .submit-btn:hover{background:#1948ad}
    @media(max-width:575px){.community-blog-form .form-actions>*{width:100%;text-align:center}}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="section" style="padding:50px 0">
    <div class="container community-blog-form">
        <div class="section-head">
            <div>
                <span class="eyebrow">CAMPUS COMMUNITY</span>
                <h1>Write a Blog Post</h1>
                <p class="muted">Share your knowledge with the CampusNotes community. Your post will be published after admin approval.</p>
            </div>
        </div>

        <?php if(session('success')): ?><div class="alert alert-success" role="status"><?php echo e(session('success')); ?></div><?php endif; ?>
        <?php if($errors->any()): ?><div class="alert alert-danger" role="alert"><strong>Please check the following:</strong><ul class="mb-0 mt-2"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div><?php endif; ?>

        <form id="community-blog-form" method="POST" action="<?php echo e(route('blog.submit.store')); ?>" enctype="multipart/form-data" class="form-card">
            <?php echo csrf_field(); ?>
            <label class="form-field">Post title <span class="text-danger">*</span>
                <input class="field" type="text" name="title" value="<?php echo e(old('title')); ?>" maxlength="255" required placeholder="Enter a clear, helpful title">
            </label>

            <label class="form-field">Category
                <select class="field" name="category_id">
                    <option value="">Choose category (optional)</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php if(old('category_id') == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>

            <label class="form-field">Short summary / excerpt
                <textarea class="field" name="excerpt" rows="3" maxlength="500" placeholder="Write a short introduction for blog cards"><?php echo e(old('excerpt')); ?></textarea>
                <span class="help">Up to 500 characters. This summary appears with your post on the Blog page.</span>
            </label>

            <div class="form-field">
                <label for="featured_image">Featured image <span class="text-danger">*</span></label>
                <input class="field" id="featured_image" type="file" name="featured_image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required>
                <span class="help">Upload one JPG, PNG or WebP image. Maximum size: 5 MB. This image will appear as the blog cover.</span>
                <img id="featured-image-preview" class="image-preview" alt="Featured image preview">
            </div>

            <label class="form-field">Image alt text
                <input class="field" type="text" name="featured_image_alt" value="<?php echo e(old('featured_image_alt')); ?>" maxlength="255" placeholder="Describe the featured image for accessibility">
            </label>

            <div class="form-field">
                <label for="blog-content">Blog content <span class="text-danger">*</span></label>
                <textarea id="blog-content" name="content"><?php echo e(old('content')); ?></textarea>
                <span class="help">Use the formatting toolbar for headings, paragraphs, lists, links and tables. Write at least 100 characters of original content.</span>
            </div>

            <div class="form-actions">
                <span class="help"><i class="fas fa-shield-alt"></i> Your post stays private until an admin approves it.</span>
                <button class="submit-btn" type="submit"><i class="fas fa-paper-plane mr-1"></i> Submit for Admin Approval</button>
            </div>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/library/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/library/popper.js/dist/umd/popper.js')); ?>"></script>
<script src="<?php echo e(asset('backend/library/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.js')); ?>"></script>
<script>
(function () {
    const editor = $('#blog-content');
    editor.summernote({
        height: 340,
        minHeight: 260,
        placeholder: 'Start writing your blog post here...',
        dialogsInBody: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        styleTags: ['p', 'blockquote', 'h2', 'h3', 'h4'],
        shortcuts: true
    });

    const form = document.getElementById('community-blog-form');
    form.addEventListener('submit', function (event) {
        const content = editor.summernote('code');
        const plainText = $('<div>').html(content).text().replace(/\s+/g, ' ').trim();
        if (plainText.length < 100) {
            event.preventDefault();
            alert('Please write at least 100 characters of blog content.');
            editor.summernote('focus');
        }
    });

    const imageInput = document.getElementById('featured_image');
    const preview = document.getElementById('featured-image-preview');
    let previewUrl = null;
    imageInput.addEventListener('change', function () {
        if (previewUrl) URL.revokeObjectURL(previewUrl);
        const file = this.files && this.files[0];
        if (!file) {
            preview.removeAttribute('src');
            preview.style.display = 'none';
            return;
        }
        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type) || file.size > 5 * 1024 * 1024) {
            this.value = '';
            preview.removeAttribute('src');
            preview.style.display = 'none';
            alert('Please choose a JPG, PNG or WebP image smaller than 5 MB.');
            return;
        }
        previewUrl = URL.createObjectURL(file);
        preview.src = previewUrl;
        preview.style.display = 'block';
    });
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/blog/submit.blade.php ENDPATH**/ ?>