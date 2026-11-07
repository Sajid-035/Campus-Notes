<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ route('frontend.home') }}</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
    <url><loc>{{ route('frontend.features') }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc>{{ route('frontend.how-it-works') }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc>{{ route('frontend.about') }}</loc><changefreq>monthly</changefreq><priority>0.5</priority></url>
    <url><loc>{{ route('frontend.contact') }}</loc><changefreq>monthly</changefreq><priority>0.4</priority></url>
    <url><loc>{{ route('blog.index') }}</loc><changefreq>daily</changefreq><priority>0.8</priority></url>
    @foreach($categories as $category)
    <url><loc>{{ route('blog.category', $category->slug) }}</loc><lastmod>{{ $category->updated_at->toAtomString() }}</lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url>
    @endforeach
    @foreach($posts as $post)
    <url><loc>{{ route('blog.show', $post->slug) }}</loc><lastmod>{{ $post->updated_at->toAtomString() }}</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>
    @endforeach
</urlset>
