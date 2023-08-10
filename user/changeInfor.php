<!-- Thay đổi thông tin tài khoản -->
<form action="" method="post">
    <div id = "user-information-fragment">
        <h2><b>Thông tin cá nhân</b></h2>
        <hr>

        <table>
            <tr>
                <td class = "label">
                    Họ:
                </td>
                <td>
                    <?php echo $user[1] ?>
                </td>
                <td class = "infor-change">
                    <input type="text" name = "first_name">
                    <ion-icon name="pencil"></ion-icon>
                </td>
            </tr>
            <tr>
                <td class = "label">
                    Tên:
                </td>
                <td>
                    <?php echo $user[2] ?>
                </td>
                <td class = "infor-change">
                    <input type="text" name = "last_name">
                    <ion-icon name="pencil"></ion-icon>
                </td>
            </tr>
            <tr>
                <td class = "label">
                    Giới tính:
                </td>
                <td>
                    <?php echo $user[3] ?>
                </td>
                <td class = "infor-change">
                    <input type="radio" name = "gioi_tinh" value = "Nam">
                    <label for="">Nam</label>
                    <input type="radio" name = "gioi_tinh" value = "Nữ">
                    <label for="">Nữ</label>
                    <input type="radio" name = "gioi_tinh" value = "Khác">
                    <label for="">Khác</label>
                    <ion-icon name="pencil"></ion-icon>
                </td>
            </tr>
            <tr>
                <td class = "label">
                    Ngày sinh:
                </td>
                <td>
                    <?php echo $user[4] ?>
                </td>
                <td class = "infor-change">
                    <input type="date" name = "birthday">
                    <ion-icon name="pencil"></ion-icon>
                </td>
            </tr>
            <tr>
                <td class = "label">
                    Số điện thoại:
                </td>
                <td>
                    <?php echo $user[5] ?>
                </td>
                <td class = "infor-change">
                    <input type="text" name = "phone_number">
                    <ion-icon name="pencil"></ion-icon>
                </td>
            </tr>
            <tr>
                <td class = "label">
                    Email:
                </td>
                <td colspan = "2">
                    <?php echo $user[6] ?>
                </td>
            </tr>
            <tr>
                <td class = "label">
                    Địa chỉ:
                </td>
                <td style = "width: 240px;">
                    <?php echo $user[7] ?>
                </td>
                <td class = "infor-change">
                    <input type="text" name = "address" size="40">
                    <ion-icon name="pencil"></ion-icon>
                </td>
            </tr>
        </table>

        <input type = "submit" name = "changeUserInfor" id = "save" value = "Thay đổi" onclick="return confirm('Bạn chắc chắn muốn thay đổi thông tin cá nhân?');">
    </div>
</form>
