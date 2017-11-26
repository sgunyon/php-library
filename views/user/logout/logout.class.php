<?php

class Logout extends UserIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Logout");
        ?>

        <div class="center_content">
            <div class="left_content">
                <br /><br />
                <div class="title">                   
                    You have been logged out!
                </div>
            </div>


            <?php
            parent::displayRight();
            parent::displayFooter();
        }

//end of display method
    }
    