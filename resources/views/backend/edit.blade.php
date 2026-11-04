@extends('backend.layouts.app')

@section('title', 'Edit Task')

@push('style')
    <!-- Keep same CSS design -->
    <link rel="stylesheet" href="{{ asset('backend/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/all.min.css') }}">

    <style>
        /* Use same dashboard styles */
        .card-body .h4 {
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
        }

        .card-body .h4 span {
            background: linear-gradient(90deg, #ff6b6b, #f7b42c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-control-lg {
            border-radius: 10px;
            background: #f0f2f5;
            border: none;
            color: #212529;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .form-control-lg:focus {
            background: #fff;
            box-shadow: 0 0 10px rgba(255, 183, 77, 0.7);
            transform: scale(1.02);
        }

        .btn-lg {
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            background: linear-gradient(90deg, #ff6b6b, #f7b42c);
            border: none;
        }

        .btn-lg:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
        }

        .todo-card {
            background: #1f3b73;
            border-radius: 15px;
            padding: 20px;
            color: #fff;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .todo-card label {
            color: #fff;
            font-weight: 500;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Task</h1>
            </div>
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-md-12">
                        <div class="card shadow-lg">
                            <div class="card-body py-4 px-4 px-md-5">
                                <!-- To-Do List Section -->
                                <h2 class="section-title">To-Do List</h2>
                                <div class="todo-card">
                                    <!-- Add New Task Form -->
                                    <form action="{{ route('todo.update', $data->id) }}" method="POST" class="mb-3">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $data->name }}" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="time" name="time" value="{{ $data->time }}"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="date" name="date" value="{{ $data->date }}"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-success w-100">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('dashboard') }}" class="btn btn-light">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('backend/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('backend/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('backend/js/page/index-0.js') }}"></script>
@endpush
