<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Edit User</h2>
    </div>

    <form method="post" action="/users/update/<?= $user['id']; ?>" style="max-width: 600px;">
        <div class="form-group">
            <label>Username *</label>
            <input type="text" value="<?= $user['username']; ?>" readonly style="background: #f5f5f5;">
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" value="<?= $user['email']; ?>" readonly style="background: #f5f5f5;">
        </div>

        <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" name="full_name" value="<?= $user['full_name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Role *</label>
            <select name="role" required>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="kasir" <?= $user['role'] === 'kasir' ? 'selected' : ''; ?>>Kasir</option>
            </select>
        </div>

        <div class="form-group">
            <label>Status *</label>
            <select name="status" required>
                <option value="active" <?= $user['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="/users" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>