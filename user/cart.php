<!-- Cart -->
<div class="view-cart" <?php if($opencart <> 1) echo "style=\"display: none;\"";?>>
    <div class = "head-cart">
        Giỏ hàng
        <a href = "<?php echo substr($current_path, 0, strlen($current_path) - 11); ?>">
            <ion-icon name="close-outline"></ion-icon>
        </a>
    </div>

    <?php
        $books_in_cart = getGioHang($mysqli, $user[0]);
        
        foreach($books_in_cart as $row) {
    ?>
    <form action="" method="post">
        <div class="product">
            <img src="../Image/<?php echo $row[2] ?>" alt="No image">
                                    
            <button type = "submit" class = "del-book-in-cart" name = "del-book-in-cart" ><ion-icon name="close-outline"></ion-icon></button>
            <input type="hidden" name = "del-book-id" value="<?php echo $row[0] ?>">
            <p class = "name">
                <?php echo $row[1] ?>
            </p>
            <p class = "cost"><?php echo formatMoney($row[3]) ?></p>
            <p class = "qty-buy">Số lượng mua: <?php echo $row[4] ?></p>
            <a href="index.php?targer=detail&bookid=<?php echo $row[0] ?>" class = "xem-chi-tiet">>>Xem chi tiết</a>
        </div>    
    </form>
    <?php } ?>

    <form action = "<?php echo str_replace("opencart=1", "dathang=1", $current_path) ?>" method = "post">
        <?php if(count($books_in_cart) <> 0) {
                echo "<button class = \"btn-order\" type=\"submit\" name = \"dat-hang\">Đặt hàng</button>";
            } else {
                echo "Hiện không có sách nào trong giỏ";
            }?>
    </form>
</div>