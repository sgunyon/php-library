<?php

class Login extends UserIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Login");
        if ($_SESSION['role'] == 2 || $_SESSION['role'] == 4) {
            ?>

            <div class="center_content">
                <div class="left_content">
                    <br /><br />
                    <div class="title">                   
                        You have been logged in!
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
    