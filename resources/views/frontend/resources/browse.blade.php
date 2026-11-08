@extends('frontend.layouts.app')
@section('title', 'Browse academic resources')
@section('meta_description', 'Search and filter class notes, previous questions, assignments, lab reports and lecture slides.')
@section('content')
<div class="container">
    <div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / Browse resources</div><h1>Browse resources</h1><p class="muted">Discover notes, questions and academic materials shared by students.</p></div>
    <div class="browse-layout">
        <aside class="card filter" id="filterPanel">
            <h3>⚙ Filters</h3>
            <form action="{{ route('resources.index') }}" method="GET">
                <label>Department<select class="field" name="department"><option value="">All departments</option>@foreach($departments as $department)<option value="{{ $department->slug }}" @selected(request('department')===$department->slug)>{{ $department->code }} — {{ $department->name }}</option>@endforeach</select></label>
                <label>Semester<select class="field" name="semester"><option value="">All semesters</option>@for($i=1;$i<=8;$i++)<option value="{{ $i }}" @selected((string)request('semester')===(string)$i)>Semester {{ $i }}</option>@endfor</select></label>
                <label>Category<select class="field" name="category"><option value="">All categories</option>@foreach($categories as $category)<option @selected(request('category')===$category)>{{ $category }}</option>@endforeach</select></label>
                <label class="filter-check"><input type="checkbox" name="verified" value="1" @checked(request()->boolean('verified'))> Verified only</label>
                <input type="hidden" name="q" value="{{ request('q') }}">
                <button class="btn primary" style="width:100%;margin-top:12px">Apply filters</button>
                <a class="btn outline" style="width:100%;margin-top:8px" href="{{ route('resources.index') }}">Clear all</a>
            </form>
        </aside>
        <div>
            <form class="browse-tools" action="{{ route('resources.index') }}" method="GET">
                <span class="muted">{{ $resources->total() }} resources found</span>
                <input name="q" value="{{ request('q') }}" class="field" style="max-width:230px" placeholder="Search resources...">
                @foreach(['department','semester','category','verified'] as $filter)<input type="hidden" name="{{ $filter }}" value="{{ request($filter) }}">@endforeach
                <select class="field" name="sort" onchange="this.form.submit()"><option value="latest" @selected(request('sort','latest')==='latest')>Latest</option><option value="downloads" @selected(request('sort')==='downloads')>Most downloaded</option><option value="rating" @selected(request('sort')==='rating')>Highest rated</option><option value="oldest" @selected(request('sort')==='oldest')>Oldest</option></select>
                <button class="btn primary" type="submit">Search</button>
                <button class="btn outline" type="button" id="filterToggle" onclick="document.getElementById('filterPanel').classList.toggle('open')">☷ Filters</button>
                <button class="btn outline" type="button" onclick="setResourceView('grid')" aria-label="Grid view">▦</button>
                <button class="btn outline" type="button" onclick="setResourceView('list')" aria-label="List view">☰</button>
            </form>
            <div class="resource-grid" id="browseResourceGrid">
                @forelse($resources as $resource)@include('frontend.partials.resource-card', ['resource' => $resource])
                @empty<div class="card empty-state"><div class="empty-icon">⌕</div><h3>No resources found</h3><p class="muted">Try changing your search or filters, or upload the first resource in this category.</p><a class="btn primary" href="{{ route('resources.upload') }}">Share a resource</a></div>@endforelse
            </div>
            <div class="pagination">{{ $resources->links() }}</div>
        </div>
    </div>
</div>
@endsection
