<?php
//require_once dirname(__FILE__).'/../../config.php';

use app\security\User;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

if ( !(isset($user) && isset($user->login) && isset($user->role)) ){
    $ctrl = new app\security\LoginCtrl();
    getMessages()->addError('Niezalogowany');
    $ctrl->generateView();
    
    exit();
}




/*
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

*/
?>