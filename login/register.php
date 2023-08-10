<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/login.css">

</head>

<body>
<?php
    session_start();

    include("../admincp/config/config.php");
    
    if(isset($_POST["btn_register"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = "SELECT * FROM tbl_khachhang WHERE email = '".$email."'";
        $res_query = mysqli_query($mysqli, $query);

        $taiKhoan = mysqli_fetch_all($res_query);

        if(count($taiKhoan) == 0) {

            $query = "INSERT INTO `tbl_khachhang` (`maKhachHang`, `ho`, `ten`, `gioiTinh`, `ngaySinh`, `soDT`, `email`, `diaChi`, `matKhau`, `admin_status`)
             VALUES (NULL, '', '".$name."', 'Khác', '2000-01-01', '0000000000', '".$email."', '', '".$password."', '0')";

            $res_query = mysqli_query($mysqli, $query);
            
            header("Location:../login/login.php");
        
        } else {
            echo "<script>alert('Email đã được sử dụng!');</script>";
        }
    }
?>

<div class="wapper">
    <div class="form-box register">
        <a href="../user/index.php">
            <ion-icon name="close" class="icon-close"></ion-icon>
        </a>
    
        <h2>Đăng ký</h2>
        <form action="" method="post">
            <div class="input-box">
                <span class = "icon">
                    <ion-icon name="person"></ion-icon>
                </span>
                <input type="text" name = "name" required>
                <label>Tên người dùng</label>
            </div>

            <div class="input-box">
                <span class = "icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="email" name = "email" required>
                <label>Email</label>
            </div>
            
            <div class="input-box">
                <span class = "icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" name = "password" placeholder="Mật khẩu gồm 6 chữ số" pattern="^\d{6}$" required>
                <label>Mật khẩu</label>
            </div>
            
            <div class="remember-forgot">
                <label><input type="checkbox" required>Tôi đồng ý với các điều khoản và điều kiện</label>
            </div>
            
            <button type="submit" class="btn_submit_login" name = "btn_register">Đăng ký</button>
            
            <div class="login-register">
                <p>Đã có tài khoản?
                    <a href="login.php" class="login-link">Đăng nhập</a></p>
            </div>
        </form>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>