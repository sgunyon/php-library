<?php

class UserNoUser extends Exception {

    public function getError($id) {
        return "There was a problem locating set user. The user id ' " . $id . " ' does not exist in the database.";
    }

}