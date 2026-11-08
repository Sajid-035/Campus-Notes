<article class="card resource">
    <div class="resource-cover" @if($resource->cover_image) style="background-image:linear-gradient(135deg,#142b55cc,#2563eb99),url('{{ asset('storage/'.$resource->cover_image) }}')" @endif>
        <span class="pdf">{{ $resource->file_name ? strtoupper(pathinfo($resource->file_name, PATHINFO_EXTENSION)) : 'SAMPLE' }}</span>
        @auth
            <form method="POST" action="{{ route('resources.bookmark', $resource) }}" style="position:absolute;right:12px;top:10px">@csrf<button class="bookmark" type="submit" title="Save bookmark">☆</button></form>
        @else
            <a class="bookmark" href="{{ route('login') }}" title="Sign in to bookmark" style="display:grid;place-items:center">☆</a>
        @endauth
        <span class="cover-code">{{ $resource->course_code ?: ($resource->department->code ?? 'CN') }}</span>
    </div>
    <div class="resource-body">
        <h3><a href="{{ route('resources.show', $resource) }}">{{ $resource->title }}</a></h3>
        <div class="muted small">{{ $resource->subject }} @if($resource->course_code) · {{ $resource->course_code }} @endif</div>
        <div class="tags">
            @if($resource->department)<span class="tag">{{ $resource->department->code }}</span>@endif
            @if($resource->semester)<span class="tag gray">Semester {{ $resource->semester }}</span>@endif
            @if($resource->is_verified)<span class="tag" style="background:#dcfce7;color:#166534">✓ Verified</span>@endif
        </div>
        <div class="meta">By {{ $resource->uploader?->name ?? $resource->uploader_name ?? 'CampusNotes member' }} · {{ optional($resource->created_at)->format('d M Y') }}<br>
            @if($resource->file_size){{ number_format($resource->file_size / 1048576, 1) }} MB · @endif{{ $resource->page_count ?: '—' }} pages
        </div>
        <div class="rating"><b class="gold">★ {{ number_format((float)$resource->rating_average, 1) }} @if($resource->rating_count) <span class="muted">({{ $resource->rating_count }})</span>@endif</b><span class="muted">↓ {{ number_format($resource->downloads_count) }}</span></div>
        <div class="resource-actions">
            <a class="btn outline" href="{{ route('resources.show', $resource) }}">Preview</a>
            @if($resource->file_path)<a class="btn primary" href="{{ route('resources.download', $resource) }}">Download</a>@else<span class="btn outline" title="Demo entry — upload a real document to enable downloads">Sample</span>@endif
        </div>
    </div>
</article>
