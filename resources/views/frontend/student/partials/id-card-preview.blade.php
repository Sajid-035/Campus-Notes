<div class="campus-id-card">
    <div class="campus-id-top"><div class="campus-id-brand"><span class="campus-id-logo">C</span><span><strong>CampusNotes</strong><small>STUDENT MEMBERSHIP CARD</small></span></div><span class="campus-id-verified">✓ Verified</span></div>
    <div class="campus-id-main">
        <div class="campus-id-avatar campus-id-avatar-photo">
            @if($user->avatar_url)<img src="{{ $user->avatar_url }}" alt="{{ $user->name }} profile photo">@else{{ strtoupper(substr($user->name, 0, 1)) }}@endif
        </div>
        <div class="campus-id-name"><small>STUDENT NAME</small><strong>{{ $user->name }}</strong><span>{{ $user->academicDepartment?->name ?: 'Department not set' }}</span><span>{{ $user->institution_name ?: 'Institution not set' }}</span></div>
    </div>
    <div class="campus-id-meta">
        <div><small>STUDENT ID</small><strong>{{ $user->student_id ?: 'Pending assignment' }}</strong></div>
        <div><small>BATCH</small><strong>{{ $user->student_batch ?: '—' }}</strong></div>
        <div><small>SEMESTER</small><strong>{{ $user->semester ? $user->semester . (in_array($user->semester % 100, [11,12,13]) ? 'th' : ([1=>'st',2=>'nd',3=>'rd'][$user->semester % 10] ?? 'th')) . ' Semester' : '—' }}</strong></div>
        <div><small>MEMBER SINCE</small><strong>{{ optional($user->verified_at ?: $user->created_at)->format('Y') }}</strong></div>
    </div>
    <div class="campus-id-footer"><span>Digital membership · Not a university-issued ID</span><span>campusnotes</span></div>
</div>
