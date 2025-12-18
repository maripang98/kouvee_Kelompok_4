-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2025 at 04:58 AM
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
-- Database: `kouvee_petshop_4`
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID_CUSTOMER` int(11) NOT NULL,
  `ID_PEGAWAI` int(11) NOT NULL,
  `NAMA_CUSTOMER` varchar(255) DEFAULT NULL,
  `ALAMAT_CUSTOMER` varchar(255) DEFAULT NULL,
  `TGL_LAHIR_CUSTOMER` date DEFAULT NULL,
  `NOMOR_TELEPON_CUSTOMER` varchar(17) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID_CUSTOMER`, `ID_PEGAWAI`, `NAMA_CUSTOMER`, `ALAMAT_CUSTOMER`, `TGL_LAHIR_CUSTOMER`, `NOMOR_TELEPON_CUSTOMER`, `deleted_at`) VALUES
(1, 2, 'Andi Nugrohoo', 'Jl. Kenanga No. 3', '1995-05-19', '08166666666', NULL),
(2, 2, 'Siti Rahma', 'Jl. Dahlia No. 7', '1992-09-20', '082222222222', NULL),
(3, 2, 'Joko Santosoo', 'Jl. Cempaka No. 9', '1989-02-11', '0833333333999', NULL),
(4, 2, 'Maria Pangaribuan', 'Ambarawa', '2004-07-24', '082293633416', NULL),
(6, 2, 'asima', 'ddd', '2025-10-09', '1111166464646', NULL),
(15, 2, 'kiki', 'Babarsari', '2025-10-18', '081111111113', NULL),
(17, 2, 'Andi Nugroho', 'babarsari', '2025-10-30', '111111111119', NULL),
(18, 2, 'Timii', 'Ambarawa', '2021-06-24', '081111111116', '2025-11-27 00:33:17'),
(19, 2, 'juno', 'f', '2000-01-19', '08229325854', '2025-11-27 00:19:57'),
(20, 2, 'jujihy', 'ja', '2000-01-11', '08649785105', '2025-12-04 03:54:08'),
(21, 2, 'jokuu', 'yy', '2000-01-01', '0855488669999', '2025-11-27 00:39:50'),
(22, 2, 'a', 'a', '2000-01-13', '4444444444444', '2025-11-27 01:09:11'),
(23, 2, 'Timi Agung', 'Ambarawa', '1996-07-15', '081111111455', NULL),
(24, 2, 'RIki Erlangga', 'Jawa Tengah', '1994-07-06', '081111114658', NULL),
(25, 2, 'Ayu Kencana', 'Yogyakarta', '1997-02-13', '081111111465', NULL),
(26, 2, 'Agung Sakti+', 'Yogyakarta', '2002-02-20', '081111114551', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_penjualan_lay`
--

CREATE TABLE `detail_transaksi_penjualan_lay` (
  `ID_LAYANAN` int(11) NOT NULL,
  `ID_TRANSAKSI_LAYANAN` int(11) NOT NULL,
  `JUMLAH_ORDER_LAYANAN` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi_penjualan_lay`
--

INSERT INTO `detail_transaksi_penjualan_lay` (`ID_LAYANAN`, `ID_TRANSAKSI_LAYANAN`, `JUMLAH_ORDER_LAYANAN`, `deleted_at`) VALUES
(1, 1, 1, NULL),
(1, 7, 2, '2025-11-12 23:17:27'),
(1, 10, 1, '2025-11-12 23:17:41'),
(1, 11, 5, NULL),
(1, 18, 3, NULL),
(1, 20, 1, NULL),
(1, 24, 1, NULL),
(1, 30, 10, NULL),
(1, 37, 1, NULL),
(2, 2, 1, '2025-11-12 23:11:26'),
(2, 8, 1, '2025-11-12 23:17:33'),
(2, 12, 1, NULL),
(2, 13, 2, NULL),
(2, 14, 1, NULL),
(2, 15, 1, '2025-11-12 23:18:47'),
(2, 16, 2, NULL),
(2, 19, 3, NULL),
(2, 23, 1, NULL),
(2, 26, 1, '2025-11-26 01:29:40'),
(2, 30, 10, NULL),
(2, 35, 30, NULL),
(3, 3, 1, '2025-11-12 23:17:22'),
(3, 9, 7, '2025-11-12 23:17:37'),
(3, 17, 2, NULL),
(3, 21, 1, NULL),
(3, 22, 4, NULL),
(3, 25, 1, NULL),
(3, 36, 45, NULL),
(11, 27, 1, '2025-11-26 01:29:37'),
(11, 28, 1, NULL),
(11, 29, 1, NULL),
(11, 32, 3, NULL),
(11, 33, 4, NULL),
(12, 28, 1, NULL),
(12, 29, 1, NULL),
(12, 31, 20, NULL),
(12, 34, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_penjualan_pro`
--

CREATE TABLE `detail_transaksi_penjualan_pro` (
  `ID_PRODUK` int(11) NOT NULL,
  `ID_TRANSAKSI_PENJUALAN_PRODUK` int(11) NOT NULL,
  `JUMLAH_ORDER_PRODUK` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi_penjualan_pro`
--

INSERT INTO `detail_transaksi_penjualan_pro` (`ID_PRODUK`, `ID_TRANSAKSI_PENJUALAN_PRODUK`, `JUMLAH_ORDER_PRODUK`, `deleted_at`) VALUES
(1, 4, 3, '2025-11-12 03:12:47'),
(1, 5, 3, '2025-11-12 03:13:44'),
(1, 18, 1, NULL),
(1, 19, 1, NULL),
(1, 20, 1, NULL),
(1, 22, 3, NULL),
(1, 23, 3, NULL),
(2, 2, 2, NULL),
(2, 6, 12, '2025-11-12 03:13:41'),
(2, 8, 3, '2025-11-12 03:13:35'),
(2, 10, 4, '2025-11-12 03:13:14'),
(2, 11, 12, '2025-11-12 03:12:57'),
(2, 13, 1, '2025-11-12 15:46:13'),
(2, 18, 1, NULL),
(2, 19, 1, NULL),
(2, 23, 2, NULL),
(2, 24, 1, NULL),
(2, 25, 21, NULL),
(3, 1, 3, NULL),
(3, 3, 2, NULL),
(3, 12, 3, '2025-11-12 15:46:19'),
(3, 13, 1, '2025-11-12 15:46:13'),
(3, 14, 7, '2025-11-12 15:37:51'),
(3, 15, 2, '2025-11-12 15:47:07'),
(3, 17, 1, NULL),
(3, 20, 1, NULL),
(3, 21, 10, NULL),
(3, 26, 4, NULL),
(13, 7, 3, '2025-11-12 03:13:39'),
(13, 9, 8, '2025-11-12 03:13:17'),
(13, 10, 4, '2025-11-12 03:13:14'),
(14, 16, 2, NULL),
(14, 18, 1, NULL),
(14, 27, 5, NULL);

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
-- Table structure for table `hewan`
--

CREATE TABLE `hewan` (
  `ID_HEWAN` int(11) NOT NULL,
  `ID_CUSTOMER` int(11) DEFAULT NULL,
  `NAMA_HEWAN` varchar(255) DEFAULT NULL,
  `TGL_LAHIR_HEWAN` date DEFAULT NULL,
  `JENIS_HEWAN` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hewan`
--

INSERT INTO `hewan` (`ID_HEWAN`, `ID_CUSTOMER`, `NAMA_HEWAN`, `TGL_LAHIR_HEWAN`, `JENIS_HEWAN`, `deleted_at`) VALUES
(1, 1, 'Momonn', '2024-10-10', 'Kucing', NULL),
(2, 2, 'Bobby', '2020-03-11', 'Anjing', NULL),
(3, 3, 'Coco', '2022-12-15', 'Kucing', NULL),
(4, 6, 'timi', '2025-10-17', 'Kucing', NULL),
(5, 4, 'Ponyo', '2024-12-09', 'Kucing', NULL),
(6, 2, 'Yupi', '2025-09-13', 'Kucing', '2025-11-27 00:42:59'),
(7, 1, 'Juji', '2020-01-18', 'Anjing', NULL),
(8, 20, 'kaiska', '2020-01-04', 'Kucing', '2025-11-27 01:11:55'),
(9, 4, 'tutut', '2020-01-23', 'Kucing', '2025-12-04 03:54:27'),
(10, 2, 'jiji', '2020-01-17', 'Kucing', '2025-11-27 04:03:50'),
(11, 3, 'Momonto', '2025-02-15', 'Kucing', NULL),
(12, 2, 'Ayce', '2025-05-30', 'Anjing', NULL),
(13, 6, 'Zugo', '2024-04-13', 'Kucing', NULL),
(14, 15, 'Loui', '2024-12-18', 'Kucing', NULL),
(15, 4, 'Embul', '2022-07-15', 'Kucing', NULL),
(16, 4, 'Poni', '2025-09-19', 'Kucing', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `ID_JABATAN` int(11) NOT NULL,
  `NAMA_JABATAN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`ID_JABATAN`, `NAMA_JABATAN`) VALUES
(1, 'Kasir'),
(2, 'CS'),
(3, 'Owner');

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
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `ID_LAYANAN` int(11) NOT NULL,
  `NAMA_LAYANAN` varchar(255) DEFAULT NULL,
  `DESKRIPSI_LAYANAN` varchar(255) DEFAULT NULL,
  `GAMBAR_LAYANAN` varchar(255) DEFAULT NULL,
  `HARGA_LAYANAN` float DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`ID_LAYANAN`, `NAMA_LAYANAN`, `DESKRIPSI_LAYANAN`, `GAMBAR_LAYANAN`, `HARGA_LAYANAN`, `deleted_at`) VALUES
(1, 'Grooming Mandi Kutu Anjing Small', 'Mandi dan perawatan kutu untuk anjing kecil', 'layanan/grooming_kutu_small.jpg', 100000, NULL),
(2, 'Potong Kuku Anjing Small', 'Potong kuku dan perapian kuku anjing kecil', 'layanan/potong_kuku_small.jpg', 20000, NULL),
(3, 'Spa & Dry Blow Anjing Small', 'Paket spa dan pengeringan lembut untuk anjing kecil', 'layanan/spa_dryblow_small.jpg', 80000, NULL),
(11, 'Grooming Kucing Kecil', 'Layanan grooming untuk kucing ukuran kecil yang meliputi mandi menggunakan sampo khusus kucing, pengeringan, dan penyisiran ringan untuk menjaga kebersihan serta kesehatan bulu.', 'layanan/dPSF4zC0E8Cl1etJ0qkJLXiFWDUDMWIJ12tSEFvg.jpg', 50000, NULL),
(12, 'Potong Kuku Kucing Small', 'Layanan pemotongan kuku untuk kucing ukuran kecil guna mencegah kuku terlalu panjang, mengurangi risiko luka, dan menjaga kenyamanan kucing saat beraktivitas. Dilakukan secara aman dan hati-hati oleh petugas berpengalaman.', 'layanan/DlgL0mkXVlaRSzEeCYzL3fXUY9etE7DBcnrLPE3L.png', 40000, NULL),
(13, 'Pembersihan Telinga Kucing', 'Layanan pembersihan telinga kucing untuk menghilangkan kotoran dan mengurangi risiko infeksi. Menggunakan cairan pembersih khusus yang aman serta dilakukan dengan lembut agar kucing tetap tenang dan nyaman.', 'layanan/EffeigGoydFSMzbnRowwmXWIHPTA1n9W2ktIL8QF.jpg', 40000, NULL),
(14, 'Perawatan Mata Anjing', 'Layanan perawatan mata khusus anjing untuk membersihkan kotoran mata, mengurangi iritasi, dan membantu mencegah infeksi.', 'layanan/LWlGjhgggebIoRsRFgf4HjOuwQvWl26CVSYegNcL.jpg', 50000, NULL);

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
(4, '2025_11_11_133727_add_deleted_at_to_master_tables', 2),
(5, '2025_11_13_102835_add_customer_hewan_to_transaksi_penjualan_produk', 3),
(6, '2025_11_26_100658_add_status_pembayaran_to_transaksi_layanan', 4);

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
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEGAWAI` int(11) NOT NULL,
  `ID_JABATAN` int(11) NOT NULL,
  `NAMA_PEGAWAI` varchar(255) DEFAULT NULL,
  `ALAMAT_PEGAWAI` varchar(255) DEFAULT NULL,
  `TGL_LAHIR_PEGAWAI` date DEFAULT NULL,
  `NOMOR_TELEPON_PEGAWAI` varchar(17) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`ID_PEGAWAI`, `ID_JABATAN`, `NAMA_PEGAWAI`, `ALAMAT_PEGAWAI`, `TGL_LAHIR_PEGAWAI`, `NOMOR_TELEPON_PEGAWAI`, `USERNAME`, `PASSWORD`, `deleted_at`) VALUES
(1, 1, 'Rina Pratama', 'Jl. Mawar No. 12', '1998-04-12', '081234567890', 'rinakasir', '$2y$12$16wEiQE7tdazDjFmc5pjnuFSL.qgMmnbZQbeJew92deViRiwwgdcG', NULL),
(2, 2, 'Dewi Lestari', 'Jl. Melati No. 5', '1997-07-22', '081345678901', 'dewics', '$2y$12$jBHbfO50LS1KvzthRk4bDODr16I1zp9JCr6ixpuMNMtHgbGY.1Vk6', NULL),
(3, 3, 'Budi Santoso', 'Jl. Anggrek No. 8', '1990-01-10', '081456789012', 'budiadmin', '$2y$12$59rYmBP6P5VrFkZknMzsjOqcoGqw8Qox4BVAE85MbqDd2Zxs4dony', NULL),
(5, 2, 'maria', 'asdad', '2025-10-24', '082233333333', 'mariapagrib', '$2y$12$ohY/lWDxpW1RQa9YyYXk6eDeIOhrGjM/928/16R297OqN0a2FlkJS', NULL),
(9, 2, 'eeeee', 'eeeeeeeee', '2025-10-24', '4444444444', '22222', '2222222222', '2025-11-11 06:48:58'),
(10, 1, 'Juna Santoso', 'Ambarawa', '2025-12-20', '082233333123', 'JunaKasir', '$2y$12$mpduD7iWBno9by82zt7XHePm1U/hhz7bH24dsHnTcEQLdcTokiRcu', NULL),
(11, 1, 'Jono Budiman', 'Kupang NTT', '1995-11-16', '082233333123', 'JonoKasir', '$2y$12$Vm6dpozJH6I671G/5Lftoe/HPZvAAGRHda5Vx8eCpQ0Nx8u8LTf3a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ID_PRODUK` int(11) NOT NULL,
  `NAMA_PRODUK` varchar(255) DEFAULT NULL,
  `DESKRIPSI_PRODUK` varchar(255) DEFAULT NULL,
  `GAMBAR_PRODUK` varchar(255) DEFAULT NULL,
  `STOK_PRODUK` int(11) DEFAULT NULL,
  `HARGA_PRODUK` float DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ID_PRODUK`, `NAMA_PRODUK`, `DESKRIPSI_PRODUK`, `GAMBAR_PRODUK`, `STOK_PRODUK`, `HARGA_PRODUK`, `deleted_at`) VALUES
(1, 'Royal Canin Mini Adult', 'Makanan anjing dewasa ukuran kecil', 'produk/royalcanin_miniadult.png\r\n', 3, 200000, NULL),
(2, 'Snack Jerry High Carrot', 'Snack sehat untuk anjing dan kucing', 'produk/snack_jerry_carrot.jpg', 2, 20000, NULL),
(3, 'Vita Fortan', 'Vitamin hewan peliharaan untuk daya tahan tubuh', 'produk/vitafortan.jpg', 26, 50000, NULL),
(13, 'Captain Bent Cat Litter Lavender 5L', 'Pasir kucing gumpal wangi dengan aroma lavender, desain untuk menyerap bau dan kotoran serta menjaga kebersihan litter box.', 'produk/YH4N6YQvkpA9uthtSeZGnNHwz9kHJg36xIGE12vb.png', 65, 95000, NULL),
(14, 'Oxyfresh Pet Oral Hygiene Solution 16 oz', 'Solusi oral tanpa rasa dan tanpa aroma yang dirancang untuk anjing & kucing, membantu menjaga kesehatan gigi dan gusi serta mengurangi bau mulut', 'produk/NvjOrhlZ6C4qvbSBwmO3oVomUw0YaaMWJsZO1CPN.jpg', 39, 220000, NULL),
(15, 'Nature Bridge Recovery & Immune Wet Food 195 gr', 'Makanan basah untuk anjing/kucing yang diformulasikan untuk pemulihan dan mendukung sistem kekebalan tubuh', 'produk/Jb13yG9NT50t5TZYTpc5mfQND98dB2xHjIeDX5SM.jpg', 70, 35000, NULL),
(16, 'Nature Bridge Adult Dog Dry Food 1.5 kg (Small Breed)', 'Makanan kering untuk anjing dewasa ukuran kecil dari lini Nature Bridge, menggunakan daging nyata dan bahan-alami', 'produk/ZOOH2xaPjFi32hs1anDoJH3wEhYB0tszbzUNyskz.jpg', 30, 235000, NULL),
(17, 'Colorful Catnip Bouncy Ball Fun Interactive Cat Toys', 'Bola mainan untuk kucing yang dilengkapi dengan catnip, mendorong aktivitas fisik seperti mengejar dan memukul-bola.', 'produk/nsh3eUv9dyWH69EkShjyTWwInxu2Y1t8ELQ5rBt5.jpg', 120, 30000, NULL),
(18, 'Kitchen Flavor Cat 1.5Kg Kitten, Adult, Beauty Makanan Kucing Grain Free, Bulu Lebat, Omega 3 6', 'Kitchen Flavor adalah makanan kucing kering premium bebas biji-bijian yang dirancang untuk mendukung kesehatan kucing dari semua usia. Dibuat dengan daging ayam, ikan laut, dan salmon asli—makanan ini cocok untuk kucing rumahan maupun aktif.', 'produk/dlVWYTuXnfvEo9MgYqoIrDPk79ohDWtuZKDgnMy3.jpg', 25, 150000, NULL);

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
('OFxNah4ZONIFfOz3J7BXsWzydw2eBWKrG5phCkif', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaVpkRnA4Rzh1cUw5cjlHNTJFYjdjVDBtdUJTVHpFMHFSWjl4VmhkSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765995017);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan_layanan`
--

CREATE TABLE `transaksi_penjualan_layanan` (
  `ID_TRANSAKSI_LAYANAN` int(11) NOT NULL,
  `ID_PEGAWAI` int(11) NOT NULL,
  `ID_CUSTOMER` bigint(20) UNSIGNED DEFAULT NULL,
  `ID_HEWAN` bigint(20) UNSIGNED DEFAULT NULL,
  `PEG_ID_PEGAWAI` int(11) NOT NULL,
  `KODE_TRANSAKSI_PENJUALAN_LAYANAN` varchar(255) DEFAULT NULL,
  `TGL_TRANSAKSI_PENJUALAN_LAYANAN` datetime DEFAULT NULL,
  `SUB_TOTAL_PENJUALAN_LAYANAN` float DEFAULT NULL,
  `DISKON_PENJUALAN_LAYANAN` float NOT NULL,
  `TOTAL_HARGA_PENJUALAN_LAYANAN` float DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `STATUS_LAYANAN` varchar(255) DEFAULT NULL,
  `STATUS_PEMBAYARAN_LAYANAN` varchar(255) NOT NULL DEFAULT 'Belum Bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_penjualan_layanan`
--

INSERT INTO `transaksi_penjualan_layanan` (`ID_TRANSAKSI_LAYANAN`, `ID_PEGAWAI`, `ID_CUSTOMER`, `ID_HEWAN`, `PEG_ID_PEGAWAI`, `KODE_TRANSAKSI_PENJUALAN_LAYANAN`, `TGL_TRANSAKSI_PENJUALAN_LAYANAN`, `SUB_TOTAL_PENJUALAN_LAYANAN`, `DISKON_PENJUALAN_LAYANAN`, `TOTAL_HARGA_PENJUALAN_LAYANAN`, `deleted_at`, `STATUS_LAYANAN`, `STATUS_PEMBAYARAN_LAYANAN`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 4, 1, 'LY-210125-01', '2025-01-21 00:00:00', 100000, 0, 100000, NULL, 'Selesai', 'Belum Lunas', NULL, NULL),
(2, 2, 1, 1, 1, 'LY-210225-02', '2025-02-21 00:00:00', 20000, 2000, 18000, '2025-11-12 23:11:26', 'Selesai', 'Belum Lunas', NULL, NULL),
(3, 2, 2, 2, 1, 'LY-210225-03', '2025-02-22 00:00:00', 80000, 0, 80000, '2025-11-12 23:17:22', 'Selesai', 'Belum Lunas', NULL, NULL),
(4, 2, 1, 1, 1, 'LY-121125-04', '2025-11-12 23:21:47', 0, 0, 0, '2025-11-12 22:42:31', 'Selesai', 'Belum Lunas', '2025-11-12 16:21:47', '2025-11-12 16:21:47'),
(5, 2, 1, 1, 1, 'LY-121125-05', '2025-11-12 23:28:04', 0, 0, 0, '2025-11-12 22:42:28', 'Selesai', 'Belum Lunas', '2025-11-12 16:28:04', '2025-11-12 16:28:04'),
(6, 2, 6, 4, 1, 'LY-121125-06', '2025-11-12 23:29:38', 0, 0, 0, '2025-11-12 22:42:22', 'Selesai', 'Belum Lunas', '2025-11-12 16:29:38', '2025-11-12 16:29:38'),
(7, 2, 6, 4, 1, 'LY-121125-07', '2025-11-12 23:30:52', 200000, 0, 200000, '2025-11-12 23:17:27', 'Selesai', 'Belum Lunas', '2025-11-12 16:30:52', '2025-11-12 16:30:52'),
(8, 2, 6, 4, 1, 'LY-121125-08', '2025-11-12 23:32:59', 20000, 0, 20000, '2025-11-12 23:17:33', 'Selesai', 'Belum Lunas', NULL, NULL),
(9, 2, 6, 4, 1, 'LY-121125-09', '2025-11-12 23:36:01', 560000, 0, 560000, '2025-11-12 23:17:37', 'Selesai', 'Belum Lunas', NULL, NULL),
(10, 2, 6, 4, 1, 'LY-131125-10', '2025-11-13 05:42:47', 100000, 0, 100000, '2025-11-12 23:17:41', 'Selesai', 'Belum Lunas', NULL, NULL),
(11, 2, 1, 1, 1, 'LY-131125-11', '2025-11-13 06:10:26', 500000, 0, 500000, NULL, 'Selesai', 'Belum Lunas', NULL, NULL),
(12, 2, 2, 2, 1, 'LY-131125-12', '2025-11-13 06:11:00', 20000, 0, 20000, NULL, 'Selesai', 'Belum Lunas', NULL, '2025-11-12 23:56:37'),
(13, 2, 1, 1, 1, 'LY-131125-13', '2025-11-13 06:11:10', 40000, 0, 40000, NULL, 'Selesai', 'Belum Lunas', NULL, NULL),
(14, 2, 4, 5, 1, 'LY-131125-14', '2025-11-13 06:11:18', 20000, 0, 20000, NULL, 'Selesai', 'Belum Lunas', NULL, NULL),
(15, 2, 6, 4, 1, 'LY-131125-15', '2025-11-13 06:18:10', 0, 0, 0, '2025-11-12 23:18:47', 'Selesai', 'Belum Lunas', NULL, NULL),
(16, 2, 3, 3, 1, 'LY-131125-16', '2025-11-13 06:18:38', 40000, 0, 40000, NULL, 'Selesai', 'Belum Lunas', NULL, '2025-11-26 01:30:44'),
(17, 2, 4, 5, 1, 'LY-131125-17', '2025-11-13 06:18:54', 160000, 0, 160000, NULL, 'Selesai', 'Belum Lunas', NULL, '2025-11-26 01:30:52'),
(18, 2, 1, 1, 1, 'LY-131125-18', '2025-11-13 07:02:05', 300000, 0, 300000, NULL, 'Selesai', 'Belum Lunas', '2025-11-13 00:02:05', '2025-11-26 01:31:09'),
(19, 2, 3, 3, 1, 'LY-131125-19', '2025-07-09 07:03:55', 60000, 0, 60000, NULL, 'Dalam Pengerjaan', 'Belum Lunas', '2025-11-13 00:03:55', '2025-11-13 00:03:55'),
(20, 2, 1, 1, 1, 'LY-131125-20', '2025-11-13 07:05:28', 100000, 0, 100000, NULL, 'Dalam Pengerjaan', 'Belum Lunas', '2025-11-13 00:05:28', '2025-11-13 00:05:28'),
(21, 2, 1, 1, 1, 'LY-131125-21', '2025-11-13 07:05:35', 80000, 0, 80000, NULL, 'Dalam Pengerjaan', 'Belum Lunas', '2025-11-13 00:05:35', '2025-11-13 00:35:31'),
(22, 2, 6, 4, 1, 'LY-131125-22', '2025-11-13 07:36:13', 320000, 0, 320000, NULL, 'Dalam Pengerjaan', 'Belum Lunas', '2025-11-13 00:36:13', '2025-11-13 00:36:13'),
(23, 2, 3, 3, 1, 'LY-131125-23', '2025-11-13 10:34:48', 20000, 0, 20000, NULL, 'Selesai', 'Lunas', '2025-11-13 03:34:48', '2025-12-17 00:34:12'),
(24, 2, 2, 2, 1, 'LY-131125-24', '2022-09-21 10:58:40', 100000, 0, 100000, NULL, 'Dalam Pengerjaan', 'Lunas', '2025-11-13 03:58:40', '2025-11-26 07:19:05'),
(25, 2, 4, 5, 1, 'LY-131125-25', '2025-11-13 11:06:00', 80000, 20000, 60000, NULL, 'Selesai', 'Lunas', '2025-11-13 04:06:00', '2025-11-26 07:15:20'),
(26, 2, 6, 4, 1, 'LY-251125-26', '2025-11-25 22:23:49', 20000, 0, 20000, '2025-08-15 01:29:40', NULL, 'Belum Lunas', '2025-11-25 15:23:49', '2025-11-26 01:29:40'),
(27, 2, 3, 3, 1, 'LY-261125-27', '2025-09-18 08:24:19', 50000, 0, 50000, '2025-11-26 01:29:37', NULL, 'Belum Lunas', '2025-11-26 01:24:19', '2025-11-26 01:29:37'),
(28, 2, 3, 3, 1, 'LY-261125-26', '2025-11-26 08:30:00', 90000, 10000, 80000, NULL, 'Dalam Pengerjaan', 'Lunas', '2025-11-26 01:30:00', '2025-11-26 05:19:52'),
(29, 2, 3, 3, 1, 'LY-261125-29', '2025-11-26 14:21:03', 90000, 0, 90000, NULL, 'Belum Dikerjakan', 'Lunas', '2025-11-26 07:21:03', '2025-11-26 07:21:33'),
(30, 2, 1, 1, 1, 'LY-261125-30', '2025-11-26 19:38:13', 1200000, 0, 1200000, NULL, 'Selesai', 'Lunas', '2025-11-26 12:38:13', '2025-11-26 12:48:52'),
(31, 2, 4, 5, 1, 'LY-261125-31', '2024-11-26 19:49:49', 800000, 0, 800000, NULL, 'Selesai', 'Lunas', '2025-11-26 12:49:49', '2025-11-26 12:50:14'),
(32, 2, 3, 3, 1, 'LY-261125-32', '2022-09-15 22:07:21', 150000, 0, 150000, NULL, 'Belum Dikerjakan', 'Lunas', '2025-11-26 15:07:21', '2025-11-26 15:09:35'),
(33, 2, 2, 6, 1, 'LY-261125-33', '2022-09-16 22:10:11', 200000, 0, 200000, NULL, 'Belum Dikerjakan', 'Lunas', '2025-11-26 15:10:11', '2025-11-26 15:11:46'),
(34, 2, 4, 5, 1, 'LY-271125-34', '2025-10-29 04:19:26', 400000, 0, 400000, NULL, 'Belum Dikerjakan', 'Lunas', '2025-11-26 21:19:26', '2025-11-26 21:20:37'),
(35, 2, 4, 5, 1, 'LY-271125-35', '2025-11-27 08:16:21', 600000, 0, 600000, NULL, 'Selesai', 'Lunas', '2025-11-27 01:16:21', '2025-11-27 01:16:48'),
(36, 2, 2, 2, 1, 'LY-271125-36', '2025-11-27 10:49:45', 3600000, 0, 3600000, NULL, 'Dalam Pengerjaan', 'Lunas', '2025-11-27 03:49:45', '2025-12-04 01:34:13'),
(37, 2, 1, 1, 1, 'LY-041225-37', '2025-12-04 11:53:22', 100000, 0, 100000, NULL, 'Dalam Pengerjaan', 'Belum Bayar', '2025-12-04 04:53:22', '2025-12-17 00:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan_produk`
--

CREATE TABLE `transaksi_penjualan_produk` (
  `ID_TRANSAKSI_PENJUALAN_PRODUK` int(11) NOT NULL,
  `ID_PEGAWAI` int(11) NOT NULL,
  `ID_CUSTOMER` bigint(20) UNSIGNED DEFAULT NULL,
  `PEG_ID_PEGAWAI` int(11) NOT NULL,
  `KODE_TRANSAKSI_PENJUALAN_PRODUK` varchar(30) DEFAULT NULL,
  `TGL_TRANSAKSI_PENJUALAN_PRODUK` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `SUB_TOTAL_PENJUALAN_PRODUK` float DEFAULT NULL,
  `DISKON_PENJUALAN_PRODUK` float DEFAULT NULL,
  `TOTAL_HARGA_PENJUALAN_PRODUK` float DEFAULT NULL,
  `STATUS_PEMBAYARAN_PRODUK` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_penjualan_produk`
--

INSERT INTO `transaksi_penjualan_produk` (`ID_TRANSAKSI_PENJUALAN_PRODUK`, `ID_PEGAWAI`, `ID_CUSTOMER`, `PEG_ID_PEGAWAI`, `KODE_TRANSAKSI_PENJUALAN_PRODUK`, `TGL_TRANSAKSI_PENJUALAN_PRODUK`, `created_at`, `updated_at`, `SUB_TOTAL_PENJUALAN_PRODUK`, `DISKON_PENJUALAN_PRODUK`, `TOTAL_HARGA_PENJUALAN_PRODUK`, `STATUS_PEMBAYARAN_PRODUK`, `deleted_at`) VALUES
(1, 2, 1, 1, 'PR-210125-01', '2025-01-21 00:00:00', '2025-11-12 15:36:26', '2025-11-12 15:40:21', 150000, 0, 150000, 'Belum Lunas', NULL),
(2, 2, 2, 1, 'PR-210225-02', '2025-02-21 00:00:00', '2025-11-12 15:36:26', NULL, 40000, 10000, 30000, 'Belum Lunas', NULL),
(3, 2, 2, 1, 'PR-210225-03', '2025-02-22 00:00:00', '2025-11-12 15:36:26', '2025-11-12 23:09:15', 100000, 0, 100000, 'Belum Lunas', NULL),
(4, 2, 2, 1, 'PR-111125165610', '2025-11-11 16:56:10', '2025-11-12 15:36:26', NULL, 600000, 0, 600000, 'Belum Lunas', '2025-11-12 03:12:47'),
(5, 2, 2, 1, 'PR-111125170519', '2025-11-11 17:05:19', '2025-11-12 15:36:26', NULL, 600000, 0, 600000, 'Belum Lunas', '2025-11-12 03:13:44'),
(6, 2, 2, 1, 'PR-111125170533', '2025-11-11 17:05:33', '2025-11-12 15:36:26', NULL, 240000, 0, 240000, 'Belum Lunas', '2025-11-12 03:13:41'),
(7, 2, 2, 1, 'PR-111125221207', '2025-11-11 22:12:07', '2025-11-12 15:36:26', NULL, 285000, 0, 285000, 'Belum Lunas', '2025-11-12 03:13:39'),
(8, 2, 2, 1, 'PR-111125222047', '2025-11-11 22:20:47', '2025-11-12 15:36:26', NULL, 60000, 0, 60000, 'Belum Lunas', '2025-11-12 03:13:35'),
(9, 2, 2, 1, 'PR-111125223858', '2025-11-11 22:38:58', '2025-11-12 15:36:26', NULL, 760000, 0, 760000, 'Belum Lunas', '2025-11-12 03:13:17'),
(10, 2, 2, 1, 'PR-111125234057', '2025-11-11 23:40:57', '2025-11-12 15:36:26', NULL, 460000, 0, 460000, 'Belum Lunas', '2025-11-12 03:13:14'),
(11, 2, 2, 1, 'PR-111125234117', '2025-11-11 23:41:17', '2025-11-12 15:36:26', NULL, 240000, 0, 240000, 'Belum Lunas', '2025-11-12 03:12:57'),
(12, 2, 2, 1, 'PR-121125-12', '2025-11-12 09:31:23', '2025-11-12 15:36:26', '2025-11-12 15:46:19', 150000, 0, 150000, 'Belum Lunas', '2025-11-12 15:46:19'),
(13, 2, 2, 1, 'PR-121125-13', '2025-11-12 21:53:10', '2025-11-12 15:36:26', '2025-11-12 15:46:13', 70000, 0, 70000, 'Belum Lunas', '2025-11-12 15:46:13'),
(14, 2, 2, 1, 'PR-121125-14', '2025-11-12 21:59:50', '2025-11-12 15:36:26', '2025-11-12 15:43:55', 350000, 0, 350000, 'Belum Lunas', '2025-11-12 15:43:55'),
(15, 2, 2, 1, 'PR-121125-04', '2025-11-12 22:46:30', '2025-11-12 15:46:30', '2025-11-12 15:47:07', 100000, 0, 100000, 'Belum Lunas', '2025-11-12 15:47:07'),
(16, 2, 2, 1, 'PR-121125-04', '2025-11-12 22:47:20', '2025-11-12 15:47:20', '2025-11-12 15:47:20', 440000, 0, 440000, 'Belum Lunas', NULL),
(17, 2, 2, 1, 'PR-121125-17', '2025-11-12 22:47:49', '2025-11-12 15:47:49', '2025-11-12 15:47:49', 50000, 0, 50000, 'Belum Lunas', NULL),
(18, 2, 2, 1, 'PR-131125-18', '2025-11-13 05:47:43', '2025-11-12 22:47:43', '2025-11-12 22:47:43', 440000, 0, 440000, 'Belum Lunas', NULL),
(19, 2, 2, 1, 'PR-131125-19', '2025-11-13 06:09:02', '2025-11-12 23:09:02', '2025-11-26 02:56:06', 220000, 0, 220000, 'Belum Lunas', NULL),
(20, 2, 2, 1, 'PR-131125-20', '2025-11-13 06:31:33', '2025-11-12 23:31:33', '2025-11-12 23:31:33', 250000, 0, 250000, 'Belum Lunas', NULL),
(21, 2, 2, 1, 'PR-131125-21', '2025-11-13 06:36:26', '2025-11-12 23:36:26', '2025-12-17 18:55:56', 500000, 0, 500000, 'Lunas', NULL),
(22, 2, 2, 1, 'PR-131125-22', '2025-11-13 06:37:14', '2025-11-12 23:37:14', '2025-12-17 05:16:36', 600000, 0, 600000, 'Lunas', NULL),
(23, 2, 2, 1, 'PR-131125-23', '2025-11-13 06:37:29', '2025-11-12 23:37:29', '2025-12-17 01:21:26', 640000, 0, 640000, 'Lunas', NULL),
(24, 2, 4, 1, 'PR-131125-24', '2025-11-13 12:36:33', '2025-11-13 05:36:33', '2025-12-17 00:32:48', 20000, 10000, 10000, 'Lunas', NULL),
(25, 2, 1, 1, 'PR-251125-25', '2025-11-25 20:10:20', '2025-11-25 13:10:20', '2025-12-17 00:16:06', 420000, 0, 420000, 'Lunas', NULL),
(26, 2, 15, 1, 'PR-251125-26', '2025-11-25 20:36:00', '2025-11-25 13:36:00', '2025-11-26 07:38:57', 200000, 0, 200000, 'Lunas', NULL),
(27, 2, 3, 1, 'PR-261125-27', '2025-11-26 10:25:58', '2025-11-26 03:25:58', '2025-11-26 07:16:35', 1100000, 100000, 1000000, 'Lunas', NULL);

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID_CUSTOMER`),
  ADD KEY `ID_PEGAWAI` (`ID_PEGAWAI`);

--
-- Indexes for table `detail_transaksi_penjualan_lay`
--
ALTER TABLE `detail_transaksi_penjualan_lay`
  ADD PRIMARY KEY (`ID_LAYANAN`,`ID_TRANSAKSI_LAYANAN`),
  ADD KEY `ID_TRANSAKSI_LAYANAN` (`ID_TRANSAKSI_LAYANAN`);

--
-- Indexes for table `detail_transaksi_penjualan_pro`
--
ALTER TABLE `detail_transaksi_penjualan_pro`
  ADD PRIMARY KEY (`ID_PRODUK`,`ID_TRANSAKSI_PENJUALAN_PRODUK`),
  ADD KEY `ID_TRANSAKSI_PENJUALAN_PRODUK` (`ID_TRANSAKSI_PENJUALAN_PRODUK`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`ID_HEWAN`),
  ADD KEY `ID_CUSTOMER` (`ID_CUSTOMER`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`ID_JABATAN`);

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
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`ID_LAYANAN`);

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
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_PEGAWAI`),
  ADD KEY `ID_JABATAN` (`ID_JABATAN`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ID_PRODUK`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi_penjualan_layanan`
--
ALTER TABLE `transaksi_penjualan_layanan`
  ADD PRIMARY KEY (`ID_TRANSAKSI_LAYANAN`),
  ADD KEY `ID_PEGAWAI` (`ID_PEGAWAI`),
  ADD KEY `PEG_ID_PEGAWAI` (`PEG_ID_PEGAWAI`);

--
-- Indexes for table `transaksi_penjualan_produk`
--
ALTER TABLE `transaksi_penjualan_produk`
  ADD PRIMARY KEY (`ID_TRANSAKSI_PENJUALAN_PRODUK`),
  ADD KEY `ID_PEGAWAI` (`ID_PEGAWAI`),
  ADD KEY `PEG_ID_PEGAWAI` (`PEG_ID_PEGAWAI`);

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
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID_CUSTOMER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `detail_transaksi_penjualan_lay`
--
ALTER TABLE `detail_transaksi_penjualan_lay`
  MODIFY `ID_LAYANAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hewan`
--
ALTER TABLE `hewan`
  MODIFY `ID_HEWAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `ID_JABATAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `ID_LAYANAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `ID_PEGAWAI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ID_PRODUK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaksi_penjualan_layanan`
--
ALTER TABLE `transaksi_penjualan_layanan`
  MODIFY `ID_TRANSAKSI_LAYANAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `transaksi_penjualan_produk`
--
ALTER TABLE `transaksi_penjualan_produk`
  MODIFY `ID_TRANSAKSI_PENJUALAN_PRODUK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`);

--
-- Constraints for table `detail_transaksi_penjualan_lay`
--
ALTER TABLE `detail_transaksi_penjualan_lay`
  ADD CONSTRAINT `detail_transaksi_penjualan_lay_ibfk_1` FOREIGN KEY (`ID_LAYANAN`) REFERENCES `layanan` (`ID_LAYANAN`),
  ADD CONSTRAINT `detail_transaksi_penjualan_lay_ibfk_2` FOREIGN KEY (`ID_TRANSAKSI_LAYANAN`) REFERENCES `transaksi_penjualan_layanan` (`ID_TRANSAKSI_LAYANAN`);

--
-- Constraints for table `detail_transaksi_penjualan_pro`
--
ALTER TABLE `detail_transaksi_penjualan_pro`
  ADD CONSTRAINT `detail_transaksi_penjualan_pro_ibfk_1` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`),
  ADD CONSTRAINT `detail_transaksi_penjualan_pro_ibfk_2` FOREIGN KEY (`ID_TRANSAKSI_PENJUALAN_PRODUK`) REFERENCES `transaksi_penjualan_produk` (`ID_TRANSAKSI_PENJUALAN_PRODUK`);

--
-- Constraints for table `hewan`
--
ALTER TABLE `hewan`
  ADD CONSTRAINT `hewan_ibfk_1` FOREIGN KEY (`ID_CUSTOMER`) REFERENCES `customer` (`ID_CUSTOMER`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`ID_JABATAN`) REFERENCES `jabatan` (`ID_JABATAN`);

--
-- Constraints for table `transaksi_penjualan_layanan`
--
ALTER TABLE `transaksi_penjualan_layanan`
  ADD CONSTRAINT `transaksi_penjualan_layanan_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`),
  ADD CONSTRAINT `transaksi_penjualan_layanan_ibfk_2` FOREIGN KEY (`PEG_ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`);

--
-- Constraints for table `transaksi_penjualan_produk`
--
ALTER TABLE `transaksi_penjualan_produk`
  ADD CONSTRAINT `transaksi_penjualan_produk_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`),
  ADD CONSTRAINT `transaksi_penjualan_produk_ibfk_2` FOREIGN KEY (`PEG_ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
