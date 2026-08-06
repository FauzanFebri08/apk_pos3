<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-2">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-primary" href="<?php echo e(route('dashboard')); ?>">
            POS
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo e(Request::is('dashboard*') ? 'active fw-bold text-primary bg-primary-subtle rounded-3' : 'text-secondary'); ?>" href="<?php echo e(route('dashboard')); ?>">
                        Dashboard
                    </a>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewany', App\Models\User::class)): ?>
                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo e(Request::is('admin/users*') ? 'active fw-bold text-primary bg-primary-subtle rounded-3' : 'text-secondary'); ?>" href="<?php echo e(route('admin.users')); ?>">
                        Users
                    </a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo e(Request::is('produk*') ? 'active fw-bold text-primary bg-primary-subtle rounded-3' : 'text-secondary'); ?>" href="<?php echo e(route('produk.index')); ?>">
                        Produk
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo e(Request::is('penjualan*') ? 'active fw-bold text-primary bg-primary-subtle rounded-3' : 'text-secondary'); ?>" href="<?php echo e(route('penjualan.index')); ?>">
                        Penjualan
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-semibold small"><?php echo e(Auth::user()->name ?? 'User'); ?></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li>
                            <div class="dropdown-header">
                                <small class="text-muted">Role:</small><br>
                                <span class="badge <?php echo e(optional(Auth::user()->role)->name == 'admin' ? 'bg-danger' : 'bg-success'); ?> text-capitalize mt-1">
                                    <?php echo e(optional(Auth::user()->role)->name ?? 'Tidak Ada Role'); ?>

                                </span>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item text-danger">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\APK_POS2\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>