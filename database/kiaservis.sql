-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 07. September 2018 jam 17:13
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kiaservis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` varchar(15) NOT NULL,
  `nm_barang` varchar(200) NOT NULL,
  `harga_beli` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `diskon` int(3) NOT NULL,
  `stok` int(3) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `harga_beli`, `harga_jual`, `diskon`, `stok`) VALUES
('K1', 'CONTOH', 10000, 300000, 20, 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasaservice`
--

CREATE TABLE IF NOT EXISTS `jasaservice` (
  `kd_jasa` varchar(15) NOT NULL,
  `nama_jasa` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `diskon` int(3) NOT NULL,
  PRIMARY KEY (`kd_jasa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jasaservice`
--

INSERT INTO `jasaservice` (`kd_jasa`, `nama_jasa`, `harga`, `diskon`) VALUES
('J1', 'CONTOH', 200000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `no_polisi` varchar(12) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `tipe_kendaraan` varchar(35) NOT NULL,
  `no_rangka` varchar(20) NOT NULL,
  `no_mesin` varchar(12) NOT NULL,
  PRIMARY KEY (`no_polisi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`no_polisi`, `nm_pelanggan`, `alamat`, `kota`, `telp`, `tipe_kendaraan`, `no_rangka`, `no_mesin`) VALUES
('B6164VOE', 'CONTOH', 'CONTOH', 'CONTOH', '021XXXXXXX', 'GALLARDO', 'XXX', 'XXX');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tekhnisi`
--

CREATE TABLE IF NOT EXISTS `tekhnisi` (
  `kd_tekhnisi` varchar(10) NOT NULL,
  `nm_tekhnisi` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_tekhnisi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tekhnisi`
--

INSERT INTO `tekhnisi` (`kd_tekhnisi`, `nm_tekhnisi`) VALUES
('T1', 'CONTOH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_transaksi`
--

CREATE TABLE IF NOT EXISTS `tmp_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `diskon` int(3) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `jenis_transaksi` varchar(20) NOT NULL,
  `id_session` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `tmp_transaksi`
--

INSERT INTO `tmp_transaksi` (`id`, `kode`, `nama`, `harga`, `diskon`, `jumlah`, `jenis_transaksi`, `id_session`) VALUES
(7, '', 'CONTOH', 0, 20, 0, 'Service', '04lef3uo3sgst4198kf9g8a8b7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `no_invoice` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `kd_tekhnisi` varchar(10) NOT NULL,
  `no_polisi` varchar(12) NOT NULL,
  `userid` varchar(20) NOT NULL,
  PRIMARY KEY (`no_invoice`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`no_invoice`, `tanggal`, `kd_tekhnisi`, `no_polisi`, `userid`) VALUES
('1809000001', '2018-09-06', 'T1', 'B6164VOE', 'adminsuci'),
('1809000002', '2018-09-06', 'T1', 'B6164VOE', 'adminsuci'),
('1809000003', '2018-09-06', 'T1', 'B6164VOE', 'adminsuci'),
('1809000004', '2018-09-07', 'selected', '', 'adminsuci'),
('1809000005', '2018-09-07', 'T1', 'B6164VOE', 'adminsuci');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_item`
--

CREATE TABLE IF NOT EXISTS `transaksi_item` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `no_invoice` varchar(10) NOT NULL,
  `kode` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `diskon` int(3) NOT NULL,
  `jenis_transaksi` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `transaksi_item`
--

INSERT INTO `transaksi_item` (`id`, `no_invoice`, `kode`, `nama`, `harga`, `jumlah`, `diskon`, `jenis_transaksi`) VALUES
(1, '1809000004', '', 'CONTOH', 0, 9, 20, 'Service'),
(2, '1809000005', '', 'CONTOH', 0, 9, 20, 'Service');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` enum('kasir','admin') NOT NULL DEFAULT 'kasir',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `password`, `nama`, `level`) VALUES
('adminsuci', '21232f297a57a5a743894a0e4a801fc3', 'Suci - Admin 1', 'admin'),
('kasirsuci', 'c7911af3adbd12a035b289556d96470a', 'Suci - Kasir 1', 'kasir');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
