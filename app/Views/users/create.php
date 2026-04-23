<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Tambah User Baru</h2>
    </div>

    <form method="post" action="/users/store" style="max-width: 600px;">
        <div class="form-group">
            <label>Username *</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password *</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" name="full_name" required>
        </div>

        <div class="form-group">
            <label>Role *</label>
            <select name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="/users" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>