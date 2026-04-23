# ⚡ QUICK START - 5 LANGKAH UNTUK JALANKAN APLIKASI

## 1️⃣ INSTALL DEPENDENCIES (Jika belum dilakukan)
```bash
cd D:\POS_web
composer install
```

## 2️⃣ BUAT DATABASE

### Cara A - Menggunakan phpMyAdmin (PALING MUDAH)
```
1. Buka browser: http://localhost/phpmyadmin
2. Login (username: root, password kosong)
3. Di sebelah kiri, klik "Database"
4. Masukkan nama: "pos_system"
5. Pilih collation: utf8mb4_unicode_ci
6. Klik tombol "Create"
7. Database berhasil dibuat!
```

### Cara B - Menggunakan phpMyAdmin Import
```
1. Buka http://localhost/phpmyadmin
2. Klik database "pos_system" (jika sudah ada)
3. Klik tab "Import"
4. Klik "Choose File", pilih file: D:\POS_web\database_setup.sql
5. Klik "Go"
6. SELESAI! Semua tabel + data awal terinstal
```

### Cara C - Menggunakan MySQL Command Line
```bash
mysql -u root -p
CREATE DATABASE pos_system;
USE pos_system;
SOURCE D:\POS_web\database_setup.sql;
EXIT;
```

## 3️⃣ KONFIGURASI .ENV (Jika diperlukan)

Edit file: `D:\POS_web\.env`

Pastikan ini sesuai dengan sistem Anda:
```env
database.default.hostname = localhost
database.default.database = pos_system
database.default.username = root
database.default.password = 
database.default.port = 3306
```

Jika MySQL Anda Ada password:
```env
database.default.password = YOUR_PASSWORD_HERE
```

## 4️⃣ JALANKAN APLIKASI

Buka Command Prompt / PowerShell di folder `D:\POS_web`:

```bash
php spark serve
```

Tunggu sampai terlihat:
```
CodeIgniter v4.7.2 Command Line Tool - Server Time: ...
Running migrations...
CodeIgniter development server started on http://localhost:8080
```

## 5️⃣ AKSES APLIKASI

Buka browser dan pergi ke:
```
http://localhost:8080
```

Login dengan salah satu akun:
```
Admin:
  Username: admin
  Password: admin123

Kasir:
  Username: kasir
  Password: kasir123
```

---

## ✅ CEKLIS VERIFIKASI

Setelah login, cek fitur ini berfungsi:
- [ ] Dashboard menampilkan statistik
- [ ] Tombol di sidebar bisa diklik
- [ ] Masuk ke halaman Kasir/Barang/Riwayat, dll
- [ ] Tambah produk (Admin) berhasil
- [ ] Lakukan transaksi (Kasir) berhasil
- [ ] Logout berfungsi

---

## 🆘 COMMON ISSUES

### Error: "Unable to connect to the database"
✅ Solusi:
- Pastikan MySQL sudah running
- Check .env configuration
- Pastikan database "pos_system" sudah ada

### Error: "Class not found" atau "Function not found"
✅ Solusi:
```bash
composer install
```

### Blank page atau 404
✅ Solusi:
- Pastikan URL: http://localhost:8080 (bukan :80 atau port lain)
- Check apakah `php spark serve` masih berjalan

### Database kosong (tidak ada tabel)
✅ Solusi:
- Import file `database_setup.sql` menggunakan phpMyAdmin
- Atau jalankan command di atas

---

## 📚 DOKUMENTASI LENGKAP

Di folder `D:\POS_web\` sudah ada:

| File | Untuk |
|------|-------|
| **README_APLIKASI.md** | Overview lengkap fitur |
| **INSTALLATION_GUIDE.md** | Panduan instalasi detail + troubleshooting |
| **USER_GUIDE.md** | Cara menggunakan setiap fitur |
| **SETUP_GUIDE.md** | Referensi database & API |

---

## 🎯 NEXT STEPS

1. **Login & Explore**: Coba semua fitur untuk familiar
2. **Baca USER_GUIDE.md**: Pelajari cara penggunaan lengkap
3. **Ubah Password**: Ganti password default jika sudah production
4. **Tambah Data**: Mulai add produk dan gunakan POS
5. **Backup**: Backup database secara rutin

---

## 📞 NEED HELP?

1. Baca dokumentasi yang sesuai
2. Cek FAQ di USER_GUIDE.md
3. Lihat INSTALLATION_GUIDE.md untuk troubleshooting

---

**Congratulations! 🎉 Aplikasi POS System siap digunakan!**
