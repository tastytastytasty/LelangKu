-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2025 at 01:34 AM
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
-- Database: `lelang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(10) UNSIGNED NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `tgl` date NOT NULL,
  `harga_awal` bigint(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `tgl`, `harga_awal`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Tanah', '2025-11-17', 90000, '1.000 Km2 \r\nPadalarang,Bandung barat', 'img/xVn4oZJ3SPuFss7LmQjhoGVrwOiRbrPJZZqfMyAR.jpg', '2025-11-16 23:43:03', '2025-11-17 17:23:53'),
(3, 'Rumah', '2025-11-17', 120000, '2 tingkat, Cimahi Selatan', 'img/w2N6TZGanz2agd7SSr7LnSBeAMyH3Iue7YtbruIg.jpg', '2025-11-17 04:37:19', '2025-11-17 17:23:41'),
(5, 'Mobil Hitam', '2025-11-18', 30000, 'ban 4', 'img/Hp3shLZOvi9OAJ9M1TQFzK2r7C8M3FaCNF4Suwx8.jpg', '2025-11-17 17:01:36', '2025-11-17 23:51:53'),
(6, 'Tanah bukit', '2025-11-18', 30000, 'Pasir halus 3.000 hm2', 'img/vtWXP835TMv6b1krVVtluPpYqHORUThbdX4NZSt3.jpg', '2025-11-17 18:44:04', '2025-11-17 18:44:04'),
(7, 'Mobil merah', '2025-11-18', 28000, 'mobil tidak putih', 'img/etJZLjRVLJ3gWVWM3Oy1QvsDXTGmMZPD3gnqnmRU.jpg', '2025-11-17 20:11:42', '2025-11-18 18:47:20'),
(8, 'Rumah II', '2025-11-19', 230000, 'Kamar tidur 2, Kamar mandi 2', 'img/KC8iVlmsiKY6i1BlaNSecTLMTvDQMU6WBq7AUb2i.jpg', '2025-11-18 23:29:04', '2025-11-19 06:21:42'),
(9, 'Villa bandung', '2025-11-19', 500000, 'Ada danau', 'img/box.jpg', '2025-11-19 06:23:08', '2025-11-19 06:23:08');

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
-- Table structure for table `history_lelang`
--

CREATE TABLE `history_lelang` (
  `id_history` int(10) UNSIGNED NOT NULL,
  `id_lelang` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `penawaran_harga` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_lelang`
--

INSERT INTO `history_lelang` (`id_history`, `id_lelang`, `id_barang`, `id_user`, `penawaran_harga`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 1, 32000, '2025-11-17 21:07:59', '2025-11-17 21:07:59'),
(2, 3, 3, 1, 2500, '2025-11-17 21:24:12', '2025-11-17 21:24:12'),
(3, 6, 7, 4, 28100, '2025-11-17 21:28:46', '2025-11-17 21:28:46'),
(4, 5, 5, 1, 33000, '2025-11-17 23:08:29', '2025-11-17 23:08:29'),
(5, 8, 5, 4, 30001, '2025-11-18 00:17:38', '2025-11-18 00:17:38'),
(6, 8, 5, 4, 30002, '2025-11-18 00:18:20', '2025-11-18 00:18:20'),
(7, 8, 5, 4, 30003, '2025-11-18 00:23:59', '2025-11-18 00:23:59'),
(8, 6, 7, 1, 28200, '2025-11-18 18:22:29', '2025-11-18 18:22:29'),
(9, 6, 7, 4, 28500, '2025-11-18 23:25:11', '2025-11-18 23:25:11');

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
-- Table structure for table `lelang`
--

CREATE TABLE `lelang` (
  `id_lelang` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `tgl_lelang` date NOT NULL,
  `harga_awal` bigint(20) NOT NULL,
  `harga_akhir` bigint(20) NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `id_petugas` int(10) UNSIGNED NOT NULL,
  `status` enum('dibuka','ditutup') NOT NULL DEFAULT 'ditutup',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lelang`
--

INSERT INTO `lelang` (`id_lelang`, `id_barang`, `tgl_lelang`, `harga_awal`, `harga_akhir`, `id_user`, `id_petugas`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-11-18', 1000, 1000, NULL, 3, 'ditutup', '2025-11-17 05:32:05', '2025-11-17 23:39:49'),
(3, 3, '2025-11-17', 1000, 2500, 1, 3, 'ditutup', '2025-11-17 05:35:06', '2025-11-18 20:49:18'),
(4, 6, '2025-11-18', 30000, 30000, NULL, 3, 'dibuka', '2025-11-17 18:44:30', '2025-11-17 18:44:36'),
(5, 5, '2025-11-18', 30000, 33000, 1, 3, 'dibuka', '2025-11-17 19:57:18', '2025-11-17 23:08:29'),
(6, 7, '2025-11-18', 28000, 28500, 4, 5, 'dibuka', '2025-11-17 20:12:35', '2025-11-19 23:27:31'),
(7, 2, '2025-11-19', 90000, 90000, NULL, 3, 'ditutup', '2025-11-17 23:39:18', '2025-11-17 23:39:18'),
(8, 5, '2025-11-19', 30000, 30003, 4, 5, 'ditutup', '2025-11-18 00:08:14', '2025-11-18 18:52:22'),
(9, 7, '2025-11-20', 28000, 28000, NULL, 3, 'ditutup', '2025-11-18 05:55:38', '2025-11-18 06:11:43'),
(10, 2, '2025-11-20', 90000, 90000, NULL, 5, 'ditutup', '2025-11-18 17:47:14', '2025-11-18 17:47:14'),
(12, 8, '2025-11-22', 230000, 230000, NULL, 5, 'ditutup', '2025-11-19 23:11:48', '2025-11-19 23:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(10) UNSIGNED NOT NULL,
  `level` enum('administrator','petugas') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level`, `created_at`, `updated_at`) VALUES
(1, 'administrator', NULL, NULL),
(2, 'petugas', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(25) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id_user`, `nama_lengkap`, `username`, `password`, `alamat`, `telp`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Vincent', '1234567123456789', '$2y$12$Tx/DBGU5qBMpbJywOB8IWO82B4NnGBkgTk16VkE1FS4lNBmT6.UU6', 'Jln. Batujajar', '081234578956', 'img/9GMU0Hg0ugS1odq9YQCfO1HYyxt0havYMi949i47.jpg', 'aktif', '2025-11-15 21:54:22', '2025-11-19 07:49:42'),
(4, 'Ali', '1234567899876543', '$2y$12$gcI96vBVYEDQC4iZWl.D7ecka.ssU3K6Q2YTXcsLWNgohSg2MWDPy', 'Jln. Haji bakar', '081234578974', 'img/6kgFTglINXvHmWs1LLuIqjisAVZ7EAEdalS35R7R.jpg', 'aktif', '2025-11-17 01:06:47', '2025-11-18 23:07:27'),
(5, 'Budi', '1111111111111111', '$2y$12$QSvNBBrVAg8sndk1kqQabulms2hQMQi3cZbxG3qQqIcabviUqJn3K', 'Jl. Cangkorah', '081234578972', 'img/91fkn4sbVa4aYdsTkq443tB5L9SIQcHdF3TcW0Bc.jpg', 'blokir', '2025-11-18 21:10:26', '2025-11-18 23:13:34');

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
(4, '2025_11_14_004847_create_masyarakat_table', 1),
(5, '2025_11_14_004915_create_barang_table', 1),
(6, '2025_11_14_004929_create_level_table', 1),
(7, '2025_11_14_004942_create_petugas_table', 2),
(8, '2025_11_14_005007_create_lelang_table', 2),
(9, '2025_11_14_005016_create_history_lelang_table', 2),
(10, '2025_11_17_005022_add_column_tgl_to_barang', 3),
(11, '2025_11_17_005655_add_column_harga_awal_to_lelang', 4),
(12, '2025_11_17_010110_add_column_status_to_masyarakat', 5),
(13, '2025_11_17_021155_add_column_gambar_to_masyarakat', 6),
(14, '2025_11_17_021215_add_column_gambar_to_petugas', 6);

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
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(10) UNSIGNED NOT NULL,
  `nama_petugas` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_level` int(10) UNSIGNED NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `id_level`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Admin Utama', 'admin', '$2y$12$vt2xhwsK6qMZ00mOPgovLevWDy8ydLCc/1.rmc4ueaJ8VOFeULXwC', 1, 'img/Ta9ojLDoq4hYeFmEKArDHSMNmFZmPM1mP3OPTATH.jpg', '2025-11-16 03:17:02', '2025-11-16 23:41:46'),
(3, 'Petugas Satu', 'petugas1', '$2y$12$Ao5H5MwJ4LpO1rwU3QVUv.Vhu0xQRJsr6wk54XJTQvx7NPezGND3u', 2, 'img/7B5PEFCWQ6c8C9BOubJ8ELr6ukqoYaznSDYmquwH.jpg', '2025-11-16 03:17:02', '2025-11-19 07:48:37'),
(5, 'Petugas qwe', 'qwe', '$2y$12$N4V2JSmW.hDd82uI.NDFPuiqHtFBBpFMwBfTGJ39Pk/fknvmXygAC', 2, 'img/xoDEQbQ58CHwLQFTPXOHgAZsSxXEUO2GIEKDt3f4.jpg', '2025-11-17 20:09:27', '2025-11-18 23:13:56'),
(11, 'Petugas qwu', 'qwu', '$2y$12$LL5UmRDIYAxkcSqVm1QlDOiQxmkL83B3CBOMKBKEhHhNdb6ti9/FO', 2, 'img/no.jpg', '2025-11-19 20:20:18', '2025-11-19 20:20:18');

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
('aLJNmjmS6fb8RFmalic2ow7gcO0kyGqg8mlh2qRN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiN09aOE1qWk1yQTBQZENkRGlPc0U4SnFJWDR1V1ZYNTNIaTM4MVFXWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763624365),
('cGEYFFTwMdtWxbwoW3a2FK79I8DrbetFl8BOYQLJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVFg3djl1SjU2VUlVZTVCTkY3RXIzNGszbDlPMzNITTBBU3BpWXhmSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYXN5YXJha2F0L2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo0OiJkYXNoIjt9czo1NzoibG9naW5fbWFzeWFyYWthdF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1763624899),
('GpMIMcOTjxVjelwXqMxBdt6QnJeYSKV8F0Q2D9XH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkFKZGdVelhPeVVFUjBnQU9veG9nYUxqbFkzWEc4S2RHbHAwRTNITyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1763624410),
('OBaDCCJ6Ns7uUDIlYuOr6w9RNgq3ODvNEkApzWxS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidUZqTmh2RE8xb0FvNFJlUTJocm0wOThlM3FVcTg1emZ4NEdqTmlGWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYXBvcmFuIjtzOjU6InJvdXRlIjtzOjc6ImxhcG9yYW4iO31zOjU0OiJsb2dpbl9wZXR1Z2FzXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1763624099),
('VgdulZiS64hiBEdGSc5zZscZrPKPBMq0rV1Fg1qa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTnVWeFBYR1M4MlNnQ0FTUThRUXl4VjQ1QXdKYXhzN3ZyM3R6UTBwUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXR1Z2FzL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo1OiJib2FyZCI7fXM6NTQ6ImxvZ2luX3BldHVnYXNfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1763685181),
('zSzhIq78WN7FS4faSzaLMXUFHNPv0vG0Tgx8A6EC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM1pRbGlNMDRFZkU2V01aSHlrcFBFRlhJZWE1OWtKYzhMYnZBNUtPaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7Tjt9czo1NzoibG9naW5fbWFzeWFyYWthdF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1763624350);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_lelang`
--
ALTER TABLE `history_lelang`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `history_lelang_id_lelang_foreign` (`id_lelang`),
  ADD KEY `history_lelang_id_barang_foreign` (`id_barang`),
  ADD KEY `history_lelang_id_user_foreign` (`id_user`);

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
-- Indexes for table `lelang`
--
ALTER TABLE `lelang`
  ADD PRIMARY KEY (`id_lelang`),
  ADD KEY `lelang_id_barang_foreign` (`id_barang`),
  ADD KEY `lelang_id_user_foreign` (`id_user`),
  ADD KEY `lelang_id_petugas_foreign` (`id_petugas`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `masyarakat_username_unique` (`username`),
  ADD UNIQUE KEY `telp` (`telp`);

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
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `petugas_username_unique` (`username`),
  ADD KEY `petugas_id_level_foreign` (`id_level`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_lelang`
--
ALTER TABLE `history_lelang`
  MODIFY `id_history` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lelang`
--
ALTER TABLE `lelang`
  MODIFY `id_lelang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_lelang`
--
ALTER TABLE `history_lelang`
  ADD CONSTRAINT `history_lelang_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `history_lelang_id_lelang_foreign` FOREIGN KEY (`id_lelang`) REFERENCES `lelang` (`id_lelang`),
  ADD CONSTRAINT `history_lelang_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `masyarakat` (`id_user`);

--
-- Constraints for table `lelang`
--
ALTER TABLE `lelang`
  ADD CONSTRAINT `lelang_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `lelang_id_petugas_foreign` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `lelang_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `masyarakat` (`id_user`);

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_id_level_foreign` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
