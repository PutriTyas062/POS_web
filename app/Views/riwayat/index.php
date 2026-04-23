<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Riwayat Transaksi</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Transaksi</th>
                <th>Tanggal/Jam</th>
                <th>Kasir</th>
                <th>Total Item</th>
                <th>Total Pembayaran</th>
                <th>Metode Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= $transaction['transaction_code']; ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($transaction['tanggal_jam'])); ?></td>
                    <td><?= $transaction['user_id']; ?></td>
                    <td><?= $transaction['total_item']; ?></td>
                    <td>Rp <?= number_format($transaction['total_payment'], 0, '.', '.'); ?></td>
                    <td><?= $transaction['payment_status']; ?></td>
                    <td>
                        <a href="/riwayat/detail/<?= $transaction['id']; ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>