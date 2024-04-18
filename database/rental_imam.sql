-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 06:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_imam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2023-11-27 01:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `kode_booking` varchar(8) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `driver` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pickup` varchar(30) NOT NULL,
  `tgl_booking` date NOT NULL,
  `bukti_bayar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`kode_booking`, `id_mobil`, `tgl_mulai`, `tgl_selesai`, `durasi`, `driver`, `status`, `email`, `pickup`, `tgl_booking`, `bukti_bayar`) VALUES
('TRX', 1, '2023-11-28', '2023-11-30', 3, 1350000, 'Selesai', 'rugimaku@gmail.com', 'Ambil Sendiri', '2023-11-27', '27112023081455VID-20200417-WA0011.mp4_snapshot_04.08.524.jpg'),
('TRX1', 1, '2023-12-28', '2023-12-29', 2, 900000, 'Selesai', 'rugimaku@gmail.com', 'Ambil Sendiri', '2023-11-29', '29112023051704foto.png'),
('TRX2', 1, '2023-12-13', '2023-12-14', 2, 900000, 'Sudah Dibayar', 'rugimaku@gmail.com', 'Ambil Sendiri', '2023-11-29', '29112023153409Screenshot (107).png'),
('TRX3', 2, '2024-01-01', '2024-01-02', 2, 900000, 'Selesai', 'rugimaku@gmail.com', 'Ambil Sendiri', '2023-11-29', '29112023153248Screenshot (103).png'),
('TRX4', 2, '2024-01-29', '2024-01-30', 2, 900000, 'Sudah Dibayar', 'rugimaku@gmail.com', 'Pickup Sesuai Alamat', '2023-11-29', '29112023161815Screenshot (103).png'),
('TRX5', 2, '2023-12-04', '2023-12-05', 2, 900000, 'Menunggu Pembayaran', 'yusuf@gmail.com', 'Ambil Sendiri', '2023-12-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cek_booking`
--

CREATE TABLE `cek_booking` (
  `kode_booking` varchar(8) DEFAULT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `tgl_booking` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cek_booking`
--

INSERT INTO `cek_booking` (`kode_booking`, `id_mobil`, `tgl_booking`, `status`) VALUES
('TRX', 1, '2023-11-28', 'Selesai'),
('TRX', 1, '2023-11-29', 'Selesai'),
('TRX', 1, '2023-11-30', 'Selesai'),
('TRX', 1, '2023-12-01', 'Selesai'),
('TRX1', 1, '2023-12-28', 'Selesai'),
('TRX1', 1, '2023-12-29', 'Selesai'),
('TRX1', 1, '2023-12-30', 'Selesai'),
('TRX2', 1, '2023-12-13', 'Sudah Dibayar'),
('TRX2', 1, '2023-12-14', 'Sudah Dibayar'),
('TRX2', 1, '2023-12-15', 'Sudah Dibayar'),
('TRX3', 2, '2024-01-01', 'Selesai'),
('TRX3', 2, '2024-01-02', 'Selesai'),
('TRX3', 2, '2024-01-03', 'Selesai'),
('TRX4', 2, '2024-01-29', 'Sudah Dibayar'),
('TRX4', 2, '2024-01-30', 'Sudah Dibayar'),
('TRX4', 2, '2024-01-31', 'Sudah Dibayar'),
('TRX5', 2, '2023-12-04', 'Menunggu Pembayaran'),
('TRX5', 2, '2023-12-05', 'Menunggu Pembayaran'),
('TRX5', 2, '2023-12-06', 'Menunggu Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `contactusinfo`
--

CREATE TABLE `contactusinfo` (
  `id_info` int(11) NOT NULL,
  `alamat_kami` tinytext DEFAULT NULL,
  `email_kami` varchar(255) DEFAULT NULL,
  `telp_kami` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contactusinfo`
--

INSERT INTO `contactusinfo` (`id_info`, `alamat_kami`, `email_kami`, `telp_kami`) VALUES
(1, 'Rental Mobil \r\nJl. Kemanggisan Raya No.19, RT.4/RW.13, Kemanggisan, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11480', 'rentalmobil@gmail.com', '08585233222');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id_merek` int(11) NOT NULL,
  `nama_merek` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id_merek`, `nama_merek`, `CreationDate`, `UpdationDate`) VALUES
(16, 'Hyundai', '2023-11-26 21:38:15', NULL),
(17, 'Toyota', '2023-12-03 18:42:34', NULL),
(18, 'Daihatsu', '2023-12-03 18:42:47', NULL),
(19, 'Suzuki', '2023-12-03 18:42:53', NULL),
(20, 'Mitsubishi', '2023-12-03 18:43:02', NULL),
(21, 'Honda', '2023-12-03 18:43:08', NULL),
(22, 'Volkswagen', '2023-12-03 18:43:40', NULL),
(23, 'BMW', '2023-12-03 18:43:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(150) DEFAULT NULL,
  `id_merek` int(11) DEFAULT NULL,
  `nopol` varchar(20) NOT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `bb` varchar(100) DEFAULT NULL,
  `tahun` int(6) DEFAULT NULL,
  `seating` int(11) DEFAULT NULL,
  `image1` varchar(120) DEFAULT NULL,
  `image2` varchar(120) DEFAULT NULL,
  `image3` varchar(120) DEFAULT NULL,
  `image4` varchar(120) DEFAULT NULL,
  `image5` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `nama_mobil`, `id_merek`, `nopol`, `deskripsi`, `harga`, `bb`, `tahun`, `seating`, `image1`, `image2`, `image3`, `image4`, `image5`, `RegDate`, `UpdationDate`) VALUES
(1, 'Innova', 17, 'BA 1655 SSK', 'Kijang Innova Zenix Hybrid dengan mesin 2000cc dibekali baterai listrik. Kijang Innova Zenix Warna Putih dengan type Q Hybrid siap disewakan', 450000, 'Bensin', 2022, 7, '1-Platinum-White-Pearl_0.png', 'kijang-innova-zenix-2-860x474.jpg', '637b53a15fc42.jpeg', '637b53a142336.jpeg', 'asdadad.jpeg', '2023-11-26 21:46:59', '2023-12-03 19:23:52'),
(2, 'Avanza', 17, 'BA 1655 RS', 'Mobil Sejuta Umat dengan type G Mesin 1300cc. Berwarna Hitam Kondisi Mulus Keluaran 2019 Siap disewakan', 350000, 'Bensin', 2019, 7, '1.png', 'avanza-facelift-2019.jpg', 'interior4.jpg', 'w131.jpeg', 'avanza-2019-20-ce1b.jpeg', '2023-11-28 23:39:50', '2023-12-03 18:50:24'),
(3, 'Jimmy', 19, 'BA 998 RS', 'Mobil offroad keluaran suzuki dengan mesin 1500cc dipastikan irit BBM. Mobil ini sudah menggunakan penggerak 4x4 jadi tangguh melewati medan offroad yang berat.', 370000, 'Bensin', 2020, 3, '17425903586111bd56e587c071532644_0_0-1.png', 'suzuki-jimny-2019-samping-belakang-47a5.jpg', 'interrr.jpeg', 'download (1).jpeg', '2155358004.jpg', '2023-12-03 18:52:12', NULL),
(4, 'Pajero', 20, 'B 1054 KKJ', 'Mobil Offroad Keluarga bermesin diesel turbo 2400cc. Mobil ini dengan torsi tinggi dan tenaga yang siap dibawa medan extreme. Mobil ini Tipe Ulitmate Dakar dengan Transmisi A/T dibekali Penggerak 4x4.', 480000, 'Diesel', 2017, 7, 'Pajero-Sport-Dakar-Ultimate-4x2.png', 'belakang-pajero-sport-rockford-fosgate-a40e.png', 'mitsubishi-pajero-fu-9faa.png', 'dafaf.jpeg', 'Review-Pajero-Sport-baru-2016-Indonesia-1.jpg', '2023-12-03 18:54:47', NULL),
(5, 'Brio', 21, 'BA 1876 NE', 'Brio Satya Merupakan Mobil LCGC keluaran honda dengan mesin 1200cc. Mobil ini cukup irit BBM.', 250000, 'Bensin', 2020, 3, 'a05UD4lPNedTJzH4cOYUcUZiwKeSf4TGrY0Al5Qn.png', '2018-honda-brio-saty-3bea.jpg', 'BRIO-RS-2023_Interior_Final-scaled.jpg', 'featinterior__1682496098333.jpg', 'featbagasikoper__1683206092043.jpg', '2023-12-03 19:06:00', NULL),
(6, 'Colt', 20, 'BA 4599 KA', 'Mobil Pick Up Colt L300 daya angkut yang besar. Dapat membawa banyak barang. Mesin mobil ini diesel euro4 kapasitas 2200cc.', 200000, 'Diesel', 2021, 2, 'NewL300-683x400.png', '8996915418958bcc88b7f9dde2c351ae.jpg', 'download.jpeg', 'mitsubishi-ambil-keputusan-berhenti-kembangkan-mesin-diesel-I9b3oK052l.jpg', 'images.jpeg', '2023-12-03 19:08:33', NULL),
(7, 'Alya', 18, 'BA 1766 HJ', 'Mobil LCGC Keluaran Daihatsu dengan mesin 1000cc menjadikan mobil ini irit BBM.', 235000, 'Bensin', 2018, 3, 'daihatsu-ayla-1_169.png', 'bagian-belakang-ayla-b2cf.png', '2019_Daihatsu_Ayla_1.2_R_Deluxe_B101RS_interior_(20190722).jpg', 'all-new-daihatsu-ayla-8_169.jpeg', '2423395211.jpg', '2023-12-03 19:14:49', NULL),
(8, 'Supra', 17, 'B 1002 AAK', 'MK4 Supra Mobil Sport Legendaris keluaran toyota banyak incaran anak muda. Mobil ini udah dilakukan banyak modifikasi bagian mesin dan penambahan tenaga dan torsi sehingga dapat berlari secepat kilat.', 750000, 'Bensin', 2004, 2, 'image-asset-removebg-preview.png', 'adadsad.jpeg', 'fit-mesin-supra.jpeg', '8wmt2fp8gas61.jpg', '5e37fb706ad00.jpeg', '2023-12-03 19:17:15', NULL),
(9, 'GLOLF', 22, 'B 1077 STT', 'WV Gloft GTI merupakan mobil hatchback bermesin mobil sport 2000cc turbo. Memberikan pengalaman mengemudi yang baik dalam performa kecepatan dan kenyamanan berkendara.', 500000, 'Bensin', 2020, 4, '465b804e5348fedff3375b092d5d27bd.png', '82583-Vokswagen-Golf-GTI-Clubsport-ABT2-960x545_.jpg', 'Interior-VW-Golf-GTI-Indonesia.jpg', '2018-Volkswagen-Golf-Interior-cutaway_o-e1522186246444.jpg', 'DB2013AU00828_web_1600.jpg', '2023-12-03 19:22:44', NULL),
(10, 'CIvic', 21, 'BK 2009 IJ', 'Civic Turbo bermesin 1500cc pesaing beratnya Corolla Altis. ', 400000, 'Bensin', 2018, 4, 'png-clipart-honda-civic-type-r-car-honda-hr-v-honda-type-r-honda-compact-car-sedan-removebg-preview.png', 'png-transparent-2018-subaru-impreza-compact-car-honda-civic-type-r-honda-sedan-car-subcompact-car.png', 'Honda_CIVIC_TYPE_R_(FK8)_interior.jpg', 'acacacac.jpg', 'png-transparent-honda-civic-type-r-car-manila-international-auto-show-honda-today-honda-compact-car-sedan-car-removebg-p', '2023-12-03 19:26:57', NULL),
(11, 'GrandMax', 18, 'BA 1234 GH', 'Mobil Niaga dengan tipe minibus van. Mesin 1500cc seperti mesin xenia.', 200000, 'Bensin', 2015, 9, '1662995704138.png', '236079-gran-max-mpv-grandmax-d-2014-manual-hitam-istimewa-surabaya-4.jpg', '1137128_720.jpg', 'mobil_g_28042020142506.jpg', '1Q3A0664OK-1.jpg', '2023-12-03 19:31:49', '2023-12-03 19:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Terms and Conditions', 'terms', '																																																																		<h2><span style=\"font-size: x-large;\"><span class=\"purple\" style=\"\">Syarat</span> Ketentuan Penyewaan Mobil</span></h2><div><h4>\r\n	<span style=\"font-size: large;\"><span data-scayt_word=\"Persyaratan\" data-scaytid=\"1\" style=\"\">1. Persyaratan</span> Rental Mobil <span data-scayt_word=\"untuk\" data-scaytid=\"2\" style=\"\">untuk</span> <span data-scayt_word=\"Perusahaan\" data-scaytid=\"3\" style=\"\">Perusahaan</span></span></h4>\r\n<ul><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"4\">Fotokopi</span> <span data-scayt_word=\"SIUP\" data-scaytid=\"7\">SIUP</span> <span data-scayt_word=\"dan\" data-scaytid=\"8\">dan</span> <span data-scayt_word=\"NPWP\" data-scaytid=\"9\">NPWP</span>.</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"5\">Fotokopi</span> <span data-scayt_word=\"akte\" data-scaytid=\"10\">akte</span> <span data-scayt_word=\"pendirian\" data-scaytid=\"11\">pendirian</span> <span data-scayt_word=\"perusahaan\" data-scaytid=\"12\">perusahaan</span>.</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"6\">Fotokopi</span> <span data-scayt_word=\"Tanda\" data-scaytid=\"14\">Tanda</span> <span data-scayt_word=\"Daftar\" data-scaytid=\"15\">Daftar</span> <span data-scayt_word=\"perusahaan\" data-scaytid=\"13\">perusahaan</span>.</li><li>\r\n		<span data-scayt_word=\"Surat\" data-scaytid=\"20\">Surat</span> <span data-scayt_word=\"keterangan\" data-scaytid=\"22\">keterangan</span> <span data-scayt_word=\"domisili\" data-scaytid=\"23\">domisili</span> <span data-scayt_word=\"perusahaan\" data-scaytid=\"16\">perusahaan</span>.</li><li>\r\n		<span data-scayt_word=\"Surat\" data-scaytid=\"21\">Surat</span> <span data-scayt_word=\"pengesahan\" data-scaytid=\"25\">pengesahan</span> <span data-scayt_word=\"keputusan\" data-scaytid=\"26\">keputusan</span> <span data-scayt_word=\"menteri\" data-scaytid=\"27\">menteri</span> <span data-scayt_word=\"Hukum\" data-scaytid=\"28\">Hukum</span> <span data-scayt_word=\"dan\" data-scaytid=\"17\">dan</span> Ham</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"19\">Fotokopi</span> <span data-scayt_word=\"KTP\" data-scaytid=\"32\">KTP</span> <span data-scayt_word=\"direksi\" data-scaytid=\"33\">direksi</span>, <span data-scayt_word=\"dan\" data-scaytid=\"18\">dan</span> <span data-scayt_word=\"pejabat\" data-scaytid=\"34\">pejabat</span> yang <span data-scayt_word=\"bertanggung\" data-scaytid=\"35\">bertanggung</span> <span data-scayt_word=\"jawab\" data-scaytid=\"36\">jawab</span> <span data-scayt_word=\"terhadap\" data-scaytid=\"37\">terhadap</span> unit <span data-scayt_word=\"kendaraan\" data-scaytid=\"38\">kendaraan</span>.</li><li>\r\n		<span data-scayt_word=\"Surat\" data-scaytid=\"39\">Surat</span> <span data-scayt_word=\"kuasa\" data-scaytid=\"58\">kuasa</span> <span data-scayt_word=\"bila\" data-scaytid=\"59\">bila</span> <span data-scayt_word=\"bukan\" data-scaytid=\"60\">bukan</span> <span data-scayt_word=\"direktur\" data-scaytid=\"61\">direktur</span> <span data-scayt_word=\"perusahaan\" data-scaytid=\"40\">perusahaan</span> yang <span data-scayt_word=\"bertanggung\" data-scaytid=\"42\">bertanggung</span> <span data-scayt_word=\"jawab\" data-scaytid=\"43\">jawab</span>.</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"44\">Fotokopi</span> <span data-scayt_word=\"SIM\" data-scaytid=\"67\">SIM</span> <span data-scayt_word=\"pengemudi\" data-scaytid=\"68\">pengemudi</span>.</li><li>\r\n		Survey <span data-scayt_word=\"lokasi\" data-scaytid=\"69\">lokasi</span> <span data-scayt_word=\"domisili\" data-scaytid=\"45\">domisili</span> <span data-scayt_word=\"perusahaan\" data-scaytid=\"41\">perusahaan</span>.</li></ul>\r\n<h4><span style=\"font-size: large;\"><span data-scayt_word=\"Persyaratan\" data-scaytid=\"53\" style=\"\"><br></span></span></h4><h4>\r\n	<span style=\"font-size: large;\"><span data-scayt_word=\"Persyaratan\" data-scaytid=\"53\" style=\"\">2. Persyaratan</span> Rental Mobil <span data-scayt_word=\"untuk\" data-scaytid=\"54\" style=\"\">untuk</span> <span data-scayt_word=\"Perorangan\" data-scaytid=\"85\" style=\"\">Perorangan</span></span></h4>\r\n<ul><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"55\">Fotokopi</span> <span data-scayt_word=\"bukti\" data-scaytid=\"88\">bukti</span> <span data-scayt_word=\"kepemilikan\" data-scaytid=\"89\">kepemilikan</span> <span data-scayt_word=\"rumah\" data-scaytid=\"90\">rumah</span> <span data-scayt_word=\"atau\" data-scaytid=\"91\">atau</span> <span data-scayt_word=\"tempat\" data-scaytid=\"92\">tempat</span> <span data-scayt_word=\"tinggal\" data-scaytid=\"93\">tinggal</span>.</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"56\">Fotokopi</span> <span data-scayt_word=\"PBB\" data-scaytid=\"94\">PBB</span>.</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"75\">Fotokopi</span> <span data-scayt_word=\"NPWP\" data-scaytid=\"79\">NPWP</span>.</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"76\">Fotokopi</span> <span data-scayt_word=\"KTP\" data-scaytid=\"80\">KTP</span> <span data-scayt_word=\"atau\" data-scaytid=\"101\">atau</span> <span data-scayt_word=\"KITAS\" data-scaytid=\"126\">KITAS</span> (<span data-scayt_word=\"pemohon\" data-scaytid=\"127\">pemohon</span> <span data-scayt_word=\"dan\" data-scaytid=\"81\">dan</span> <span data-scayt_word=\"penjamin\" data-scaytid=\"129\">penjamin</span>).</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"77\"><span data-scayt_word=\"Foto\" data-scaytid=\"436\">Foto</span>kopi</span> <span data-scayt_word=\"KK\" data-scaytid=\"130\">KK</span> (<span data-scayt_word=\"Kartu\" data-scaytid=\"131\">Kartu</span> <span data-scayt_word=\"Keluarga\" data-scaytid=\"132\">Keluarga</span>).</li><li>\r\n		<span data-scayt_word=\"Fotokopi\" data-scaytid=\"78\">Fotokopi</span> <span data-scayt_word=\"Pasport\" data-scaytid=\"133\">Pasport</span>.</li><li>\r\n		<span data-scayt_word=\"Foto\" data-scaytid=\"134\">Foto</span> <span data-scayt_word=\"kopi\" data-scaytid=\"135\">kopi</span> <span data-scayt_word=\"SIM\" data-scaytid=\"82\">SIM</span>.</li><li>\r\n		<span data-scayt_word=\"Foto\" data-scaytid=\"137\">Foto</span> <span data-scayt_word=\"kopi\" data-scaytid=\"138\">kopi</span> ID Card <span data-scayt_word=\"tempat\" data-scaytid=\"113\">tempat</span> <span data-scayt_word=\"bekerja\" data-scaytid=\"164\">bekerja</span>.</li><li>\r\n		<span data-scayt_word=\"Kartu\" data-scaytid=\"141\">Kartu</span> <span data-scayt_word=\"nama\" data-scaytid=\"166\">nama</span>.</li><li>\r\n		Tim surveyor <span data-scayt_word=\"kami\" data-scaytid=\"167\">kami</span> survey <span data-scayt_word=\"lokasi\" data-scaytid=\"115\">lokasi</span> <span data-scayt_word=\"alamat\" data-scaytid=\"169\">alamat</span> <span data-scayt_word=\"dan\" data-scaytid=\"116\">dan</span> <span data-scayt_word=\"tempat\" data-scaytid=\"114\">tempat</span> <span data-scayt_word=\"tinggal\" data-scaytid=\"117\">tinggal</span> <span data-scayt_word=\"penyewa\" data-scaytid=\"172\">penyewa</span>.</li><li>\r\n		<span data-scayt_word=\"Memiliki\" data-scaytid=\"173\">Memiliki</span> <span data-scayt_word=\"penjamin\" data-scaytid=\"145\">penjamin</span> (<span data-scayt_word=\"bila\" data-scaytid=\"118\">bila</span> <span data-scayt_word=\"diperlukan\" data-scaytid=\"176\">diperlukan</span>).</li><li>\r\n		<span data-scayt_word=\"ketersediaan\" data-scaytid=\"188\">ketersediaan</span> <span data-scayt_word=\"lahan\" data-scaytid=\"189\">lahan</span> <span data-scayt_word=\"parkir\" data-scaytid=\"190\">parkir</span> yang <span data-scayt_word=\"layak\" data-scaytid=\"191\">layak</span> <span data-scayt_word=\"dan\" data-scaytid=\"157\">dan</span> <span data-scayt_word=\"aman\" data-scaytid=\"193\">aman</span>.</li></ul>\r\n<div style=\"padding:15px; background:#efefef\">\r\n	<h4>\r\n		Note</h4>\r\n	<ul><li>\r\n			<span data-scayt_word=\"Prosedur\" data-scaytid=\"194\">Prosedur</span> survey <span data-scayt_word=\"kami\" data-scaytid=\"178\">kami</span> <span data-scayt_word=\"harus\" data-scaytid=\"196\">harus</span> <span data-scayt_word=\"dilakukan\" data-scaytid=\"197\">dilakukan</span> minimal 1 <span data-scayt_word=\"hari\" data-scaytid=\"198\">hari</span> <span data-scayt_word=\"sebelum\" data-scaytid=\"200\">sebelum</span> <span data-scayt_word=\"hari\" data-scaytid=\"199\">hari</span> H. (<span data-scayt_word=\"Perusahaan\" data-scaytid=\"158\">Perusahaan</span> <span data-scayt_word=\"memerlukan\" data-scaytid=\"202\">memerlukan</span> <span data-scayt_word=\"waktu\" data-scaytid=\"203\">waktu</span> <span data-scayt_word=\"untuk\" data-scaytid=\"159\">untuk</span> <span data-scayt_word=\"pengecekan\" data-scaytid=\"205\">pengecekan</span> <span data-scayt_word=\"legalitas\" data-scaytid=\"206\">legalitas</span>/<span data-scayt_word=\"keaslian\" data-scaytid=\"207\">keaslian</span> data customer).</li><li>\r\n			Customer <span data-scayt_word=\"wajib\" data-scaytid=\"208\">wajib</span> <span data-scayt_word=\"Membayar\" data-scaytid=\"209\">Membayar</span> <span data-scayt_word=\"uang\" data-scaytid=\"210\">uang</span> deposit <span data-scayt_word=\"sebagai\" data-scaytid=\"211\">sebagai</span> <span data-scayt_word=\"jaminan\" data-scaytid=\"212\">jaminan</span> <span data-scayt_word=\"asuransi\" data-scaytid=\"213\">asuransi</span> (<span data-scayt_word=\"dikembalikan\" data-scaytid=\"214\">dikembalikan</span> <span data-scayt_word=\"di\" data-scaytid=\"215\">di</span> <span data-scayt_word=\"masa\" data-scaytid=\"216\">masa</span> <span data-scayt_word=\"akhir\" data-scaytid=\"217\">akhir</span> <span data-scayt_word=\"sewa\" data-scaytid=\"218\">sewa</span>).</li><li>\r\n			<span data-scayt_word=\"Kendaraan\" data-scaytid=\"289\">Kendaraan</span> <span data-scayt_word=\"hanya\" data-scaytid=\"290\">hanya</span> <span data-scayt_word=\"dapat\" data-scaytid=\"291\">dapat</span> <span data-scayt_word=\"dikemudikan\" data-scaytid=\"292\">dikemudikan</span> <span data-scayt_word=\"oleh\" data-scaytid=\"293\">oleh</span> <span data-scayt_word=\"orang\" data-scaytid=\"294\">orang</span> yang <span data-scayt_word=\"memiliki\" data-scaytid=\"295\">memiliki</span> <span data-scayt_word=\"SIM\" data-scaytid=\"185\">SIM</span> <span data-scayt_word=\"nasional\" data-scaytid=\"298\">nasional</span> <span data-scayt_word=\"indonesia\" data-scaytid=\"299\">indonesia</span> <span data-scayt_word=\"atau\" data-scaytid=\"187\">atau</span> <span data-scayt_word=\"SIM\" data-scaytid=\"186\">SIM</span> <span data-scayt_word=\"internasional\" data-scaytid=\"301\">internasional</span>.</li><li>\r\n			<span data-scayt_word=\"Semua\" data-scaytid=\"302\">Semua</span> data yang <span data-scayt_word=\"di\" data-scaytid=\"253\">di</span> <span data-scayt_word=\"sertakan\" data-scaytid=\"305\">sertakan</span> <span data-scayt_word=\"berupa\" data-scaytid=\"306\">berupa</span> <span data-scayt_word=\"foto\" data-scaytid=\"307\">foto</span> <span data-scayt_word=\"kopi\" data-scaytid=\"255\">kopi</span>. <span data-scayt_word=\"Penyewa\" data-scaytid=\"309\">Penyewa</span> <span data-scayt_word=\"wajib\" data-scaytid=\"256\">wajib</span> <span data-scayt_word=\"menunjukan\" data-scaytid=\"311\">menunjukan</span> <span data-scayt_word=\"dokumen\" data-scaytid=\"312\">dokumen</span> <span data-scayt_word=\"asli\" data-scaytid=\"314\">asli</span> <span data-scayt_word=\"kepada\" data-scaytid=\"315\">kepada</span> surveyor <span data-scayt_word=\"ketika\" data-scaytid=\"316\">ketika</span> <span data-scayt_word=\"di\" data-scaytid=\"254\">di</span> survey. <span data-scayt_word=\"Guna\" data-scaytid=\"317\">Guna</span> <span data-scayt_word=\"mencocokan\" data-scaytid=\"318\">mencocokan</span> <span data-scayt_word=\"keaslian\" data-scaytid=\"257\">keaslian</span> <span data-scayt_word=\"dokumen\" data-scaytid=\"313\">dokumen</span> <span data-scayt_word=\"dengan\" data-scaytid=\"320\">dengan</span> <span data-scayt_word=\"fotokopi\" data-scaytid=\"321\">fotokopi</span> yang <span data-scayt_word=\"diberikan\" data-scaytid=\"322\">diberikan</span>.</li><li>\r\n			<span data-scayt_word=\"Dilarang\" data-scaytid=\"920\">Dilarang</span> <span data-scayt_word=\"meninggalkan\" data-scaytid=\"921\">meninggalkan</span> <span data-scayt_word=\"STNK\" data-scaytid=\"922\">STNK</span>, <span data-scayt_word=\"kunci\" data-scaytid=\"923\">kunci</span> <span data-scayt_word=\"kontak\" data-scaytid=\"924\">kontak</span> <span data-scayt_word=\"dan\" data-scaytid=\"512\">dan</span> <span data-scayt_word=\"karcis\" data-scaytid=\"926\">karcis</span> <span data-scayt_word=\"parkir\" data-scaytid=\"513\">parkir</span> <span data-scayt_word=\"di\" data-scaytid=\"503\">di</span> <span data-scayt_word=\"dalam\" data-scaytid=\"929\">dalam</span> <span data-scayt_word=\"kendaraan\" data-scaytid=\"515\">kendaraan</span> yang <span data-scayt_word=\"sedang\" data-scaytid=\"932\">sedang</span> <span data-scayt_word=\"di\" data-scaytid=\"504\">di</span> <span data-scayt_word=\"parkir\" data-scaytid=\"514\">parkir</span>.</li><li>\r\n			<span data-scayt_word=\"Penggantian\" data-scaytid=\"933\">Penggantian</span> <span data-scayt_word=\"kendaraan\" data-scaytid=\"516\">kendaraan</span> <span data-scayt_word=\"tidak\" data-scaytid=\"934\">tidak</span> <span data-scayt_word=\"berlaku\" data-scaytid=\"935\">berlaku</span> <span data-scayt_word=\"jika\" data-scaytid=\"936\">jika</span> <span data-scayt_word=\"kerusakan\" data-scaytid=\"937\">kerusakan</span>/<span data-scayt_word=\"kecelakaan\" data-scaytid=\"938\">kecelakaan</span> <span data-scayt_word=\"diakibatkan\" data-scaytid=\"939\">diakibatkan</span> <span data-scayt_word=\"kelalaian\" data-scaytid=\"940\">kelalaian</span> <span data-scayt_word=\"penyewa\" data-scaytid=\"517\">penyewa</span>.</li><li>\r\n			<span id=\"result_box\" lang=\"id\"><span class=\"hps\"><span data-scayt_word=\"Penyewa\" data-scaytid=\"518\">Penyewa</span></span> <span class=\"hps\"><span data-scayt_word=\"dan\" data-scaytid=\"537\">dan</span></span> <span class=\"hps\">driver <span data-scayt_word=\"tambahan\" data-scaytid=\"609\">tambahan</span></span> <span class=\"hps\"><span data-scayt_word=\"harus\" data-scaytid=\"538\">harus</span> <span data-scayt_word=\"memiliki\" data-scaytid=\"539\">memiliki</span> <span data-scayt_word=\"usia\" data-scaytid=\"612\">usia</span> <span data-scayt_word=\"antara\" data-scaytid=\"613\">antara</span></span> <span class=\"hps\">21</span> <span data-scayt_word=\"hingga\" data-scaytid=\"614\">hingga</span> <span class=\"hps\">65 <span data-scayt_word=\"tahun\" data-scaytid=\"615\">tahun</span></span> <span class=\"hps\"><span data-scayt_word=\"untuk\" data-scaytid=\"540\">untuk</span> normal</span> <span class=\"hps\"><span data-scayt_word=\"kendaraan\" data-scaytid=\"541\">kendaraan</span></span> <span class=\"hps\"><span data-scayt_word=\"kategori\" data-scaytid=\"618\">kategori</span></span> <span class=\"hps\"><span data-scayt_word=\"mobil\" data-scaytid=\"619\">mobil</span> <span data-scayt_word=\"standar\" data-scaytid=\"620\">standar</span></span> <span class=\"hps\"><span data-scayt_word=\"dan\" data-scaytid=\"565\">dan</span></span> <span class=\"hps\">berusia</span> <span class=\"hps\">25</span> <span data-scayt_word=\"hingga\" data-scaytid=\"622\">hingga</span><span class=\"hps\"> 65</span> <span class=\"hps\"><span data-scayt_word=\"tahun\" data-scaytid=\"623\">tahun</span></span> <span class=\"hps\"><span data-scayt_word=\"untuk\" data-scaytid=\"566\">untuk</span></span> <span class=\"hps\"><span data-scayt_word=\"kategori\" data-scaytid=\"626\">kategori</span></span> <span class=\"hps\"><span data-scayt_word=\"mobil\" data-scaytid=\"627\">mobil</span> mewah.</span> </span></li><li>\r\n			<span data-scayt_word=\"Penyewaan\" data-scaytid=\"568\">Penyewaan</span> <span data-scayt_word=\"tanpa\" data-scaytid=\"569\">tanpa</span> <span data-scayt_word=\"supir\" data-scaytid=\"570\">supir</span> <span data-scayt_word=\"diwajibkan\" data-scaytid=\"571\">diwajibkan</span> <span data-scayt_word=\"untuk\" data-scaytid=\"323\">untuk</span> <span data-scayt_word=\"memonitor\" data-scaytid=\"572\">memonitor</span> <span data-scayt_word=\"perawatan\" data-scaytid=\"573\">perawatan</span> <span data-scayt_word=\"kendaraan\" data-scaytid=\"324\">kendaraan</span>.</li><li>\r\n			<span data-scayt_word=\"Hasil\" data-scaytid=\"797\">Hasil</span> survey <span data-scayt_word=\"adalah\" data-scaytid=\"798\">adalah</span> <span data-scayt_word=\"murni\" data-scaytid=\"799\">murni</span> data <span data-scayt_word=\"independen\" data-scaytid=\"800\">independen</span> <span data-scayt_word=\"dari\" data-scaytid=\"801\">dari</span> <span data-scayt_word=\"perusahaan\" data-scaytid=\"779\">perusahaan</span> <span data-scayt_word=\"kami\" data-scaytid=\"781\">kami</span>, <span data-scayt_word=\"jika\" data-scaytid=\"782\">jika</span> <span data-scayt_word=\"terjadi\" data-scaytid=\"806\">terjadi</span> <span data-scayt_word=\"penolakan\" data-scaytid=\"807\">penolakan</span> <span data-scayt_word=\"hasil\" data-scaytid=\"808\">hasil</span> survey, <span data-scayt_word=\"maka\" data-scaytid=\"810\">maka</span> <span data-scayt_word=\"perusahaan\" data-scaytid=\"780\">perusahaan</span> <span data-scayt_word=\"tidak\" data-scaytid=\"783\">tidak</span> <span data-scayt_word=\"akan\" data-scaytid=\"812\">akan</span> <span data-scayt_word=\"memberikan\" data-scaytid=\"813\">memberikan</span> <span data-scayt_word=\"informasi\" data-scaytid=\"814\">informasi</span> <span data-scayt_word=\"apapun\" data-scaytid=\"815\">apapun</span> <span data-scayt_word=\"kepada\" data-scaytid=\"784\">kepada</span> customer <span data-scayt_word=\"mengenai\" data-scaytid=\"817\">mengenai</span> <span data-scayt_word=\"hasil\" data-scaytid=\"809\">hasil</span> <span data-scayt_word=\"analisa\" data-scaytid=\"818\">analisa</span> survey</li></ul></div></div><p align=\"justify\"><br></p>																																																																		'),
(5, 'Rekening', 'rekening', '																																	123456789 Bank BRI a/n WAHYU SARONTO'),
(0, 'Driver', 'driver', '450000'),
(2, 'Privacy Policy', 'privacy', '<div>At Altium, we take privacy and the protection of your Personal Data seriously.</div><div><br></div><div>Personal Data means information that can directly or indirectly identify you or other individuals (“Personal Data”). This typically includes information such as your surname, name, name suffix, date of birth, address, email address, telephone number, date of purchase and financial details provided by you in connection with your purchase. Personal Data can also include other information such as your IP address and your shopping habits.</div><div><br></div><div>The categories of Personal Data that we process depends on how you use our services. We use your Personal Data to provide our website services in alignment with your preferences, to deal with your requests, to contact you regarding tailored products and services which may be of interest to you, or to carry out relevant administrative services. All Personal Data is processed in accordance with applicable data protection laws.</div><div><br></div><div>We do not disclose your Personal Data to any third party except to our affiliates and to data processors that assist us with providing our services. With your consent we use cookies for marketing, performance and statistical purposes.</div><div><br></div><div>As our valid customer, we also offer you various choices to control how your Personal Data is used.</div><div><br></div><div>If you would like to receive more information about the processing of your Personal Data by us and on the cookies that we use, please see the extended version of this Privacy Policy below, as well as our Cookie Policy.</div>'),
(3, 'Tentang Kami', 'aboutus', '																						<span style=\"color: rgb(0, 0, 0); text-align: justify; font-family: Poppins;\">Kami adalah perusahaan yang bergerak di bidang penyewaan mobil.</span>											'),
(11, 'FAQs', 'faqs', '																																	<div style=\"text-align: justify;\"><span style=\"font-size: 1em; color: rgb(0, 0, 0); font-family: Poppins;\">Q : Bagaimana cara menyewa mobil di&nbsp; Car Rental?</span></div><div style=\"text-align: justify;\"><span style=\"font-size: 1em; color: rgb(0, 0, 0); font-family: Poppins;\">A : Pertama anda harus mendaftar terlebih dahulu sebagai user melalui menu yang telah disediakan.</span></div>																																	');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(120) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `telp` char(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `ktp` varchar(120) NOT NULL,
  `kk` varchar(120) NOT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email`, `password`, `telp`, `alamat`, `ktp`, `kk`, `RegDate`, `UpdationDate`) VALUES
(7, 'Yusuf', 'yusuf@gmail.com', 'dd2eb170076a5dec97cdbbbbff9a4405', '08122233343', 'Jl. Sukosemolo', '07092022132814id.png', '07092022132814id (1).png', '2022-09-07 11:28:14', NULL),
(10, 'Imam Adli', 'rugimaku@gmail.com', 'bffa783a022fe2d98692014dda6d7a4c', '08990096343', 'solok', '27112023021359foto.png', '27112023021359CrystalDiskMark_20230320004009.png', '2023-11-27 01:13:59', NULL),
(11, 'Ucok', 'ucok@gmail.com', '202cb962ac59075b964b07152d234b70', '086969454', 'supomook', '03122023161443391661826_6050387731728106_7345997746731350660_n.jpg', '03122023161443wallpaperflare.com_wallpaper (1).jpg', '2023-12-03 15:14:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`kode_booking`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indexes for table `cek_booking`
--
ALTER TABLE `cek_booking`
  ADD KEY `kode_booking` (`kode_booking`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indexes for table `contactusinfo`
--
ALTER TABLE `contactusinfo`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id_merek`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `id_merek` (`id_merek`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contactusinfo`
--
ALTER TABLE `contactusinfo`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id_merek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cek_booking`
--
ALTER TABLE `cek_booking`
  ADD CONSTRAINT `cek_booking_ibfk_1` FOREIGN KEY (`kode_booking`) REFERENCES `booking` (`kode_booking`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cek_booking_ibfk_2` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`);

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_ibfk_1` FOREIGN KEY (`id_merek`) REFERENCES `merek` (`id_merek`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
