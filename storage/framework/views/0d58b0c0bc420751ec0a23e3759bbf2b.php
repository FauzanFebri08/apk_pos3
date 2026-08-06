<?php $__env->startSection('title', 'Edit Produk'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/user-form.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="card form-card shadow-sm border-0">
            
            <div class="card-header bg-primary text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-1">Edit Produk</h3>
                        <p class="mb-0 text-white-50">Perbarui informasi produk di bawah ini.</p>
                    </div>
                    
                    <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-light btn-sm text-primary fw-semibold px-3 py-2">
                        &larr; Kembali
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="<?php echo e(route('produk.update', $produk)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <?php echo $__env->make('produk._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS2\resources\views/produk/edit.blade.php ENDPATH**/ ?>