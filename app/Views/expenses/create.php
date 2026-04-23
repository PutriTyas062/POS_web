<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Tambah Pengeluaran</h2>
    </div>

    <form method="post" action="/expenses/store" style="max-width: 600px;">
        <div class="form-group">
            <label>Tanggal *</label>
            <input type="datetime-local" name="tanggal" required>
        </div>

        <div class="form-group">
            <label>Kategori *</label>
            <select name="category" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Listrik">Listrik</option>
                <option value="Gas">Gas</option>
                <option value="Pembaharuan">Pembaharuan</option>
                <option value="Sewa">Sewa</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label>Nominal *</label>
            <input type="number" name="nominal" required min="0">
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="/expenses" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>