<?php

class BookBadResults extends Exception {

    public function getError() {
        return "Improper Request from current table.";
    }

}