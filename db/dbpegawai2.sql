-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04 Mei 2019 pada 10.07
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbpegawai2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE IF NOT EXISTS `bidang` (
  `id_bidang` varchar(15) NOT NULL,
  `nm_bidang` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `nm_bidang`) VALUES
('BI.001', 'Pengembangan Kompetensi Aparatur'),
('BI.002', 'Mutasi Pegawai'),
('BI.003', 'Pengadaan, Pemberhentian dan Informasi'),
('BI.004', 'Penilaian Kinerja Aparatur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kriteria`
--

CREATE TABLE IF NOT EXISTS `detail_kriteria` (
`id_detail` int(4) NOT NULL,
  `id_kriteria` varchar(15) NOT NULL,
  `nama_detail` varchar(45) NOT NULL,
  `skor` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_kriteria`
--

INSERT INTO `detail_kriteria` (`id_detail`, `id_kriteria`, `nama_detail`, `skor`) VALUES
(10, 'KR.001', 'Tidak Ada', 1),
(11, 'KR.002', 'Ada', 2),
(12, 'KR.003', 'Hukum', 3),
(13, 'KR.004', 'Pendidikan', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ketentuan`
--

CREATE TABLE IF NOT EXISTS `ketentuan` (
`id_ketentuan` int(2) NOT NULL,
  `selisih` int(2) NOT NULL,
  `nilai` decimal(5,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ketentuan`
--

INSERT INTO `ketentuan` (`id_ketentuan`, `selisih`, `nilai`) VALUES
(1, 0, '5.00'),
(2, 1, '4.50'),
(5, -1, '4.00'),
(6, 2, '3.50'),
(7, -2, '3.00'),
(8, 3, '2.50'),
(9, -3, '2.00'),
(10, 4, '1.50'),
(11, -4, '1.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` varchar(15) NOT NULL,
  `nm_kriteria` varchar(24) NOT NULL,
  `keterangan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`, `keterangan`) VALUES
('KR.001', 'Pendidikan Terakhir', ''),
('KR.002', 'Pengalaman Kerja', ''),
('KR.003', 'Usia', ''),
('KR.004', 'Jurusan Pendidikan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `nip` varchar(15) NOT NULL,
  `nm_pegawai` varchar(36) NOT NULL,
  `jen_kel` varchar(25) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `usia_skrg` int(3) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_pendidikan` varchar(10) NOT NULL,
  `id_usia` varchar(10) NOT NULL,
  `id_riwayat` varchar(10) NOT NULL,
  `id_masa` varchar(10) NOT NULL,
  `id_jurusan` varchar(10) NOT NULL,
  `tgl_update` date NOT NULL,
  `n_akhir` decimal(5,2) NOT NULL,
  `id_bidang` varchar(15) NOT NULL,
  `tgl_penempatan` date NOT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nm_pegawai`, `jen_kel`, `tempat_lahir`, `tgl_lahir`, `usia_skrg`, `alamat`, `id_pendidikan`, `id_usia`, `id_riwayat`, `id_masa`, `id_jurusan`, `tgl_update`, `n_akhir`, `id_bidang`, `tgl_penempatan`, `status`) VALUES
('NIP.001', 'Adel', 'Perempuan', 'Indramayu', '1996-02-12', 23, 'Indramayu', '', '2', '2', '2', '3', '2019-05-03', '40.00', 'BI.004', '2019-05-03', 'Y'),
('NIP.002', 'Dian', 'Perempuan', 'Indramayu', '1996-12-12', 23, 'Bongas', '', '2', '1', '2', '3', '2019-05-03', '36.00', '', '0000-00-00', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penempatan`
--

CREATE TABLE IF NOT EXISTS `penempatan` (
`id_penempatan` int(4) NOT NULL,
  `id_bidang` varchar(15) NOT NULL,
  `id_pendidikan` varchar(10) NOT NULL,
  `id_riwayat` varchar(10) NOT NULL,
  `id_usia` varchar(10) NOT NULL,
  `id_jurusan` varchar(10) NOT NULL,
  `id_masa` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penempatan`
--

INSERT INTO `penempatan` (`id_penempatan`, `id_bidang`, `id_pendidikan`, `id_riwayat`, `id_usia`, `id_jurusan`, `id_masa`) VALUES
(7, 'BI.004', '4', '2', '4', '4', '3'),
(12, 'BI.002', '4', '2', '4', '2', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@detik.com', '08238923848', 'admin', 'N', 'r8sifpvafnmrooocakk6pubu37'),
('kepala', '870f669e4bbbfa8a6fde65549826d1c4', 'Ir. Nugroho', 'a@mail.com', '098765', 'kepala', 'N', '98828a5cb77e74e7d184603abca942c9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
 ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
 ADD PRIMARY KEY (`id_detail`), ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `ketentuan`
--
ALTER TABLE `ketentuan`
 ADD PRIMARY KEY (`id_ketentuan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
 ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `penempatan`
--
ALTER TABLE `penempatan`
 ADD PRIMARY KEY (`id_penempatan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
MODIFY `id_detail` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `ketentuan`
--
ALTER TABLE `ketentuan`
MODIFY `id_ketentuan` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `penempatan`
--
ALTER TABLE `penempatan`
MODIFY `id_penempatan` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
ADD CONSTRAINT `detail_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
