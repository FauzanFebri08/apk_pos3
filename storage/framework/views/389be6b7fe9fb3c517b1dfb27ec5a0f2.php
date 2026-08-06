<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div style="background-color: #f0f4f8; min-height: calc(100vh - 60px);" class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom rounded-3 shadow-sm p-3" style="background-color: #9ad9f7;">
            <div>
                <h2 class="fw-bold mb-0 text-dark">Dashboard Ringkasan</h2>
                <p class="text-muted mb-0">Pantau performa penjualan dan status stok barang hari ini.</p>
            </div>
            <div class="badge bg-white text-primary border shadow-sm p-2 px-3 fs-6 fw-normal rounded-3 float-card">
                <?php echo e(now()->locale('id')->translatedFormat('l, d F Y')); ?>

            </div>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewany', App\Models\User::class)): ?>
        <div class="mb-4">
            <h5 class="fw-bold text-dark mb-3" style="text-align: center;">Ringkasan Penjualan Hari Ini</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 text-white h-100 float-card" style="background: linear-gradient(135deg, #0b2545, #134074); border-radius: 14px;">
                        <div class="card-body p-4">
                            <span class="text-white-50 small text-uppercase fw-semibold">Total Nilai Penjualan</span>
                            <h2 class="fw-bold mb-0 mt-2">
                                Rp <?php echo e(number_format($ringkasan['total_penjualan'], 0, ',', '.')); ?>

                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 text-white h-100 float-card" style="background: linear-gradient(135deg, #1d4ed8, #2563eb); border-radius: 14px;">
                        <div class="card-body p-4">
                            <span class="text-white-50 small text-uppercase fw-semibold">Jumlah Transaksi</span>
                            <h2 class="fw-bold mb-0 mt-2">
                                <?php echo e(number_format($ringkasan['total_transaksi'])); ?> <span class="fs-6 text-white-50 fw-normal">Transaksi</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h5 class="fw-bold text-dark mb-3" style="text-align: center;">Status Pembayaran</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 text-white h-100 float-card" style="background: linear-gradient(135deg, #0284c7, #0369a1); border-radius: 14px;">
                        <div class="card-body p-4">
                            <span class="text-white-50 small text-uppercase fw-semibold">Total Pembayaran Tunai (Cash)</span>
                            <h3 class="fw-bold mb-0 mt-2">
                                Rp <?php echo e(number_format($ringkasan['total_cash'], 0, ',', '.')); ?>

                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 text-white h-100 float-card" style="background: linear-gradient(135deg, #0284c7, #0f766e); border-radius: 14px;">
                        <div class="card-body p-4">
                            <span class="text-white-50 small text-uppercase fw-semibold">Total Pembayaran Non-Tunai</span>
                            <h3 class="fw-bold mb-0 mt-2">
                                Rp <?php echo e(number_format($ringkasan['total_non_tunai'], 0, ',', '.')); ?>

                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="mb-5">
            <h5 class="fw-bold text-dark mb-3" style="text-align: center;">Status Stok Kritis</h5>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 h-100 rounded-3 overflow-hidden float-card">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h6 class="m-0 fw-bold text-primary">Daftar Produk Stok Rendah</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="10%">#</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col" class="text-end">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($produkStokRendah->firstItem() + $index); ?></td>
                                        <td class="fw-semibold"><?php echo e($produk->nama); ?></td>
                                        <td class="text-end">
                                            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2"><?php echo e($produk->stok); ?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($produkStokRendah->hasPages()): ?>
                        <div class="card-footer bg-white border-top-0 pt-3">
                            <?php echo e($produkStokRendah->links()); ?>

                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 h-100 rounded-3 overflow-hidden float-card">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h6 class="m-0 fw-bold text-primary">Produk Habis Stok</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="10%">#</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col" class="text-end">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $produkStokHabis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($produkStokHabis->firstItem() + $index); ?></td>
                                        <td class="fw-semibold"><?php echo e($produk->nama); ?></td>
                                        <td class="text-end">
                                            <span class="badge bg-secondary text-white fw-bold px-3 py-2"><?php echo e($produk->stok); ?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($produkStokHabis->hasPages()): ?>
                        <div class="card-footer bg-white border-top-0 pt-3">
                            <?php echo e($produkStokHabis->links()); ?>

                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h5 class="fw-bold text-dark mb-3" style="text-align: center;">Best Seller Produk</h5>
            <div class="card border-0 rounded-3 overflow-hidden float-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Nama Produk</th>
                                <th scope="col" class="text-center">Sisa Stok</th>
                                <th scope="col" class="text-end">Unit Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $produkTerlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-semibold"><?php echo e($produk->nama); ?></td>
                                <td class="text-center"><?php echo e($produk->stok); ?></td>
                                <td class="text-end">
                                    <span class="badge bg-primary px-3 py-2 fs-6 fw-normal"><?php echo e($produk->total_terjual); ?> unit</span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="text-muted text-center py-4">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .float-card {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
    }

    .float-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15), 0 10px 15px -5px rgba(0, 0, 0, 0.08);
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS2\resources\views/dashboard.blade.php ENDPATH**/ ?>