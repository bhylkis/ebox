-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2021 at 03:45 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-grup`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(200) NOT NULL,
  `penulis_komentar` varchar(100) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` varchar(100) NOT NULL,
  `id_post` int(100) NOT NULL,
  `pp_penulis` text NOT NULL,
  `penulis_post` varchar(100) NOT NULL,
  `lihat_komentar` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `penulis_komentar`, `isi_komentar`, `tanggal_komentar`, `id_post`, `pp_penulis`, `penulis_post`, `lihat_komentar`) VALUES
(90, 'mutia', 'keren', '18:57 12/02/2021', 25, '', 'mutia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lihat`
--

CREATE TABLE `lihat` (
  `user_lihat` varchar(100) NOT NULL,
  `lihat` int(5) NOT NULL,
  `apa_lihat` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lihat`
--

INSERT INTO `lihat` (`user_lihat`, `lihat`, `apa_lihat`) VALUES
('tegar', 0, 'komentar'),
('tegar', 1, 'like'),
('hiqmal', 0, 'komentar'),
('hiqmal', 0, 'like'),
('Rizki', 0, 'komentar'),
('mario', 0, 'komentar'),
('mario', 0, 'like'),
('Rizki', 0, 'like'),
('bhylkis', 0, 'komentar'),
('bhylkis', 1, 'like'),
('iki', 0, 'komentar'),
('iki', 0, 'like'),
('nauru', 0, 'komentar'),
('nauru', 0, 'like'),
('zein', 0, 'komentar'),
('zein', 0, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(200) NOT NULL,
  `judul_post` varchar(200) NOT NULL,
  `isi_post` text NOT NULL,
  `penulis_post` varchar(100) NOT NULL,
  `tanggal_post` varchar(100) NOT NULL,
  `gambar_post` text NOT NULL,
  `suka_post` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `judul_post`, `isi_post`, `penulis_post`, `tanggal_post`, `gambar_post`, `suka_post`) VALUES
(30, 'halo', 'saya zen', 'zen', '23:23 25/02/2021', '', 3),
(27, 'SARANA', 'apasih?', 'zen', '22:43 25/02/2021', '20210225_224336220px-Joko_Widodo_2019_official_portrait.jpg', 2),
(32, 'SARANA', 'baik nih di 26', 'mutia', '20:40 01/03/2021', '', 1),
(33, 'SARANA', 'hay', 'mutia', '20:41 01/03/2021', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suka_post`
--

CREATE TABLE `suka_post` (
  `id_suka` bigint(20) UNSIGNED NOT NULL,
  `user_suka` varchar(100) NOT NULL,
  `id_post` int(200) NOT NULL,
  `post_suka` int(5) NOT NULL,
  `penulis_post` varchar(100) NOT NULL,
  `tanggal_suka` varchar(100) NOT NULL,
  `lihat_suka` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suka_post`
--

INSERT INTO `suka_post` (`id_suka`, `user_suka`, `id_post`, `post_suka`, `penulis_post`, `tanggal_suka`, `lihat_suka`) VALUES
(67, 'mutia', 25, 1, 'mutia', '18:57 12/02/2021', 0),
(90, 'tegar', 27, 1, 'zen', '20:05 01/03/2021', 1),
(111, 'mutia', 32, 1, 'mutia', '20:41 01/03/2021', 1),
(96, 'bhylkis', 30, 1, 'zen', '20:07 01/03/2021', 1),
(110, 'mutia', 30, 1, 'zen', '20:40 01/03/2021', 1),
(76, 'tegar', 25, 1, 'mutia', '19:11 12/02/2021', 1),
(78, 'iki', 25, 1, 'mutia', '14:35 22/02/2021', 1),
(103, 'bhylkis', 27, 1, 'zen', '20:08 01/03/2021', 1),
(91, 'tegar', 30, 1, 'zen', '20:05 01/03/2021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tegar`
--

CREATE TABLE `tegar` (
  `pengumuman_tegar` text NOT NULL,
  `izin_reg_tegar` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tegar`
--

INSERT INTO `tegar` (`pengumuman_tegar`, `izin_reg_tegar`) VALUES
('Jangan Lupa Kelas 8.5 Nanti Kita Bersih Bersih Kelas...', 1),
('AYOK ISI SARANNYA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_user` varchar(100) NOT NULL,
  `pass_user` varchar(100) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `jk_user` varchar(50) NOT NULL,
  `status_user` varchar(50) NOT NULL,
  `pp_user` text NOT NULL,
  `tanggal_login_user` varchar(100) NOT NULL,
  `level_user` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_user`, `pass_user`, `nama_user`, `jk_user`, `status_user`, `pp_user`, `tanggal_login_user`, `level_user`) VALUES
('tegar', 'tegar', 'Tegar Santosa', 'Pria', 'Offline', 'user.jpg', '20:04 01/03/2021', 1),
('iki', '12345', 'Muhammad Rifki', 'Pria', 'Offline', '', '17:06 22/02/2021', 0),
('Nopa', '121212', 'Nopa', 'Pria', 'Offline', '', '', 0),
('nau', '121212', 'Nauru Anaba', 'Pria', 'Offline', '', '', 0),
('mutia', '12345', 'mutia zahra', 'Wanita', 'Offline', '', '20:39 01/03/2021', 0),
('bhylkis', '12345', 'Bhylkis Syiva Mahoni', 'Pria', 'Offline', 'user.jpg', '21:25 01/03/2021', 0),
('zen', '123123', 'Zein As', 'Pria', 'Offline', '', '23:12 25/02/2021', 0),
('cahya', '12345', 'cahya kumadi', 'Pria', 'Offline', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idu` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `first_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(128) NOT NULL,
  `bio` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `facebook` varchar(256) NOT NULL,
  `twitter` varchar(128) NOT NULL,
  `gplus` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `private` int(11) NOT NULL,
  `salted` varchar(256) NOT NULL,
  `background` varchar(256) NOT NULL,
  `cover` varchar(128) NOT NULL,
  `verified` int(11) NOT NULL,
  `privacy` int(11) NOT NULL DEFAULT 1,
  `gender` tinyint(4) NOT NULL,
  `online` int(11) NOT NULL,
  `offline` tinyint(4) NOT NULL,
  `notificationl` tinyint(4) NOT NULL,
  `notificationc` tinyint(4) NOT NULL,
  `notificationm` tinyint(4) NOT NULL,
  `notificationd` tinyint(4) NOT NULL,
  `email_comment` tinyint(4) NOT NULL,
  `email_like` int(11) NOT NULL,
  `born` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idu`, `username`, `password`, `email`, `first_name`, `last_name`, `location`, `website`, `bio`, `date`, `facebook`, `twitter`, `gplus`, `image`, `private`, `salted`, `background`, `cover`, `verified`, `privacy`, `gender`, `online`, `offline`, `notificationl`, `notificationc`, `notificationm`, `notificationd`, `email_comment`, `email_like`, `born`) VALUES
(30, 'tegar', '714440abdc2359b0533fd3cbbe29382c', '08971158242', 'Tegar', 'Santosa', 'Metro, Lampung', 'http://http://teziger.blogspot.com', 'Editor', '2016-08-22', 'mtegarsp', 'tegarsantosa_p', '+TegarSantosaP', '1805422046_549028107_132432099.jpg', 0, '', '', '717741620_706237106_530786799.jpg', 1, 1, 1, 1472126837, 0, 1, 1, 1, 1, 1, 1, '2002-04-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `suka_post`
--
ALTER TABLE `suka_post`
  ADD PRIMARY KEY (`id_suka`),
  ADD UNIQUE KEY `id_suka` (`id_suka`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`idu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `suka_post`
--
ALTER TABLE `suka_post`
  MODIFY `id_suka` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
