<div class="main-sidebar sidebar-style-2">
<aside id="sidebar-wrapper">
<div class="sidebar-brand"><a href="<?php echo e(route('dashboard')); ?>">Campus Notes</a></div>
<ul class="sidebar-menu">
<li class="menu-header">Workspace</li>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['contact-messages-list','contact-messages-update','contact-messages-delete'])): ?>
<li class="nav-item <?php echo e(Request::routeIs('admin.contact-messages.*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('admin.contact-messages.index')); ?>" class="nav-link"><i class="fas fa-envelope"></i><span>Contact Inbox</span></a>
</li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['resources-list','resources-approve','resources-delete'])): ?>
<li class="menu-header">Academic Library</li>
<li class="nav-item <?php echo e(Request::routeIs('admin.resources.*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('admin.resources.index')); ?>" class="nav-link"><i class="fas fa-book-open"></i><span>Resource Moderation</span></a>
</li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['blog-list','blog-create','blog-edit','blog-delete'])): ?>
<li class="menu-header">Content</li>
<li class="nav-item dropdown <?php echo e(Request::routeIs('admin.blog.*') ? 'active' : ''); ?>">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i><span>Blog Management</span></a>
    <ul class="dropdown-menu">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-list')): ?><li><a class="nav-link" href="<?php echo e(route('admin.blog.posts.index')); ?>">All Posts</a></li><?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-create')): ?><li><a class="nav-link" href="<?php echo e(route('admin.blog.posts.create')); ?>">Add New Post</a></li><?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-list')): ?><li><a class="nav-link" href="<?php echo e(route('admin.blog.categories.index')); ?>">Categories</a></li><?php endif; ?>
    </ul>
</li>
<?php endif; ?>
<li class="nav-item <?php echo e(Request::routeIs('dashboard') ? 'active' : ''); ?>"><a href="<?php echo e(route('dashboard')); ?>" class="nav-link"><i class="fas fa-th-large"></i><span>Dashboard</span></a></li>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-list','user-create','user-edit','user-delete','role-list','role-create','role-edit','role-delete','manage-permissions'])): ?>
<li class="menu-header">Administration</li>
<li class="nav-item dropdown <?php echo e(Request::routeIs('users.*') || Request::routeIs('roles.*') || Request::routeIs('manage_permissions') || Request::routeIs('admin.student-applications.*') ? 'active' : ''); ?>">
<a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>User Management</span></a>
<ul class="dropdown-menu">
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-list','user-create'])): ?>
<li class="dropdown-header">Users</li>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?><li><a class="nav-link" href="<?php echo e(route('users.create')); ?>">Add User</a></li><?php endif; ?>
<li><a class="nav-link" href="<?php echo e(route('users.index')); ?>">User List</a></li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?><li><a class="nav-link" href="<?php echo e(route('admin.student-applications.index')); ?>">Student Applications</a></li><?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['role-list','role-create'])): ?>
<li class="dropdown-header">Roles</li>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?><li><a class="nav-link" href="<?php echo e(route('roles.create')); ?>">Add Role</a></li><?php endif; ?>
<li><a class="nav-link" href="<?php echo e(route('roles.index')); ?>">Role List</a></li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-permissions')): ?><li class="dropdown-header">Permissions</li><li><a class="nav-link" href="<?php echo e(route('manage_permissions')); ?>">Role Permissions</a></li><?php endif; ?>
</ul></li>
<?php endif; ?>
</ul>
<div class="hide-sidebar-mini mt-4 mb-4 p-3"><a href="<?php echo e(route('logout')); ?>" class="btn btn-primary btn-lg btn-block btn-icon-split" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sign Out</a><form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form></div>
</aside></div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/backend/components/sidebar.blade.php ENDPATH**/ ?>