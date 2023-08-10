<!-- Đặt hàng -->
<?php
    $books_in_cart = getGioHang($mysqli, $user[0]);
?>

<form action="<?php echo str_replace("dathang=1", "opencart=1", $current_path) ?>" method = "post">
        <div id = "back">
        <div id = "dat-hang-fragment">
            <a href = " <?php echo str_replace("dathang=1", "opencart=1", $current_path) ?>"><span class="icon-close">
                <ion-icon name="close"></ion-icon>
            </span></a>

            <h2>Đơn hàng</h2>

            <div>
                <table class = "order">
                    <tr>
                        <td><b>Mã đơn hàng: </b></td>
                        <td  style = "padding-right: 250px;"></td>
                        <td><b>Ngày lập: </b></td>
                        <td><?php echo date('Y-m-d'); ?></td>
                    </tr>
                    <tr>
                        <td><b>Tên khách hàng: </b></td>
                        <td colspan="3"><?php echo $user[1]." ".$user[2] ?></td>
                    </tr>
                    <tr>
                        <td><b>Số điện thoại: </b></td>
                        <td colspan = "3" >
                            <input type="radio" name = "order_phone" value = "0" checked>
                            <label for=""><?php echo $user[5] ?></label>
                            <br><br>
                            <input type="radio" name = "order_phone" value = "1">
                            <input type="text" name = "soDT_datHang" value = "">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Địa chỉ: </b></td>
                        <td colspan = "3" >
                            <input type="radio" name = "dia_chi" value = "0" checked>
                            <label for=""><?php echo $user[7] ?></label>
                            <br><br>
                            <input type="radio" name = "dia_chi" value = "1">
                            <input type="text" name = "address_order" size = "40" value = "">
                        </td>
                    </tr>
                    <tr>
                        <td colspan = "4"><b>Danh sách sách: </b></td>
                    </tr>
                    <?php $sum_money_order = 0; foreach($books_in_cart as $row) { ?>
                    <tr>
                        <td class = "order-books" colspan = "2"><?php echo $row[1] ?> x<?php echo $row[4]?></td>
                        <td class = "order-books"><?php echo formatMoney($row[3]); ?></td>
                        <td class = "order-books"><?php echo formatMoney($row[3]*$row[4]); ?></td>
                    </tr>
                    <?php $sum_money_order +=  $row[3]*$row[4]; } ?>
                    <tr>
                        <td class = "total-order" colspan="4" align="right"><b>Tổng tiền:</b> <?php echo formatMoney($sum_money_order); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">
                            <input type = "submit" name = "btn-submit-order" class = "btn-submit-order" value = "Đặt hàng">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </div>
    </form>
