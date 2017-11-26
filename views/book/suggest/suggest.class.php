<?php
/*
 * Author: Joel Allman
 * Date: 04/16/2014
 * Name: suggest_book.class.php
 * Description: displays an actual search live with ajax.
 *
 */

class Book_Suggest extends BookIndexView {
    /*
     * the displays accepts an array of book objects and displays
     * them in a table.
     */

    public function display() {
        //display page header
        parent::displayHeader("Book List");
        ?>
        <div class="center_content">
            <div class="left_content" id="left_content">
                <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Book List</div>
                <div class="new_products">
                    <div class="new_prod_box">
                        <div class="new_prod_bg">
                            <p>Upon typing your searched material, This will load up possible titles.</p>
                        </div>

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
    