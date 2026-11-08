@extends('frontend.layouts.app')
@section('title', 'Contact CampusNotes')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / Contact</div><h1>Get in touch</h1><p class="muted">Have a question, suggestion or issue with a resource? Send our team a message.</p></div>
    <div class="detail-layout" style="align-items:start">
        <div class="card form-card">
                    @if($errors->any())<div class="flash error">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('frontend.contact.store') }}">@csrf
                <label class="field-label">Your name *</label><input class="field" name="name" value="{{ old('name') }}" required maxlength="150" placeholder="Full name">
                <label class="field-label">Email address *</label><input class="field" type="email" name="email" value="{{ old('email') }}" required maxlength="190" placeholder="you@example.com">
                <label class="field-label">Subject</label><input class="field" name="subject" value="{{ old('subject') }}" maxlength="200" placeholder="How can we help?">
                <label class="field-label">Message *</label><textarea class="field" name="message" rows="6" required maxlength="5000" placeholder="Write your message...">{{ old('message') }}</textarea>
                <button class="btn primary" style="margin-top:12px">Send message →</button>
            </form>
        </div>
        <aside class="card info-card"><h3 style="margin-top:0">CampusNotes support</h3><p class="muted" style="line-height:1.8">Use this form to share feedback, report a problem, suggest a feature or ask about the academic resource library.</p><div class="info-row"><span>Resource help</span><b>Upload and access issues</b></div><div class="info-row"><span>Community</span><b>Feedback and suggestions</b></div><div class="info-row"><span>Safety</span><b>Report incorrect content</b></div><a href="{{ route('frontend.faq') }}" class="btn outline" style="width:100%;margin-top:18px">View FAQ</a></aside>
    </div>
</div>
@endsection
