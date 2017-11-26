<?php

class Book_Add extends BookIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Add Book");
        if ($_SESSION['role'] == 4) {
            ?>

            <div class="center_content">
                <div class="left_content">
                    <br /><br />
                    <div class="title">                   
                        The book has been successfully added.
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
    