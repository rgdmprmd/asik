-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 10:25 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asik`
--

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `meja_id` int(11) NOT NULL,
  `jenismeja_id` int(11) DEFAULT NULL,
  `meja_nomer` varchar(128) DEFAULT NULL,
  `isTaken` int(1) DEFAULT NULL,
  `kursi_tersedia` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`meja_id`, `jenismeja_id`, `meja_nomer`, `isTaken`, `kursi_tersedia`, `dateCreated`, `dateModified`, `email_input`, `email_update`) VALUES
(1, 1, 'A1', 1, 0, '2020-09-08 13:31:26', '2020-11-02 14:09:19', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(2, 1, 'A2', 0, 2, '2020-09-08 13:36:13', '2020-09-10 10:00:58', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(3, 2, 'A3', 0, 4, '2020-09-08 13:36:26', '2020-09-08 13:50:06', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(4, 2, 'A4', 0, 4, '2020-09-08 13:37:10', NULL, 'bonuslupis@gmail.com', NULL),
(5, 3, 'A5', 0, 6, '2020-09-08 13:37:24', '2020-09-08 13:50:16', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(6, 4, 'A6', 0, 1, '2020-09-08 13:37:50', '2020-09-08 13:55:30', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(7, 4, 'A7', 0, 1, '2020-09-08 13:38:14', '2020-09-08 13:54:49', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(8, 4, 'A8', 0, 1, '2020-09-08 13:38:41', '2020-09-08 13:54:58', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `meja_jenis`
--

CREATE TABLE `meja_jenis` (
  `jenismeja_id` int(11) NOT NULL,
  `jenismeja_nama` varchar(128) DEFAULT NULL,
  `jenismeja_kursi` int(11) DEFAULT NULL,
  `jenismeja_desc` text,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `jenismeja_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja_jenis`
--

INSERT INTO `meja_jenis` (`jenismeja_id`, `jenismeja_nama`, `jenismeja_kursi`, `jenismeja_desc`, `email_input`, `email_update`, `dateCreated`, `dateModified`, `jenismeja_status`) VALUES
(1, 'Couple', 2, 'Meja kotak dengan 2 kursi, cocok untuk makan malam intim bersama orang terdekatmu.', 'bonuslupis@gmail.com', NULL, '2020-09-08 12:16:59', NULL, 1),
(2, 'Group', 4, 'Meja kotak dengan 4 kursi, cocok untuk makan bersama teman dan keluarga.', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com', '2020-09-08 12:45:25', '2020-09-10 10:29:20', 1),
(3, 'Family', 6, 'Meja panjang dengan 6 kursi, cocok untuk makan bersama keluarga besar kamu.', 'bonuslupis@gmail.com', NULL, '2020-09-08 13:19:58', NULL, 1),
(4, 'Corner', 1, 'Meja panjang yang nempel kaca, cocok buat kamu yang pengen sendiri aja.', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com', '2020-09-08 13:47:19', '2020-09-08 13:54:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_nama` varchar(128) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL,
  `menu_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_nama`, `dateCreated`, `dateModified`, `email_input`, `email_update`, `menu_status`) VALUES
(1, 'user', '2020-08-10 13:48:48', '2020-08-10 13:48:48', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com', 1),
(2, 'admin', '2020-08-10 13:52:47', '2020-08-10 13:52:47', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com', 1),
(3, 'teams', '2020-08-10 14:12:29', NULL, 'bonuslupis@gmail.com', NULL, 1),
(4, 'manager', '2020-09-04 09:37:44', NULL, 'bonuslupis@gmail.com', NULL, 1),
(5, 'kitchen', '2020-11-02 11:05:15', '2020-11-02 11:05:23', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com', 1),
(6, 'waiters', '2020-11-02 11:08:09', NULL, 'bonuslupis@gmail.com', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_akses`
--

CREATE TABLE `menu_akses` (
  `akses_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_akses`
--

INSERT INTO `menu_akses` (`akses_id`, `role_id`, `menu_id`, `dateCreated`, `dateModified`, `email_input`, `email_update`) VALUES
(1, 2, 1, '2020-08-07 00:00:00', NULL, NULL, NULL),
(2, 1, 2, '2020-08-10 00:00:00', NULL, NULL, NULL),
(13, 1, 1, '2020-08-11 15:03:18', NULL, 'bonuslupis@gmail.com', NULL),
(14, 3, 1, '2020-09-02 13:48:37', NULL, 'bonuslupis@gmail.com', NULL),
(15, 4, 1, '2020-09-02 13:48:49', NULL, 'bonuslupis@gmail.com', NULL),
(16, 5, 1, '2020-09-02 13:48:57', NULL, 'bonuslupis@gmail.com', NULL),
(17, 6, 1, '2020-09-03 12:51:06', NULL, 'bonuslupis@gmail.com', NULL),
(20, 6, 5, '2020-11-02 11:08:21', NULL, 'bonuslupis@gmail.com', NULL),
(21, 3, 6, '2020-11-02 11:08:35', NULL, 'bonuslupis@gmail.com', NULL),
(25, 1, 4, '2020-11-02 16:09:30', NULL, 'bonuslupis@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_jenis`
--

CREATE TABLE `menu_jenis` (
  `makananjenis_id` int(11) NOT NULL,
  `makananjenis_nama` varchar(128) DEFAULT NULL,
  `makananjenis_status` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_jenis`
--

INSERT INTO `menu_jenis` (`makananjenis_id`, `makananjenis_nama`, `makananjenis_status`, `dateCreated`, `dateModified`, `email_input`, `email_update`) VALUES
(1, 'Burger', 1, '2020-09-10 10:55:24', NULL, 'bonuslupis@gmail.com', NULL),
(2, 'Sandwich', 1, '2020-09-10 11:10:13', NULL, 'bonuslupis@gmail.com', NULL),
(3, 'Hot dog', 1, '2020-09-10 11:12:52', NULL, 'bonuslupis@gmail.com', NULL),
(4, 'Deep fry', 1, '2020-09-10 11:20:28', '2020-09-10 11:53:28', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(5, 'Chicken stripe', 1, '2020-09-10 11:21:11', NULL, 'bonuslupis@gmail.com', NULL),
(6, 'Bir', 1, '2020-09-10 11:22:03', NULL, 'bonuslupis@gmail.com', NULL),
(7, 'Tea', 1, '2020-09-10 11:22:14', NULL, 'bonuslupis@gmail.com', NULL),
(8, 'Soda', 1, '2020-09-10 11:22:14', '2020-09-10 11:39:12', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(9, 'Mineral water', 1, '2020-09-10 11:23:06', NULL, 'bonuslupis@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_makanan`
--

CREATE TABLE `menu_makanan` (
  `makanan_id` int(11) NOT NULL,
  `makananjenis_id` int(11) DEFAULT NULL,
  `makanan_nama` varchar(128) DEFAULT NULL,
  `makanan_desc` text,
  `makanan_img` varchar(128) DEFAULT NULL,
  `makanan_harga` int(11) DEFAULT NULL,
  `makanan_hpp` int(11) DEFAULT NULL,
  `makanan_status` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_makanan`
--

INSERT INTO `menu_makanan` (`makanan_id`, `makananjenis_id`, `makanan_nama`, `makanan_desc`, `makanan_img`, `makanan_harga`, `makanan_hpp`, `makanan_status`, `dateCreated`, `dateModified`, `email_input`, `email_update`) VALUES
(1, 6, 'Bintang', 'Your local pride bir in the nutshell.', 'bd7840cfc3a19c08add6ec262713235e.jpg', 39000, 34000, 1, '2020-09-11 09:36:38', '2020-09-11 15:57:17', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(2, 6, 'Radler', 'Your local pride bir with the touch of radler taste.', 'f82944e141acf0fe9fe7623e2e893b4e.jpg', 34000, 23000, 1, '2020-09-11 09:56:29', NULL, 'bonuslupis@gmail.com', NULL),
(3, 6, 'Heineken', 'Your local pride bir in the nutshell.', '1c3de141036b0fa01841d260d43fbfcc.jpg', 375000, 30000, 1, '2020-09-11 15:42:35', '2020-11-02 09:14:24', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `detpesanan_id` int(11) NOT NULL,
  `pesanan_id` int(11) DEFAULT NULL,
  `makanan_id` int(11) DEFAULT NULL,
  `qty_pesanan` int(11) DEFAULT NULL,
  `total_pesanan` int(11) DEFAULT NULL,
  `detpesanan_status` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`detpesanan_id`, `pesanan_id`, `makanan_id`, `qty_pesanan`, `total_pesanan`, `detpesanan_status`, `dateCreated`, `dateModified`, `email_input`, `email_update`) VALUES
(1, 1, 1, 1, 39000, 1, '2020-11-02 14:09:19', '2020-11-02 14:14:06', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(2, 1, 2, 2, 68000, 1, '2020-11-02 14:09:19', '2020-11-02 14:14:41', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(3, 1, 3, 1, 375000, 1, '2020-11-02 14:18:14', '2020-11-02 14:18:25', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_header`
--

CREATE TABLE `pesanan_header` (
  `pesanan_id` int(11) NOT NULL,
  `meja_id` int(11) DEFAULT NULL,
  `jumlah_tamu` int(11) DEFAULT NULL,
  `pesanan_total` int(11) DEFAULT NULL,
  `pesanan_status` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_header`
--

INSERT INTO `pesanan_header` (`pesanan_id`, `meja_id`, `jumlah_tamu`, `pesanan_total`, `pesanan_status`, `dateCreated`, `dateModified`, `email_input`, `email_update`) VALUES
(1, 1, 2, 107000, 2, '2020-11-02 14:09:19', '2020-11-02 14:18:41', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_nama` varchar(128) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_nama`, `dateCreated`, `dateModified`, `email_input`, `email_update`) VALUES
(1, 'Superman', '2020-08-11 12:15:39', '2020-09-02 14:17:13', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(2, 'User', '2020-08-11 13:44:56', NULL, 'bonuslupis@gmail.com', NULL),
(3, 'Waiters', '2020-09-02 13:47:47', '2020-09-03 12:57:59', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(4, 'Manager', '2020-09-02 13:48:00', '2020-11-02 14:19:14', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(5, 'Kasir', '2020-09-02 13:48:09', NULL, 'bonuslupis@gmail.com', NULL),
(6, 'Kitchen', '2020-09-03 12:50:51', NULL, 'bonuslupis@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `submenu_id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `submenu_nama` varchar(128) DEFAULT NULL,
  `submenu_url` varchar(128) DEFAULT NULL,
  `submenu_icon` varchar(128) DEFAULT NULL,
  `submenu_status` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `email_input` varchar(128) DEFAULT NULL,
  `email_update` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`submenu_id`, `menu_id`, `submenu_nama`, `submenu_url`, `submenu_icon`, `submenu_status`, `dateCreated`, `dateModified`, `email_input`, `email_update`) VALUES
(1, 1, 'Profile', 'user', 'fas fa-fw fa-user-alt', 1, '2020-08-10 14:51:48', '2020-08-10 14:51:48', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(2, 2, 'Menu Management', 'admin/menu', 'fas fa-fw fa-folder-open', 1, '2020-08-10 14:52:14', '2020-08-10 14:52:14', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(3, 2, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1, '2020-08-10 15:05:55', '2020-08-10 15:05:55', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(4, 2, 'Role', 'admin/role', 'fas fa-fw fa-user-lock', 1, '2020-08-11 09:51:10', '2020-08-11 09:51:10', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(5, 2, 'Users', 'admin/users', 'fas fa-fw fa-users', 1, '2020-09-02 15:21:50', '2020-09-02 15:21:50', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(6, 4, 'Meja', 'manager/meja', 'fas fa-fw fa-chair', 1, '2020-09-04 09:46:43', '2020-09-04 09:46:43', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(7, 4, 'Menu', 'manager/menu', 'fas fa-fw fa-scroll', 1, '2020-09-04 09:47:39', '2020-09-04 09:47:39', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(8, 4, 'Pesanan', 'manager/pesanan', 'fas fa-fw fa-user-tag', 1, '2020-09-04 09:57:26', '2020-09-04 09:57:26', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(9, 4, 'Jenis Meja', 'manager/jenismeja', 'fas fa-fw fa-tachometer-alt', 0, '2020-09-08 12:02:52', '2020-09-08 12:02:52', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(10, 5, 'Menu', 'kitchen/menu', 'fas fa-fw fa-scroll', 1, '2020-11-02 11:06:13', '2020-11-02 11:06:13', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(11, 5, 'Pesanan', 'kitchen/pesanan', 'fas fa-fw fa-user-tag', 1, '2020-11-02 11:07:12', '2020-11-02 11:07:12', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(12, 6, 'Meja', 'waiters/meja', 'fas fa-fw fa-chair', 1, '2020-11-02 11:09:12', '2020-11-02 11:09:12', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(13, 6, 'Menu', 'waiters/menu', 'fas fa-fw fa-scroll', 1, '2020-11-02 11:09:52', '2020-11-02 11:09:52', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(14, 6, 'Pesanan', 'waiters/pesanan', 'fas fa-fw fa-user-tag', 1, '2020-11-02 11:10:23', '2020-11-02 11:10:23', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com'),
(15, 4, 'Payment', 'manager/payment', 'fas fa-fw fa-cash-register', 1, '2020-11-02 16:23:00', '2020-11-02 16:23:00', 'bonuslupis@gmail.com', 'bonuslupis@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `token_id` int(11) NOT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(128) DEFAULT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `user_image` varchar(128) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `owner_status` int(11) DEFAULT NULL,
  `user_status` int(1) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_nama`, `user_email`, `user_image`, `user_password`, `role_id`, `team_id`, `owner_status`, `user_status`, `dateCreated`, `dateModified`) VALUES
(1, 'Koala', 'bonuslupis@gmail.com', '8c855f4c801dd1f2760fa658297c8651.gif', '$2y$10$80fB.mRM3DUs7Iq87Qfu9uVQgFSM/2FEslkVxDWYHXV8dWxYX.GQW', 1, 0, 1, 1, '2020-08-05 09:43:14', '2020-09-10 16:41:57'),
(2, 'Daesy', 'badcodebutgoodjoke@gmail.com', 'default.jpg', '$2y$10$wP4QakV4/7DrH8cT0TnLnO.SUr2IgklQh114sfydEXy07BhuBsf3m', 5, 0, 1, 1, '2020-09-02 14:14:55', '2020-09-03 12:51:20'),
(3, 'Rangga', 'ranggadpermadi@gmail.com', 'd0570869e035c24d6c5b3f07d87f6382.jpeg', '$2y$10$Jqx.w6pl8w8WIr1BKOlAyOZ83Lsj3bgkYSmePrZ4U8Ng9/B4mlCK.', 2, 0, 1, 1, '2020-09-02 14:18:39', '2020-11-02 14:55:02'),
(4, 'Rangga D Permadi', 'rnggdmsprmd@gmail.com', 'default.jpg', '$2y$10$pzTDFm7RR92v8Y3ZhMOFKOqv4n0MuJI3GmDczt2XLF4WmByHGp6Xy', 3, 0, 1, 1, '2020-09-02 14:19:19', '2020-09-03 12:52:03'),
(5, 'Mariska', 'mariskariva06@gmail.com', 'default.jpg', '$2y$10$/t62qvEoC73DUcRuw/taReUsRKOPnWlqO0Y2.ynDNTtI0uG9xrRYa', 4, 0, 1, 1, '2020-09-02 14:19:45', '2020-11-02 14:19:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`meja_id`);

--
-- Indexes for table `meja_jenis`
--
ALTER TABLE `meja_jenis`
  ADD PRIMARY KEY (`jenismeja_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_akses`
--
ALTER TABLE `menu_akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indexes for table `menu_jenis`
--
ALTER TABLE `menu_jenis`
  ADD PRIMARY KEY (`makananjenis_id`);

--
-- Indexes for table `menu_makanan`
--
ALTER TABLE `menu_makanan`
  ADD PRIMARY KEY (`makanan_id`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`detpesanan_id`);

--
-- Indexes for table `pesanan_header`
--
ALTER TABLE `pesanan_header`
  ADD PRIMARY KEY (`pesanan_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`submenu_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `meja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meja_jenis`
--
ALTER TABLE `meja_jenis`
  MODIFY `jenismeja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_akses`
--
ALTER TABLE `menu_akses`
  MODIFY `akses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `menu_jenis`
--
ALTER TABLE `menu_jenis`
  MODIFY `makananjenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_makanan`
--
ALTER TABLE `menu_makanan`
  MODIFY `makanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `detpesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesanan_header`
--
ALTER TABLE `pesanan_header`
  MODIFY `pesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
