<?php $__env->startSection('title', 'Detail Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    📄 Detail Transaksi #<?php echo e($penjualan->id); ?>

                </h3>
                <p class="mb-0 text-white-50 small">Rincian informasi transaksi dan barang yang dibeli.</p>
            </div>
            <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-light text-primary fw-bold px-3 py-2 rounded-3 shadow-sm">
                ← Kembali
            </a>
        </div>

        <div class="px-2">
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="detail-card-box">
                        <small class="detail-label">Tanggal Transaksi</small>
                        <span class="detail-value"><?php echo e($penjualan->created_at->translatedFormat('d-m-Y H:i:s')); ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="detail-card-box">
                        <small class="detail-label">Kasir</small>
                        <span class="detail-value"><?php echo e($penjualan->user->name ?? '-'); ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="detail-card-box">
                        <small class="detail-label">Metode Pembayaran</small>
                        <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-bold mt-1">
                            <?php echo e($penjualan->metode_pembayaran); ?>

                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="detail-card-box">
                        <small class="detail-label">Status</small>
                        <span class="badge rounded-pill <?php echo e(strtoupper($penjualan->status) == 'COMPLETED' ? 'bg-success' : 'bg-warning text-dark'); ?> px-3 py-1 mt-1">
                            <?php echo e($penjualan->status); ?>

                        </span>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold text-secondary mb-3">Item Barang</h5>
            <div class="table-responsive mb-4">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="fw-bold text-secondary">#</th>
                            <th scope="col" class="fw-bold text-secondary">Nama Produk</th>
                            <th scope="col" class="fw-bold text-secondary text-center">Harga Satuan</th>
                            <th scope="col" class="fw-bold text-secondary text-center">Jumlah (Qty)</th>
                            <th scope="col" class="fw-bold text-secondary text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $penjualan->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-secondary"><?php echo e($loop->iteration); ?></td>
                                <td class="fw-semibold text-dark"><?php echo e($item->produk->nama ?? 'Produk Dihapus'); ?></td>
                                <td class="text-center">Rp <?php echo e(number_format($item->harga_satuan ?? ($item->subtotal / ($item->kuantitas ?: 1)), 0, ',', '.')); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary rounded-pill px-3 py-1"><?php echo e($item->kuantitas); ?></span>
                                </td>
                                <td class="text-end fw-bold text-dark">
                                    Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-secondary">
                                    Tidak ada item barang pada transaksi ini.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="summary-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-secondary">Total Pembayaran</span>
                            <span class="summary-total">
                                Rp <?php echo e(number_format($penjualan->total_pembayaran, 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS2\resources\views/penjualan/show.blade.php ENDPATH**/ ?>