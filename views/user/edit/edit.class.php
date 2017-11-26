<?php

class User_Edit extends UserIndexView {

    public function display($user) {
        //display page header
        parent::displayHeader("Edit User");
        if ($_SESSION['role'] == 4) {

            //retrieve user details by calling get methods
            $id = $user->getId();
            $firstname = $user->getFirstname();
            $lastname = $user->getLastname();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $role = $user->getRole();
            ?>

            <div class="center_content">
                <div class="left_content">
                    <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Edit User Details</div>

                    <div class="feat_prod_box_details">
                        <p class="details">

                        </p>

                        <div class="contact_form">
                            <form action="<?= base_url ?>/user/update/<?= $id ?>" method="post" enctype="text">
                                <input type="hidden" name="id" class="contact_input" value="<?= $id ?>"/>
                                <div class="form_row">
                                    <label class="contact"><strong>First Name:</strong></label>
                                    <input type="text" name="firstname" class="contact_input" value="<?= $firstname ?>" autofocus />
                                </div>  
                                <div class="form_row">
                                    <label class="contact"><strong>Author:</strong></label>
                                    <input type="text" name="lastname" class="contact_input" value="<?= $lastname ?>"/>
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>Username:</strong></label>
                                    <input type="text" name="username" class="contact_input" maxlength="13" value="<?= $username ?>"/>
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>Password:</strong></label>
                                    <input type="password" name="password" class="contact_input" maxlength="13" value="<?= $password ?>"/>
                                </div> 
                                <div class="form_row">
                                    <label class="contact"><strong>Role:</strong></label>
                                    <input type="text" name="role" class="contact_input" value="<?= $role ?>"/>
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
    