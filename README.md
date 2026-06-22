# 🏰 Sistem Informasi Pemesanan Tiket Wisata Istana Pasir

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

Sistem informasi pemesanan tiket wisata online untuk **Istana Pasir Cilegon** - destinasi rekreasi keluarga dengan istana pasir termegah di Indonesia. Aplikasi ini mendukung manajemen tiket, pembayaran manual dengan upload bukti, verifikasi oleh admin, dan generate e-ticket otomatis.

---

## 📸 Screenshots

| Halaman Welcome | Dashboard Pengunjung |
|:---------------:|:--------------------:|

| Verifikasi Pembayaran | E-Ticket QR Code |
|:---------------------:|:-----------------:|

---

## ✨ Fitur Utama

### 👤 Pengunjung (Visitor)
- Registrasi & login akun
- Pemesanan tiket dengan kalkulasi harga otomatis
- Pilih periode kunjungan (tanggal mulai - selesai)
- Upload bukti pembayaran manual (transfer bank)
- Download & cetak e-ticket dengan QR Code

### 🔐 Admin
- Dashboard statistik penjualan & pengunjung
- CRUD manajemen tiket (harga, stok, deskripsi)
- Verifikasi pembayaran (setujui/tolak)
- Kelola data pemesanan
- Laporan penjualan (filter periode)

### 👮 Petugas
- Scan/input kode QR e-ticket
- Validasi tiket masuk
- Ubah status tiket menjadi "digunakan"

### 📊 Owner
- Dashboard laporan lengkap
- Statistik pendapatan & pengunjung

---

## 🛠️ Teknologi & Stack

| Kategori | Teknologi |
|----------|-----------|
| **Backend** | Laravel 12.x (PHP 8.2+) |
| **Frontend** | Blade Templates + TailwindCSS 3.x |
| **Database** | MySQL / SQLite |
| **Auth** | Laravel Authentication (Session) |
| **Icons** | Emoji (no external library) |
| **QR Code** | SVG Placeholder (siap integrasi simple-qrcode) |

---

## 📋 Persyaratan Sistem

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x & **NPM**
- **MySQL** >= 5.7 atau **SQLite**
- **XAMPP/WAMP/Laragon** (untuk development lokal)

---

## 🚀 Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/istana-pasir-tiket.git
cd istana-pasir-tiket
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies Frontend

```bash
npm install
```

### 4. Setup Environment File

```bash
# Copy file .env.example
copy .env.example .env    # Windows
# atau
cp .env.example .env      # Linux/Mac

# Generate application key
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env` sesuai konfigurasi database Anda:

**Option A: MySQL (Recommended)**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=istana_pasir_db
DB_USERNAME=root
DB_PASSWORD=
```

**Option B: SQLite (Simple)**
```env
DB_CONNECTION=sqlite
# Hapus/comment baris DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

### 6. Jalankan Migrasi & Seeder

```bash
# Jalankan migrasi database
php artisan migrate

# Jalankan seeder (data awal: user & tiket)
php artisan db:seed
```

### 7. Build Frontend Assets

```bash
npm run build
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser dan akses: **http://localhost:8000**

---

## 🔑 Akun Demo

Setelah menjalankan `php artisan db:seed`, Anda dapat login dengan akun berikut:

| Role | Email | Username | Password |
|------|-------|----------|----------|
| **Admin** | admin@istanapasir.test | admin | password |
| **Owner** | owner@istanapasir.test | owner | password |
| **Petugas** | petugas@istanapasir.test | petugas | password |
| **Pengunjung** | pengunjung@istanapasir.test | pengunjung | password |

> ⚠️ **Penting:** Ganti password akun ini saat deploy ke production!

---

## 📁 Struktur Folder Penting

```
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Logic controller
│   │   └── Middleware/      # Role middleware
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Schema database
│   └── seeders/             # Data awal
├── resources/
│   └── views/
│       ├── admin/           # View admin
│       ├── visitor/         # View pengunjung
│       ├── petugas/         # View petugas
│       └── owner/           # View owner
└── routes/
    └── web.php              # Routing aplikasi
```

---

## 🔧 Command Penting

```bash
# Development server
php artisan serve

# Build CSS/JS (development)
npm run dev

# Build CSS/JS (production)
npm run build

# Reset database & seed ulang
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 🗄️ Diagram Alur Sistem

```
[Pengunjung] ── Registrasi/Login ──> [Dashboard]
      │
      ├── Pesan Tiket ──> Pilih Jenis & Jumlah ──> Checkout
      │                                              │
      │                                              ├── Upload Bukti Bayar
      │                                              │
      │                                              ▼
      │                                        [Admin Verifikasi]
      │                                              │
      │                         ┌────────────────────┴────────────────────┐
      │                         │                                         │
      │                    [Disetujui]                              [Ditolak]
      │                         │                                         │
      │                         ▼                                         │
      │               Generate E-Ticket                           Ulang Upload
      │                         │
      │                         ▼
      │               [Tampilkan QR Code]
      │                         │
      │                         ▼
      │               [Petugas Scan/Validasi]
      │                         │
      │                         ▼
      │                  Status: Digunakan
      │
      └── Lihat Riwayat Pemesanan
```

---

## 🌐 Deployment ke Hosting

### Persiapan

1. Pastikan hosting mendukung **PHP 8.2+** dan **MySQL**
2. Zip semua file project (kecuali `node_modules` dan `vendor`)

### Langkah Deploy

1. Upload zip ke `public_html` atau subfolder
2. Extract file
3. Set **Document Root** ke folder `/public`
4. Import database MySQL via phpMyAdmin
5. Edit `.env` sesuai konfigurasi hosting:
   ```env
   APP_URL=https://domain-anda.com
   DB_DATABASE=name_db
   DB_USERNAME=user_db
   DB_PASSWORD=pass_db
   ```
6. Jalankan via SSH/terminal:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan key:generate
   php artisan migrate --force
   php artisan db:seed --force
   ```

---

## ⚠️ Catatan Pengembangan

### Fitur yang Belum Implementasi:

1. **QR Code Real** - Saat ini menggunakan SVG placeholder. Untuk integrasi QR Code asli:
   ```bash
   composer require simplesoftwareio/simple-qrcode
   ```

2. **Halaman Welcome Dinamis** - Daftar tiket di halaman welcome masih hard-coded, sebaiknya diambil dari database

3. **Validasi Stok Tiket** - Perlu penambahan validasi stok saat pemesanan

4. **Edit Profil** - Fitur ubah password & profil pengguna

5. **Reset Password** - Fitur lupa password via email

---

## 📄 License

Project ini dibuat untuk keperluan pembelajaran dan dapat digunakan secara bebas di bawah lisensi [MIT](LICENSE).

---

## 👨‍💻 Author

Dibuat dengan ❤️ untuk **Istana Pasir Cilegon**

---

## 🙏 Credits

- [Laravel](https://laravel.com) - The PHP Framework
- [TailwindCSS](https://tailwindcss.com) - A utility-first CSS framework

