@extends('frontend.layouts.app')

@section('title', isset($category) ? $category->name . ' Articles' : 'The Campus Notes Blog')
@section('meta_title', isset($category) ? (($category->seo_title ?: $category->name . ' Articles') . ' | Campus Notes') : 'Campus Notes Blog | Study smarter, learn better')
@section('meta_description', isset($category) ? ($category->meta_description ?: $category->description ?: 'Explore articles in ' . $category->name . ' from Campus Notes.') : 'Explore practical study tips, productivity guides, learning strategies and student resources on the Campus Notes blog.')
@section('canonical_url', isset($category) ? (route('blog.category', $category->slug) . ($posts->currentPage() > 1 ? '?page=' . $posts->currentPage() : '')) : (route('blog.index') . ($posts->currentPage() > 1 ? '?page=' . $posts->currentPage() : '')))
@section('meta_robots', request('q') ? 'noindex,follow' : 'index,follow')
@section('og_title', isset($category) ? ($category->seo_title ?: $category->name . ' | Campus Notes') : 'Campus Notes Blog')
@section('og_description', isset($category) ? ($category->meta_description ?: ($category->description ?: 'Explore articles from this Campus Notes topic.')) : 'Practical ideas and guides to help you study smarter and stay organized.')

@push('styles')<link rel="stylesheet" href="{{ asset('frontend/css/blog.css') }}">@endpush

@push('seo')
@php
    $collectionSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => isset($category) ? $category->name . ' Articles' : 'Campus Notes Blog',
        'description' => isset($category) ? ($category->meta_description ?: $category->description) : 'Practical study advice, learning strategies and student resources.',
        'url' => url()->current(),
        'isPartOf' => ['@type' => 'Blog', 'name' => 'Campus Notes Blog', 'url' => route('blog.index')],
    ];
@endphp
<script type="application/ld+json">@json($collectionSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
<section class="blog-hero">
    <div class="cn-container">
        <div class="blog-hero-copy">
            <span class="blog-eyebrow"><i></i> THE CAMPUS NOTES JOURNAL</span>
            <h1>@if(isset($category)){{ $category->name }}@else Ideas for a <span>smarter</span> student life @endif</h1>
            <p>{{ isset($category) ? ($category->description ?: 'Explore useful articles and practical guides from this topic.') : 'Practical study advice, thoughtful learning strategies and fresh ideas to make every study session count.' }}</p>
            <form action="{{ route('blog.index') }}" method="GET" class="blog-search">
                <i class="fas fa-search" aria-hidden="true"></i><input type="search" name="q" value="{{ request('q') }}" placeholder="Search articles, study tips, productivity..." aria-label="Search blog articles"><button type="submit">Search</button>
            </form>
            <div class="blog-hero-meta"><span><i class="far fa-newspaper"></i> {{ $posts->total() }} {{ Str::plural('article', $posts->total()) }}</span><span><i class="far fa-clock"></i> Fresh ideas for everyday learning</span></div>
        </div>
        <div class="blog-hero-art" aria-hidden="true"><div class="blog-art-ring ring-a"></div><div class="blog-art-ring ring-b"></div><div class="blog-art-paper"><span class="paper-label">STUDENT NOTES</span><strong>Learn.<br>Grow.<br><em>Repeat.</em></strong><i></i><i></i><i></i><b>✦</b></div><span class="blog-art-orb orb-a">✳</span><span class="blog-art-orb orb-b">✦</span></div>
    </div>
</section>

<section class="blog-main cn-container">
    <div class="blog-category-row">
        <a href="{{ route('blog.index') }}" class="blog-chip {{ !isset($category) && !request('category') ? 'active' : '' }}">All articles</a>
        @foreach($categories as $blogCategory)
            @if($blogCategory->posts_count > 0)<a href="{{ route('blog.category',$blogCategory->slug) }}" class="blog-chip {{ isset($category) && $category->id === $blogCategory->id ? 'active' : '' }}">{{ $blogCategory->name }} <small>{{ $blogCategory->posts_count }}</small></a>@endif
        @endforeach
    </div>

    @if(isset($featuredPost) && $featuredPost && !request('q') && $posts->currentPage() === 1)
    <a href="{{ route('blog.show',$featuredPost->slug) }}" class="blog-featured-card">
        <div class="blog-featured-image">
            @if($featuredPost->featured_image)<img src="{{ asset('storage/'.$featuredPost->featured_image) }}" alt="{{ $featuredPost->featured_image_alt ?: $featuredPost->title }}" loading="eager">@else<div class="blog-image-placeholder"><span>CN</span></div>@endif
            <span class="blog-featured-label">EDITOR'S PICK</span>
        </div>
        <div class="blog-featured-copy"><div class="blog-card-meta"><span>{{ $featuredPost->category?->name ?? 'Featured' }}</span><i></i><time datetime="{{ $featuredPost->published_at->toDateString() }}">{{ $featuredPost->published_at->format('M d, Y') }}</time></div><h2>{{ $featuredPost->title }}</h2><p>{{ $featuredPost->excerpt ?: Str::limit(strip_tags($featuredPost->content), 180) }}</p><div class="blog-read-link">Read featured article <span>↗</span></div><div class="blog-author-line"><span class="blog-author-avatar">{{ strtoupper(substr($featuredPost->author?->name ?? 'C',0,1)) }}</span><span>By {{ $featuredPost->author?->name ?? 'Campus Notes' }}</span><span class="blog-read-time"><i class="far fa-clock"></i> {{ $featuredPost->reading_time }} min read</span></div></div>
    </a>
    @endif

    <div class="blog-list-heading"><div><span class="blog-section-kicker">DISCOVER &amp; LEARN</span><h2>{{ request('q') ? 'Search results' : (isset($category) ? 'Explore this topic' : 'Latest articles') }}</h2></div>@if(request('q'))<span class="blog-result-label">Results for “{{ request('q') }}”</span>@endif</div>
    <div class="blog-post-grid">
        @forelse($posts as $post)
            @if(!(isset($featuredPost) && $featuredPost && $posts->currentPage() === 1 && $post->id === $featuredPost->id))
            <article class="blog-card">
                <a class="blog-card-image" href="{{ route('blog.show',$post->slug) }}">
                    @if($post->featured_image)<img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->featured_image_alt ?: $post->title }}" loading="lazy">@else<div class="blog-image-placeholder"><span>CN</span><small>Campus Notes</small></div>@endif
                    @if($post->is_featured)<span class="blog-card-featured">Featured</span>@endif
                </a>
                <div class="blog-card-content"><div class="blog-card-meta"><span>{{ $post->category?->name ?? 'Campus Notes' }}</span><i></i><time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('M d, Y') }}</time></div><h3><a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a></h3><p>{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 130) }}</p><div class="blog-card-bottom"><a href="{{ route('blog.show',$post->slug) }}">Read article <span>→</span></a><small>{{ $post->reading_time }} min read</small></div></div>
            </article>
            @endif
        @empty
            <div class="blog-empty"><div class="blog-empty-icon"><i class="far fa-file-alt"></i></div><h3>No articles found</h3><p>{{ request('q') ? 'Try another search phrase or browse all articles.' : 'There are no published posts in this category yet. Check back soon.' }}</p><a class="cn-button cn-button-primary" href="{{ route('blog.index') }}">Browse all articles</a></div>
        @endforelse
    </div>
    @if($posts->hasPages())<div class="blog-pagination">{{ $posts->links() }}</div>@endif
</section>
@endsection
