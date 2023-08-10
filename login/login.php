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
    
    if(isset($_GET["logout"])) {
        unset($_SESSION['user']);
    }

    // Kiểm tra xem cookie có tồn tại hay không và sử dụng nó để đăng nhập người dùng
    if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];
    }

    if(isset($_POST["btn_submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = "SELECT * FROM tbl_khachhang WHERE email = '".$email."' AND matKhau = '".$password."'";
        $res_query = mysqli_query($mysqli, $query);

        $taiKhoan = mysqli_fetch_all($res_query);

        if(count($taiKhoan) != 0) {
            if($taiKhoan[0][9] == 0) {
                $_SESSION['user'] = $taiKhoan[0];

                // Kiểm tra xem người dùng đã chọn ghi nhớ hay chưa
                if(isset($_POST['remember'])) {
                    // Thiết lập cookie với thông tin đăng nhập của người dùng
                    setcookie('email', $email, time() + (86400 * 30), "/"); // Hết hạn sau 30 ngày
                    setcookie('password', $password, time() + (86400 * 30), "/");
                } else {
                    // Nếu không được chọn, xóa cookie nếu có
                    if(isset($_COOKIE['email'])) {
                        setcookie('email', '', time() - 3600, '/'); // Đặt thời gian trước đó để xóa cookie
                    }
                    if(isset($_COOKIE['password'])) {
                        setcookie('password', '', time() - 3600, '/');
                    }
                }

                header("Location:../user/index.php");
                exit;
            } else {
                $_SESSION['admin'] = $taiKhoan[0];
                header("Location:../admincp/index.php");
            }
        } else {
            echo "<script>alert('Email\Mật khẩu không đúng!');</script>";
        }
    }
?>

<div class="wapper">
    
    <div class="form-box login">
        <a href="../user/index.php">
            <ion-icon name="close" class="icon-close"></ion-icon>
        </a>

        <h2>Đăng nhập</h2>
        <form action="" method = "post">
            
            <div class="input-box">
                <span class = "icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="email" name = "email" value = "<?php echo $email ?>" required>
                <label>Email</label>
            </div>
            
            <div class="input-box">
                <span class = "icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" name = "password" value = "<?php echo $password ?>" required>
                <label>Mật khẩu</label>
            </div>
            
            <div class="remember-forgot">
                <label><input type="checkbox" name = "remember">Ghi nhớ</label>
            </div>
            
            <input type="submit" class="btn_submit_login" name = "btn_submit" value = "Đăng nhập">
            
            <div class="login-register">
                <p>Chưa có tài khoản?
                    <a href="register.php" class="register-link">Đăng ký</a></p>
            </div>
        </form>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>