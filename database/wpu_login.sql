-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2022 pada 15.51
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpu_login`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `prodi` varchar(128) NOT NULL,
  `npm` int(11) NOT NULL,
  `nik` bigint(20) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `prodi`, `npm`, `nik`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'fadly', 'eprakerin2021@gmail.com', '0', 0, 0, 'Pendaftaran_POLTEKPOS2.jpg', '$2y$10$fzCVGbHbuYSreFnhvY4fiOeJQzeRhMjEq/u1lTWncQOtO4ytzzbVC', 1, 1, 1641735264),
(5, 'Pak ruslan', 'didinirfandy16@gmail.com', '', 0, 1234433232333, 'default.jpg', '$2y$10$mu4qmmc52wh/E4MMxiqhPuaX1l7TnDXWUQZTjc9nltFS0XUVtinWC', 2, 1, 1641741738),
(9, 'koor', 'fadlyferdiansyah14@gmail.com', '', 0, 0, 'default.jpg', '$2y$10$4C8bKzTw/KTfrCgTCWt7/eMcXT0L3Dv8xHU.9aj33okueWZ.Mnhy.', 4, 1, 1642402263);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(6, 3, 3),
(10, 1, 4),
(11, 4, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Dosen'),
(3, 'Mahasiswa'),
(4, 'Koordinator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Dosen'),
(3, 'Mahasiswa'),
(4, 'Koordinator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'dosen', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'dosen/edit', 'fas fa-fw fa-user-edit', 1),
(4, 1, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 1, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-tasks', 1),
(6, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(7, 2, 'Change Password', 'dosen/changepassword', 'fas fa-fw fa-key', 1),
(8, 3, 'My Profile', 'mahasiswa', 'fas fa-fw fa-user', 1),
(9, 3, 'Edit Profile', 'mahasiswa/edit', 'fas fa-fw fa-user-edit', 1),
(10, 3, 'Change Password', 'mahasiswa/changepassword', 'fas fa-fw fa-key', 1),
(11, 3, 'Upload Laporan', 'mahasiswa/uploadlaporan', 'fas fa-fw fa-file-upload ', 1),
(12, 3, 'Data Dosen', 'mahasiswa/datadosen', 'fas fa-fw fa-chalkboard-teacher', 1),
(13, 2, 'Laporan Mahasiswa', 'dosen/laporanm', 'fas fa-fw fa-file-download', 1),
(14, 2, 'Data Mahasiswa', 'dosen/viewm', 'fas fa-fw fa-user-graduate', 1),
(15, 4, 'My Profile', 'koordinator', 'fas fa-fw fa-user', 1),
(16, 4, 'Edit Profile', 'koordinator/edit', 'fas fa-fw fa-user-edit', 1),
(17, 4, 'Change Password ', 'koordinator/changepassword', 'fas fa-fw fa-key', 1),
(18, 4, 'Lokasi PKL', 'koordinator/lokasiPKL', 'fas fa-fw fa-map-marked-alt', 1),
(19, 4, 'Daftar Dosen Pembimbing', 'koordinator/dftrDsnPembimbing', 'fas fa-fw fa-street-view', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
