<?php

class Book_Inventory extends BookIndexView {
    /*
     * the displays accepts an array of book objects and displays
     * them in a table.
     */

    public function display($books) {
        //display page header
        parent::displayHeader("Book List");
        ?>
        <div class="center_content">
            <div class="left_content">
                <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Book List</div>
                <div class="new_products">

                    <?php
                    foreach ($books as $count => $book) {
                        $id = $book->getId();
                        $title = $book->getTitle();
                        $image = $book->getImage();
                        ?>

                        <div class="new_prod_box">
                            <div class="new_prod_bg">
                                <a href='<?= base_url ?>/book/detail/<?= $id ?>'><img src='<?= base_url ?>/www/img/books/<?= $image ?>' alt='' title='' class='thumb' border='0' width='60' height='100' /></a></div>
                                <br /><a href='<?= base_url ?>/book/detail/<?= $id ?>'><?= $title ?></a><br />
                        </div>

                        <?php
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
