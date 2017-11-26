<?php

class Book_Index extends BookIndexView {
    /*
     * the displays accepts an array of book objects and displays
     * them in a table.
     */

    public function display($books, $random) {
        //display page header
        parent::displayHeader("Library Index");
        ?>
        <!--beginning left content-->
        <div class="center_content">
            <div class="left_content">

                <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Featured Book</div>

                <div class="feat_prod_box">

                    <?php
                    $r_id = $random->getId();
                    $r_title = $random->getTitle();
                    $r_image = $random->getImage();
                    $r_desc = $random->getDescription();
                    ?>

                    <div class="prod_img">
                        <?php echo "<a href='" . base_url . "/book/detail/" . $r_id . "'>" . "<img src='" . base_url . "/www/img/books/" . $r_image . "' alt='' title='' class='thumb' border='0' width='140' height='200' /></a>"; ?>
                    </div>

                    <div class="prod_det_box">


                        <div class="box_top"></div>
                        <div class="box_center">
                            <div class="prod_title"><?= $r_title ?><br /><br /></div>
                            <p class="details"><?= $r_desc ?></p>
                            <div style="font-size: x-small; text-align: right; padding: 10px; ">
                                <a href='<?= base_url ?>/book/detail/<?= $r_id ?>'>- more details -</a>
                            </div>

                            <div class="clear"></div>
                        </div>
                    </div> 

                    <div class="clear"></div>
                </div>



                <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet2.gif" alt="" title="" /></span>New books</div> 
                <div class="new_products">
                    <?php
                    $i = 0;
                    foreach ($books as $count => $book) {
                        if ($i == 3)
                            break;
                        $id = $book->getId();
                        $title = $book->getTitle();
                        $image = $book->getImage();
                        ?>

                        <div class="new_prod_box">
                            <a href="details.php"><?= $title ?></a><br />
                            <div class="new_prod_bg">
                                <span class="new_icon"><img src="<?= base_url ?>/www/img/books/new_icon.gif" alt="" title="" /></span>
                                <a href='<?= base_url ?>/book/detail/<?= $id ?>'><img src='<?= base_url ?>/www/img/books/<?= $image ?>' alt='' title='' class='thumb' border='0' width='60' height='100' /></a></div>
                        </div>              

                        <?php
                        $i++;
                    }
                    ?> 
                </div>  
                <div class="clear"></div>
            </div>
            <!--end of left content-->

            <?php
            //display page static right and footer
            parent::displayRight();
            parent::displayFooter();
        }

//end of display method
    }
    