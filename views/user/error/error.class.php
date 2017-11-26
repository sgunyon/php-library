<?php

class User_Error extends IndexView {

    public function display($message) {

        //display page header
        parent::displayHeader("Error");
        ?>
        <div class="center_content">
            <div class="left_content"> 
                <table style="width: 100%; border: none; padding-right: 30px">
                    <tr>
                        <td style="vertical-align: middle; text-align: center; width:100px">
                            <img src='<?= base_url ?>/www/img/books/error.jpg' style="width: 80px; border: none"/>
                        </td>
                        <td style="text-align: left; vertical-align: top;">
                            <h3> We're sorry, but an error has occurred.</h3>
                            <div style="color: red">
                                <?= urldecode($message) ?>
                            </div>
                            <p>Please go back to the previous page and fix the error.</p>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
        //display page footer
        parent::displayRight();
        parent::displayFooter();
    }

}
