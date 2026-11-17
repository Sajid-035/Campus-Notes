<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                    <i class="fas fa-search"></i>
                </a>
            </li>
        </ul>
    </form>

    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    src="<?php echo e(Auth::user()->avatar ? asset('uploads/avatars/' . Auth::user()->avatar) : asset('img/avatar/avatar-1.png')); ?>"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">
                    Hi, <?php echo e(Auth::user()->name); ?>

                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-profile')): ?> 
                    <a href="<?php echo e(route('profile.show')); ?>" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-settings')): ?> 
                    <a href="<?php echo e(route('settings.index')); ?>" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <?php endif; ?>
                    <div class="dropdown-divider"></div>

                    <a href="<?php echo e(route('logout')); ?>" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    <form id="logout-form-navbar" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
<?php /**PATH G:\laragon\www\demo\resources\views/backend/components/header.blade.php ENDPATH**/ ?>