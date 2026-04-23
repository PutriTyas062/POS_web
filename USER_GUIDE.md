# PANDUAN PENGGUNAAN - POS SYSTEM

## Daftar Isi
1. [Login](#login)
2. [Dashboard](#dashboard)
3. [Kasir (POS)](#kasir-pos)
4. [Riwayat Transaksi](#riwayat-transaksi)
5. [Manajemen Barang](#manajemen-barang)
6. [Pengeluaran](#pengeluaran)
7. [Laporan](#laporan)
8. [Pengaturan User](#pengaturan-user)

---

## Login

### Halaman Login
1. Buka browser: **http://localhost:8080**
2. Masukkan Username
3. Masukkan Password
4. Klik tombol **"Masuk"**

### Akun Tersedia
- **Admin** - Username: `admin` / Password: `admin123`
- **Kasir** - Username: `kasir` / Password: `kasir123`

> **Catatan**: Setiap akun memiliki akses berbeda

---

## Dashboard

**Akses**: Semua user

### Informasi yang Ditampilkan
1. **Total Penjualan Hari Ini**
   - Menampilkan total uang masuk dari transaksi
   - Diperbarui real-time

2. **Total Item Terjual**
   - Jumlah item yang berhasil dijual
   - Dihitung dari semua transaksi hari ini

3. **Total Pengeluaran**
   - Total pengeluaran operasional
   - Kategori: Listrik, Gas, Sewa, dll

4. **Peringatan Stok** (Admin)
   - Menampilkan barang dengan stok rendah
   - Warning jika stok < stok minimum

---

## Kasir (POS)

**Akses**: Kasir & Admin

### Mari Memproses Penjualan

#### 1. Tambah Produk ke Keranjang
```
1. Di sebelah kiri, lihat daftar produk
2. Klik tombol "+ TAMBAH" pada produk
3. Produk otomatis masuk ke keranjang (kanan)
```

#### 2. Filter & Cari Produk
```
Opsi 1: Gunakan kategori
- Klik tombol kategori: "Semua Produk", "Makanan", "Minuman", "Lainnya"

Opsi 2: Gunakan search
- Ketik di kolom "Cari produk..."
- Hasil akan filter otomatis
```

#### 3. Ubah Jumlah Item
```
1. Di keranjang, lihat kolom "Qty"
2. Ubah nilai quantity sesuai kebutuhan
3. Total otomatis terupdate
```

#### 4. Hapus Item dari Keranjang
```
1. Klik tombol merah "🗑" di samping item
2. Item akan dihapus dari keranjang
```

#### 5. Proses Pembayaran
```
1. Klik tombol "BAYAR" di bawah keranjang
2. Dialog pembayaran akan muncul
3. Pilih metode pembayaran:
   - TUNAI: Input jumlah uang yang diterima
   - QRIS: Tunjukkan QR Code
   - DEBIT: Kartu debit digesek
4. Otomatis hitung kembalian
5. Klik "Simpan & Cetak Resi"
6. Transaksidiselesaikan, keranjang kosong
```

### Tips Kasir
- Cek stok sebelum menjual
- Beritahu pelanggan jika stok terbatas
- Validasi pembayaran sebelum mencetak resi
- Catat kejadian khusus di notes transaksi

---

## Riwayat Transaksi

**Akses**: Kasir & Admin

### Lihat Semua Transaksi
```
1. Klik menu "Riwayat Transaksi"
2. Tabel menampilkan semua transaksi
3. Transaksi terbaru ada di atas
```

### Kolom Tabel
| Kolom | Keterangan |
|-------|-----------|
| No. Transaksi | ID unik transaksi |
| Tanggal/Jam | Waktu transaksi dilakukan |
| Kasir | Siapa yang melayani |
| Total Item | Jumlah item terjual |
| Total Pembayaran | Uang yang diterima |
| Metode Bayar | Tunai/QRIS/Debit |

### Lihat Detail Transaksi
```
1. Klik tombol "LIHAT" / mata pada transaksi
2. Halaman detail terbuka menampilkan:
   - Info transaksi lengkap
   - Daftar item yang dibeli
   - Detail pembayaran & kembalian
```

---

## Manajemen Barang

**Akses**: Admin Only

### Daftar Barang
```
1. Klik menu "Barang & Stok"
2. Tabel menampilkan semua produk
3. Cek stok saat ini di kolom "Stok"
```

### Tambah Barang Baru
```
1. Klik tombol "+ TAMBAH BARANG"
2. Isi form:
   - Kode Barang (unique, ex: PRD-001)
   - Nama Barang
   - Kategori (Makanan/Minuman/Lainnya)
   - Satuan (Buah/Cup/Pcs/Dus/Botol)
   - Harga Beli
   - Harga Jual
   - Stok Awal
   - Stok Minimum (untuk peringatan)
3. Klik "SIMPAN"
```

### Edit Barang
```
1. Klik tombol "✏️" di baris barang
2. Update informasi
3. Klik "SIMPAN"
```

### Hapus Barang
```
1. Klik tombol "🗑" di baris barang
2. Konfirmasi penghapusan
3. Barang terhapus
```

### Status Barang
- **AKTIF**: Barang bisa dijual
- **NONAKTIF**: Barang tidak tampil di POS

### Indikator Stok
- 🟢 **Hijau**: Stok normal
- 🔴 **Merah**: Stok dibawah minimum, perlu reorder

---

## Pengeluaran

**Akses**: Admin Only

### Catat Pengeluaran
```
1. Klik menu "Pengeluaran"
2. Klik tombol "+ TAMBAH PENGELUARAN"
3. Isi form:
   - Tanggal & Waktu
   - Kategori (Listrik/Gas/Sewa/Pembaharuan/Lainnya)
   - Deskripsi
   - Nominal (amount)
   - Pengguna (auto-filled)
4. Klik "SIMPAN"
```

### Kategori Pengeluaran
- **Listrik**: Tagihan listrik bulanan
- **Gas**: Refill tabung gas
- **Sewa**: Sewa tempat/rental
- **Pembaharuan**: Maintenance, perbaikan
- **Lainnya**: Kategori lainnya

### Edit Pengeluaran
```
1. Di list pengeluaran, klik "✏️"
2. Update data
3. Klik "SIMPAN"
```

### Hapus Pengeluaran
```
1. Di list pengeluaran, klik "🗑"
2. Konfirmasi penghapusan
```

---

## Laporan

**Akses**: Admin Only

### Laporan Penjualan
```
1. Klik menu "Laporan"
2. Pilih "Laporan Penjualan"
3. Filter periode:
   - Input "Dari Tanggal"
   - Input "Sampai Tanggal"
   - Klik "Filter"
4. Lihat total penjualan di bawah tabel
```

### Laporan Pengeluaran
```
1. Klik menu "Laporan"
2. Pilih "Laporan Pengeluaran"
3. Filter periode (sama seperti penjualan)
4. Lihat total pengeluaran di bawah tabel
```

### Export Laporan (Manual)
```
1. Klik kanan tabel
2. Pilih "Copy all" atau gunakan Ctrl+A
3. Paste ke Excel
4. Simpan file
```

---

## Pengaturan User

**Akses**: Admin Only

### Daftar User
```
1. Klik menu "Pengaturan"
2. Lihat semua user yang terdaftar
3. Cek role dan status masing-masing
```

### Tambah User Baru
```
1. Klik tombol "+ TAMBAH USER"
2. Isi form:
   - Username (unique, no spaces)
   - Email
   - Password (min 6 karakter)
   - Nama Lengkap
   - Role (Admin/Kasir)
3. Klik "SIMPAN"
```

### Edit User
```
1. Klik tombol "✏️" di baris user
2. Update:
   - Nama Lengkap
   - Role
   - Status (Active/Inactive)
3. Klik "SIMPAN"

NOTE: Username, Email, Password tidak bisa diubah
```

### Nonaktifkan User
```
1. Click "✏️" pada user
2. Ubah Status ke "Inactive"
3. User tidak bisa login
```

### Hapus User
```
1. Klik tombol "🗑" di baris user
2. Konfirmasi penghapusan
3. User & data terhapus

CATATAN: Data history transaksi tetap tersimpan
```

---

## Tips & Trik

### Untuk Kasir
✅ Perhatikan list produk di sebelah kiri  
✅ Gunakan kategori untuk cari cepat  
✅ Validasi pembayaran sebelum selesai  
✅ Jika lupa logout, sistem auto-timeout 2 jam  

### Untuk Admin
✅ Update stok minimum produk  
✅ Monitor stok di dashboard  
✅ Catat pengeluaran rutin  
✅ Backup database regular  
✅ Lihat laporan untuk evaluasi penjualan  

### Shortcut Keyboard
| Tombol | Fungsi |
|--------|--------|
| Ctrl+A | Select All |
| Ctrl+C | Copy |
| Ctrl+V | Paste |
| Esc | Close modal |

---

## FAQ

**Q: Lupa password?**
A: Hubungi admin untuk reset password

**Q: Bagaimana jika transaksi error?**
A: Klik kembali, jangan double-click pembayaran

**Q: Stok bisa negatif?**
A: Tidak, sistem akan warning jika stok habis

**Q: Bisa edit transaksi yang sudah selesai?**
A: Tidak, riwayat transaksi permanent/read-only

**Q: Bagaimana backup data?**
A: Admin buka phpMyAdmin, export database

---

## Laporan Masalah (Bug Report)

Jika menemukan bug atau error:
1. Catat waktu kejadian
2. Sebutkan apa yang dilakukan
3. Tangkap screenshot error
4. Laporkan ke admin

---

Selamat menggunakan POS System! 🎉
