<?php

class UserEditDb extends Exception {

    static public function getError() {
        return "We're sorry.  Database can not accept changes at this time.";
    }

}