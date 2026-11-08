<?php $__env->startSection('title', isset($category) ? $category->name . ' Articles' : 'The Campus Notes Blog'); ?>
<?php $__env->startSection('meta_title', isset($category) ? (($category->seo_title ?: $category->name . ' Articles') . ' | Campus Notes') : 'Campus Notes Blog | Study smarter, learn better'); ?>
<?php $__env->startSection('meta_description', isset($category) ? ($category->meta_description ?: $category->description ?: 'Explore articles in ' . $category->name . ' from Campus Notes.') : 'Explore practical study tips, productivity guides, learning strategies and student resources on the Campus Notes blog.'); ?>
<?php $__env->startSection('canonical_url', isset($category) ? (route('blog.category', $category->slug) . ($posts->currentPage() > 1 ? '?page=' . $posts->currentPage() : '')) : (route('blog.index') . ($posts->currentPage() > 1 ? '?page=' . $posts->currentPage() : ''))); ?>
<?php $__env->startSection('meta_robots', request('q') ? 'noindex,follow' : 'index,follow'); ?>
<?php $__env->startSection('og_title', isset($category) ? ($category->seo_title ?: $category->name . ' | Campus Notes') : 'Campus Notes Blog'); ?>
<?php $__env->startSection('og_description', isset($category) ? ($category->meta_description ?: ($category->description ?: 'Explore articles from this Campus Notes topic.')) : 'Practical ideas and guides to help you study smarter and stay organized.'); ?>

<?php $__env->startPush('styles'); ?><link rel="stylesheet" href="<?php echo e(asset('frontend/css/blog.css')); ?>"><?php $__env->stopPush(); ?>

<?php $__env->startPush('seo'); ?>
<?php
    $collectionSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => isset($category) ? $category->name . ' Articles' : 'Campus Notes Blog',
        'description' => isset($category) ? ($category->meta_description ?: $category->description) : 'Practical study advice, learning strategies and student resources.',
        'url' => url()->current(),
        'isPartOf' => ['@type' => 'Blog', 'name' => 'Campus Notes Blog', 'url' => route('blog.index')],
    ];
?>
<script type="application/ld+json"><?php echo json_encode($collectionSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE, 512) ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="blog-hero">
    <div class="cn-container">
        <div class="blog-hero-copy">
            <span class="blog-eyebrow"><i></i> THE CAMPUS NOTES JOURNAL</span>
            <h1><?php if(isset($category)): ?><?php echo e($category->name); ?><?php else: ?> Ideas for a <span>smarter</span> student life <?php endif; ?></h1>
            <p><?php echo e(isset($category) ? ($category->description ?: 'Explore useful articles and practical guides from this topic.') : 'Practical study advice, thoughtful learning strategies and fresh ideas to make every study session count.'); ?></p>
            <form action="<?php echo e(route('blog.index')); ?>" method="GET" class="blog-search">
                <i class="fas fa-search" aria-hidden="true"></i><input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search articles, study tips, productivity..." aria-label="Search blog articles"><button type="submit">Search</button>
            </form>
            <div class="blog-hero-meta"><span><i class="far fa-newspaper"></i> <?php echo e($posts->total()); ?> <?php echo e(Str::plural('article', $posts->total())); ?></span><span><i class="far fa-clock"></i> Fresh ideas for everyday learning</span></div>
        </div>
        <div class="blog-hero-art" aria-hidden="true"><div class="blog-art-ring ring-a"></div><div class="blog-art-ring ring-b"></div><div class="blog-art-paper"><span class="paper-label">STUDENT NOTES</span><strong>Learn.<br>Grow.<br><em>Repeat.</em></strong><i></i><i></i><i></i><b>✦</b></div><span class="blog-art-orb orb-a">✳</span><span class="blog-art-orb orb-b">✦</span></div>
    </div>
</section>

<section class="blog-main cn-container">
    <div class="blog-category-row">
        <a href="<?php echo e(route('blog.index')); ?>" class="blog-chip <?php echo e(!isset($category) && !request('category') ? 'active' : ''); ?>">All articles</a>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($blogCategory->posts_count > 0): ?><a href="<?php echo e(route('blog.category',$blogCategory->slug)); ?>" class="blog-chip <?php echo e(isset($category) && $category->id === $blogCategory->id ? 'active' : ''); ?>"><?php echo e($blogCategory->name); ?> <small><?php echo e($blogCategory->posts_count); ?></small></a><?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if(isset($featuredPost) && $featuredPost && !request('q') && $posts->currentPage() === 1): ?>
    <a href="<?php echo e(route('blog.show',$featuredPost->slug)); ?>" class="blog-featured-card">
        <div class="blog-featured-image">
            <?php if($featuredPost->featured_image): ?><img src="<?php echo e(asset('storage/'.$featuredPost->featured_image)); ?>" alt="<?php echo e($featuredPost->featured_image_alt ?: $featuredPost->title); ?>" loading="eager"><?php else: ?><div class="blog-image-placeholder"><span>CN</span></div><?php endif; ?>
            <span class="blog-featured-label">EDITOR'S PICK</span>
        </div>
        <div class="blog-featured-copy"><div class="blog-card-meta"><span><?php echo e($featuredPost->category?->name ?? 'Featured'); ?></span><i></i><time datetime="<?php echo e($featuredPost->published_at->toDateString()); ?>"><?php echo e($featuredPost->published_at->format('M d, Y')); ?></time></div><h2><?php echo e($featuredPost->title); ?></h2><p><?php echo e($featuredPost->excerpt ?: Str::limit(strip_tags($featuredPost->content), 180)); ?></p><div class="blog-read-link">Read featured article <span>↗</span></div><div class="blog-author-line"><span class="blog-author-avatar"><?php echo e(strtoupper(substr($featuredPost->author?->name ?? 'C',0,1))); ?></span><span>By <?php echo e($featuredPost->author?->name ?? 'Campus Notes'); ?></span><span class="blog-read-time"><i class="far fa-clock"></i> <?php echo e($featuredPost->reading_time); ?> min read</span></div></div>
    </a>
    <?php endif; ?>

    <div class="blog-list-heading"><div><span class="blog-section-kicker">DISCOVER &amp; LEARN</span><h2><?php echo e(request('q') ? 'Search results' : (isset($category) ? 'Explore this topic' : 'Latest articles')); ?></h2></div><?php if(request('q')): ?><span class="blog-result-label">Results for “<?php echo e(request('q')); ?>”</span><?php endif; ?></div>
    <div class="blog-post-grid">
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if(!(isset($featuredPost) && $featuredPost && $posts->currentPage() === 1 && $post->id === $featuredPost->id)): ?>
            <article class="blog-card">
                <a class="blog-card-image" href="<?php echo e(route('blog.show',$post->slug)); ?>">
                    <?php if($post->featured_image): ?><img src="<?php echo e(asset('storage/'.$post->featured_image)); ?>" alt="<?php echo e($post->featured_image_alt ?: $post->title); ?>" loading="lazy"><?php else: ?><div class="blog-image-placeholder"><span>CN</span><small>Campus Notes</small></div><?php endif; ?>
                    <?php if($post->is_featured): ?><span class="blog-card-featured">Featured</span><?php endif; ?>
                </a>
                <div class="blog-card-content"><div class="blog-card-meta"><span><?php echo e($post->category?->name ?? 'Campus Notes'); ?></span><i></i><time datetime="<?php echo e($post->published_at->toDateString()); ?>"><?php echo e($post->published_at->format('M d, Y')); ?></time></div><h3><a href="<?php echo e(route('blog.show',$post->slug)); ?>"><?php echo e($post->title); ?></a></h3><p><?php echo e($post->excerpt ?: Str::limit(strip_tags($post->content), 130)); ?></p><div class="blog-card-bottom"><a href="<?php echo e(route('blog.show',$post->slug)); ?>">Read article <span>→</span></a><small><?php echo e($post->reading_time); ?> min read</small></div></div>
            </article>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="blog-empty"><div class="blog-empty-icon"><i class="far fa-file-alt"></i></div><h3>No articles found</h3><p><?php echo e(request('q') ? 'Try another search phrase or browse all articles.' : 'There are no published posts in this category yet. Check back soon.'); ?></p><a class="cn-button cn-button-primary" href="<?php echo e(route('blog.index')); ?>">Browse all articles</a></div>
        <?php endif; ?>
    </div>
    <?php if($posts->hasPages()): ?><div class="blog-pagination"><?php echo e($posts->links()); ?></div><?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/blog/index.blade.php ENDPATH**/ ?>