<?php

class BookNoResults extends Exception {

    public function getError($title) {
        return "Your query, " . $title . " shows we do not have a book or author by that term.";
    }

}