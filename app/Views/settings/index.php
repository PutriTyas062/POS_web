<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<style>
    .nav-tabs {
        display: flex;
        gap: 10px;
        border-bottom: 2px solid #e0e0e0;
        margin-bottom: 30px;
        padding-bottom: 15px;
    }

    .nav-tab {
        padding: 10px 20px;
        background: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        color: #999;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
    }

    .nav-tab.active {
        color: #FF8C42;
        border-bottom-color: #FF8C42;
    }

    .nav-tab:hover {
        color: #FF8C42;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .form-section {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
        color: #333;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #FF8C42;
        box-shadow: 0 0 0 3px rgba(255, 140, 66, 0.1);
    }

    .toggle-switch {
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .toggle-switch input {
        display: none;
    }

    .toggle-slider {
        width: 50px;
        height: 24px;
        background-color: #ccc;
        border-radius: 12px;
        position: relative;
        transition: background-color 0.3s;
        margin-right: 10px;
    }

    .toggle-slider::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: white;
        border-radius: 50%;
        top: 2px;
        left: 2px;
        transition: left 0.3s;
    }

    .toggle-switch input:checked + .toggle-slider {
        background-color: #FF8C42;
    }

    .toggle-switch input:checked + .toggle-slider::after {
        left: 28px;
    }

    .help-text {
        font-size: 12px;
        color: #999;
        margin-top: 5px;
    }

    .btn-group {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .upload-area {
        border: 2px dashed #FF8C42;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background: rgba(255, 140, 66, 0.05);
        cursor: pointer;
        transition: all 0.3s;
    }

    .upload-area:hover {
        background: rgba(255, 140, 66, 0.1);
    }

    .upload-area i {
        font-size: 32px;
        color: #FF8C42;
        margin-bottom: 10px;
        display: block;
    }

    .upload-area input {
        display: none;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .nav-tabs {
            overflow-x: auto;
            flex-wrap: nowrap;
        }
    }
</style>

<div class="card">
    <div class="card-header">
        <h2>Pengaturan Toko</h2>
    </div>

    <!-- Tabs Navigation -->
    <div class="nav-tabs">
        <button class="nav-tab active" onclick="switchTab(0)"><i class="fas fa-store"></i> Profil Toko</button>
        <button class="nav-tab" onclick="switchTab(1)"><i class="fas fa-cogs"></i> Stok & Pajak</button>
        <button class="nav-tab" onclick="switchTab(2)"><i class="fas fa-users"></i> Pengguna</button>
        <button class="nav-tab" onclick="switchTab(3)"><i class="fas fa-database"></i> Data</button>
    </div>

    <!-- Tab 1: Profil Toko -->
    <div class="tab-content active" id="tab-0">
        <form onclick="return false;">
            <!-- Informasi Toko -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-info-circle"></i> Informasi Toko</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Toko *</label>
                        <input type="text" value="POS System" placeholder="Masukkan nama toko">
                    </div>
                    <div class="form-group">
                        <label>Email Toko</label>
                        <input type="email" value="pos@example.com" placeholder="Masukkan email toko">
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Toko *</label>
                    <textarea rows="3" placeholder="Masukkan alamat complete toko">Jl. Contoh No. 123, Kota, Provinsi 12345</textarea>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nomor Telepon *</label>
                        <input type="tel" value="+62" placeholder="Contoh: +62812345678">
                    </div>
                    <div class="form-group">
                        <label>Nomor WhatsApp</label>
                        <input type="tel" value="+62" placeholder="Contoh: +62812345678">
                    </div>
                </div>
                <div class="form-group">
                    <label>NPWP (opsional)</label>
                    <input type="text" placeholder="Contoh: 01.000.000.000-00.000">
                </div>
            </div>

            <!-- Logo Toko -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-image"></i> Logo Toko</div>
                <div class="upload-area" onclick="document.getElementById('logoInput').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <div>Klik untuk upload atau drag & drop</div>
                    <div class="help-text">Format: JPG, PNG, GIF (Max 2MB)</div>
                    <input type="file" id="logoInput" accept="image/*">
                </div>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-primary" onclick="saveSettings()"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" onclick="resetSettings()"><i class="fas fa-undo"></i> Batal</button>
            </div>
        </form>
    </div>

    <!-- Tab 2: Stok & Pajak -->
    <div class="tab-content" id="tab-1">
        <form onclick="return false;">
            <!-- Pengaturan Pajak -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-percent"></i> Pengaturan Pajak</div>
                <div class="form-group">
                    <label>Aktifkan PPN 11%</label>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                    <div class="help-text">Jika diaktifkan, PPN 11% akan otomatis ditambahkan ke setiap transaksi</div>
                </div>
            </div>

            <!-- Pengaturan Diskon -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-tag"></i> Pengaturan Diskon</div>
                <div class="form-group">
                    <label>Diskon Maksimum (%)</label>
                    <input type="number" value="50" min="0" max="100" placeholder="Masukkan batas maksimal diskon">
                    <div class="help-text">Batas maksimal diskon dalam persen yang bisa diberikan kasir</div>
                </div>
            </div>

            <!-- Pengaturan Stok -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-boxes"></i> Pengaturan Stok</div>
                <div class="form-group">
                    <label>Batas Indikator Stok Rendah</label>
                    <input type="number" value="5" min="1" placeholder="Masukkan nilai ambang batas">
                    <div class="help-text">Stok akan ditandai kuning jika dibawah nilai ini</div>
                </div>
            </div>

            <!-- Pengaturan Pembulatan Harga -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-calculator"></i> Pembulatan Harga</div>
                <div class="form-group">
                    <label>Pembulatuan Harga</label>
                    <select>
                        <option>Tidak ada pembulatan</option>
                        <option>Bulatkan ke 100</option>
                        <option>Bulatkan ke 500</option>
                        <option>Bulatkan ke 1000</option>
                    </select>
                    <div class="help-text">Sistem akan otomatis membulatkan harga transaksi</div>
                </div>
            </div>

            <!-- Nomor Dokumen -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-file-alt"></i> Nomor Dokumen</div>
                <div class="form-group">
                    <label>Format Nomor Transaksi</label>
                    <input type="text" value="TRX-YYYYMMDD-###" placeholder="Contoh: TRX-YYYYMMDD-###">
                    <div class="help-text">YYYY=Tahun, MM=Bulan, DD=Hari, ###=Counter</div>
                </div>
                <div class="form-group">
                    <label>Konsistensi Nomor Urut</label>
                    <select>
                        <option>Reset per hari</option>
                        <option>Reset per bulan</option>
                        <option>Tidak direset</option>
                    </select>
                </div>
            </div>

            <!-- Printer -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-print"></i> Printer</div>
                <div class="form-group">
                    <label>Ukuran Kertas</label>
                    <select>
                        <option>Thermal 80mm</option>
                        <option>Thermal 58mm</option>
                        <option>A4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Margin Umum</label>
                    <input type="text" placeholder="Contoh: 5">
                </div>
            </div>

            <!-- Cetak Otomatis -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-cog"></i> Cetak Otomatis</div>
                <div class="form-group">
                    <label>Cetak Struk Otomatis Setelah Transaksi</label>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-primary" onclick="saveSettings()"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" onclick="resetSettings()"><i class="fas fa-undo"></i> Reset</button>
            </div>
        </form>
    </div>

    <!-- Tab 3: Pengguna -->
    <div class="tab-content" id="tab-2">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <a href="/users" style="text-decoration: none;">
                <div style="background: white; padding: 30px; border-radius: 10px; text-align: center; border-left: 5px solid #FF8C42; box-shadow: 0 2px 10px rgba(0,0,0,0.05); cursor: pointer; transition: transform 0.3s;">
                    <div style="font-size: 40px; color: #FF8C42; margin-bottom: 15px;"><i class="fas fa-users"></i></div>
                    <div style="font-size: 16px; font-weight: bold; color: #333;">Kelola User</div>
                    <div style="font-size: 13px; color: #999; margin-top: 10px;">Tambah, edit, atau hapus pengguna</div>
                </div>
            </a>

            <a href="/users/create" style="text-decoration: none;">
                <div style="background: white; padding: 30px; border-radius: 10px; text-align: center; border-left: 5px solid #4CAF50; box-shadow: 0 2px 10px rgba(0,0,0,0.05); cursor: pointer; transition: transform 0.3s;">
                    <div style="font-size: 40px; color: #4CAF50; margin-bottom: 15px;"><i class="fas fa-user-plus"></i></div>
                    <div style="font-size: 16px; font-weight: bold; color: #333;">Tambah User Baru</div>
                    <div style="font-size: 13px; color: #999; margin-top: 10px;">Daftarkan kasir atau admin baru</div>
                </div>
            </a>
        </div>
    </div>

    <!-- Tab 4: Data -->
    <div class="tab-content" id="tab-3">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div style="background: white; padding: 30px; border-radius: 10px; border-left: 5px solid #2196F3; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div style="font-size: 32px; color: #2196F3; margin-bottom: 15px;"><i class="fas fa-download"></i></div>
                <div style="font-size: 16px; font-weight: bold; color: #333; margin-bottom: 10px;">Backup Database</div>
                <div style="font-size: 13px; color: #999; margin-bottom: 15px;">Download seluruh database aplikasi</div>
                <button class="btn btn-primary" style="width: 100%;" onclick="backupDatabase()"><i class="fas fa-database"></i> Backup Sekarang</button>
            </div>

            <div style="background: white; padding: 30px; border-radius: 10px; border-left: 5px solid #FF9800; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div style="font-size: 32px; color: #FF9800; margin-bottom: 15px;"><i class="fas fa-upload"></i></div>
                <div style="font-size: 16px; font-weight: bold; color: #333; margin-bottom: 10px;">Restore Database</div>
                <div style="font-size: 13px; color: #999; margin-bottom: 15px;">Upload file backup untuk restore</div>
                <button class="btn btn-secondary" style="width: 100%;" onclick="document.getElementById('restoreInput').click();"><i class="fas fa-folder-open"></i> Pilih File</button>
                <input type="file" id="restoreInput" accept=".sql" style="display: none;">
            </div>

            <div style="background: #fff3cd; padding: 30px; border-radius: 10px; border-left: 5px solid #FFC107; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div style="font-size: 32px; color: #FF8C42; margin-bottom: 15px;"><i class="fas fa-exclamation-triangle"></i></div>
                <div style="font-size: 16px; font-weight: bold; color: #333; margin-bottom: 10px;">Hapus Semua Data</div>
                <div style="font-size: 13px; color: #999; margin-bottom: 15px;">Hapus semua data transaksi dan pengeluaran</div>
                <button class="btn btn-danger" style="width: 100%;" onclick="if(confirm('Data tidak dapat dikembalikan! Lanjutkan?')) clearAllData();"><i class="fas fa-trash"></i> Hapus Semua Data</button>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tabIndex) {
        document.querySelectorAll('.nav-tab').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

        document.querySelectorAll('.nav-tab')[tabIndex].classList.add('active');
        document.getElementById('tab-' + tabIndex).classList.add('active');
    }

    function saveSettings() {
        const formData = new FormData();
        
        // Collect store profile data
        formData.append('store_name', document.querySelector('input[placeholder="Nama Toko"]')?.value || '');
        formData.append('store_email', document.querySelector('input[placeholder="Email Toko"]')?.value || '');
        formData.append('store_address', document.querySelector('textarea')?.value || '');
        formData.append('store_phone', document.querySelector('input[placeholder="No. Telp"]')?.value || '');
        formData.append('store_npwp', document.querySelector('input[placeholder="NPWP"]')?.value || '');
        
        // Collect stock & tax data
        const ppnToggle = document.querySelector('input[type="checkbox"]');
        if (ppnToggle) {
            formData.append('ppn_enabled', ppnToggle.checked ? 'on' : 'off');
        }
        formData.append('ppn_percent', document.querySelector('input[placeholder="11"]')?.value || 11);
        formData.append('discount_limit', document.querySelector('input[placeholder="Rp 1.000.000"]')?.value || 100000);
        formData.append('min_stock', document.querySelector('input[placeholder="5"]')?.value || 5);
        formData.append('number_format', document.querySelector('select')?.value || 'TRX-YYYYMMDD');
        formData.append('auto_print', document.querySelector('input[type="checkbox"]')?.checked ? 'on' : 'off');
        formData.append('printer_name', document.querySelector('input[placeholder="Printer"]')?.value || '');
        
        // Add logo if selected
        const logoInput = document.getElementById('logoInput');
        if (logoInput && logoInput.files.length > 0) {
            formData.append('store_logo', logoInput.files[0]);
        }

        fetch('/settings/save', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✓ Pengaturan berhasil disimpan!');
            } else {
                alert('✗ Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('✗ Terjadi kesalahan!');
        });
    }

    function resetSettings() {
        if (confirm('Reset semua pengaturan ke nilai awal?')) {
            location.reload();
        }
    }

    function backupDatabase() {
        if (!confirm('Backup database akan diunduh. Lanjutkan?')) return;

        fetch('/settings/backup', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✓ ' + data.message + '\nFile: ' + data.file);
                // In production, you'd download the file here
            } else {
                alert('✗ Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('✗ Terjadi kesalahan!');
        });
    }

    function restoreDatabase() {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = '.sql';
        fileInput.onchange = (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('backup_file', file);

            fetch('/settings/restore', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✓ ' + data.message);
                    location.reload();
                } else {
                    alert('✗ Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('✗ Terjadi kesalahan!');
            });
        };
        fileInput.click();
    }

    function clearAllData() {
        const userInput = prompt('Ketik "YES" untuk mengkonfirmasi penghapusan semua data:\n(Data tidak dapat dikembalikan!)');
        
        if (userInput === 'YES') {
            fetch('/settings/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'confirm=YES'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✓ ' + data.message);
                    location.reload();
                } else {
                    alert('✗ Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('✗ Terjadi kesalahan!');
            });
        }
    }

    // Handle drag & drop for logo upload
    const uploadArea = document.querySelector('.upload-area');
    if (uploadArea) {
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.background = 'rgba(255, 140, 66, 0.15)';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.background = 'rgba(255, 140, 66, 0.05)';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('logoInput').files = files;
                alert('✓ File ' + files[0].name + ' dipilih');
            }
        });

        // Click to select file
        uploadArea.addEventListener('click', () => {
            document.getElementById('logoInput').click();
        });
    }

    // File input change handler
    const logoInput = document.getElementById('logoInput');
    if (logoInput) {
        logoInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                // Preview logo
                const reader = new FileReader();
                reader.onload = (event) => {
                    const preview = document.querySelector('.upload-area img');
                    if (preview) {
                        preview.src = event.target.result;
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }

    // Change restore button onclick to call the function
    const restoreBtn = document.querySelector('button').parentElement.querySelector('button:nth-child(2)');
    if (restoreBtn) {
        restoreBtn.onclick = restoreDatabase;
    }
</script>

<?= $this->endSection(); ?>