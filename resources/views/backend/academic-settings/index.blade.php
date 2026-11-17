@extends('backend.layouts.app')
@section('title', 'Academic Settings')
@push('style')
<style>
.academic-settings .settings-panel{border:0;box-shadow:0 5px 24px rgba(24,38,67,.06);margin-bottom:24px}
.academic-settings .settings-panel .card-header{background:#fff;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}
.academic-settings .add-form{display:grid;grid-template-columns:repeat(4,minmax(120px,1fr));gap:10px;align-items:end;margin-bottom:20px;padding:16px;background:#f8fafc;border-radius:10px}
.academic-settings .add-form .form-group{margin:0}
.academic-settings .row-form{display:flex;gap:8px;align-items:center;min-width:420px}
.academic-settings .row-form .form-control{min-width:85px}
.academic-settings .settings-table td{vertical-align:middle}
.academic-settings .status-toggle{display:flex;align-items:center;gap:5px;white-space:nowrap;font-size:12px}
@media(max-width:767px){.academic-settings .add-form{grid-template-columns:1fr 1fr}.academic-settings .row-form{min-width:360px}}
</style>
@endpush
@section('main')
<div class="main-content academic-settings">
    <section class="section">
        <div class="section-header"><h1><i class="fas fa-sliders-h mr-2 text-primary"></i>Academic Settings</h1></div>
        <p class="text-muted mb-4">Manage the department, semester and resource category options shown in student registration, profiles and resource submission forms.</p>
        @if(session('success'))<div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>@endif
        @if(session('error'))<div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>@endif
        @if($errors->any())<div class="alert alert-danger"><strong>Please check the submitted values.</strong><ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

        <div class="card settings-panel">
            <div class="card-header"><h4><i class="fas fa-university mr-2 text-primary"></i>Departments <span class="badge badge-light">{{ $departments->count() }}</span></h4></div>
            <div class="card-body">
                @can('resources-approve')
                <form class="add-form" method="POST" action="{{ route('admin.academic-settings.departments.store') }}">@csrf
                    <div class="form-group"><label>Department name *</label><input class="form-control" name="name" required maxlength="150" placeholder="Computer Science"></div>
                    <div class="form-group"><label>Department code *</label><input class="form-control" name="code" required maxlength="20" placeholder="CSE"></div>
                    <div class="form-group"><label>Sort order</label><input class="form-control" type="number" min="0" name="sort_order" value="0"></div>
                    <button class="btn btn-primary"><i class="fas fa-plus mr-1"></i>Add Department</button>
                </form>
                @endcan
                <div class="table-responsive"><table class="table table-hover settings-table"><thead><tr><th>Department</th><th>Code</th><th>Resources</th><th>Status</th><th>Manage</th></tr></thead><tbody>
                @forelse($departments as $department)
                    <tr><td colspan="5">
                        <form class="row-form" method="POST" action="{{ route('admin.academic-settings.departments.update',$department) }}">@csrf @method('PUT')
                            <input class="form-control" name="name" value="{{ $department->name }}" required aria-label="Department name">
                            <input class="form-control" name="code" value="{{ $department->code }}" required aria-label="Department code">
                            <input class="form-control" type="number" min="0" name="sort_order" value="{{ $department->sort_order }}" aria-label="Sort order">
                            <input type="hidden" name="description" value="{{ $department->description }}">
                            <label class="status-toggle"><input type="checkbox" name="is_active" value="1" @checked($department->is_active)> Active</label>
                            <span class="badge badge-light">{{ $department->resources_count }} resources</span>
                            @can('resources-approve')<button class="btn btn-sm btn-primary" type="submit">Save</button>@endcan
                        </form>
                    </td></tr>
                @empty<tr><td colspan="5" class="text-center text-muted">No departments have been added yet.</td></tr>@endforelse
                </tbody></table></div>
            </div>
        </div>

        <div class="card settings-panel">
            <div class="card-header"><h4><i class="fas fa-layer-group mr-2 text-primary"></i>Semesters <span class="badge badge-light">{{ $semesters->count() }}</span></h4></div>
            <div class="card-body">
                @can('resources-approve')
                <form class="add-form" method="POST" action="{{ route('admin.academic-settings.semesters.store') }}">@csrf
                    <div class="form-group"><label>Semester number *</label><input class="form-control" type="number" name="number" min="1" max="255" required placeholder="e.g. 1"></div>
                    <div class="form-group"><label>Display name *</label><input class="form-control" name="name" maxlength="100" required placeholder="1st Semester"></div>
                    <div class="form-group"><label>Sort order</label><input class="form-control" type="number" min="0" name="sort_order" value="0"></div>
                    <button class="btn btn-primary"><i class="fas fa-plus mr-1"></i>Add Semester</button>
                </form>
                @endcan
                <div class="table-responsive"><table class="table table-hover settings-table"><thead><tr><th>Number</th><th>Display name</th><th>Sort</th><th>Status</th><th>Manage</th></tr></thead><tbody>
                @forelse($semesters as $semester)
                    <tr><td colspan="5"><form class="row-form" method="POST" action="{{ route('admin.academic-settings.semesters.update',$semester) }}">@csrf @method('PUT')
                        <input class="form-control" style="max-width:110px" type="number" min="1" max="255" name="number" value="{{ $semester->number }}" required aria-label="Semester number">
                        <input class="form-control" name="name" value="{{ $semester->name }}" required aria-label="Semester name">
                        <input class="form-control" style="max-width:100px" type="number" min="0" name="sort_order" value="{{ $semester->sort_order }}" aria-label="Sort order">
                        <label class="status-toggle"><input type="checkbox" name="is_active" value="1" @checked($semester->is_active)> Active</label>
                        @can('resources-approve')<button class="btn btn-sm btn-primary" type="submit">Save</button>@endcan
                    </form></td></tr>
                @empty<tr><td colspan="5" class="text-center text-muted">No semesters have been added yet.</td></tr>@endforelse
                </tbody></table></div>
                <small class="text-muted">The semester number is saved with existing student and resource records. Changing a number updates those records too.</small>
            </div>
        </div>

        <div class="card settings-panel">
            <div class="card-header"><h4><i class="fas fa-tags mr-2 text-primary"></i>Resource Categories <span class="badge badge-light">{{ $categories->count() }}</span></h4></div>
            <div class="card-body">
                @can('resources-approve')
                <form class="add-form" method="POST" action="{{ route('admin.academic-settings.categories.store') }}">@csrf
                    <div class="form-group"><label>Category name *</label><input class="form-control" name="name" maxlength="100" required placeholder="e.g. E-books"></div>
                    <div class="form-group"><label>Description</label><input class="form-control" name="description" maxlength="2000" placeholder="Optional details"></div>
                    <div class="form-group"><label>Sort order</label><input class="form-control" type="number" min="0" name="sort_order" value="0"></div>
                    <button class="btn btn-primary"><i class="fas fa-plus mr-1"></i>Add Category</button>
                </form>
                @endcan
                <div class="table-responsive"><table class="table table-hover settings-table"><thead><tr><th>Category</th><th>Description</th><th>Resources</th><th>Status</th><th>Manage</th></tr></thead><tbody>
                @forelse($categories as $category)
                    <tr><td colspan="5"><form class="row-form" method="POST" action="{{ route('admin.academic-settings.categories.update',$category) }}">@csrf @method('PUT')
                        <input class="form-control" name="name" value="{{ $category->name }}" required aria-label="Category name">
                        <input class="form-control" name="description" value="{{ $category->description }}" aria-label="Category description">
                        <input class="form-control" style="max-width:85px" type="number" min="0" name="sort_order" value="{{ $category->sort_order }}" aria-label="Sort order">
                        <label class="status-toggle"><input type="checkbox" name="is_active" value="1" @checked($category->is_active)> Active</label>
                        <span class="badge badge-light">{{ $category->resources_count }} resources</span>
                        @can('resources-approve')<button class="btn btn-sm btn-primary" type="submit">Save</button>@endcan
                    </form></td></tr>
                @empty<tr><td colspan="5" class="text-center text-muted">No resource categories have been added yet.</td></tr>@endforelse
                </tbody></table></div>
                <small class="text-muted">Renaming a category also updates the category name on existing resources. Deactivate a category to hide it from new submissions without losing old data.</small>
            </div>
        </div>
    </section>
</div>
@endsection
