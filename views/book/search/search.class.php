<?php
/*
 * Author: Joel Allman
 * Date: 4/16/2014
 * Name: search.class.php
 * Description: Displays results from book_model running under search.php file.
 */

class Book_Search extends BookIndexView {
    /*
     * the displays accepts an array of book objects and displays
     * them in a table.
     */

    public function display($books) {
        //display page header
        parent::displayHeader("Search Books");
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
                        <div id="suggestionDiv">
                            <div class="new_prod_box">
                                <a href='<?= base_url ?>/book/detail/<?= $id ?>'><?= $title ?></a><br />
                                <div class="new_prod_bg">
                                    <span class="new_icon"><img src="<?= base_url ?>/www/img/books/new_icon.gif" alt="" title="" /></span>
                                    <a href='<?= base_url ?>/book/detail/<?= $id ?>'>
                                      <img src='<?= base_url ?>/www/img/books/<?= $image ?>' alt='' title='' class='thumb' border='0' width='60' height='100' />
                                    </a>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
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
