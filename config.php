<?php
define('_SERVER_NAME', 'localhost');
define('_SERVER_URL', 'http://'._SERVER_NAME);
define('_APP_ROOT', '/AA/zad01_calc/credit_calc');
define('_APP_URL', _SERVER_URL._APP_ROOT);
define("_ROOT_PATH", dirname(__FILE__));
require_once _ROOT_PATH.'/smarty-4.5.2/libs/smarty.class.php';
?>