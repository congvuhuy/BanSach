<!-- Home -->
<form action="" method = "post">
    <div id = "home-fragment">
        <div class = "homeImg">
            <img src="../Image/poster.webp" alt="No image">
        </div>

        <div class = "view-product">
            <h2 class = "title">Mới cập nhật</h2>
            <div class = "list-books">
            <?php
                $ds_new_book = getNewBooks($mysqli);
                foreach($ds_new_book as $row_new_book) {
            ?>
                <div class = "book"><a href="index.php?targer=detail&bookid=<?php echo $row_new_book[0] ?>">
                    <img src="../Image/<?php echo $row_new_book[2] ?>" alt="No image">
                    
                    <p class = "name"><?php echo $row_new_book[1] ?></p>
                    <p class = "price"><?php echo formatMoney($row_new_book[6]) ?></p>
                </a></div>
            <?php } ?>
            </div>
        </div>

        <div class = "view-product">
            <h2 class = "title">Mua nhiều nhất</h2> 

            <div class = "list-books">
            <?php 
                $ds_best_seller = bestSeller($mysqli);
                foreach($ds_best_seller as $row) {
            ?>
                <div class = "book">
                    <a href="index.php?targer=detail&bookid=<?php echo $row[0] ?>">
                        <img src="../Image/<?php echo $row[2] ?>" alt="No image">
                        
                        <p class = "name"><?php echo $row[1] ?></p>
                        <p class = "price"><?php echo formatMoney($row[3]) ?></p>
                    </a>
                </div>
            <?php } ?>
            </div> 
        </div>        

        <div class = "view-product">
        <h2 class = "title">Gợi ý</h2>

        <div class = "list-books">
            <?php 
                $ds_suggest_book = randBook($mysqli);
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