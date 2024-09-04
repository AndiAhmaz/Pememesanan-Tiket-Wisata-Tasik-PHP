-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2024 pada 01.49
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
-- Database: `dbpemesanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(50) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `total` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tanggal_pemesanan`, `total`) VALUES
(65, '2024-08-06', 100000),
(66, '2024-08-07', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_tiket`
--

CREATE TABLE `pemesanan_tiket` (
  `id_pemesanan_tiket` int(50) NOT NULL,
  `id_pemesanan` int(50) NOT NULL,
  `id_rute` varchar(50) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan_tiket`
--

INSERT INTO `pemesanan_tiket` (`id_pemesanan_tiket`, `id_pemesanan`, `id_rute`, `jumlah`) VALUES
(50, 61, '35', 1),
(51, 62, '22', 1),
(52, 63, '22', 1),
(53, 64, '22', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket_onlybus`
--

CREATE TABLE `tiket_onlybus` (
  `id_rute` int(50) NOT NULL,
  `nama_bus` varchar(50) NOT NULL,
  `jenis_rute` varchar(50) NOT NULL,
  `stok_tiket` int(50) NOT NULL,
  `harga_tiket` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tiket_onlybus`
--

INSERT INTO `tiket_onlybus` (`id_rute`, `nama_bus`, `jenis_rute`, `stok_tiket`, `harga_tiket`, `gambar`) VALUES
(22, 'Gunung Galunggung', 'Alami', 50, 100000, 'gunung galugung.png'),
(34, 'Kebun Teh Taraju', '', 50, 50000, 'kebun teh taraju.png'),
(35, 'Situ Sanghyang', '', 50, 20000, 'landmark-situ-sanghyang 1.png'),
(36, 'Pantai Cipatujah', 'Alami', 50, 25000, 'pantai cipatujah.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `hp` varchar(25) NOT NULL,
  `status` enum('admin','user','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `hp`, `status`) VALUES
(9, 'andi', 'andi', 'ANDI AHMAD ZAELANI', 'Laki-Laki', '2002-09-08', 'KP LEBAKGEDE, RT/RW 002/0', '085213243123', 'user'),
(10, 'admin', 'admin', 'admin', 'Laki-Laki', '2002-09-08', 'Kp. Lebak Gede', '085213243123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `pemesanan_tiket`
--
ALTER TABLE `pemesanan_tiket`
  ADD PRIMARY KEY (`id_pemesanan_tiket`);

--
-- Indeks untuk tabel `tiket_onlybus`
--
ALTER TABLE `tiket_onlybus`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_tiket`
--
ALTER TABLE `pemesanan_tiket`
  MODIFY `id_pemesanan_tiket` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `tiket_onlybus`
--
ALTER TABLE `tiket_onlybus`
  MODIFY `id_rute` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
