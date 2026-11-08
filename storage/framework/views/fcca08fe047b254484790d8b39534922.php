<?php $__env->startSection('title', $post->exists ? 'Edit Blog Post' : 'Create Blog Post'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.css')); ?>">
<style>
.blog-editor .card{border:0;border-radius:12px;box-shadow:0 5px 24px rgba(24,38,67,.055);margin-bottom:20px}.blog-editor .card-header{background:#fff;border-bottom:1px solid #f0f2f7;padding:18px 22px}.blog-editor .card-header h4{font-size:15px;margin:0;font-weight:800;color:#29334b}.blog-editor .card-body{padding:22px}.blog-editor label{font-size:12px;font-weight:700;color:#59647c}.blog-editor .form-control{border-radius:7px;font-size:13px}.blog-editor .form-control:focus{border-color:#6777ef;box-shadow:0 0 0 2px rgba(103,119,239,.1)}.blog-editor .form-text{font-size:11px}.blog-editor .form-section-title{font-size:12px;font-weight:800;color:#6c7590;text-transform:uppercase;letter-spacing:.7px;margin:4px 0 15px}.blog-editor .seo-preview{border:1px solid #e8ebf3;border-radius:10px;padding:17px;background:#fff}.blog-editor .seo-preview .preview-url{font-size:11px;color:#536b58;overflow-wrap:anywhere}.blog-editor .seo-preview .preview-title{display:block;color:#1a0dab;font:500 18px/1.35 Arial,sans-serif;margin:4px 0}.blog-editor .seo-preview .preview-desc{font:13px/1.5 Arial,sans-serif;color:#4d5156}.blog-editor .counter{font-size:11px;color:#8490a6}.blog-editor .counter.good{color:#28a36a}.blog-editor .counter.bad{color:#e25858}.blog-editor .analysis-panel{border:1px solid #e8ebf3;border-radius:10px;padding:17px}.blog-editor .analysis-panel h5{font-size:13px;font-weight:800;margin:0 0 12px}.blog-editor .analysis-score{display:flex;align-items:center;gap:12px;margin-bottom:14px}.blog-editor .score-circle{width:54px;height:54px;flex:0 0 54px;border-radius:50%;display:grid;place-items:center;background:#edf8f2;color:#21875a;font-size:17px;font-weight:800}.blog-editor .score-track{height:7px;border-radius:20px;background:#edf0f6;overflow:hidden}.blog-editor .score-fill{height:100%;width:0;background:#27ae75;border-radius:20px;transition:width .25s}.blog-editor .analysis-list{list-style:none;padding:0;margin:0}.blog-editor .analysis-list li{font-size:11px;padding:6px 0;border-bottom:1px solid #f1f2f6;color:#737f96;display:flex;gap:8px}.blog-editor .analysis-list li:last-child{border:0}.blog-editor .analysis-list .pass{color:#239466}.blog-editor .analysis-list .fail{color:#d28a36}.blog-editor .analysis-list i{width:13px;margin-top:2px}.blog-editor .editor-help{font-size:11px;color:#8b94a7}.blog-editor .note-editor.note-frame{border-color:#e6e9f0;border-radius:8px;overflow:hidden}.blog-editor .note-editor .note-editing-area .note-editable{font-size:14px;line-height:1.8;color:#30394d}.blog-editor .note-toolbar{background:#f8f9fc;border-bottom:1px solid #e9ecf3}.blog-editor .featured-preview{max-width:100%;max-height:220px;object-fit:cover;border-radius:9px}.blog-editor .sticky-save{position:sticky;bottom:10px;z-index:20;background:rgba(255,255,255,.96);backdrop-filter:blur(8px);border:1px solid #e9ecf3;border-radius:10px;padding:11px 14px;box-shadow:0 8px 28px rgba(24,38,67,.11)}.blog-editor .custom-control-label{font-size:12px}.blog-editor .nav-tabs .nav-link{font-size:12px;font-weight:700}.blog-editor .social-label{font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.6px;color:#8892a7}
@media(max-width:767px){.blog-editor .card-body{padding:15px}.blog-editor .card-header{padding:15px}.blog-editor .section-header{height:auto;min-height:55px}.blog-editor .section-header h1{font-size:20px}.blog-editor .sticky-save{position:static}.blog-editor .note-editor .note-toolbar .note-btn-group{margin-bottom:4px}}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<?php
    $tagValue = old('tags', $post->exists ? $post->tags->pluck('name')->implode(', ') : '');
    $rawMetaDescription = old('meta_description', $post->exists ? $post->getRawOriginal('meta_description') : '');
    $publishedValue = old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\\TH:i') : '');
    $currentStatus = $post->status === 'scheduled' && $post->published_at && $post->published_at->isPast() ? 'published' : $post->status;
    $formAction = $post->exists ? route('admin.blog.posts.update', $post) : route('admin.blog.posts.store');
?>
<div class="main-content blog-editor">
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($post->exists ? 'Edit Post' : 'Create Post'); ?></h1>
            <div class="section-header-breadcrumb"><?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-list')): ?><div class="breadcrumb-item"><a href="<?php echo e(route('admin.blog.posts.index')); ?>">Blog Posts</a></div><?php endif; ?><div class="breadcrumb-item active"><?php echo e($post->exists ? 'Edit' : 'New'); ?></div></div>
        </div>
        <?php if($errors->any()): ?><div class="alert alert-danger"><strong>Please review the form.</strong><ul class="mb-0 mt-2"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div><?php endif; ?>
        <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>

        <form id="blog-post-form" action="<?php echo e($formAction); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php if($post->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header"><h4><i class="fas fa-pen-nib mr-2 text-primary"></i>Post content</h4></div>
                        <div class="card-body">
                            <div class="form-group"><label for="title">Post title <span class="text-danger">*</span></label><input id="title" name="title" value="<?php echo e(old('title', $post->title)); ?>" class="form-control form-control-lg" maxlength="255" required placeholder="Write a clear, helpful title"><small class="form-text text-muted">Use one clear H1 title. Search engines and readers should understand the topic immediately.</small></div>
                            <div class="form-group"><label for="slug">URL slug</label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><?php echo e(url('/blog')); ?>/</span></div><input id="slug" name="slug" value="<?php echo e(old('slug', $post->slug)); ?>" class="form-control" maxlength="190" placeholder="your-post-url"></div><small class="form-text text-muted">Keep it short, readable and include the main topic. Avoid changing a published slug unless necessary.</small></div>
                            <div class="form-group"><label for="excerpt">Excerpt / Introduction</label><textarea id="excerpt" name="excerpt" rows="3" maxlength="500" class="form-control" placeholder="A short summary shown on blog cards and search previews"><?php echo e(old('excerpt', $post->excerpt)); ?></textarea></div>
                            <div class="form-group mb-0"><label for="post-content">Main content <span class="text-danger">*</span></label><textarea id="post-content" name="content"><?php echo e(old('content', $post->content)); ?></textarea><small class="form-text text-muted">Use descriptive H2/H3 headings, concise paragraphs, helpful internal links and trustworthy external references.</small></div>
                        </div>
                    </div>

                    <div class="card" id="seo-settings">
                        <div class="card-header d-flex justify-content-between align-items-center"><h4><i class="fas fa-search mr-2 text-success"></i>SEO optimization</h4><span class="badge badge-light">Yoast SEO-style analysis</span></div>
                        <div class="card-body">
                            <div class="form-group"><label for="focus_keyphrase">Focus keyphrase</label><input id="focus_keyphrase" name="focus_keyphrase" class="form-control" value="<?php echo e(old('focus_keyphrase', $post->focus_keyphrase)); ?>" placeholder="e.g. effective study techniques"><small class="form-text text-muted">Choose the main search phrase this article should answer.</small></div>
                            <div class="form-group"><label for="keyphrase_synonyms">Keyphrase synonyms / related phrases</label><input id="keyphrase_synonyms" name="keyphrase_synonyms" class="form-control" value="<?php echo e(old('keyphrase_synonyms', $post->keyphrase_synonyms)); ?>" placeholder="study tips, learning strategies, study habits"><small class="form-text text-muted">Separate related phrases with commas. Use naturally in the article.</small></div>
                            <div class="form-row">
                                <div class="form-group col-md-6"><label for="seo_title">SEO title</label><input id="seo_title" name="seo_title" maxlength="255" class="form-control" value="<?php echo e(old('seo_title', $post->exists ? $post->getRawOriginal('seo_title') : '')); ?>" placeholder="Search result title"><div id="seo-title-count" class="counter mt-1">0 / 60 characters</div></div>
                                <div class="form-group col-md-6"><label for="meta_description">Meta description</label><textarea id="meta_description" name="meta_description" rows="3" maxlength="320" class="form-control" placeholder="Summarize the page in a compelling way"><?php echo e($rawMetaDescription); ?></textarea><div id="meta-desc-count" class="counter mt-1">0 / 155 characters</div></div>
                            </div>
                            <div class="form-group"><label>Google search preview</label><div class="seo-preview"><div class="preview-url"><?php echo e(config('app.url')); ?>/blog/<span id="preview-slug"><?php echo e($post->slug ?: 'your-post-url'); ?></span></div><span class="preview-title" id="preview-title"><?php echo e($post->seo_title ?: ($post->title ?: 'Your SEO title will appear here')); ?></span><div class="preview-desc" id="preview-desc"><?php echo e($post->meta_description ?: 'Your meta description will appear here. Write a clear summary to encourage useful clicks.'); ?></div></div></div>
                            <div class="row mt-4">
                                <div class="col-md-6 mb-3"><div class="analysis-panel h-100"><h5><i class="fas fa-chart-line mr-1 text-success"></i> SEO analysis</h5><div class="analysis-score"><div id="seo-score-circle" class="score-circle">0/100</div><div class="flex-grow-1"><strong id="seo-score-label" class="d-block">Needs analysis</strong><small class="text-muted">Updates while you write</small><div class="score-track mt-2"><div id="seo-score-fill" class="score-fill"></div></div></div></div><ul class="analysis-list" id="seo-analysis-list"><li>Enter a focus keyphrase to begin.</li></ul></div></div>
                                <div class="col-md-6 mb-3"><div class="analysis-panel h-100"><h5><i class="fas fa-book-reader mr-1 text-info"></i> Readability analysis</h5><div class="analysis-score"><div id="readability-score-circle" class="score-circle">0/100</div><div><strong id="readability-score-label" class="d-block">Needs analysis</strong><small class="text-muted">Content structure and clarity</small></div></div><ul class="analysis-list" id="readability-analysis-list"><li>Write your article to see readability feedback.</li></ul></div></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><h4><i class="fab fa-facebook mr-2 text-primary"></i>Social appearance</h4></div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist"><li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#facebook-tab" role="tab">Facebook / Open Graph</a></li><li class="nav-item"><a class="nav-link" data-toggle="tab" href="#twitter-tab" role="tab">X / Twitter</a></li></ul>
                            <div class="tab-content pt-4">
                                <div class="tab-pane fade show active" id="facebook-tab" role="tabpanel">
                                    <div class="form-group"><label>Social title</label><input name="og_title" id="og_title" class="form-control" maxlength="255" value="<?php echo e(old('og_title', $post->og_title)); ?>" placeholder="Leave blank to use SEO title"></div>
                                    <div class="form-group"><label>Social description</label><textarea name="og_description" class="form-control" rows="2" maxlength="320" placeholder="Leave blank to use meta description"><?php echo e(old('og_description', $post->og_description)); ?></textarea></div>
                                    <div class="form-group mb-0"><label>Social image URL</label><input name="og_image" class="form-control" type="url" value="<?php echo e(old('og_image', $post->og_image)); ?>" placeholder="https://example.com/social-image.jpg"><small class="form-text text-muted">Recommended: 1200 × 630 px. Leave blank to use the featured image.</small></div>
                                </div>
                                <div class="tab-pane fade" id="twitter-tab" role="tabpanel">
                                    <div class="form-group"><label>Twitter / X title</label><input name="twitter_title" class="form-control" maxlength="255" value="<?php echo e(old('twitter_title', $post->twitter_title)); ?>" placeholder="Leave blank to use SEO title"></div>
                                    <div class="form-group"><label>Twitter / X description</label><textarea name="twitter_description" class="form-control" rows="2" maxlength="320" placeholder="Leave blank to use meta description"><?php echo e(old('twitter_description', $post->twitter_description)); ?></textarea></div>
                                    <div class="form-group mb-0"><label>Twitter / X image URL</label><input name="twitter_image" class="form-control" type="url" value="<?php echo e(old('twitter_image', $post->twitter_image)); ?>" placeholder="https://example.com/social-image.jpg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header"><h4>Publish</h4></div>
                        <div class="card-body">
                            <div class="form-group"><label for="status">Post status</label><select id="status" name="status" class="form-control"><option value="draft" <?php if(old('status',$currentStatus)==='draft'): echo 'selected'; endif; ?>>Draft</option><option value="published" <?php if(old('status',$currentStatus)==='published'): echo 'selected'; endif; ?>>Publish now</option><option value="scheduled" <?php if(old('status',$currentStatus)==='scheduled'): echo 'selected'; endif; ?>>Schedule</option></select></div>
                            <div class="form-group"><label for="published_at">Publish date &amp; time</label><input type="datetime-local" id="published_at" name="published_at" value="<?php echo e($publishedValue); ?>" class="form-control"><small class="form-text text-muted">For scheduled posts, choose a future date and time. Scheduled posts stay hidden until then.</small></div>
                            <div class="form-group"><label for="category_id">Category</label><select id="category_id" name="category_id" class="form-control"><option value="">Uncategorized</option><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>" <?php if((string)old('category_id',$post->category_id)===(string)$category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select><small class="form-text"><?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-list')): ?><a href="<?php echo e(route('admin.blog.categories.index')); ?>" target="_blank">Manage categories</a><?php else: ?> Choose from the existing categories.<?php endif; ?></small></div>
                            <div class="form-group"><label for="tags">Tags</label><input id="tags" name="tags" class="form-control" value="<?php echo e($tagValue); ?>" placeholder="Laravel, Study Tips, Productivity"><small class="form-text text-muted">Comma-separated; up to 20 tags.</small></div>
                            <div class="custom-control custom-checkbox mb-2"><input type="hidden" name="is_featured" value="0"><input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" <?php if(old('is_featured',$post->is_featured)): echo 'checked'; endif; ?>><label class="custom-control-label" for="is_featured">Featured post</label></div>
                            <div class="custom-control custom-checkbox"><input type="hidden" name="is_cornerstone" value="0"><input type="checkbox" class="custom-control-input" id="is_cornerstone" name="is_cornerstone" value="1" <?php if(old('is_cornerstone',$post->is_cornerstone)): echo 'checked'; endif; ?>><label class="custom-control-label" for="is_cornerstone">Cornerstone content</label></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><h4>Featured image</h4></div>
                        <div class="card-body">
                            <?php if($post->featured_image): ?><img src="<?php echo e(asset('storage/'.$post->featured_image)); ?>" class="featured-preview mb-3 d-block" alt="Current featured image"><?php endif; ?>
                            <div class="form-group"><input type="file" id="featured_image" name="featured_image" class="form-control-file" accept="image/jpeg,image/png,image/webp,image/avif"><small class="form-text text-muted">JPG, PNG, WebP or AVIF. Max 5 MB.</small></div>
                            <div class="form-group"><label for="featured_image_alt">Image alternative text (ALT)</label><input id="featured_image_alt" name="featured_image_alt" class="form-control" maxlength="255" value="<?php echo e(old('featured_image_alt',$post->featured_image_alt)); ?>" placeholder="Describe the image clearly"></div>
                            <?php if($post->featured_image): ?><div class="custom-control custom-checkbox"><input type="checkbox" name="remove_featured_image" value="1" id="remove_featured_image" class="custom-control-input" <?php if(old('remove_featured_image')): echo 'checked'; endif; ?>><label for="remove_featured_image" class="custom-control-label text-danger">Remove current image</label></div><?php endif; ?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><h4>Advanced SEO</h4></div>
                        <div class="card-body">
                            <div class="form-group"><label for="canonical_url">Canonical URL</label><input type="url" id="canonical_url" name="canonical_url" class="form-control" value="<?php echo e(old('canonical_url',$post->canonical_url)); ?>" placeholder="Leave blank to use the post URL"><small class="form-text text-muted">Use only when this content has a preferred original URL.</small></div>
                            <div class="form-group"><label for="schema_type">Schema type</label><select id="schema_type" name="schema_type" class="form-control"><?php $__currentLoopData = ['BlogPosting'=>'Blog post','Article'=>'Article','NewsArticle'=>'News article']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value); ?>" <?php if(old('schema_type',$post->schema_type ?: 'BlogPosting')===$value): echo 'selected'; endif; ?>><?php echo e($label); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
                            <div class="custom-control custom-checkbox mb-2"><input type="hidden" name="robots_index" value="0"><input type="checkbox" class="custom-control-input" id="robots_index" name="robots_index" value="1" <?php if(old('robots_index',$post->robots_index ?? true)): echo 'checked'; endif; ?>><label class="custom-control-label" for="robots_index">Allow search engines to index</label></div>
                            <div class="custom-control custom-checkbox mb-3"><input type="hidden" name="robots_follow" value="0"><input type="checkbox" class="custom-control-input" id="robots_follow" name="robots_follow" value="1" <?php if(old('robots_follow',$post->robots_follow ?? true)): echo 'checked'; endif; ?>><label class="custom-control-label" for="robots_follow">Allow search engines to follow links</label></div>
                            <div class="alert alert-light small mb-0">Noindex removes this post from search indexing. Nofollow asks crawlers not to follow links on the post.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sticky-save d-flex align-items-center justify-content-between flex-wrap">
                <?php if(auth()->user()->can('blog-list')): ?><a href="<?php echo e(route('admin.blog.posts.index')); ?>" class="btn btn-light">Cancel</a><?php else: ?><a href="<?php echo e(route('dashboard')); ?>" class="btn btn-light">Back to dashboard</a><?php endif; ?>
                <div class="d-flex align-items-center flex-wrap" style="gap:8px">
                    <?php if($post->exists && ($post->status==='published' || ($post->status==='scheduled' && $post->published_at && $post->published_at->isPast()))): ?><a href="<?php echo e(route('blog.show',$post->slug)); ?>" class="btn btn-outline-primary" target="_blank"><i class="fas fa-external-link-alt mr-1"></i> View post</a><?php endif; ?>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> <?php echo e($post->exists ? 'Update post' : 'Save post'); ?></button>
                </div>
            </div>
        </form>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/library/summernote/dist/summernote-bs4.min.js')); ?>"></script>
<script>
(function ($) {
    'use strict';
    const $editor = $('#post-content');
    const $title = $('#title'), $slug = $('#slug'), $focus = $('#focus_keyphrase');
    const $seoTitle = $('#seo_title'), $meta = $('#meta_description'), $alt = $('#featured_image_alt');
    const $synonyms = $('#keyphrase_synonyms');
    let slugWasEdited = Boolean($slug.val());

    $editor.summernote({
        height: 430,
        minHeight: 260,
        placeholder: 'Start writing a useful, well-structured article...',
        dialogsInBody: true,
        toolbar: [
            ['style', ['style']], ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']], ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']],
            ['insert', ['link', 'picture', 'hr']], ['view', ['fullscreen', 'codeview']]
        ],
        callbacks: {
            onChange: updateAnalysis,
            onImageUpload: function (files) {
                const file = files[0];
                if (!file) return;
                const data = new FormData();
                data.append('image', file);
                data.append('_token', '<?php echo e(csrf_token()); ?>');
                $.ajax({
                    url: '<?php echo e(route('admin.blog.upload-inline-image')); ?>',
                    method: 'POST', data: data, processData: false, contentType: false,
                    success: function (result) { $editor.summernote('insertImage', result.url); },
                    error: function (xhr) { alert(xhr.responseJSON?.message || 'Image upload failed. Please try again.'); }
                });
            }
        }
    });

    function plainText(html) {
        return $('<div>').html(html || '').text().replace(/\s+/g, ' ').trim();
    }
    function slugify(value) {
        return (value || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '').slice(0, 190);
    }
    function setCount($target, count, ideal, max) {
        $target.text(count + ' / ' + ideal + ' characters').removeClass('good bad');
        if (count >= Math.max(ideal - 15, 1) && count <= max) $target.addClass('good');
        else if (count > max) $target.addClass('bad');
    }
    function renderChecks(target, checks) {
        const $list = $(target).empty();
        checks.forEach(function (check) {
            $('<li>').addClass(check.ok ? 'pass' : 'fail')
                .append($('<i>').addClass('fas ' + (check.ok ? 'fa-check-circle' : 'fa-info-circle')))
                .append($('<span>').text(check.text)).appendTo($list);
        });
    }
    function scorePanel(circle, fill, label, value, title) {
        $(circle).text(value + '/100'); $(fill).css('width', value + '%'); $(label).text(title);
        $(circle).css({background: value >= 75 ? '#e8f7ef' : (value >= 45 ? '#fff5e5' : '#fff0ee'), color: value >= 75 ? '#21875a' : (value >= 45 ? '#b97819' : '#bd5149')});
    }
    function updateAnalysis() {
        const title = $title.val().trim();
        const slug = $slug.val().trim();
        const key = $focus.val().trim().toLowerCase();
        const synonyms = $synonyms.val().split(',').map(value => value.trim().toLowerCase()).filter(Boolean);
        const seoTitle = ($seoTitle.val().trim() || title);
        const meta = $meta.val().trim();
        const html = $editor.summernote('code');
        const text = plainText(html);
        const words = text ? text.split(/\s+/).length : 0;
        const lower = text.toLowerCase();
        const headings = $('<div>').html(html).find('h2,h3').map(function(){return $(this).text().toLowerCase();}).get().join(' ');
        const contentImages = $('<div>').html(html).find('img').toArray();
        const imagesAlt = contentImages.length ? contentImages.every(function(img){return Boolean($(img).attr('alt'));}) : Boolean($alt.val().trim());
        const firstWords = lower.split(/\s+/).slice(0, 100).join(' ');
        const density = key ? ((lower.split(key).length - 1) * key.split(/\s+/).length / Math.max(words,1)) * 100 : 0;
        const slugKey = slugify(key);
        const slugCheck = !key || !slugKey || slug.toLowerCase().includes(slugKey);
        const synonymUsed = synonyms.some(phrase => lower.includes(phrase));
        const outbound = $('<div>').html(html).find('a[href^="http"]').length > 0;
        const internal = $('<div>').html(html).find('a[href^="/"]').length > 0 || $('<div>').html(html).find('a[href*="' + location.host + '"]').length > 0;
        const checks = [
            {ok: !!key, text: key ? 'Focus keyphrase is set.' : 'Add a focus keyphrase.'},
            {ok: !!key && seoTitle.toLowerCase().includes(key), text: 'Use the keyphrase in the SEO title.'},
            {ok: !!key && slugCheck, text: 'Use a short, readable URL slug that reflects the main topic.'},
            {ok: synonyms.length === 0 || synonymUsed, text: 'Use a related keyphrase synonym naturally where relevant.'},
            {ok: !!key && meta.toLowerCase().includes(key), text: 'Include the keyphrase in the meta description.'},
            {ok: !!key && firstWords.includes(key), text: 'Mention the keyphrase near the beginning of the content.'},
            {ok: !!key && headings.includes(key), text: 'Use the keyphrase or a close variation in a subheading.'},
            {ok: !!key && ($alt.val().toLowerCase().includes(key) || imagesAlt), text: 'Add descriptive image ALT text; include the keyphrase where natural.'},
            {ok: words >= 300, text: 'Aim for at least 300 useful words (current: ' + words + ').'},
            {ok: !key || (density >= 0.5 && density <= 2.5), text: 'Keep keyphrase usage natural (estimated density: ' + density.toFixed(1) + '%).'},
            {ok: outbound, text: 'Add a relevant, trustworthy external link.'},
            {ok: internal, text: 'Add at least one useful internal link.'},
            {ok: seoTitle.length >= 30 && seoTitle.length <= 60, text: 'Keep the SEO title around 30–60 characters (' + seoTitle.length + ').'},
            {ok: meta.length >= 120 && meta.length <= 160, text: 'Keep the meta description around 120–160 characters (' + meta.length + ').'}
        ];
        const passed = checks.filter(c => c.ok).length;
        const seoScore = Math.round((passed / checks.length) * 100);
        scorePanel('#seo-score-circle', '#seo-score-fill', '#seo-score-label', seoScore, seoScore >= 80 ? 'Good SEO' : seoScore >= 55 ? 'Needs improvement' : 'Needs work');
        renderChecks('#seo-analysis-list', checks);

        const sentences = text.split(/[.!?]+/).map(s => s.trim()).filter(Boolean);
        const avgSentence = sentences.length ? sentences.reduce((sum, s) => sum + s.split(/\s+/).length, 0) / sentences.length : 0;
        const paragraphs = $('<div>').html(html).find('p').map(function(){return $(this).text().trim();}).get().filter(Boolean);
        const avgParagraph = paragraphs.length ? paragraphs.reduce((sum, p) => sum + p.split(/\s+/).length, 0) / paragraphs.length : 0;
        const transitions = ['however','therefore','also','because','first','second','finally','for example','for instance','in addition','as a result','meanwhile','although','moreover','পরিশেষে','তাছাড়া','তবে','অন্যদিকে'];
        const transitionCount = sentences.filter(s => transitions.some(t => s.toLowerCase().includes(t))).length;
        const transitionRatio = sentences.length ? transitionCount / sentences.length : 0;
        const readabilityChecks = [
            {ok: words >= 150, text: 'Write enough detail to fully answer the reader’s question.'},
            {ok: avgSentence > 0 && avgSentence <= 20, text: 'Keep the average sentence length near 20 words (now ' + avgSentence.toFixed(1) + ').'},
            {ok: paragraphs.length > 0 && avgParagraph <= 100, text: 'Break long paragraphs into shorter, scannable blocks.'},
            {ok: $('<div>').html(html).find('h2,h3').length >= 2, text: 'Use at least two descriptive subheadings.'},
            {ok: sentences.length > 0 && transitionRatio >= 0.2, text: 'Use transition words to connect ideas naturally.'},
            {ok: $('<div>').html(html).find('ul,ol').length > 0, text: 'Use lists where they make steps or key points easier to scan.'}
        ];
        const readabilityScore = Math.round(readabilityChecks.filter(c => c.ok).length / readabilityChecks.length * 100);
        scorePanel('#readability-score-circle', null, '#readability-score-label', readabilityScore, readabilityScore >= 80 ? 'Easy to scan' : readabilityScore >= 50 ? 'Could improve' : 'Needs structure');
        renderChecks('#readability-analysis-list', readabilityChecks);

        $('#preview-title').text(seoTitle || 'Your SEO title will appear here');
        $('#preview-desc').text(meta || 'Your meta description will appear here. Write a clear summary to encourage useful clicks.');
        $('#preview-slug').text(slug || 'your-post-url');
        setCount($('#seo-title-count'), seoTitle.length, 60, 60);
        setCount($('#meta-desc-count'), meta.length, 155, 160);
    }

    $title.on('input', function () {
        if (!$seoTitle.val().trim()) $seoTitle.val($(this).val());
        if (!slugWasEdited) $slug.val(slugify($(this).val()));
        updateAnalysis();
    });
    $slug.on('input', function () { slugWasEdited = true; updateAnalysis(); });
    $seoTitle.add($meta).add($focus).add($alt).add($synonyms).on('input', updateAnalysis);
    $editor.on('summernote.change', updateAnalysis);
    $('#blog-post-form').on('submit', function () {
        if (!$seoTitle.val().trim()) $seoTitle.val($title.val().trim());
        if (!$slug.val().trim()) $slug.val(slugify($title.val()));
    });
    updateAnalysis();
})(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/backend/blog/posts/form.blade.php ENDPATH**/ ?>