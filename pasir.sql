-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 06:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_tikets`
--

CREATE TABLE `e_tikets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pemesanan` bigint(20) UNSIGNED NOT NULL,
  `kode_qr` varchar(255) NOT NULL,
  `tanggal_kirim` datetime NOT NULL,
  `status_tiket` enum('aktif','digunakan') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `e_tikets`
--

INSERT INTO `e_tikets` (`id`, `id_pemesanan`, `kode_qr`, `tanggal_kirim`, `status_tiket`, `created_at`, `updated_at`) VALUES
(1, 1, 'ETK-20260616-EML5YAOJ', '2026-06-16 08:31:56', 'digunakan', '2026-06-16 01:31:56', '2026-06-16 01:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_16_000001_create_tikets_table', 2),
(5, '2026_06_16_000002_create_pemesanans_table', 2),
(6, '2026_06_16_000003_create_pembayarans_table', 2),
(7, '2026_06_16_000004_create_e_tikets_table', 2),
(8, '2026_06_16_000000_add_missing_profile_columns_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pemesanan` bigint(20) UNSIGNED NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `metode_bayar` varchar(255) NOT NULL DEFAULT 'Transfer Bank Manual',
  `jumlah_bayar` int(10) UNSIGNED NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status_bayar` enum('pending','berhasil','gagal') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `id_pemesanan`, `tanggal_bayar`, `metode_bayar`, `jumlah_bayar`, `bukti_bayar`, `status_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-06-16 08:29:54', 'Transfer Bank Manual', 75000, 'bukti-pembayaran/vLmCeAWcglaCdq5kBqYJ6Qscz6JQ8MMIh2VnNq4R.jpg', 'berhasil', '2026-06-16 01:29:54', '2026-06-16 01:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_tiket` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `tanggal_kunjungan` date DEFAULT NULL,
  `jumlah_tiket` int(10) UNSIGNED NOT NULL,
  `total_harga` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','dibayar','selesai') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id`, `id_user`, `id_tiket`, `tanggal_pesan`, `tanggal_kunjungan`, `jumlah_tiket`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2026-06-16 08:29:45', '2026-06-27', 1, 75000, 'selesai', '2026-06-16 01:29:45', '2026-06-16 01:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('44nu7scMNEvJYJlRvbq1bjUo72TL1sopmeQjSLgt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.124.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRURHRm0yOVBDd0VGVTZQaFd3eE1KdFhwanRXbTZKSGFYU3NNSVkxciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781756458),
('9kmeTtfteUcyl7xBxgkv35NXDCLGg7aqx1tN9L6p', NULL, '127.0.0.1', 'curl/8.4.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQm9ObFo3em43ZzA3M3pab0N1NTBXN0Jyb2dFb3FVZlVLMWdrYXowWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781598456),
('H6sFOm3tkcld8iKZ4HBRJI6W6dJYNvdXxXFdZRpZ', NULL, '127.0.0.1', 'curl/8.4.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDN6VGJlZ0pHUG1lNDhveG96QVRFWkVkbGcyWHl1bzBxNzRpQU9mUyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781598972),
('Iola9TfbRIeUlOhv2nsTQUPcuHk3g0YFPT2563fa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmk1N2dRVWF2YUhjS214QlpMRVZxZnAzek9XcUVlMHJwMUJ5WUdjRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1781600136),
('y0byu9mFSJIupRvs9RqL7tc5NgKkDNL7DnIteGn0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.124.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGJ2aHdVQmFnTURzQlRudFAwQ0N1cXcybWlpVkhveVl1U0RhWnpFVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781598244);

-- --------------------------------------------------------

--
-- Table structure for table `tikets`
--

CREATE TABLE `tikets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_tiket` varchar(255) NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `stok` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tikets`
--

INSERT INTO `tikets` (`id`, `nama_tiket`, `harga`, `stok`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Terusan VIP ⭐', 75000, 119, 'Akses penuh semua wahana utama, kolam renang anak & dewasa, spot foto, serta free soft drink & ice cream.', '2026-06-16 01:27:01', '2026-06-16 01:29:45'),
(2, 'Regular Dewasa', 30000, 350, 'Satu tiket masuk per orang dewasa. Belum termasuk akses ke wahana air dan playground anak.', '2026-06-16 01:27:01', '2026-06-16 01:27:01'),
(3, 'Regular Anak', 20000, 420, 'Satu tiket masuk per anak. Termasuk akses area Istana Pasir utama dan kolam renang anak.', '2026-06-16 01:27:01', '2026-06-16 01:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` enum('admin','owner','pengunjung','petugas') NOT NULL DEFAULT 'pengunjung',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Istana Pasir', 'admin@istanapasir.test', 'admin', NULL, 'admin', NULL, '$2y$12$j15WoORY6a1ozPyIHi50f.5I4O5yrJQsb7nisi2fPe/ZKBa6dNrIa', 'w2Yiax0BWzAV34qsAuuYGAH8Cq73nonZSN90C7Np2nMVm0e165KcA5VaS3Z1', '2026-06-16 01:27:00', '2026-06-16 01:27:00'),
(2, 'Owner Istana Pasir', 'owner@istanapasir.test', 'owner', NULL, 'owner', NULL, '$2y$12$ym6rv/6pyict9dAtkPsPOetZMXszlfbHZMVYuuaJaKRJBNjYnHz8y', 'QzxdVLLDS2WkPCGFqhMOSTJkEtpDjGTlvVp7QQNqhkChHDp5QNgvJm5B8Y3b', '2026-06-16 01:27:00', '2026-06-16 01:27:00'),
(3, 'Petugas Loket', 'petugas@istanapasir.test', 'petugas', NULL, 'petugas', NULL, '$2y$12$Drh.e6nM2vdusy/8Koird.gvEHAUaO1s70aQ54gxnMPD8SNobwq46', 'siXlnhEZkTv5cZBrHrshHllKuH4daYGpoYkIKFb570Cpzyp0JwAvDuW3TeuU', '2026-06-16 01:27:01', '2026-06-16 01:27:01'),
(4, 'Pengunjung Demo', 'pengunjung@istanapasir.test', 'pengunjung', NULL, 'pengunjung', NULL, '$2y$12$fOmBQ/SWH3vkwxjE85N06OiGKk7xRAc44YDBRZDHtjHLRTTJx5FfG', NULL, '2026-06-16 01:27:01', '2026-06-16 01:27:01'),
(5, 'Abdul Muis', 'mabsul4@gmail.com', 'Muis', '087873714410', 'pengunjung', NULL, '$2y$12$923WmpfhyqVFiWe/zls0teSgkBIJPIboXAy1GXKR2D5zQwUIpqhTa', 'klQXxu9RHvnOlqbu36Tc2VkNiQj2cgLFEOs3dOGmtriHdJe4d8nGgFWvWa9i', '2026-06-16 01:29:29', '2026-06-16 01:29:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `e_tikets`
--
ALTER TABLE `e_tikets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `e_tikets_kode_qr_unique` (`kode_qr`),
  ADD KEY `e_tikets_id_pemesanan_foreign` (`id_pemesanan`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_id_pemesanan_foreign` (`id_pemesanan`);

--
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanans_id_user_foreign` (`id_user`),
  ADD KEY `pemesanans_id_tiket_foreign` (`id_tiket`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tikets`
--
ALTER TABLE `tikets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `e_tikets`
--
ALTER TABLE `e_tikets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tikets`
--
ALTER TABLE `tikets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `e_tikets`
--
ALTER TABLE `e_tikets`
  ADD CONSTRAINT `e_tikets_id_pemesanan_foreign` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_id_pemesanan_foreign` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD CONSTRAINT `pemesanans_id_tiket_foreign` FOREIGN KEY (`id_tiket`) REFERENCES `tikets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
