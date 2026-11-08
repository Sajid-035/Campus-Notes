<div class="main-sidebar sidebar-style-2">
<aside id="sidebar-wrapper">
<div class="sidebar-brand"><a href="{{ route('dashboard') }}">Campus Notes</a></div>
<ul class="sidebar-menu">
<li class="menu-header">Workspace</li>
@canany(['contact-messages-list','contact-messages-update','contact-messages-delete'])
<li class="nav-item {{ Request::routeIs('admin.contact-messages.*') ? 'active' : '' }}">
    <a href="{{ route('admin.contact-messages.index') }}" class="nav-link"><i class="fas fa-envelope"></i><span>Contact Inbox</span></a>
</li>
@endcan
@canany(['resources-list','resources-approve','resources-delete'])
<li class="menu-header">Academic Library</li>
<li class="nav-item {{ Request::routeIs('admin.resources.*') ? 'active' : '' }}">
    <a href="{{ route('admin.resources.index') }}" class="nav-link"><i class="fas fa-book-open"></i><span>Resource Moderation</span></a>
</li>
@endcan
@canany(['blog-list','blog-create','blog-edit','blog-delete'])
<li class="menu-header">Content</li>
<li class="nav-item dropdown {{ Request::routeIs('admin.blog.*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i><span>Blog Management</span></a>
    <ul class="dropdown-menu">
        @can('blog-list')<li><a class="nav-link" href="{{ route('admin.blog.posts.index') }}">All Posts</a></li>@endcan
        @can('blog-create')<li><a class="nav-link" href="{{ route('admin.blog.posts.create') }}">Add New Post</a></li>@endcan
        @can('blog-list')<li><a class="nav-link" href="{{ route('admin.blog.categories.index') }}">Categories</a></li>@endcan
    </ul>
</li>
@endcan
<li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-th-large"></i><span>Dashboard</span></a></li>
@canany(['user-list','user-create','user-edit','user-delete','role-list','role-create','role-edit','role-delete','manage-permissions'])
<li class="menu-header">Administration</li>
<li class="nav-item dropdown {{ Request::routeIs('users.*') || Request::routeIs('roles.*') || Request::routeIs('manage_permissions') || Request::routeIs('admin.student-applications.*') ? 'active' : '' }}">
<a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>User Management</span></a>
<ul class="dropdown-menu">
@canany(['user-list','user-create'])
<li class="dropdown-header">Users</li>
@can('user-create')<li><a class="nav-link" href="{{ route('users.create') }}">Add User</a></li>@endcan
<li><a class="nav-link" href="{{ route('users.index') }}">User List</a></li>
@endcan
@can('user-list')<li><a class="nav-link" href="{{ route('admin.student-applications.index') }}">Student Applications</a></li>@endcan
@canany(['role-list','role-create'])
<li class="dropdown-header">Roles</li>
@can('role-create')<li><a class="nav-link" href="{{ route('roles.create') }}">Add Role</a></li>@endcan
<li><a class="nav-link" href="{{ route('roles.index') }}">Role List</a></li>
@endcan
@can('manage-permissions')<li class="dropdown-header">Permissions</li><li><a class="nav-link" href="{{ route('manage_permissions') }}">Role Permissions</a></li>@endcan
</ul></li>
@endcan
</ul>
<div class="hide-sidebar-mini mt-4 mb-4 p-3"><a href="{{ route('logout') }}" class="btn btn-primary btn-lg btn-block btn-icon-split" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sign Out</a><form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form></div>
</aside></div>
