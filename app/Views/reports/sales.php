<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Laporan Penjualan</h2>
    </div>

    <form method="get" style="margin-bottom: 20px; display: grid; grid-template-columns: 1fr 1fr auto auto; gap: 10px; align-items: flex-end;">
        <div class="form-group" style="margin: 0;">
            <label>Dari Tanggal</label>
            <input type="date" name="start_date" value="<?= $start_date; ?>" required>
        </div>
        <div class="form-group" style="margin: 0;">
            <label>Sampai Tanggal</label>
            <input type="date" name="end_date" value="<?= $end_date; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="/reports/sales" class="btn btn-secondary" style="margin: 0;">Reset</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>No. Transaksi</th>
                <th>Tanggal/Jam</th>
                <th>Total Item</th>
                <th>Total Penjualan</th>
                <th>Metode Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= $transaction['transaction_code']; ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($transaction['tanggal_jam'])); ?></td>
                    <td><?= $transaction['total_item']; ?></td>
                    <td>Rp <?= number_format($transaction['total_payment'], 0, '.', '.'); ?></td>
                    <td><?= $transaction['payment_status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%); color: white; padding: 20px; border-radius: 10px; margin-top: 20px; text-align: right;">
        <h2>Total Penjualan: Rp <?= number_format($total_sales, 0, '.', '.'); ?></h2>
    </div>
</div>

<?= $this->endSection(); ?>