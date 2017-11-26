<?php

class Book_Detail extends BookIndexView {

    public function display($book) {
        //display page header
        parent::displayHeader("Book Details");

        $id = $book->getId();
        $title = $book->getTitle();
        $isbn = $book->getIsbn();
        $publisher = $book->getPublisher();
        $on_hand = $book->getOn_hand();
        $image = $book->getImage();
        $description = $book->getDescription();
        ?>
        <div class="center_content">
            <div class="left_content">

                <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span><?= $title ?></div>

                <div class="feat_prod_box_details">


                    <div class="prod_img">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <a href=" <?= base_url ?>/book/detail/<?= $id ?>"><img src="<?= base_url ?>/www/img/books/<?= $image ?>" alt='' title='' class='thumb' border='0' width='250' height='375' /></a>
                        <br /><br />
                    </div>


                </div>

                <div class="clear"></div>
            </div><!--end of left content-->

            <div class="right_content">
                <br /><br /><br />
                <div class="prod_det_box">
                    <div class="box_top"></div>
                    <div class="box_center">
                        <div class="prod_title">Description:<br /><br /></div>
                        <p class="details">
                            <?= $description ?> 
                            <br/><br/>
                            Publisher: &nbsp&nbsp&nbsp&nbsp&nbsp <?= $publisher ?>  <br/>
                            ISBN: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?= $isbn ?>  <br/>
                            In Stock: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?= $on_hand ?></p>



                        <?php
                        if ($_SESSION['role'] == 4) {
                            ?>
                            <a href="<?= base_url . "/book/delete/" . $id ?>" class="delete"><img src="<?= base_url ?>/www/img/books/delete.gif" alt="" title="" border="0" /></a>
                            <a class="delete">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
                            <a href="<?= base_url . "/book/edit/" . $id ?>" class="delete"><img src="<?= base_url ?>/www/img/books/edit.gif" alt="" title="" border="0" /></a>
                        <?php } elseif (($on_hand <= 0)) {
                            ?>
                            <a class="more"><img src="<?= base_url ?>/www/img/books/out.gif" alt="" title="" border="0" /></a>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <div class="clear"></div>
                        <div class="box_bottom"></div>
                    </div>
                </div>     

            </div><!--end of right content-->

            <div class="clear"></div>
        </div><!--end of center content-->

        <?php
        //parent::displayRight();
        parent::displayFooter();
    }

//end of display method
}
