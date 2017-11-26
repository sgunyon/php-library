<?php

class User_LoginForm extends UserIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Login Form");
        if ($_SESSION['role'] !== 2 || $_SESSION['role'] !== 4) {
            ?>


            <div class="center_content">
                <div class="left_content">
                    <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Add New User</div>

                    <div class="login_form">
                        <div class="form_subtitle">login into your account</div>
                        <form name="login" action="<?= base_url ?>/user/login/" method="post">          
                            <div class="form_row">
                                <label class="contact"><strong>Username:</strong></label>
                                <input type="text" class="contact_input" name="username" autofocus />
                            </div>  

                            <div class="form_row">
                                <label class="contact"><strong>Password:</strong></label>
                                <input type="password" class="contact_input" name="password" />
                            </div>                     

                            <div class="form_row">
                                <input type="submit" class="register" value="login" />
                            </div>   
                            <br/>
                            <div style="font-size:90%"><b>Sample Logins:</b><br><br><i>&nbsp&nbsp&nbsp admin/admin<br>&nbsp&nbsp&nbsp user/password</i></div>
                        </form>     
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
    