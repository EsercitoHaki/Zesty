-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 03:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zesty`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `MaAdmin` int(11) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `TenDangNhap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`MaAdmin`, `MatKhau`, `TenDangNhap`) VALUES
(1, '123', 'quan');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `MaBlog` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `NoiDung` text DEFAULT NULL,
  `MaAdmin` int(11) DEFAULT NULL,
  `MaThanhVien` int(11) DEFAULT NULL,
  `NgayDang` date DEFAULT NULL,
  `AnhBlog` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`MaBlog`, `Title`, `NoiDung`, `MaAdmin`, `MaThanhVien`, `NgayDang`, `AnhBlog`) VALUES
(1, 'Cách làm bánh mỳ', 'Bánh mỳ', NULL, 1, '2023-12-12', 'banhmy.png'),
(2, 'Bánh xèo', 'Cách làm bánh xèo', 1, NULL, '2023-12-08', 'banhxeo.png'),
(3, 'Cách làm bún bò Huế', 'Chỉ cần làm theo video là được', NULL, 4, '2023-12-12', 'bunbo.png'),
(5, 'Cách làm bánh crepe', 'Cách làm bánh crepe làm theo video là được', NULL, 1, '2023-12-16', 'Cách làm bánh crepe.jpg'),
(6, 'Cách làm bánh Doraemon', 'Cách làm bánh Doraemon là xem phim Doraemon là làm được thôi', NULL, 1, '2023-12-16', 'Cách làm bánh Doraemon.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ctdonhang`
--

CREATE TABLE `ctdonhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaSanPham` int(11) NOT NULL,
  `MaGioHang` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `GiaMoiSP` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctdonhang`
--

INSERT INTO `ctdonhang` (`MaDonHang`, `MaSanPham`, `MaGioHang`, `SoLuong`, `GiaMoiSP`) VALUES
(191, 3, 1723435, 4, 400000.00),
(192, 4, 1723436, 7, 350000.00);

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `MaDanhGia` int(11) NOT NULL,
  `MaThanhVien` int(11) DEFAULT NULL,
  `TieuDe` varchar(255) DEFAULT NULL,
  `NoiDung` text DEFAULT NULL,
  `HaiLong` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`MaDanhGia`, `MaThanhVien`, `TieuDe`, `NoiDung`, `HaiLong`) VALUES
(1, 1, 'Sản Phẩm', 'Rất Tuyệt', 1),
(2, 1, 'abcd', 'ádasdas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDanhMuc` int(11) NOT NULL,
  `TenDanhMuc` varchar(255) NOT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`MaDanhMuc`, `TenDanhMuc`, `MoTa`) VALUES
(1, 'Hoa Quả', 'Hoa Quả'),
(2, 'Rau củ', 'Rau củ'),
(3, 'Gia vị', 'Gia vị'),
(4, 'Thực phẩm đạm', 'Thực phẩm đạm'),
(5, 'Các loại hạt và ngũ cốc', 'Các loại hạt và ngũ cốc'),
(6, 'Dầu ăn và gia vị', 'Dầu ăn và gia vị'),
(7, 'Sản phẩm từ sữa', 'Sản phẩm từ sữa'),
(8, 'Đồ uống', 'Đồ uống');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaThanhVien` int(11) DEFAULT NULL,
  `MaGioHang` int(11) DEFAULT NULL,
  `MaPhuongThuc` int(11) NOT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `ThoiGianDatHang` date DEFAULT NULL,
  `TenNguoiNhan` varchar(255) NOT NULL,
  `DiaChiNhanHang` varchar(255) NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `GhiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`MaDonHang`, `MaThanhVien`, `MaGioHang`, `MaPhuongThuc`, `TrangThai`, `ThoiGianDatHang`, `TenNguoiNhan`, `DiaChiNhanHang`, `SDT`, `GhiChu`) VALUES
(191, 4, 1723435, 1, '0', '2023-12-18', 'Nguyễn Hồng Phúc', 'Hà Nội', '0123456789', ''),
(192, 4, 1723436, 1, '0', '2023-12-18', 'Nguyễn Hồng Phúc', 'Hà Nội', '0123456789', '');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `MaGioHang` int(11) NOT NULL,
  `MaThanhVien` int(11) DEFAULT NULL,
  `MaSanPham` int(11) DEFAULT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`MaGioHang`, `MaThanhVien`, `MaSanPham`, `TrangThai`, `SoLuong`) VALUES
(1723435, 4, 3, NULL, 4),
(1723436, 4, 4, NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `phuongthucthanhtoan`
--

CREATE TABLE `phuongthucthanhtoan` (
  `MaPhuongThuc` int(11) NOT NULL,
  `TenPhuongThuc` varchar(255) NOT NULL,
  `TrangThai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phuongthucthanhtoan`
--

INSERT INTO `phuongthucthanhtoan` (`MaPhuongThuc`, `TenPhuongThuc`, `TrangThai`) VALUES
(1, 'Thanh toán khi nhận hàng', '1'),
(2, 'Momo', '1'),
(3, 'ZaloPay', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSanPham` int(11) NOT NULL,
  `TenSanPham` varchar(255) NOT NULL,
  `Gia` decimal(10,2) NOT NULL,
  `DinhLuong` varchar(255) DEFAULT NULL,
  `ThongTin` text DEFAULT NULL,
  `Anh` varchar(255) DEFAULT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `MaDanhMuc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSanPham`, `TenSanPham`, `Gia`, `DinhLuong`, `ThongTin`, `Anh`, `TrangThai`, `MaDanhMuc`) VALUES
(1, 'Dây tây', 120000.00, 'Kg', 'Dâu tây mỹ đá Dalat', 'dautay.png', '1', 1),
(3, 'Táo', 100000.00, 'Kg', 'Táo', 'tao.png', '1', 1),
(4, 'Cam', 50000.00, 'Kg', 'Cam', 'cam.png', '1', 1),
(5, 'Chuối', 100000.00, 'Kg', 'Chuối', 'chuoi.png', '1', 1),
(6, 'Dưa Hấu', 30000.00, '1 quả', 'Dưa hấu tươi ngon, giàu nước.', 'dua_hau.jpg', '1', 1),
(7, 'Táo Fuji', 25000.00, '1 kg', 'Táo Fuji nhập khẩu, ngọt và giòn.', 'tao_fuji.jpg', '1', 1),
(8, 'Xoài Cát', 40000.00, '1 kg', 'Xoài Cát chín mọng, mùi thơm đặc trưng.', 'xoai_cat.jpg', '1', 1),
(9, 'Cam Sành', 35000.00, '1 kg', 'Cam Sành tươi ngon, giàu vitamin C.', 'cam_sanh.jpg', '1', 1),
(10, 'Cherry', 60000.00, '100g', 'Cherry đỏ mọng, ngọt ngào.', 'cherry.jpg', '1', 1),
(11, 'Mâm Xôi', 45000.00, '1 kg', 'Mâm xôi chín mọng, thơm ngon.', 'mam_xoi.jpg', '1', 1),
(12, 'Lựu', 55000.00, '1 kg', 'Quả lựu đỏ tươi, giàu chất dinh dưỡng.', 'lua.jpg', '1', 1),
(13, 'Dâu Tây', 70000.00, '500g', 'Dâu tây chín đỏ, ngọt và mềm.', 'dau_tay.jpg', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `thanhvien`
--

CREATE TABLE `thanhvien` (
  `MaThanhVien` int(11) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `TenDangNhap` varchar(255) NOT NULL,
  `SDT` varchar(20) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `HoTen` varchar(255) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thanhvien`
--

INSERT INTO `thanhvien` (`MaThanhVien`, `MatKhau`, `TenDangNhap`, `SDT`, `Email`, `HoTen`, `DiaChi`, `NgaySinh`) VALUES
(1, '1234', 'quanpham', '0123456789', 'quan1@gmail.com', 'Phạm Công Quân', 'Thanh Hoá', '2003-09-10'),
(3, '123', 'dung', '0123456789', 'dung@gmail.com', 'Nguyễn Văn Dũng', 'Hà Nội', NULL),
(4, '123', 'phucham', '0123456789', 'phuc@gmail.com', 'Nguyễn Hồng Phúc', 'Hà Nội', '2003-02-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`MaAdmin`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`MaBlog`),
  ADD KEY `MaAdmin` (`MaAdmin`),
  ADD KEY `MaThanhVien` (`MaThanhVien`);

--
-- Indexes for table `ctdonhang`
--
ALTER TABLE `ctdonhang`
  ADD PRIMARY KEY (`MaDonHang`,`MaSanPham`,`MaGioHang`),
  ADD KEY `MaSanPham` (`MaSanPham`),
  ADD KEY `MaGioHang` (`MaGioHang`);

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`MaDanhGia`),
  ADD KEY `MaThanhVien` (`MaThanhVien`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDanhMuc`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `MaThanhVien` (`MaThanhVien`),
  ADD KEY `MaGioHang` (`MaGioHang`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGioHang`),
  ADD KEY `MaThanhVien` (`MaThanhVien`),
  ADD KEY `MaSanPham` (`MaSanPham`);

--
-- Indexes for table `phuongthucthanhtoan`
--
ALTER TABLE `phuongthucthanhtoan`
  ADD PRIMARY KEY (`MaPhuongThuc`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD KEY `MaDanhMuc` (`MaDanhMuc`);

--
-- Indexes for table `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`MaThanhVien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `MaAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `MaBlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `MaDanhGia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `MaDanhMuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `MaGioHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1723437;

--
-- AUTO_INCREMENT for table `phuongthucthanhtoan`
--
ALTER TABLE `phuongthucthanhtoan`
  MODIFY `MaPhuongThuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSanPham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `thanhvien`
--
ALTER TABLE `thanhvien`
  MODIFY `MaThanhVien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`MaAdmin`) REFERENCES `admin` (`MaAdmin`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`MaThanhVien`) REFERENCES `thanhvien` (`MaThanhVien`);

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`MaThanhVien`) REFERENCES `thanhvien` (`MaThanhVien`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`MaThanhVien`) REFERENCES `thanhvien` (`MaThanhVien`);

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`MaThanhVien`) REFERENCES `thanhvien` (`MaThanhVien`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaDanhMuc`) REFERENCES `danhmuc` (`MaDanhMuc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
