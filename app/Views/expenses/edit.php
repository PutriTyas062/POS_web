<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Edit Pengeluaran</h2>
    </div>

    <form method="post" action="/expenses/update/<?= $expense['id']; ?>" style="max-width: 600px;">
        <div class="form-group">
            <label>Tanggal *</label>
            <input type="datetime-local" name="tanggal" value="<?= date('Y-m-d\TH:i', strtotime($expense['tanggal'])); ?>" required>
        </div>

        <div class="form-group">
            <label>Kategori *</label>
            <select name="category" required>
                <option value="Listrik" <?= $expense['category'] === 'Listrik' ? 'selected' : ''; ?>>Listrik</option>
                <option value="Gas" <?= $expense['category'] === 'Gas' ? 'selected' : ''; ?>>Gas</option>
                <option value="Pembaharuan" <?= $expense['category'] === 'Pembaharuan' ? 'selected' : ''; ?>>Pembaharuan</option>
                <option value="Sewa" <?= $expense['category'] === 'Sewa' ? 'selected' : ''; ?>>Sewa</option>
                <option value="Lainnya" <?= $expense['category'] === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4"><?= $expense['deskripsi']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Nominal *</label>
            <input type="number" name="nominal" value="<?= $expense['nominal']; ?>" required min="0">
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="/expenses" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>