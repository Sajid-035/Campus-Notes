@extends('backend.layouts.app')

@section('title', 'Dashboard')

@push('style')
    {{-- Assuming 'all.min.css' includes Font Awesome and other base CSS --}}
    <link rel="stylesheet" href="{{ asset('backend/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/all.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            {{-- Statistic Cards Row --}}
            <div class="row">
                {{-- Total News Count --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total News</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalNewsCount ?? 0 }} {{-- Replace with actual variable --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Published News Count --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Published News</h4>
                            </div>
                            <div class="card-body">
                                {{ $publishedNewsCount ?? 0 }} {{-- Replace with actual variable --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending News Count --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending News</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingNewsCount ?? 0 }} {{-- Replace with actual variable --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Draft News Count --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Draft News</h4>
                            </div>
                            <div class="card-body">
                                {{ $draftNewsCount ?? 0 }} {{-- Replace with actual variable --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Second row of statistics --}}
            <div class="row">
                {{-- Breaking News Count --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Breaking News</h4>
                            </div>
                            <div class="card-body">
                                {{ $breakingNewsCount ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Featured News Count --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Featured News</h4>
                            </div>
                            <div class="card-body">
                                {{ $featuredNewsCount ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Categories --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-dark">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Categories</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCategories ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Reporters --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Reporters</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalReporters ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Third row of statistics --}}
            <div class="row">
                {{-- Total Admin Users --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admins</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalAdminUsers ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Comments --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Comments</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalComments ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Advertisements --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-ad"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Ads</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalAdvertisements ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Placeholder for remaining space or other widget --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-light">
                            <i class="fas fa-chart-bar text-muted"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Other Metric</h4>
                            </div>
                            <div class="card-body">
                                N/A
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- To-Do Section (Moved and Integrated) --}}
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg" id="list1">
                        <div class="card-body py-4 px-4 px-md-5">
                            {{-- To-Do List Section --}}
                            <h2 class="section-title">To-Do List</h2>
                            <div class="todo-card">
                                {{-- Add New Task Form --}}
                                <form action="{{ route('todo.store') }}" method="POST" class="mb-3">
                                    @csrf
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Task name..." required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="time" name="time" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-success w-100">Add Task</button>
                                        </div>
                                    </div>
                                </form>

                                {{-- Task List --}}
                                @foreach ($data as $index => $task)
                                    <div class="task-item col-md-12">
                                        <div
                                            class="d-flex flex-column flex-md-row justify-content-between w-100 align-items-start align-items-md-center mb-2 p-2 border rounded">
                                            {{-- Left part: index + task name --}}
                                            <div class="mb-1 mb-md-0">
                                                <span class="badge bg-light text-dark">{{ $index + 1 }}</span>
                                                <span class="ms-2">{{ $task->name }}</span>
                                            </div>

                                            {{-- Right part: time, date, edit, delete --}}
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <span
                                                    class="badge bg-info">{{ \Carbon\Carbon::parse($task->time)->format('h:i A') }}</span>
                                                <span
                                                    class="badge bg-warning">{{ \Carbon\Carbon::parse($task->date)->format('j F Y') }}</span>
                                                <div class="d-flex">
                                                    <a href="{{ route('todo.edit', $task->id) }}"
                                                        class="btn btn-sm btn-primary me-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('todo.destroy', $task->id) }}"
                                                        method="POST" class="m-0 p-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
@endpush