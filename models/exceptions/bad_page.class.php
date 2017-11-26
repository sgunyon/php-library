<?php

class BadPage extends Exception {

    static public function getError() {
        return "We're sorry, the page cannot be found at this time.";
    }

}
