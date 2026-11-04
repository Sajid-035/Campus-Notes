@extends('campusnotes.layout')
@section('title','Departments')
@section('content')
<div class="page-banner"><div class="container"><span class="eyebrow">ACADEMIC STRUCTURE</span><h1 class="fw-bold">Departments</h1></div></div>
<div class="container py-5">
@if(in_array(session('demo_role','Student'),['Admin','Super Admin']))<div class="form-panel mb-4"><h5>Add department</h5><form method="POST" action="{{ route('departments.store') }}" class="row g-2">@csrf<div class="col-md-4"><input name="name" class="form-control" placeholder="Department name" required></div><div class="col-md-2"><input name="code" class="form-control" placeholder="Code" required></div><div class="col-md-4"><input name="description" class="form-control" placeholder="Description"></div><div class="col-md-2"><button class="btn btn-primary w-100">Add</button></div></form></div>@endif
<div class="row g-3">@foreach($departments as $d)<div class="col-md-6 col-lg-4"><div class="dept-card h-100"><i class="bi bi-building"></i><h5 class="mt-3">{{ $d->name }}</h5><span class="badge text-bg-light">{{ $d->code }}</span><p class="small text-secondary mt-2">{{ $d->description }}</p><b class="small">{{ $d->resources_count }} resources</b><div><a class="btn btn-sm btn-outline-primary mt-3" href="{{ route('resources.index',['department'=>$d->id]) }}">Explore</a></div></div></div>@endforeach</div></div>
@endsection
