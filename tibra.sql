-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Jun 2025 pada 22.18
-- Versi server: 8.4.3
-- Versi PHP: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tibra`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` int NOT NULL,
  `id_produk` int NOT NULL,
  `diskon` int NOT NULL,
  `harga_akhir` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `id_produk`, `diskon`, `harga_akhir`) VALUES
(5, 12, 50, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int NOT NULL,
  `id_user` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_user`, `fullname`, `activity`, `created_at`) VALUES
(1, 2, 'Admin', 'Telah Login', '2025-06-17 12:34:39'),
(2, 2, 'Admin', 'Telah mengatur diskon 50% pada produk Test', '2025-06-17 05:34:58'),
(3, 2, 'Admin', 'Telah Login', '2025-06-17 12:13:39'),
(4, 2, 'Admin', 'Telah Login', '2025-06-17 15:16:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int NOT NULL,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_pembelian` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_user`, `id_produk`, `jumlah`, `tanggal_pembelian`, `total_harga`) VALUES
(1, 7, 3, 0, '2025-06-17 20:35:30', 0),
(2, 7, 12, 0, '2025-06-17 20:40:19', 0),
(3, 8, 4, 0, '2025-06-17 20:42:44', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `merk_produk` varchar(100) NOT NULL,
  `jumlah` varchar(200) NOT NULL,
  `type_produk` varchar(100) NOT NULL,
  `tahun_pembuatan` varchar(4) NOT NULL,
  `photo_produk` varchar(200) NOT NULL DEFAULT 'default.png',
  `diskon` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `deskripsi_produk`, `merk_produk`, `jumlah`, `type_produk`, `tahun_pembuatan`, `photo_produk`, `diskon`) VALUES
(3, 'MSI HUAHAHAH', 5000, 'Keren', 'MSI', '100', 'Mouse', '1945', '1749813254_e58c6254782752de16c2.png', 0),
(4, 'BESI PANAS', 500000, 'Mantap', 'PT.NIKEL', '10', 'Lainnya', '2002', '1749896454_b543107b3a70bb8c8b56.png', 0),
(12, 'Test', 1000000, 'keren', 'AMD', '100', 'Keyboard', '1981', '1750163258_b69062e4e2d47ec112ec.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `fullname` varchar(211) NOT NULL,
  `email` varchar(211) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT 'empty',
  `role` varchar(20) NOT NULL DEFAULT 'Customer',
  `no_telepon` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `email`, `password`, `address`, `role`, `no_telepon`) VALUES
(2, 'Admin', 'admin@admin.com', '$2y$10$YH.6oyiEL/CiAIGnU5U71utOxx9/spvF/iB7nlUBXZewjeOpyI4dy', 'empty', 'Admin', 0),
(4, 'Ujang Bageur', 'test@email.com', '', 'empty', 'Customer', 0),
(5, 'ayam', 'ayam@yahoo.com', '$2y$10$taGtqKboKLuvo/lcUjYLfenSDjVGchaSPMybOQ5KlWZDeyOC5r5dm', 'empty', 'Customer', 0),
(6, 'Viki', 'vikisatriaramadhan@gmail.com', '$2y$10$FYOZiYxdr1Y3wStwQS.2Hu8ycfsgtD0stle5hylMzvap0jhXaGJQO', 'cijerokaso', 'Customer', 0),
(7, 'sipa nurfadillah', 'sipa@sipaanl.com', '$2y$10$WL3XITGnOk9MubYLEyMMAOQ2dOyGOza.UAZb1VsCoHfRup82piH7O', 'empty', 'Customer', 0),
(8, 'gugugaga', 'gugaga@gmail.com', '$2y$10$HK7gM2I/FwfSeddFuMu5gudBZoYsljtXS41zhev8VS3pLlokPGsqi', 'empty', 'Customer', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id_diskon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
