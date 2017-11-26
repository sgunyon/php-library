<?php

class Book_AddForm extends BookIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Add Book Form"); 
        if ($_SESSION['role'] == 4) {
            ?>
            <div class="center_content">
                <div class="left_content">
                    <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Add New Book</div>

                    <div class="feat_prod_box_details">
                        <p class="details">

                        </p>

                        <div class="contact_form">
                            <form action="<?= base_url ?>/book/add/" method="post" enctype="text">
                                <div class="form_row">
                                    <label class="contact"><strong>Title:</strong></label>
                                    <input type="text" name="title" class="contact_input" autofocus />
                                </div>  
                                <div class="form_row">
                                    <label class="contact"><strong>Author:</strong></label>
                                    <input type="text" name="author" class="contact_input" />
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>ISBN:</strong></label>
                                    <input type="text" name="isbn" class="contact_input" maxlength="13" />
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>Publisher:</strong></label>
                                    <input type="text" name="publisher" class="contact_input" />
                                </div>
                                <div class="form_row">
                                    <label class="contact"><strong>Inventory:</strong></label>
                                    <input type="text" name="on_hand" class="contact_input" />
                                </div>
                                <div class="form_row">
                                    <label class="contact"><strong>Image:</strong></label>
                                    <input type="text" name="image" class="contact_input" />
                                </div>
                                <div class="form_row">
                                    <label class="contact"><strong>Description:</strong></label>
                                    <input type="text" name="description" class="contact_input" />
                                </div>
                                <div class="form_row">
                                    <input type="submit" class="register" value="add book"  />
                                </div>   
                            </form>     
                        </div>  
                    </div> 
                </div>


                <?php
                parent::displayRight();
                parent::displayFooter();
            } else {
                header("Location: " . base_url);
            }
        }

//end of display method
    }
    