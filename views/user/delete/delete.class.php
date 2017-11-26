<?php

class User_Delete extends UserIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Delete User");
        if ($_SESSION['role'] == 4) {
            ?>

            <div class="center_content">
                <div class="left_content">
                    <br /><br />
                    <div class="title">                   
                        The user has been successfully deleted.
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
    