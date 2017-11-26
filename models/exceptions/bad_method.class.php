<?php

class BadMethod extends Exception {

    static public function getError($name) {
        return $name . " is an improper method.";
    }

}