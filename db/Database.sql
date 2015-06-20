-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2015 at 12:01 PM
-- Server version: 5.6.19-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mdpu_finance`
--

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
(30, 'Natar', 'OMMASTA, S.Kom JKT', 'Lampung', 'Lampung Selatan', 'Natar', 'Jl Panjang Lampung km 21 ', '23112 ');

-- --------------------------------------------------------

--
-- Table structure for table `costumer`
--

CREATE TABLE IF NOT EXISTS `costumer` (
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
  PRIMARY KEY (`nik_costumer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costumer`
--

INSERT INTO `costumer` (`nik_costumer`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `jenis_kelamin`, `agama`, `status`, `pekerjaan`, `alamat_tempat_kerja`, `hp`, `telpon`, `id_user`, `id_cabang`) VALUES
('1121231231211', 'Riza Masta Saputra', 'Jl Waru No 21 Antasari Bandar Lampung', 'Tanjung Raja', '2015-06-17', 'Masjuita', 'pria', 'islam', 'menikah', 'wiraswasta', 'Jl Waru No 21 Antasari Bandar Lampung', '8123123123', '123123', 16, 29),
('2147483647', 'Leo Masta Kusuma', 'Jl Radio 1 No 21 Kebayoran Baru Jakarta Selatan', 'Tanjung Raja', '1990-06-23', 'Majuita', '', 'islam', 'lajang', 'Swasta', 'Jl Radio 1 No 21 Kebayoran Baru Jakarta Selatan', '0812311111', '', 16, 29),
('41112121111', 'Aldhonie Saputra', 'Metro', 'Metro', '2015-04-13', 'MARSYA', 'pria', 'islam', 'menikah', 'IT Helpdesk', 'Test Test Test ', '0812312312', '021211111', 17, 30);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE IF NOT EXISTS `kendaraan` (
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
  PRIMARY KEY (`no_polisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`no_polisi`, `no_bpkb`, `nama_bpkb`, `alamat`, `merk`, `no_mesin`, `no_rangka`, `warna`, `tahun_pembuatan`, `isi_silinder`, `tgl_stnk`, `nik_costumer`) VALUES
('51214', '51214a51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a', '51214a51214a51214a51214a', '51214a51214a', '51214a51214a', '2015-06-29', 'protected', '2015-06-29', '1121231231211'),
('BE 85', '012314121879287498341431231', 'Sri Rohayati', 'Jl Waru Antarasi', 'Test', '788hjgt64sdsdg5ds', '788hjgt64sdsdg5ds', 'hitam', '2014-06-10', 'kjlkj', '2014-08-20', '41112121111'),
('BE123', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', 'BE1234GJ', '2015-06-23', 'BE1234GJ', '2015-06-30', '11212'),
('BE506', '1231231231232', 'Leo Masta Kusuma', '', 'Yahama', '801111111', '801111111', 'Hitam', '2009-06-24', '40cc', '2015-07-23', ''),
('qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', 'qweq', '2015-06-29', 'qweq', '2015-06-29', '1121231231211');

-- --------------------------------------------------------

--
-- Table structure for table `penjamin`
--

CREATE TABLE IF NOT EXISTS `penjamin` (
  `nik_costumer` varchar(50) NOT NULL,
  `nik_penjamin` varchar(50) NOT NULL,
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
  PRIMARY KEY (`nik_penjamin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjamin`
--

INSERT INTO `penjamin` (`nik_costumer`, `nik_penjamin`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `jenis_kelamin`, `agama`, `status`, `pekerjaan`, `alamat_tempat_kerja`, `hp`, `telpon`) VALUES
('asdasd', '11231221123', 'sqweq', 'we', 'weqwe', '2015-06-30', 'qweqwe', 'pria', 'islam', 'Menikah', 'qweqwe', 'qwe', 'qwe', 'qwe'),
('2147483647', '123123132123', 'Penjamin', 'Penjamin', 'Penjamin', '2015-06-23', 'Penjamin', 'Laki-Laki', 'budha', 'Menikah', 'Penjamin', 'Penjamin', 'Penjamin', 'Penjamin'),
('41112121111', '14123121111', 'Iskandar Parta Dinata', 'Jakarta Selatan', 'Krui', '2015-06-23', 'IBU NEGARA', 'Laki-Laki', 'islam', 'Belum Menikah', 'IT Helpdesk', 'Test', '0812311111', '021211111'),
('1121231231211', 'asdasd', 'asdasd', 'asdasd', 'asdasdasdasdasdasd', '2015-06-30', 'asdasdasdasd', 'pria', 'hindu', 'menikah', 'asdasd', 'asdasd', 'asdasd', 'asdasdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE IF NOT EXISTS `pinjaman` (
  `nik_costumer` int(11) NOT NULL,
  `no_kontrak` varchar(11) NOT NULL,
  `nilai_pinjaman` float NOT NULL,
  `angsuran_perbulan` float NOT NULL,
  `lama_angsuran` int(5) NOT NULL,
  PRIMARY KEY (`no_kontrak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spb`
--

CREATE TABLE IF NOT EXISTS `spb` (
  `no_spb` varchar(50) NOT NULL,
  `no_kontrak` varchar(50) NOT NULL,
  `no_polisi` varchar(50) NOT NULL,
  `nik_costumer` varchar(50) NOT NULL,
  PRIMARY KEY (`no_spb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_cabang`, `realname`, `username`, `password`, `create_at`, `level`) VALUES
(15, 29, 'Riza Masta Saputra ', 'ommasta', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'kasir'),
(16, 29, 'Leo Masta Kusuma', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'superadmin'),
(17, 30, 'Rendi Proyoga', 'rendi', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-19', 'admin'),
(18, 30, 'Kasir Natar', 'kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', '2015-06-19', 'kasir');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id_login`, `id_user`, `last_login`, `login_time`, `ip_login`, `status`) VALUES
(5, 16, '2015-06-20 10:51:19', '2015-06-20 11:30:28', '172.17.3.234', 1),
(6, 15, '2015-06-18 11:03:17', '2015-06-18 11:11:44', '172.17.3.234', 0),
(7, 17, '2015-06-20 10:29:31', '2015-06-20 10:30:38', '172.17.3.234', 0),
(10, 18, '2015-06-20 10:13:54', '2015-06-20 10:14:56', '172.17.3.234', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
