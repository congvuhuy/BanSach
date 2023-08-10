<?php
    // Định dạng tiền
    function formatMoney($money)
    {
        $res = ".000 vnđ";
        $money /= 1000;

        while($money > 1000) {
           $res = ".".($money%1000).$res;
           $money = ($money - $money%1000)/1000;
        }

        return $money.$res;
    }

    // Lấy danh sách các danh mục nhà xuất bản xếptheo tên nhà xuất bản
    function getDMNXB($database) 
    {
        $query = "SELECT * FROM tbl_nxb ORDER BY tenNXB";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách các danh mục nhà xuất bản
    function getDMNXBV1($database) 
    {
        $query = "SELECT * FROM tbl_nxb";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách các danh mục nhà xuất bản xếp theo tên danh mục
    function getDMTheLoai($database) 
    {
        $query = "SELECT * FROM tbl_theloai ORDER BY theLoai";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách các danh mục nhà xuất bản xếp theo mã danh mục
    function getDMTheLoaiV1($database) 
    {
        $query = "SELECT * FROM tbl_theloai";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách các cuốn sách mới cập nhật
    function getNewBooks($database) 
    {
        $query = "SELECT * FROM tbl_sach ORDER BY maSach DESC LIMIT 12";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Gợi ý sách ngẫu nhiên
    function randBook($database) 
    {
        $query = "SELECT * FROM tbl_sach";
        $res_query = mysqli_query($database, $query);

        $books = mysqli_fetch_all($res_query);

        $temp = array();

        $i=0;
        while($i<6) {
            $iBook = rand(0, count($books)-1);

            $j=0;
            while($j < $i && $iBook != $temp[$j]) {
                $j++;
            }

            if($j == $i) {
                $temp[] = $iBook;
                $i++;
            }
        }

        $res = array();
        while($i > 0) {
            $res[] = $books[$temp[$i-1]];
            $i--;
        }

        return $res;
    }

    // Lấy danh sách sách bán chạy nhất
    function bestSeller($database) 
    {
        $query =  "SELECT tbl_sach.maSach,tbl_sach.tenSach, tbl_sach.anh, tbl_sach.gia , SUM(tbl_chitietdonhang.soLuong) 
                    FROM tbl_chitietdonhang 
                        RIGHT JOIN tbl_sach ON tbl_sach.maSach = tbl_chitietdonhang.maSach 
                    GROUP BY maSach 
                    ORDER BY SUM(tbl_chitietdonhang.soLuong) DESC
                    LIMIT 12";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    function bestSellerV1($database) 
    {
        $query =  "SELECT tbl_sach.maSach,tbl_sach.tenSach, tbl_sach.anh, tbl_sach.gia , SUM(tbl_chitietdonhang.soLuong) 
                    FROM tbl_chitietdonhang 
                        RIGHT JOIN tbl_sach ON tbl_sach.maSach = tbl_chitietdonhang.maSach 
                    GROUP BY maSach 
                    ORDER BY SUM(tbl_chitietdonhang.soLuong) DESC
                    LIMIT 5";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách sách bán chạy nhất của 1 thể loại
    function bestSellerByTL($database, $maTL) 
    {
        $query =  "SELECT tbl_sach.maSach,tbl_sach.tenSach, tbl_sach.anh, tbl_sach.gia , SUM(tbl_chitietdonhang.soLuong) 
                    FROM tbl_chitietdonhang 
                        RIGHT JOIN tbl_sach ON tbl_sach.maSach = tbl_chitietdonhang.maSach 
                    WHERE tbl_sach.maTheLoai = ".$maTL." GROUP BY maSach 
                    ORDER BY SUM(tbl_chitietdonhang.soLuong) DESC 
                    LIMIT 5";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách sách bán chạy nhất của 1 nhà xuất bản
    function bestSellerByNXB($database, $maNXB) 
    {
        $query =  "SELECT tbl_sach.maSach,tbl_sach.tenSach, tbl_sach.anh, tbl_sach.gia , SUM(tbl_chitietdonhang.soLuong) 
                    FROM tbl_chitietdonhang 
                        RIGHT JOIN tbl_sach ON tbl_sach.maSach = tbl_chitietdonhang.maSach 
                    WHERE tbl_sach.maNXB = ".$maNXB." GROUP BY maSach 
                    ORDER BY SUM(tbl_chitietdonhang.soLuong) DESC 
                    LIMIT 5";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách tác giả
    function getAuthor($database) {
        $query = "SELECT DISTINCT tacGia FROM tbl_sach ORDER BY tacGia";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách sách theo thể loại
    function getBookByTL($database, $maTL) {
        $query = "SELECT * FROM tbl_sach INNER JOIN tbl_theloai ON tbl_theloai.maTheLoai = tbl_sach.maTheLoai WHERE tbl_sach.maTheLoai = ".$maTL;
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách sách theo thể loại
    function getBookByNXB($database, $maNXB) {
        $query = "SELECT * FROM tbl_sach INNER JOIN tbl_nxb ON tbl_nxb.maNXB = tbl_sach.maNXB WHERE tbl_sach.maNXB = ".$maNXB;
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách sách trong giỏ của một khách hàng
    function getGioHang($database, $maKhachHang) {
        $query = "SELECT tbl_gioHang.maSach, tenSach, anh, gia, tbl_gioHang.soLuong, tbl_sach.soLuong FROM tbl_giohang
                INNER JOIN tbl_sach ON tbl_sach.maSach = tbl_giohang.maSach
                WHERE maKhachHang = ".$maKhachHang;
            
        $res_query = mysqli_query($database, $query);
        
        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách các mã đơn hàng
    function getMaDonHang($database, $maKhachHang) {
        $query = "SELECT tbl_donHang.maDonHang
                FROM tbl_donhang
                WHERE maKhachHang = ".$maKhachHang;
            
        $res_query = mysqli_query($database, $query);
        
        return mysqli_fetch_all($res_query);
    }

    // Lấy đơn hàng theo mã khách hàng và mã đơn hàng
    function getDonHang($database, $maKhachHang, $maDonHang) {
        $query = "SELECT tbl_donhang.maDonHang, tbl_donhang.ngayLap, tbl_khachhang.ho, 
                        tbl_khachhang.ten, tbl_donhang.soDT, tbl_donhang.diaChi, 
                        tbl_donhang.tinhTrang, tbl_sach.tenSach, tbl_chitietdonhang.soLuong , 
                        tbl_sach.gia, tbl_sach.maSach 
                    FROM tbl_khachhang 
                    INNER JOIN tbl_donhang ON tbl_khachhang.maKhachHang = tbl_donhang.maKhachHang 
                    INNER JOIN tbl_chitietdonhang ON tbl_chitietdonhang.maDonHang = tbl_donhang.maDonHang 
                    INNER JOIN tbl_sach ON tbl_sach.maSach = tbl_chitietdonhang.maSach 
                    WHERE tbl_khachhang.maKhachHang = ".$maKhachHang." AND tbl_donhang.maDonHang = ".$maDonHang;
            
        $res_query = mysqli_query($database, $query);
        
        return mysqli_fetch_all($res_query);
    }

    // Xóa đơn hàng
    function deleteOrder($database, $orderId) {
        // Lấy danh sách sách trong đơn hàng bị hủy
        $query = "SELECT  maSach, soLuong
                    FROM tbl_chitietdonhang
                    WHERE maDonHang = ".$orderId;
        $res_query = mysqli_query($database, $query);

        $reBooks = mysqli_fetch_all($res_query);

        foreach($reBooks as $row) {
            // Lấy số lượng sách còn trong kho
            $query = "SELECT soLuong FROM tbl_sach 
                    WHERE maSach = ".$row[0];

            $res_query = mysqli_query($database, $query);

            $book_quantity = mysqli_fetch_all($res_query);

            // Cập nhật lại số lượng trong bảng sách
            $query = "UPDATE tbl_sach 
                SET soLuong = '".($book_quantity[0][0] + $row[1])."'
                WHERE maSach = ".$row[0];

            mysqli_query($database, $query);
        }


        $query = "DELETE FROM tbl_chitietdonhang
                WHERE maDonHang = ".$orderId;
            
        mysqli_query($database, $query);
        
        $query = "DELETE FROM tbl_donhang
                WHERE maDonHang = ".$orderId;
            
        mysqli_query($database, $query);
    }

    // Cập nhật thông tin người dùng
    function updateUserInfor($database, $userInfor) {
        $query = "UPDATE tbl_khachhang 
                SET ho = '".$userInfor[1]."',
                    ten = '".$userInfor[2]."',
                    gioiTinh = '".$userInfor[3]."',
                    ngaySinh = '".$userInfor[4]."',
                    soDT = '".$userInfor[5]."',
                    diaChi = '".$userInfor[6]."'
                WHERE maKhachHang = ".$userInfor[0];

        mysqli_query($database, $query);
    }

    // Lấy thông tin tài khoản
    function getTaiKhoan($database, $userId) {
        $query = "SELECT * FROM tbl_khachhang 
                WHERE maKhachHang = ".$userId;

        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_array($res_query);
    }

    // Đổi mật khẩu
    function rePassword($database, $userId, $new_pass) {
        $query = "UPDATE tbl_khachhang 
                SET matKhau = '".$new_pass."'
                WHERE maKhachHang = ".$userId;

        mysqli_query($database, $query);
    }

    // Thêm sách vào giỏ hàng
    function themSachVaoGio($database, $userId, $book_id, $soLuong) {
        // Lấy danh sách các cuốn sách trong giỏ với mã sách và mã khách hàng
        $query = "SELECT * FROM tbl_giohang 
                WHERE maKhachHang = ".$userId." AND maSach = ".$book_id;
        $res_query = mysqli_query($database, $query);

        $books_in_cart = mysqli_fetch_all($res_query);

        // Lấy số lượng sách còn trong kho
        $query = "SELECT soLuong FROM tbl_sach 
                WHERE maSach = ".$book_id;
        $res_query = mysqli_query($database, $query);

        $book_quantity = mysqli_fetch_all($res_query);
        
        // Cập nhật lại số lượng trong bảng sách
        $query = "UPDATE tbl_sach 
            SET soLuong = '".($book_quantity[0][0] - $soLuong)."'
            WHERE maSach = ".$book_id;

        mysqli_query($database, $query);

        if(count($books_in_cart) <> 0){
            // Nếu đã có trong giỏ thì tăng số lượng
            $query = "UPDATE tbl_giohang 
                SET soLuong = ".($books_in_cart[0][2] + $soLuong)."
                WHERE maKhachHang = '".$userId."' AND maSach = ".$book_id;

            mysqli_query($database, $query);
        } else {
            // Nếu chưa có trong giỏ thì thêm vào giỏ
            $query = "INSERT INTO `tbl_giohang` (`maKhachHang`, `maSach`, `soLuong`) VALUES ('".$userId."', '".$book_id."', '".$soLuong."')";

            mysqli_query($database, $query);
        }
    }

    // Xóa sách khỏi giỏ
    function delBookInCart($database, $userId, $book_id) {
        $query = "SELECT * FROM tbl_giohang 
        INNER JOIN tbl_sach ON tbl_sach.maSach = tbl_giohang.maSach
        WHERE maKhachHang = ".$userId." AND tbl_giohang.maSach = ".$book_id;

        $res_query = mysqli_query($database, $query);

        $temp = mysqli_fetch_all($res_query);

        // Cập nhật lại số lượng sách trong bảng sách
        $query = "UPDATE tbl_sach 
            SET soLuong = '".($temp[0][8] + $temp[0][2])."'
            WHERE maSach = ".$book_id;

        mysqli_query($database, $query);

        // Xóa sách khỏi giỏ
        $query = "DELETE FROM tbl_giohang 
        WHERE maKhachHang = '".$userId."' AND maSach = ".$book_id;

        mysqli_query($database, $query);
    }

    // Tạo mã đơn hàng mới
    function getNewOrderId($database) {        
        $query = "SELECT tbl_donHang.maDonHang
                FROM tbl_donhang 
                ORDER BY maDonHang DESC
                LIMIT 1";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    }

    // Đặt hàng
    function datHang($database, $orderInfor, $books_in_cart) {

        // Thêm đơn hàng
        $query = "INSERT INTO `tbl_donhang` (`maDonHang`, `ngayLap`, `tinhTrang`, `soDT`, `diaChi`, `maKhachHang`) 
        VALUES (NULL, '".$orderInfor[0]."', 'Chuẩn bị hàng', '".$orderInfor[1]."', '".$orderInfor[2]."', '".$orderInfor[3]."')";
            
        mysqli_query($database, $query);

        $new_order_id = getNewOrderId($database);

        // Thêm chi tiết đơn hàng
        foreach($books_in_cart as $row) {
            $query = "INSERT INTO `tbl_chitietdonhang`(`maDonHang`, `maSach`, `soLuong`)
                 VALUES ('".$new_order_id[0][0]."','".$row[0]."','".$row[4]."')";
            
            mysqli_query($database, $query);
        }

        // Xóa sách khỏi giỏ
        foreach($books_in_cart as $row) {
            $query = "DELETE FROM tbl_giohang 
            WHERE maKhachHang = '".$orderInfor[3]."' AND maSach = ".$row[0];

            mysqli_query($database, $query);
        }
    }

    // Lấy danh sách sách theo tên sách
    function getBookByName($database, $search_name) {
        $query = "SELECT * FROM tbl_sach WHERE tenSach LIKE '%".$search_name."%'";
        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_all($res_query);
    } 

    // Lấy số lượng nhà xuất bản
    function soLuongNXB($database) {
        $query = "SELECT COUNT(maNXB) FROM tbl_nxb";
        $res_query = mysqli_query($database, $query);

        $result = mysqli_fetch_row($res_query);
        return $result[0];
    }

    // Lấy số lượng thể loại
    function soLuongTL($database) {
        $query = "SELECT COUNT(maTheLoai) FROM tbl_theloai";
        $res_query = mysqli_query($database, $query);

        $result = mysqli_fetch_row($res_query);
        return $result[0];
    }

    // Lấy số lượng sách
    function soLuongSach($database) {
        $query = "SELECT COUNT(maSach) FROM tbl_sach";
        $res_query = mysqli_query($database, $query);

        $result = mysqli_fetch_row($res_query);
        return $result[0];
    }

    // Lấy số lượng sách
    function tongSoLuongSach($database) {
        $query = "SELECT SUM(soLuong) FROM tbl_sach";
        $res_query = mysqli_query($database, $query);

        $result = mysqli_fetch_row($res_query);
        return $result[0];
    }

    // Lấy số lượng khách hàng
    function soLuongKhachHang($database) {
        $query = "SELECT COUNT(maKhachHang) FROM tbl_khachhang WHERE admin_status = '0'";
        $res_query = mysqli_query($database, $query);

        $result = mysqli_fetch_row($res_query);
        return $result[0];
    }

    // Lấy danh sách sách
    function getBooks($database) {
        $query = "SELECT maSach, tenSach, tacGia, namXB, soLuong, gia, theLoai, tenNXB
                 FROM tbl_sach
                    INNER JOIN tbl_nxb ON tbl_nxb.maNXB = tbl_sach.maNXB
                    INNER JOIN tbl_theloai ON tbl_theloai.maTheLoai = tbl_sach.maTheLoai";
        $res_query = mysqli_query($database, $query);

        if(!$res_query) {
            echo "ERROR";
        }

        return mysqli_fetch_all($res_query);
    }

    // Lấy danh sách khách hàng
    function getKhachHang($database) {
        $query = "SELECT maKhachHang, ho, ten, gioiTinh, ngaySinh, soDT, email, diaChi
                 FROM tbl_khachhang WHERE admin_status = '0'";

        $res_query = mysqli_query($database, $query);

        if(!$res_query) {
            echo "ERROR";
        }

        return mysqli_fetch_all($res_query);
    }

    // Thêm nhà xuất bản
    function addNXB($database, $name) {
        $query = "INSERT INTO `tbl_nxb` (`maNXB`, `tenNXB`) VALUES (NULL, '".$name."')";

        return mysqli_query($database, $query);
    }

    // Thêm thể loại
    function addTheLoai($database, $name) {
        $query = "INSERT INTO `tbl_theloai` (`maTheLoai`, `theLoai`) VALUES (NULL, '".$name."')";

        return mysqli_query($database, $query);
    }

    function addBook($database, $book) {
        $query = "INSERT INTO `tbl_sach` (`maSach`, `tenSach`, `anh`, `tacGia`, `namXB`, `soLuong`, `gia`, `maTheLoai`, `maNXB`) 
                VALUES (NULL, '".$book[0]."', '".$book[1]."', '".$book[2]."', '".$book[3]."', '".$book[4]."', '".$book[5]."', '".$book[6]."', '".$book[7]."')";

        return mysqli_query($database, $query);
    } 

    // Sửa thông tin nhà xuất bản
    function editNXB($database, $maNXB, $name_edit) {
        $query = "UPDATE `tbl_nxb` SET `tenNXB` = '".$name_edit."' WHERE `tbl_nxb`.`maNXB` = ".$maNXB;

        return mysqli_query($database, $query);
    }

    // Sửa thông tin thể loại
    function editTheLoai($database, $maTL, $name_edit) {
        $query = "UPDATE `tbl_theloai` SET `theLoai` = '".$name_edit."' WHERE `tbl_theloai`.`maTheLoai` = ".$maTL;

        return mysqli_query($database, $query);
    }

    // Sửa thông tin sách
    function editBook($database, $book) {
        $query = "UPDATE `tbl_sach` 
                SET `tenSach` = '".$book[1]."', `anh` = '".$book[2]."', `tacGia` = '".$book[3]."', `namXB` = '".$book[4]."', `soLuong` = '".$book[5]."', `gia` = '".$book[6]."', `maTheLoai` = ".$book[7].", `maNXB` = ".$book[8]."
                WHERE `tbl_sach`.`maSach` = ".$book[0];
        
        return mysqli_query($database, $query);
    }

    // Xóa nhà xuất bản
    function delNXB($database, $maNXB) {
        $query = "DELETE FROM `tbl_nxb` WHERE `tbl_nxb`.`maNXB` = ".$maNXB;

        return mysqli_query($database, $query);
    }

    // Xóa thể loại sách
    function delTheLoai($database, $maTheLoai) {
        $query = "DELETE FROM `tbl_theloai` WHERE `tbl_theloai`.`maTheLoai` = ".$maTheLoai;

        return mysqli_query($database, $query);
    }

    // Xóa sách
    function delSach($database, $maSach) {
        $query = "DELETE FROM `tbl_sach` WHERE `tbl_sach`.`maSach` = ".$maSach;

        return mysqli_query($database, $query);
    }

    // Xóa tài khoản khách hàng
    function delKhachHang($database, $maKH) {
        $query = "DELETE FROM `tbl_khachhang` WHERE `tbl_khachhang`.`maKhachHang` = ".$maKH;

        return mysqli_query($database, $query);
    }

    // Lấy tên nhà xuất bản theo mã nhà xuát bản
    function getNXBByID($database, $maNXB) {
        $query = "SELECT tenNXB FROM tbl_nxb WHERE maNXB = ".$maNXB;

        $res_query = mysqli_query($database, $query);

        $row = mysqli_fetch_row($res_query);

        return $row[0];
    }
    
    // Lấy thể loại theo mã thể loại
    function getTheLoaiByID($database, $maTL) {
        $query = "SELECT theLoai FROM tbl_theloai WHERE maTheLoai = ".$maTL;

        $res_query = mysqli_query($database, $query);

        $row = mysqli_fetch_row($res_query);

        return $row[0];
    }

    function getImageBook($database, $maSach) {
        $query = "SELECT anh FROM tbl_sach WHERE maSach = ".$maSach;

        $res_query = mysqli_query($database, $query);

        $row = mysqli_fetch_row($res_query);

        return $row[0];
    }

    function getBookByID($database, $maSach) {
        $query = "SELECT * FROM tbl_sach WHERE maSach = ".$maSach;

        $res_query = mysqli_query($database, $query);

        return mysqli_fetch_row($res_query);
    }
?>
