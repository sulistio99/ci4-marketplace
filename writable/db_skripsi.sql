-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2023 pada 15.33
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username`, `password`, `email`, `no_hp`, `alamat`, `foto`) VALUES
(1, 'Sulistio', 'sulistio', 'admin', 'admin@yahoo.com', '089635789232', 'Labakkang', 'foto.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('belum terjual','terjual','terkunci') NOT NULL,
  `deskripsi` text NOT NULL,
  `foto1` varchar(125) NOT NULL,
  `foto2` varchar(125) NOT NULL,
  `foto3` varchar(125) NOT NULL,
  `foto4` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `id_user`, `id_kategori`, `nama_barang`, `harga_barang`, `tanggal`, `status`, `deskripsi`, `foto1`, `foto2`, `foto3`, `foto4`) VALUES
(1, 3, 1, 'laptop toshiba satellite c600', 2100000, '2022-09-27', 'belum terjual', 'Pemakaian 1 Tahun\r\nMinus Cas\r\nHDD 500 GB\r\nRAM 6 GB', '1685544091_74ffe90d968dea93f14d.jpg', '', '', ''),
(8, 3, 1, 'Jual Laptop-Second Lenovo-G405-AMD-E1', 1750000, '2022-09-28', 'belum terjual', 'Pemakain 2 Bulan', '1685544021_5ed2ed65a36439e3695c.jpg', '', '', ''),
(9, 3, 1, 'Jual Laptop Acer ES1-431 Intel Celeron Bekas', 1300000, '2022-09-28', 'belum terjual', 'Pemakain 4 Bulan', '1685543947_1f2c08042f05fc85d74d.jpg', '', '', ''),
(10, 3, 1, 'Jual Acer Aspire E14 ES1-411 Bekas | LSM', 2100000, '2022-09-28', 'belum terjual', 'Minus Cas', '1685543906_e30cbb41fa4f277c2ce6.jpg', '', '', ''),
(13, 9, 2, 'Jual Jual kipas angin bekas', 100000, '2022-09-09', 'belum terjual', 'Masih Bagus.', '1685544401_970ee76c112c8424b9d3.jpg', '', '', ''),
(14, 9, 2, 'Kompor 2 Tungku Bekas', 150000, '2022-09-15', 'belum terjual', 'Masih Bagus.', '1685544329_c34d5d12923118db544b.jpg', '', '', ''),
(15, 9, 2, 'Jual Kompor portable Winn Gas (bekas)', 75000, '2022-09-29', 'belum terjual', 'Barang Masih Bagus Dan Mulus.', '1685544283_e88c59b17a23f200914a.jpg', '', '', ''),
(16, 9, 2, 'Rice cooker miyako bekas 606 0,6liter', 50000, '2022-09-29', 'belum terjual', 'Masih berfungsi dengan baik.', '1685544204_79f9bee9c99d651458da.jpg', '', '', ''),
(17, 3, 7, 'Jual Murah Gitar Akustik Murah', 150000, '2022-10-04', 'belum terjual', 'Pemakaian 4 Bulan, Masih Oke Bodi mulis', '1685543707_39faefb260fd652ba527.jpg', '', '', ''),
(18, 4, 7, 'Gitar Akustik', 500000, '2022-10-04', 'terjual', 'Body Mulus, lengkap senar, bonus pick gitar akustik', '1664793038_1c6ae638f8caeb88c487.jpg', '', '', ''),
(19, 2, 4, 'Tas NB hitam', 80000, '2022-10-01', 'terjual', 'Barang masih mulus, Warna Sesuai Gambar ', '1685544654_0fa3c076cd73d37eddbf.jpg', '', '', ''),
(20, 2, 3, 'Sepatu 3 Pasang', 175000, '2022-10-02', 'belum terjual', 'Sepatu 3 Pasang ukuran 42, Warna Sesuai Gambar', '1664793236_23a345f6099c9d5f72d8.jpg', '', '', ''),
(21, 2, 2, 'Kulkas 2 Pintu', 1000000, '2022-10-02', 'terkunci', 'Barang masih berfungsi dengan Baik', '1664793288_7a35998c3949ba50ea46.jpg', '', '', ''),
(22, 3, 1, 'Laptop Asus Murah  + 2 Cas', 1720000, '2022-10-03', 'belum terjual', 'Bodi masih bagus.', '1685543794_976700c9f9d3e18824f7.jpg', '', '', ''),
(23, 3, 6, '3 Baju Polos Bekas Bersih', 50000, '2022-10-04', 'belum terjual', 'Masih Bagus', '1664881645_03a8ec9aa0bd5e029875.jpg', '', '', ''),
(24, 2, 3, 'Sepatu N bekas.', 150000, '2022-10-13', 'belum terjual', 'Masih Mulus', '1685544598_0f17f8bd90cafc260372.jpg', '', '', ''),
(25, 12, 6, 'Jaket Denim Hitam', 50000, '2023-05-29', 'terjual', 'Barang Masih Bagus, Agak Pudar Sedikit.', '1685377535_7aa2ce524d8e5ed247b1.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bukti_pengiriman`
--

CREATE TABLE `tb_bukti_pengiriman` (
  `id_bukti_pengiriman` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `validasi` enum('belum','valid','tidak valid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bukti_pengiriman`
--

INSERT INTO `tb_bukti_pengiriman` (`id_bukti_pengiriman`, `id_transaksi`, `id_pengajuan`, `tanggal`, `foto`, `keterangan`, `validasi`) VALUES
(20, 23, 52, '2022-11-08', '1667909791_465fc420d9c9bce09f6f.jpg', 'JNE', 'valid'),
(21, 25, 54, '2022-11-14', '1668427502_d9f12b663fd125523548.jpg', 'Via JNE', 'valid'),
(22, 26, 55, '2023-05-29', '1685337687_ed3ec01afad29cbcc923.jpg', 'JNE', 'valid'),
(23, 27, 57, '2023-05-29', '1685381653_36e90e802b11d263c524.jpg', 'Paket Dikirim Ke Alamat VIA JNT', 'valid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bukti_transaksi`
--

CREATE TABLE `tb_bukti_transaksi` (
  `id_bukti_transaksi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `validasi` enum('belum','valid','tidak valid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bukti_transaksi`
--

INSERT INTO `tb_bukti_transaksi` (`id_bukti_transaksi`, `id_pengajuan`, `tanggal`, `foto`, `keterangan`, `validasi`) VALUES
(21, 52, '2022-11-08', '1667909759_78a10302f0db49a7c824.jpg', 'BNI Bersama', 'valid'),
(22, 54, '2022-11-14', '1668426744_f4dda23f843a89f3d1b7.jpg', 'Via rekening bersama', 'valid'),
(23, 55, '2023-05-29', '1685337585_dbb1fdd402063dcd18d8.jpg', 'Via BNI', 'valid'),
(25, 57, '2023-05-29', '1685381599_a5b7c83c29d4f714f925.jpeg', 'VIA BRI', 'valid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id_cart` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `harga` int(100) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `status` enum('belum terjual','terjual','terkunci') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_cart`
--

INSERT INTO `tb_cart` (`id_cart`, `id_penjual`, `id_pembeli`, `tanggal`, `harga`, `id_barang`, `status`) VALUES
(116, 2, 3, '2022-11-08', 80000, 19, 'terjual'),
(119, 4, 3, '2022-11-14', 500000, 18, 'terjual'),
(120, 2, 3, '2022-11-14', 175000, 20, 'terkunci'),
(121, 2, 11, '2022-11-17', 175000, 20, 'belum terjual'),
(122, 2, 3, '2023-02-14', 1000000, 21, 'terkunci'),
(133, 12, 13, '2023-05-29', 50000, 25, 'terjual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar`
--

CREATE TABLE `tb_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_gambar`
--

INSERT INTO `tb_gambar` (`id_gambar`, `id_barang`, `ket`, `gambar`) VALUES
(1, 1, 'gambar 1', '1.jpg'),
(5, 1, 'gambar 2', '2.jpg'),
(6, 1, 'gambar 3', '3.jpeg'),
(7, 1, 'gambar 4', '4.jpg'),
(11, 23, 'Baju cantik', '1668790723_6f476227771ff587c629.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `foto`) VALUES
(1, 'Komputer & Aksesoris', 'laptop2.jpg'),
(2, 'Dapur', 'dapur.jpg'),
(3, 'Sepatu', 'sepatu.jpg'),
(4, 'Tas', 'tas2.jpg'),
(6, 'Pakaian', 'baju2.jpg'),
(7, 'Hobi & Koleksi', 'gitar2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konfirm_transaksi`
--

CREATE TABLE `tb_konfirm_transaksi` (
  `id_konfirm_transaksi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_konfirm_transaksi`
--

INSERT INTO `tb_konfirm_transaksi` (`id_konfirm_transaksi`, `id_pengajuan`, `status`, `harga`) VALUES
(27, 51, 'Belum Dibayar', 201000),
(28, 52, 'Menunggu Bukti Pembayaran', 70000),
(29, 53, 'Menunggu Bukti Pembayaran', 150000),
(30, 54, 'Menunggu Bukti Pembayaran', 110000),
(31, 55, 'Menunggu Bukti Pembayaran', 400000),
(32, 57, 'Menunggu Bukti Pembayaran', 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `dari` varchar(50) NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `aksi` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id_notifikasi`, `tanggal`, `dari`, `kepada`, `aksi`, `id_user`) VALUES
(6, '2022-11-08 06:07:34', 'Eko Setiawan S.com', 'Bayu', 'Eko Setiawan S.com Menawar Harga Barang Sepatu NIKE 100Z', 2),
(7, '2022-11-08 06:08:04', 'Bayu', 'Eko Setiawan S.com', 'Bayu Memperbarui Harga Penawaran Sepatu NIKE 100Z', 3),
(8, '2022-11-08 06:09:59', 'Eko Setiawan S.com', 'Bayu', 'Eko Setiawan S.com Memperbarui Harga Penawaran Sepatu NIKE 100Z', 2),
(9, '2022-11-08 06:10:37', 'Bayu', 'Eko Setiawan S.com', 'Bayu Menyetujui Harga Penawaran Sepatu NIKE 100Z', 3),
(10, '2022-11-08 06:11:12', 'Eko Setiawan S.com', 'Bayu', 'Eko Setiawan S.com Menawar Harga Barang Tas Distro Hitam', 2),
(11, '2022-11-08 06:12:39', 'Bayu', 'Eko Setiawan S.com', 'Bayu Memperbarui Harga Penawaran Tas Distro Hitam', 3),
(12, '2022-11-08 06:12:54', 'Eko Setiawan S.com', 'Bayu', 'Eko Setiawan S.com Menyetujui Harga Penawaran Tas Distro Hitam', 2),
(13, '2022-11-09 08:39:42', 'Eko Setiawan S.com', 'Bayu', 'Eko Setiawan S.com Menawar Harga Barang Sepatu 3 Pasang', 2),
(14, '2022-11-09 08:40:14', 'Bayu', 'Eko Setiawan S.com', 'Bayu Menyetujui Harga Penawaran Sepatu 3 Pasang', 3),
(15, '2022-11-14 05:15:45', 'Eko Setiawan S.com', 'Bayu', 'Eko Setiawan S.com Menawar Harga Barang Sepatu 3 Pasang', 2),
(16, '2022-11-14 05:30:47', 'Bayu', 'Eko Setiawan S.com', 'Bayu Memperbarui Harga Penawaran Sepatu 3 Pasang', 3),
(17, '2022-11-14 05:36:29', 'Eko Setiawan S.com', 'Bayu', 'Eko Setiawan S.com Memperbarui Harga Penawaran Sepatu 3 Pasang', 2),
(18, '2022-11-14 05:39:45', 'Bayu', 'Eko Setiawan S.com', 'Bayu Menyetujui Harga Penawaran Sepatu 3 Pasang', 3),
(19, '2023-05-29 00:17:06', 'Eko Setiawan', 'Ayu', 'Eko Setiawan Menawar Harga Barang Gitar Akustik', 4),
(20, '2023-05-29 00:17:53', 'Ayu', 'Eko Setiawan', 'Ayu Memperbarui Harga Penawaran Gitar Akustik', 3),
(21, '2023-05-29 00:18:09', 'Eko Setiawan', 'Ayu', 'Eko Setiawan Menyetujui Harga Penawaran Gitar Akustik', 4),
(22, '2023-05-29 11:12:59', 'Eko Setiawan', 'Bayu', 'Eko Setiawan Menawar Harga Barang Kulkas 2 Pintu', 2),
(23, '2023-05-29 12:28:23', 'Fitri', 'Agus', 'Fitri Menawar Harga Barang Jaket Denim Hitam', 12),
(24, '2023-05-29 12:29:01', 'Agus', 'Fitri', 'Agus Memperbarui Harga Penawaran Jaket Denim Hitam', 13),
(25, '2023-05-29 12:29:26', 'Fitri', 'Agus', 'Fitri Memperbarui Harga Penawaran Jaket Denim Hitam', 12),
(26, '2023-05-29 12:29:56', 'Agus', 'Fitri', 'Agus Menyetujui Harga Penawaran Jaket Denim Hitam', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `harga_tawar_pembeli` int(50) NOT NULL,
  `harga_tawar_penjual` int(50) NOT NULL,
  `keterangan_pembeli` text NOT NULL,
  `keterangan_penjual` text NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `id_pembeli`, `id_penjual`, `tanggal`, `harga_tawar_pembeli`, `harga_tawar_penjual`, `keterangan_pembeli`, `keterangan_penjual`, `id_barang`, `id_cart`, `status`) VALUES
(52, 3, 2, '2022-11-08', 50000, 70000, '', '', 19, 116, 'Barang Diterima'),
(54, 3, 2, '2022-11-14', 110000, 120000, '', '', 20, 120, 'Bukti Pengiriman Diterima (Barang Dikirim Kelokasi Pembeli)'),
(55, 3, 4, '2023-05-29', 350000, 400000, '', '', 18, 119, 'Barang Diterima'),
(56, 3, 2, '2023-05-29', 750000, 0, '', '', 21, 122, 'proses negosiasi'),
(57, 13, 12, '2023-05-29', 40000, 45000, '', '', 25, 133, 'Barang Diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rincian_transaksi`
--

CREATE TABLE `tb_rincian_transaksi` (
  `id_rincian_transaksi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `nama_barang` varchar(125) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_riwayat_transaksi`
--

CREATE TABLE `tb_riwayat_transaksi` (
  `id_riwayat_transaksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_bukti_transaksi` int(11) NOT NULL,
  `id_bukti_pengiriman` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `harga_akhir` int(100) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_riwayat_transaksi`
--

INSERT INTO `tb_riwayat_transaksi` (`id_riwayat_transaksi`, `tanggal`, `id_transaksi`, `id_bukti_transaksi`, `id_bukti_pengiriman`, `id_pengajuan`, `harga_akhir`, `id_pembeli`, `id_penjual`) VALUES
(9, '2022-11-08', 23, 21, 20, 52, 70000, 3, 2),
(10, '2022-11-14', 25, 22, 21, 54, 110000, 3, 2),
(11, '2023-05-29', 26, 23, 22, 55, 400000, 3, 4),
(12, '2023-05-29', 27, 25, 23, 57, 40000, 13, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `harga_akhir` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pengajuan`, `tanggal`, `harga_akhir`) VALUES
(23, 52, '2022-11-08', 70000),
(25, 54, '2022-11-14', 110000),
(26, 55, '2023-05-29', 400000),
(27, 57, '2023-05-29', 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `rekening` varchar(20) NOT NULL,
  `foto_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `email`, `password`, `tanggal_lahir`, `jenis_kelamin`, `no_hp`, `alamat`, `rekening`, `foto_user`) VALUES
(2, 'Bayu Andri Solong', 'bayu@yahoo.com', '123', '2022-08-30', 'Laki-laki', '089635789232', 'Bungoro', '2112233', '1661600858_e7caaf84f14650b62894.jpg'),
(3, 'Eko Store', 'eko@yahoo.com', '123', '2000-01-25', 'Laki-laki', '089123321451', 'Jl.Selayar No.43 Block C', '3311421', '1662466219_cf72879ea759b62bb4b2.png'),
(4, 'Ayu Olshop', 'ayu@yahoo.com', '123', '2022-09-08', 'Perempuan', '089765455212', 'Palembang', '55122341', '1662191320_d6248587e50fe527b6f7.png'),
(9, 'Iful Store', 'iful@yahoo.com', '123', '2022-10-04', 'Laki-laki', '089123321456', 'Baru Baru', '112233', '1662472276_663bdee4f80e34d6137c.jpg'),
(11, 'Sulistio', 'sulistio@yahoo.com', '123', '2022-11-08', 'Laki-laki', '081527446836', '', '', ''),
(12, 'Agus', 'agus@yahoo.com', '123', '2023-05-22', 'Laki-laki', '089667223451', 'Toa Daeng', '', ''),
(13, 'Fitri', 'fitri@yahoo.com', '123', '2023-05-23', 'Perempuan', '085255678123', 'Perintis Kemerdekaan 2', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indeks untuk tabel `tb_bukti_pengiriman`
--
ALTER TABLE `tb_bukti_pengiriman`
  ADD PRIMARY KEY (`id_bukti_pengiriman`),
  ADD KEY `id_pengajuan` (`id_pengajuan`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `tb_bukti_transaksi`
--
ALTER TABLE `tb_bukti_transaksi`
  ADD PRIMARY KEY (`id_bukti_transaksi`),
  ADD KEY `id_pengajuan` (`id_pengajuan`);

--
-- Indeks untuk tabel `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_penjual` (`id_penjual`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Indeks untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_users` (`id_user`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `tb_konfirm_transaksi`
--
ALTER TABLE `tb_konfirm_transaksi`
  ADD PRIMARY KEY (`id_konfirm_transaksi`),
  ADD KEY `id_pengajuan` (`id_pengajuan`);

--
-- Indeks untuk tabel `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indeks untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `id_pembeli` (`id_pembeli`) USING BTREE,
  ADD KEY `id_penjual` (`id_penjual`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_cart` (`id_cart`);

--
-- Indeks untuk tabel `tb_rincian_transaksi`
--
ALTER TABLE `tb_rincian_transaksi`
  ADD PRIMARY KEY (`id_rincian_transaksi`),
  ADD KEY `id_pengajuan` (`id_pengajuan`);

--
-- Indeks untuk tabel `tb_riwayat_transaksi`
--
ALTER TABLE `tb_riwayat_transaksi`
  ADD PRIMARY KEY (`id_riwayat_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_bukti_pengiriman` (`id_bukti_pengiriman`),
  ADD KEY `id_pengajuan` (`id_pengajuan`),
  ADD KEY `id_bukti_transaksi` (`id_bukti_transaksi`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_penjual` (`id_penjual`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pengajuan` (`id_pengajuan`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_bukti_pengiriman`
--
ALTER TABLE `tb_bukti_pengiriman`
  MODIFY `id_bukti_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_bukti_transaksi`
--
ALTER TABLE `tb_bukti_transaksi`
  MODIFY `id_bukti_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_konfirm_transaksi`
--
ALTER TABLE `tb_konfirm_transaksi`
  MODIFY `id_konfirm_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tb_riwayat_transaksi`
--
ALTER TABLE `tb_riwayat_transaksi`
  MODIFY `id_riwayat_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD CONSTRAINT `tb_komentar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
