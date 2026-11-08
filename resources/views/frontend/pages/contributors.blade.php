@extends('frontend.layouts.app')
@section('title', 'Student contributors')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / Contributors</div><h1>Meet the contributors</h1><p class="muted">Students helping others study smarter by sharing useful academic resources.</p></div>
    <div class="department-grid">@forelse($contributors as $person)<article class="card department-card"><div class="avatar-circle">{{ strtoupper(substr($person->name,0,1)) }}</div><div style="flex:1"><h3>{{ $person->name }}</h3><p>{{ $person->approved_uploads }} approved resources shared</p><p style="margin-top:7px"><strong>{{ number_format($person->total_downloads ?? 0) }}</strong> total resource downloads</p></div><span class="tag">Contributor</span></article>@empty<div class="card empty-state"><h3>No contributors to show yet</h3><p class="muted">Approved student uploads will appear here.</p></div>@endforelse</div>
    <div class="pagination">{{ $contributors->links() }}</div>
</div>
@endsection
