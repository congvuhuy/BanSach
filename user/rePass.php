<!-- Đổi mật khẩu -->
<form action="" method = "post">
        <div id = "change-password-fragment">
            <h2>Đổi mật khẩu</h2>
            <hr>
            <table>
                <tr>
                    <td class = "label">
                        Mật khẩu cũ:
                    </td>
                    <td class = "infor">
                        <input type="password" name = "old_password" required>
                    </td>
                </tr>
                <tr>
                    <td class = "label">
                        Mật khẩu mới:
                    </td>
                    <td class = "infor">
                        <input type="password" name = "new_password" placeholder="Mật khẩu gồm 6 chữ số" pattern="^\d{6}$" required>
                    </td>
                </tr>
                <tr>
                    <td class = "label">
                        Nhập lại mật khẩu mới:
                    </td>
                    <td class = "infor">
                        <input type="password" name = "rewrite" required>
                    </td>
                </tr>
            </table>

            <input type="submit" name = "change_password" id = "change" value = "Thay đổi" onclick="return confirm('Bạn chắc chắn muốn đổi mật khẩu?');">
        </div>
    </form>