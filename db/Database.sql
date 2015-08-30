
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 30 Agu 2015 pada 11.29
-- Versi Server: 10.0.20-MariaDB
-- Versi PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `u529313763_mdpu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bb_penerimaan_kas`
--

CREATE TABLE IF NOT EXISTS `bb_penerimaan_kas` (
  `id_kas` int(5) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(20) NOT NULL,
  `no_kwitansi` varchar(20) NOT NULL,
  `angsuran_ke` int(2) NOT NULL,
  `angsuran` varchar(50) NOT NULL,
  `denda` varchar(50) NOT NULL,
  `biaya_tagih` varchar(50) NOT NULL,
  `bo` varchar(20) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data untuk tabel `bb_penerimaan_kas`
--

INSERT INTO `bb_penerimaan_kas` (`id_kas`, `no_kontrak`, `no_kwitansi`, `angsuran_ke`, `angsuran`, `denda`, `biaya_tagih`, `bo`, `discount`, `total`, `tgl_bayar`, `keterangan`) VALUES
(1, '001-MF-00001-15', '000001', 1, '625.000', '0,00', '625.000', 'Antasari', '0,00', '625.000', '2015-08-07', '-'),
(2, '001-MF-00001-15', '000002', 2, '625.000', '0,00', '625.000', 'Antasari', '20.000', '605.000', '2015-08-18', '-'),
(3, '001-MF-00001-15', '000003', 3, '625.000', '0,00', '625.000', 'Antasari', '20.000', '605.000', '2015-08-18', '-'),
(4, '001-MF-00001-15', '000005', 4, '625.000', '0,00', '625.000', 'Antasari', '20.000', '605.000', '2015-08-18', '-'),
(5, '001-MF-00001-15', '000007', 5, '625.000', '0,00', '625.000', 'Antasari', '20.000', '605.000', '2015-08-18', '-'),
(6, '001-MF-00001-15', '000009', 6, '625.000', '0,00', '625.000', 'Antasari', '20.000', '605.000', '2015-08-18', '-'),
(7, '001-MF-00001-15', '000010', 7, '625.000', '0,00', '625.000', 'Antasari', '20.000', '605.000', '2015-08-19', 'Cabang Natar'),
(8, '002-MF-00001-15', '000011', 1, '510.000', '0,00', '510.000', 'Natar', '0,00', '510.000', '2015-08-20', 'Cabang Antasari'),
(9, '002-MF-00001-15', '000012', 2, '510.000', '0,00', '510.000', 'Natar', '20.000', '490.000', '2015-08-20', '-'),
(12, '001-MF-00006-15', '000013', 1, '675.000', '0,00', '675.000', 'Antasari', '0,00', '675.000', '2015-08-21', '-'),
(13, '001-MF-00002-15', '000016', 1, '894.000', '5.364', '894.000', 'Antasari', '0,00', '899.364', '2015-08-21', '-'),
(14, '001-MF-00002-15', '000017', 2, '894.000', '0,00', '894.000', 'Antasari', '20.000', '874.000', '2015-08-21', '-'),
(15, '001-MF-00001-15', '000018', 8, '625.000', '0,00', '625.000', 'Antasari', '20.000', '605.000', '2015-08-29', '-'),
(16, '002-MF-00001-15', '000019', 3, '510.000', '0,00', '510.000', 'Natar', '20.000', '490.000', '2015-08-30', '-'),
(17, '001-MF-00003-15', '000020', 1, '472.000', '28.320', '472.000', 'Antasari', '0,00', '500.320', '2015-08-30', '-'),
(18, '001-MF-00002-15', '000021', 3, '894.000', '0,00', '894.000', 'Antasari', '20.000', '874.000', '2015-08-30', '-'),
(19, '001-MF-00002-15', '000022', 4, '894.000', '0,00', '894.000', 'Antasari', '20.000', '874.000', '2015-08-30', '-'),
(20, '001-MF-00002-15', '000023', 5, '894.000', '0,00', '894.000', 'Antasari', '20.000', '874.000', '2015-08-30', '-'),
(21, '001-MF-00003-15', '000025', 2, '472.000', '0,00', '472.000', 'Antasari', '20.000', '452.000', '2015-08-30', '-'),
(22, '001-MF-00003-15', '000026', 3, '472.000', '0,00', '472.000', 'Antasari', '20.000', '452.000', '2015-08-30', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bb_piutang`
--

CREATE TABLE IF NOT EXISTS `bb_piutang` (
  `id_piutang` int(11) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `debit` varchar(50) NOT NULL,
  `kredit` varchar(50) NOT NULL,
  `saldo` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_piutang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `bb_piutang`
--

INSERT INTO `bb_piutang` (`id_piutang`, `no_kontrak`, `nama`, `debit`, `kredit`, `saldo`, `tanggal`) VALUES
(1, '001-MF-00001-15', 'Raka Rizky Ramadhan', '1.875.000', '', '1.875.000', '2015-08-29'),
(2, '002-MF-00001-15', 'Ria Heri Ruswanti', '4.080.000', '', '4.080.000', '2015-08-30'),
(4, '001-MF-00006-15', 'Yudi Suyitno', '2.700.000', '', '2.700.000', '2015-08-21'),
(5, '001-MF-00002-15', 'Leo Masta Kusuma', '5.364.000', '', '5.364.000', '2015-08-30'),
(6, '001-MF-00003-15', 'Riza Masta Saputra', '2.832.000', '', '2.832.000', '2015-08-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE IF NOT EXISTS `cabang` (
  `id_cabang` varchar(10) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `kepala_cabang` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` varchar(7) NOT NULL,
  PRIMARY KEY (`id_cabang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `cabang`, `kepala_cabang`, `provinsi`, `kota`, `kecamatan`, `alamat`, `kode_pos`) VALUES
('001', 'Antasari', 'Subaidi', 'Lampung', 'Bandar Lampung', 'Kedamaian', 'Jl. Pangeran Antasari No. 1', '35133'),
('002', 'Natar', 'Sunaryo', 'Lampung', 'Lampung Selatan', 'Sukadana', 'Jl. Mawar 2  No. 123', '35138'),
('003', 'Metro', 'Tri Utomo', 'Lampung', 'Lampung Tengah', 'Seputih Raman', 'Jl. Merdeka Km 20 ', '56756 ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `costumer`
--

CREATE TABLE IF NOT EXISTS `costumer` (
  `id_costumer` int(50) NOT NULL AUTO_INCREMENT,
  `nik_costumer` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat_tempat_kerja` text NOT NULL,
  `hp` varchar(15) NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cabang` varchar(3) NOT NULL,
  `npwp` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kode_pos` varchar(7) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `penghasilan_perbulan` varchar(20) NOT NULL,
  `jumlah_tanggungan` int(3) NOT NULL,
  PRIMARY KEY (`id_costumer`),
  UNIQUE KEY `nik_costumer` (`nik_costumer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `costumer`
--

INSERT INTO `costumer` (`id_costumer`, `nik_costumer`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `jenis_kelamin`, `agama`, `status`, `pekerjaan`, `alamat_tempat_kerja`, `hp`, `telpon`, `id_user`, `id_cabang`, `npwp`, `kota`, `kode_pos`, `provinsi`, `penghasilan_perbulan`, `jumlah_tanggungan`) VALUES
(1, '1871121711550003', 'Raka Rizky Ramadhan', 'Jl. Pangeran Antasari Gg. Waru II No. 25', 'Bandar Lampung', '1955-11-17', 'Sri Wahyuningsih', 'laki-laki', 'ISLAM', 'menikah', 'Wiraswasta', 'Jl. Pangeran Antasari Gg. Waru II No. 25', '081367549835', '0721-705303', 4, '001', '123456789', 'Bandar Lampung', '35133', 'Lampung', '5000000', 3),
(2, '1234567890987654', 'Ria Heri Ruswanti', 'Jl. Z.A. Pagar Alam No 70 Bandar Lampung', 'Bandar Lampung', '1994-01-31', 'Dwi Maila Pauristina', 'perempuan', 'islam', 'belummenikah', 'Notaris', 'Jl. Z.A. Pagar Alam No 70 Bandar Lampung', '085645389754', '', 5, '002', '987456438', 'Bandar Lampung', '35138', 'Lampung', '7000000', 0),
(3, '9875431654765432', 'Leo Masta Kusuma', 'Jl. Radio 1 No. 21 Bandar Lampung', 'Tanjung Raja', '1990-06-23', 'Masjuita', 'laki-laki', 'islam', 'menikah', 'Programer', 'Jl. Radio 1 No. 21 Bandar Lampung', '081256738976', '0721-701113', 4, '001', '347542797643', 'Bandar Lampung', '35133', 'Lampung', '5000000', 1),
(4, '8765438907654327', 'Riza Masta Saputra', 'Jl. Vila Sakura No. 1 Bandar Lampung', 'Tanjung Raja', '1992-03-29', 'Masjuita', 'laki-laki', 'islam', 'menikah', 'Programer', 'Jl. Vila Sakura No. 1 Bandar Lampung', '089754367854', '', 4, '001', '', 'Bandar Lampung', '56744', 'Lampung', '4000000', 2),
(5, '9765236789654328', 'Aprila Wahyuni', 'Jl. Kimaja No. 1 Bandar Lampung', 'Bandar Lampung', '1994-04-20', 'Feni Hartati', 'perempuan', 'islam', 'belummenikah', 'Karyawan', 'PT ABC', '081367342398', '', 5, '002', '', 'Bandar Lampung', '35138', 'Lampung', '3000000', 0),
(6, '9856427865432876', 'Yuni Arwati', 'Jl. Soekarno Hatta No. 100', 'Bandar Lampung', '1994-04-13', 'Melati', 'perempuan', 'islam', 'belummenikah', 'Karyawan', 'PT XYZ', '089759732567', '', 5, '002', '', 'Bandar Lampung', '', 'Lampung', '2500000', 0),
(7, '9867542198076536', 'Yudi Suyitno', 'Jl. Pangeran Antasari No. 90', 'Bandar Lampung', '1993-08-16', 'Sulis Tia Noviani', 'laki-laki', 'islam', 'belummenikah', 'Karyawan', 'Jl. Soekarno Hatta No. 009', '089656234509', '', 4, '001', '', '', '35133', 'Lampung', '4500000', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kartu_piutang`
--

CREATE TABLE IF NOT EXISTS `kartu_piutang` (
  `id_piutang` int(11) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(20) NOT NULL,
  `no_kwitansi` varchar(20) NOT NULL,
  `angsuran_ke` int(2) NOT NULL,
  `tagihan` varchar(20) NOT NULL,
  `pembayaran` varchar(20) NOT NULL,
  `potongan` varchar(20) NOT NULL,
  `telat` int(3) NOT NULL,
  `denda_terhitung` varchar(20) NOT NULL,
  `denda_dibayar` varchar(20) NOT NULL,
  `sisa_denda` varchar(20) NOT NULL,
  `tanggal_bayar_angsuran` date NOT NULL,
  `tanggal_bayar_denda` varchar(30) NOT NULL,
  PRIMARY KEY (`id_piutang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data untuk tabel `kartu_piutang`
--

INSERT INTO `kartu_piutang` (`id_piutang`, `no_kontrak`, `no_kwitansi`, `angsuran_ke`, `tagihan`, `pembayaran`, `potongan`, `telat`, `denda_terhitung`, `denda_dibayar`, `sisa_denda`, `tanggal_bayar_angsuran`, `tanggal_bayar_denda`) VALUES
(1, '001-MF-00001-15', '000001', 1, '625.000', '625.000', '0,00', 0, '0,00', '0,00', '0,00', '2015-08-07', '-'),
(2, '001-MF-00001-15', '000002', 2, '625.000', '625.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-18', '-'),
(3, '001-MF-00001-15', '000003', 3, '625.000', '625.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-18', '-'),
(4, '001-MF-00001-15', '000005', 4, '625.000', '625.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-18', '-'),
(5, '001-MF-00001-15', '000007', 5, '625.000', '625.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-18', '-'),
(6, '001-MF-00001-15', '000009', 6, '625.000', '625.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-18', '-'),
(7, '001-MF-00001-15', '000010', 7, '625.000', '625.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-19', '-'),
(8, '002-MF-00001-15', '000011', 1, '510.000', '510.000', '0,00', 0, '0,00', '0,00', '0,00', '2015-08-20', '-'),
(9, '002-MF-00001-15', '000012', 2, '510.000', '510.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-20', '-'),
(12, '001-MF-00006-15', '000013', 1, '675.000', '675.000', '0,00', 0, '0,00', '0,00', '0,00', '2015-08-21', '-'),
(13, '001-MF-00002-15', '000016', 1, '894.000', '894.000', '0,00', 1, '5.364', '5.364', '0,00', '2015-08-21', '2015-08-21 11:54:42'),
(14, '001-MF-00002-15', '000017', 2, '894.000', '894.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-21', '-'),
(15, '001-MF-00001-15', '000018', 8, '625.000', '625.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-29', '-'),
(16, '002-MF-00001-15', '000019', 3, '510.000', '510.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-30', '-'),
(17, '001-MF-00003-15', '000020', 1, '472.000', '472.000', '0,00', 10, '28.320', '28.320', '0,00', '2015-08-30', '2015-08-30 05:02:36'),
(18, '001-MF-00002-15', '000021', 3, '894.000', '894.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-30', '-'),
(19, '001-MF-00002-15', '000022', 4, '894.000', '894.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-30', '-'),
(20, '001-MF-00002-15', '000023', 5, '894.000', '894.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-30', '-'),
(21, '001-MF-00003-15', '000025', 2, '472.000', '472.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-30', '-'),
(22, '001-MF-00003-15', '000026', 3, '472.000', '472.000', '20.000', 0, '0,00', '0,00', '0,00', '2015-08-30', '-');

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
  `warna` varchar(50) NOT NULL,
  `tahun_pembuatan` varchar(4) NOT NULL,
  `isi_silinder` varchar(50) NOT NULL,
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
(1, 'BE-4613-YQ', 'H-05301615F', 'Suti Supriati', 'Jl. PAngeran Antasari Gg. Waru II No. 24', 'Honda / NC110A1C A/T', 'JF81E-1080843', 'MH1JF8112AK080135', 'Merah Silver', '2010', '110 cc', '2015-11-24', '1871121711550003', 'kredit'),
(2, 'BE-8525-CB', '6671381F', 'Dwi Maila Pauristina', 'Jl. Z.A. Pagar Alam No. 70', 'Honda/NF125S', 'JB41E-1026769', 'MH1JB411X5K026821', 'Biru Silver', '2005', '125cc', '2025-11-20', '1234567890987654', 'kredit'),
(3, 'BE-7113-LS', '701113701120LS', 'Leo Masta Kusuma', 'Jl. Radio 1 No. 21 Bandar Lampung', 'Suzuki/SatriaFu', 'JH87-65398588', 'SZ6989557474', 'Kuning', '2012', '150cc', '2017-08-17', '9875431654765432', 'kredit'),
(4, 'BE-7374-RN', '6786543G', 'Riza Masta Saputra', 'Jl. Vila Sakura No. 1 Bandar Lamppun', 'Yamaha Mio GT', 'YM78-54321678', '6549873467RF', 'Merah Hitam', '2010', '125cc', '2015-12-31', '8765438907654327', 'kredit'),
(5, 'BE-2345-AT', '768435683213AT', 'Tri Utami Rahayu', 'Jl. Kimaja No. 1 Bandar LAmpung', 'Honda/Beat', 'HB23-123908675', 'MH1JB7586947883', 'Merah', '2015', '125cc', '2020-06-01', '9765236789654328', 'kredit'),
(6, 'BE-9090-KL', '675463D', 'Yuni Arwati', 'Jl. Soekarna Hatta No. 100 Bandar Lampung', 'Honda/Scoopy', 'JF67E-9875327', 'MH1HJ1236655', 'Putih', '2015', '125cc', '2020-12-31', '9856427865432876', 'kredit'),
(7, 'BE-7051-MY', '374683639HJ', 'Yudi Suyitno', 'Jl. Pangeran Antasari No. 90', 'Yamaha / Mio J', 'MH1JB-84749354', '2475492570070F', 'Putih Bitu', '2010', '125cc', '2015-10-22', '9867542198076536', 'kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `tanggal_pembayaran`, `no_kwitansi`, `no_kontrak`, `angsuran_ke`, `angsuran_perbulan`, `denda`, `potongan`, `total_bayar`) VALUES
(1, '2015-08-07', '000001', '001-MF-00001-15', 1, '625.000', '0,00', '0,00', '625.000'),
(2, '2015-08-18', '000002', '001-MF-00001-15', 2, '625.000', '0,00', '20.000', '605.000'),
(4, '2015-08-18', '000003', '001-MF-00001-15', 3, '625.000', '0,00', '20.000', '605.000'),
(6, '2015-08-18', '000005', '001-MF-00001-15', 4, '625.000', '0,00', '20.000', '605.000'),
(8, '2015-08-18', '000007', '001-MF-00001-15', 5, '625.000', '0,00', '20.000', '605.000'),
(9, '2015-08-18', '000009', '001-MF-00001-15', 6, '625.000', '0,00', '20.000', '605.000'),
(10, '2015-08-19', '000010', '001-MF-00001-15', 7, '625.000', '0,00', '20.000', '605.000'),
(11, '2015-08-20', '000011', '002-MF-00001-15', 1, '510.000', '0,00', '0,00', '510.000'),
(12, '2015-08-20', '000012', '002-MF-00001-15', 2, '510.000', '0,00', '20.000', '490.000'),
(15, '2015-08-21', '000013', '001-MF-00006-15', 1, '675.000', '0,00', '0,00', '675.000'),
(16, '2015-08-21', '000016', '001-MF-00002-15', 1, '894.000', '5.364', '0,00', '899.364'),
(17, '2015-08-21', '000017', '001-MF-00002-15', 2, '894.000', '0,00', '20.000', '874.000'),
(18, '2015-08-29', '000018', '001-MF-00001-15', 8, '625.000', '0,00', '20.000', '605.000'),
(19, '2015-08-30', '000019', '002-MF-00001-15', 3, '510.000', '0,00', '20.000', '490.000'),
(20, '2015-08-30', '000020', '001-MF-00003-15', 1, '472.000', '28.320', '0,00', '500.320'),
(21, '2015-08-30', '000021', '001-MF-00002-15', 3, '894.000', '0,00', '20.000', '874.000'),
(22, '2015-08-30', '000022', '001-MF-00002-15', 4, '894.000', '0,00', '20.000', '874.000'),
(24, '2015-08-30', '000023', '001-MF-00002-15', 5, '894.000', '0,00', '20.000', '874.000'),
(25, '2015-08-30', '000025', '001-MF-00003-15', 2, '472.000', '0,00', '20.000', '452.000'),
(26, '2015-08-30', '000026', '001-MF-00003-15', 3, '472.000', '0,00', '20.000', '452.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjamin`
--

CREATE TABLE IF NOT EXISTS `penjamin` (
  `id_penjamin` int(50) NOT NULL AUTO_INCREMENT,
  `nik_penjamin` varchar(50) NOT NULL,
  `nik_costumer` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
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
(1, '1871125411590003', '1871121711550003', 'Shellya Ariani', 'Jl. Pangeran Antasari Gg. Waru II No. 25', 'Bandar Lampung', '1959-11-14', 'Riana Septiani', 'Peremuan', 'islam', 'Menikah', 'PNS', 'Jl. Pangeran Antasari Gg. Waru I No. 1', '085678234562', '0721-705303'),
(2, '1234976437896542', '1234567890987654', 'Dian Nova Arisanti', 'Jl. Z.A. Pagar Alam No. 70 Bandar Lampung', 'Bandar Lampung', '1989-11-17', 'Dwi Maila Pauristina', 'Peremuan', 'islam', 'Belum Menikah', 'Wiraswasta', 'Jl. R.A Kartini No. 123', '081298764567', ''),
(3, '9873456321987654', '9875431654765432', 'Sri Rohayati', 'Jl. Radio 1 No. 21 Bandar Lampung', 'Bandar Lampung', '1994-05-21', 'Suti Supriati', 'Peremuan', 'islam', 'Menikah', 'Ibu Rumah Tangga', 'Jl. Radio 1 No. 21 Bandar Lampung', '08975418522', ''),
(4, '9876543278965437', '8765438907654327', 'Nurlaila ', 'Jl. Vila Sakura No.1 Bandar Lampung', 'Pringsewu', '1992-02-14', 'Mentari', 'Peremuan', 'islam', 'Menikah', 'Ibu Rumah Tangga', 'Jl. Vila Sakura No.1 Bandar Lampung', '089645632189', ''),
(5, '9872345617239585', '9765236789654328', 'Tri Utami Rahayu', 'Jl. Kimaja No. 1', 'Bandar Lampung', '1994-07-27', 'Feni Hartati', 'Peremuan', 'islam', 'Belum Menikah', 'Karyawan', 'PT ABC', '085765389765321', ''),
(6, '9864329076543876', '9856427865432876', 'Yuni Oktaviani', 'Jl. Soekarna Hatta No. 100 Bandar Lampung', 'Bandar Lampung', '1993-10-18', 'Melati', 'Peremuan', 'islam', 'Belum Menikah', 'Wiraswasta', 'Jl. Soekarna Hatta No. 100 Bandar Lampung', '085609432789', ''),
(7, '9846381298065389', '9867542198076536', 'Sukatno', 'Jl. Pangeran Antasari No. 90', 'Bandar Lampung', '1970-12-16', 'Sulis Tia Noviani', 'Laki-Laki', 'islam', 'Menikah', 'Wiraswasta', 'Jl. Pangeran Antasari No. 90', '081378632987', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
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
  `tanggal` varchar(20) NOT NULL,
  PRIMARY KEY (`no_kontrak`),
  UNIQUE KEY `id_pinjaman` (`id_pinjaman`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `nik_costumer`, `no_kontrak`, `no_polisi`, `nilai_pinjaman`, `angsuran_perbulan`, `lama_angsuran`, `tanggal_jatuh_tempo`, `tanggal`) VALUES
(1, '1871121711550003', '001-MF-00001-15', 'BE-4613-YQ', '5.000.000', '625.000', 11, '07', '2015-08-07'),
(3, '9875431654765432', '001-MF-00002-15', 'BE-7113-LS', '7.000.000', '894.000', 11, '20', '2015-08-20'),
(4, '8765438907654327', '001-MF-00003-15', 'BE-7374-RN', '3.000.000', '472.000', 9, '20', '2015-08-20'),
(7, '9867542198076536', '001-MF-00006-15', 'BE-7051-MY', '2.500.000', '675.000', 5, '21', '2015-08-21'),
(2, '1234567890987654', '002-MF-00001-15', 'BE-8525-CB', '4.000.000', '510.000', 11, '20', '2015-08-20'),
(5, '9765236789654328', '002-MF-00004-15', 'BE-2345-AT', '3.500.000', '450.000', 11, '20', '2015-08-20'),
(6, '9856427865432876', '002-MF-00005-15', 'BE-9090-KL', '2.000.000', '272.000', 11, '20', '2015-08-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spb`
--

CREATE TABLE IF NOT EXISTS `spb` (
  `no_spb` int(50) NOT NULL AUTO_INCREMENT,
  `no_kontrak` varchar(50) NOT NULL,
  `no_polisi` varchar(50) NOT NULL,
  `nik_costumer` varchar(50) NOT NULL,
  `create_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`no_spb`),
  UNIQUE KEY `no_kontrak` (`no_kontrak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `spb`
--

INSERT INTO `spb` (`no_spb`, `no_kontrak`, `no_polisi`, `nik_costumer`, `create_at`, `modified_at`) VALUES
(1, '001-MF-00001-15', 'BE-4613-YQ', '1871121711550003', '2015-08-26 11:39:09', '2015-08-30 10:41:58'),
(2, '001-MF-00002-15', 'BE-7113-LS', '9875431654765432', '2015-08-29 13:00:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `id_cabang` varchar(3) NOT NULL,
  `realname` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `create_at` date NOT NULL,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_cabang`, `realname`, `username`, `password`, `create_at`, `level`) VALUES
(1, '001', 'Sri Rohayati', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'superadmin'),
(3, '002', 'Fitria', 'kasirnatar', '560fd0580c4cd4f082e9906f17d0f37e3d783410', '2015-08-03', 'kasir'),
(4, '001', 'Silviana', 'admantasari', '6f0502ef7596f6f988d273cfdcdd9c1b90dc8fb8', '2015-08-03', 'admin'),
(5, '002', 'Erlia Agustina', 'admnatar', '4174cd772cc17c8e42b679c43a0e5122ee656093', '2015-08-03', 'admin'),
(6, '001', 'Sisca', 'akuntansi', '81f66b30d3445399cdf8cd10072467c94351abb2', '2015-08-03', 'akuntan'),
(8, '001', 'Ega Obellia', 'kasirantasari', '978582b03b3e7d6f786e2821a7f67090fe09b58c', '2015-08-07', 'kasir'),
(9, '001', 'Subaidi', 'pimpinanantasari', '5f2c370b25610fc70ca44d155e595c6caf359ca0', '2015-08-29', 'pimpinan'),
(10, '002', 'Sunaryo', 'pimpinannatar', '82737b7b8ba096bf9ab875c9e10fcd33deffeda8', '2015-08-29', 'pimpinan');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `user_login`
--

INSERT INTO `user_login` (`id_login`, `id_user`, `last_login`, `login_time`, `ip_login`, `status`) VALUES
(9, 1, '2015-08-30 02:06:27', '2015-08-30 02:36:31', '114.79.36.124', 0),
(10, 6, '2015-08-30 05:52:51', '2015-08-30 10:39:12', '114.79.33.193', 0),
(11, 8, '2015-08-30 05:41:30', '2015-08-30 10:32:19', '114.79.36.193', 0),
(12, 3, '2015-08-27 12:29:33', '2015-08-30 04:57:18', '114.79.36.197', 0),
(13, 4, '2015-08-30 10:41:52', '2015-08-30 10:47:01', '114.79.36.193', 0),
(14, 9, '2015-08-30 05:54:43', '2015-08-30 10:35:58', '114.79.33.193', 0),
(15, 10, '2015-08-29 08:20:51', '2015-08-30 06:05:55', '114.79.33.97', 0),
(16, 5, '2015-08-29 07:54:40', '2015-08-29 07:54:40', '116.68.171.166', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;