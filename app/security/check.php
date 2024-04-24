<?php
require_once dirname(__FILE__).'/../../config.php';
if(!isset($_SESSION)) 
{ 
    session_start();
}

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if (empty($role)){
	include $conf->root_path.'/app/security/login.php';
	exit();
}

?>