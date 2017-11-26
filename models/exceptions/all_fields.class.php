<?php

class AllFields extends Exception {

    static public function getError() {
        return "All fields are required.";
    }

}
