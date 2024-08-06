-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 07:16 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='id_barang' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`) VALUES
(2, 'kursi'),
(3, 'kipas'),
(7, 'printer'),
(8, 'komputer'),
(9, 'tempat seduh kopi'),
(12, 'speaker'),
(14, 'meja'),
(15, 'test'),
(16, 'test barang');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `jml_keluar` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_barang`, `tgl_keluar`, `jml_keluar`, `deskripsi`) VALUES
(1, 2, '2024-07-17', 1, 'lab mm'),
(2, 14, '2024-07-17', 5, 'lab PM'),
(3, 8, '2024-07-17', 2, 'GB Mart'),
(4, 16, '2024-07-17', 1, 'rusak');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `min_stock` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE
	stock
SET
	sisa_stok = sisa_stok - new.jml_keluar
WHERE
	id_barang=new.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `spesifikasi` text NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `jml_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_barang`, `tgl_masuk`, `spesifikasi`, `kondisi`, `jml_masuk`) VALUES
(3, 2, '2024-07-17', 'asus i5', 'bekas', 5),
(14, 7, '2024-07-17', 'printer epson 220', 'baru', 1),
(15, 3, '2024-07-17', 'kipas angin vika', 'bekas', 2),
(18, 8, '2024-07-17', 'komputer asus ram 4gb i5', 'baru', 20),
(19, 3, '2024-07-17', 'kipas isekai 3000', 'baru', 2),
(24, 12, '2024-07-17', 'earphone untuk komputer', 'baru', 10),
(25, 7, '2024-07-17', 'printer 3pson L220', 'baik', 2),
(26, 2, '2024-07-17', 'charger for asus', 'baru', 20),
(28, 2, '2024-07-17', 'laptop ROG type 1', 'bekas', 11),
(29, 9, '2024-07-17', 'ups for komputer', 'baru', 5),
(30, 12, '2024-07-17', 'earphone untuk komputer', 'baru', 10),
(31, 14, '2024-07-17', 'notebook asus', 'baru', 20),
(32, 16, '2024-07-17', 'barang antik', 'baik', 2);

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `add_stock` BEFORE INSERT ON `barang_masuk` FOR EACH ROW INSERT INTO
	stock (id_barang,sisa_stok)
VALUES
	(new.id_barang, new.jml_masuk)
ON DUPLICATE KEY UPDATE sisa_stok = sisa_stok + new.jml_masuk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `keluar`
-- (See below for the actual view)
--
CREATE TABLE `keluar` (
`id_barang` int(11)
,`nama_barang` varchar(255)
,`jml_keluar` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `masuk`
-- (See below for the actual view)
--
CREATE TABLE `masuk` (
`id_barang` int(11)
,`nama_barang` varchar(255)
,`jml_masuk` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_barang` int(11) NOT NULL,
  `sisa_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_barang`, `sisa_stok`) VALUES
(16, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stok`
-- (See below for the actual view)
--
CREATE TABLE `stok` (
`id_barang` int(11)
,`nama_barang` varchar(255)
,`jml_masuk` decimal(32,0)
,`jml_keluar` decimal(32,0)
,`sisa_stok` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` char(100) NOT NULL,
  `password` char(250) NOT NULL,
  `level` enum('administrator','manajemen','peminjam','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(7, 'Owner', 'owner', '72122ce96bfec66e2396d2e25225d70a', 'manajemen'),
(8, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator');

-- --------------------------------------------------------

--
-- Structure for view `keluar`
--
DROP TABLE IF EXISTS `keluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `keluar`  AS  select `barang`.`id_barang` AS `id_barang`,`barang`.`nama_barang` AS `nama_barang`,sum(coalesce(`barang_keluar`.`jml_keluar`,0)) AS `jml_keluar` from (`barang` left join `barang_keluar` on((`barang`.`id_barang` = `barang_keluar`.`id_barang`))) group by `barang`.`id_barang` ;

-- --------------------------------------------------------

--
-- Structure for view `masuk`
--
DROP TABLE IF EXISTS `masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `masuk`  AS  select `barang`.`id_barang` AS `id_barang`,`barang`.`nama_barang` AS `nama_barang`,sum(coalesce(`barang_masuk`.`jml_masuk`,0)) AS `jml_masuk` from (`barang` left join `barang_masuk` on((`barang`.`id_barang` = `barang_masuk`.`id_barang`))) group by `barang`.`id_barang` ;

-- --------------------------------------------------------

--
-- Structure for view `stok`
--
DROP TABLE IF EXISTS `stok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stok`  AS  select `masuk`.`id_barang` AS `id_barang`,`masuk`.`nama_barang` AS `nama_barang`,`masuk`.`jml_masuk` AS `jml_masuk`,`keluar`.`jml_keluar` AS `jml_keluar`,(`masuk`.`jml_masuk` - `keluar`.`jml_keluar`) AS `sisa_stok` from (`masuk` join `keluar` on((`masuk`.`id_barang` = `keluar`.`id_barang`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
