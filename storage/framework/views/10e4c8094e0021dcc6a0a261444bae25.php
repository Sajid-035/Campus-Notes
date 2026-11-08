<article class="card resource">
    <div class="resource-cover" <?php if($resource->cover_image): ?> style="background-image:linear-gradient(135deg,#142b55cc,#2563eb99),url('<?php echo e(asset('storage/'.$resource->cover_image)); ?>')" <?php endif; ?>>
        <span class="pdf"><?php echo e($resource->file_name ? strtoupper(pathinfo($resource->file_name, PATHINFO_EXTENSION)) : 'SAMPLE'); ?></span>
        <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('resources.bookmark', $resource)); ?>" style="position:absolute;right:12px;top:10px"><?php echo csrf_field(); ?><button class="bookmark" type="submit" title="Save bookmark">☆</button></form>
        <?php else: ?>
            <a class="bookmark" href="<?php echo e(route('login')); ?>" title="Sign in to bookmark" style="display:grid;place-items:center">☆</a>
        <?php endif; ?>
        <span class="cover-code"><?php echo e($resource->course_code ?: ($resource->department->code ?? 'CN')); ?></span>
    </div>
    <div class="resource-body">
        <h3><a href="<?php echo e(route('resources.show', $resource)); ?>"><?php echo e($resource->title); ?></a></h3>
        <div class="muted small"><?php echo e($resource->subject); ?> <?php if($resource->course_code): ?> · <?php echo e($resource->course_code); ?> <?php endif; ?></div>
        <div class="tags">
            <?php if($resource->department): ?><span class="tag"><?php echo e($resource->department->code); ?></span><?php endif; ?>
            <?php if($resource->semester): ?><span class="tag gray">Semester <?php echo e($resource->semester); ?></span><?php endif; ?>
            <?php if($resource->is_verified): ?><span class="tag" style="background:#dcfce7;color:#166534">✓ Verified</span><?php endif; ?>
        </div>
        <div class="meta">By <?php echo e($resource->uploader?->name ?? $resource->uploader_name ?? 'CampusNotes member'); ?> · <?php echo e(optional($resource->created_at)->format('d M Y')); ?><br>
            <?php if($resource->file_size): ?><?php echo e(number_format($resource->file_size / 1048576, 1)); ?> MB · <?php endif; ?><?php echo e($resource->page_count ?: '—'); ?> pages
        </div>
        <div class="rating"><b class="gold">★ <?php echo e(number_format((float)$resource->rating_average, 1)); ?> <?php if($resource->rating_count): ?> <span class="muted">(<?php echo e($resource->rating_count); ?>)</span><?php endif; ?></b><span class="muted">↓ <?php echo e(number_format($resource->downloads_count)); ?></span></div>
        <div class="resource-actions">
            <a class="btn outline" href="<?php echo e(route('resources.show', $resource)); ?>">Preview</a>
            <?php if($resource->file_path): ?><a class="btn primary" href="<?php echo e(route('resources.download', $resource)); ?>">Download</a><?php else: ?><span class="btn outline" title="Demo entry — upload a real document to enable downloads">Sample</span><?php endif; ?>
        </div>
    </div>
</article>
<?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/partials/resource-card.blade.php ENDPATH**/ ?>