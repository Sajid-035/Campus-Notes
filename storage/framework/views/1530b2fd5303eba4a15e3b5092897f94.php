<?php
    $panelUser = auth()->user();
    $unreadCount = $panelUser->studentNotifications()->whereNull('read_at')->count();
?>
<aside class="student-sidebar">
    <div class="student-sidebar-brand">
        <span class="student-sidebar-logo">C</span>
        <span><strong>CampusNotes</strong><small>Student Panel</small></span>
    </div>
    <div class="student-sidebar-profile">
        <div class="student-sidebar-avatar student-avatar-frame">
            <?php if($panelUser->avatar_url): ?><img src="<?php echo e($panelUser->avatar_url); ?>" alt="<?php echo e($panelUser->name); ?> profile photo"><?php else: ?><?php echo e(strtoupper(substr($panelUser->name, 0, 1))); ?><?php endif; ?>
        </div>
        <div class="student-sidebar-profile-text"><strong><?php echo e($panelUser->name); ?></strong><small><?php echo e($panelUser->student_id ?: 'Student account'); ?></small></div>
        <span class="student-online-dot" title="Signed in"></span>
    </div>

    <div class="student-menu-label">MAIN MENU</div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('student.dashboard')); ?>"><span>▦</span> Dashboard</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.dashboard')); ?>">Overview</a><a href="<?php echo e(route('student.dashboard')); ?>#stats">Statistics</a></div>

    <div class="student-menu-label">MY ACADEMIC SPACE</div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.profile', 'student.profile.edit', 'student.id-card') ? 'active' : ''); ?>" href="<?php echo e(route('student.profile')); ?>"><span>♙</span> My Profile</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.profile')); ?>">View Profile</a><a href="<?php echo e(route('student.profile.edit')); ?>">Edit Profile</a><a href="<?php echo e(route('student.id-card')); ?>">Digital Student ID</a></div>

    <a class="student-menu-link <?php echo e(request()->routeIs('resources.upload') || request()->routeIs('student.upload-history') ? 'active' : ''); ?>" href="<?php echo e(route('resources.upload')); ?>"><span>⇧</span> Upload Resource</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('resources.upload')); ?>">Add New Resource</a><a href="<?php echo e(route('student.upload-history')); ?>">Upload History</a></div>

    <a class="student-menu-link <?php echo e(request()->routeIs('student.resources') ? 'active' : ''); ?>" href="<?php echo e(route('student.resources', ['status' => 'all'])); ?>"><span>▤</span> My Resources</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.resources', ['status' => 'all'])); ?>">All Resources</a><a href="<?php echo e(route('student.resources', ['status' => 'published'])); ?>">Published</a><a href="<?php echo e(route('student.resources', ['status' => 'pending'])); ?>">Pending</a><a href="<?php echo e(route('student.resources', ['status' => 'rejected'])); ?>">Rejected</a><a href="<?php echo e(route('student.resources', ['status' => 'draft'])); ?>">Drafts</a></div>

    <a class="student-menu-link <?php echo e(request()->routeIs('student.bookmarks') ? 'active' : ''); ?>" href="<?php echo e(route('student.bookmarks')); ?>"><span>☆</span> My Bookmarks</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.bookmarks')); ?>">Saved Notes & Materials</a><a href="<?php echo e(route('student.bookmarks')); ?>?category=Previous%20Questions">Saved Questions</a><a href="<?php echo e(route('student.bookmarks')); ?>?category=Assignments">Saved Assignments</a></div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.downloads') ? 'active' : ''); ?>" href="<?php echo e(route('student.downloads')); ?>"><span>⇩</span> My Downloads</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.downloads')); ?>">Download History</a><a href="<?php echo e(route('student.downloads',['period'=>'recent'])); ?>">Recent Downloads</a></div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.reviews') ? 'active' : ''); ?>" href="<?php echo e(route('student.reviews')); ?>"><span>★</span> My Reviews</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.reviews')); ?>">All Reviews</a><a href="<?php echo e(route('resources.index')); ?>">Review a Resource</a></div>

    <div class="student-menu-label">CAMPUS COMMUNITY</div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.community*') ? 'active' : ''); ?>" href="<?php echo e(route('student.community')); ?>"><span>☷</span> Community</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.community')); ?>">Discussions</a><a href="<?php echo e(route('student.community.questions')); ?>">My Questions</a><a href="<?php echo e(route('student.community.replies')); ?>">My Replies</a></div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.points') ? 'active' : ''); ?>" href="<?php echo e(route('student.points')); ?>"><span>✧</span> Points & Rewards</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.points')); ?>#history">Points History</a><a href="<?php echo e(route('student.points')); ?>#achievements">Achievements</a><a href="<?php echo e(route('student.points')); ?>#leaderboard">Leaderboard</a></div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.notifications') ? 'active' : ''); ?>" href="<?php echo e(route('student.notifications')); ?>"><span>♧</span> Notifications <?php if($unreadCount): ?><em class="student-menu-count"><?php echo e($unreadCount); ?></em><?php endif; ?></a>
    <div class="student-menu-label">ACCOUNT</div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.settings') ? 'active' : ''); ?>" href="<?php echo e(route('student.settings')); ?>"><span>⚙</span> Account Settings</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('student.settings')); ?>#email">Email</a><a href="<?php echo e(route('student.settings')); ?>#password">Password</a><a href="<?php echo e(route('student.settings')); ?>#privacy">Privacy</a></div>
    <a class="student-menu-link <?php echo e(request()->routeIs('student.support') ? 'active' : ''); ?>" href="<?php echo e(route('student.support')); ?>"><span>?</span> Help & Support</a>
    <div class="student-menu-sub"><a href="<?php echo e(route('frontend.faq')); ?>">FAQ</a><a href="<?php echo e(route('student.support')); ?>">Contact Admin</a></div>
    <form method="POST" action="<?php echo e(route('logout')); ?>" class="student-logout-form"><?php echo csrf_field(); ?><button class="student-menu-link student-logout" type="submit"><span>↪</span> Logout / Sign Out</button></form>
</aside>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/frontend/student/partials/sidebar.blade.php ENDPATH**/ ?>