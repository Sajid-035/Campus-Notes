@extends('frontend.layouts.app')
@section('title', 'Academic departments')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / Departments</div><h1>Explore departments</h1><p class="muted">Choose your department to find relevant notes, questions, assignments and study material.</p></div>
    <div class="department-grid">
        @forelse($departments as $department)
            <a class="card department-card" href="{{ route('departments.show', $department) }}"><span class="dept-code">{{ $department->code }}</span><div><h3>{{ $department->name }}</h3><p>{{ $department->description }}</p><p style="margin-top:10px;color:var(--blue);font-weight:700">{{ number_format($department->resources_count) }} resources →</p></div></a>
        @empty<div class="card empty-state"><h3>No departments available</h3></div>@endforelse
    </div>
</div>
@endsection
