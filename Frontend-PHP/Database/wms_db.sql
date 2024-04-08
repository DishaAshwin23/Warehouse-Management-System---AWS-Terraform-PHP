-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 07:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `wms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_user` varchar(25) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `admin_nama` varchar(30) NOT NULL,
  `admin_alamat` varchar(250) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_telepon` varchar(15) NOT NULL,
  `admin_ip` varchar(12) NOT NULL,
  `admin_online` int(10) NOT NULL,
  `admin_level_kode` int(3) NOT NULL,
  `admin_status` varchar(100) NOT NULL,
  `admin_created` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_user`, `admin_pass`, `admin_nama`, `admin_alamat`, `admin_email`, `admin_telepon`, `admin_ip`, `admin_online`, `admin_level_kode`, `admin_status`, `admin_created`, `admin_updated`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', 'Mark Cooper', 'Here St. Over There, Anywhere, 2306', 'admin@mail.com', '9564897544', '', 0, 1, 'A', '2019-02-01 22:19:14', '2022-06-13 13:13:42'),
('staff1', 'ab4c31c66f9fe6485aefd34c3c9c88a1', 'Staff 101', 'Sample Address', '', '4569872', '', 0, 2, 'A', '2022-06-13 09:34:04', '2022-06-13 09:42:46'),
('staff2', '2bf4351232ec393d2a436d73dcb69dcf', 'Staff 102', 'Sample Address', '', '7864321', '', 0, 3, 'A', '2022-06-13 09:34:26', '2022-06-13 09:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_level`
--

CREATE TABLE `admin_level` (
  `admin_level_kode` int(3) NOT NULL,
  `admin_level_nama` varchar(30) NOT NULL,
  `admin_level_status` char(1) NOT NULL,
  `admin_level_created` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_level_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_level`
--

INSERT INTO `admin_level` (`admin_level_kode`, `admin_level_nama`, `admin_level_status`, `admin_level_created`, `admin_level_updated`) VALUES
(1, 'Administrator', 'A', '2018-07-26 22:31:41', '2018-07-26 22:31:41'),
(2, 'Staff Supplier', 'A', '2018-07-26 22:31:41', '2018-08-17 16:45:27'),
(3, 'Staff Customer', 'A', '2018-08-17 16:45:45', '2018-08-17 16:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `alamat_customer` varchar(100) NOT NULL,
  `notelp_customer` varchar(12) NOT NULL,
  `customer_created` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `alamat_customer`, `notelp_customer`, `customer_created`, `customer_updated`) VALUES
(1, 'John Watson', '855 Rosemary St', '46552000', '2022-01-18 18:40:10', '2022-01-18 18:40:10'),
(2, 'Jack Stuart', '854 Louis St', '04522260', '2022-01-19 10:59:12', '2022-01-19 10:59:12'),
(3, 'Douglas Stover', '17 Lake Forest Drive', '06665210', '2022-01-19 17:13:24', '2022-01-19 17:13:24'),
(4, 'Curtis Maury', '1342 Wayside Lane', '10458600', '2022-01-19 17:14:03', '2022-01-19 17:14:03'),
(5, 'Betty Wright', '1205 Cardinal Lane', '01478000', '2022-01-19 17:14:23', '2022-01-19 17:14:23'),
(6, 'George', '19 Gerald Bates Drive', '03690005', '2022-01-19 17:14:54', '2022-01-19 17:14:54'),
(7, 'Richard', '469 Providence Lane', '01478005', '2022-01-19 17:15:25', '2022-01-19 17:15:25'),
(8, 'Casie Dixon', '361 Bassel St', '02580014', '2022-01-19 17:15:54', '2022-01-19 17:15:54'),
(9, 'Will Williams', '4569 Down St', '45654000', '2022-01-20 11:19:58', '2022-01-20 11:19:58'),
(10, 'Customer 101', 'Sample Address 101', '0931456789', '2022-06-13 09:15:59', '2022-06-13 09:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `identitas_id` int(3) NOT NULL,
  `identitas_website` varchar(250) NOT NULL,
  `identitas_deskripsi` text NOT NULL,
  `identitas_keyword` text NOT NULL,
  `identitas_alamat` varchar(250) NOT NULL,
  `identitas_notelp` char(20) NOT NULL,
  `identitas_fb` varchar(100) NOT NULL,
  `identitas_email` varchar(100) NOT NULL,
  `identitas_tw` varchar(100) NOT NULL,
  `identitas_gp` varchar(100) NOT NULL,
  `identitas_yb` varchar(100) NOT NULL,
  `identitas_favicon` varchar(250) NOT NULL,
  `identitas_author` varchar(100) NOT NULL,
  `identitas_created` datetime NOT NULL DEFAULT current_timestamp(),
  `identitas_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`identitas_id`, `identitas_website`, `identitas_deskripsi`, `identitas_keyword`, `identitas_alamat`, `identitas_notelp`, `identitas_fb`, `identitas_email`, `identitas_tw`, `identitas_gp`, `identitas_yb`, `identitas_favicon`, `identitas_author`, `identitas_created`, `identitas_updated`) VALUES
(1, 'CI-WMS', 'Warehouse Management System in PHP CodeIgniter', 'Warehouse Management System  in PHP CodeIgniter', '569 Eren Avenue', '08123456789', 'https://www.facebook.com/CIwms', 'info@wmsmail.com', 'https://twitter.com/CIwms', 'http://CIwms.com/', 'https://www.youtube.com/wms', 'd5bf7e44b3331b3d4b0c0177e3d51f31.png', 'CI PHP - Project', '2019-02-13 22:19:42', '2022-06-13 11:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `limitstock`
--

CREATE TABLE `limitstock` (
  `limitstock_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `limitstock_created` datetime DEFAULT current_timestamp(),
  `limitstock_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `limitstock`
--

INSERT INTO `limitstock` (`limitstock_id`, `stock`, `limitstock_created`, `limitstock_updated`) VALUES
(1, 50, '2019-02-14 23:33:38', '2022-06-13 11:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `barang_created` datetime NOT NULL DEFAULT current_timestamp(),
  `barang_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `nama_barang`, `merek`, `stock`, `barang_created`, `barang_updated`) VALUES
(13, 'Test Item', 'Test Brand', 80, '2022-01-18 18:40:31', '2022-01-18 18:42:20'),
(14, 'Item 01', 'B ONE', 1, '2022-01-19 10:58:26', '2022-01-19 17:48:11'),
(15, 'Item 02', 'B ONE', 192, '2022-01-19 17:41:44', '2022-01-20 10:59:24'),
(16, 'Item 03', 'B TWO', 111, '2022-01-19 17:42:01', '2022-01-19 17:59:26'),
(17, 'Item 04', 'B THREE', 80, '2022-01-20 10:58:40', '2022-01-20 11:26:36'),
(18, 'Item 05', 'B FOUR', 268, '2022-01-20 11:20:39', '2022-01-20 11:22:16'),
(19, 'Product 101', 'Brand 101', 70, '2022-06-13 09:13:45', '2022-06-13 11:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('262ed206690c8ffa8c0880853ab67ce2', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1504186814, ''),
('49e9e36170db732c7314cb317b3c899e', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1504187151, ''),
('4b6baa8cbc478d7e38395c0d7a3fc212', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 1504186981, 'a:5:{s:9:\"user_data\";s:0:\"\";s:10:\"admin_nama\";s:13:\"Administrator\";s:10:\"admin_user\";s:5:\"admin\";s:11:\"admin_level\";s:1:\"1\";s:9:\"logged_in\";b:1;}'),
('648fe333a5f0d3d2515f2a2711e1751c', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 1532611686, ''),
('8f90fd01811f1c4f981059b36f932233', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 1504186981, ''),
('9f4279bb252307cbf1d9f5d87bf88a9c', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1504186691, ''),
('aa0a60fa0dba1e30487cce20443ba358', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 1532679275, ''),
('aa8fa7618237d5f7cb131b5777a1e564', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1504187079, ''),
('e3deff5ffd5e90e5ba3deef2c0681ff4', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 1504187005, 'a:2:{s:9:\"user_data\";s:0:\"\";s:10:\"admin_nama\";s:13:\"Administrator\";}'),
('f622232dd0c9c866affa9648415588ab', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 1504187039, '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat_supplier` varchar(100) NOT NULL,
  `notelp_supplier` varchar(12) NOT NULL,
  `supplier_created` datetime NOT NULL DEFAULT current_timestamp(),
  `supplier_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `notelp_supplier`, `supplier_created`, `supplier_updated`) VALUES
(1, 'XYZ Suppliers', '774 Black Street', '45478540', '2022-01-18 18:39:24', '2022-01-18 18:39:24'),
(2, 'Ultimate Suppliers', '550 Allace Avenue', '01478500', '2022-01-19 17:37:13', '2022-01-19 17:37:13'),
(3, 'Verion Supplies', '558 Black Street', '01478540', '2022-01-19 17:38:21', '2022-01-19 17:38:21'),
(4, 'Avant Suppliers', '440 Enim St', '04550010', '2022-01-19 17:39:31', '2022-01-19 17:39:31'),
(5, 'Pegasus Suppliers', '5514 Eros Avenue', '40145550', '2022-01-19 17:40:25', '2022-01-19 17:40:25'),
(6, 'QWER Suppliers', '7741 D Street', '41000140', '2022-01-20 11:19:15', '2022-01-20 11:19:15'),
(7, 'Supplier 101', 'Test supplier', '09123564789', '2022-06-13 09:14:41', '2022-06-13 09:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_barang`
--

CREATE TABLE `transaksi_barang` (
  `id_transaksi` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaksi_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_pergerakan` char(1) NOT NULL COMMENT 'pergerakan barang masuk = 1 atau keluar = 2',
  `id_barang` int(11) NOT NULL,
  `admin_user` varchar(119) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_barang`
--

INSERT INTO `transaksi_barang` (`id_transaksi`, `jumlah`, `tanggal_transaksi`, `transaksi_updated`, `status_pergerakan`, `id_barang`, `admin_user`, `id_supplier`, `id_customer`) VALUES
(30, 112, '2022-01-18 12:56:57', '2022-01-18 18:41:57', '1', 13, 'admin', 1, 0),
(31, 32, '2022-01-18 12:57:20', '2022-01-18 18:42:20', '2', 13, 'admin', 0, 1),
(32, 56, '2022-01-19 05:13:43', '2022-01-19 10:58:43', '1', 14, 'admin', 1, 0),
(33, 251, '2022-01-19 12:01:20', '2022-01-19 17:46:20', '1', 15, 'admin', 1, 0),
(34, 55, '2022-01-19 12:03:11', '2022-01-19 17:48:11', '2', 14, 'admin', 0, 2),
(35, 111, '2022-01-19 12:14:26', '2022-01-19 17:59:26', '1', 16, 'admin', 5, 0),
(36, 59, '2022-01-20 05:14:24', '2022-01-20 10:59:24', '2', 15, 'admin', 0, 6),
(37, 336, '2022-01-20 05:36:27', '2022-01-20 11:21:27', '1', 18, 'admin', 6, 0),
(38, 68, '2022-01-20 05:37:16', '2022-01-20 11:22:16', '2', 18, 'admin', 0, 9),
(39, 80, '2022-01-20 05:41:36', '2022-01-20 11:26:36', '1', 17, 'admin', 4, 0),
(42, 100, '2022-06-13 01:31:10', '2022-06-13 09:31:10', '1', 19, 'admin', 7, 0),
(43, 55, '2022-06-13 01:31:31', '2022-06-13 09:31:31', '2', 19, 'admin', 0, 10),
(45, 20, '2022-06-13 03:32:59', '2022-06-13 11:32:59', '1', 19, 'admin', 7, 0),
(46, 30, '2022-06-13 03:33:17', '2022-06-13 11:33:17', '2', 19, 'admin', 0, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_user`),
  ADD KEY `admin_level_kode` (`admin_level_kode`);

--
-- Indexes for table `admin_level`
--
ALTER TABLE `admin_level`
  ADD PRIMARY KEY (`admin_level_kode`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`identitas_id`);

--
-- Indexes for table `limitstock`
--
ALTER TABLE `limitstock`
  ADD PRIMARY KEY (`limitstock_id`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `Tgl_transaksi` (`tanggal_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_level`
--
ALTER TABLE `admin_level`
  MODIFY `admin_level_kode` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `identitas_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `limitstock`
--
ALTER TABLE `limitstock`
  MODIFY `limitstock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;
