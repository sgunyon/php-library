<?php

class User_Update extends UserIndexView {

    public function display($id) {
        //display page header
        parent::displayHeader("Edit User");
        if ($_SESSION['role'] == 4) {
            ?>

            <div class="center_content">
                <div class="left_content">
                    <br /><br />
                    <div class="title">                   
                        The user has been successfully updated
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
    