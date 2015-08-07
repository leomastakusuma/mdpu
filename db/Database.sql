-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 06 Agu 2015 pada 08.21
-- Versi Server: 10.0.20-MariaDB
-- Versi PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
('002', 'Natar', 'Sunaryo', 'Lampung', 'Lampung Selatan', 'Sukadana', 'Jl. Mawar 2  No. 123', '35138');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `telat` int(1) NOT NULL,
  `denda_terhitung` varchar(20) NOT NULL,
  `denda_dibayar` varchar(20) NOT NULL,
  `sisa_denda` varchar(20) NOT NULL,
  `tanggal_bayar_angsuran` date NOT NULL,
  `tanggal_bayar_denda` varchar(30) NOT NULL,
  PRIMARY KEY (`id_piutang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `tahun_pembuatan` date NOT NULL,
  `isi_silinder` varchar(50) NOT NULL,
  `tgl_stnk` date NOT NULL,
  `nik_costumer` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_kendaraan`),
  UNIQUE KEY `no_polisi` (`no_polisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_cabang`, `realname`, `username`, `password`, `create_at`, `level`) VALUES
(1, '001', 'Sri Rohayati', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'superadmin'),
(2, '001', 'Ega Obellia', 'kasirantasari', '978582b03b3e7d6f786e2821a7f67090fe09b58c', '2015-08-03', 'kasir'),
(3, '002', 'Fitria', 'kasirnatar', '560fd0580c4cd4f082e9906f17d0f37e3d783410', '2015-08-03', 'kasir'),
(4, '001', 'Dian Nova Arisanti', 'admantasari', '6f0502ef7596f6f988d273cfdcdd9c1b90dc8fb8', '2015-08-03', 'admin'),
(5, '002', 'Ria Heri Ruswanti', 'admnatar', '4174cd772cc17c8e42b679c43a0e5122ee656093', '2015-08-03', 'admin'),
(6, '001', 'Sisca', 'akuntansi', '81f66b30d3445399cdf8cd10072467c94351abb2', '2015-08-03', 'akuntan');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;