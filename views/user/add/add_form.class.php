<?php

class User_AddForm extends UserIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Add User Form");
        if ($_SESSION['role'] !== 2 || $_SESSION !== 4) {
            ?>
            <div class="center_content">
                <div class="left_content">
                    <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Add New User</div>

                    <div class="feat_prod_box_details">
                        <p class="details">

                        </p>

                        <div class="contact_form">
                            <form action="<?= base_url ?>/user/add/" method="post" enctype="text">
                                <div class="form_row">
                                    <label class="contact"><strong>First Name:</strong></label>
                                    <input type="text" name="firstname" class="contact_input" autofocus />
                                </div>  
                                <div class="form_row">
                                    <label class="contact"><strong>Last Name:</strong></label>
                                    <input type="text" name="lastname" class="contact_input" />
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>Username:</strong></label>
                                    <input type="text" name="username" class="contact_input" maxlength="13" />
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>Password:</strong></label>
                                    <input type="password" name="password" class="contact_input" />
                                </div>
                                <div class="form_row">
                                    <input type="submit" class="register" value="add user"  />
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
