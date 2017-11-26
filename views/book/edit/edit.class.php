<?php

class Book_Edit extends BookIndexView {

    public function display($book) {
        //display page header
        parent::displayHeader("Edit Book");
        if ($_SESSION['role'] == 4) {

            //retrieve book details by calling get methods
            $id = $book->getId();
            $title = $book->getTitle();
            $author = $book->getAuthor();
            $isbn = $book->getIsbn();
            $publisher = $book->getPublisher();
            $on_hand = $book->getOn_hand();
            $image = $book->getImage();
            $description = $book->getDescription();
            ?>

            <div class="center_content">
                <div class="left_content">
                    <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Edit Book Details</div>

                    <div class="feat_prod_box_details">
                        <p class="details">

                        </p>

                        <div class="contact_form">
                            <div class="form_subtitle">edit book</div>
                            <form action="<?= base_url ?>/book/update/<?= $id ?>" method="post" enctype="text">
                                <input type="hidden" name="id" class="contact_input" value="<?= $id ?>"/>
                                <div class="form_row">
                                    <label class="contact"><strong>Title:</strong></label>
                                    <input type="text" name="title" class="contact_input" value="<?= $title ?>" autofocus />
                                </div>  
                                <div class="form_row">
                                    <label class="contact"><strong>Author:</strong></label>
                                    <input type="text" name="author" class="contact_input" value="<?= $author ?>"/>
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>ISBN:</strong></label>
                                    <input type="text" name="isbn" class="contact_input" maxlength="13" value="<?= $isbn ?>"/>
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>Publisher:</strong></label>
                                    <input type="text" name="publisher" class="contact_input" value="<?= $publisher ?>"/>
                                </div>
                                <div class="form_row">
                                    <label class="contact"><strong>Inventory:</strong></label>
                                    <input type="text" name="on_hand" class="contact_input" value="<?= $on_hand ?>"/>
                                </div>
                                <div class="form_row">
                                    <label class="contact"><strong>Image:</strong></label>
                                    <input type="text" name="image" class="contact_input" value="<?= $image ?>"/>
                                </div>
                                <div class="form_row">
                                    <label class="contact"><strong>Description:</strong></label><br /><br />
                                    <textarea name="description" class="contact_input" cols="40" rows="5"  ><?= $description ?></textarea>
                                </div>
                                <div class="form_row">
                                    <input type="submit" class="register" value="update"  />
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
    