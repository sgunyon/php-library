<?php

class BookNotNumeric extends Exception {

    static public function getError() {
        return "Inventory needs to be a numeric value.";
    }

}