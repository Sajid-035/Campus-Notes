@extends('backend.layouts.app')
@section('title', 'Edit Role')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Role</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Roles</a></div>
                <div class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role List</a></div>
                <div class="breadcrumb-item">Edit Role</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Update Role Information</h4>
                        </div>

                        <div class="card-body">
                            {{-- Validation Errors --}}
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Edit Form --}}
                            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

                            <div class="form-group">
                                <label><b>Role Name</b></label>
                                {!! Form::text('name', old('name', $role->name), ['placeholder' => 'Enter Role Name','class' => 'form-control']) !!}
                            </div>

                       <div class="form-group mt-4">
    <label><b>Assign Permissions</b></label>
    {{-- Select All Button --}}
    <div class="mb-2">
        <button type="button" id="select-all" class="btn btn-sm btn-info">Select All</button>
        <button type="button" id="deselect-all" class="btn btn-sm btn-secondary">Deselect All</button>
    </div>
    <div class="row">
        @foreach($permission as $value)
            <div class="col-md-6 col-lg-4 mb-2">
                <div class="form-check">
                    {!! Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), ['class' => 'form-check-input perm-checkbox', 'id' => 'perm_'.$value->id]) !!}
                    <label class="form-check-label" for="perm_{{ $value->id }}">
                        {{ ucfirst($value->name) }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

                            <div class="text-left mt-4">
                                <button type="submit" class="btn btn-primary">Update Role</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
{{-- JS for Select/Deselect All --}}
@push('scripts')
<script>
    document.getElementById('select-all').addEventListener('click', function () {
        document.querySelectorAll('.perm-checkbox').forEach(function(checkbox){
            checkbox.checked = true;
        });
    });

    document.getElementById('deselect-all').addEventListener('click', function () {
        document.querySelectorAll('.perm-checkbox').forEach(function(checkbox){
            checkbox.checked = false;
        });
    });
</script>
@endpush