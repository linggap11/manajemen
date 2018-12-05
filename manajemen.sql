-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 Des 2018 pada 14.36
-- Versi Server: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hak_akses` enum('admin','staff','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `username`, `password`, `hak_akses`) VALUES
(2, 'Dimas Firmansyah', 'dimasfrmnsyh@gmail.com', 'dimasfrmnsyh1', '$2y$12$M2wQFgKnFxWhnFg2jfvlZeQzl8HXUBB54TUJfdSxK58Pj4GQN4Bj2', 'admin'),
(5, 'admin', 'admin@admin.admin', 'admin', '$2y$12$10D4wd7RgjAwF1Kho8fXzOcYYpCk7fM7gSoTCU0ptanrypdhldnTS', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `nama_cv` varchar(30) NOT NULL,
  `alamat_cv` text NOT NULL,
  `kontak_cv` varchar(15) NOT NULL,
  `email_cv` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cv`
--

INSERT INTO `cv` (`id`, `nama_cv`, `alamat_cv`, `kontak_cv`, `email_cv`) VALUES
(1, 'C.V. INDOMINERAL', 'Jalan Raya Ciburuy No.33, Ciburuy, Padalarang, Kabupaten Bandung Barat, Jawa Barat 40553', '022314124', 'indomineral@email.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_telp`, `alamat`, `kode_pos`) VALUES
(1, 'Pelanggan 1', '123131820', 'Jalan Bandung di patiukur', 12312),
(2, 'Pelanggan Baru 1', '12312312', 'Pelanggan Baru 1Pelanggan Baru 1Pelanggan Baru 1Pelanggan Baru 1', 12312),
(24, 'John Doea', '2312312', 'Jalan Jlana akwkwkwk', 13123);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` int(11) NOT NULL,
  `no_pengiriman` varchar(50) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `berat` varchar(50) NOT NULL,
  `biaya_tambahan` varchar(50) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `total` bigint(50) NOT NULL,
  `status` enum('BERHASIL','INORDER','BATAL') NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `produk_id` int(10) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `no_pengiriman`, `tgl_transaksi`, `berat`, `biaya_tambahan`, `harga`, `total`, `status`, `pelanggan_id`, `produk_id`, `sales_id`, `transaksi_id`) VALUES
(10, 'SHIPMNT000001', '2018-12-05', '12', '1000', 10000, 120000, 'BERHASIL', 1, 23, 1, 2),
(11, 'SHIPMNT000002', '2018-12-05', '1', '0', 66, 66, 'BERHASIL', 24, 27, 4, 4),
(12, 'SHIPMNT000003', '2018-12-05', '1', '0', 1231231, 1231231, 'BERHASIL', 2, 29, 2, 6),
(13, 'SHIPMNT000004', '2018-12-07', '1', '0', 333, 333, 'BERHASIL', 1, 23, 1, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text,
  `harga` bigint(20) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama`, `deskripsi`, `harga`, `pelanggan_id`) VALUES
(23, 'PROD-111132341', 'Produk A', 'Deskripsi Produk A', 10000, 1),
(24, 'PROD-111132342', 'Produk Baru 1', 'Produk Baru 1Produk Baru 1', 20000, 2),
(25, 'PROD-111132343', 'Produk 3', 'Deskripsi Produk 3', 22, 24),
(27, 'PROD-111132344', '56', '65', 66, 24),
(29, 'PROD-111132345', 'sada', '123123', 1231231, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `plat_nomor` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `no_gps` varchar(20) NOT NULL,
  `status` enum('MENGIRIM','FREE') NOT NULL DEFAULT 'FREE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `nama`, `plat_nomor`, `no_telp`, `no_gps`, `status`) VALUES
(1, 'Yuma Yusuf', 'D 666 SU', '08123123123', '100123123123', 'FREE'),
(2, 'imatu', 'B 666 SU', '08123123123', '100123123123', 'FREE'),
(3, 'Ujang', 'D 444 D1', '12312312312', '125215215251', 'MENGIRIM'),
(4, 'Nawari', 'B 4404 AA', '2311251251', '2312412519252', 'FREE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `no_bukti` char(15) NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `status` enum('PENDING','APPROVED','BATAL') DEFAULT 'PENDING',
  `tagihan` enum('LUNAS','BELUM LUNAS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `no_bukti`, `tgl_terima`, `status`, `tagihan`) VALUES
(2, '2018/09/415', '2018-12-05', 'APPROVED', 'BELUM LUNAS'),
(4, '2018/09/416', '2018-12-05', 'APPROVED', 'BELUM LUNAS'),
(6, '2018/09/417', '2018-12-05', 'APPROVED', 'BELUM LUNAS'),
(8, '2018/09/418', '2018-12-05', 'APPROVED', 'BELUM LUNAS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `pengiriman_ibfk_2` (`produk_id`),
  ADD KEY `pengiriman_ibfk_4` (`transaksi_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pengiriman_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pengiriman_ibfk_3` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pengiriman_ibfk_4` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
