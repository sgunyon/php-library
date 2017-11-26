<?php

class UserBadResults extends Exception {

    static public function getError() {
        return "The search failed to find proper results.";
    }

}