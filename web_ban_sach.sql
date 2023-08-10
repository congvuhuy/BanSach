-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th5 25, 2023 lúc 09:51 AM
-- Phiên bản máy phục vụ: 8.0.17
-- Phiên bản PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_ban_sach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_chitietdonhang`
--

CREATE TABLE `tbl_chitietdonhang` (
  `maDonHang` int(11) NOT NULL,
  `maSach` int(11) NOT NULL,
  `soLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_chitietdonhang`
--

INSERT INTO `tbl_chitietdonhang` (`maDonHang`, `maSach`, `soLuong`) VALUES
(1, 2, 5),
(1, 3, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `maDonHang` int(11) NOT NULL,
  `ngayLap` date NOT NULL,
  `tinhTrang` enum('Đang giao','Chuẩn bị hàng','Đã giao') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Chuẩn bị hàng',
  `soDT` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diaChi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maKhachHang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_donhang`
--

INSERT INTO `tbl_donhang` (`maDonHang`, `ngayLap`, `tinhTrang`, `soDT`, `diaChi`, `maKhachHang`) VALUES
(1, '2023-05-01', 'Đã giao', '0347654231', 'Thụy Văn, Thái Thụy, Thái Bình', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giohang`
--

CREATE TABLE `tbl_giohang` (
  `maKhachHang` int(11) NOT NULL,
  `maSach` int(11) NOT NULL,
  `soLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_giohang`
--

INSERT INTO `tbl_giohang` (`maKhachHang`, `maSach`, `soLuong`) VALUES
(1, 6, 1),
(1, 7, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khachhang`
--

CREATE TABLE `tbl_khachhang` (
  `maKhachHang` int(11) NOT NULL,
  `ho` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioiTinh` enum('Nam','Nữ','Khác') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Khác',
  `ngaySinh` date NOT NULL,
  `soDT` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diaChi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matKhau` int(6) NOT NULL,
  `admin_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`maKhachHang`, `ho`, `ten`, `gioiTinh`, `ngaySinh`, `soDT`, `email`, `diaChi`, `matKhau`, `admin_status`) VALUES
(1, 'Nguyễn Công', 'Mạnh', 'Nam', '2002-02-02', '0347654231', 'user001@gmail.com', 'Thụy Văn, Thái Thụy, Thái Bình', 123456, '0'),
(2, 'Lê Thị', 'A', 'Nữ', '2000-01-15', '0123456789', 'admin001@gmail.com', 'Hoài Đức, Hà Nội', 123456, '1'),
(6, 'Black', 'Rose', 'Nữ', '2008-05-25', '0341287654', 'user002@gmail.com', 'Cầu Giấy, Hà Nội', 654321, '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nxb`
--

CREATE TABLE `tbl_nxb` (
  `maNXB` int(11) NOT NULL,
  `tenNXB` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nxb`
--

INSERT INTO `tbl_nxb` (`maNXB`, `tenNXB`) VALUES
(1, 'NXB Kim Đồng'),
(2, 'Nhã Nam'),
(3, 'NXB Trẻ'),
(4, 'Nhà sách Minh Thắng'),
(5, 'Alpha Books');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sach`
--

CREATE TABLE `tbl_sach` (
  `maSach` int(11) NOT NULL,
  `tenSach` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tacGia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namXB` year(4) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `gia` int(11) NOT NULL,
  `maTheLoai` int(11) NOT NULL,
  `maNXB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sach`
--

INSERT INTO `tbl_sach` (`maSach`, `tenSach`, `anh`, `tacGia`, `namXB`, `soLuong`, `gia`, `maTheLoai`, `maNXB`) VALUES
(2, 'Học Viện Siêu Anh Hùng - Tập 30', '001.jpg', 'Kohei Horikoshi', 2023, 100, 25000, 5, 1),
(3, 'Hoàng tử bé', '002.jpg', 'Antoine De Saint-Exupéry', 2020, 50, 35000, 5, 1),
(4, 'Tuổi trẻ đáng giá bao nhiêu', '003.jpg', 'Rosie Nguyễn', 2021, 100, 72000, 3, 2),
(5, 'Sự im lặng của bầy cừu', '004.jpg', 'Thomas Harris', 2019, 10, 115000, 1, 2),
(6, 'Tôi thấy hoa vàng trên cỏ xanh', '005.jpg', 'Nguyễn Nhật Ánh', 2018, 20, 125000, 1, 3),
(7, 'Tôi Là Bêtô', '006.jpg', 'Nguyễn Nhật Ánh', 2018, 10, 85000, 1, 3),
(8, 'Trí tuệ do thái', '007.jpg', 'Eran Katz', 2022, 9, 189000, 3, 5),
(9, 'Sapiens Lược Sử Loài Người', '008.jpg', 'Yuval Noah Harari', 2023, 48, 299000, 4, 5),
(10, 'English Grammar In Use', '009.jpg', 'Nguyễn Thị Thu Huế', 2023, 100, 165000, 4, 4),
(11, '3.500 Từ Vựng Tiếng Anh Theo Chủ Đề', '010.jpg', 'Nguyễn Thị Thu Huế', 2023, 48, 75000, 4, 4),
(21, 'Đời Ngắn Đừng Ngủ Dài', '011.jpg', 'Robin Sharma', 2018, 18, 75000, 3, 3),
(22, 'Cà phê cùng Tony', '012.jpg', 'Tony Buổi Sáng', 2022, 34, 105000, 3, 3),
(23, 'Cho Tôi Xin Một Vé Đi Tuổi Thơ', '013.jpg', 'Nguyễn Nhật Ánh', 2018, 15, 80000, 1, 3),
(24, 'Nhà Lãnh Đạo Không Chức Danh', '014.jpg', 'Robin Sharma', 2022, 30, 105000, 2, 3),
(25, 'Làm bạn với bầu trời', '015.jpg', 'Nguyễn Nhật Ánh', 2021, 40, 110000, 1, 3),
(26, 'Tiếng Nhật Cho Mọi Người - Sơ Cấp 1 ', '016.jpg', 'Robert T Kiyosaki, John Flem', 2019, 10, 85000, 2, 3),
(27, 'Doanh Nghiệp Của Thế Kỷ 21', '017.jpg', 'Robin Sharma', 2022, 30, 105000, 1, 3),
(28, 'Harry Potter Và Hòn Đá Phù Thuỷ - Tập 1', '018.jpg', 'J.K.Rowling, Lý Lan', 2015, 10, 150000, 1, 3),
(37, 'Komi - Nữ Thần Sợ Giao Tiếp - Tập 12', '019.jpg', 'Tomohito Oda', 2023, 100, 25000, 5, 1),
(38, 'Komi - Nữ Thần Sợ Giao Tiếp - Tập 10', '020.jpg', 'Tomohito Oda', 2023, 50, 25000, 5, 1),
(39, 'Chú Thuật Hồi Chiến - Tập 2', '021.jpg', 'Gege Akutami', 2023, 100, 30000, 5, 1),
(40, '\r\nSpy X Family - Tập 6', '022.jpg', 'Tatsuya Endo', 2023, 50, 25000, 5, 1),
(41, 'Kimetsu No Yaiba - Tập 20', '023.jpg', 'Koyoharu Gotouge', 2023, 70, 25000, 5, 1),
(42, 'Tuổi Thơ Dữ Dội - Tập 2', '024.jpg', 'Phùng Quán', 2019, 20, 80000, 5, 1),
(43, 'Tatsuya Endo', '025.jpg', 'Tatsuya Endo', 2023, 50, 25000, 5, 1),
(44, 'Kimetsu No Yaiba - Tập 21', '026.jpg', 'Koyoharu Gotouge', 2023, 70, 30000, 5, 1),
(45, 'Chuyện Con Mèo Dạy Hải Âu Bay', '027.jpg', 'Luis Sepúlveda', 2019, 20, 49000, 3, 2),
(46, 'Bước Chậm Lại Giữa Thế Gian Vội Vã', '028.jpg', 'Hae Min', 2018, 30, 85000, 1, 2),
(47, 'Điều Kỳ Diệu Của Tiệm Tạp Hóa Namiya', '029.jpg', 'Higashino Keigo', 2018, 10, 105000, 1, 2),
(48, 'Những Tù Nhân Của Địa Lý', '030.jpg', 'Tim Marshall', 2018, 50, 210000, 4, 2),
(49, 'Totto-Chan Bên Cửa Sổ', '031.jpg', 'Kuroyanagi Tetsuko', 2018, 30, 98000, 1, 2),
(50, 'Một Lít Nước Mắt', '032.jpg', 'Kito Aya', 2019, 40, 80000, 1, 2),
(51, 'Chiến Binh Cầu Vồng', '033.jpg', 'Andrea Hirata', 2020, 30, 109000, 1, 2),
(52, 'Rừng Nauy', '034.jpg', 'Haruki Murakami', 2019, 30, 150000, 1, 2),
(53, 'Những Kẻ Xuất Chúng', '035.jpg', 'Malcolm Gladwel', 2021, 50, 159000, 2, 5),
(54, 'Tạo Lập Mô Hình Kinh Doanh', '036.jpg', 'Tạo Lập Mô Hình Kinh Doanh', 2023, 100, 299000, 2, 5),
(55, 'Thiết Kế Giải Pháp Giá Trị', '037.jpg', 'Nhiều Tác Giả', 2023, 50, 339000, 2, 5),
(56, 'Tạo Lập Mô Hình Kinh Doanh - Cá Nhân', '038.jpg', 'Tim Clark, Alexander, Osterwalder, Yves Pigneur', 2022, 30, 299000, 2, 5),
(57, 'Combo Sách Tạo Lập Mô Hình Kinh Doanh Cá Nhân', '039.jpg', 'Tim Clark, Alexander, Osterwalder, Yves Pigneur', 2023, 30, 1236000, 2, 5),
(58, 'Trên Đỉnh Phố Wall', '040.jpg', 'Peter Lynch, John Rothchild', 2021, 10, 219000, 2, 5),
(59, 'Câu Chuyện Về Nền Kinh Tế Thần Kỳ Của Israel', '041.jpg', 'Dan Senor, Saul Singer', 2022, 30, 209000, 2, 5),
(60, 'Tỷ Phú Bán Giày', '042.jpg', 'Tony Hsieh', 2023, 50, 109000, 2, 5),
(61, '109 hiện tượng bí ẩn trên thế giới', '043.jpg', 'Nhiều tác giả', 2023, 100, 95000, 4, 4),
(62, '157 Hiện Tượng Bí Ẩn Trên Thế Giới', '044.jpg', 'Nguyễn Hồng Lân', 2023, 50, 110000, 4, 4),
(63, 'Đồ Giải Kinh Lạc Huyệt Vị Nam Giới', '045.jpg', 'Lương y Hoàng Duy Tân', 2023, 20, 120000, 4, 4),
(64, 'Kinh Nghiệm Để Tránh Sai Lầm Trong Chuẩn Đoán', '046.jpg', 'Lương y Nguyễn Thiên Quyến', 2023, 20, 140000, 4, 4),
(65, 'Chinh Phục Ngữ Pháp Và Bài Tập Tiếng Anh Lớp 6', '047.jpg', 'Nguyễn Thị Thu Huế', 2023, 100, 78000, 4, 4),
(66, 'Chinh Phục Ngữ Pháp Và Bài Tập Tiếng Anh Lớp 8', '048.jpg', 'Nguyễn Thị Thu Huế', 2020, 100, 79000, 4, 4),
(67, 'Chinh Phục Từ Vựng Tiếng Anh', '049.png', 'ThS Tạ Thanh Hiền', 2023, 50, 180000, 4, 4),
(68, 'Bách Khoa Thư Lịch Sử - Từ Tiền Sử Đến Thời Đại', '050.jpg', 'Philip Steele', 2023, 50, 250000, 4, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_theloai`
--

CREATE TABLE `tbl_theloai` (
  `maTheLoai` int(11) NOT NULL,
  `theLoai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_theloai`
--

INSERT INTO `tbl_theloai` (`maTheLoai`, `theLoai`) VALUES
(1, 'Văn học'),
(2, 'Kinh tế'),
(3, 'Tâm lý - kỹ năng sống'),
(4, 'Giáo khoa - tham khảo'),
(5, 'Truyện tranh');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_chitietdonhang`
--
ALTER TABLE `tbl_chitietdonhang`
  ADD PRIMARY KEY (`maDonHang`,`maSach`),
  ADD KEY `maSach` (`maSach`);

--
-- Chỉ mục cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`maDonHang`),
  ADD KEY `maKhachHang` (`maKhachHang`);

--
-- Chỉ mục cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  ADD PRIMARY KEY (`maKhachHang`,`maSach`),
  ADD KEY `maSach` (`maSach`);

--
-- Chỉ mục cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD PRIMARY KEY (`maKhachHang`);

--
-- Chỉ mục cho bảng `tbl_nxb`
--
ALTER TABLE `tbl_nxb`
  ADD PRIMARY KEY (`maNXB`);

--
-- Chỉ mục cho bảng `tbl_sach`
--
ALTER TABLE `tbl_sach`
  ADD PRIMARY KEY (`maSach`),
  ADD KEY `maTheLoai` (`maTheLoai`),
  ADD KEY `maNXB` (`maNXB`);

--
-- Chỉ mục cho bảng `tbl_theloai`
--
ALTER TABLE `tbl_theloai`
  ADD PRIMARY KEY (`maTheLoai`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `maDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `maKhachHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_nxb`
--
ALTER TABLE `tbl_nxb`
  MODIFY `maNXB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_sach`
--
ALTER TABLE `tbl_sach`
  MODIFY `maSach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `tbl_theloai`
--
ALTER TABLE `tbl_theloai`
  MODIFY `maTheLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_chitietdonhang`
--
ALTER TABLE `tbl_chitietdonhang`
  ADD CONSTRAINT `tbl_chitietdonhang_ibfk_1` FOREIGN KEY (`maDonHang`) REFERENCES `tbl_donhang` (`maDonHang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_chitietdonhang_ibfk_2` FOREIGN KEY (`maSach`) REFERENCES `tbl_sach` (`maSach`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD CONSTRAINT `tbl_donhang_ibfk_1` FOREIGN KEY (`maKhachHang`) REFERENCES `tbl_khachhang` (`maKhachHang`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  ADD CONSTRAINT `tbl_giohang_ibfk_1` FOREIGN KEY (`maKhachHang`) REFERENCES `tbl_khachhang` (`maKhachHang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_giohang_ibfk_2` FOREIGN KEY (`maSach`) REFERENCES `tbl_sach` (`maSach`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tbl_sach`
--
ALTER TABLE `tbl_sach`
  ADD CONSTRAINT `tbl_sach_ibfk_1` FOREIGN KEY (`maTheLoai`) REFERENCES `tbl_theloai` (`maTheLoai`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_sach_ibfk_2` FOREIGN KEY (`maNXB`) REFERENCES `tbl_nxb` (`maNXB`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
