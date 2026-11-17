<?php $__env->startSection('title', $post->title); ?>
<?php $__env->startSection('meta_title', $post->seo_title . ' | Campus Notes'); ?>
<?php $__env->startSection('meta_description', $post->meta_description); ?>
<?php $__env->startSection('canonical_url', $post->canonical_url ?: route('blog.show',$post->slug)); ?>
<?php $__env->startSection('meta_robots', ($post->robots_index ? 'index' : 'noindex') . ',' . ($post->robots_follow ? 'follow' : 'nofollow')); ?>
<?php $__env->startSection('og_type', 'article'); ?>
<?php $__env->startSection('og_title', $post->og_title ?: $post->seo_title); ?>
<?php $__env->startSection('og_description', $post->og_description ?: $post->meta_description); ?>
<?php $__env->startSection('og_image', $post->og_image ?: ($post->featured_image ? asset('storage/'.$post->featured_image) : '')); ?>
<?php $__env->startSection('twitter_title', $post->twitter_title ?: $post->seo_title); ?>
<?php $__env->startSection('twitter_description', $post->twitter_description ?: $post->meta_description); ?>
<?php $__env->startSection('twitter_image', $post->twitter_image ?: ($post->og_image ?: ($post->featured_image ? asset('storage/'.$post->featured_image) : ''))); ?>

<?php $__env->startPush('styles'); ?><link rel="stylesheet" href="<?php echo e(asset('frontend/css/blog.css')); ?>"><?php $__env->stopPush(); ?>

<?php $__env->startPush('seo'); ?>
<?php
    $articleSchema = [
        '@context' => 'https://schema.org',
        '@type' => $post->schema_type ?: 'BlogPosting',
        'headline' => $post->title,
        'description' => $post->meta_description,
        'keywords' => collect([$post->focus_keyphrase])->merge($post->tags->pluck('name'))->filter()->implode(', '),
        'datePublished' => $post->published_at?->toIso8601String(),
        'dateModified' => $post->updated_at?->toIso8601String(),
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $post->canonical_url ?: route('blog.show',$post->slug)],
        'author' => ['@type' => 'Person', 'name' => $post->author?->name ?: 'Campus Notes'],
        'publisher' => ['@type' => 'Organization', 'name' => 'Campus Notes'],
    ];
    if ($post->featured_image) $articleSchema['image'] = [asset('storage/'.$post->featured_image)];
    $breadcrumbSchema = ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('frontend.home')],
        ['@type'=>'ListItem','position'=>2,'name'=>'Blog','item'=>route('blog.index')],
        ['@type'=>'ListItem','position'=>3,'name'=>$post->title,'item'=>route('blog.show',$post->slug)],
    ]];
?>
<meta property="article:published_time" content="<?php echo e($post->published_at?->toIso8601String()); ?>">
<meta property="article:modified_time" content="<?php echo e($post->updated_at?->toIso8601String()); ?>">
<?php if($post->category): ?><meta property="article:section" content="<?php echo e($post->category->name); ?>"><?php endif; ?>
<?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><meta property="article:tag" content="<?php echo e($tag->name); ?>"><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script type="application/ld+json"><?php echo json_encode($articleSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE, 512) ?></script>
<script type="application/ld+json"><?php echo json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE, 512) ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="blog-single-top"><div class="cn-container"><div class="blog-breadcrumb"><a href="<?php echo e(route('frontend.home')); ?>">Home</a><span>/</span><a href="<?php echo e(route('blog.index')); ?>">Blog</a><?php if($post->category): ?><span>/</span><a href="<?php echo e(route('blog.category',$post->category->slug)); ?>"><?php echo e($post->category->name); ?></a><?php endif; ?></div>
    <div class="blog-single-heading"><?php if($post->category): ?><a class="blog-single-category" href="<?php echo e(route('blog.category',$post->category->slug)); ?>"><?php echo e($post->category->name); ?></a><?php endif; ?><h1><?php echo e($post->title); ?></h1><?php if($post->excerpt): ?><p class="blog-single-excerpt"><?php echo e($post->excerpt); ?></p><?php endif; ?>
        <div class="blog-single-byline"><span class="blog-author-avatar"><?php echo e(strtoupper(substr($post->author?->name ?? 'C',0,1))); ?></span><span>By <strong><?php echo e($post->author?->name ?? 'Campus Notes'); ?></strong></span><i></i><time datetime="<?php echo e($post->published_at->toIso8601String()); ?>"><?php echo e($post->published_at->format('F d, Y')); ?></time><i></i><span><i class="far fa-clock"></i> <?php echo e($post->reading_time); ?> min read</span></div>
    </div>
    <?php if($post->featured_image): ?><div class="blog-single-cover"><img src="<?php echo e(asset('storage/'.$post->featured_image)); ?>" alt="<?php echo e($post->featured_image_alt ?: $post->title); ?>"></div><?php endif; ?>
</div></section>

<section class="blog-article-layout cn-container">
    <article class="blog-article"><div class="blog-article-content"><?php echo $post->content; ?></div>
        <div class="blog-article-tags"><?php if($post->tags->isNotEmpty()): ?><strong>Topics:</strong><?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span><?php echo e($tag->name); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></div>
        <div class="blog-article-footer"><a href="<?php echo e(route('blog.index')); ?>" class="blog-back-link">← Back to all articles</a><span>Keep learning with Campus Notes</span></div>
    </article>
    <aside class="blog-article-aside"><div class="blog-aside-card"><span class="blog-section-kicker">KEEP EXPLORING</span><h3>Make every study session count.</h3><p>Discover more practical ideas and resources from Campus Notes.</p><a href="<?php echo e(route('blog.index')); ?>" class="cn-button cn-button-primary">Explore the blog <span>↗</span></a></div><div class="blog-aside-note"><i class="far fa-lightbulb"></i><p>Save useful ideas, revisit your notes and keep building better learning habits.</p></div></aside>
</section>

<?php if($relatedPosts->isNotEmpty()): ?><section class="blog-related"><div class="cn-container"><div class="blog-list-heading"><div><span class="blog-section-kicker">MORE TO EXPLORE</span><h2>Related articles</h2></div><a href="<?php echo e(route('blog.index')); ?>" class="blog-view-all">View all articles ↗</a></div><div class="blog-post-grid"><?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="blog-card"><a class="blog-card-image" href="<?php echo e(route('blog.show',$related->slug)); ?>"><?php if($related->featured_image): ?><img src="<?php echo e(asset('storage/'.$related->featured_image)); ?>" alt="<?php echo e($related->featured_image_alt ?: $related->title); ?>" loading="lazy"><?php else: ?><div class="blog-image-placeholder"><span>CN</span></div><?php endif; ?></a><div class="blog-card-content"><div class="blog-card-meta"><span><?php echo e($related->category?->name ?? 'Campus Notes'); ?></span><i></i><time><?php echo e($related->published_at->format('M d, Y')); ?></time></div><h3><a href="<?php echo e(route('blog.show',$related->slug)); ?>"><?php echo e($related->title); ?></a></h3><p><?php echo e($related->excerpt ?: Str::limit(strip_tags($related->content), 120)); ?></p><div class="blog-card-bottom"><a href="<?php echo e(route('blog.show',$related->slug)); ?>">Read article <span>→</span></a><small><?php echo e($related->reading_time); ?> min read</small></div></div></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div></div></section><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/blog/show.blade.php ENDPATH**/ ?>