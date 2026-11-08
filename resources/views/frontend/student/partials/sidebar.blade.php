@php
    $panelUser = auth()->user();
    $unreadCount = $panelUser->studentNotifications()->whereNull('read_at')->count();
@endphp
<aside class="student-sidebar">
    <div class="student-sidebar-brand">
        <span class="student-sidebar-logo">C</span>
        <span><strong>CampusNotes</strong><small>Student Panel</small></span>
    </div>
    <div class="student-sidebar-profile">
        <div class="student-sidebar-avatar student-avatar-frame">
            @if($panelUser->avatar_url)<img src="{{ $panelUser->avatar_url }}" alt="{{ $panelUser->name }} profile photo">@else{{ strtoupper(substr($panelUser->name, 0, 1)) }}@endif
        </div>
        <div class="student-sidebar-profile-text"><strong>{{ $panelUser->name }}</strong><small>{{ $panelUser->student_id ?: 'Student account' }}</small></div>
        <span class="student-online-dot" title="Signed in"></span>
    </div>

    <div class="student-menu-label">MAIN MENU</div>
    <a class="student-menu-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}"><span>▦</span> Dashboard</a>
    <div class="student-menu-sub"><a href="{{ route('student.dashboard') }}">Overview</a><a href="{{ route('student.dashboard') }}#stats">Statistics</a></div>

    <div class="student-menu-label">MY ACADEMIC SPACE</div>
    <a class="student-menu-link {{ request()->routeIs('student.profile', 'student.profile.edit', 'student.id-card') ? 'active' : '' }}" href="{{ route('student.profile') }}"><span>♙</span> My Profile</a>
    <div class="student-menu-sub"><a href="{{ route('student.profile') }}">View Profile</a><a href="{{ route('student.profile.edit') }}">Edit Profile</a><a href="{{ route('student.id-card') }}">Digital Student ID</a></div>

    <a class="student-menu-link {{ request()->routeIs('resources.upload') || request()->routeIs('student.upload-history') ? 'active' : '' }}" href="{{ route('resources.upload') }}"><span>⇧</span> Upload Resource</a>
    <div class="student-menu-sub"><a href="{{ route('resources.upload') }}">Add New Resource</a><a href="{{ route('student.upload-history') }}">Upload History</a></div>

    <a class="student-menu-link {{ request()->routeIs('student.resources') ? 'active' : '' }}" href="{{ route('student.resources', ['status' => 'all']) }}"><span>▤</span> My Resources</a>
    <div class="student-menu-sub"><a href="{{ route('student.resources', ['status' => 'all']) }}">All Resources</a><a href="{{ route('student.resources', ['status' => 'published']) }}">Published</a><a href="{{ route('student.resources', ['status' => 'pending']) }}">Pending</a><a href="{{ route('student.resources', ['status' => 'rejected']) }}">Rejected</a><a href="{{ route('student.resources', ['status' => 'draft']) }}">Drafts</a></div>

    <a class="student-menu-link {{ request()->routeIs('student.bookmarks') ? 'active' : '' }}" href="{{ route('student.bookmarks') }}"><span>☆</span> My Bookmarks</a>
    <div class="student-menu-sub"><a href="{{ route('student.bookmarks') }}">Saved Notes & Materials</a><a href="{{ route('student.bookmarks') }}?category=Previous%20Questions">Saved Questions</a><a href="{{ route('student.bookmarks') }}?category=Assignments">Saved Assignments</a></div>
    <a class="student-menu-link {{ request()->routeIs('student.downloads') ? 'active' : '' }}" href="{{ route('student.downloads') }}"><span>⇩</span> My Downloads</a>
    <div class="student-menu-sub"><a href="{{ route('student.downloads') }}">Download History</a><a href="{{ route('student.downloads',['period'=>'recent']) }}">Recent Downloads</a></div>
    <a class="student-menu-link {{ request()->routeIs('student.reviews') ? 'active' : '' }}" href="{{ route('student.reviews') }}"><span>★</span> My Reviews</a>
    <div class="student-menu-sub"><a href="{{ route('student.reviews') }}">All Reviews</a><a href="{{ route('resources.index') }}">Review a Resource</a></div>

    <div class="student-menu-label">CAMPUS COMMUNITY</div>
    <a class="student-menu-link {{ request()->routeIs('student.community*') ? 'active' : '' }}" href="{{ route('student.community') }}"><span>☷</span> Community</a>
    <div class="student-menu-sub"><a href="{{ route('student.community') }}">Discussions</a><a href="{{ route('student.community.questions') }}">My Questions</a><a href="{{ route('student.community.replies') }}">My Replies</a></div>
    <a class="student-menu-link {{ request()->routeIs('student.points') ? 'active' : '' }}" href="{{ route('student.points') }}"><span>✧</span> Points & Rewards</a>
    <div class="student-menu-sub"><a href="{{ route('student.points') }}#history">Points History</a><a href="{{ route('student.points') }}#achievements">Achievements</a><a href="{{ route('student.points') }}#leaderboard">Leaderboard</a></div>
    <a class="student-menu-link {{ request()->routeIs('student.notifications') ? 'active' : '' }}" href="{{ route('student.notifications') }}"><span>♧</span> Notifications @if($unreadCount)<em class="student-menu-count">{{ $unreadCount }}</em>@endif</a>
    <div class="student-menu-label">ACCOUNT</div>
    <a class="student-menu-link {{ request()->routeIs('student.settings') ? 'active' : '' }}" href="{{ route('student.settings') }}"><span>⚙</span> Account Settings</a>
    <div class="student-menu-sub"><a href="{{ route('student.settings') }}#email">Email</a><a href="{{ route('student.settings') }}#password">Password</a><a href="{{ route('student.settings') }}#privacy">Privacy</a></div>
    <a class="student-menu-link {{ request()->routeIs('student.support') ? 'active' : '' }}" href="{{ route('student.support') }}"><span>?</span> Help & Support</a>
    <div class="student-menu-sub"><a href="{{ route('frontend.faq') }}">FAQ</a><a href="{{ route('student.support') }}">Contact Admin</a></div>
    <form method="POST" action="{{ route('logout') }}" class="student-logout-form">@csrf<button class="student-menu-link student-logout" type="submit"><span>↪</span> Logout / Sign Out</button></form>
</aside>
