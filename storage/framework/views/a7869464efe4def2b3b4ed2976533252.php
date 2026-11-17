<?php $__env->startSection('title', $resource->title); ?>
<?php $__env->startSection('canonical_url', route('resources.show', $resource)); ?>
<?php $__env->startSection('meta_robots', 'index,follow'); ?>
<?php $__env->startSection('og_title', $resource->title . ' · CampusNotes'); ?>
<?php $__env->startSection('meta_description', \Illuminate\Support\Str::limit(strip_tags($resource->description ?: $resource->title . ' academic resource'), 155)); ?>
<?php $__env->startPush('seo'); ?>
<?php ($resourceSchema = ['@context' => 'https://schema.org', '@type' => 'LearningResource', 'name' => $resource->title, 'description' => strip_tags($resource->description ?: $resource->title), 'learningResourceType' => $resource->category, 'educationalLevel' => $resource->semester ? ($resource->semesterOption?->name ?? 'Semester '.$resource->semester) : null, 'url' => route('resources.show', $resource), 'datePublished' => $resource->created_at?->toIso8601String()]); ?>
<script type="application/ld+json"><?php echo json_encode($resourceSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE, 512) ?></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="subhead"><div class="crumb"><a href="<?php echo e(route('frontend.home')); ?>">Home</a> / <a href="<?php echo e(route('resources.index')); ?>">Browse</a> / Resource details</div><h1><?php echo e($resource->title); ?></h1><?php if($resource->is_verified): ?><span class="tag" style="background:#dcfce7;color:#166534">✓ Verified resource</span><?php endif; ?></div>
    <div class="detail-layout">
        <div>
            <div class="card viewer">
                <div class="viewer-toolbar">
                    <?php if($resource->file_path && str_ends_with(strtolower($resource->file_name ?: ''), '.pdf')): ?>
                        <button class="btn outline" type="button" onclick="changeResourcePage(-1)">‹</button><span id="resourcePageLabel" class="small">Page 1 / <?php echo e($resource->page_count ?: '—'); ?></span><button class="btn outline" type="button" onclick="changeResourcePage(1)">›</button>
                        <span style="flex:1"></span><button class="btn outline" type="button" onclick="zoomResourcePreview(-10)">−</button><span id="resourceZoomLabel" class="small">100%</span><button class="btn outline" type="button" onclick="zoomResourcePreview(10)">＋</button>
                    <?php else: ?><span class="small"><strong><?php echo e($resource->file_name ?: 'Study preview'); ?></strong></span><span style="flex:1"></span><?php endif; ?>
                    <?php if($resource->file_path): ?><a class="btn outline" href="<?php echo e(route('resources.download', $resource)); ?>">⇩ Download</a><?php else: ?><span class="btn outline" aria-disabled="true">Demo entry</span><?php endif; ?>
                </div>
                <?php if($resource->file_path && str_ends_with(strtolower($resource->file_name ?: ''), '.pdf')): ?>
                    <div class="pdf-stage" style="display:block;min-height:520px"><iframe id="resourcePdfPreview" class="detail-preview" src="<?php echo e(asset('storage/'.$resource->file_path)); ?>#toolbar=1&page=1&zoom=100" title="<?php echo e($resource->title); ?> PDF preview"></iframe></div>
                <?php else: ?>
                    <div class="pdf-stage"><div class="detail-preview-placeholder"><div><div style="font-size:48px;color:#2563eb">▤</div><h3><?php echo e($resource->file_name ?: 'Resource preview'); ?></h3><p><?php if($resource->file_path): ?>This file format cannot be previewed directly in the browser. Use Download to access the uploaded document.@elseThis is a sample listing added for the initial demo. Upload a real document to enable preview and download.<?php endif; ?></p></div></div></div>
                <?php endif; ?>
            </div>
            <div class="tabs"><button class="active" type="button" onclick="showResourceTab('overview',this)">Overview</button><button type="button" onclick="showResourceTab('reviews',this)">Reviews & Ratings</button><button type="button" onclick="showResourceTab('info',this)">Resource Information</button></div>
            <div class="card tab-content" id="resourceTabContent"><?php echo e($resource->description ?: 'Study notes and academic material shared by the CampusNotes community.'); ?></div>
            <div class="card" id="reviewPanel" style="margin-top:18px;padding:20px"><h3>Student reviews</h3>
                <?php $__empty_1 = true; $__currentLoopData = $resource->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><div class="review-card"><div class="profile-row"><div class="avatar-circle"><?php echo e(strtoupper(substr($review->user->name,0,1))); ?></div><div><strong><?php echo e($review->user->name); ?></strong><div class="gold"><?php echo e(str_repeat('★', $review->rating)); ?><?php echo e(str_repeat('☆', 5-$review->rating)); ?></div></div><span class="muted small" style="margin-left:auto"><?php echo e($review->created_at->format('d M Y')); ?></span></div><?php if($review->comment): ?><p class="muted small"><?php echo e($review->comment); ?></p><?php endif; ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="muted small">No student reviews yet. Be the first to review this resource.</p><?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                    <?php if((int) $resource->uploader_id !== (int) auth()->id()): ?>
                    <form method="POST" action="<?php echo e(route('resources.review', $resource)); ?>" style="margin-top:18px"><?php echo csrf_field(); ?><label class="field-label">Your rating</label><select class="field" name="rating" required><option value="">Choose rating</option><?php for($i=5;$i>=1;$i--): ?><option value="<?php echo e($i); ?>"><?php echo e($i); ?> — <?php echo e($i===5?'Excellent':($i===4?'Very good':($i===3?'Good':($i===2?'Fair':'Poor')))); ?></option><?php endfor; ?></select><label class="field-label">Review (optional)</label><textarea class="field" name="comment" rows="3" placeholder="Share how this resource helped you..."></textarea><button class="btn primary" style="margin-top:10px">Submit review</button></form>
                    <?php else: ?>
                        <p class="muted small" style="margin-top:15px">You cannot review a resource that you uploaded.</p>
                    <?php endif; ?>
                <?php else: ?><a class="btn outline" href="<?php echo e(route('login')); ?>">Sign in to leave a review</a><?php endif; ?>
            </div>
            <div class="section-head" style="margin-top:35px"><h2>Related resources</h2><a href="<?php echo e(route('resources.index')); ?>" class="btn outline">See all →</a></div>
            <div class="resource-grid"><?php $__empty_1 = true; $__currentLoopData = $relatedResources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php echo $__env->make('frontend.partials.resource-card',['resource'=>$related], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="muted">No related resources available.</p><?php endif; ?></div>
        </div>
        <aside class="card info-card"><h3 style="margin-top:0">Resource details</h3>
            <?php $__currentLoopData = ['Category'=>$resource->category,'Department'=>$resource->department?->name ?? '—','Semester'=>$resource->semester ? ($resource->semesterOption?->name ?? 'Semester '.$resource->semester) : '—','Subject'=>$resource->subject,'Course code'=>$resource->course_code ?: '—','File size'=>$resource->file_size ? number_format($resource->file_size/1048576,1).' MB' : '—','Pages'=>$resource->page_count ?: '—','Uploaded'=>optional($resource->created_at)->format('d M Y'),'Uploader'=>$resource->uploader?->name ?? $resource->uploader_name ?? 'CampusNotes','Downloads'=>number_format($resource->downloads_count)]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="info-row"><span><?php echo e($label); ?></span><b><?php echo e($value); ?></b></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($resource->file_path): ?><a href="<?php echo e(route('resources.download', $resource)); ?>" class="btn primary" style="width:100%;margin-top:18px">⇩ Download resource</a><?php else: ?><span class="btn outline" style="width:100%;margin-top:18px;cursor:not-allowed">Demo entry · no file attached</span><?php endif; ?>
            <div style="display:flex;gap:8px;margin-top:9px">
                <?php if(auth()->guard()->check()): ?><form action="<?php echo e(route('resources.bookmark',$resource)); ?>" method="POST" style="flex:1"><?php echo csrf_field(); ?><button class="btn outline" style="width:100%"><?php echo e($isBookmarked ? '★ Saved' : '☆ Bookmark'); ?></button></form><?php else: ?><a href="<?php echo e(route('login')); ?>" class="btn outline" style="flex:1">☆ Bookmark</a><?php endif; ?>
                <button class="btn outline" style="flex:1" type="button" onclick="navigator.clipboard?.writeText(location.href).then(()=>toast('Link copied'))">↗ Share</button>
            </div>
        </aside>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
let resourcePreviewPage = 1; let resourcePreviewZoom = 100;
function changeResourcePage(amount){resourcePreviewPage=Math.max(1,Math.min(<?php echo e((int)($resource->page_count ?: 999)); ?>,resourcePreviewPage+amount));const frame=document.getElementById('resourcePdfPreview');if(frame){const base=frame.src.split('#')[0];frame.src=base+'#toolbar=1&page='+resourcePreviewPage+'&zoom='+resourcePreviewZoom;}const label=document.getElementById('resourcePageLabel');if(label)label.textContent='Page '+resourcePreviewPage+' / <?php echo e($resource->page_count ?: '—'); ?>';}
function zoomResourcePreview(amount){resourcePreviewZoom=Math.max(60,Math.min(180,resourcePreviewZoom+amount));const frame=document.getElementById('resourcePdfPreview');if(frame){const base=frame.src.split('#')[0];frame.src=base+'#toolbar=1&page='+resourcePreviewPage+'&zoom='+resourcePreviewZoom;}const label=document.getElementById('resourceZoomLabel');if(label)label.textContent=resourcePreviewZoom+'%';}
function showResourceTab(tab,button){document.querySelectorAll('.tabs button').forEach(el=>el.classList.remove('active'));button.classList.add('active');const content=document.getElementById('resourceTabContent');const data={overview:<?php echo json_encode($resource->description ?: 'Study notes and academic material shared by the CampusNotes community.', 15, 512) ?>,reviews:'Student feedback and ratings are shown below. Sign in to submit your own review.',info:'Academic resource · Public visibility · Uploaded by the CampusNotes community.'};content.textContent=data[tab];if(tab==='reviews')document.getElementById('reviewPanel').scrollIntoView({behavior:'smooth',block:'start'});}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/frontend/resources/show.blade.php ENDPATH**/ ?>