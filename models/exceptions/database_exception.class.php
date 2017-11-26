<?php

class DatabaseException extends Exception {

    static public function getError() {
        return "Can not run command on set database.";
    }

}
