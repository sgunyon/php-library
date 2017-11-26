<?php

class BookNoBook extends Exception {

    public function getError($id) {
        return "There was a problem locating set book. The book id ' " . $id . " ' does not exist in the database.";
    }

}
