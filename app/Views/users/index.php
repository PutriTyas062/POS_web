<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Pengaturan User</h2>
        <div class="buttons">
            <a href="/users/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah User</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Nama Lengkap</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['full_name']; ?></td>
                    <td><?= ucfirst($user['role']); ?></td>
                    <td>
                        <span style="background: <?= $user['status'] === 'active' ? '#4CAF50' : '#ccc'; ?>; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px;">
                            <?= $user['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="/users/edit/<?= $user['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="/users/delete/<?= $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>