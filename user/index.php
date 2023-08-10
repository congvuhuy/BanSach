<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website bán sách</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/showByMenu.css">
    <link rel="stylesheet" href="../css/detail.css">
    <link rel="stylesheet" href="../css/order.css">
    <link rel="stylesheet" href="../css/userInfor.css">
    <link rel="stylesheet" href="../css/userMenu.css">
    <link rel="stylesheet" href="../css/changePass.css">
    <link rel="stylesheet" href="../css/datHang.css">
</head>

<body>
    <?php
        include "../admincp/config/config.php";
        include "../dataProcess/dataProcess.php";

        // Chuyển đổi giữa các fragment
        if(isset($_GET["targer"]) == "theloai" && isset($_GET["theloaiid"])) {
            $targer = $_GET["targer"];
            $theloai_id = $_GET["theloaiid"];
        } else if(isset($_GET["targer"]) == "nxb" && isset($_GET["nxbid"])) {
            $targer = $_GET["targer"];
            $nxb_id = $_GET["nxbid"];
        } else if(isset($_GET["targer"]) == "detail") {
            $targer = $_GET["targer"];
            $book_id = $_GET["bookid"];
        } else if(isset($_GET["targer"]) == "login") {
            $targer = isset($_GET["targer"]);
            header("Location:../login/login.php");
        } else if(isset($_GET["targer"]) == "register") {
            $targer = isset($_GET["targer"]);
            header("Location../login/register.php");
        } else {
            $targer = "home";
        }

        // Tìm kiếm
        if(isset($_GET["search-name"]) && $_GET["search-name"] <> "") {
            $targer = "search";
            $search_name = $_GET["search-name"];
        }

        // Mở giỏ hàng
        if(isset($_GET["opencart"])) {
            $opencart = 1;
        } else {
            $opencart = 0;
        }

        // Mở form đặt hàng
        if(isset($_GET["dathang"])) {
            $dathang = $_GET["dathang"];
        }

        // Hủy đơn hàng
        if(isset($_POST["btn-delete-order"])) {
            $order_delete_id = str_replace("Hủy đơn hàng ", "", $_POST["btn-delete-order"]);

            deleteOrder($mysqli, $order_delete_id);
        }

        // Lấy thông tin tài khoản đã đăng nhập
        if(isset($_SESSION["user"])) {
                $userId = $_SESSION['user'][0];

                $user = getTaiKhoan($mysqli, $userId);
        }

        // Đổi thông tin tài khoản
        if(isset($_POST["changeUserInfor"])) {

            $userInfor[] = $user[0];
            if(isset($_POST["first_name"]) && $_POST["first_name"] <> "") $userInfor[] = $_POST["first_name"] ;
            else $userInfor[] = $user[1];
            if(isset($_POST["last_name"]) && $_POST["last_name"] <> "") $userInfor[] = $_POST["last_name"] ;
            else $userInfor[] = $user[2];
            if(isset($_POST["gioi_tinh"])) $userInfor[] = $_POST["gioi_tinh"];
            else $userInfor[] = $user[3];
            if(isset($_POST["birthday"]) && $_POST["birthday"] <> "") $userInfor[] = $_POST["birthday"] ;
            else $userInfor[] = $user[4];
            if(isset($_POST["phone_number"]) && $_POST["phone_number"] <> "") $userInfor[] = $_POST["phone_number"] ;
            else $userInfor[] = $user[5];
            if(isset($_POST["address"]) && $_POST["address"] <> "") $userInfor[] = $_POST["address"] ;
            else $userInfor[] = $user[7];

            updateUserInfor($mysqli, $userInfor);

            $user = getTaiKhoan($mysqli, $user[0]);
        }

        // Đổi mật khẩu
        if(isset($_POST["change_password"])) {
            $old_pass = $_POST["old_password"];

            if($old_pass <> $user[8]) {
                echo "<script>alert('Mật khẩu không đúng!');</script>";
            } else {
                $new_pass = $_POST["new_password"];

                if($new_pass == $old_pass) {
                    echo "<script>alert('Mật khẩu mới trùng với mật khẩu cũ!');</script>";
                } else {
                    $rewrite = $_POST["rewrite"];
    
                    if($rewrite <> $new_pass) {
                        echo "<script>alert('Mật khẩu nhập lại không khớp!');</script>";
                    } else {
                        rePassword($mysqli, $user[0], $new_pass);
                        echo "<script>alert('Đổi mật khẩu thành công');</script>";
                    }
                }
            }
        }

        // Thêm sách vào giỏ
        if(isset($_POST["add-to-cart"])) {
            if(isset($_SESSION["user"])) {
                themSachVaoGio($mysqli, $user[0], $book_id, $_POST["soluongmua"]);
                echo "<script>alert('Thêm hàng vào giỏ hàng thành công');</script>";
            } else {
                echo "<script>alert('Cần đăng nhập để có thể thêm sách vào giỏ!');</script>";
            }
        }

        // Xóa sách khỏi giỏ
        if(isset($_POST["del-book-in-cart"])) {
            delBookInCart($mysqli, $user[0], $_POST["del-book-id"]);
        }

        // Đặt hàng
        if(isset($_POST["btn-submit-order"])) {
            $orderInfor = array();
            
            $orderInfor[] = date('Y-m-d');
            
            if($_POST["order_phone"] == 0) {
                $orderInfor[] = $user[5];
            } else {
                $orderInfor[] = $_POST["soDT_datHang"];
            }

            if($_POST["dia_chi"] == 0) {
                $orderInfor[] = $user[7];
            } else {
                $orderInfor[] = $_POST["address_order"];
            }

            $orderInfor[] = $user[0];

            datHang($mysqli, $orderInfor, getGioHang($mysqli, $user[0]));
            echo "<script>alert('Đặt hàng thành công');</script>";
        }
    ?>

    <header>
        <ion-icon name="book-outline" class = "logo"></ion-icon>

        <form class = "navigation" action="" method = "get">
            <a href="index.php" class = "menu" style="text-decoration: none;">Trang chủ</a>
            
            <div href="" class = "menu">Thể loại
                <div class = "sub-menu">
                <?php 
                    $ds_the_loai = getDMTheLoai($mysqli);
                    foreach($ds_the_loai as $row) {
                ?>
                    <a class = "item"  href = "index.php?targer=theloai&theloaiid=<?php echo $row[0] ?>">
                        <?php 
                            echo $row[1];
                        ?>
                    </a>
                <?php } ?>                 
                </div>
            </div>

            <div class = "menu">Nhà xuất bản
                <div class = "sub-menu">
                <?php 
                    $ds_nxb = getDMNXB($mysqli);
                    foreach($ds_nxb as $row) {
                ?>
                    <a class = "item" href = "index.php?targer=nxb&nxbid=<?php echo $row[0] ?>">
                        <?php echo $row[1]; ?>
                    </a>
                <?php } ?>
                </div>
            </div>
        </form>
    
        <a href = "http://localhost/BanSach/login/login.php" <?php if(isset($_SESSION['user'])) echo "style=\"display: none;\"" ?>>
            <button class = "btn-login" type = "submit">Đăng nhập</button>
        </a>

        <div class = "user-account" <?php if(!isset($_SESSION['user'])) echo "style=\"display: none;\"" ?>>
            <?php echo $user[1]." ".$user[2]; ?>

            <ion-icon name="person"></ion-icon>

            <div class = "user-menu">
                <a href="index.php?targer=userinfor">Thông tin tài khoản</a>
                <a href="index.php?targer=checkorder">Kiểm tra đơn hàng</a>
                <a href="index.php?targer=repass">Đổi mật khẩu</a>
                <a href="http://localhost/BanSach/login/login.php?logout=1">Đăng xuất</a>
            </div>
        </div>
        
        <a <?php
            $current_path = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            if(isset($_SESSION["user"])) {
                if(strpos($_SERVER['REQUEST_URI'], "?") == false) {
                    echo "href = \"".$current_path."?opencart=1\"";
                } else {
                    echo "href = \"".$current_path."&opencart=1\"";
                }
            }
            else echo "href=\"../login/login.php\"" ?> id = "cart">

            <ion-icon name="cart"></ion-icon>
        </a>    

        <form action="" method="get">
            <div class="search-box">
                <input type="text" id="search-txt" placeholder="Tìm kiếm ..." name = "search-name">
                <button type = "submit"><span id="search-btn">
                    <ion-icon name="search"></ion-icon>
                </span></button>
            </div> 
        </form>
        
    </header>

    <?php
        if($targer == "theloai" || $targer == "nxb" || $targer == "search") {
            include("../user/showByMenu.php");
        } else if($targer == "detail") {
            include("../user/detail.php");
        } else if($targer == "checkorder") {
            include("../user/userMenu.php");
            include("../user/checkOrder.php");
        } else if($targer == "userinfor") {
            include("../user/userMenu.php");
            include("../user/changeInfor.php");
        } else if($targer == "repass") {
            include("../user/userMenu.php");
            include("../user/rePass.php");
        }
        else {
            include("../user/home.php");
        }

        if($opencart == 1) {
            include("../user/cart.php");
        }

        if($dathang == 1) {
            include("../user/datHang.php");
        }
    ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>