<?php

class BookDbExport extends Exception {

    static public function getError() {
        return "We're sorry.  The database produced invalid results.";
    }

}