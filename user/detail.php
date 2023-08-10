<!-- Details -->
<form action = "" method = "POST">
    <div  id = "detail-fragment">
        <?php
            $query_select_book = "SELECT * FROM tbl_sach INNER JOIN tbl_nxb ON tbl_sach.maNXB = tbl_nxb.maNXB INNER JOIN tbl_theloai ON tbl_theloai.maTheLoai = tbl_sach.maTheLoai WHERE tbl_sach.maSach = ".$book_id;
            $res_query_select_book = mysqli_query($mysqli, $query_select_book);

            $ds_book = mysqli_fetch_all($res_query_select_book);
        ?>
        <div class = "detail-product">
            <h2 class = "title">Thông tin sách <?php echo $ds_book[0][1] ?></h2>

            <div class = "img-product">
                <img src="../Image/<?php echo $ds_book[0][2] ?>" alt="No image">
            </div>

            <p class = "name"><b><?php echo $ds_book[0][1] ?></b></p>
            <p class = "author"><b>Tác giả: </b><?php echo $ds_book[0][3] ?></p>
            <p class = "nxb"><b>Nhà xuất bản: </b><?php echo $ds_book[0][10] ?></p>
            <p class = "the-loai"><b>Thể loại: </b><?php echo $ds_book[0][12] ?></p>
            <p class = "nam"><b>Năm xuất bản: </b><?php echo $ds_book[0][4] ?></p>
            <p class = "price"><b>Giá: </b><?php echo formatMoney($ds_book[0][6]) ?></p>
            <p><b>Số lượng: </b><input aria-label="quantity" class="input-qty" name = "soluongmua" max="<?php echo $ds_book[0][5] ?>" min="1" type="number" value="1"></p>

            <button type="submit" class = "add-to-cart" name = "add-to-cart">Thêm hàng vào giỏ</button>
        </div>

        <div class = "product-suggest">
            <h2 class = "title">Gợi ý</h2>

            <div class = "list-books">
                <?php 
                    $query_suggest_book = "SELECT * FROM tbl_sach ORDER BY maSach DESC";
                    $res_query_suggest_book = mysqli_query($mysqli, $query_suggest_book);

                    $ds_suggest_book = mysqli_fetch_all($res_query_suggest_book);
                    for($i = 0; $i< 6; $i++) {
                ?>
                    <div class = "book"><a href="index.php?targer=detail&bookid=<?php echo $ds_suggest_book[$i][0] ?>">
                        <img src = "../Image/<?php echo $ds_suggest_book[$i][2] ?>" alt="No image">
                        
                        <p class = "name"><?php echo $ds_suggest_book[$i][1] ?></p>
                        <p class = "price"><?php echo formatMoney($ds_suggest_book[$i][6]) ?></p>
                    </a></div>
                <?php } ?>
            </div>
        </div>
    </div>
</form>