<?php $__env->startSection('title', 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">Tambah Produk</h3>
                <p class="mb-0 text-white-50 small">Isi formulir untuk menambahkan produk baru.</p>
            </div>
            <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-light btn-sm fw-bold text-primary rounded-3 px-3">
                ← Kembali
            </a>
        </div>

        <div class="px-2">
            <form action="<?php echo e(route('produk.store')); ?>" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="form-tambah-produk">
                
                <?php echo $__env->make('produk._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                
            </form>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS2\resources\views/produk/create.blade.php ENDPATH**/ ?>