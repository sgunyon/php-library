<?php

class NoResults extends Exception {

    public function getError($id) {
        return "I'm sorry Dave, there are no results.";
    }

}