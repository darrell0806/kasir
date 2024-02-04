-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2024 pada 10.46
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(4) NOT NULL,
  `fotob` text NOT NULL,
  `nama_brg` varchar(200) NOT NULL,
  `stock` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `fotob`, `nama_brg`, `stock`, `harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1706887616_7f2bb3fcfbea881b2070.jpg', 'Sunco 1 Liter', '5', '22000', '2024-02-02 09:07:08', '2024-02-02 09:27:28', '0000-00-00 00:00:00'),
(3, '1706941203_761d888f953658879f9d.jpg', 'Bimoli 1 Liter', '6', '20000', '2024-02-03 00:20:03', '2024-02-03 00:20:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` text NOT NULL,
  `subtotal` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `id_penjualan`, `id_barang`, `jumlah`, `subtotal`, `created_at`) VALUES
(1, 1, 3, '2', '40000', '2024-02-04 15:31:42'),
(2, 1, 1, '2', '44000', '2024-02-06 15:31:47'),
(3, 2, 1, '5', '110000', '2024-02-03 15:31:51');

--
-- Trigger `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `hapuss` AFTER DELETE ON `detail_penjualan` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock+old.jumlah WHERE id_barang=old.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `keluar` AFTER INSERT ON `detail_penjualan` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock-new.jumlah WHERE id_barang=new.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2023-10-09 19:57:33', NULL, NULL),
(2, 'Petugas', '2023-10-09 19:57:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `id_masuk` int(4) NOT NULL,
  `jumlah` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `id_user` int(4) NOT NULL,
  `id_barang` int(4) NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`id_masuk`, `jumlah`, `created_at`, `id_user`, `id_barang`, `updated_at`, `deleted_at`) VALUES
(4, '2', '2024-02-02 10:50:01', 1, 1, '2024-02-02 10:50:01', '0000-00-00 00:00:00');

--
-- Trigger `masuk`
--
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `masuk` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock-old.jumlah WHERE id_barang=old.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `masukk` AFTER INSERT ON `masuk` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock+new.jumlah WHERE id_barang= new.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal`, `total`, `id_user`, `created_at`) VALUES
(1, '2024-02-03 15:41:44', '84000', 1, '2024-02-03 09:41:29'),
(2, '2024-02-03 17:05:42', '110000', 1, '2024-02-03 11:05:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `level` int(11) NOT NULL,
  `foto` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `email`, `level`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'Admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin@gmail.com', 1, 'default.png', '2024-01-27 14:27:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Petugas', 'Petugas', '0cc175b9c0f1b6a831c399e269772661', 'petugas@gmail.com', 2, 'default.png', '2024-01-27 02:55:31', '2024-01-27 03:12:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `website`
--

CREATE TABLE `website` (
  `id_website` int(11) NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `logo_website` text DEFAULT NULL,
  `logo_pdf` text DEFAULT NULL,
  `favicon_website` text DEFAULT NULL,
  `komplek` text DEFAULT NULL,
  `jalan` text DEFAULT NULL,
  `kelurahan` text DEFAULT NULL,
  `kecamatan` text DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `website`
--

INSERT INTO `website` (`id_website`, `nama_website`, `logo_website`, `logo_pdf`, `favicon_website`, `komplek`, `jalan`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kasir Minimarket', 'logo_contoh.svg', 'logo_pdf_contoh.svg', 'favicon_contoh.svg', 'Komp. Pahlawan Mas', 'Jl. Raya Pahlawan No. 123', 'Kel. Sukajadi', 'Kec. Sukasari', 'Kota Batam', '29424', '2023-05-01 16:33:53', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id_website`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `id_masuk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id_website` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
