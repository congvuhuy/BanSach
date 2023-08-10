<!-- User menu -->
<form action="" method = "post"> 
    <div id = "user-menu-fragment">
        <div class = "user-name">
            <ion-icon name="person-circle"></ion-icon>
            <h2><?php echo $user[1]." ".$user[2] ?></h2>
        </div>
        <hr>

        <div class = "user-menu">
            <div>
                <ion-icon name="information-circle-outline"></ion-icon>
                <a href="index.php?targer=userinfor">Thông tin tài khoản</a>
            </div>
            
            <div>
                <ion-icon name="newspaper-outline"></ion-icon>
                <a href="index.php?targer=checkorder">Kiểm tra đơn hàng</a>
            </div>

            <div>
                <ion-icon name="key-outline"></ion-icon>
                <a href="index.php?targer=repass">Đổi mật khẩu</a>
            </div>

            <div>
                <a href="../login/login.php">Đăng xuất</a>
            </div>
        </div>
    </div>
</form>