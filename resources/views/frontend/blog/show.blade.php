@extends('frontend.layouts.app')

@section('title', $post->title)
@section('meta_title', $post->seo_title . ' | Campus Notes')
@section('meta_description', $post->meta_description)
@section('canonical_url', $post->canonical_url ?: route('blog.show',$post->slug))
@section('meta_robots', ($post->robots_index ? 'index' : 'noindex') . ',' . ($post->robots_follow ? 'follow' : 'nofollow'))
@section('og_type', 'article')
@section('og_title', $post->og_title ?: $post->seo_title)
@section('og_description', $post->og_description ?: $post->meta_description)
@section('og_image', $post->og_image ?: ($post->featured_image ? asset('storage/'.$post->featured_image) : ''))
@section('twitter_title', $post->twitter_title ?: $post->seo_title)
@section('twitter_description', $post->twitter_description ?: $post->meta_description)
@section('twitter_image', $post->twitter_image ?: ($post->og_image ?: ($post->featured_image ? asset('storage/'.$post->featured_image) : '')))

@push('styles')<link rel="stylesheet" href="{{ asset('frontend/css/blog.css') }}">@endpush

@push('seo')
@php
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
@endphp
<meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}">
<meta property="article:modified_time" content="{{ $post->updated_at?->toIso8601String() }}">
@if($post->category)<meta property="article:section" content="{{ $post->category->name }}">@endif
@foreach($post->tags as $tag)<meta property="article:tag" content="{{ $tag->name }}">@endforeach
<script type="application/ld+json">@json($articleSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
<script type="application/ld+json">@json($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
<section class="blog-single-top"><div class="cn-container"><div class="blog-breadcrumb"><a href="{{ route('frontend.home') }}">Home</a><span>/</span><a href="{{ route('blog.index') }}">Blog</a>@if($post->category)<span>/</span><a href="{{ route('blog.category',$post->category->slug) }}">{{ $post->category->name }}</a>@endif</div>
    <div class="blog-single-heading">@if($post->category)<a class="blog-single-category" href="{{ route('blog.category',$post->category->slug) }}">{{ $post->category->name }}</a>@endif<h1>{{ $post->title }}</h1>@if($post->excerpt)<p class="blog-single-excerpt">{{ $post->excerpt }}</p>@endif
        <div class="blog-single-byline"><span class="blog-author-avatar">{{ strtoupper(substr($post->author?->name ?? 'C',0,1)) }}</span><span>By <strong>{{ $post->author?->name ?? 'Campus Notes' }}</strong></span><i></i><time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at->format('F d, Y') }}</time><i></i><span><i class="far fa-clock"></i> {{ $post->reading_time }} min read</span></div>
    </div>
    @if($post->featured_image)<div class="blog-single-cover"><img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->featured_image_alt ?: $post->title }}"></div>@endif
</div></section>

<section class="blog-article-layout cn-container">
    <article class="blog-article"><div class="blog-article-content">{!! $post->content !!}</div>
        <div class="blog-article-tags">@if($post->tags->isNotEmpty())<strong>Topics:</strong>@foreach($post->tags as $tag)<span>{{ $tag->name }}</span>@endforeach @endif</div>
        <div class="blog-article-footer"><a href="{{ route('blog.index') }}" class="blog-back-link">← Back to all articles</a><span>Keep learning with Campus Notes</span></div>
    </article>
    <aside class="blog-article-aside"><div class="blog-aside-card"><span class="blog-section-kicker">KEEP EXPLORING</span><h3>Make every study session count.</h3><p>Discover more practical ideas and resources from Campus Notes.</p><a href="{{ route('blog.index') }}" class="cn-button cn-button-primary">Explore the blog <span>↗</span></a></div><div class="blog-aside-note"><i class="far fa-lightbulb"></i><p>Save useful ideas, revisit your notes and keep building better learning habits.</p></div></aside>
</section>

@if($relatedPosts->isNotEmpty())<section class="blog-related"><div class="cn-container"><div class="blog-list-heading"><div><span class="blog-section-kicker">MORE TO EXPLORE</span><h2>Related articles</h2></div><a href="{{ route('blog.index') }}" class="blog-view-all">View all articles ↗</a></div><div class="blog-post-grid">@foreach($relatedPosts as $related)<article class="blog-card"><a class="blog-card-image" href="{{ route('blog.show',$related->slug) }}">@if($related->featured_image)<img src="{{ asset('storage/'.$related->featured_image) }}" alt="{{ $related->featured_image_alt ?: $related->title }}" loading="lazy">@else<div class="blog-image-placeholder"><span>CN</span></div>@endif</a><div class="blog-card-content"><div class="blog-card-meta"><span>{{ $related->category?->name ?? 'Campus Notes' }}</span><i></i><time>{{ $related->published_at->format('M d, Y') }}</time></div><h3><a href="{{ route('blog.show',$related->slug) }}">{{ $related->title }}</a></h3><p>{{ $related->excerpt ?: Str::limit(strip_tags($related->content), 120) }}</p><div class="blog-card-bottom"><a href="{{ route('blog.show',$related->slug) }}">Read article <span>→</span></a><small>{{ $related->reading_time }} min read</small></div></div></article>@endforeach</div></div></section>@endif
@endsection
