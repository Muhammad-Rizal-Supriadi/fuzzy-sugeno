-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Bulan Mei 2018 pada 14.25
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ai_gastro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `diagnosa_penyakit`
--

CREATE TABLE `diagnosa_penyakit` (
  `id` int(11) NOT NULL,
  `nama_diagnosa_penyakit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diagnosa_penyakit`
--

INSERT INTO `diagnosa_penyakit` (`id`, `nama_diagnosa_penyakit`) VALUES
(3, 'Keracunan Jamur Beracun'),
(4, 'Keracunan Salmonellae'),
(5, 'Keracunan Campylobacter'),
(6, 'Keracunan Clostridium botulinum'),
(7, 'Keracunan Staphylococcus aureus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala_fisik`
--

CREATE TABLE `gejala_fisik` (
  `id` int(11) NOT NULL,
  `nama_gejala_fisik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gejala_fisik`
--

INSERT INTO `gejala_fisik` (`id`, `nama_gejala_fisik`) VALUES
(1, 'Apakah anda sering mengalami buang air besar (lebih dari 2 kali)?'),
(2, 'Apakah anda mengalami berak encer?'),
(3, 'Apakah anda mengalami berak berdarah?'),
(4, 'Apakah anda merasa lesu dan tidak bergairah?'),
(5, 'Apakah anda tidak selera makan?'),
(6, 'Apakah anda merasa mual dan sering muntah (lebih dari 1 kali) ?'),
(7, 'Apakah anda merasa sakit di bagian perut ?'),
(8, 'Apakah tekanan darah anda rendah ?'),
(9, 'Apakah anda merasa pusing ?'),
(10, 'Apakah anda mengalami pingsan ?'),
(11, 'Apakah suhu badan anda tinggi ?'),
(12, 'Apakah anda mengalami luka di bagian tertentu ?'),
(13, 'Apakah anda tidak dapat menggerakkan anggota badan tertentu ?'),
(14, 'Apakah anda pernah memakan sesuatu ?'),
(15, 'Apakah anda memakan daging ?'),
(16, 'Apakah anda memakan jamur ?'),
(17, 'Apakah anda memakan makanan kaleng ?'),
(18, 'Apakah anda membeli susu ?'),
(19, 'Apakah anda meminum susu ?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala_klinis`
--

CREATE TABLE `gejala_klinis` (
  `id` int(11) NOT NULL,
  `nama_gejala_klinis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gejala_klinis`
--

INSERT INTO `gejala_klinis` (`id`, `nama_gejala_klinis`) VALUES
(1, 'Mencret'),
(2, 'Muntah'),
(3, 'Sakit perut'),
(4, 'Darah rendah'),
(5, 'Koma'),
(6, 'Demam'),
(7, 'Septicaemia'),
(8, 'Lumpuh'),
(9, 'Mencret berdarah'),
(10, 'Makan daging'),
(11, 'Makan jamur'),
(12, 'Makan makanan kaleng'),
(13, 'Minum susu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `relation_diagnosa_klinis`
--

CREATE TABLE `relation_diagnosa_klinis` (
  `id` int(11) NOT NULL,
  `gejala_klinis_id` int(11) NOT NULL,
  `diagnosa_penyakit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `relation_diagnosa_klinis`
--

INSERT INTO `relation_diagnosa_klinis` (`id`, `gejala_klinis_id`, `diagnosa_penyakit_id`) VALUES
(1, 1, 7),
(2, 2, 7),
(3, 3, 7),
(4, 4, 7),
(5, 10, 7),
(6, 1, 3),
(7, 2, 3),
(8, 3, 3),
(9, 5, 3),
(10, 11, 3),
(11, 1, 4),
(12, 2, 4),
(13, 3, 4),
(14, 6, 4),
(15, 7, 4),
(16, 10, 4),
(17, 2, 6),
(18, 8, 6),
(19, 12, 6),
(20, 9, 5),
(21, 3, 5),
(22, 6, 5),
(23, 13, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `relation_klinik_fisik`
--

CREATE TABLE `relation_klinik_fisik` (
  `id` int(11) NOT NULL,
  `gejala_fisik_id` int(11) NOT NULL,
  `gejala_klinis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `relation_klinik_fisik`
--

INSERT INTO `relation_klinik_fisik` (`id`, `gejala_fisik_id`, `gejala_klinis_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 4, 1),
(4, 5, 1),
(5, 4, 2),
(6, 5, 2),
(7, 6, 2),
(8, 4, 3),
(9, 7, 3),
(10, 4, 4),
(11, 8, 4),
(12, 9, 4),
(13, 8, 5),
(14, 10, 5),
(15, 4, 6),
(16, 5, 6),
(17, 9, 6),
(18, 11, 6),
(19, 4, 7),
(20, 8, 7),
(21, 11, 7),
(22, 12, 7),
(23, 4, 8),
(24, 13, 8),
(25, 1, 9),
(26, 2, 9),
(27, 3, 9),
(28, 4, 9),
(29, 5, 9),
(30, 14, 10),
(31, 15, 10),
(32, 14, 11),
(33, 16, 11),
(34, 14, 12),
(35, 17, 12),
(36, 18, 13),
(37, 19, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `diagnosa_penyakit`
--
ALTER TABLE `diagnosa_penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gejala_fisik`
--
ALTER TABLE `gejala_fisik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gejala_klinis`
--
ALTER TABLE `gejala_klinis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `relation_diagnosa_klinis`
--
ALTER TABLE `relation_diagnosa_klinis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `relation_klinik_fisik`
--
ALTER TABLE `relation_klinik_fisik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `diagnosa_penyakit`
--
ALTER TABLE `diagnosa_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `gejala_fisik`
--
ALTER TABLE `gejala_fisik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `gejala_klinis`
--
ALTER TABLE `gejala_klinis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `relation_diagnosa_klinis`
--
ALTER TABLE `relation_diagnosa_klinis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `relation_klinik_fisik`
--
ALTER TABLE `relation_klinik_fisik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
