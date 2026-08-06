<?php $__env->startSection('title', 'POS - Transaksi Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="fw-bold mb-1">
                    Tambah dan Edit Penjualan
                </h3>
                <p class="mb-0 text-white-50 small">Pilih produk dan tuntaskan transaksi penjualan kasir.</p>
            </div>
            <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-light text-primary fw-bold px-3 py-2 rounded-3 shadow-sm">
                Kembali
            </a>
        </div>

        <?php if(session('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 mx-2" role="alert">
                <?php echo e(session('errors')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="px-2">
            <div class="row g-4">

                
                <div class="col-md-6">
                    <h5 class="fw-bold text-secondary mb-3">Daftar Produk</h5>
                    
                    <div class="card border-0 shadow-sm rounded-4 p-3 bg-light">
                        <div class="mb-3">
                            <form method="GET" action="<?php echo e(route('penjualan.create')); ?>">
                                <input type="text"
                                    name="search"
                                    value="<?php echo e(request('search')); ?>"
                                    class="form-control form-control-lg bg-white border-1 rounded-3 fs-6"
                                    placeholder="Cari produk..."
                                    onkeyup="this.form.submit()">
                            </form>
                        </div>

                        <div class="pos-product-wrapper">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <form method="POST" action="<?php echo e(route('itempenjualan.store')); ?>" class="row g-2 align-items-center pos-product-item mx-0">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                
                                <div class="col-7">
                                    <div class="pos-product-name"><?php echo e($product->nama); ?></div>
                                    <small class="pos-product-price">Rp <?php echo e(number_format($product->harga_jual)); ?></small>
                                </div>

                                <div class="col-3">
                                    <input type="number" name="quantity" value="1" min="1" 
                                    class="form-control text-center py-1 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                                </div>

                                <div class="col-2">
                                    <button class="btn btn-primary fw-bold w-100 py-1 rounded-2 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">+</button>
                                </div>
                            </form>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <h5 class="fw-bold text-secondary mb-3">Keranjang Belanja</h5>
                    
                    <div class="pos-cart-container card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="fw-bold text-secondary ps-3">Produk</th>
                                        <th scope="col" class="fw-bold text-secondary">Harga</th>
                                        <th scope="col" class="fw-bold text-secondary text-center">Qty</th>
                                        <th scope="col" class="fw-bold text-secondary">Subtotal</th>
                                        <th scope="col" class="fw-bold text-secondary text-center pe-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="ps-3 fw-semibold text-dark"><?php echo e($item->produk->nama); ?></td>
                                        <td class="text-nowrap">Rp <?php echo e(number_format($item->produk->harga_jual)); ?></td>
                                        <td style="width: 90px;" class="text-center">
                                            <form method="POST" action="<?php echo e(route('itempenjualan.update', $item->id)); ?>">
                                                <?php echo csrf_field(); ?> 
                                                <?php echo method_field('PUT'); ?>
                                                <input type="number" name="quantity"
                                                    value="<?php echo e($item->kuantitas); ?>"
                                                    class="form-control form-control-sm text-center fw-bold"
                                                    onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="fw-bold text-dark text-nowrap">Rp <?php echo e(number_format($item->subtotal)); ?></td>
                                        <td class="text-center pe-3">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $item)): ?>
                                            <form method="POST" action="<?php echo e(route('itempenjualan.destroy', $item->id)); ?>">
                                                <?php echo csrf_field(); ?> 
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="btn btn-outline-danger btn-sm px-2 py-0 rounded-2" onclick="return confirm('Hapus item?')" title="Hapus Item">
                                                    Hapus
                                                </button>
                                            </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Keranjang masih kosong.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer bg-light p-3 border-top-0">
                            <div class="d-flex justify-content-between align-items-center pos-total-box mb-3">
                                <span class="fw-semibold text-secondary">Total Pembayaran:</span>
                                <strong class="pos-total-amount">Rp <?php echo e(number_format($sale->total_pembayaran)); ?></strong>
                            </div>
                            
                            <form 
                                method="POST" 
                                action="<?php echo e(route('penjualan.update', $sale->id)); ?>"
                                onsubmit="return confirm('Selesaikan Transaksi?')" class="mb-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                
                                <div class="mb-2">
                                    <select name="payment_method" class="form-select py-2 fw-semibold" required>
                                        <option value="">-- Pilih Metode Pembayaran --</option>
                                        <option value="CASH" <?php echo e($sale->metode_pembayaran == 'CASH' ? 'selected' : ''); ?>>Cash (Tunai)</option>
                                        <option value="QRIS" <?php echo e($sale->metode_pembayaran == 'QRIS' ? 'selected' : ''); ?>>QRIS (Non-Tunai)</option>
                                    </select>
                                </div>

                                <button class="btn btn-success fw-bold w-100 py-2 fs-6 rounded-3 shadow-sm <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                                    CHECKOUT
                                </button>
                            </form>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                            <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button class="btn btn-outline-danger fw-semibold w-100 py-2 rounded-3 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                                    Batalkan Transaksi
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS2\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>