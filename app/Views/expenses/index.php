<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h2>Pengeluaran Toko</h2>
        <div class="buttons">
            <a href="/expenses/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pengeluaran</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Nominal</th>
                <th>Pengguna</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($expenses as $expense): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($expense['tanggal'])); ?></td>
                    <td><?= $expense['category']; ?></td>
                    <td><?= substr($expense['deskripsi'], 0, 30); ?>...</td>
                    <td>Rp <?= number_format($expense['nominal'], 0, '.', '.'); ?></td>
                    <td><?= $expense['pengguna']; ?></td>
                    <td>
                        <a href="/expenses/edit/<?= $expense['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="/expenses/delete/<?= $expense['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>