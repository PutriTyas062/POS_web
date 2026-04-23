<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Tambah Barang Baru</h2>
        <a href="/products" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <form method="post" action="/products/store">
        <div style="max-width: 600px;">
            <div class="form-group">
                <label>Kode Barang *</label>
                <input type="text" name="product_code" required>
            </div>

            <div class="form-group">
                <label>Nama Barang *</label>
                <input type="text" name="product_name" required>
            </div>

            <div class="form-group">
                <label>Kategori *</label>
                <select name="category" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label>Satuan *</label>
                <select name="unit" required>
                    <option value="">-- Pilih Satuan --</option>
                    <option value="Buah">Buah</option>
                    <option value="Cup">Cup</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Dus">Dus</option>
                    <option value="Botol">Botol</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga Beli *</label>
                <input type="number" name="purchase_price" required min="0">
            </div>

            <div class="form-group">
                <label>Harga Jual *</label>
                <input type="number" name="selling_price" required min="0">
            </div>

            <div class="form-group">
                <label>Stok Awal *</label>
                <input type="number" name="stock" required min="0" value="0">
            </div>

            <div class="form-group">
                <label>Stok Minimum *</label>
                <input type="number" name="min_stock" required min="1" value="5">
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/products" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>