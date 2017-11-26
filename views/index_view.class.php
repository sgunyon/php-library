<?php

class IndexView {

    //this method displays the page header
    public function displayHeader($title) {
        ob_start();
        session_start();

        if (!isset($_SESSION['role']))
            $_SESSION['role'] = 1
            ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
                <title><?= $title; ?></title>
                <script type = "text/javascript">
                    var base_url = '<?= base_url ?>';
                    var suggest_url = '<?= base_url ?>' + '/book/suggest/';
                </script>
                <script type="text/javascript" src="<?= base_url ?>/www/js/ajax_autosuggestion.js"></script>
                <link rel="stylesheet" type="text/css" href="<?= base_url ?>/www/css/style.css" />
            </head>
            <body>

                <div id="wrap">
                    <div class="header">
                        <div class="logo"><a href="<?= base_url ?>"><img src="<?= base_url ?>/www/img/books/logo2.gif" alt="" title="" border="0" width="100"/></a></div>            
                        <div id="menu">
                            <ul>
                                <?php
                                if ($_SESSION['role'] == 2) {
                                    ?>
                                    <li><a href="<?= base_url ?>">Home</a></li>
                                    <li><a href="<?= base_url ?>/book/inventory/">Books</a></li>
                                    <li><a href="<?= base_url ?>/book/random/">Random Book</a></li>
                                    <li><a href="<?= base_url ?>/user/logout/">Logout for <?= $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?></a></li>

                                    <?php
                                } elseif ($_SESSION['role'] == 4) {
                                    ?>
                                    <li><a href="<?= base_url ?>">Home</a></li>
                                    <li><a href="<?= base_url ?>/book/inventory/">Books</a></li>
                                    <li><a href="<?= base_url ?>/book/addform/">Add Book</a></li>
                                    <li><a href="<?= base_url ?>/user/listuser/">User List</a></li>
                                    <li><a href="<?= base_url ?>/user/logout/">Logout</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="<?= base_url ?>">Home</a></li>
                                    <li><a href="<?= base_url ?>/book/inventory/">Inventory</a></li>
                                    <li><a href="<?= base_url ?>/book/random/">Random Book</a></li>
                                    <li><a href="<?= base_url ?>/user/loginform/">Login</a></li>
                                    <li><a href="<?= base_url ?>/user/addform/">New User</a></li>
                                <?php }
                                ?>
                                <li>
                                    <div id="searchbar">
                                        <form method="post" action="<?= base_url ?>/book/search/">
                                            <div id="searchTxt"></div>
                                            <input name="request" id="request"
                                                   onkeyup="updateSearch()" />
                                            <input type="submit" value="Search" />
                                        </form>
                                        <div id="searchid"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> 
                    <?php
                    //end header
                }

                public function displayRight() {
                    ?>
                    <div class="right_content">

                        <br />
                        <div class="title"><span class="title_icon"><img src="<?= base_url ?>/www/img/books/bullet3.gif" alt="" title="" /></span>&nbsp&nbspAbout Our Library</div> 
                        <div class="about">
                            <p>
                                <img src="<?= base_url ?>/www/img/books/about.gif" alt="" title="" class="right" />
                                This Library site has been created to demonstrate the application of PHP and mySQL in a real world environment. The goal of the site was to create dynamic webpages that can store and retrieve data from a database in a user friendly way. We have added features including user accounts, search, and random featured books. Please feel free to navigate through the site and test the various features in this application. <br/><br/>
                            </p>

                        </div>
                    </div><!--end of right content-->

                    <div class="clear"></div>
                </div>

                <?php
            }

            //this method displays the page footer
            public function displayFooter() {
                ?>
<!--
                <div class="footer">
                    <div class="left_footer"><img src="<?= base_url ?>/www/img/books/logo2.gif" alt="" title="" width="100"><br /> <a href="http://csscreme.com/freecsstemplates/" title="free templates"></a></div>
                    <div class="right_footer">


                    </div>
                </div>
            </body>
        </html>
-->
        <?php
    }

//end of displayFooter method
}
