<?php

// Debug sets
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

// Site directory set
define('ROOT', dirname(__FILE__));

//Timezone set
if (isset($_SESSION['timezone'])) {
    date_default_timezone_set($_SESSION['timezone']);
}

//Conecting system files
require_once(ROOT.'/components/Autoload.php');


//Router call
$router = new Router();
$router->run();