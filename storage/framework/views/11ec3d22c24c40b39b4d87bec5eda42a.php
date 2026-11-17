<?php $__env->startSection('title', 'Blog Posts'); ?>

<?php $__env->startPush('style'); ?>
<style>
.blog-admin .card{border-radius:12px}.blog-admin .stat-card{border:0;box-shadow:0 5px 24px rgba(24,38,67,.06)}.blog-admin .stat-number{font-size:25px;font-weight:800;color:#26324b}.blog-admin .table td{vertical-align:middle}.blog-admin .post-thumb{width:54px;height:44px;object-fit:cover;border-radius:8px;background:#f1f3f8}.blog-admin .post-title{font-weight:700;color:#26324b}.blog-admin .post-slug{font-size:11px;color:#9098aa;display:block;max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.blog-admin .badge{font-weight:700}.blog-admin .filter-form{display:flex;gap:8px;flex-wrap:wrap}.blog-admin .filter-form .form-control{min-width:145px}.blog-admin .empty-state{padding:50px 20px;text-align:center;color:#8a93a8}
@media(max-width:575px){.blog-admin .section-header{flex-wrap:wrap;height:auto;gap:10px}.blog-admin .section-header h1{font-size:20px}.blog-admin .filter-form>*{width:100%}.blog-admin .filter-form .form-control{min-width:0}.blog-admin .table-responsive{font-size:12px}.blog-admin .post-thumb{width:42px;height:38px}}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content blog-admin">
    <section class="section">
        <div class="section-header">
            <h1><i class="far fa-newspaper mr-2 text-primary"></i>Blog Posts</h1>
            <div class="section-header-button ml-auto">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-create')): ?><a href="<?php echo e(route('admin.blog.posts.create')); ?>" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> New Post</a><?php endif; ?>
            </div>
        </div>

        <?php if(session('success')): ?><div class="alert alert-success alert-has-icon"><div class="alert-icon"><i class="far fa-check-circle"></i></div><div class="alert-body"><?php echo e(session('success')); ?></div></div><?php endif; ?>

        <div class="row">
            <?php $__currentLoopData = ['all'=>'All Posts','published'=>'Published','scheduled'=>'Scheduled','draft'=>'Drafts','pending'=>'Pending Review']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-3"><div class="card stat-card"><div class="card-body py-3"><div class="text-muted text-small"><?php echo e($label); ?></div><div class="stat-number"><?php echo e($stats[$key]); ?></div></div></div></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="card">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <h4>Content library</h4>
                <a href="<?php echo e(route('admin.blog.categories.index')); ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-folder mr-1"></i> Manage categories</a>
            </div>
            <div class="card-body">
                <form method="GET" class="filter-form mb-4">
                    <input type="search" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="Search title, slug or keyphrase">
                    <select name="status" class="form-control"><option value="">All statuses</option><?php $__currentLoopData = ['pending'=>'Pending Review','published'=>'Published','scheduled'=>'Scheduled','draft'=>'Draft']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value); ?>" <?php if(request('status')===$value): echo 'selected'; endif; ?>><?php echo e($label); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
                    <select name="category" class="form-control"><option value="">All categories</option><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>" <?php if((string)request('category')===(string)$category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <a href="<?php echo e(route('admin.blog.posts.index')); ?>" class="btn btn-light">Reset</a>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead><tr><th style="min-width:280px">Post</th><th>Author</th><th>Category</th><th>Status</th><th>SEO</th><th>Updated</th><th class="text-right">Actions</th></tr></thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if($post->featured_image): ?><img src="<?php echo e(asset('storage/'.$post->featured_image)); ?>" alt="" class="post-thumb mr-3"><?php else: ?><div class="post-thumb mr-3 d-flex align-items-center justify-content-center"><i class="far fa-image text-muted"></i></div><?php endif; ?>
                                        <div><?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-edit')): ?><a class="post-title" href="<?php echo e(route('admin.blog.posts.edit',$post)); ?>"><?php echo e($post->title); ?></a><?php else: ?><strong class="post-title"><?php echo e($post->title); ?></strong><?php endif; ?><span class="post-slug">/<?php echo e($post->slug); ?></span><?php if($post->is_cornerstone): ?><span class="badge badge-info mt-1">Cornerstone</span><?php endif; ?></div>
                                    </div>
                                </td>
                                <td><?php echo e($post->author?->name ?? '—'); ?></td>
                                <td><?php echo e($post->category?->name ?? 'Uncategorized'); ?></td>
                                <td>
                                    <?php if($post->status==='published' || ($post->status==='scheduled' && $post->published_at && $post->published_at->isPast())): ?><span class="badge badge-success">Published</span>
                                    <?php elseif($post->status==='scheduled'): ?><span class="badge badge-warning">Scheduled</span>
                                    <?php elseif($post->status==='pending'): ?><span class="badge badge-info">Pending Review</span>
                                    <?php else: ?><span class="badge badge-secondary">Draft</span><?php endif; ?>
                                </td>
                                <td><span class="text-muted small"><?php echo e($post->focus_keyphrase ?: 'No keyphrase'); ?></span><br><span class="text-muted small"><?php echo e($post->robots_index ? 'Index' : 'Noindex'); ?> / <?php echo e($post->robots_follow ? 'Follow' : 'Nofollow'); ?></span></td>
                                <td class="text-muted small"><?php echo e($post->updated_at->format('d M Y')); ?></td>
                                <td class="text-right text-nowrap">
                                    <?php if($post->status==='published' || ($post->status==='scheduled' && $post->published_at && $post->published_at->isPast())): ?><a href="<?php echo e(route('blog.show',$post->slug)); ?>" target="_blank" class="btn btn-sm btn-light" title="View"><i class="fas fa-external-link-alt"></i></a><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-edit')): ?>
                                    <?php if($post->status==='pending'): ?><form action="<?php echo e(route('admin.blog.posts.approve',$post)); ?>" method="POST" class="d-inline" data-admin-confirm-title="Approve and publish blog?" data-admin-confirm="Approve and publish this blog post? It will become visible on the website."><?php echo csrf_field(); ?><button class="btn btn-sm btn-success" type="submit">Approve</button></form><form action="<?php echo e(route('admin.blog.posts.reject',$post)); ?>" method="POST" class="d-inline" data-admin-confirm-title="Reject this blog?" data-admin-confirm="Reject this blog post? It will be returned to drafts."><?php echo csrf_field(); ?><button class="btn btn-sm btn-warning" type="submit">Reject</button></form><?php endif; ?>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-edit')): ?><a href="<?php echo e(route('admin.blog.posts.edit',$post)); ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-delete')): ?><form action="<?php echo e(route('admin.blog.posts.destroy',$post)); ?>" method="POST" class="d-inline" data-admin-confirm-title="Delete blog post?" data-admin-confirm="Delete this blog post permanently? This action cannot be undone."><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button></form><?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="7"><div class="empty-state"><i class="far fa-newspaper fa-3x mb-3"></i><h5>No blog posts yet</h5><p>Create your first post and optimize it for search engines.</p><?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-create')): ?><a href="<?php echo e(route('admin.blog.posts.create')); ?>" class="btn btn-primary">Create first post</a><?php endif; ?></div></td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end"><?php echo e($posts->links()); ?></div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/backend/blog/posts/index.blade.php ENDPATH**/ ?>