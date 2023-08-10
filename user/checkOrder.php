<!-- Đơn hàng -->
<form action="" method = "post">
    <div id = "order-fragment">
        <?php
            $ds_order_id = getMaDonHang($mysqli, $user[0]);
        ?>
        <h2><b>Đơn hàng của bạn</b></h2>
        <hr>

        <p id = "empty-order" <?php if(count($ds_order_id) <> 0) echo "style=\"display: none;\""; ?>>Hiện không có đơn hàng nào!</p>

        <div >
        <?php foreach($ds_order_id as $order_id) { ?>
            <table class = "order">
                <?php $ds_book_in_order = getDonHang($mysqli, $user[0], $order_id[0])?>
                <tr>
                    <td><b>Mã đơn hàng: </b></td>
                    <td><?php echo $ds_book_in_order[0][0] ?></td>
                    <td style = "padding-left: 150px;"><b>Ngày lập: </b></td>
                    <td><?php echo $ds_book_in_order[0][1] ?></td>
                </tr>
                <tr>
                    <td><b>Tên khách hàng: </b></td>
                    <td><?php echo $ds_book_in_order[0][2]." ".$ds_book_in_order[0][3] ?></td>
                    <td style = "padding-left: 150px;"><b>Số điện thoại: </b></td>
                    <td><?php echo $ds_book_in_order[0][4] ?></td>
                </tr>
                <tr>
                    <td><b>Địa chỉ: </b></td>
                    <td colspan = "3" ><?php echo $ds_book_in_order[0][5] ?></td>
                </tr>
                <tr>
                    <td><b>Tình trạng đơn hàng: </b></td>
                    <td colspan = "3" ><?php echo $ds_book_in_order[0][6] ?></td>
                </tr>
                <tr>
                    <td colspan = "4"><b>Danh sách sách: </b></td>
                </tr>
                <?php $sum_money = 0;
                foreach($ds_book_in_order as $row) {
                    $sum_money +=  $row[9]*$row[8];?>
                <tr>
                    <td class = "order-books" style="width: 300px;"><a href="index.php?targer=detail&bookid=<?php echo $row[10] ?>"><?php echo $row[7] ?></a></td>
                    <td class = "order-books">x<?php echo $row[8] ?></td>
                    <td class = "order-books"><?php echo formatMoney($row[9]) ?></td>
                    <td class = "order-books"><?php echo formatMoney($row[9]*$row[8]) ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td class = "total-order" colspan="4" align="right"><b>Tổng tiền:</b> <?php echo formatMoney($sum_money) ?></td>
                </tr>
                <tr>
                    <td class = "delete-order" colspan="4" align="right">
                        <?php if($row[6] <> "Đã giao") 
                        echo "<input type = \"submit\" name = \"btn-delete-order\" class = \"btn-delete-order\" value = \"Hủy đơn hàng ".$ds_book_in_order[0][0]."\" onclick=\"return confirm('Bạn chắc chắn muốn xóa đơn hàng này?');\""?>
                    </td>
                </tr>
            </table>
            <hr>
        <?php } ?>
        </div>
    </div>
</form>
