-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Agu 2024 pada 17.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bengkel`
--
CREATE DATABASE IF NOT EXISTS `db_bengkel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_bengkel`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--
-- Pembuatan: 22 Agu 2024 pada 15.13
-- Pembaruan terakhir: 22 Agu 2024 pada 15.25
--

DROP TABLE IF EXISTS `bahan`;
CREATE TABLE `bahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `bahan`:
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--
-- Pembuatan: 18 Agu 2024 pada 11.06
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `jenis_mobil` varchar(255) NOT NULL,
  `nomor_plat` varchar(255) NOT NULL,
  `warna_cat` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `pelanggan`:
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_bahan`
--
-- Pembuatan: 22 Agu 2024 pada 15.13
--

DROP TABLE IF EXISTS `pembelian_bahan`;
CREATE TABLE `pembelian_bahan` (
  `id` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `dibeli_oleh` int(11) NOT NULL,
  `tanggal_pembelian` datetime NOT NULL DEFAULT current_timestamp(),
  `jumlah` decimal(10,2) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `foto_nota` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `pembelian_bahan`:
--   `id_bahan`
--       `bahan` -> `id`
--   `dibeli_oleh`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan_bahan`
--
-- Pembuatan: 22 Agu 2024 pada 15.14
--

DROP TABLE IF EXISTS `penggunaan_bahan`;
CREATE TABLE `penggunaan_bahan` (
  `id` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_penggunaan` datetime NOT NULL DEFAULT current_timestamp(),
  `jumlah_digunakan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `penggunaan_bahan`:
--   `id_bahan`
--       `bahan` -> `id`
--   `id_pelanggan`
--       `pelanggan` -> `id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--
-- Pembuatan: 18 Agu 2024 pada 11.16
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `total_pendapatan` decimal(10,2) NOT NULL,
  `biaya_bahan` decimal(10,2) NOT NULL,
  `biaya_jasa` decimal(10,2) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `transaksi`:
--   `id_pelanggan`
--       `pelanggan` -> `id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pekerja`
--
-- Pembuatan: 18 Agu 2024 pada 11.16
--

DROP TABLE IF EXISTS `transaksi_pekerja`;
CREATE TABLE `transaksi_pekerja` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bagian_jasa` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `transaksi_pekerja`:
--   `id_transaksi`
--       `transaksi` -> `id`
--   `id_user`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--
-- Pembuatan: 18 Agu 2024 pada 09.54
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profil` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian_bahan`
--
ALTER TABLE `pembelian_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bahan` (`id_bahan`),
  ADD KEY `dibeli_oleh` (`dibeli_oleh`);

--
-- Indeks untuk tabel `penggunaan_bahan`
--
ALTER TABLE `penggunaan_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bahan` (`id_bahan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `transaksi_pekerja`
--
ALTER TABLE `transaksi_pekerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembelian_bahan`
--
ALTER TABLE `pembelian_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penggunaan_bahan`
--
ALTER TABLE `penggunaan_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pekerja`
--
ALTER TABLE `transaksi_pekerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian_bahan`
--
ALTER TABLE `pembelian_bahan`
  ADD CONSTRAINT `pembelian_bahan_ibfk_1` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id`),
  ADD CONSTRAINT `pembelian_bahan_ibfk_2` FOREIGN KEY (`dibeli_oleh`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `penggunaan_bahan`
--
ALTER TABLE `penggunaan_bahan`
  ADD CONSTRAINT `penggunaan_bahan_ibfk_1` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id`),
  ADD CONSTRAINT `penggunaan_bahan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_pekerja`
--
ALTER TABLE `transaksi_pekerja`
  ADD CONSTRAINT `transaksi_pekerja_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_pekerja_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
