@extends('frontend.layouts.app')
@section('content')
<div class="container student-area">
    <div class="student-shell">
        @include('frontend.student.partials.sidebar')
        <section class="student-content">
            @yield('panel-content')
        </section>
    </div>
</div>
@endsection
