<?php

require_once ("application/autoloader.class.php");

//define a constant for the application url; you may need to modify the value for your system.
define("base_url", "http://localhost/MVCLibrary");

Dispatcher::dispatch();