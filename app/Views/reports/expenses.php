<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Laporan Pengeluaran</h2>
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
        <a href="/reports/expenses" class="btn btn-secondary" style="margin: 0;">Reset</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Nominal</th>
                <th>Pengguna</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($expenses as $expense): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($expense['tanggal'])); ?></td>
                    <td><?= $expense['category']; ?></td>
                    <td><?= substr($expense['deskripsi'], 0, 40); ?>...</td>
                    <td>Rp <?= number_format($expense['nominal'], 0, '.', '.'); ?></td>
                    <td><?= $expense['pengguna']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%); color: white; padding: 20px; border-radius: 10px; margin-top: 20px; text-align: right;">
        <h2>Total Pengeluaran: Rp <?= number_format($total_expenses, 0, '.', '.'); ?></h2>
    </div>
</div>

<?= $this->endSection(); ?>