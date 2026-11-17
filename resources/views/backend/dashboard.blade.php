@extends('backend.layouts.app')

@section('title', 'Admin Dashboard')

@push('style')
<style>
    .admin-dashboard .dashboard-hero {
        position: relative;
        overflow: hidden;
        border: 0;
        border-radius: 14px;
        background: linear-gradient(120deg, #172554 0%, #1e40af 58%, #4f46e5 100%);
        color: #fff;
        box-shadow: 0 10px 28px rgba(30, 64, 175, .16);
    }
    .admin-dashboard .dashboard-hero:after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        right: -55px;
        top: -95px;
        border: 34px solid rgba(255,255,255,.08);
        border-radius: 50%;
    }
    .admin-dashboard .dashboard-hero .hero-content { position: relative; z-index: 1; }
    .admin-dashboard .hero-date { color: rgba(255,255,255,.76); font-size: 13px; }
    .admin-dashboard .hero-action { border-radius: 8px; font-weight: 600; margin: 4px 4px 0 0; }
    .admin-dashboard .stat-card {
        height: 100%;
        border: 1px solid #edf0f5;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(28, 39, 60, .045);
        transition: transform .18s ease, box-shadow .18s ease;
    }
    .admin-dashboard .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 22px rgba(28,39,60,.08); }
    .admin-dashboard .stat-card .card-body { padding: 20px; }
    .admin-dashboard .stat-top { display: flex; align-items: center; justify-content: space-between; }
    .admin-dashboard .stat-icon {
        width: 44px; height: 44px; display: inline-flex; align-items: center; justify-content: center;
        border-radius: 11px; font-size: 17px;
    }
    .admin-dashboard .stat-label { color: #7b8495; font-size: 12px; font-weight: 700; letter-spacing: .045em; text-transform: uppercase; }
    .admin-dashboard .stat-value { color: #202b3c; font-size: 29px; line-height: 1.2; font-weight: 700; margin-top: 9px; }
    .admin-dashboard .stat-note { color: #8a93a3; font-size: 12px; margin-top: 5px; }
    .admin-dashboard .tone-blue { background: #eaf1ff; color: #3267d6; }
    .admin-dashboard .tone-green { background: #e7f7ef; color: #1c9b60; }
    .admin-dashboard .tone-orange { background: #fff2e3; color: #db851d; }
    .admin-dashboard .tone-purple { background: #f0eaff; color: #7950c8; }
    .admin-dashboard .tone-red { background: #ffebeb; color: #dc5353; }
    .admin-dashboard .tone-teal { background: #e3f7f7; color: #19999a; }
    .admin-dashboard .dashboard-panel {
        border: 1px solid #edf0f5; border-radius: 12px; box-shadow: 0 4px 16px rgba(28,39,60,.045);
        height: 100%;
    }
    .admin-dashboard .dashboard-panel .card-header {
        background: #fff; border-bottom: 1px solid #f0f2f6; padding: 17px 20px; border-radius: 12px 12px 0 0;
    }
    .admin-dashboard .dashboard-panel .card-header h4 { font-size: 15px; margin: 0; color: #263246; font-weight: 700; }
    .admin-dashboard .panel-subtitle { color: #8a93a3; font-size: 12px; margin-top: 4px; }
    .admin-dashboard .table td, .admin-dashboard .table th { vertical-align: middle; padding: 12px 14px; }
    .admin-dashboard .table thead th { border-top: 0; color: #8a93a3; font-size: 10px; text-transform: uppercase; letter-spacing: .05em; }
    .admin-dashboard .item-title { color: #303c50; font-weight: 600; font-size: 13px; }
    .admin-dashboard .item-meta { color: #97a0ae; font-size: 11px; margin-top: 3px; }
    .admin-dashboard .avatar-initial {
        width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center;
        border-radius: 50%; background: #edf2ff; color: #4369bd; font-weight: 700; font-size: 12px;
    }
    .admin-dashboard .empty-state { color: #8a93a3; text-align: center; padding: 28px 12px; font-size: 13px; }
    .admin-dashboard .empty-state i { display: block; font-size: 25px; color: #c3cad5; margin-bottom: 9px; }
    .admin-dashboard .quick-link {
        display: flex; align-items: center; padding: 13px 14px; margin-bottom: 9px;
        border: 1px solid #edf0f5; border-radius: 9px; color: #39465a; transition: .15s ease;
    }
    .admin-dashboard .quick-link:hover { text-decoration: none; border-color: #cbd8f7; background: #f8faff; color: #2454b8; }
    .admin-dashboard .quick-link i { width: 28px; color: #5475c4; }
    .admin-dashboard .quick-link span { flex: 1; font-size: 13px; font-weight: 600; }
    .admin-dashboard .quick-link small { color: #8a93a3; }
    .admin-dashboard .todo-card { border: 1px solid #edf0f5; border-radius: 12px; box-shadow: 0 4px 16px rgba(28,39,60,.045); }
    .admin-dashboard .todo-task { border: 1px solid #edf0f5; border-radius: 8px; padding: 10px 12px; margin-bottom: 8px; }
    .admin-dashboard .pill-soft { border-radius: 20px; padding: 5px 9px; font-size: 10px; font-weight: 700; }
    @media (max-width: 767px) {
        .admin-dashboard .dashboard-hero { padding: 20px !important; }
        .admin-dashboard .stat-value { font-size: 25px; }
        .admin-dashboard .table-responsive { border: 0; }
    }
</style>
@endpush

@section('main')
<div class="main-content admin-dashboard">
    <section class="section">
        <div class="section-header">
            <h1>Admin Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Overview</div>
            </div>
        </div>

        @php($stats = $dashboardStats ?? [])
        <div class="card dashboard-hero mb-4">
            <div class="card-body p-4 p-md-5 hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="hero-date mb-2">{{ now()->format('l, d F Y') }}</div>
                        <h2 class="text-white mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
                        <p class="mb-0" style="color:rgba(255,255,255,.82)">Here is what is happening across your Campus Notes community today.</p>
                    </div>
                    <div class="col-lg-5 text-lg-right mt-3 mt-lg-0">
                        @can('user-list')
                            <a href="{{ route('admin.student-applications.index', ['status' => 'pending']) }}" class="btn btn-light hero-action">
                                <i class="fas fa-user-check mr-1"></i> Member approvals
                                @if(($stats['members_pending'] ?? 0) > 0)<span class="badge badge-danger ml-1">{{ $stats['members_pending'] }}</span>@endif
                            </a>
                        @endcan
                        @can('resources-list')
                            <a href="{{ route('admin.resources.index', ['status' => 'pending']) }}" class="btn btn-outline-light hero-action">
                                <i class="fas fa-book-open mr-1"></i> Review resources
                            </a>
                        @endcan
                        @can('blog-list')
                            <a href="{{ route('admin.blog.posts.index', ['status' => 'pending']) }}" class="btn btn-outline-light hero-action">
                                <i class="fas fa-newspaper mr-1"></i> Review blogs
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @can('user-list')
            <div class="col-xl-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card stat-card"><div class="card-body">
                    <div class="stat-top"><span class="stat-label">Total members</span><span class="stat-icon tone-blue"><i class="fas fa-users"></i></span></div>
                    <div class="stat-value">{{ number_format($stats['members_total'] ?? 0) }}</div>
                    <div class="stat-note">{{ $stats['members_students'] ?? 0 }} students · {{ $stats['members_teachers'] ?? 0 }} teachers · {{ $stats['members_staff'] ?? 0 }} staff</div>
                </div></div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card stat-card"><div class="card-body">
                    <div class="stat-top"><span class="stat-label">Pending members</span><span class="stat-icon tone-orange"><i class="fas fa-user-clock"></i></span></div>
                    <div class="stat-value">{{ number_format($stats['members_pending'] ?? 0) }}</div>
                    <div class="stat-note">Awaiting admin approval</div>
                </div></div>
            </div>
            @endcan

            @can('resources-list')
            <div class="col-xl-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card stat-card"><div class="card-body">
                    <div class="stat-top"><span class="stat-label">Academic resources</span><span class="stat-icon tone-teal"><i class="fas fa-book"></i></span></div>
                    <div class="stat-value">{{ number_format($stats['resources_total'] ?? 0) }}</div>
                    <div class="stat-note">{{ $stats['resources_approved'] ?? 0 }} published · {{ $stats['resources_pending'] ?? 0 }} pending</div>
                </div></div>
            </div>
            @endcan

            @can('blog-list')
            <div class="col-xl-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card stat-card"><div class="card-body">
                    <div class="stat-top"><span class="stat-label">Blog posts</span><span class="stat-icon tone-purple"><i class="fas fa-newspaper"></i></span></div>
                    <div class="stat-value">{{ number_format($stats['blogs_total'] ?? 0) }}</div>
                    <div class="stat-note">{{ $stats['blogs_published'] ?? 0 }} published · {{ $stats['blogs_pending'] ?? 0 }} pending</div>
                </div></div>
            </div>
            @endcan

            @can('contact-messages-list')
            <div class="col-xl-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card stat-card"><div class="card-body">
                    <div class="stat-top"><span class="stat-label">New messages</span><span class="stat-icon tone-red"><i class="fas fa-envelope"></i></span></div>
                    <div class="stat-value">{{ number_format($stats['messages_new'] ?? 0) }}</div>
                    <div class="stat-note">Unread contact enquiries</div>
                </div></div>
            </div>
            @endcan
            @can('resources-list')
            <div class="col-xl-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card stat-card"><div class="card-body">
                    <div class="stat-top"><span class="stat-label">Resource downloads</span><span class="stat-icon tone-green"><i class="fas fa-download"></i></span></div>
                    <div class="stat-value">{{ number_format($stats['resources_downloads'] ?? 0) }}</div>
                    <div class="stat-note">Total downloads from the library</div>
                </div></div>
            </div>
            @endcan
        </div>

        <div class="row">
            @can('user-list')
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card dashboard-panel">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><h4><i class="fas fa-user-check text-primary mr-2"></i>Pending member applications</h4><div class="panel-subtitle">New students, teachers and staff waiting for approval</div></div>
                        <a href="{{ route('admin.student-applications.index', ['status' => 'pending']) }}" class="btn btn-sm btn-light">View all <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                    <div class="card-body p-0">
                        @if(($pendingMembers ?? collect())->isEmpty())
                            <div class="empty-state"><i class="fas fa-check-circle"></i>You're all caught up. No pending member applications.</div>
                        @else
                            <div class="table-responsive"><table class="table table-hover mb-0">
                                <thead><tr><th>Member</th><th>Type / ID</th><th>Submitted</th></tr></thead>
                                <tbody>
                                @foreach($pendingMembers as $member)
                                    <tr>
                                        <td><div class="d-flex align-items-center"><span class="avatar-initial mr-2">{{ strtoupper(substr($member->name, 0, 1)) }}</span><div><div class="item-title">{{ $member->name }}</div><div class="item-meta">{{ $member->email }}</div></div></div></td>
                                        <td><span class="badge badge-info pill-soft">{{ ucfirst($member->account_type ?: 'student') }}</span><div class="item-meta">{{ $member->institutional_id_number ?: 'ID not provided' }}</div></td>
                                        <td class="text-muted small">{{ optional($member->application_submitted_at ?: $member->created_at)->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table></div>
                        @endif
                    </div>
                </div>
            </div>
            @endcan

            @can('resources-list')
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card dashboard-panel">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><h4><i class="fas fa-book-open text-info mr-2"></i>Resources awaiting review</h4><div class="panel-subtitle">Recently submitted academic resources</div></div>
                        <a href="{{ route('admin.resources.index', ['status' => 'pending']) }}" class="btn btn-sm btn-light">View all <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                    <div class="card-body p-0">
                        @if(($pendingResources ?? collect())->isEmpty())
                            <div class="empty-state"><i class="fas fa-check-circle"></i>No resources are waiting for review.</div>
                        @else
                            <div class="table-responsive"><table class="table table-hover mb-0">
                                <thead><tr><th>Resource</th><th>Contributor</th><th>Submitted</th></tr></thead>
                                <tbody>
                                @foreach($pendingResources as $resource)
                                    <tr>
                                        <td><div class="item-title">{{ \Illuminate\Support\Str::limit($resource->title, 42) }}</div><div class="item-meta">{{ $resource->category }} · {{ optional($resource->department)->name ?: 'No department' }}</div></td>
                                        <td><div class="item-title">{{ optional($resource->uploader)->name ?: ($resource->uploader_name ?: 'Unknown') }}</div><div class="item-meta">{{ optional($resource->uploader)->email }}</div></td>
                                        <td class="text-muted small">{{ $resource->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table></div>
                        @endif
                    </div>
                </div>
            </div>
            @endcan
        </div>

        <div class="row">
            @can('blog-list')
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card dashboard-panel">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><h4><i class="fas fa-newspaper text-purple mr-2"></i>Blogs awaiting approval</h4><div class="panel-subtitle">Community blog submissions to review</div></div>
                        <a href="{{ route('admin.blog.posts.index', ['status' => 'pending']) }}" class="btn btn-sm btn-light">View all <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                    <div class="card-body p-0">
                        @if(($pendingBlogs ?? collect())->isEmpty())
                            <div class="empty-state"><i class="fas fa-check-circle"></i>No blog posts are waiting for approval.</div>
                        @else
                            <div class="table-responsive"><table class="table table-hover mb-0">
                                <thead><tr><th>Blog post</th><th>Author</th><th>Submitted</th></tr></thead>
                                <tbody>
                                @foreach($pendingBlogs as $post)
                                    <tr>
                                        <td><div class="item-title">{{ \Illuminate\Support\Str::limit($post->title, 45) }}</div><div class="item-meta">{{ optional($post->category)->name ?: 'Uncategorised' }}</div></td>
                                        <td><div class="item-title">{{ optional($post->author)->name ?: 'Unknown author' }}</div><div class="item-meta">{{ optional($post->author)->email }}</div></td>
                                        <td class="text-muted small">{{ $post->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table></div>
                        @endif
                    </div>
                </div>
            </div>
            @endcan

            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card dashboard-panel">
                    <div class="card-header"><h4><i class="fas fa-bolt text-warning mr-2"></i>Quick access</h4><div class="panel-subtitle">Jump straight to the tools you use most</div></div>
                    <div class="card-body">
                        @can('user-list')<a class="quick-link" href="{{ route('admin.student-applications.index') }}"><i class="fas fa-users"></i><span>Member Applications</span><small>{{ $stats['members_pending'] ?? 0 }} pending</small></a>@endcan
                        @can('user-list')<a class="quick-link" href="{{ route('users.index') }}"><i class="fas fa-user-cog"></i><span>Manage Users</span><i class="fas fa-chevron-right"></i></a>@endcan
                        @can('resources-list')<a class="quick-link" href="{{ route('admin.resources.index') }}"><i class="fas fa-book"></i><span>User Resources</span><small>{{ $stats['resources_pending'] ?? 0 }} pending</small></a>@endcan
                        @can('resources-list')<a class="quick-link" href="{{ route('admin.academic-settings.index') }}"><i class="fas fa-sliders-h"></i><span>Academic Settings</span><i class="fas fa-chevron-right"></i></a>@endcan
                        @can('blog-list')<a class="quick-link" href="{{ route('admin.blog.posts.index') }}"><i class="fas fa-newspaper"></i><span>Blog Management</span><small>{{ $stats['blogs_pending'] ?? 0 }} pending</small></a>@endcan
                        @can('contact-messages-list')<a class="quick-link" href="{{ route('admin.contact-messages.index', ['status' => 'new']) }}"><i class="fas fa-envelope"></i><span>Contact Inbox</span><small>{{ $stats['messages_new'] ?? 0 }} new</small></a>@endcan
                        @can('manage-permissions')<a class="quick-link" href="{{ route('manage_permissions') }}"><i class="fas fa-shield-alt"></i><span>Role Permissions</span><i class="fas fa-chevron-right"></i></a>@endcan
                    </div>
                </div>
            </div>
        </div>

        @can('user-list')
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card dashboard-panel">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><h4><i class="fas fa-user-plus text-success mr-2"></i>Recently registered members</h4><div class="panel-subtitle">Latest account registrations across all member types</div></div>
                        <a href="{{ route('admin.student-applications.index') }}" class="btn btn-sm btn-light">Manage members</a>
                    </div>
                    <div class="card-body p-0">
                        @if(($recentMembers ?? collect())->isEmpty())
                            <div class="empty-state"><i class="fas fa-users"></i>No member registrations yet.</div>
                        @else
                            <div class="table-responsive"><table class="table table-hover mb-0">
                                <thead><tr><th>Member</th><th>Member type</th><th>Institutional ID</th><th>Department</th><th>Status</th><th>Joined</th></tr></thead>
                                <tbody>
                                @foreach($recentMembers as $member)
                                    @php($memberStatus = $member->account_status ?: 'pending')
                                    <tr>
                                        <td><div class="item-title">{{ $member->name }}</div><div class="item-meta">{{ $member->email }}</div></td>
                                        <td>{{ ucfirst($member->account_type ?: 'student') }}</td>
                                        <td>{{ $member->institutional_id_number ?: '—' }}</td>
                                        <td>{{ optional($member->academicDepartment)->name ?: '—' }}</td>
                                        <td><span class="badge badge-{{ $memberStatus === 'approved' ? 'success' : ($memberStatus === 'rejected' ? 'danger' : 'warning') }} pill-soft">{{ ucfirst(str_replace('_', ' ', $memberStatus)) }}</span></td>
                                        <td class="text-muted small">{{ $member->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('dashboard-access')
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card todo-card">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <div><h4 class="mb-1"><i class="fas fa-clipboard-list text-primary mr-2"></i>Admin To-Do List</h4><div class="panel-subtitle">Keep track of your admin tasks and reminders</div></div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('todo.store') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="form-row align-items-end">
                                <div class="form-group col-lg-5 col-md-5"><label for="todo-name">Task name</label><input id="todo-name" type="text" name="name" class="form-control" placeholder="What needs to be done?" required></div>
                                <div class="form-group col-lg-2 col-md-3"><label for="todo-time">Time</label><input id="todo-time" type="time" name="time" class="form-control" required></div>
                                <div class="form-group col-lg-3 col-md-3"><label for="todo-date">Date</label><input id="todo-date" type="date" name="date" class="form-control" value="{{ now()->toDateString() }}" required></div>
                                <div class="form-group col-lg-2 col-md-1"><button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus mr-1"></i>Add</button></div>
                            </div>
                        </form>
                        @forelse(($data ?? collect()) as $index => $task)
                            <div class="todo-task d-flex flex-wrap align-items-center justify-content-between">
                                <div class="mr-3"><span class="badge badge-light mr-2">{{ $index + 1 }}</span><strong class="text-dark">{{ $task->name }}</strong><div class="item-meta ml-4">{{ \Carbon\Carbon::parse($task->date)->format('d M Y') }} at {{ \Carbon\Carbon::parse($task->time)->format('h:i A') }}</div></div>
                                <div class="mt-2 mt-md-0">
                                    <a href="{{ route('todo.edit', $task->id) }}" class="btn btn-sm btn-light" aria-label="Edit task"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('todo.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this task?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-light text-danger" aria-label="Delete task"><i class="fas fa-trash"></i></button></form>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state py-3"><i class="fas fa-clipboard-check"></i>No tasks yet. Add a reminder above.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </section>
</div>
@endsection
