-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2019 at 03:36 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `ws_admin`
--

CREATE TABLE `ws_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `profile_picture` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_admin`
--

INSERT INTO `ws_admin` (`id`, `name`, `profile_picture`, `password`, `update_time`) VALUES
(1, 'admin', 'assets/img/foto/admin/38852429.jpeg', '21232f297a57a5a743894a0e4a801fc3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ws_finance`
--

CREATE TABLE `ws_finance` (
  `id_finance` int(11) NOT NULL,
  `approval_code` varchar(11) NOT NULL,
  `cash_in` bigint(20) NOT NULL,
  `cash_out` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>kredit , 1=>debit'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_finance`
--

INSERT INTO `ws_finance` (`id_finance`, `approval_code`, `cash_in`, `cash_out`, `description`, `created_time`, `created_by`, `updated_time`, `updated_by`, `status`) VALUES
(1, 'SF1', 25000, 0, 'Pembayaran uang sekolah Taufiq Rourkyendo tanggal (2019-01-26)', '2019-01-26 07:04:48', 2, '2019-01-27 11:13:23', 2, 1),
(2, 'DB1', 500000, 0, 'Test melakukan debit keuangan', '2019-01-27 00:00:00', 2, '2019-01-27 15:09:02', 2, 1),
(3, 'KD1', 0, 250000, 'Pengeluaran bayar uang listrik', '2019-01-27 00:00:00', 2, '2019-01-27 14:54:31', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ws_group`
--

CREATE TABLE `ws_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_group`
--

INSERT INTO `ws_group` (`group_id`, `group_name`) VALUES
(1, 'Operator'),
(2, 'Keuangan'),
(3, 'Guru');

-- --------------------------------------------------------

--
-- Table structure for table `ws_major`
--

CREATE TABLE `ws_major` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_major`
--

INSERT INTO `ws_major` (`major_id`, `major_name`) VALUES
(1, 'IPA'),
(2, 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `ws_media`
--

CREATE TABLE `ws_media` (
  `media_id` int(11) NOT NULL,
  `media_judul` varchar(255) NOT NULL,
  `media_gambar` varchar(255) NOT NULL,
  `media_isi` text NOT NULL,
  `media_med_kat_id` int(11) NOT NULL,
  `media_created_time` datetime NOT NULL,
  `media_created_by` int(11) NOT NULL,
  `media_update_time` datetime DEFAULT NULL,
  `media_update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ws_media_comment`
--

CREATE TABLE `ws_media_comment` (
  `media_comment_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `name` varchar(120) NOT NULL,
  `comment_created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_media_comment`
--

INSERT INTO `ws_media_comment` (`media_comment_id`, `media_id`, `comment`, `name`, `comment_created_time`) VALUES
(1, 1, 'Terimakasih Infonya', 'Fernando', '2018-12-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ws_media_kategori`
--

CREATE TABLE `ws_media_kategori` (
  `med_kat_id` int(11) NOT NULL,
  `med_kat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_media_kategori`
--

INSERT INTO `ws_media_kategori` (`med_kat_id`, `med_kat_name`) VALUES
(1, 'Berita');

-- --------------------------------------------------------

--
-- Table structure for table `ws_pegawai`
--

CREATE TABLE `ws_pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(250) DEFAULT NULL,
  `profile_picture` varchar(500) DEFAULT 'assets/img/avatar04.png',
  `name` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('l','p') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `joined_date` date NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_pegawai`
--

INSERT INTO `ws_pegawai` (`id`, `nip`, `profile_picture`, `name`, `password`, `alamat`, `kota`, `telepon`, `email`, `gender`, `birth_date`, `joined_date`, `group_id`, `created_time`, `update_time`, `update_by`) VALUES
(1, '123456789', 'assets/img/foto/pegawai/123456789.jpg', 'Venika Sutrisna', 'c1cf7107880a0cc49d78a0f607de4f00', 'Pangkalan Susu', 'Pangkalan Susu', '0888888888888', 'test@mail.com', 'p', '1999-12-27', '2019-01-11', 2, '2019-01-11 20:10:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ws_school_fees`
--

CREATE TABLE `ws_school_fees` (
  `id_sf` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nominal` bigint(20) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `approved_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_school_fees`
--

INSERT INTO `ws_school_fees` (`id_sf`, `id_siswa`, `nominal`, `payment_date`, `approved_by`, `created_time`, `updated_time`, `updated_by`) VALUES
(1, 1, 25000, '2019-01-26', 2, '2019-01-26 07:04:48', '2019-01-27 11:13:23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ws_siswa`
--

CREATE TABLE `ws_siswa` (
  `id` int(11) NOT NULL,
  `nisn` varchar(250) NOT NULL,
  `profile_picture` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(250) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('l','p') NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(250) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `class` varchar(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `register_year` year(4) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_siswa`
--

INSERT INTO `ws_siswa` (`id`, `nisn`, `profile_picture`, `name`, `password`, `parent_name`, `birth_date`, `gender`, `alamat`, `kota`, `telepon`, `email`, `class`, `major_id`, `register_year`, `created_time`, `update_time`, `update_by`) VALUES
(1, '123456789', '', 'Taufiq Rourkyendo', 'a9be25651b7f51db3ee242844ee0711d', 'Suwitono', '1998-12-11', 'l', 'Pangkalan Brandan', 'Pangkalan Brandan', '082276648478', 'taufiqrorkyendo@gmail.com', '9', 1, 2017, '2019-01-26 07:04:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ws_users`
--

CREATE TABLE `ws_users` (
  `users_id` int(11) NOT NULL,
  `users_username` varchar(100) NOT NULL,
  `users_role_id` int(11) NOT NULL,
  `users_user_id` tinyint(4) NOT NULL,
  `users_status_active` tinyint(4) NOT NULL,
  `users_created_time` datetime NOT NULL,
  `users_created_by` int(11) NOT NULL,
  `users_ref_by_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_users`
--

INSERT INTO `ws_users` (`users_id`, `users_username`, `users_role_id`, `users_user_id`, `users_status_active`, `users_created_time`, `users_created_by`, `users_ref_by_id`) VALUES
(1, 'admin', 1, 1, 1, '2019-01-10 16:48:07', 1, 0),
(2, 'venika', 2, 1, 1, '2019-01-11 14:10:02', 1, 0),
(3, '123456789', 3, 1, 1, '2019-01-26 01:04:10', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ws_users_role`
--

CREATE TABLE `ws_users_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_created_by` int(11) NOT NULL,
  `role_created_time` datetime NOT NULL,
  `role_update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_users_role`
--

INSERT INTO `ws_users_role` (`role_id`, `role_name`, `role_created_by`, `role_created_time`, `role_update_time`) VALUES
(1, 'admin', 1, '0000-00-00 00:00:00', NULL),
(2, 'member', 1, '0000-00-00 00:00:00', NULL),
(3, 'siswa', 1, '2019-01-11 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ws_users_session`
--

CREATE TABLE `ws_users_session` (
  `ses_id` int(11) NOT NULL,
  `ses_users_id` int(11) NOT NULL,
  `ses_last_ip` varchar(15) NOT NULL,
  `last_user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ws_admin`
--
ALTER TABLE `ws_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ws_finance`
--
ALTER TABLE `ws_finance`
  ADD PRIMARY KEY (`id_finance`);

--
-- Indexes for table `ws_group`
--
ALTER TABLE `ws_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `ws_major`
--
ALTER TABLE `ws_major`
  ADD PRIMARY KEY (`major_id`),
  ADD UNIQUE KEY `major_name` (`major_name`);

--
-- Indexes for table `ws_media`
--
ALTER TABLE `ws_media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `ws_media_comment`
--
ALTER TABLE `ws_media_comment`
  ADD PRIMARY KEY (`media_comment_id`);

--
-- Indexes for table `ws_media_kategori`
--
ALTER TABLE `ws_media_kategori`
  ADD PRIMARY KEY (`med_kat_id`);

--
-- Indexes for table `ws_pegawai`
--
ALTER TABLE `ws_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `ws_school_fees`
--
ALTER TABLE `ws_school_fees`
  ADD PRIMARY KEY (`id_sf`);

--
-- Indexes for table `ws_siswa`
--
ALTER TABLE `ws_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- Indexes for table `ws_users`
--
ALTER TABLE `ws_users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `ws_users_role`
--
ALTER TABLE `ws_users_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `ws_users_session`
--
ALTER TABLE `ws_users_session`
  ADD PRIMARY KEY (`ses_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ws_admin`
--
ALTER TABLE `ws_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ws_finance`
--
ALTER TABLE `ws_finance`
  MODIFY `id_finance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ws_group`
--
ALTER TABLE `ws_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ws_major`
--
ALTER TABLE `ws_major`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ws_media`
--
ALTER TABLE `ws_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ws_media_comment`
--
ALTER TABLE `ws_media_comment`
  MODIFY `media_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ws_media_kategori`
--
ALTER TABLE `ws_media_kategori`
  MODIFY `med_kat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ws_pegawai`
--
ALTER TABLE `ws_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ws_school_fees`
--
ALTER TABLE `ws_school_fees`
  MODIFY `id_sf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ws_siswa`
--
ALTER TABLE `ws_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ws_users`
--
ALTER TABLE `ws_users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ws_users_role`
--
ALTER TABLE `ws_users_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ws_users_session`
--
ALTER TABLE `ws_users_session`
  MODIFY `ses_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
