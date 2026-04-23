<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Daftar Barang</h2>
        <div class="buttons">
            <a href="/products/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Barang</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['product_code']; ?></td>
                    <td><?= $product['product_name']; ?></td>
                    <td><?= $product['category']; ?></td>
                    <td>Rp <?= number_format($product['purchase_price'], 0, '.', '.'); ?></td>
                    <td>Rp <?= number_format($product['selling_price'], 0, '.', '.'); ?></td>
                    <td>
                        <strong style="<?= $product['stock'] < $product['min_stock'] ? 'color: #f44336;' : 'color: #4CAF50;'; ?>">
                            <?= $product['stock']; ?>
                        </strong>
                    </td>
                    <td>
                        <span style="background: <?= $product['status'] === 'AKTIF' ? '#4CAF50' : '#ccc'; ?>; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px;">
                            <?= $product['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="/products/edit/<?= $product['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="/products/delete/<?= $product['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>