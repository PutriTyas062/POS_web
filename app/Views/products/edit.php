<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Edit Barang</h2>
        <a href="/products" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <form method="post" action="/products/update/<?= $product['id']; ?>">
        <div style="max-width: 600px;">
            <div class="form-group">
                <label>Kode Barang *</label>
                <input type="text" value="<?= $product['product_code']; ?>" readonly style="background: #f5f5f5;">
            </div>

            <div class="form-group">
                <label>Nama Barang *</label>
                <input type="text" name="product_name" value="<?= $product['product_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Kategori *</label>
                <select name="category" required>
                    <option value="Makanan" <?= $product['category'] === 'Makanan' ? 'selected' : ''; ?>>Makanan</option>
                    <option value="Minuman" <?= $product['category'] === 'Minuman' ? 'selected' : ''; ?>>Minuman</option>
                    <option value="Lainnya" <?= $product['category'] === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label>Satuan *</label>
                <select name="unit" required>
                    <option value="Buah" <?= $product['unit'] === 'Buah' ? 'selected' : ''; ?>>Buah</option>
                    <option value="Cup" <?= $product['unit'] === 'Cup' ? 'selected' : ''; ?>>Cup</option>
                    <option value="Pcs" <?= $product['unit'] === 'Pcs' ? 'selected' : ''; ?>>Pcs</option>
                    <option value="Dus" <?= $product['unit'] === 'Dus' ? 'selected' : ''; ?>>Dus</option>
                    <option value="Botol" <?= $product['unit'] === 'Botol' ? 'selected' : ''; ?>>Botol</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga Beli *</label>
                <input type="number" name="purchase_price" value="<?= $product['purchase_price']; ?>" required min="0">
            </div>

            <div class="form-group">
                <label>Harga Jual *</label>
                <input type="number" name="selling_price" value="<?= $product['selling_price']; ?>" required min="0">
            </div>

            <div class="form-group">
                <label>Stok *</label>
                <input type="number" name="stock" value="<?= $product['stock']; ?>" required min="0">
            </div>

            <div class="form-group">
                <label>Stok Minimum *</label>
                <input type="number" name="min_stock" value="<?= $product['min_stock']; ?>" required min="1">
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/products" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>