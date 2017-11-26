<?php

class User_List extends UserIndexView {

    //put your code here

    public function display($users) {
        parent::displayHeader("User List");
        if ($_SESSION['role'] == 4) {
            ?>
            <div class="center_content">
                <div class="left_content">
                    <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet1.gif" alt="" title="" /></span>Book List</div>
                    <div class="feat_prod_box_details">

                        <table border="1" class="cart_table">
                            <tr class="cart_title">
                                <td>Username</td>    
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                            <?php
                            foreach ($users as $count => $user) {
                                $id = $user->getId();
                                $firstname = $user->getFirstname();
                                $lastname = $user->getLastname();
                                $username = $user->getUsername();
                                $role = $user->getRole();
                                ?>
                                <tr>
                                    <td><?= $username ?></td>
                                    <td><?= $firstname ?></td>
                                    <td><?= $lastname ?></td>
                                    <td><a href='<?= base_url ?>/user/edit/<?= $id ?>'>Edit User</a></td>
                                    <td><a href='<?= base_url ?>/user/delete/<?= $id ?>'>Delete User</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a href='<?= base_url ?>/user/addform/'>Add User</a></td>
                                </tr>
                        </table>   
                    </div>
                </div>

                <?php
                parent::displayRight();
                parent::displayFooter();
            } else {
                header("Location: " . base_url);
            }
        }

    }
    