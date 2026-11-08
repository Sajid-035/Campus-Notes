@extends('frontend.layouts.app')
@section('title', 'Frequently asked questions')
@section('content')
<div class="container"><div class="subhead"><div class="crumb"><a href="{{ route('frontend.home') }}">Home</a> / FAQ</div><h1>Frequently asked questions</h1><p class="muted">Quick answers about finding, sharing and using CampusNotes resources.</p></div>
    <div class="faq-list">
        <details open><summary>What is CampusNotes?</summary><p>CampusNotes is a student-focused academic resource hub where members can discover and share class notes, previous questions, assignments, lab reports and lecture slides.</p></details>
        <details><summary>Do I need an account to browse resources?</summary><p>No. Public, approved resources can be browsed without signing in. You need an account to upload resources, bookmark materials or submit a review.</p></details>
        <details><summary>How do I upload my notes?</summary><p>Create an account, choose Upload from the navigation, enter the resource details and attach a supported document. Your submission will be reviewed before it becomes public.</p></details>
        <details><summary>Why is my upload pending?</summary><p>New uploads are held for moderation to help keep the library relevant and safe. An administrator must approve the upload before it appears in public search.</p></details>
        <details><summary>Which file types can I upload?</summary><p>The current upload form accepts PDF, DOC, DOCX, PPT and PPTX files up to 25 MB.</p></details>
        <details><summary>Can I bookmark or rate a resource?</summary><p>Yes. Sign in, open a resource and use Bookmark or the review form. You can see saved materials from your student dashboard.</p></details>
        <details><summary>Can I upload copyrighted or private documents?</summary><p>Only upload material you have permission to share. Do not upload confidential student records, private information or documents that you are not authorized to distribute.</p></details>
        <details><summary>How can I report an incorrect resource?</summary><p>Contact the CampusNotes team through the Contact page and include the resource title and a description of the issue.</p></details>
    </div>
</div>
@endsection
