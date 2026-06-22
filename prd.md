1. Project Overview & Objective
Sistem ini dibangun untuk mendigitalisasi proses pemesanan tiket di tempat wisata Istana Pasir Cilegon yang sebelumnya masih bersifat manual. Tujuannya adalah mengurangi antrean di lokasi, meminimalisir kesalahan pencatatan data transaksi, serta membantu pihak manajemen (Admin, Petugas Loket, dan Owner) dalam mengelola operasional dan memantau laporan pendapatan secara real-time.

2. User Personas & Roles (Aktor)
Sistem ini mengakomodasi 4 jenis pengguna dengan hak akses (Role) yang berbeda menggunakan sistem Autentikasi Tunggal berbasis Middleware:

Pengunjung (Visitor):

Melakukan registrasi akun dan login.

Melihat informasi tiket, harga, dan sisa stok.

Melakukan pemesanan tiket dan simulasi pembayaran (unggah bukti transfer).

Mengunduh E-Ticket yang berisi QR Code setelah pembayaran divalidasi.

Admin:

Mengelola master data tiket (CRUD Tiket: Nama, Harga, Stok, Deskripsi).

Memvalidasi dan memverifikasi bukti pembayaran yang diunggah pengunjung.

Mengubah status pesanan (Pending, Dibayar, Selesai).

Petugas Loket:

Membuka halaman verifikasi/pemindaian tiket.

Melakukan validasi E-Ticket pengunjung di gerbang masuk (mengubah status tiket dari Aktif menjadi Digunakan).

Owner:

Mengakses dashboard eksekutif untuk melihat grafik total pengunjung, total transaksi, dan total pendapatan harian/bulanan/tahunan.

3. Scope of Work & Out of Scope (Batasan Masalah)
In Scope (Fitur yang Wajib Ada):
Autentikasi: Fitur Registrasi, Login, dan Logout untuk seluruh pengguna.

Manajemen Tiket: Modul CRUD data tiket oleh Admin.

Transaksi & Booking: Form pemesanan dengan kalkulator harga otomatis (menggunakan JavaScript).

Simulasi Pembayaran: Fitur unggah file gambar (.jpg, .jpeg, .png) sebagai bukti transfer bank manual.

Modul E-Ticket: Pembuatan QR Code unik secara otomatis per transaksi yang sukses dikonfirmasi.

Modul Laporan: Filter data pendapatan dan cetak laporan berbasis tabular.

Out of Scope (Tidak Dikerjakan):
Payment Gateway Nyata: Sistem tidak terintegrasi dengan Midtrans/Xendit/Doku, melainkan hanya menggunakan simulasi unggah bukti transfer manual.

Sistem Pemasaran: Sistem berfokus pada operasional pemesanan, verifikasi, dan pelaporan, bukan SEO atau iklan pariwisata.

4. Technical Architecture & Stack
Framework: Laravel 11 (Struktur aplikasi ringkas, performa optimal).

Front-End Styling: Tailwind CSS (Responsif, utility-first framework).

Authentication Package: Laravel Breeze (Blade / Livewire Stack).

Database: MySQL / MariaDB (Relasional).

QR Code Generator: simplesoftwareio/simple-qrcode (Untuk kebutuhan e-ticket).

5. Database Schema Requirements (Ringkasan)
Berikut adalah gambaran tabel esensial yang harus dibentuk saat migrasi:

users: id, nama, email, username, password, role (admin, owner, pengunjung, petugas).

tikets: id, nama_tiket, harga, stok, deskripsi.

pemesanans: id, id_user, id_tiket, tanggal_pesan, jumlah_tiket, total_harga, status (pending, dibayar, selesai).

pembayarans: id, id_pemesanan, tanggal_bayar, metode_bayar, jumlah_bayar, bukti_bayar (path file gambar), status_bayar (berhasil, gagal).

e_tikets: id, id_pemesanan, kode_qr (unique string), tanggal_kirim, status_tiket (aktif, digunakan).
