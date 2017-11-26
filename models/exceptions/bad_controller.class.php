<?php

class BadController extends Exception {

    static public function getError($name) {
        return $name . " is an improper controller.";
    }

}