# PANDUAN INSTALASI LENGKAP - POS SYSTEM

## Prasyarat

Sebelum memulai, pastikan sudah terinstal:
- **XAMPP** atau **WAMP Server** (untuk Apache, PHP, MySQL)
- **Composer** (untuk PHP Dependency Manager)
- **Text Editor** (VSCode, Sublime Text, dll)

## Langkah-Langkah Instalasi

### 1. Download & Install XAMPP/WAMP

#### Untuk XAMPP:
1. Download dari https://www.apachefriends.org/
2. Install dan pilih komponen: Apache, MySQL, PHP
3. Jalankan Apache dan MySQL dari Control Panel

#### Untuk WAMP:
1. Download dari https://www.wampserver.com/
2. Install dengan default settings
3. Klik ikon WAMP dan pilih "Put Online"

### 2. Persiapan Database

#### Menggunakan phpMyAdmin:
1. Buka browser: `http://localhost/phpmyadmin`
2. Login dengan username: `root` (password kosong)
3. Klik menu **"Database"**
4. Masukkan nama database: `pos_system`
5. Pilih collation: **utf8mb4_unicode_ci**
6. Klik tombol **"Create"**

#### Atau menggunakan MySQL Command Line:
```bash
mysql -u root -p
CREATE DATABASE pos_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 3. Import Database Schema

#### Menggunakan phpMyAdmin:
1. Buka database `pos_system` yang baru dibuat
2. Klik menu **"Import"**
3. Klik tombol **"Choose File"**
4. Pilih file `database_setup.sql` dari folder `D:\POS_web\`
5. Klik **"Go"** untuk import

#### Atau menggunakan MySQL Command Line:
```bash
mysql -u root pos_system < D:\POS_web\database_setup.sql
```

### 4. Konfigurasi Aplikasi

File `.env` sudah tersedia di `D:\POS_web\.env`

**Pastikan konfigurasi sudah benar:**
```env
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = pos_system
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Jika MySQL Anda menggunakan password, tambahkan di `password =`

### 5. Install Dependencies dengan Composer

Buka Command Prompt / Power Shell dan jalankan:

```bash
cd D:\POS_web
composer install
```

Tunggu hingga semua dependency terinstal (sekitar 2-5 menit).

### 6. Jalankan Aplikasi

Dari folder `D:\POS_web`, jalankan:

```bash
php spark serve
```

Aplikasi akan berjalan di: **http://localhost:8080**

## Login ke Sistem

### Akun Admin
- **Username**: admin
- **Password**: admin123
- **Hak Akses**: Semua menu dan fitur

### Akun Kasir
- **Username**: kasir  
- **Password**: kasir123
- **Hak Akses**: Kasir & Riwayat Transaksi

## Troubleshooting

### Error: "Unable to connect to the database"

**Solusi:**
1. Pastikan MySQL sudah running (lihat di XAMPP/WAMP Control Panel)
2. Cek konfigurasi di file `.env`
3. Pastikan database `pos_system` sudah dibuat
4. Restart MySQL service

### Error: "Call to undefined function" atau "Class not found"

**Solusi:**
1. Jalankan `composer install` di folder project
2. Hapus folder `vendor` dan jalankan `composer install` lagi

### ERR_CONNECTION_REFUSED

**Solusi:**
1. Cek apakah `php spark serve` masih berjalan
2. Cek port 8080 tidak ada yang menggunakan
3. Coba port berbeda: `php spark serve --port 8081`

### Database empty / tidak ada tabel

**Solusi:**
1. Buka phpMyAdmin
2. Pilih database `pos_system`
3. Klik menu Import
4. Pilih file `database_setup.sql`
5. Klik Go

## Struktur Folder Project

```
D:\POS_web\
│
├── app/
│   ├── Controllers/           # Logic aplikasi
│   ├── Models/               # Data models  
│   ├── Views/                # Template HTML
│   ├── Database/
│   │   ├── Migrations/       # Skema database
│   │   └── Seeds/            # Data awal
│   └── Config/               # Konfigurasi
│
├── public/                    # File publik
├── vendor/                    # Dependency PHP
├── writable/                  # Temporary files
│
├── .env                       # Environment config
├── database_setup.sql         # SQL schema
├── SETUP_GUIDE.md            # Panduan setup
├── spark                      # CLI tool
└── composer.json             # Dependency config
```

## Fitur Aplikasi

### Dashboard
- Ringkasan penjualan hari ini
- Total item terjual dan pengeluaran
- Peringatan stok barang (admin)

### Kasir (POS)
- Interface penjualan real-time
- Kategori produk dengan filter
- Shopping cart interaktif
- Modal pembayaran dengan berbagai metode
- Kalkulasi kembalian otomatis

### Barang & Stok (Admin)
- Manajemen produk lengkap
- Input/edit/hapus barang
- Monitoring stok real-time
- Indikator stok minimum

### Riwayat Transaksi
- Daftar semua transaksi
- Detail transaksi terperinci
- Item per transaksi

### Pengeluaran (Admin)
- Catat pengeluaran operasional
- Kategori pengeluaran fleksibel
- Edit dan hapus pengeluaran

### Laporan (Admin)
- Laporan penjualan per periode
- Laporan pengeluaran per periode
- Filter berdasarkan tanggal

### Pengaturan (Admin)
- Manajemen user/kasir
- Tambah user baru
- Edit role dan status

## Tips Penting

1. **Backup Database**: Sebelum mengubah data, selalu backup di phpMyAdmin
2. **User Roles**: Kasir hanya bisa akses Kasir & Riwayat, Admin akses semua
3. **Stok Minimum**: Setting stok minimum di produk untuk mendapat peringatan
4. **Pembayaran**: Sistem support Tunai, QRIS, dan Debit
5. **Session**: Login session valid selama 2 jam

## Mengubah Password User

### Via phpMyAdmin:
1. Buka database `pos_system`
2. Tabel `users`
3. Edit user yang ingin diubah
4. Update password (gunakan hash online jika manual)

### Testing Password:
Gunakan tool online seperti https://www.php.net/manual/en/function.password-hash.php

## Performance Tips

1. **Clear Cache Browser**: Tekan Ctrl+Shift+Delete
2. **Optimize Images**: Compress gambar produk
3. **Database Index**: Sudah optimal di schema
4. **Session Cleanup**: Otomatis setiap 2 jam

## Support & Kontribusi

Untuk pertanyaan atau bug report, silakan hubungi tim development.

---

**Version**: 1.0.0  
**Created**: April 2026  
**Last Updated**: April 2026
