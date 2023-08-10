<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <?php
        include "../admincp/config/config.php";
        include "../dataProcess/dataProcess.php";

        if(!isset($_SESSION["admin"])) {
            header("Location:../login/login.php");
        } else {
            $adminId = $_SESSION['admin'][0];

            $admin = getTaiKhoan($mysqli, $adminId);
        }

        if(isset($_GET["targer"])) {
            $targer = $_GET["targer"];
        } else {
            $targer = "home";
        }

        if(isset($_POST["btn_add"])) {
            $action = "add";
        } else if(isset($_POST["btn_edit"])) {
            $action = "edit";
            $id = $_POST["id"];
        } else {
            $action = "no-action";
        }

        // Thêm mới nhà xuất bản
        if(isset($_POST["btn-add-nxb"])) {
            if(!addNXB($mysqli, $_POST["txt-name"]))
                echo "<script>alert('Thêm mới nhà xuất bản không thành công');</script>";
            else 
                echo "<script>alert('Thêm mới nhà xuất bản thành công');</script>";
        }

        // Thêm mới thể loại sách
        if(isset($_POST["btn-add-the-loai"])) {
            if(!addTheLoai($mysqli, $_POST["txt-name"]))
                echo "<script>alert('Thêm mới thể loại không thành công');</script>";
            else
                echo "<script>alert('Thêm mới thể loại thành công');</script>";
        }

        // Thêm mới sách
        if(isset($_POST["btn-add-book"])) {
            $book = array();
            $book[] = $_POST["txt-book-name"];
            
            $errors = array();
            $file_name = $_FILES['book-img']['name'];
            $file_size =$_FILES['book-img']['size'];
            $file_tmp =$_FILES['book-img']['tmp_name'];
            $file_type=$_FILES['book-img']['type'];   
            
            $file_ext = explode('.', $_FILES['book-img']['name']);
            $file_ext = strtolower(end($file_ext));
            $extensions = array("jpeg","jpg","png");        
            
            if(in_array($file_ext, $extensions) === false){
                echo "<script>alert('Chỉ cho phép tập tin JPG, JPEG hoặc PNG.');</script>";
            } else if($file_size > 2097152){
                echo "<script>alert('Kích thước tệp tin phải nhỏ hơn 2 MB');</script>";
            } else {
                $random_name = md5(uniqid(rand(), true)) . '.'.$file_ext;
                
                if(move_uploaded_file($file_tmp,"../Image/".$random_name)){
                    $book[] = $random_name;
                    $book[] = $_POST["txt-book-author"];
                    $book[] = $_POST["txt-book-year"];
                    $book[] = $_POST["txt-book-quantity"];
                    $book[] = $_POST["txt-book-price"];
                    $book[] = $_POST["add-book-tl"];
                    $book[] = $_POST["add-book-nxb"];
        
                    if(!addBook($mysqli, $book))
                        echo "<script>alert('Thêm mới sách không thành công');</script>";
                    else
                        echo "<script>alert('Thêm mới sách thành công');</script>";
                }
            }
        }

        // Sửa thông tin nhà xuất bản
        if(isset($_POST["btn-edit-nxb"])) {
            if(!editNXB($mysqli, $_POST["id-edit"], $_POST["txt-name-edit"]))
                echo "<script>alert('Sửa thông tin nhà xuất bản không thành công');</script>";
            else
                echo "<script>alert('Sửa thông tin nhà xuất bản thành công');</script>";
        }

        // Sửa thông tin thể loại
        if(isset($_POST["btn-edit-the-loai"])) {
        if(!editTheLoai($mysqli, $_POST["id-edit"], $_POST["txt-name-edit"]))
            echo "<script>alert('Sửa thông tin thể loại không thành công');</script>";
        else
            echo "<script>alert('Sửa thông tin thể loại thành công');</script>";
        }

        // Sửa thông tin sách
        if(isset($_POST["btn-edit-book"])) {

            $book = array();
            $book[] = $_POST["id-edit"];
            $book[] = $_POST["txt-book-name"];
            
            $errors = array();
            $file_name = $_FILES['book-img']['name'];
            $file_size =$_FILES['book-img']['size'];
            $file_tmp =$_FILES['book-img']['tmp_name'];
            $file_type=$_FILES['book-img']['type'];   
            
            $file_ext = explode('.', $_FILES['book-img']['name']);
            $file_ext = strtolower(end($file_ext));
            $extensions = array("jpeg","jpg","png");        
            
            if(in_array($file_ext, $extensions) === false){
                echo "<script>alert('Chỉ cho phép tập tin JPG, JPEG hoặc PNG.');</script>";
            } else if($file_size > 2097152){
                echo "<script>alert('Kích thước tệp tin phải nhỏ hơn 2 MB');</script>";
            } else {
                $random_name = md5(uniqid(rand(), true)) . '.'.$file_ext;
                
                if(move_uploaded_file($file_tmp,"../Image/".$random_name)){
                    $book[] = $random_name;
                    $book[] = $_POST["txt-book-author"];
                    $book[] = $_POST["txt-book-year"];
                    $book[] = $_POST["txt-book-quantity"];
                    $book[] = $_POST["txt-book-price"];
                    $book[] = $_POST["add-book-tl"];
                    $book[] = $_POST["add-book-nxb"];

                    print_r($book);

                    // Xóa ảnh cũ khỏi thư mục Image
                    if(file_exists("../Image/".getImageBook($mysqli, $book[0]).""))
                        unlink("../Image/".getImageBook($mysqli, $book[0])."");

                    if(!editBook($mysqli, $book))
                        echo "<script>alert('Sửa thông tin sách không thành công');</script>";
                    else
                        echo "<script>alert('Sửa thông tin sách thành công');</script>";
                }
            }
        }


        // Xóa nhà xuất bản
        if($targer == 'nxb' && isset($_POST["btn_delete"])) {
            $maNXB = $_POST["id"];
            delNXB($mysqli, $maNXB);
        }

        // Xóa thể loại
        if($targer == 'theloai' && isset($_POST["btn_delete"])) {
            $maTheLoai = $_POST["id"];
            delTheLoai($mysqli, $maTheLoai);
        }

        // Xóa sách
        if($targer == 'sach' && isset($_POST["btn_delete"])) {
            $maSach = $_POST["id"];
            
            // Xóa ảnh khỏi thư mục Image
            if(file_exists("../Image/".getImageBook($mysqli, $maSach).""))
                unlink("../Image/".getImageBook($mysqli, $maSach)."");
            
            delSach($mysqli, $maSach);
        }

        // Xóa tài khoản khách hàng
        if($targer == 'taikhoan' && isset($_POST["btn_delete"])) {
            $maKH = $_POST["id"];
            delKhachHang($mysqli, $maKH);
        }
    ?>

    <header>
        <ion-icon name="book-outline" class = "logo"></ion-icon>

        <form class = "navigation" action="" method = "get">
            <a href="index.php" class = "menu" style="text-decoration: none;">Trang chủ</a>
            
            <a href="index.php?targer=nxb" class = "menu">Bảo trì NXB
            </a>

            <a href="index.php?targer=theloai" class = "menu">Bảo trì thể loại
            </a>

            <a href="index.php?targer=sach" class = "menu">Bảo trì sách
            </a>

            <a href="index.php?targer=taikhoan" class = "menu">Quản lý tài khoản
            </a>
        </form>

        <div class = "user-account">
            <?php echo $admin[1]." ".$admin[2] ?>

            <ion-icon name="person"></ion-icon>

            <div class = "user-menu">
                <a href="../login/login.php?logout=1">Đăng xuất</a>
            </div>
        </div>
    </header>

    <div id="home" <?php if($targer <> "home") echo "style = \"display: none;\"" ?>>
        <h1>Chào mừng đến với trang admin website bán sách</h1>

        <hr>

        <img src="../Image/poster.webp" alt="No image">

        <h2>Thống kê dữ liệu hiện tại của website</h2>
        <p>Số lượng nhà xuất bản: <?php echo soLuongNXB($mysqli); ?></p>
        <p>Số lượng thể loại sách: <?php echo soLuongTL($mysqli); ?></p>
        <p>Số cuốn sách: <?php echo soLuongSach($mysqli); ?></p>
        <p>Tổng số lượng sách: <?php echo tongSoLuongSach($mysqli); ?> </p>
        <p>Số lượng tài khoản khách hàng: <?php echo soLuongKhachHang($mysqli); ?></p>
    </div>

    <div id="fragment" <?php if($targer <> "nxb" && $targer <> "theloai" && $targer <> "sach" && $targer <> "taikhoan") echo "style = \"display: none;\"" ?>>
        <?php if($targer == "nxb") { ?>
            <h1>Bảo trì nhà xuất bản</h1>
        <?php } else if($targer == "theloai") { ?>
            <h1>Bảo trì thể loại</h1>
        <?php } else if($targer == "sach") { ?>
            <h1>Bảo trì sách</h1>
        <?php } else if($targer == "taikhoan") { ?>
            <h1>Quản lý tài khoản khách hàng</h1>
        <?php } else ?>
        <hr>

        <?php if($targer <> "taikhoan") 
        echo "<form action = \"\" method=\"post\">
                <button type=\"submit\" name = \"btn_add\" class = \"btn_add\">Thêm mới</button>
            </form>"?>

        <table class = "list" border="1" cellspacing = "0">
            <tr>
                
            <?php if($targer == "nxb") { ?>
                <td colspan="3"><h2><b>
                    Danh sách nhà xuất bản
                </b></h2></td>
            <?php } else if($targer == "theloai") { ?>
                <td colspan="3"><h2><b>
                    Danh sách nhà xuất bản
                </b></h2></td>
            <?php } else if($targer == "sach") { ?>
                <td colspan="9"><h2><b>
                    Danh sách sách
                </b></h2></td>
            <?php } else if($targer == "taikhoan") { ?>
                <td colspan="9"><h2><b>
                    Danh sách khách hàng
                </b></h2></td>
            <?php } ?>

            </tr>

            <?php if($targer == "nxb") { ?>
            <tr>
                <td><b>Mã nhà xuất bản</b></td>
                <td><b>Tên nhà xuất bản</b></td>
                <td><b>#</b></td>
            </tr>
            <?php } else if($targer == "theloai") { ?>
            <tr>
                <td><b>Mã thể loại</b></td>
                <td><b>Tên thể loại</b></td>
                <td><b>#</b></td>
            </tr>
            <?php } else if($targer == "sach") { ?>
            <tr>
                <td><b>Mã sách</b></td>
                <td><b>Tên sách</b></td>
                <td><b>Tác giả</b></td>
                <td><b>Năm xuất bản</b></td>
                <td><b>Số lượng</b></td>
                <td><b>Giá</b></td>
                <td><b>Thể loại</b></td>
                <td><b>Nhà xuất bản</b></td>
                <td><b>#</b></td>
            </tr>
            <?php } else if($targer == "taikhoan") { ?>
            <tr>
                <td><b>Mã khách hàng</b></td>
                <td><b>Họ</b></td>
                <td><b>Tên</b></td>
                <td><b>Giới tính</b></td>
                <td><b>Ngày sinh</b></td>
                <td><b>Số điện thoại</b></td>
                <td><b>Email</b></td>
                <td><b>Địa chỉ</b></td>
                <td><b>#</b></td>
            </tr>
            <?php } ?>

            <?php 
            if($targer == "nxb") $list = getDMNXBV1($mysqli);
            else if($targer == "theloai") $list = getDMTheLoaiV1($mysqli);
            else if($targer == "sach") $list = getBooks($mysqli);
            else if($targer == "taikhoan") $list = getKhachHang($mysqli);

            foreach($list as $row) { 
            ?>
            <form action="" method = "post"><tr>
                <?php for($i = 0; $i < count($row); $i++) { ?>
                    <td><p><?php echo $row[$i] ?><p></td>
                <?php } ?>
                <td>
                    <input type="hidden" name = "id" value="<?php echo $row[0] ?>">
                    <?php if($targer <> "taikhoan") echo "<button type=\"submit\" name = \"btn_edit\" class = \"btn_edit\">Sửa</button>"?>
                    <button type="submit" name = "btn_delete" class = "btn_delete" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</button>
                </td>
            </tr></form>
            <?php } ?>
        </div>
    </div>

    <div class = "add-fragment" <?php if($action <> "add") echo "style = \"display: none;\"" ?>>
        <form action="" method = "post" enctype="multipart/form-data">
            <?php if($targer == "nxb") {?>
            <div class = "danh-muc-add">
                <h2>Thêm mới nhà xuất bản</h2>
                <hr>

                <p>Nhập tên nhà xuất bản:</p>
                <input type="text" name = "txt-name" size="30" required> 
                
                <br>
                <button type="submit" name = "btn-add-nxb">Thêm</button>
                <a href = ""><button type="button" name = "btn-cancel">Hủy</button></a>
            </div>

            <?php } else if($targer == "theloai") {?>
            <div class = "danh-muc-add">
                <h2>Thêm mới thể loại</h2>
                <hr>

                <p>Nhập tên thể loại:</p>
                <input type="text" name = "txt-name" size="30" required> 
                
                <br>
                <button type="submit" name = "btn-add-the-loai">Thêm</button>
                <a href = ""><button type="button" name = "btn-cancel">Hủy</button></a>
            </div>

            <?php } else if($targer == "sach") {?>
            <div class = "book-add">
                <h2>Thêm mới sách</h2>
                <hr>

                <p>Tên sách:
                <input type="text" name = "txt-book-name" size="30" required></p> 
                
                <p>Ảnh:
                <input type="file" name = "book-img" required><pre style="font-size: 0.6em; margin-left: 150px; color:gray;">Chỉ nhận file "jpeg","jpg","png", dưới 2MB</pre></p>

                <p>Tác giả:
                <input type="text" name = "txt-book-author" size="30" required></p>

                <p>Năm xuất bản:
                <input type="number" name = "txt-book-year" min = "1900" max = "<?php echo date("Y"); ?>" value = "2020" required></p>

                <p>Số lượng:
                <input type="number" name = "txt-book-quantity" min = "1" value = "10" required></p>

                <p>Giá (VNĐ):
                <input type="text" name = "txt-book-price" size="20" pattern="[1-9]\d*000$" placeholder="VD: 85000" required></p>

                <p>Thể loại:
                <select name = "add-book-tl">
                    <?php foreach(getDMTheLoai($mysqli) as $row) { ?>
                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                    <?php } ?>
                </select>

                <p>Nhà xuất bản:
                <select name = "add-book-nxb">
                    <?php foreach(getDMNXB($mysqli) as $row) { ?>
                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                    <?php } ?>
                </select>

                <br>
                <button type="submit" name = "btn-add-book">Thêm</button>
                <a href = ""><button type="button" name = "btn-cancel">Hủy</button></a>
            </div>
            <?php } ?>
        </form>
    </div>

    <div class = "edit-fragment" <?php if($action <> "edit") echo "style = \"display: none;\"" ?>>
        <form action="" method = "post"  enctype="multipart/form-data">
            <?php if($targer == "nxb") {?>
            <div class = "danh-muc-edit">
                <h2>Sửa thông tin nhà xuất bản</h2>
                <hr>

                <p>
                    <input type="hidden" value="<?php echo $id ?>" name = "id-edit">
                    Tên nhà xuất bản (cũ): <?php echo getNXBByID($mysqli, $id) ?>
                </p>

                <p>Nhập tên nhà xuất bản (mới):</p>
                <input type="text" name = "txt-name-edit" size="30" required> 
                
                <br>
                <button type="submit" name = "btn-edit-nxb">Sửa</button>
                <a href = ""><button type="button" name = "btn-cancel">Hủy</button></a>
            </div>

            <?php } else if($targer == "theloai") {?>
            <div class = "danh-muc-edit">
                <h2>Sửa thông tin thể loại sách</h2>
                <hr>

                <p>
                    <input type="hidden" value="<?php echo $id ?>" name = "id-edit">
                    Tên thể loại (cũ): <?php echo getTheLoaiByID($mysqli, $id) ?>
                </p>

                <p>Nhập tên thể loại (mới):</p>
                <input type="text" name = "txt-name-edit" size="30" required> 
                
                <br>
                <button type="submit" name = "btn-edit-the-loai">Sửa</button>
                <a href = ""><button type="button" name = "btn-cancel">Hủy</button></a>
            </div>

            <?php } else if($targer == "sach") {?>
                <div class = "book-edit">
                    <h2>Sửa thông tin sách</h2>
                    <hr>

                    <div style="display: grid; grid-template-columns: auto auto; row-gap: 10px; margin: 10px;">
                        <?php $book_infor = getBookByID($mysqli, $id); ?>

                        <input type="hidden" value="<?php echo $id ?>" name = "id-edit">

                        <p>Tên sách: <?php echo $book_infor[1] ?></p>
                        <input type="text" name = "txt-book-name" style="width: 300px;" required> 
                        
                        <p>Ảnh: <?php echo $book_infor[2] ?></p>
                        <input type="file" name = "book-img" required>

                        <p>Tác giả: <?php echo $book_infor[3] ?></p>
                        <input type="text" name = "txt-book-author" style="width: 250px;" required>

                        <p>Năm xuất bản: <?php echo $book_infor[4] ?></p>
                        <input type="number" name = "txt-book-year" min = "1900" max = "<?php echo date("Y"); ?>" value = "2020" style="width: 70px;" required>

                        <p>Số lượng: <?php echo $book_infor[5] ?></p>
                        <input type="number" name = "txt-book-quantity" min = "1" value = "10" style="width: 60px;" required>

                        <p>Giá (VNĐ): <?php echo $book_infor[6] ?></p>
                        <input type="text" name = "txt-book-price" size="20" pattern="[1-9]\d*000$" placeholder="VD: 85000" style="width: 150px;" required>

                        <p>Thể loại: <?php echo getTheLoaiByID($mysqli, $book_infor[7]); ?></p>
                        <select name = "add-book-tl" style="width: 200px;">
                            <?php foreach(getDMTheLoai($mysqli) as $row) { ?>
                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                            <?php } ?>
                        </select>

                        <p>Nhà xuất bản: <?php echo getNXBByID($mysqli, $book_infor[8]); ?></p>
                        <select name = "add-book-nxb" style="width: 200px;">
                            <?php foreach(getDMNXB($mysqli) as $row) { ?>
                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <br>
                    <button type="submit" name = "btn-edit-book">Sửa</button>
                    <a href = ""><button type="button" name = "btn-cancel">Hủy</button></a>
                </div>
            <?php } ?>
        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
