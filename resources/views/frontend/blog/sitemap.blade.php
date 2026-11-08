<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ route('frontend.home') }}</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
    <url><loc>{{ route('resources.index') }}</loc><changefreq>daily</changefreq><priority>0.9</priority></url>
    <url><loc>{{ route('departments.index') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ route('questions.index') }}</loc><changefreq>daily</changefreq><priority>0.7</priority></url>
    <url><loc>{{ route('assignments.index') }}</loc><changefreq>daily</changefreq><priority>0.7</priority></url>
    <url><loc>{{ route('frontend.features') }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc>{{ route('frontend.how-it-works') }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc>{{ route('frontend.about') }}</loc><changefreq>monthly</changefreq><priority>0.5</priority></url>
    <url><loc>{{ route('frontend.contact') }}</loc><changefreq>monthly</changefreq><priority>0.4</priority></url>
    <url><loc>{{ route('frontend.faq') }}</loc><changefreq>monthly</changefreq><priority>0.4</priority></url>
    <url><loc>{{ route('blog.index') }}</loc><changefreq>daily</changefreq><priority>0.8</priority></url>
    @foreach($departments as $department)
    <url><loc>{{ route('departments.show', $department->slug) }}</loc><lastmod>{{ $department->updated_at->toAtomString() }}</lastmod><changefreq>weekly</changefreq><priority>0.6</priority></url>
    @endforeach
    @foreach($resources as $resource)
    <url><loc>{{ route('resources.show', $resource->slug) }}</loc><lastmod>{{ $resource->updated_at->toAtomString() }}</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>
    @endforeach
    @foreach($categories as $category)
    <url><loc>{{ route('blog.category', $category->slug) }}</loc><lastmod>{{ $category->updated_at->toAtomString() }}</lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url>
    @endforeach
    @foreach($posts as $post)
    <url><loc>{{ route('blog.show', $post->slug) }}</loc><lastmod>{{ $post->updated_at->toAtomString() }}</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>
    @endforeach
</urlset>
