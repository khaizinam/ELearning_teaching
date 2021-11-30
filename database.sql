-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 04:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `danh_sach_lop`
--

CREATE TABLE `danh_sach_lop` (
  `ID_lop` varchar(10) NOT NULL,
  `ID_SV` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `giang_vien`
--

CREATE TABLE `giang_vien` (
  `ID` varchar(10) NOT NULL,
  `Ho_ten` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `SDT` varchar(12) NOT NULL,
  `ID_Khoa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giang_vien`
--

INSERT INTO `giang_vien` (`ID`, `Ho_ten`, `Email`, `SDT`, `ID_Khoa`) VALUES
('205786', 'Quảng Hà Đông', 'dong@gamil.com', '0846141788', '1002');

-- --------------------------------------------------------

--
-- Table structure for table `giang_vien_quan_li_lop`
--

CREATE TABLE `giang_vien_quan_li_lop` (
  `ID_lop` varchar(10) NOT NULL,
  `ID_GV` varchar(10) NOT NULL,
  `chuc_vu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `ID` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`ID`, `name`) VALUES
('1001', 'Khoa học và máy tính'),
('1002', 'Kĩ thuật máy tính CLC');

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `ID` varchar(10) NOT NULL,
  `Ten_MH` varchar(100) NOT NULL,
  `So_TC` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mon_hoc`
--

INSERT INTO `mon_hoc` (`ID`, `Ten_MH`, `So_TC`) VALUES
('CO1002', 'Hệ Cơ Sở Dữ Liệu', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nhom_lop`
--

CREATE TABLE `nhom_lop` (
  `ID` varchar(10) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `tiet_bat_dau` int(5) NOT NULL,
  `tiet_ket_thuc` int(5) NOT NULL,
  `Phong_hoc` varchar(100) NOT NULL,
  `id_giang_vien` varchar(10) NOT NULL,
  `id_monhoc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhom_lop`
--

INSERT INTO `nhom_lop` (`ID`, `ten`, `tiet_bat_dau`, `tiet_ket_thuc`, `Phong_hoc`, `id_giang_vien`, `id_monhoc`) VALUES
('1002', 'L07', 7, 6, '206H6', '205786', 'CO1002');

-- --------------------------------------------------------

--
-- Table structure for table `phong_hoc`
--

CREATE TABLE `phong_hoc` (
  `name` varchar(50) NOT NULL,
  `toa` varchar(100) NOT NULL,
  `co_so` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phong_hoc`
--

INSERT INTO `phong_hoc` (`name`, `toa`, `co_so`) VALUES
('206H6', 'H6', 'Co so 1');

-- --------------------------------------------------------

--
-- Table structure for table `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `ID` varchar(10) NOT NULL,
  `Ho_ten` varchar(200) NOT NULL,
  `Lop` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `TT_hoc` varchar(200) NOT NULL,
  `khoa_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sinh_vien`
--

INSERT INTO `sinh_vien` (`ID`, `Ho_ten`, `Lop`, `Email`, `TT_hoc`, `khoa_ID`) VALUES
('1913779', 'Nguyễn Hữu Khải', 'KH07', 'khaizinam@gmail.com', 'Bình thường', '1002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danh_sach_lop`
--
ALTER TABLE `danh_sach_lop`
  ADD KEY `ID_lop` (`ID_lop`),
  ADD KEY `ID_SV` (`ID_SV`);

--
-- Indexes for table `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Khoa` (`ID_Khoa`);

--
-- Indexes for table `giang_vien_quan_li_lop`
--
ALTER TABLE `giang_vien_quan_li_lop`
  ADD KEY `ID_lop` (`ID_lop`),
  ADD KEY `ID_GV` (`ID_GV`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `nhom_lop`
--
ALTER TABLE `nhom_lop`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_monhoc` (`id_monhoc`),
  ADD KEY `id_giang_vien` (`id_giang_vien`);

--
-- Indexes for table `phong_hoc`
--
ALTER TABLE `phong_hoc`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `khoa_ID` (`khoa_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `danh_sach_lop`
--
ALTER TABLE `danh_sach_lop`
  ADD CONSTRAINT `danh_sach_lop_ibfk_1` FOREIGN KEY (`ID_lop`) REFERENCES `nhom_lop` (`ID`),
  ADD CONSTRAINT `danh_sach_lop_ibfk_2` FOREIGN KEY (`ID_SV`) REFERENCES `sinh_vien` (`ID`);

--
-- Constraints for table `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD CONSTRAINT `giang_vien_ibfk_1` FOREIGN KEY (`ID_Khoa`) REFERENCES `khoa` (`ID`);

--
-- Constraints for table `giang_vien_quan_li_lop`
--
ALTER TABLE `giang_vien_quan_li_lop`
  ADD CONSTRAINT `giang_vien_quan_li_lop_ibfk_1` FOREIGN KEY (`ID_lop`) REFERENCES `nhom_lop` (`ID`),
  ADD CONSTRAINT `giang_vien_quan_li_lop_ibfk_2` FOREIGN KEY (`ID_GV`) REFERENCES `giang_vien` (`ID`);

--
-- Constraints for table `nhom_lop`
--
ALTER TABLE `nhom_lop`
  ADD CONSTRAINT `nhom_lop_ibfk_1` FOREIGN KEY (`id_monhoc`) REFERENCES `mon_hoc` (`ID`),
  ADD CONSTRAINT `nhom_lop_ibfk_2` FOREIGN KEY (`id_giang_vien`) REFERENCES `giang_vien` (`ID`);

--
-- Constraints for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD CONSTRAINT `sinh_vien_ibfk_1` FOREIGN KEY (`khoa_ID`) REFERENCES `khoa` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
