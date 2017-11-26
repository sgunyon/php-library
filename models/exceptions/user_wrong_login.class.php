<?php

class UserWrongLogin extends Exception {

    static public function getError() {
        return "Username and/or password incorrect.";
    }

}
