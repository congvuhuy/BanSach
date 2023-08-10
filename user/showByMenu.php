<!-- Show By Menu -->
<form action = "" method = "get">
    <div id = "show-by-menu-fragment">        

        <div class = "product-by-menu">
        <?php
            if($targer == "theloai") {
                $ds_book_by_dm = getBookByTL($mysqli, $theloai_id);
            } else if($targer == "nxb") {
                $ds_book_by_dm = getBookByNXB($mysqli, $nxb_id);
            } else {
                $ds_book_by_dm = getBookByName($mysqli, $search_name);
            }
        ?>
            <h2 class = "title">
                <?php
                    if($targer == "theloai") {
                        echo $ds_book_by_dm[0][10];
                    } else if($targer == "nxb") {
                        echo $ds_book_by_dm[0][10];
                    } else {
                        echo "Các cuốn sách có tên tương ứng \"".$search_name."\"";
                    }
                ?>
            </h2>

            <div class = "list-books">
                <?php

                    if(count($ds_book_by_dm) == 0) echo "Tìm kiếm không có kết quả";
                    
                    foreach($ds_book_by_dm as $row_book_by_dm) {
                ?>

                <div class = "book"><a href="index.php?targer=detail&bookid=<?php echo $row_book_by_dm[0] ?>">
                    <img src="../Image/<?php echo $row_book_by_dm[2] ?>" alt="No image">
                    
                    <p class = "name"><?php echo $row_book_by_dm[1] ?></p>
                    <p class = "price"><?php echo formatMoney($row_book_by_dm[6]) ?></p>
                </a></div>
                
                <?php } ?>    
                    
            </div>
        </div>    
                
        <div class = "top">
            <h2 class = "title">Bán nhiều nhất</h2>
    
            <div class = "list-books">
                <?php
                    if($targer == "theloai") {
                        $ds_best_seller_by_DM = bestSellerByTL($mysqli, $theloai_id);
                    } else if($targer == "nxb") {
                        $ds_best_seller_by_DM = bestSellerByNXB($mysqli, $nxb_id);
                    } else {
                        $ds_best_seller_by_DM = bestSellerV1($mysqli);
                    }
    
                    foreach($ds_best_seller_by_DM as $row) {
                ?>
                <div class = "book"><a href="index.php?targer=detail&bookid=<?php echo $row[0] ?>">
                    <img src = "../Image/<?php echo $row[2] ?>" alt="No image">
                    
                    <p class = "name"><?php echo $row[1] ?></p>
                    <p class = "price"><?php echo formatMoney($row[3]) ?></p>
                </a></div>
                <?php } ?>
            </div>
        </div>
    </div>
</form>
