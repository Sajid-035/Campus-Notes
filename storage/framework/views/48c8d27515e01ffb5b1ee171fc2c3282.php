<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(config('app.name')); ?></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown <?php echo e(Request::routeIs('dashboard') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-list', 'user-create', 'user-edit', 'user-delete'])): ?>
                <li class="nav-item dropdown <?php echo e(Request::routeIs('users.*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-users"></i> <span>Users</span></a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                            <li class="<?php echo e(Request::routeIs('users.create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('users.create')); ?>">Add User</a>
                            </li>
                        <?php endif; ?>
                        <li class="<?php echo e(Request::routeIs('users.index') ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(route('users.index')); ?>">User List</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
                <li class="nav-item dropdown <?php echo e(Request::routeIs('roles.*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-user-shield"></i>
                        <span>Roles</span></a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
                            <li class="<?php echo e(Request::routeIs('roles.create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('roles.create')); ?>">Add Role</a>
                            </li>
                        <?php endif; ?>
                        <li class="<?php echo e(Request::routeIs('roles.index') ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(route('roles.index')); ?>">Role List</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-list')): ?>
                <li class="nav-item dropdown <?php echo e(Request::routeIs('products.*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-box"></i>
                        <span>Products</span></a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-create')): ?>
                            <li class="<?php echo e(Request::routeIs('products.create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(route('products.create')); ?>">Add Product</a>
                            </li>
                        <?php endif; ?>
                        <li class="<?php echo e(Request::routeIs('products.index') ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(route('products.index')); ?>">Product List</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <!-- Existing Blogs Menu -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-list')): ?>
                <li class="nav-item dropdown <?php echo e(Request::routeIs('blog.*') ? 'active' : ''); ?>"> <a href="#"
                        class="nav-link has-dropdown"><i class="fa-solid fa-blog"></i><span>Blogs</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo e(Request::routeIs('blog.create') ? 'active' : ''); ?>"> <a class="nav-link"
                                href="<?php echo e(route('blog.create')); ?>">Add Blog</a> </li>
                        <li class="<?php echo e(Request::routeIs('blog.list') ? 'active' : ''); ?>"> <a class="nav-link"
                                href="<?php echo e(route('blog.list')); ?>">Blog List</a> </li>
                    </ul>
                </li>
            <?php endif; ?>
            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings-list')): ?>
                <li class="nav-item dropdown <?php echo e(Request::routeIs('settings.*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa-solid fa-gear"></i>
                        <span>Settings</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo e(Request::routeIs('settings.basic') ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(route('settings.basic')); ?>">Basic Settings</a>
                        </li>
                        <li class="<?php echo e(Request::routeIs('settings.banner') ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(route('settings.banner')); ?>">Banner Settings</a>
                        </li>
                        <li class="<?php echo e(Request::routeIs('settings.contactShow') ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(route('settings.contactShow')); ?>">Contact Message</a>
                        </li>
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
<?php /**PATH G:\laragon\www\shop\resources\views/backend/components/sidebar.blade.php ENDPATH**/ ?>