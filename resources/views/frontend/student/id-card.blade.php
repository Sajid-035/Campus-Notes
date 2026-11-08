@extends('frontend.layouts.app')
@section('title', 'Digital Student ID Card')
@section('content')
<div class="container student-id-card-page"><div class="student-page-heading"><div><span class="student-kicker">CAMPUSNOTES MEMBERSHIP</span><h1>Digital Student ID Card</h1><p>Your CampusNotes membership identity. This is not a substitute for your university-issued ID.</p></div><button class="btn primary no-print" onclick="window.print()">↓ Download / Print PDF</button></div>
    @include('frontend.student.partials.id-card-preview', ['user' => $user])
    <div class="student-id-card-note no-print"><strong>How to save:</strong> Select “Download / Print PDF”, then choose “Save as PDF” in your browser's print dialog.</div>
    <a class="btn outline no-print" href="{{ route('student.profile') }}">← Back to Profile</a>
</div>
@endsection
@push('styles')<style>@media print{body{background:#fff!important}.topbar,.footer,.no-print,.toast{display:none!important}.student-id-card-page{width:100%;margin:0;padding:35px}.campus-id-card{width:100%;max-width:760px;margin:50px auto;box-shadow:none!important;print-color-adjust:exact;-webkit-print-color-adjust:exact}.student-page-heading{display:none!important}}</style>@endpush
