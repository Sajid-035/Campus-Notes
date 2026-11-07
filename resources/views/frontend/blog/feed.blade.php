<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"><channel>
    <title>Campus Notes Blog</title>
    <link>{{ route('blog.index') }}</link>
    <description>Study smarter, learn better with Campus Notes.</description>
    <language>en</language>
    @foreach($posts as $post)
    <item><title>{{ $post->title }}</title><link>{{ route('blog.show',$post->slug) }}</link><guid>{{ route('blog.show',$post->slug) }}</guid><pubDate>{{ $post->published_at->toRfc2822String() }}</pubDate><description>{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 300) }}</description></item>
    @endforeach
</channel></rss>
