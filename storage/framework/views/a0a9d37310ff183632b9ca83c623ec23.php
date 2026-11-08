<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(config('app.name')); ?></a>
        </div>
        <ul class="sidebar-menu">
            
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown <?php echo e(Request::routeIs('dashboard') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-link">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

         
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('analytics-index')): ?>
    <li class="nav-item <?php echo e(Request::routeIs('website.analytics') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('website.analytics')); ?>" class="nav-link">
            <i class="fas fa-chart-line"></i>
            <span>Website Analytics</span>
        </a>
    </li>
<?php endif; ?>


            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-list', 'user-create', 'user-edit', 'user-delete', 'role-list', 'role-create', 'role-edit',
                'role-delete', 'manage-permissions'])): ?>
                <li
                    class="nav-item dropdown 
    <?php echo e(Request::routeIs('users.*') || Request::routeIs('roles.*') || Request::routeIs('manage_permissions') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fa-solid fa-user"></i>
                        <span>User Management</span>
                    </a>
                    <ul class="dropdown-menu">

                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-list', 'user-create'])): ?>
                            <li class="dropdown-header">Users</li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                                <li class="<?php echo e(Request::routeIs('users.create') ? 'active' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(route('users.create')); ?>">Add User</a>
                                </li>
                            <?php endif; ?>
                            <li class="<?php echo e(Request::routeIs('users.index') ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('users.index')); ?>">User List</a>
                            </li>
                        <?php endif; ?>

                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['role-list', 'role-create'])): ?>
                            <li class="dropdown-header">Roles</li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
                                <li class="<?php echo e(Request::routeIs('roles.create') ? 'active' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(route('roles.create')); ?>">Add Role</a>
                                </li>
                            <?php endif; ?>
                            <li class="<?php echo e(Request::routeIs('roles.index') ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('roles.index')); ?>">Role List</a>
                            </li>
                        <?php endif; ?>

                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-permissions')): ?>
                            <li class="dropdown-header">Permissions</li>
                            <li class="<?php echo e(Request::routeIs('manage_permissions') ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('manage_permissions')); ?>">Role Permissions</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['blog-list', 'blog-create', 'blog-edit', 'blog-delete'])): ?>
                <li class="nav-item dropdown <?php echo e(Request::routeIs('blog.*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-blog"></i><span>Blogs</span></a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-create')): ?>
                            <li class="<?php echo e(Request::routeIs('blog.create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('blog.create')); ?>">Add Blog</a>
                            </li>
                        <?php endif; ?>
                        <li class="<?php echo e(Request::routeIs('blog.list') ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(route('blog.list')); ?>">Blog List</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['news-list', 'news-create', 'news-edit', 'news-delete'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i><span>News
                            Management</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Add News</a></li>
                        <li><a class="nav-link" href="#">All News</a></li>
                        <li><a class="nav-link" href="#">Pending News</a></li>
                        <li><a class="nav-link" href="#">Draft News</a></li>
                        <li><a class="nav-link" href="#">Breaking News</a></li>
                        <li><a class="nav-link" href="#">Featured / Slider News</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['category-list', 'category-create', 'category-edit', 'category-delete'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-sitemap"></i><span>Category
                            Management</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Main Categories</a></li>
                        <li><a class="nav-link" href="#">Sub Categories</a></li>
                        <li><a class="nav-link" href="#">Region / District Category</a></li>
                        <li><a class="nav-link" href="#">Menu Management</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['media-list', 'media-create', 'media-edit', 'media-delete'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-photo-video"></i><span>Media
                            Manager</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Photo Gallery</a></li>
                        <li><a class="nav-link" href="#">Video Gallery</a></li>
                        <li><a class="nav-link" href="#">Upload Images</a></li>
                        <li><a class="nav-link" href="#">File Manager</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['reporter-list', 'reporter-create', 'reporter-edit', 'reporter-delete', 'reporter-assign'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-pen-nib"></i><span>Writer /
                            Reporter</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Add Reporter</a></li>
                        <li><a class="nav-link" href="#">Reporter List</a></li>
                        <li><a class="nav-link" href="#">Assign News</a></li>
                        <li><a class="nav-link" href="#">Reporter Permissions</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ads-list', 'ads-create', 'ads-edit', 'ads-delete'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-ad"></i><span>Advertisement</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Add Advertisement</a></li>
                        <li><a class="nav-link" href="#">Ad Positions</a></li>
                        <li><a class="nav-link" href="#">Ad Schedule</a></li>
                        <li><a class="nav-link" href="#">Ad Reports</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['homepage-slider', 'homepage-breaking', 'homepage-featured', 'homepage-section-order'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-home"></i><span>Homepage
                            Settings</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Slider Settings</a></li>
                        <li><a class="nav-link" href="#">Breaking News Settings</a></li>
                        <li><a class="nav-link" href="#">Featured Section Control</a></li>
                        <li><a class="nav-link" href="#">Section Order</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['comments-manage', 'contact-messages', 'user-feedback'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-comments"></i><span>Comments &
                            Feedback</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Manage Comments</a></li>
                        <li><a class="nav-link" href="#">Contact Messages</a></li>
                        <li><a class="nav-link" href="#">User Feedback</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['report-news', 'report-view-count', 'report-popular', 'report-daily-monthly'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-file-alt"></i><span>Reports</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">News Reports</a></li>
                        <li><a class="nav-link" href="#">View Count</a></li>
                        <li><a class="nav-link" href="#">Popular News</a></li>
                        <li><a class="nav-link" href="#">Daily / Monthly Reports</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['archive-date-wise', 'archive-category-wise'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-archive"></i><span>Archive</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Date-wise Archive</a></li>
                        <li><a class="nav-link" href="#">Category-wise Archive</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['security-login-logs', 'security-ip-block', 'security-backup'])): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-shield-alt"></i><span>Security</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Login Logs</a></li>
                        <li><a class="nav-link" href="#">IP Block</a></li>
                        <li><a class="nav-link" href="#">Backup Database</a></li>
                    </ul>
                </li>
            <?php endif; ?>

        </ul>

        
        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="<?php echo e(route('logout')); ?>" class="btn btn-primary btn-lg btn-block btn-icon-split"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Sign Out
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </aside>
</div>
<?php /**PATH G:\laragon\www\portal\resources\views/backend/components/sidebar.blade.php ENDPATH**/ ?>