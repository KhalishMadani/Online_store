-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 10:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `user_id`, `username`, `nama`, `alamat`, `kota`, `kode_pos`) VALUES
(14, 17, 'muk', 'Malek', 'Pemurus ', 'Banjarmasin', '098732'),
(21, 23, 'kipa', 'Anwar Nash', 'Kertak Jaya', 'Banjarmasin', '99282'),
(22, 24, 'yusri', 'yusri ikhwani', 'adyaksa', 'Banjarmasin', '99902');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `kode_beli` int(20) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `kepuasan` varchar(255) NOT NULL,
  `komentar` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`kode_beli`, `customer`, `kepuasan`, `komentar`, `tanggal`) VALUES
(0, 'kipa', 'Netral', '', '2023-08-13 20:53:31'),
(0, 'kipa', 'Kurang Baik', 'buruk', '2023-08-13 20:53:31'),
(0, 'kipa', 'Netral', 'senang', '2023-08-13 20:53:31'),
(0, 'kipa', 'Sangat Baik', '', '2023-08-13 20:53:31'),
(0, 'kipa', 'Kurang Baik', '', '2023-08-13 20:53:31'),
(0, 'kipa', 'Netral', '', '2023-08-13 20:53:31'),
(920067, 'kipa', 'Kurang Baik', 's', '2023-08-13 20:53:31'),
(920067, 'kipa', 'Netral', 'rrrr', '2023-08-13 20:53:31'),
(808892, 'kipa', 'Kurang Baik', 'mohon untuk lebih teliti saat melakukan packing', '2023-08-13 20:53:31'),
(206839, 'muk', 'Netral', 'Saya senang dengan pelayanan yang diberikan oleh pihak penjual dan kurir', '2023-08-13 20:57:56'),
(690163, 'muk', 'Sangat Baik', 'Respon dari Penjual Begitu Cepat dan Pengiriman Kurir Tidak Memakan Waktu yang Lama', '2023-08-13 20:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Pria'),
(19, 'Wanita'),
(26, 'Aksesories');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `nama_brg` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `code_byr` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `dibikin_pada` date NOT NULL,
  `status_pesanan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `nama_brg`, `qty`, `harga`, `nama_customer`, `alamat`, `kota`, `kode_pos`, `code_byr`, `created_at`, `dibikin_pada`, `status_pesanan`) VALUES
(89, 'Kemeja Kotak-Kotak', 4, 340000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 586022, '2023-07-06 19:08:32', '2023-06-02', 'complete'),
(90, 'Kerudung Corak', 2, 180000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 889755, '2023-07-06 19:10:25', '2023-06-05', 'complete'),
(93, 'Kemeja Kotak-Kotak', 2, 170000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 146198, '2023-07-06 19:37:18', '2023-06-06', 'complete'),
(94, 'Gelang', 4, 48000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 915665, '2023-07-11 00:36:57', '2023-07-03', 'complete'),
(95, 'Jam Tangan', 4, 240000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 758487, '2023-07-25 07:09:34', '2023-07-10', 'sedang di proses'),
(96, 'Jam Saku', 1, 90000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 944307, '2023-07-26 07:02:21', '2023-07-11', 'pending'),
(97, 'Kaftan', 2, 132000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 425309, '2023-07-26 07:02:41', '2023-07-10', 'pending'),
(98, 'Gamis Wanita', 1, 75000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 556265, '2023-07-26 07:02:51', '2023-07-10', 'pending'),
(99, 'Jam Tangan', 1, 190000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 104506, '2023-07-26 07:02:59', '2023-07-12', 'pending'),
(100, 'Songkok Topi', 2, 80000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 805188, '2023-07-26 07:03:15', '2023-07-11', 'pending'),
(101, 'Jogger Pants', 1, 75000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 663309, '2023-07-26 07:03:24', '2023-07-03', 'pending'),
(102, 'Gamis Wanita', 1, 75000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 260558, '2023-08-05 10:29:03', '0000-00-00', 'pending'),
(103, 'Jogger Pants', 3, 225000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 458063, '2023-08-05 11:35:25', '0000-00-00', 'pending'),
(104, 'Cardigan', 3, 210000.00, '', 'Jl. Sutoyo', 'Banjarbaru', '99083', 147478, '2023-08-06 11:38:07', '0000-00-00', 'pending'),
(107, 'Gamis Wanita', 1, 75000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 479640, '2023-08-13 03:45:55', '2023-08-10', 'complete'),
(108, 'Cardigan', 2, 140000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 352419, '2023-08-13 03:54:57', '2023-08-03', 'complete'),
(109, 'Cardigan', 1, 70000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 349622, '2023-08-13 06:13:13', '2023-08-04', 'complete'),
(110, 'Gamis Wanita', 1, 75000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 426161, '2023-08-13 14:07:46', '2023-08-11', 'complete'),
(111, 'Mukena', 1, 40000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 211259, '2023-08-13 14:08:40', '2023-08-11', 'complete'),
(112, 'Tunik', 2, 110000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 369258, '2023-08-13 14:11:16', '2023-08-09', 'complete'),
(113, 'Cardigan', 1, 70000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 936923, '2023-08-13 14:12:46', '2023-08-09', 'complete'),
(114, 'Hijab', 1, 70000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 129294, '2023-08-13 14:25:34', '2023-08-01', 'complete'),
(115, 'Jam Tangan', 1, 190000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 963392, '2023-08-13 14:33:32', '2023-08-08', 'complete'),
(116, 'Peci', 2, 50000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 920067, '2023-08-13 17:24:10', '2023-08-08', 'complete'),
(117, 'Hijab', 1, 70000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 821363, '2023-08-13 18:35:08', '2023-08-08', 'rejected'),
(118, 'Peci', 1, 25000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 808892, '2023-08-13 18:49:51', '2023-08-07', 'complete'),
(119, 'Gamis Wanita', 1, 75000.00, 'kipa', 'Kertak Jaya', 'Banjarmasin', '99282', 739080, '2023-08-13 19:13:29', '2023-08-07', 'delivered'),
(120, 'Songkok Topi', 1, 40000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 206839, '2023-08-13 20:57:04', '2023-08-03', 'complete'),
(121, 'Kemeja Koko Lengan Panjang', 2, 280000.00, 'muk', 'Jl. Sutoyo', 'Banjarbaru', '99083', 690163, '2023-08-13 20:58:37', '2023-08-03', 'complete'),
(122, 'Cardigan Rajut', 1, 70000.00, 'muk', 'Pemurus ', 'Banjarmasin', '098732', 666974, '2023-08-14 22:46:31', '2023-08-01', 'pending'),
(123, 'Hijab', 1, 70000.00, 'muk', 'Pemurus ', 'Banjarmasin', '098732', 942236, '2023-08-14 22:48:37', '2023-08-01', 'pending'),
(124, 'Jam Saku', 2, 180000.00, 'yusri', 'adyaksa', 'Banjarmasin', '99902', 840257, '2023-08-15 01:48:59', '0000-00-00', 'diserahkan kepada kurir'),
(125, 'Mukena', 3, 120000.00, 'yusri', 'adyaksa', 'Banjarmasin', '99902', 229235, '2023-08-15 01:49:45', '0000-00-00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `kode_pesanan` int(11) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `harga` double NOT NULL,
  `bayar` double NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qty` int(11) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `kembalian` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `kode_pesanan`, `customer`, `barang`, `harga`, `bayar`, `dibuat`, `qty`, `tipe`, `kembalian`) VALUES
(18, 586022, 'muk', 'Kemeja Kotak-Kotak', 340000, 500000, '2023-07-25 12:52:43', 4, 'Cash On Delivery', 0),
(23, 146198, 'muk', 'Kemeja Kotak-Kotak', 170000, 200000, '2023-07-25 16:12:38', 2, 'Cash On Delivery', 0),
(24, 758487, 'muk', 'Jam Tangan', 240000, 240000, '2023-07-25 16:40:42', 4, 'Transfer', 0),
(25, 889755, 'muk', 'Kerudung Corak', 180000, 180000, '2023-07-25 16:40:49', 2, 'Transfer', 0),
(26, 915665, 'muk', 'Gelang', 48000, 50000, '2023-07-26 06:39:21', 4, 'Cash On Delivery', 2000),
(28, 479640, 'muk', 'Gamis Wanita', 75000, 75000, '2023-08-13 03:51:26', 1, 'Transfer', 0),
(29, 352419, 'kipa', 'Cardigan', 140000, 200000, '2023-08-13 03:55:27', 2, 'Cash On Delivery', 60000),
(30, 349622, 'muk', 'Cardigan', 70000, 100000, '2023-08-13 06:14:00', 1, 'Cash On Delivery', 30000),
(31, 840257, 'yusri', 'Jam Saku', 180000, 180000, '2023-08-15 01:51:15', 2, 'Transfer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_prdk`
--

CREATE TABLE `pembelian_prdk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_beli` int(11) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `current_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_prdk`
--

INSERT INTO `pembelian_prdk` (`id`, `nama`, `kode_beli`, `harga`, `foto`, `detail`, `jumlah`, `current_time`) VALUES
(4, 'Cardigan', 320248, 70000, 'AguiU2oo15CHl.jpg', 'Cardigan Rajut wanita\r\nbahan tebal tidak panas\r\nada kantongnya\r\n\r\nUkuran L size', 12, '2023-07-25 17:15:14'),
(5, 'Sepatu', 899230, 80000, '2WGUC7Zv7dC7S.jpg', 'Sepatu Sneaker cocok untuk jogging dan pemakaian casual\r\nukuran 41', 4, '2023-07-25 17:20:13'),
(6, 'Tunik', 902093, 55000, 'ffNoccv5FUlgS.png', 'bahan lembut tidak panas\r\nfull kancing depan\r\npanjang baju 107 cm', 12, '2023-07-26 04:09:20'),
(7, 'Gamis Wanita', 451305, 75000, '0UtnJHDCRRQM8.png', 'gamis wanita dengan lengan baju karet cocok untuk pemakaian ke acara formal atau pengajian', 12, '2023-07-26 04:10:32'),
(8, 'Mukena', 678170, 40000, 'K9JMNwa0o5IRi.png', 'Mukena maroon\r\nadem kain tebal namun tidak panas', 12, '2023-07-26 04:11:25'),
(9, 'Kaftan', 825396, 66000, 'Yx5ROFkvSjwvO.png', 'BAHAN MOSCREPE\r\n-SIZE M- L- XL  BESAR , MUAT UNTUK BB 50 - 80 KG\r\n-XL-ld 140 panjang 135\r\n- L- LD 130 -PANJANG 133\r\n- M - LD 120 - PANJANG 130\r\n-MODEL KELELAWAR\r\n-belakang di karet \r\n- depan di kerut ditabah renda bunga kecil', 14, '2023-07-26 04:17:23'),
(10, 'Hijab', 560669, 70000, 'YaYP69VUMHNiv.jpg', 'Bahan voal premium \r\nHarga konveksi \r\nMotif sublime \r\nUkuran 110 x 110 cm \r\nTdk renyah dan mudah di bentuk ', 10, '2023-07-26 04:19:12'),
(11, 'Jam Saku', 307982, 90000, 'si06UEY2v2qOR.jpg', 'pocket watch/jam saku\r\njam arloji antik dan astetik', 8, '2023-07-26 06:34:10'),
(12, 'Jam Tangan', 111532, 190000, 'T3QjaqaGsELzL.jpg', 'Jam Tangan Analog Merk Casio', 4, '2023-07-26 06:34:59'),
(13, 'Peci', 434064, 25000, 'FKAFcOK23h1u3.jpeg', 'Peci Hitam\r\nbisa untuk pemakaian sehari-hari maupun kegiatan beribadah', 20, '2023-07-26 06:44:37'),
(14, 'Songkok Topi', 679533, 40000, '0Bs9RYpxjIW1V.jpeg', 'Modern topi kopiah', 12, '2023-07-26 06:45:06'),
(15, 'Kemeja Koko', 752596, 80000, '53TOOCrngqETO.jpg', 'Kemeja Koko Lengan Pendek\r\nDapat digunakan untuk penampilan kasual maupun formal', 8, '2023-07-26 06:45:53'),
(16, 'Sarung', 886950, 44000, 'XXPdfLZ5WU4ut.jpg', 'Sarung dengan kualitas kain pilihan', 20, '2023-07-26 06:46:27'),
(17, 'Gelang', 911839, 90000, 'BEo5kApYeqmgm.jpg', 'gelang emas bayi lucu', 6, '2023-07-26 06:47:44'),
(18, 'Kemeja Koko Lengan Panjang', 949070, 140000, '8B4vgEaFlQt9L.jpg', 'Kemeja koko dengan lengan panjang terbaru dan trendy', 8, '2023-07-26 06:51:26'),
(19, 'Jogger Pants', 368951, 75000, 'xwph6cCNpKbSN.jpg', 'Celana jogger Pria cocok untuk aktivitas olahraga dan lainnya', 12, '2023-07-26 06:52:11'),
(20, 'sapu', 110596, 20000, 'Cs4DqIZkVZHV9.', '', 2, '2023-08-07 03:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `ketersediaan_stok` enum('habis','tersedia') NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`, `stock`) VALUES
(18, 19, 'Cardigan Rajut', 70000, 'yCS9UP4ZOEdel.jpg', 'Cardigan rajut\r\nkain lembut dan tidak panas', 'tersedia', 1),
(21, 19, 'Gamis Wanita Casual', 50000, 'ZwtycA4ZsWf3x.png', 'Baju gamis wanita', 'tersedia', 7),
(22, 19, 'Mukena', 40000, 'K9JMNwa0o5IRi.png', 'Mukena maroon\r\nadem kain tebal namun tidak panas', 'tersedia', 8),
(23, 19, 'Kaftan', 66000, 'Yx5ROFkvSjwvO.png', 'BAHAN MOSCREPE\r\n-SIZE M- L- XL  BESAR , MUAT UNTUK BB 50 - 80 KG\r\n-XL-ld 140 panjang 135\r\n- L- LD 130 -PANJANG 133\r\n- M - LD 120 - PANJANG 130\r\n-MODEL KELELAWAR\r\n-belakang di karet \r\n- depan di kerut ditabah renda bunga kecil', 'tersedia', 10),
(24, 19, 'Hijab', 70000, 'YaYP69VUMHNiv.jpg', 'Bahan voal premium \r\nHarga konveksi \r\nMotif sublime \r\nUkuran 110 x 110 cm \r\nTdk renyah dan mudah di bentuk ', 'tersedia', 7),
(25, 26, 'Jam Saku', 90000, 'si06UEY2v2qOR.jpg', 'pocket watch/jam saku\r\njam arloji antik dan astetik', 'tersedia', 5),
(26, 26, 'Jam Tangan', 190000, 'T3QjaqaGsELzL.jpg', 'Jam Tangan Analog Merk Casio', 'tersedia', 2),
(27, 1, 'Peci', 25000, 'FKAFcOK23h1u3.jpeg', 'Peci Hitam\r\nbisa untuk pemakaian sehari-hari maupun kegiatan beribadah', 'tersedia', 17),
(28, 1, 'Songkok Topi', 40000, '0Bs9RYpxjIW1V.jpeg', 'Modern topi kopiah', 'tersedia', 9),
(29, 1, 'Kemeja Koko', 80000, '53TOOCrngqETO.jpg', 'Kemeja Koko Lengan Pendek\r\nDapat digunakan untuk penampilan kasual maupun formal', 'tersedia', 8),
(30, 26, 'Sarung', 35000, 'TGbNpBClhXLK1.', '', 'tersedia', 20),
(31, 26, 'Gelang', 90000, 'BEo5kApYeqmgm.jpg', 'gelang emas bayi lucu', 'tersedia', 6),
(32, 1, 'Kemeja Koko Lengan Panjang', 140000, '8B4vgEaFlQt9L.jpg', 'Kemeja koko dengan lengan panjang terbaru dan trendy', 'tersedia', 6),
(33, 1, 'Jogger Pants', 75000, 'xwph6cCNpKbSN.jpg', 'Celana jogger Pria cocok untuk aktivitas olahraga dan lainnya', 'tersedia', 8);

-- --------------------------------------------------------

--
-- Table structure for table `s_delivered`
--

CREATE TABLE `s_delivered` (
  `id` int(11) NOT NULL,
  `kode_pesanan` int(11) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `delivered` varchar(255) DEFAULT NULL,
  `delivered_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_delivered`
--

INSERT INTO `s_delivered` (`id`, `kode_pesanan`, `customer`, `delivered`, `delivered_timestamp`) VALUES
(6, 586022, 'muk', 'sampai tujuan(delivered)', '2023-07-06 19:24:11'),
(7, 889755, 'muk', 'sampai tujuan(delivered)', '2023-08-06 03:02:55'),
(8, 146198, 'muk', 'sampai tujuan(delivered)', '2023-08-06 03:03:05'),
(9, 915665, 'muk', 'sampai tujuan(delivered)', '2023-08-08 10:00:05'),
(10, 574862, 'wish', 'sampai tujuan(delivered)', '2023-08-13 03:41:57'),
(11, 479640, 'muk', 'sampai tujuan(delivered)', '2023-08-13 03:46:54'),
(12, 349622, 'muk', 'sampai tujuan(delivered)', '2023-08-13 06:15:31'),
(13, 352419, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 14:02:59'),
(14, 426161, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 14:07:57'),
(15, 211259, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 14:08:58'),
(16, 369258, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 14:11:32'),
(17, 936923, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 14:12:59'),
(18, 129294, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 14:25:50'),
(19, 963392, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 14:33:45'),
(20, 920067, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 17:24:31'),
(21, 808892, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 18:50:08'),
(22, 808892, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 19:04:33'),
(23, 821363, 'kipa', 'Pesanan Ditolak', '2023-08-13 19:11:49'),
(24, 739080, 'kipa', 'sampai tujuan(delivered)', '2023-08-13 19:13:51'),
(25, 206839, 'muk', 'sampai tujuan(delivered)', '2023-08-13 20:57:19'),
(26, 690163, 'muk', 'sampai tujuan(delivered)', '2023-08-13 20:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `s_diperjalanan`
--

CREATE TABLE `s_diperjalanan` (
  `id` int(11) NOT NULL,
  `kode_pesanan` int(11) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `diperjalanan` varchar(255) DEFAULT NULL,
  `diperjalanan_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_diperjalanan`
--

INSERT INTO `s_diperjalanan` (`id`, `kode_pesanan`, `customer`, `diperjalanan`, `diperjalanan_timestamp`) VALUES
(11, 586022, 'muk', 'sedang di perjalanan', '2023-07-06 19:23:53'),
(12, 889755, 'muk', 'sedang di perjalanan', '2023-08-06 03:02:54'),
(13, 146198, 'muk', 'sedang di perjalanan', '2023-08-06 03:03:03'),
(14, 915665, 'muk', 'sedang di perjalanan', '2023-08-08 10:00:04'),
(15, 574862, 'wish', 'sedang di perjalanan', '2023-08-13 03:41:55'),
(16, 479640, 'muk', 'sedang di perjalanan', '2023-08-13 03:46:52'),
(17, 349622, 'muk', 'sedang di perjalanan', '2023-08-13 06:15:29'),
(18, 936923, 'kipa', 'sedang di perjalanan', '2023-08-13 14:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `s_kemas`
--

CREATE TABLE `s_kemas` (
  `id` int(11) NOT NULL,
  `kode_pesanan` int(11) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `kemas` varchar(255) DEFAULT NULL,
  `kemas_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_kemas`
--

INSERT INTO `s_kemas` (`id`, `kode_pesanan`, `customer`, `kemas`, `kemas_timestamp`) VALUES
(11, 586022, 'muk', 'telah dikemas', '2023-07-06 19:11:18'),
(12, 889755, 'muk', 'telah dikemas', '2023-07-06 19:35:35'),
(13, 915665, 'muk', 'telah dikemas', '2023-07-11 00:44:40'),
(14, 146198, 'muk', 'telah dikemas', '2023-08-06 03:02:39'),
(15, 758487, 'muk', 'telah dikemas', '2023-08-07 06:24:07'),
(16, 574862, 'wish', 'telah dikemas', '2023-08-13 03:40:25'),
(17, 479640, 'muk', 'telah dikemas', '2023-08-13 03:46:13'),
(18, 349622, 'muk', 'telah dikemas', '2023-08-13 06:14:57'),
(19, 840257, 'yusri', 'telah dikemas', '2023-08-15 01:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `s_kurir`
--

CREATE TABLE `s_kurir` (
  `id` int(11) NOT NULL,
  `kode_pesanan` int(11) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `kurir` varchar(255) DEFAULT NULL,
  `kurir_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_kurir`
--

INSERT INTO `s_kurir` (`id`, `kode_pesanan`, `customer`, `kurir`, `kurir_timestamp`) VALUES
(11, 586022, 'muk', 'diserahkan kepada kurir', '2023-07-06 19:11:21'),
(12, 889755, 'muk', 'diserahkan kepada kurir', '2023-07-06 20:02:54'),
(13, 146198, 'muk', 'diserahkan kepada kurir', '2023-08-06 03:02:41'),
(14, 915665, 'muk', 'diserahkan kepada kurir', '2023-08-07 06:21:45'),
(15, 574862, 'wish', 'diserahkan kepada kurir', '2023-08-13 03:40:27'),
(16, 479640, 'muk', 'diserahkan kepada kurir', '2023-08-13 03:46:14'),
(17, 349622, 'muk', 'diserahkan kepada kurir', '2023-08-13 06:15:00'),
(18, 352419, 'kipa', 'diserahkan kepada kurir', '2023-08-13 14:02:38'),
(19, 840257, 'yusri', 'diserahkan kepada kurir', '2023-08-15 01:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `s_proses`
--

CREATE TABLE `s_proses` (
  `id` int(11) NOT NULL,
  `kode_pesanan` int(11) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `process_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_proses`
--

INSERT INTO `s_proses` (`id`, `kode_pesanan`, `customer`, `process`, `process_timestamp`) VALUES
(22, 586022, 'muk', 'sedang di proses', '2023-07-06 19:11:14'),
(23, 889755, 'muk', 'sedang di proses', '2023-07-06 19:35:32'),
(24, 146198, 'muk', 'sedang di proses', '2023-07-06 19:37:55'),
(25, 146198, 'muk', 'sedang di proses', '2023-07-06 19:40:32'),
(26, 915665, 'muk', 'sedang di proses', '2023-07-11 00:44:37'),
(27, 758487, 'muk', 'sedang di proses', '2023-08-07 06:23:51'),
(28, 758487, 'muk', 'sedang di proses', '2023-08-07 06:24:28'),
(29, 758487, 'muk', 'sedang di proses', '2023-08-07 06:24:31'),
(30, 574862, 'wish', 'sedang di proses', '2023-08-13 03:40:21'),
(31, 479640, 'muk', 'sedang di proses', '2023-08-13 03:46:11'),
(32, 349622, 'muk', 'sedang di proses', '2023-08-13 06:14:55'),
(33, 840257, 'yusri', 'sedang di proses', '2023-08-15 01:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `s_selesai`
--

CREATE TABLE `s_selesai` (
  `id` int(11) NOT NULL,
  `kode_pesanan` int(11) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `selesai` varchar(255) DEFAULT NULL,
  `selesai_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','customer','courrier') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(3, 'admins', '123456', 'admin'),
(4, 'kurir', '1234', 'courrier'),
(17, 'muk', '123', 'customer'),
(23, 'kipa', '123', 'customer'),
(24, 'yusri', 'yusri', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_prdk`
--
ALTER TABLE `pembelian_prdk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indexes for table `s_delivered`
--
ALTER TABLE `s_delivered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_diperjalanan`
--
ALTER TABLE `s_diperjalanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_kemas`
--
ALTER TABLE `s_kemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_kurir`
--
ALTER TABLE `s_kurir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_proses`
--
ALTER TABLE `s_proses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_selesai`
--
ALTER TABLE `s_selesai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pembelian_prdk`
--
ALTER TABLE `pembelian_prdk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `s_delivered`
--
ALTER TABLE `s_delivered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `s_diperjalanan`
--
ALTER TABLE `s_diperjalanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `s_kemas`
--
ALTER TABLE `s_kemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `s_kurir`
--
ALTER TABLE `s_kurir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `s_proses`
--
ALTER TABLE `s_proses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `s_selesai`
--
ALTER TABLE `s_selesai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
