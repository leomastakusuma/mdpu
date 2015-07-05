-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 06 Jul 2015 pada 02.07
-- Versi Server: 5.6.19-0ubuntu0.14.04.1
-- Versi PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Basis data: `mdpu_finance`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE IF NOT EXISTS `cabang` (
  `id_cabang` int(10) NOT NULL AUTO_INCREMENT,
  `cabang` varchar(200) NOT NULL,
  `kepala_cabang` varchar(200) NOT NULL,
  `provinsi` text NOT NULL,
  `kota` text NOT NULL,
  `kecamatan` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` varchar(7) NOT NULL,
  PRIMARY KEY (`id_cabang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `cabang`, `kepala_cabang`, `provinsi`, `kota`, `kecamatan`, `alamat`, `kode_pos`) VALUES
(29, 'Antasari', 'SRI ROHAYATI, S.Kom, Mp.di', 'Lampung', 'Antasari', 'Waru', 'Jl Pangen Antasari No 20', '12310 '),
(30, 'Natar', 'OMMASTA, S.Kom JKT', 'Lampung', 'Lampung Selatan', 'Natar', 'Jl Panjang Lampung km 21 ', '23112 ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `costumer`
--

CREATE TABLE IF NOT EXISTS `costumer` (
  `id_costumer` int(50) NOT NULL AUTO_INCREMENT,
  `nik_costumer` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `alamat_tempat_kerja` text NOT NULL,
  `hp` varchar(20) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cabang` int(10) NOT NULL,
  PRIMARY KEY (`id_costumer`),
  UNIQUE KEY `nik_costumer` (`nik_costumer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `costumer`
--

INSERT INTO `costumer` (`id_costumer`, `nik_costumer`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `jenis_kelamin`, `agama`, `status`, `pekerjaan`, `alamat_tempat_kerja`, `hp`, `telpon`, `id_user`, `id_cabang`) VALUES
(1, '11-212-31231211', 'Riza Masta Saputra', 'Jl Waru No 21 Antasari Bandar Lampung', 'Tanjung Raja', '2015-06-17', 'Masjuita', 'laki-laki', 'HINDU', 'belummenikah', 'PNS', 'Jl Waru No 21 Antasari Bandar Lampung', '8123123123', '123123', 16, 29),
(2, '112-1-2-3-12312113', 'Leo Masta Kusuma', 'Jl Radio 1 No 21 Kebayoran Baru Jakarta Selatan', 'Tanjung Raja', '1990-06-23', 'Majuita', 'perempuan', 'ISLAM', 'menikah', 'Swasta', 'Jl Radio 1 No 21 Kebayoran Baru Jakarta Selatan', '0812311111', '123', 16, 29),
(3, '41112121111', 'Aldhonie Saputra', 'Metro', 'Metro', '2015-04-13', 'MARSYA', 'pria', 'islam', 'menikah', 'IT Helpdesk', 'Test Test Test ', '0812312312', '021211111', 16, 29),
(7, '1234-111-23-90', 'Rendi Prayoga', 'Jl Sri Menanti No 21 Tanjung Raja Lampung Utara', 'Tanjung Raja', '2002-04-14', 'Masjuita', 'pria', 'islam', 'belummenikah', 'Pelajar', 'Jalan Simatupang', '0812311111', '021211111', 16, 29),
(8, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0),
(9, '18129310112231', 'Iskandar Parta Dinata', 'Lampung', 'Lampung', '2015-07-22', 'Lampung', 'pria', 'islam', 'menikah', 'Lampung', 'Lampung', '1234555', '22121212', 17, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE IF NOT EXISTS `kendaraan` (
  `id_kendaraan` int(10) NOT NULL AUTO_INCREMENT,
  `no_polisi` varchar(10) NOT NULL,
  `no_bpkb` varchar(100) NOT NULL,
  `nama_bpkb` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `merk` varchar(100) NOT NULL,
  `no_mesin` varchar(100) NOT NULL,
  `no_rangka` varchar(100) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `tahun_pembuatan` date NOT NULL,
  `isi_silinder` varchar(100) NOT NULL,
  `tgl_stnk` date NOT NULL,
  `nik_costumer` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_kendaraan`),
  UNIQUE KEY `no_polisi` (`no_polisi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `no_polisi`, `no_bpkb`, `nama_bpkb`, `alamat`, `merk`, `no_mesin`, `no_rangka`, `warna`, `tahun_pembuatan`, `isi_silinder`, `tgl_stnk`, `nik_costumer`, `status`) VALUES
(1, '51214', '51214a51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a51214a', '51214a51214a', '51214a51214a', '2015-06-29', 'protected', '2015-06-29', '1121231231211', 'new'),
(2, 'BE85', '012314121879287498341431231', 'Sri Rohayati', 'Jl Waru Antarasi', 'Test', '788hjgt64sdsdg5ds', '788hjgt64sdsdg5ds', 'hitam', '2014-06-10', 'kjlkj', '2014-08-20', '41112121111', 'new'),
(3, 'BE123', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', '2015-06-23', 'BE1234GJ', '2015-06-30', '11212', 'new'),
(5, 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', '2015-06-29', 'qweq', '2015-06-29', '1121231231211', 'new'),
(6, 'BE-5064-JA', 'bkp', 'bkp', 'BE-5064-JA', 'HONDA', 'BE-5064-JA1', 'BE-5064-JA', 'Hitam', '2015-06-23', 'BE-5064-JA', '2015-06-22', '1234-111-23-90', 'kredit'),
(7, 'AD-5064-JI', '123451111111', 'Iskandar Parta', 'Jl Jauh gang semping', 'Honda', '01231111', '122212221222122212221222', 'Hitam Metal', '2015-02-11', '250 cc', '2015-07-22', '18129310112231', 'kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` int(5) NOT NULL AUTO_INCREMENT,
  `no_kwitansi` varchar(10) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `no_kontrak` varchar(10) NOT NULL,
  `angsuran_ke` int(3) NOT NULL,
  `angsuran_perbulan` decimal(10,0) NOT NULL,
  `denda` decimal(10,0) NOT NULL,
  `total_bayar` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `no_kwitansi` (`no_kwitansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjamin`
--

CREATE TABLE IF NOT EXISTS `penjamin` (
  `id_penjamin` int(50) NOT NULL AUTO_INCREMENT,
  `nik_penjamin` varchar(50) NOT NULL,
  `nik_costumer` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `alamat_tempat_kerja` text NOT NULL,
  `hp` varchar(20) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  PRIMARY KEY (`id_penjamin`),
  UNIQUE KEY `nik_penjamin` (`nik_penjamin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `penjamin`
--

INSERT INTO `penjamin` (`id_penjamin`, `nik_penjamin`, `nik_costumer`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `jenis_kelamin`, `agama`, `status`, `pekerjaan`, `alamat_tempat_kerja`, `hp`, `telpon`) VALUES
(5, '11-231221-23', '11-212-31231211', 'Riza Masta Saputra', 'Jl Waru No 21 Antasari Bandar Lampung', 'Tanjung Raja', '2015-06-17', 'Masjuita', 'Laki-Laki', 'ISLAM', 'Menikah', 'PNS', 'Jl Waru No 21 Antasari Bandar Lampung', '2', '1'),
(7, 'Mahendra', '18129310112231', 'Mahendra', 'Mahendra', 'Mahendra', '2015-07-28', 'Mahendra', 'Laki-Laki', 'islam', 'Menikah', 'Mahendra', 'Mahendra', 'Mahendra', 'Mahendra');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE IF NOT EXISTS `pinjaman` (
  `id_pinjaman` int(10) NOT NULL AUTO_INCREMENT,
  `nik_costumer` varchar(50) NOT NULL,
  `no_kontrak` varchar(20) NOT NULL,
  `no_polisi` varchar(10) NOT NULL,
  `nilai_pinjaman` float NOT NULL,
  `angsuran_perbulan` float NOT NULL,
  `lama_angsuran` int(5) NOT NULL,
  `tanggal_jatuh_tempo` varchar(2) NOT NULL,
  PRIMARY KEY (`no_kontrak`),
  UNIQUE KEY `id_pinjaman` (`id_pinjaman`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `nik_costumer`, `no_kontrak`, `no_polisi`, `nilai_pinjaman`, `angsuran_perbulan`, `lama_angsuran`, `tanggal_jatuh_tempo`) VALUES
(159, '', '', '', 0, 0, 0, '07'),
(154, '1234-111-23-90', '29/MF/00001/15', 'BE-5064-JA', 20000000, 1901220, 12, '06'),
(155, '41112121111', '29/MF/00154/15', 'BE85', 123, 12, 12, '20'),
(157, '18129310112231', '30/MD/00156/15', 'AD-5064-JI', 2333, 33333, 12, '07'),
(156, '18129310112231', '30/MF/00155/15', 'AD-5064-JI', 300000000, 3000000, 12, '07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spb`
--

CREATE TABLE IF NOT EXISTS `spb` (
  `no_spb` int(50) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(50) NOT NULL,
  `no_polisi` varchar(50) NOT NULL,
  `nik_costumer` varchar(50) NOT NULL,
  PRIMARY KEY (`no_spb`),
  UNIQUE KEY `no_kontrak` (`no_kontrak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Dumping data untuk tabel `spb`
--

INSERT INTO `spb` (`no_spb`, `no_kontrak`, `no_polisi`, `nik_costumer`) VALUES
(122, '30/MF/00155/15', 'AD-5064-JI', '18129310112231');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) NOT NULL,
  `realname` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `create_at` date NOT NULL,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_cabang`, `realname`, `username`, `password`, `create_at`, `level`) VALUES
(15, 29, 'Riza Masta Saputra ', 'ommasta', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'kasir'),
(16, 29, 'Leo Masta Kusuma', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'superadmin'),
(17, 30, 'Rendi Proyoga', 'rendi', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'admin'),
(18, 30, 'Kasir Natar', 'kasir', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id_login` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `last_login` datetime NOT NULL,
  `login_time` datetime NOT NULL,
  `ip_login` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `user_login`
--

INSERT INTO `user_login` (`id_login`, `id_user`, `last_login`, `login_time`, `ip_login`, `status`) VALUES
(5, 16, '2015-07-05 23:25:44', '2015-07-05 23:49:32', '127.0.0.1', 0),
(6, 15, '2015-06-18 11:03:17', '2015-06-18 11:11:44', '172.17.3.234', 0),
(7, 17, '2015-07-05 23:25:44', '2015-07-06 01:21:09', '127.0.0.1', 0),
(10, 18, '2015-06-20 10:14:56', '2015-07-06 01:44:58', '127.0.0.1', 1);
