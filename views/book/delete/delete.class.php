<?php

class Book_Delete extends BookIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Delete Book");
        if ($_SESSION['role'] == 4) {
            ?>

            <div class="center_content">
                <div class="left_content">
                    <br /><br />
                    <div class="title">                   
                        The book has been successfully deleted.
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
    