# POS System - CodeIgniter 4

Sistem Penjualan Terpadu (Point of Sale) dengan fitur lengkap untuk mengelola transaksi penjualan, inventori produk, dan keuangan toko.

## Fitur Utama

### Untuk Kasir:
- **Transaksi Penjualan**: Antarmuka POS interaktif untuk memproses penjualan
- **Riwayat Penjualan**: Lihat semua transaksi yang telah dilakukan

### Untuk Admin:
- Semua fitur kasir plus:
- **Manajemen Barang**: Tambah, ubah, hapus produk dan kelola stok
- **Laporan**: Laporan penjualan dan pengeluaran
- **Pengeluaran**: Catat semua pengeluaran operasional toko
- **Pengaturan User**: Kelola akun kasir dan admin

## Persyaratan Sistem

- PHP 8.0+
- MySQL 5.7+
- Composer
- Web Server (Apache/Nginx)

## Instalasi & Setup

### 1. Konfigurasi Database

Buat database MySQL baru:
```bash
mysql -u root -p
CREATE DATABASE pos_system;
EXIT;
```

### 2. Konfigurasi Environment

File `.env` sudah tersedia di root project. Sesuaikan konfigurasi:

```env
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = pos_system
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 3. Jalankan Migrations

```bash
cd D:\POS_web
php spark migrate
```

### 4. Jalankan Seeder (Data Awal)

```bash
php spark db:seed InitialSeeder
```

### 5. Jalankan Development Server

```bash
php spark serve
```

Server akan berjalan di `http://localhost:8080`

## Akun Login Default

### Admin
- Username: `admin`
- Password: `admin123`

### Kasir
- Username: `kasir`
- Password: `kasir123`

## Struktur Database

### Tabel Users
- id (Primary Key)
- username (Unique)
- email (Unique)
- password
- full_name
- role (admin/kasir)
- status (active/inactive)

### Tabel Products
- id (Primary Key)
- product_code (Unique)
- product_name
- category (Makanan/Minuman/Lainnya)
- unit
- purchase_price
- selling_price
- stock
- min_stock
- status (AKTIF/NONAKTIF)

### Tabel Transactions
- id (Primary Key)
- transaction_code (Unique)
- tanggal_jam
- user_id (Foreign Key)
- total_item
- subtotal
- discount_value
- ppn_percent
- ppn_value
- total_payment
- cash_received
- cash_return
- payment_status (Tunai/QRIS/Debit)

### Tabel Transaction Details
- id (Primary Key)
- transaction_id (Foreign Key)
- product_id (Foreign Key)
- quantity
- unit_price
- subtotal

### Tabel Expenses
- id (Primary Key)
- tanggal
- category
- deskripsi
- nominal
- pengguna
- lampiran

## Fitur & Halaman

### Dashboard
- Ringkasan penjualan hari ini
- Total item terjual
- Total pengeluaran
- Peringatan stok barang (untuk Admin)

### Kasir (POS)
- Tampilan produk dalam grid
- Filter kategori produk
- Pencarian produk real-time
- Keranjang belanja interaktif
- Modal pembayaran dengan berbagai metode
- Perhitungan kembalian otomatis

### Barang & Stok
- Daftar semua produk
- Tambah produk baru
- Edit produk
- Hapus produk
- Indikator stok rendah (warna merah)

### Riwayat Transaksi
- Daftar transaksi harian
- Detail transaksi lengkap
- Info pembayaran

### Pengeluaran Toko
- Daftar pengeluaran operasional
- Kategori pengeluaran (Listrik, Gas, Sewa, dll)
- Tambah/Edit/Hapus pengeluaran

### Laporan
- Laporan penjualan per periode
- Laporan pengeluaran per periode
- Filter berdasarkan tanggal

### Pengaturan
- Manajemen user/kasir
- Tambah user baru
- Edit role dan status user

## Desain & Warna

- **Warna Utama**: Orange (#FF8C42) dan putih
- **Warna Gradien**: #FF8C42 → #FF6B35
- **Layout**: Sidebar satu sisi dengan konten utama yang responsif
- **Font**: Segoe UI

## Navigasi

### Menu Kasir:
1. Dashboard
2. Kasir (POS)
3. Riwayat Transaksi
4. Logout

### Menu Admin:
1. Dashboard
2. Kasir (POS)
3. Barang & Stok
4. Riwayat Transaksi
5. Laporan
6. Pengeluaran
7. Pengaturan
8. Logout

## API Endpoints

### Kasir
- `GET /kasir` - Halaman POS
- `POST /kasir/add-item` - Tambah item ke keranjang
- `POST /kasir/remove-item` - Hapus item dari keranjang
- `GET /kasir/get-cart` - Ambil data keranjang
- `POST /kasir/checkout` - Proses checkout/pembayaran

### Produk
- `GET /products` - Daftar produk
- `GET /products/create` - Form tambah produk
- `POST /products/store` - Simpan produk baru
- `GET /products/edit/:id` - Form edit produk
- `POST /products/update/:id` - Simpan perubahan produk
- `GET /products/delete/:id` - Hapus produk

### Transaksi
- `GET /riwayat` - Daftar transaksi
- `GET /riwayat/detail/:id` - Detail transaksi

### Pengeluaran
- `GET /expenses` - Daftar pengeluaran
- `GET /expenses/create` - Form tambah pengeluaran
- `POST /expenses/store` - Simpan pengeluaran
- `GET /expenses/edit/:id` - Form edit pengeluaran
- `POST /expenses/update/:id` - Simpan perubahan pengeluaran
- `GET /expenses/delete/:id` - Hapus pengeluaran

### User
- `GET /users` - Daftar user
- `GET /users/create` - Form tambah user
- `POST /users/store` - Simpan user baru
- `GET /users/edit/:id` - Form edit user
- `POST /users/update/:id` - Simpan perubahan user
- `GET /users/delete/:id` - Hapus user

### Laporan
- `GET /reports` - Halaman laporan
- `GET /reports/sales` - Laporan penjualan
- `GET /reports/expenses` - Laporan pengeluaran

## Troubleshooting

### Database Connection Error
- Pastikan MySQL sudah berjalan
- Cek konfigurasi `.env`
- Pastikan database `pos_system` sudah dibuat

### Migration Error
- Hapus file migrations yang bermasalah
- Jalankan `php spark migrate:refresh` untuk reset
- Jalankan `php spark migrate` kembali

### Akses Terbatas
- Kasir hanya bisa akses Kasir dan Riwayat
- Admin bisa akses semua menu
- Pengaturan role ada di menu Users

## Struktur Folder

```
POS_web/
├── app/
│   ├── Controllers/     # Semua controller
│   ├── Models/          # Semua model
│   ├── Views/           # Semua view
│   ├── Database/
│   │   ├── Migrations/  # Database migrations
│   │   └── Seeds/       # Data seeder
│   └── Config/          # Konfigurasi aplikasi
├── public/              # File publik (CSS, JS, images)
├── writable/            # Folder writable
├── vendor/              # Vendor packages
├── .env                 # Environment configuration
└── spark                # CLI framework
```

## Tips Penggunaan

1. **Kasir**: Fokus pada POS, inputkan kategori, cari produk, tambah ke keranjang
2. **Admin**: Atur stok minimal di produk agar mendapat peringatan
3. **Pembayaran**: Dukung Tunai, QRIS, dan Debit
4. **Laporan**: Filter berdasarkan tanggal untuk analisis

## Support & Update

Untuk update atau fitur tambahan, hubungi tim development.

---

**Version**: 1.0.0  
**Last Updated**: April 2026
