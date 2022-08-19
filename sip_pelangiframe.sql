-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2022 pada 18.04
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sip_pelangiframe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_bonus`
--

CREATE TABLE `data_bonus` (
  `id_bonus` int(11) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `bonus` int(11) DEFAULT NULL,
  `thr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_bonus`
--

INSERT INTO `data_bonus` (`id_bonus`, `bulan`, `username`, `nama_karyawan`, `jenis_kelamin`, `nama_jabatan`, `bonus`, `thr`) VALUES
(1, '052022', 'ADM-01', 'Ami', 'Perempuan', 'Admin Divisi', 300000, 2100000),
(2, '052022', 'PSG-01', 'Hamdan', 'Laki-laki', 'Tukang Pasang Bingkai 1', 200000, 2200000),
(3, '052022', 'PSG-02', 'Chandra', 'Laki-laki', 'Tukang Pasang Bingkai 2', 300000, 2600000),
(4, '052022', 'PMT-01', 'Aris', 'Laki-laki', 'Tukang Pemantek Bingkai', 300000, 2400000),
(5, '052022', 'ADM-02', 'Rowi', 'Laki-laki', 'Admin Kios', 500000, 2600000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `gaji_pokok` varchar(10) NOT NULL,
  `intensif` varchar(10) NOT NULL,
  `uang_transport` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `intensif`, `uang_transport`) VALUES
(1, 'Admin Divisi', '2000000', '2000000', '30000'),
(2, 'Tukang Potong Bingkai', '2400000', '2600000', '30000'),
(3, 'Tukang Pasang Bingkai 1', '2800000', '2200000', '20000'),
(4, 'Tukang Pasang Bingkai 2', '2600000', '2600000', '40000'),
(5, 'Tukang Pemantek Bingkai', '2200000', '2400000', '25000'),
(6, 'Admin Kios', '2400000', '2600000', '30000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_karyawan`
--

INSERT INTO `data_karyawan` (`id_karyawan`, `username`, `password`, `nama_karyawan`, `jenis_kelamin`, `jabatan`, `foto`, `hak_akses`) VALUES
(9, 'PSG-02', '81dc9bdb52d04dc20036dbd8313ed055', 'Chandra', 'Laki-laki', 'Tukang Pasang Bingkai 2', '8dff49985d0d8afa53751d9ba8907aed.jpg', 2),
(10, 'PMT-01', '81dc9bdb52d04dc20036dbd8313ed055', 'Aris', 'Laki-laki', 'Tukang Pemantek Bingkai', '54879bd87bb201e20db46f14e5445b55.jpg', 2),
(11, 'ADM-02', '81dc9bdb52d04dc20036dbd8313ed055', 'Rowi', 'Laki-laki', 'Admin Kios', '8dff49985d0d8afa53751d9ba8907aed2.jpg', 1),
(12, 'ADM-01', 'd41d8cd98f00b204e9800998ecf8427e', 'Ami', 'Perempuan', 'Admin Divisi', 'original_(12).jpg', 1),
(13, 'PTG-01', '81dc9bdb52d04dc20036dbd8313ed055', 'Heru', 'Laki-laki', 'Tukang Potong Bingkai', '8dff49985d0d8afa53751d9ba8907aed3.jpg', 2),
(14, 'PSG-01', '81dc9bdb52d04dc20036dbd8313ed055', 'Hamdan', 'Laki-laki', 'Tukang Pasang Bingkai 1', '8dff49985d0d8afa53751d9ba8907aed4.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `hadir` int(11) DEFAULT NULL,
  `libur` int(11) DEFAULT NULL,
  `alpha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id_kehadiran`, `bulan`, `username`, `nama_karyawan`, `jenis_kelamin`, `nama_jabatan`, `hadir`, `libur`, `alpha`) VALUES
(1, '052022', 'ADM-01', 'Ami', 'Perempuan', 'Admin Divisi', 23, 8, 0),
(2, '052022', 'PTG-01', 'Heru', 'Laki-laki', 'Tukang Potong Bingkai', 23, 8, 0),
(3, '052022', 'PSG-01', 'Hamdan', 'Laki-laki', 'Tukang Pasang Bingkai 1', 23, 8, 0),
(4, '052022', 'PSG-02', 'Chandra', 'Laki-laki', 'Tukang Pasang Bingkai 2', 23, 8, 0),
(5, '052022', 'PMT-01', 'Aris', 'Laki-laki', 'Tukang Pemantek Bingkai', 23, 8, 0),
(6, '052022', 'ADM-02', 'Rowi', 'Laki-laki', 'Admin Kios', 23, 8, 0),
(61, '082022', 'ADM-01', 'Ami', 'Perempuan', 'Admin Divisi', 3, 2, 3),
(62, '082022', 'PSG-01', 'Hamdan', 'Laki-laki', 'Tukang Pasang Bingkai 1', 2, 0, 1),
(63, '082022', 'PSG-02', 'Chandra', 'Laki-laki', 'Tukang Pasang Bingkai 2', 0, 0, 0),
(64, '082022', 'PMT-01', 'Aris', 'Laki-laki', 'Tukang Pemantek Bingkai', 0, 0, 0),
(65, '082022', 'ADM-02', 'Rowi', 'Laki-laki', 'Admin Kios', 0, 0, 0),
(66, '082022', 'PTG-01', 'Heru', 'Laki-laki', 'Tukang Potong Bingkai', 1, 0, 0),
(67, '062022', 'ADM-01', 'Ami', 'Perempuan', 'Admin Divisi', 25, 5, 0),
(68, '062022', 'PSG-01', 'Hamdan', 'Laki-laki', 'Tukang Pasang Bingkai 1', 25, 5, 0),
(69, '062022', 'PSG-02', 'Chandra', 'Laki-laki', 'Tukang Pasang Bingkai 2', 25, 5, 0),
(70, '062022', 'PMT-01', 'Aris', 'Laki-laki', 'Tukang Pemantek Bingkai', 25, 5, 0),
(71, '062022', 'ADM-02', 'Rowi', 'Laki-laki', 'Admin Kios', 25, 5, 0),
(72, '072022', 'ADM-01', 'Ami', 'Perempuan', 'Admin Divisi', 27, 4, 0),
(73, '072022', 'PSG-01', 'Hamdan', 'Laki-laki', 'Tukang Pasang Bingkai 1', 27, 4, 0),
(74, '072022', 'PSG-02', 'Chandra', 'Laki-laki', 'Tukang Pasang Bingkai 2', 27, 4, 0),
(75, '072022', 'PMT-01', 'Aris', 'Laki-laki', 'Tukang Pemantek Bingkai', 27, 4, 0),
(76, '072022', 'ADM-02', 'Rowi', 'Laki-laki', 'Admin Kios', 27, 4, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_potongan_gaji`
--

CREATE TABLE `data_potongan_gaji` (
  `id_potongan` int(11) NOT NULL,
  `potongan` varchar(120) NOT NULL,
  `jml_potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_potongan_gaji`
--

INSERT INTO `data_potongan_gaji` (`id_potongan`, `potongan`, `jml_potongan`) VALUES
(1, 'alpha', 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_akses` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id_akses`, `keterangan`, `hak_akses`) VALUES
(1, 'Admin', 1),
(2, 'Karyawan', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_bonus`
--
ALTER TABLE `data_bonus`
  ADD PRIMARY KEY (`id_bonus`);

--
-- Indeks untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indeks untuk tabel `data_potongan_gaji`
--
ALTER TABLE `data_potongan_gaji`
  ADD PRIMARY KEY (`id_potongan`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_bonus`
--
ALTER TABLE `data_bonus`
  MODIFY `id_bonus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `data_potongan_gaji`
--
ALTER TABLE `data_potongan_gaji`
  MODIFY `id_potongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
