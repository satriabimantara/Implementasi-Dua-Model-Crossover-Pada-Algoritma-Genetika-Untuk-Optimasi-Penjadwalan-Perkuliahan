-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2020 at 11:08 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genetika3`
--

-- --------------------------------------------------------

--
-- Table structure for table `alfabetkelas`
--

CREATE TABLE `alfabetkelas` (
  `id_alfabetkelas` int(11) NOT NULL,
  `nama_kelas` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alfabetkelas`
--

INSERT INTO `alfabetkelas` (`id_alfabetkelas`, `nama_kelas`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G'),
(8, 'H'),
(9, 'I'),
(10, 'J'),
(11, 'K'),
(12, 'L'),
(13, 'M'),
(14, 'N'),
(15, 'O'),
(16, 'P'),
(17, 'Q'),
(18, 'R'),
(19, 'S'),
(20, 'T'),
(21, 'U'),
(22, 'V'),
(23, 'W'),
(24, 'X'),
(25, 'Y'),
(26, 'Z');

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id_angkatan` int(11) NOT NULL,
  `tahun_angkatan` smallint(6) NOT NULL,
  `id_statusangkatan` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`id_angkatan`, `tahun_angkatan`, `id_statusangkatan`) VALUES
(2, 2017, 2),
(3, 2018, 2),
(4, 2019, 2),
(6, 2016, 2),
(7, 2020, 2);

--
-- Triggers `angkatan`
--
DELIMITER $$
CREATE TRIGGER `after_delete_angkatan` AFTER DELETE ON `angkatan` FOR EACH ROW DELETE FROM detailangkatan WHERE id_angkatan = old.id_angkatan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detailangkatan`
--

CREATE TABLE `detailangkatan` (
  `id_detailangkatan` int(11) NOT NULL,
  `id_angkatan` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `peserta_kelas` int(11) NOT NULL DEFAULT '0',
  `id_statuskelas` int(11) NOT NULL DEFAULT '0' COMMENT 'id kategori matkul untuk setiap kelas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailangkatan`
--

INSERT INTO `detailangkatan` (`id_detailangkatan`, `id_angkatan`, `id_kelas`, `peserta_kelas`, `id_statuskelas`) VALUES
(1, 6, 1, 24, 1),
(2, 6, 2, 22, 1),
(3, 6, 3, 25, 1),
(4, 2, 1, 30, 1),
(5, 2, 2, 32, 1),
(6, 2, 3, 33, 1),
(7, 3, 1, 32, 1),
(8, 3, 2, 30, 1),
(9, 3, 3, 32, 1),
(10, 3, 4, 35, 1),
(11, 4, 1, 30, 1),
(12, 4, 2, 35, 1),
(13, 4, 3, 30, 1),
(15, 4, 4, 35, 1),
(17, 4, 1, 20, 2),
(19, 4, 2, 22, 2),
(20, 4, 3, 20, 2),
(21, 4, 4, 20, 2),
(22, 3, 1, 22, 2),
(23, 3, 2, 20, 2),
(24, 3, 3, 22, 2),
(25, 0, 4, 18, 2),
(26, 3, 5, 20, 2),
(27, 3, 4, 20, 2),
(28, 2, 3, 15, 2),
(29, 2, 4, 20, 2),
(30, 2, 1, 20, 2),
(31, 2, 2, 18, 2),
(32, 4, 5, 15, 2),
(43, 4, 5, 35, 1),
(44, 3, 5, 35, 1),
(45, 7, 1, 35, 1),
(46, 7, 2, 30, 1),
(47, 7, 3, 32, 1),
(48, 7, 4, 33, 1),
(49, 7, 5, 32, 1),
(50, 7, 1, 22, 2),
(51, 7, 2, 22, 2),
(52, 7, 3, 22, 2),
(53, 7, 4, 22, 2),
(54, 7, 5, 22, 2),
(62, 2, 1, 10, 3),
(66, 6, 1, 25, 2),
(67, 6, 2, 25, 2),
(68, 6, 3, 25, 2),
(69, 6, 4, 25, 2),
(70, 6, 7, 10, 3),
(71, 6, 8, 10, 3),
(72, 6, 9, 10, 3),
(73, 6, 10, 10, 3),
(74, 6, 14, 10, 3),
(75, 6, 6, 10, 3),
(76, 6, 11, 10, 3),
(77, 6, 12, 10, 3),
(78, 6, 13, 10, 3),
(79, 2, 7, 10, 3),
(80, 2, 8, 10, 3),
(81, 2, 9, 10, 3),
(82, 2, 10, 10, 3),
(83, 2, 14, 10, 3),
(84, 2, 6, 10, 3),
(85, 2, 11, 10, 3),
(86, 2, 12, 10, 3),
(87, 2, 13, 10, 3);

--
-- Triggers `detailangkatan`
--
DELIMITER $$
CREATE TRIGGER `after_delete_detail_angkatan` AFTER DELETE ON `detailangkatan` FOR EACH ROW DELETE FROM detailmatkul WHERE id_detailangkatan = old.id_detailangkatan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detailmatkul`
--

CREATE TABLE `detailmatkul` (
  `id_detailmatkul` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_detailangkatan` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailmatkul`
--

INSERT INTO `detailmatkul` (`id_detailmatkul`, `id_matkul`, `id_detailangkatan`, `id_dosen`) VALUES
(116, 46, 7, 1),
(117, 46, 8, 1),
(118, 46, 9, 1),
(119, 46, 10, 1),
(125, 28, 11, 3),
(126, 28, 12, 3),
(129, 32, 17, 4),
(130, 32, 19, 4),
(131, 45, 10, 4),
(135, 61, 4, 5),
(136, 61, 5, 5),
(137, 61, 6, 5),
(141, 49, 22, 6),
(142, 49, 23, 6),
(143, 49, 24, 6),
(144, 49, 27, 6),
(145, 49, 26, 6),
(148, 30, 11, 7),
(149, 30, 12, 7),
(150, 30, 13, 7),
(151, 30, 15, 7),
(152, 29, 11, 8),
(153, 29, 12, 8),
(158, 26, 15, 9),
(163, 45, 7, 10),
(164, 45, 8, 10),
(165, 45, 9, 10),
(178, 59, 4, 13),
(179, 59, 5, 13),
(180, 59, 6, 13),
(182, 29, 13, 14),
(183, 29, 15, 14),
(186, 31, 17, 15),
(187, 31, 19, 15),
(188, 31, 20, 15),
(193, 28, 13, 16),
(194, 28, 15, 16),
(195, 32, 20, 16),
(196, 32, 21, 16),
(197, 32, 32, 16),
(198, 44, 10, 16),
(215, 26, 11, 20),
(216, 26, 12, 20),
(217, 26, 13, 20),
(218, 31, 21, 20),
(219, 31, 32, 20),
(221, 44, 7, 21),
(222, 44, 8, 21),
(223, 44, 9, 21),
(229, 9, 11, 22),
(230, 9, 12, 22),
(231, 9, 13, 22),
(232, 9, 15, 22),
(233, 25, 11, 23),
(234, 25, 12, 23),
(235, 25, 13, 23),
(236, 25, 15, 23),
(237, 41, 7, 25),
(238, 41, 8, 25),
(239, 41, 9, 25),
(240, 41, 10, 25),
(241, 1, 11, 14),
(242, 1, 12, 14),
(243, 1, 13, 14),
(244, 1, 15, 14),
(246, 2, 11, 22),
(247, 2, 12, 22),
(248, 2, 13, 22),
(249, 2, 15, 22),
(251, 3, 11, 23),
(252, 3, 12, 23),
(253, 3, 13, 23),
(254, 3, 15, 23),
(256, 5, 11, 8),
(257, 5, 12, 8),
(258, 5, 13, 8),
(259, 5, 15, 8),
(272, 27, 11, 2),
(273, 27, 12, 2),
(274, 27, 13, 2),
(275, 27, 15, 2),
(277, 8, 11, 9),
(278, 8, 12, 9),
(279, 8, 13, 9),
(280, 8, 15, 9),
(283, 56, 4, 1),
(284, 56, 5, 1),
(285, 56, 6, 1),
(287, 34, 7, 3),
(288, 34, 8, 4),
(289, 34, 9, 10),
(290, 34, 10, 10),
(292, 35, 7, 12),
(293, 35, 8, 12),
(294, 35, 9, 12),
(295, 35, 10, 12),
(297, 42, 7, 17),
(298, 42, 8, 17),
(299, 42, 9, 12),
(300, 42, 10, 12),
(302, 43, 7, 19),
(303, 43, 8, 19),
(304, 43, 9, 19),
(305, 43, 10, 18),
(307, 47, 7, 11),
(308, 47, 8, 11),
(309, 47, 9, 11),
(310, 47, 15, 9),
(312, 48, 22, 21),
(313, 48, 23, 21),
(314, 48, 24, 21),
(315, 48, 27, 21),
(316, 48, 26, 21),
(317, 40, 22, 20),
(318, 40, 23, 20),
(319, 40, 24, 13),
(320, 40, 27, 13),
(321, 40, 26, 13),
(322, 50, 4, 3),
(323, 50, 5, 3),
(324, 50, 6, 3),
(332, 52, 4, 11),
(333, 52, 5, 11),
(334, 52, 6, 14),
(337, 53, 4, 18),
(338, 53, 5, 18),
(340, 53, 6, 18),
(342, 60, 4, 8),
(343, 60, 5, 8),
(344, 60, 6, 8),
(347, 55, 4, 13),
(348, 55, 5, 13),
(349, 55, 6, 13),
(353, 62, 31, 17),
(354, 62, 28, 15),
(355, 62, 29, 15),
(366, 39, 7, 2),
(367, 39, 8, 2),
(368, 39, 9, 2),
(369, 39, 10, 2),
(370, 37, 7, 3),
(371, 51, 6, 5),
(372, 51, 5, 5),
(373, 51, 4, 12),
(374, 119, 1, 5),
(375, 119, 2, 5),
(376, 119, 3, 5),
(377, 37, 9, 6),
(378, 38, 9, 6),
(379, 38, 10, 6),
(380, 57, 31, 6),
(381, 57, 28, 6),
(382, 57, 29, 6),
(383, 57, 30, 14),
(384, 36, 7, 7),
(385, 36, 8, 7),
(386, 36, 9, 7),
(387, 36, 10, 7),
(388, 37, 8, 7),
(389, 37, 10, 16),
(390, 58, 28, 9),
(391, 58, 29, 9),
(392, 58, 30, 11),
(393, 58, 31, 11),
(394, 38, 7, 13),
(395, 38, 8, 13),
(396, 122, 11, 11),
(397, 122, 12, 11),
(398, 122, 13, 16),
(399, 122, 15, 16),
(400, 128, 11, 15),
(401, 128, 12, 15),
(402, 128, 13, 15),
(403, 128, 15, 15),
(404, 54, 4, 19),
(405, 54, 5, 19),
(406, 54, 6, 19),
(407, 127, 11, 20),
(408, 127, 12, 20),
(409, 127, 13, 20),
(410, 127, 15, 20),
(411, 33, 7, 21),
(412, 33, 8, 21),
(413, 33, 9, 21),
(414, 33, 10, 21),
(415, 117, 78, 1),
(416, 101, 70, 3),
(417, 100, 70, 4),
(418, 103, 71, 5),
(419, 112, 76, 8),
(420, 110, 75, 9),
(421, 111, 75, 9),
(422, 121, 77, 10),
(423, 116, 78, 10),
(424, 107, 73, 11),
(425, 105, 72, 14),
(426, 104, 72, 15),
(427, 102, 71, 17),
(428, 109, 74, 17),
(429, 106, 73, 18),
(430, 108, 74, 18),
(431, 113, 76, 19),
(432, 115, 77, 21),
(433, 62, 30, 17),
(434, 80, 83, 1),
(435, 65, 79, 3),
(436, 67, 79, 3),
(437, 64, 79, 4),
(438, 66, 79, 4),
(439, 93, 86, 4),
(440, 68, 80, 5),
(441, 69, 80, 5),
(442, 87, 84, 5),
(443, 91, 85, 6),
(444, 98, 87, 6),
(445, 88, 85, 8),
(446, 81, 83, 9),
(447, 84, 84, 9),
(448, 85, 84, 9),
(449, 95, 86, 10),
(450, 72, 81, 11),
(451, 76, 82, 11),
(452, 79, 82, 11),
(453, 78, 82, 12),
(454, 70, 80, 12),
(455, 86, 84, 12),
(456, 97, 87, 13),
(457, 74, 81, 14),
(458, 75, 81, 14),
(459, 73, 81, 15),
(460, 99, 87, 15),
(461, 89, 85, 16),
(462, 92, 86, 17),
(463, 94, 86, 17),
(464, 77, 82, 18),
(465, 82, 83, 18),
(466, 83, 83, 18),
(467, 96, 87, 18),
(468, 71, 80, 19),
(469, 90, 85, 20);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nip_dosen` varchar(100) DEFAULT '0',
  `nama_dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nip_dosen`, `nama_dosen`) VALUES
(1, '', 'Dr. Ir. I Ketut Gede Suhartana, S.Kom., M.Kom'),
(2, '', 'Drs. I Wayan Santiyasa, M.Si'),
(3, '', 'Dr. A A Istri Ngurah Eka Karyawati, S.Si., M.Eng'),
(4, '', 'Dr. Ngurah Agus Sanjaya ER, S.Kom., M.Kom.'),
(5, '', 'Cokorda Rai Adi Pramartha, ST.MM.Ph.D'),
(6, '', 'Dra. Luh Gede Astuti, M.Kom'),
(7, '', 'Luh Arida Ayu Rahning Putri, S.Kom., M.Cs'),
(8, '', 'I Gede Santi Astawa, ST., M.Cs'),
(9, '', 'I Komang Ari Mogi, S.Kom., M.Kom'),
(10, '', 'Ida Bagus Gede Dwidasmara, S.Kom., M.Cs'),
(11, '', 'I Dewa Made Bayu Atmaja D., S.Kom., M.Cs'),
(12, '', 'I Gusti Agung Gede Arya K., S.Kom., M.Kom'),
(13, '', 'I Gusti Anom Cahyadi Putra, ST., M.Cs'),
(14, '', 'Gst Ayu Vida Mastrika Giri, S.Kom., M.Cs'),
(15, '', 'Agus Muliantara, S.Kom., M.Kom'),
(16, '', 'I Made Widiartha, S.Si., M.Kom'),
(17, '', 'Ida Bagus Made Mahendra, S.Kom., M.Kom'),
(18, '', 'I Gede Arta Wibawa, ST., M.Cs'),
(19, '', 'I Putu Gede Hendra Suputra, S.Kom., M.Kom'),
(20, '', 'I Wayan Supriana, S.Si., M.Cs'),
(21, '', 'Made Agung Raharja, S.Si., M.Cs'),
(22, '', 'Dosen MIPA 1'),
(23, '', 'Dosen MIPA 2'),
(25, '', 'Dosen MIPA 3');

--
-- Triggers `dosen`
--
DELIMITER $$
CREATE TRIGGER `after_delete_dosen` AFTER DELETE ON `dosen` FOR EACH ROW DELETE FROM detailmatkul WHERE id_dosen = old.id_dosen
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(20) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`, `id_status`) VALUES
(1, 'Senin', 1),
(2, 'Selasa', 1),
(3, 'Rabu', 1),
(4, 'Kamis', 1),
(5, 'Jumat', 1),
(6, 'Sabtu', 2),
(7, 'Minggu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jam`
--

CREATE TABLE `jam` (
  `id_jam` int(11) NOT NULL,
  `kode_jam` varchar(50) NOT NULL,
  `rentang_jam` varchar(50) NOT NULL,
  `sks_jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam`
--

INSERT INTO `jam` (`id_jam`, `kode_jam`, `rentang_jam`, `sks_jam`) VALUES
(1, 'J1', '08.00-10.30', 3),
(2, 'J2', '10.30-13.00', 3),
(3, 'J3', '13.30-16.00', 3),
(4, 'J4', '08.00-09.40', 2),
(6, 'J5', '09.40-11.20', 2),
(7, 'J6', '11.20-13.00', 2),
(8, 'J7', '13.30-15.10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategorimatkul`
--

CREATE TABLE `kategorimatkul` (
  `id_kategorimatkul` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorimatkul`
--

INSERT INTO `kategorimatkul` (`id_kategorimatkul`, `nama_kategori`) VALUES
(1, 'Wajib'),
(2, 'Praktikum'),
(3, 'Pilihan');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'P'),
(7, 'K'),
(8, 'L'),
(9, 'M'),
(10, 'N'),
(11, 'Q'),
(12, 'R'),
(13, 'S'),
(14, 'O'),
(15, 'T'),
(16, 'U'),
(17, 'V'),
(18, 'W'),
(19, 'X'),
(20, 'Y'),
(21, 'Z');

--
-- Triggers `kelas`
--
DELIMITER $$
CREATE TRIGGER `after_delete_kelas` AFTER DELETE ON `kelas` FOR EACH ROW DELETE FROM detailangkatan WHERE id_kelas = old.id_kelas
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(11) NOT NULL,
  `kode_matkul` varchar(255) NOT NULL,
  `nama_matkul` varchar(255) NOT NULL,
  `sks_matkul` int(11) NOT NULL,
  `semester_matkul` int(11) NOT NULL,
  `id_kategorimatkul` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `kode_matkul`, `nama_matkul`, `sks_matkul`, `semester_matkul`, `id_kategorimatkul`) VALUES
(1, 'IF1610012', 'Bahasa Inggris ', 2, 1, 1),
(2, 'IF1610022', 'Kewarganegaraan ', 2, 1, 1),
(3, 'IF1610032', 'Bahasa Indonesia ', 2, 1, 1),
(5, 'IF1610053', 'Matematika Diskrit I ', 3, 1, 1),
(8, 'IF1610083', 'Sistem Digital ', 3, 1, 1),
(9, 'IF1620012', 'Ilmu Sosial dan Budaya Dasar  ', 2, 2, 1),
(25, 'IF1620022', 'Pancasila ', 2, 2, 1),
(26, 'IF1620033', 'Kalkulus II ', 3, 2, 1),
(27, 'IF1620043', 'Statistika Dasar ', 3, 2, 1),
(28, 'IF1620053', 'Struktur Data ', 3, 2, 1),
(29, 'IF1620063', 'Matematika Diskrit II', 3, 2, 1),
(30, 'IF1620073', 'Aljabar Linear Elementer', 3, 2, 1),
(31, 'IF1620083', 'Praktikum Sistem Digital', 1, 2, 2),
(32, 'IF1620091', 'Praktikum Algoritma dan Pemrograman', 1, 2, 2),
(33, 'IF1630013', 'Sistem Operasi ', 3, 3, 1),
(34, 'IF1630023', 'Basis Data ', 3, 3, 1),
(35, 'IF1630033', 'Desain dan Analisis Algoritma ', 3, 3, 1),
(36, 'IF1630043', 'Program Linear ', 3, 3, 1),
(37, 'IF1630053', 'Analisis Numerik', 3, 3, 1),
(38, 'IF1630063', 'Pengantar Kecerdasan Buatan ', 3, 3, 1),
(39, 'IF1630073', 'Pengantar Probabilitas ', 3, 3, 1),
(40, 'IF1630081', 'Praktikum Struktur Data ', 1, 3, 2),
(41, 'IF1640012', 'Etika', 2, 4, 1),
(42, 'IF1640023', 'Rekayasa Perangkat Lunak ', 3, 4, 1),
(43, 'IF1640033', 'Pemrograman Berorientasi Obyek ', 3, 4, 1),
(44, 'IF1640043', 'Riset Operasi ', 3, 4, 1),
(45, 'IF1640053', 'Basis Data Lanjut ', 3, 4, 1),
(46, 'IF1640063', 'Organisasi dan Arsitektur Komputer ', 3, 4, 1),
(47, 'IF1640073', 'Komunikasi Data dan Jaringan Komp. ', 3, 4, 1),
(48, 'IF1640081', 'Praktikum Sistem Operasi', 1, 4, 2),
(49, 'IF1640091', 'Praktikum Basis Data', 1, 4, 2),
(50, 'IF1650013', 'Teori Bahasa dan Otomata ', 3, 5, 1),
(51, 'IF1650023', 'Analisis dan Desain Sistem ', 3, 5, 1),
(52, 'IF1650033', 'Pemodelan dan Simulasi ', 3, 5, 1),
(53, 'IF1650043', 'Grafika Komputer ', 3, 5, 1),
(54, 'IF1650053', 'Pemrograman Berbasis Web ', 3, 5, 1),
(55, 'IF1650063', 'Metode Penelitian ', 2, 5, 1),
(56, 'IF1650072', 'Interaksi Manusia dan Komputer ', 3, 5, 1),
(57, 'IF1650081', 'Praktikum Pemrograman Berorientasi Obyek ', 1, 5, 2),
(58, 'IF1650091', 'Praktikum Komunikasi Data dan Jaringan Komp. ', 1, 5, 2),
(59, 'IF1660012', 'Tata Tulis Karya Ilmiah', 2, 6, 1),
(60, 'IF1660022', 'Kewirausahaan', 2, 6, 1),
(61, 'IF1660042', 'Etika Profesi', 2, 6, 1),
(62, 'IF1660051', 'Praktikum Pemrograman Berbasis Web', 1, 6, 2),
(63, 'IF1660032', 'KKN', 2, 6, 1),
(64, 'IF1801013', 'Penambangan Data Tekstual dan Pemrosesan Bahasan Alami (Text Mining and Natural Language Processing)', 3, 6, 3),
(65, 'IF1801023', 'Temu Kembali Informasi Tekstual (Text Retrieval)', 3, 6, 3),
(66, 'IF1801033', 'Pembelajaran Mesin untuk Data Tekstual (Machine Learning for Text)', 3, 6, 3),
(67, 'IF1801043', 'Analisis Semantik (Semantic Analysis)', 3, 6, 3),
(68, 'IF1801073', 'Manajemen Pengetahuan Semantik (Semantic Knowledge Management)', 3, 6, 3),
(69, 'IF1801083', 'Sistem Manajemen Pengetahuan (Knowledge Management Systems)', 3, 6, 3),
(70, 'IF1801093', 'Warisan Budaya Digital (Digital Heritage)', 3, 6, 3),
(71, 'IF1801103', 'Intelijen Bisnis dan Analisis (Business Intelligence and Analytics)', 3, 6, 3),
(72, 'IF1801133', 'Pemrosesan Sinyal Digital (Digital Signal Processing)', 3, 6, 3),
(73, 'IF1801143', 'Pengenalan Pola (Pattern Recognition)', 3, 6, 3),
(74, 'IF1801153', 'Sistem Temu Kembali Informasi Musik (Music Information Retrieval System)', 3, 6, 3),
(75, 'IF1801163', 'Sintesis Bunyi (Sound Synthesis)', 3, 6, 3),
(76, 'IF1801193', 'Pengolahan Bunyi Digital (Digital Sound Processing)', 3, 6, 3),
(77, 'IF1801203', 'Pengolahan Citra Digital (Digital Image Processing)', 3, 6, 3),
(78, 'IF1801213', 'Kompresi Data Multimedia (Multimedia Data Compression)', 3, 6, 3),
(79, 'IF1801223', 'Jaringan Multimedia (Multimedia Network)', 3, 6, 3),
(80, 'IF1801253', 'Kriptografi (Cryptography)', 3, 6, 3),
(81, 'IF1801263', 'Kriptoanalisis (Cryptoanalysis)', 3, 6, 3),
(82, 'IF1801273', 'Keamanan Sistem Informasi (Information System Security)', 3, 6, 3),
(83, 'IF1801283', 'Forensik Digital (Digital Forensics)', 3, 6, 3),
(84, 'IF1801313', 'Teknologi Nirkabel (Wireless Technology)', 3, 6, 3),
(85, 'IF1801323', 'Jaringan Sensor Terdistribusi (Distributed Sensor Networks)', 3, 6, 3),
(86, 'IF1801333', 'Data Integrasi dan Sensor Web (Data Integration and Web Sensors)', 3, 6, 3),
(87, 'IF1801343', 'Pemrosesan Dalam Jaringan (In-Network Processing)', 3, 6, 3),
(88, 'IF1801373', 'Analisis dan Pengolahan Data Digital (Digital Data Analysis and Processing)', 3, 6, 3),
(89, 'IF1801383', 'Metode Kecerdasan Buatan Lanjut (Advanced Artificial Intelligence Methods)', 3, 6, 3),
(90, 'IF1801393', 'Metode Penalaran (Reasoning Method)', 3, 6, 3),
(91, 'IF1801403', 'Sistem Pakar (Expert System)', 3, 6, 3),
(92, 'IF1801433', 'Manajemen Proyek Teknologi Informasi (Information Technology Project Management)', 3, 6, 3),
(93, 'IF1801443', 'Penambangan Data dan Analisis (Data Mining and Analytics)', 3, 6, 3),
(94, 'IF1801453', 'Pemrograman Berbasis Mobile (Mobile Programming)', 3, 6, 3),
(95, 'IF1801463', 'Gudang Data dan Basis Data Terdistribusi (Data Warehouse and Distributed Database)', 3, 6, 3),
(96, 'IF1801493', 'Kecerdasan Buatan Pada Pengembangan Game (Artificial Intelligence in Game Development)', 3, 6, 3),
(97, 'IF1801503', 'Realitas Virtual dan Tertambah (Augmented And Virtual Reality)', 3, 6, 3),
(98, 'IF1801513', 'Analisis Antarmuka (Interface Analysis)', 3, 6, 3),
(99, 'IF1801523', 'Visi Komputer (Computer Vision)', 3, 6, 3),
(100, 'IF1801053', 'Pemrosesan Data Tekstual pada Web (Text Processing on the Web)', 3, 7, 3),
(101, 'IF1801063', 'Representasi Pengetahuan Data Tekstual (Text Knowledge Representation)', 3, 7, 3),
(102, 'IF1801113', 'Manajemen Data dan Informasi (Data and Information Management)', 3, 7, 3),
(103, 'IF1801123', 'Evaluasi Teknologi Informasi (Information Technology Evaluation)', 3, 7, 3),
(104, 'IF1801173', 'Pengantar Pembelajaran Mesin (Introduction to Machine Learning)', 3, 7, 3),
(105, 'IF1801183', 'Pengantar Komputasi Lunak (Introduction to Soft Computing)', 3, 7, 3),
(106, 'IF1801233', 'Pengolahan Video Digital (Digital Video Processing)', 3, 7, 3),
(107, 'IF1801243', 'Kualitas Pelayanan Jaringan pada Jaringan Multimedia (Quality of Service in Multimedia Networks)', 3, 7, 3),
(108, 'IF1801293', 'Steganografi (Steganography)', 3, 7, 3),
(109, 'IF1801303', 'Keamanan Sistem Mobile (Mobile System Security)', 3, 7, 3),
(110, 'IF1801353', 'Keamanan Jaringan Sensor (Sensor Networks Security)', 3, 7, 3),
(111, 'IF1801363', 'Keamanan Agregasi Data (Secure Data Agregation)', 3, 7, 3),
(112, 'IF1801413', 'Sistem Optimasi (Optimization System)', 3, 7, 3),
(113, 'IF1801423', 'Sistem Temu Kembali Berbasis Komputasi Cerdas (Smart-Computing Information Retrieval System)', 3, 7, 3),
(115, 'IF1801483', 'Sistem Informasi Geografis dan Analisis Data Spasial (Geographic Information System and Spatial Data Analytics)', 3, 7, 3),
(116, 'IF1801533', 'Pengembangan Aplikasi Multimedia (Multimedia Apllication System)', 3, 7, 3),
(117, 'IF1801543', 'Ergonomi Terapan (Applied Ergonomics)', 3, 7, 3),
(118, 'IF1670012', 'PKL', 2, 7, 1),
(119, 'IF1670022', 'Komputer dan Masyarakat', 2, 7, 1),
(120, 'IF1680016', 'Tugas Akhir', 6, 8, 1),
(121, 'IF1801473', 'Perdagangan Elektronik dan Intelijen Bisnis (e-Commerce and Business Intelligence)', 3, 7, 3),
(122, 'IF1610063', 'Algoritma dan Pemrograman ', 3, 1, 1),
(127, 'IF1610043', 'Kalkulus I', 3, 1, 1),
(128, 'IF1610073', 'Logika Informatika', 3, 1, 1);

--
-- Triggers `matkul`
--
DELIMITER $$
CREATE TRIGGER `after_delete_matkul` AFTER DELETE ON `matkul` FOR EACH ROW DELETE FROM detailmatkul WHERE id_matkul = old.id_matkul
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `kapasitas_ruangan` int(11) NOT NULL,
  `lokasi_ruangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `kapasitas_ruangan`, `lokasi_ruangan`) VALUES
(1, 'BC 11', 35, 'Gedung BC Kampus Bukit Jimbaran'),
(2, 'BC 12', 35, 'Gedung BC Kampus Bukit Jimbaran'),
(3, 'BC 21', 35, 'Gedung BC Kampus Bukit Jimbaran'),
(4, 'BC 22', 35, 'Gedung BC Kampus Bukit Jimbaran'),
(6, 'BD 12', 40, 'Gedung BD Kampus Bukit Jimbaran'),
(7, 'Laboratorium Information System', 10, 'Gedung BD Kampus Bukit Jimbaran'),
(8, 'Laboratorium Computational & Intelligent System', 10, 'Gedung BD Kampus Bukit Jimbaran'),
(9, 'Laboratorium Programming', 25, 'Gedung BF Kampus Bukit Jimbaran'),
(10, 'Laboratorium Net Centric Computing', 25, 'Gedung BF Kampus Bukit Jimbaran'),
(11, 'Laboratorium Micro Computing', 10, 'Gedung BD Kampus Bukit Jimbaran'),
(12, 'Laboratorium Ergonomic Computing', 10, 'Gedung BD Kampus Bukit Jimbaran'),
(13, 'BD 11', 40, 'Gedung BD Kampus Bukit Jimbaran');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
(1, 'Aktif'),
(2, 'Non-Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `statusangkatan`
--

CREATE TABLE `statusangkatan` (
  `id_statusangkatan` int(11) NOT NULL,
  `nama_statusangkatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statusangkatan`
--

INSERT INTO `statusangkatan` (`id_statusangkatan`, `nama_statusangkatan`) VALUES
(1, 'Lulus'),
(2, 'Belum Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(300) NOT NULL,
  `email_user` varchar(300) NOT NULL,
  `hp_user` varchar(15) NOT NULL,
  `username_user` varchar(500) NOT NULL,
  `password_user` varchar(500) NOT NULL,
  `status_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `hp_user`, `username_user`, `password_user`, `status_user`) VALUES
(2, 'I Made Satria Bimantara', 'satria_md@yahoo.com', '081337700152', 'satria', '$2y$10$ongjSHc4nROzSAxxd0kzPukHV6MOLCeDfx3qwFurzkrDjTCSV.fti', 'Admin'),
(3, 'Budi', 'budiraharjo@gmail.com', '081334455189', 'budi', '$2y$10$BxkNV2eWiUEwiK3Q4kaYe.7QP/HcE56wwrpA8dtrruQgqIqSLZfj.', 'Admin'),
(4, 'I Made Satria Bimantara', 'satriabimantara34@gmail.com', '089676355898', 'bimbim', '$2y$10$dggn2xeU1Wp.f8qWg0cfMOvvYl87.5z.WxnKhnE6c9z8wRtOdtjhy', 'User'),
(5, 'I Wayan Supriana', 'wayan.supriana@unud.ac.id', '08349765964', 'iwayansupriana', '$2y$10$zzuVYvUKz.zRbaDjFKh/SOl59tOXUnsXooj1eMfRoJJTntZz9oJAu', 'Admin'),
(6, 'ketut alit', 'ketut.alit@unud.ac.id', '081999988540', 'ketutalit', '$2y$10$lIeZ1NnTEjLNjtHY4pVxqepjXF8fYSwPcA3ikgIKQkUUWfrHsLnHq', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alfabetkelas`
--
ALTER TABLE `alfabetkelas`
  ADD PRIMARY KEY (`id_alfabetkelas`);

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indexes for table `detailangkatan`
--
ALTER TABLE `detailangkatan`
  ADD PRIMARY KEY (`id_detailangkatan`);

--
-- Indexes for table `detailmatkul`
--
ALTER TABLE `detailmatkul`
  ADD PRIMARY KEY (`id_detailmatkul`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `kategorimatkul`
--
ALTER TABLE `kategorimatkul`
  ADD PRIMARY KEY (`id_kategorimatkul`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `statusangkatan`
--
ALTER TABLE `statusangkatan`
  ADD PRIMARY KEY (`id_statusangkatan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alfabetkelas`
--
ALTER TABLE `alfabetkelas`
  MODIFY `id_alfabetkelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id_angkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detailangkatan`
--
ALTER TABLE `detailangkatan`
  MODIFY `id_detailangkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `detailmatkul`
--
ALTER TABLE `detailmatkul`
  MODIFY `id_detailmatkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jam`
--
ALTER TABLE `jam`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategorimatkul`
--
ALTER TABLE `kategorimatkul`
  MODIFY `id_kategorimatkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statusangkatan`
--
ALTER TABLE `statusangkatan`
  MODIFY `id_statusangkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
