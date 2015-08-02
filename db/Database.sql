-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2015 at 10:37 PM
-- Server version: 5.6.19-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mdpu_finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `bb_penerimaan_kas`
--

CREATE TABLE IF NOT EXISTS `bb_penerimaan_kas` (
  `id_kas` int(5) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(20) NOT NULL,
  `no_kwitansi` varchar(20) NOT NULL,
  `angsuran_ke` int(2) NOT NULL,
  `angsuran` varchar(50) NOT NULL,
  `denda` varchar(50) NOT NULL,
  `biaya_tagih` varchar(50) NOT NULL,
  `bo` varchar(200) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bb_penerimaan_kas`
--

INSERT INTO `bb_penerimaan_kas` (`id_kas`, `no_kontrak`, `no_kwitansi`, `angsuran_ke`, `angsuran`, `denda`, `biaya_tagih`, `bo`, `discount`, `total`, `tgl_bayar`, `keterangan`) VALUES
(1, '29-MD-00162-15', 'KW-00001-08-15', 1, '500.000', '0,00', '500.000', 'Natar', '500.000', '500.000', '2015-08-02', 'Cabang Lain'),
(2, '29-MD-00162-15', 'KW-00002-08-15', 2, '500.000', '0,00', '500.000', 'Natar', '500.000', '480.000', '2015-08-02', 'Cabang Lain'),
(3, '29-MD-00162-15', 'KW-00003-08-15', 3, '500.000', '0,00', '500.000', 'Natar', '500.000', '480.000', '2015-08-02', 'Cabang Lain'),
(4, '29-MD-00162-15', 'KW-00004-08-15', 4, '500.000', '0,00', '500.000', 'Natar', '500.000', '480.000', '2015-08-02', 'Cabang Lain'),
(5, '29-MD-00162-15', 'KW-00004-08-15', 4, '500.000', '0,00', '500.000', 'Natar', '20.000', '480.000', '2015-08-02', 'Cabang Lain');

-- --------------------------------------------------------

--
-- Table structure for table `bb_piutang`
--

CREATE TABLE IF NOT EXISTS `bb_piutang` (
  `id_piutang` int(11) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `debit` varchar(50) NOT NULL,
  `kredit` varchar(50) NOT NULL,
  `saldo` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_piutang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bb_piutang`
--

INSERT INTO `bb_piutang` (`id_piutang`, `no_kontrak`, `nama`, `debit`, `kredit`, `saldo`, `tanggal`) VALUES
(2, '29-MD-00162-15', 'Iskandar Parta Dinata', '500.000', '', '2.500.000', '2015-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
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
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `cabang`, `kepala_cabang`, `provinsi`, `kota`, `kecamatan`, `alamat`, `kode_pos`) VALUES
(29, 'Antasari', 'SRI ROHAYATI, S.Kom, Mp.di', 'Lampung', 'Antasari', 'Waru', 'Jl Pangen Antasari No 20', '12310 '),
(30, 'Natar', 'Raka', 'Lampung', 'Lampung Selatan', 'Natar', 'Jl Panjang Lampung km 21 ', '23112  ');

-- --------------------------------------------------------

--
-- Table structure for table `costumer`
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
-- Dumping data for table `costumer`
--

INSERT INTO `costumer` (`id_costumer`, `nik_costumer`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `jenis_kelamin`, `agama`, `status`, `pekerjaan`, `alamat_tempat_kerja`, `hp`, `telpon`, `id_user`, `id_cabang`) VALUES
(1, '11-212-312-31211', 'Riza Masta Saputra', 'Jl Waru No 21 Antasari Bandar Lampung', 'Tanjung Raja', '2015-06-17', 'Masjuita', 'laki-laki', 'ISLAM', 'belummenikah', 'PNS', 'Jl Waru No 21 Antasari Bandar Lampung', '8123123123', '123123', 16, 29),
(2, '112-1-2-3-12312113', 'Leo Masta Kusuma', 'Jl Radio 1 No 21 Kebayoran Baru Jakarta Selatan', 'Tanjung Raja', '1990-06-23', 'Majuita', 'perempuan', 'ISLAM', 'menikah', 'Swasta', 'Jl Radio 1 No 21 Kebayoran Baru Jakarta Selatan', '0812311111', '123', 16, 29),
(3, '41112121111', 'Aldhonie Saputra', 'Metro', 'Metro', '2015-04-13', 'MARSYA', 'pria', 'islam', 'menikah', 'IT Helpdesk', 'Test Test Test ', '0812312312', '021211111', 15, 29),
(7, '1234-111-23-90', 'Rendi Prayoga', 'Jl Sri Menanti No 21 Tanjung Raja Lampung Utara', 'Tanjung Raja', '2002-04-14', 'Masjuita', 'pria', 'islam', 'belummenikah', 'Pelajar', 'Jalan Simatupang', '0812311111', '021211111', 15, 29),
(8, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0),
(9, '18129310112231', 'Iskandar Parta Dinata', 'Lampung', 'Lampung', '2015-07-22', 'Lampung', 'pria', 'islam', 'menikah', 'Lampung', 'Lampung', '1234555', '22121212', 17, 30);

-- --------------------------------------------------------

--
-- Table structure for table `kartu_piutang`
--

CREATE TABLE IF NOT EXISTS `kartu_piutang` (
  `id_piutang` int(11) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(20) NOT NULL,
  `no_kwitansi` varchar(20) NOT NULL,
  `angsuran_ke` int(2) NOT NULL,
  `tagihan` varchar(20) NOT NULL,
  `pembayaran` varchar(20) NOT NULL,
  `potongan` varchar(20) NOT NULL,
  `telat` int(1) NOT NULL,
  `denda_terhitung` varchar(20) NOT NULL,
  `denda_dibayar` varchar(20) NOT NULL,
  `sisa_denda` varchar(20) NOT NULL,
  `tanggal_bayar_angsuran` date NOT NULL,
  `tanggal_bayar_denda` varchar(30) NOT NULL,
  PRIMARY KEY (`id_piutang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kartu_piutang`
--

INSERT INTO `kartu_piutang` (`id_piutang`, `no_kontrak`, `no_kwitansi`, `angsuran_ke`, `tagihan`, `pembayaran`, `potongan`, `telat`, `denda_terhitung`, `denda_dibayar`, `sisa_denda`, `tanggal_bayar_angsuran`, `tanggal_bayar_denda`) VALUES
(1, '29-MD-00162-15', 'KW-00001-08-15', 1, '500.000', '500.000', '0,00', 0, '0,00', '0,00', '0,00', '2015-08-02', '-'),
(2, '29-MD-00162-15', 'KW-00002-08-15', 2, '500.000', '500.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-02', '-'),
(3, '29-MD-00162-15', 'KW-00003-08-15', 3, '500.000', '500.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-02', '-'),
(4, '29-MD-00162-15', 'KW-00004-08-15', 4, '500.000', '500.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-02', '-'),
(5, '29-MD-00162-15', 'KW-00004-08-15', 4, '500.000', '500.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-02', '-');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `no_polisi`, `no_bpkb`, `nama_bpkb`, `alamat`, `merk`, `no_mesin`, `no_rangka`, `warna`, `tahun_pembuatan`, `isi_silinder`, `tgl_stnk`, `nik_costumer`, `status`) VALUES
(1, '51214', '51214a51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a51214a', '51214a51214a', '51214a51214a', '2015-06-29', 'protected', '2015-06-29', '1121231231211', 'new'),
(2, 'BE85', '012314121879287498341431231', 'Sri Rohayati', 'Jl Waru Antarasi', 'Test', '788hjgt64sdsdg5ds', '788hjgt64sdsdg5ds', 'hitam', '2014-06-10', 'kjlkj', '2014-08-20', '41112121111', 'new'),
(3, 'BE123', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', '2015-06-23', 'BE1234GJ', '2015-06-30', '11212', 'new'),
(5, 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', '2015-06-29', 'qweq', '2015-06-29', '1121231231211', 'new'),
(6, 'BE-5064-JA', 'bkp', 'bkp', 'BE-5064-JA', 'HONDA', 'BE-5064-JA1', 'BE-5064-JA', 'Hitam', '2015-06-23', 'BE-5064-JA', '2015-06-22', '1234-111-23-90', 'new'),
(7, 'AD-5064-JI', '123451111111', 'Iskandar Parta', 'Jl Jauh gang semping', 'Honda', '01231111', '122212221222122212221222', 'Hitam Metal', '2015-02-11', '250 cc', '2015-07-22', '18129310112231', 'Lunas'),
(8, 'DD-101-AK', '081234123123123', 'Andri Aja', 'Jalan Selamet Merdeka', 'Yamaha', '0812-121-111111', '0812-121-1111110812-121-111111', 'Merah', '2015-06-23', '250 cc', '2015-06-22', '11-212-31231211', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` int(5) NOT NULL AUTO_INCREMENT,
  `tanggal_pembayaran` date NOT NULL,
  `no_kwitansi` varchar(20) NOT NULL,
  `no_kontrak` varchar(20) NOT NULL,
  `angsuran_ke` int(3) NOT NULL,
  `angsuran_perbulan` varchar(20) NOT NULL,
  `denda` varchar(20) NOT NULL,
  `potongan` varchar(50) NOT NULL,
  `total_bayar` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pembayaran`),
  UNIQUE KEY `no_kwitansi_2` (`no_kwitansi`),
  KEY `no_kwitansi` (`no_kwitansi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `tanggal_pembayaran`, `no_kwitansi`, `no_kontrak`, `angsuran_ke`, `angsuran_perbulan`, `denda`, `potongan`, `total_bayar`) VALUES
(1, '2015-08-02', 'KW-00001-08-15', '29-MD-00162-15', 1, '500.000', '0,00', '0,00', '500.000'),
(2, '2015-08-02', 'KW-00002-08-15', '29-MD-00162-15', 2, '500.000', '0,00', '20.000', '480.000'),
(3, '2015-08-02', 'KW-00003-08-15', '29-MD-00162-15', 3, '500.000', '0,00', '20.000', '480.000'),
(5, '2015-08-02', 'KW-00004-08-15', '29-MD-00162-15', 4, '500.000', '0,00', '20.000', '480.000');

-- --------------------------------------------------------

--
-- Table structure for table `penjamin`
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
-- Dumping data for table `penjamin`
--

INSERT INTO `penjamin` (`id_penjamin`, `nik_penjamin`, `nik_costumer`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `jenis_kelamin`, `agama`, `status`, `pekerjaan`, `alamat_tempat_kerja`, `hp`, `telpon`) VALUES
(5, '11-231221-23', '11-212-31231211', 'Riza Masta Saputra', 'Jl Waru No 21 Antasari Bandar Lampung', 'Tanjung Raja', '2015-06-17', 'Masjuita', 'Laki-Laki', 'ISLAM', 'Menikah', 'PNS', 'Jl Waru No 21 Antasari Bandar Lampung', '2', '1'),
(7, 'Mahendra', '18129310112231', 'Mahendra', 'Mahendra', 'Mahendra', '2015-07-28', 'Mahendra', 'Laki-Laki', 'islam', 'Menikah', 'Mahendra', 'Mahendra', 'Mahendra', 'Mahendra');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE IF NOT EXISTS `pinjaman` (
  `id_pinjaman` int(10) NOT NULL AUTO_INCREMENT,
  `nik_costumer` varchar(50) NOT NULL,
  `no_kontrak` varchar(20) NOT NULL,
  `no_polisi` varchar(10) NOT NULL,
  `nilai_pinjaman` varchar(20) NOT NULL,
  `angsuran_perbulan` varchar(20) NOT NULL,
  `lama_angsuran` int(5) NOT NULL,
  `tanggal_jatuh_tempo` varchar(2) NOT NULL,
  PRIMARY KEY (`no_kontrak`),
  UNIQUE KEY `id_pinjaman` (`id_pinjaman`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `nik_costumer`, `no_kontrak`, `no_polisi`, `nilai_pinjaman`, `angsuran_perbulan`, `lama_angsuran`, `tanggal_jatuh_tempo`) VALUES
(163, '18129310112231', '29-MD-00162-15', 'AD-5064-JI', '2.000.000', '500.000', 4, '26');

-- --------------------------------------------------------

--
-- Table structure for table `spb`
--

CREATE TABLE IF NOT EXISTS `spb` (
  `no_spb` int(50) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(50) NOT NULL,
  `no_polisi` varchar(50) NOT NULL,
  `nik_costumer` varchar(50) NOT NULL,
  PRIMARY KEY (`no_spb`),
  UNIQUE KEY `no_kontrak` (`no_kontrak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `spb`
--

INSERT INTO `spb` (`no_spb`, `no_kontrak`, `no_polisi`, `nik_costumer`) VALUES
(122, '30/MF/00155/15', 'AD-5064-JI', '18129310112231'),
(124, '29/MF/00154/15', 'BE85', '41112121111'),
(125, '30/MD/00156/15', 'AD-5064-JI', '18129310112231'),
(126, '29-MF-00154-15', 'BE85', '41112121111');

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_cabang`, `realname`, `username`, `password`, `create_at`, `level`) VALUES
(15, 29, 'Riza Masta Saputra ', 'ommasta', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'kasir'),
(16, 29, 'Leo Masta Kusuma', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'superadmin'),
(17, 30, 'Rendi Proyoga', 'rendi', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'admin'),
(18, 29, 'Kasir Natar', 'kasir', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'kasir'),
(19, 29, 'Sri Rohayati', 'akuntan', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-07-25', 'akuntan');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id_login` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `last_login` datetime NOT NULL,
  `login_time` datetime NOT NULL,
  `ip_login` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id_login`, `id_user`, `last_login`, `login_time`, `ip_login`, `status`) VALUES
(5, 16, '2015-07-27 13:55:48', '2015-08-02 20:24:46', '127.0.0.1', 0),
(6, 15, '2015-07-16 04:14:26', '2015-07-16 20:31:31', '127.0.0.1', 0),
(7, 17, '2015-07-16 21:28:17', '2015-07-25 14:09:46', '127.0.0.1', 0),
(10, 18, '2015-08-02 19:22:23', '2015-08-02 20:54:21', '127.0.0.1', 0),
(11, 19, '2015-08-02 21:05:08', '2015-08-02 22:15:43', '127.0.0.1', 1);
