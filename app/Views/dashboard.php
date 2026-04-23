<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
        color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.2);
    }

    .stat-card h3 {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .stat-card .value {
        font-size: 28px;
        font-weight: bold;
    }

    .stat-icon {
        font-size: 32px;
        margin-bottom: 15px;
    }
</style>

<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
        <h3>Total Penjualan Hari Ini</h3>
        <div class="value">
            Rp <?= number_format($summary['total_penjualan'] ?? 0, 0, '.', '.'); ?>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-cubes"></i></div>
        <h3>Total Item Terjual</h3>
        <div class="value">
            <?= $summary['total_item'] ?? 0; ?> Item
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
        <h3>Total Pengeluaran</h3>
        <div class="value">
            Rp <?= number_format($total_expense['total'] ?? 0, 0, '.', '.'); ?>
        </div>
    </div>
</div>

<?php if (session()->get('role') === 'admin'): ?>
    <div class="card">
        <div class="card-header">
            <h2>Peringatan Stok</h2>
        </div>
        <?php if (!empty($low_stock)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok Saat Ini</th>
                        <th>Stok Minimum</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($low_stock as $product): ?>
                        <tr>
                            <td><?= $product['product_code']; ?></td>
                            <td><?= $product['product_name']; ?></td>
                            <td><?= $product['stock']; ?></td>
                            <td><?= $product['min_stock']; ?></td>
                            <td><span style="background: #ffc107; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px;">Peringatan</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #999; padding: 20px;">Semua stok dalam kondisi normal</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>