<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title','CampusNotes') · CampusNotes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="{{ asset('campusnotes/css/campusnotes.css') }}" rel="stylesheet"></head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark cn-navbar sticky-top"><div class="container">
<a class="navbar-brand fw-bold" href="{{ route('home') }}"><i class="bi bi-journal-bookmark-fill me-2"></i>CampusNotes</a>
<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="nav"><ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
<li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li><li class="nav-item"><a class="nav-link" href="{{ route('resources.index') }}">Resources</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('departments.index') }}">Departments</a></li><li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="nav-item"><a class="btn btn-sm btn-light text-primary fw-semibold" href="{{ route('resources.create') }}"><i class="bi bi-cloud-upload me-1"></i>Upload</a></li>
<li class="nav-item"><form method="POST" action="{{ route('demo.role') }}" class="ms-lg-2">@csrf<select name="role" class="form-select form-select-sm role-select" onchange="this.form.submit()">@foreach(['Student','Teacher','Moderator','Admin','Super Admin'] as $r)<option value="{{ $r }}" @selected(session('demo_role','Student')===$r)>{{ $r }} demo</option>@endforeach</select></form></li>
</ul></div></div></nav>
@if(session('success'))<div class="container mt-3"><div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button class="btn-close" data-bs-dismiss="alert"></button></div></div>@endif
@if($errors->any())<div class="container mt-3"><div class="alert alert-danger"><b>Please correct these fields:</b><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>@endif
<main>@yield('content')</main>
<footer class="cn-footer mt-5"><div class="container py-4 d-flex justify-content-between flex-wrap gap-2"><div><b><i class="bi bi-journal-bookmark-fill me-2"></i>CampusNotes</b><div class="small text-white-50">Share knowledge. Learn together.</div></div><span class="small text-white-50">University Academic Resource Hub · Demo</span></div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>@stack('scripts')
</body></html>
