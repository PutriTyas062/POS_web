<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Detail Transaksi: <?= $transaction['transaction_code']; ?></h2>
        <a href="/riwayat" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
        <div>
            <p><strong>No. Transaksi:</strong> <?= $transaction['transaction_code']; ?></p>
            <p><strong>Tanggal/Jam:</strong> <?= date('d/m/Y H:i', strtotime($transaction['tanggal_jam'])); ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= $transaction['payment_status']; ?></p>
        </div>
        <div>
            <p><strong>Total Item:</strong> <?= $transaction['total_item']; ?></p>
            <p><strong>Subtotal:</strong> Rp <?= number_format($transaction['subtotal'], 0, '.', '.'); ?></p>
            <p><strong>PPN (11%):</strong> Rp <?= number_format($transaction['ppn_value'], 0, '.', '.'); ?></p>
        </div>
    </div>

    <h3 style="margin: 20px 0 15px 0; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">Item Transaksi</h3>
    <table>
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $detail): ?>
                <tr>
                    <td><?= $detail['product_code']; ?></td>
                    <td><?= $detail['product_name']; ?></td>
                    <td><?= $detail['quantity']; ?></td>
                    <td>Rp <?= number_format($detail['unit_price'], 0, '.', '.'); ?></td>
                    <td>Rp <?= number_format($detail['subtotal'], 0, '.', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%); color: white; padding: 20px; border-radius: 10px; margin-top: 20px; text-align: right;">
        <h2 style="margin-bottom: 10px;">Total Pembayaran: Rp <?= number_format($transaction['total_payment'], 0, '.', '.'); ?></h2>
        <?php if ($transaction['payment_status'] === 'Tunai'): ?>
            <p>Uang Diterima: Rp <?= number_format($transaction['cash_received'], 0, '.', '.'); ?></p>
            <p>Kembalian: Rp <?= number_format($transaction['cash_return'], 0, '.', '.'); ?></p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>