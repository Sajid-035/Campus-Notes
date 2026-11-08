@extends('frontend.layouts.app')
@section('title', $resource->title)
@section('canonical_url', route('resources.show', $resource))
@section('meta_robots', 'index,follow')
@section('og_title', $resource->title . ' · CampusNotes')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($resource->description ?: $resource->title . ' academic resource'), 155))
@push('seo')
@php($resourceSchema = ['@context' => 'https://schema.org', '@type' => 'LearningResource', 'name' => $resource->title, 'description' => strip_tags($resource->description ?: $resource->title), 'learningResourceType' => $resource->category, 'educationalLevel' => $resource->semester ? 'Semester '.$resource->semester : null, 'url' => route('resources.show', $resource), 'datePublished' => $resource->created_at?->toIso8601String()])
<script type="application/ld+json">@json($resourceSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endpush
@section('content')
<div class="container">
    <div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / <a href="{{ route('resources.index') }}">Browse</a> / Resource details</div><h1>{{ $resource->title }}</h1>@if($resource->is_verified)<span class="tag" style="background:#dcfce7;color:#166534">✓ Verified resource</span>@endif</div>
    <div class="detail-layout">
        <div>
            <div class="card viewer">
                <div class="viewer-toolbar">
                    @if($resource->file_path && str_ends_with(strtolower($resource->file_name ?: ''), '.pdf'))
                        <button class="btn outline" type="button" onclick="changeResourcePage(-1)">‹</button><span id="resourcePageLabel" class="small">Page 1 / {{ $resource->page_count ?: '—' }}</span><button class="btn outline" type="button" onclick="changeResourcePage(1)">›</button>
                        <span style="flex:1"></span><button class="btn outline" type="button" onclick="zoomResourcePreview(-10)">−</button><span id="resourceZoomLabel" class="small">100%</span><button class="btn outline" type="button" onclick="zoomResourcePreview(10)">＋</button>
                    @else<span class="small"><strong>{{ $resource->file_name ?: 'Study preview' }}</strong></span><span style="flex:1"></span>@endif
                    @if($resource->file_path)<a class="btn outline" href="{{ route('resources.download', $resource) }}">⇩ Download</a>@else<span class="btn outline" aria-disabled="true">Demo entry</span>@endif
                </div>
                @if($resource->file_path && str_ends_with(strtolower($resource->file_name ?: ''), '.pdf'))
                    <div class="pdf-stage" style="display:block;min-height:520px"><iframe id="resourcePdfPreview" class="detail-preview" src="{{ asset('storage/'.$resource->file_path) }}#toolbar=1&page=1&zoom=100" title="{{ $resource->title }} PDF preview"></iframe></div>
                @else
                    <div class="pdf-stage"><div class="detail-preview-placeholder"><div><div style="font-size:48px;color:#2563eb">▤</div><h3>{{ $resource->file_name ?: 'Resource preview' }}</h3><p>@if($resource->file_path)This file format cannot be previewed directly in the browser. Use Download to access the uploaded document.@elseThis is a sample listing added for the initial demo. Upload a real document to enable preview and download.@endif</p></div></div></div>
                @endif
            </div>
            <div class="tabs"><button class="active" type="button" onclick="showResourceTab('overview',this)">Overview</button><button type="button" onclick="showResourceTab('reviews',this)">Reviews & Ratings</button><button type="button" onclick="showResourceTab('info',this)">Resource Information</button></div>
            <div class="card tab-content" id="resourceTabContent">{{ $resource->description ?: 'Study notes and academic material shared by the CampusNotes community.' }}</div>
            <div class="card" id="reviewPanel" style="margin-top:18px;padding:20px"><h3>Student reviews</h3>
                @forelse($resource->reviews as $review)<div class="review-card"><div class="profile-row"><div class="avatar-circle">{{ strtoupper(substr($review->user->name,0,1)) }}</div><div><strong>{{ $review->user->name }}</strong><div class="gold">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5-$review->rating) }}</div></div><span class="muted small" style="margin-left:auto">{{ $review->created_at->format('d M Y') }}</span></div>@if($review->comment)<p class="muted small">{{ $review->comment }}</p>@endif</div>@empty<p class="muted small">No student reviews yet. Be the first to review this resource.</p>@endforelse
                @auth
                    <form method="POST" action="{{ route('resources.review', $resource) }}" style="margin-top:18px">@csrf<label class="field-label">Your rating</label><select class="field" name="rating" required><option value="">Choose rating</option>@for($i=5;$i>=1;$i--)<option value="{{ $i }}">{{ $i }} — {{ $i===5?'Excellent':($i===4?'Very good':($i===3?'Good':($i===2?'Fair':'Poor'))) }}</option>@endfor</select><label class="field-label">Review (optional)</label><textarea class="field" name="comment" rows="3" placeholder="Share how this resource helped you..."></textarea><button class="btn primary" style="margin-top:10px">Submit review</button></form>
                @else<a class="btn outline" href="{{ route('login') }}">Sign in to leave a review</a>@endauth
            </div>
            <div class="section-head" style="margin-top:35px"><h2>Related resources</h2><a href="{{ route('resources.index') }}" class="btn outline">See all →</a></div>
            <div class="resource-grid">@forelse($relatedResources as $related)@include('frontend.partials.resource-card',['resource'=>$related])@empty<p class="muted">No related resources available.</p>@endforelse</div>
        </div>
        <aside class="card info-card"><h3 style="margin-top:0">Resource details</h3>
            @foreach(['Category'=>$resource->category,'Department'=>$resource->department?->name ?? '—','Semester'=>$resource->semester ? 'Semester '.$resource->semester : '—','Subject'=>$resource->subject,'Course code'=>$resource->course_code ?: '—','File size'=>$resource->file_size ? number_format($resource->file_size/1048576,1).' MB' : '—','Pages'=>$resource->page_count ?: '—','Uploaded'=>optional($resource->created_at)->format('d M Y'),'Uploader'=>$resource->uploader?->name ?? $resource->uploader_name ?? 'CampusNotes','Downloads'=>number_format($resource->downloads_count)] as $label=>$value)
                <div class="info-row"><span>{{ $label }}</span><b>{{ $value }}</b></div>
            @endforeach
            @if($resource->file_path)<a href="{{ route('resources.download', $resource) }}" class="btn primary" style="width:100%;margin-top:18px">⇩ Download resource</a>@else<span class="btn outline" style="width:100%;margin-top:18px;cursor:not-allowed">Demo entry · no file attached</span>@endif
            <div style="display:flex;gap:8px;margin-top:9px">
                @auth<form action="{{ route('resources.bookmark',$resource) }}" method="POST" style="flex:1">@csrf<button class="btn outline" style="width:100%">{{ $isBookmarked ? '★ Saved' : '☆ Bookmark' }}</button></form>@else<a href="{{ route('login') }}" class="btn outline" style="flex:1">☆ Bookmark</a>@endauth
                <button class="btn outline" style="flex:1" type="button" onclick="navigator.clipboard?.writeText(location.href).then(()=>toast('Link copied'))">↗ Share</button>
            </div>
        </aside>
    </div>
</div>
@endsection
@push('scripts')
<script>
let resourcePreviewPage = 1; let resourcePreviewZoom = 100;
function changeResourcePage(amount){resourcePreviewPage=Math.max(1,Math.min({{ (int)($resource->page_count ?: 999) }},resourcePreviewPage+amount));const frame=document.getElementById('resourcePdfPreview');if(frame){const base=frame.src.split('#')[0];frame.src=base+'#toolbar=1&page='+resourcePreviewPage+'&zoom='+resourcePreviewZoom;}const label=document.getElementById('resourcePageLabel');if(label)label.textContent='Page '+resourcePreviewPage+' / {{ $resource->page_count ?: '—' }}';}
function zoomResourcePreview(amount){resourcePreviewZoom=Math.max(60,Math.min(180,resourcePreviewZoom+amount));const frame=document.getElementById('resourcePdfPreview');if(frame){const base=frame.src.split('#')[0];frame.src=base+'#toolbar=1&page='+resourcePreviewPage+'&zoom='+resourcePreviewZoom;}const label=document.getElementById('resourceZoomLabel');if(label)label.textContent=resourcePreviewZoom+'%';}
function showResourceTab(tab,button){document.querySelectorAll('.tabs button').forEach(el=>el.classList.remove('active'));button.classList.add('active');const content=document.getElementById('resourceTabContent');const data={overview:@json($resource->description ?: 'Study notes and academic material shared by the CampusNotes community.'),reviews:'Student feedback and ratings are shown below. Sign in to submit your own review.',info:'Academic resource · Public visibility · Uploaded by the CampusNotes community.'};content.textContent=data[tab];if(tab==='reviews')document.getElementById('reviewPanel').scrollIntoView({behavior:'smooth',block:'start'});}
</script>
@endpush
