<?php
require_once dirname(__FILE__).'/../../config.php';

require_once $conf->root_path.'/smarty-4.5.2/libs/smarty.class.php';

//pobranie parametrów
function getParamsLogin(&$form){
	$form['login'] = isset ($_REQUEST ['login']) ? $_REQUEST ['login'] : null;
	$form['pass'] = isset ($_REQUEST ['pass']) ? $_REQUEST ['pass'] : null;
}

function validateLogin(&$form,&$messages){
	if ( ! (isset($form['login']) && isset($form['pass']))) {
		return false;
	}

	if ( $form['login'] == "") {
		$messages [] = 'Nie podano loginu';
	}
	if ( $form['pass'] == "") {
		$messages [] = 'Nie podano hasła';
	}

	if (count ( $messages ) > 0) return false;
        
	if ($form['login'] == "admin" && $form['pass'] == "admin") {
		session_start();
		$_SESSION['role'] = 'admin';
		return true;
	}
	if ($form['login'] == "user" && $form['pass'] == "user") {
		session_start();
		$_SESSION['role'] = 'user';
		return true;
	}
	
	$messages [] = 'Niepoprawny login lub hasło';
	return false; 
}

global $conf;

$form = array();
$messages = array();

getParamsLogin($form);

if (!validateLogin($form,$messages)) {
    
    $smarty = new Smarty();

    $smarty->assign('conf',$conf);
    $smarty->assign('login',$form['login']);
    $smarty->assign('password',$form['pass']);
    $smarty->assign('messages',$messages);


    $smarty->display($conf->root_path.'\app\security\login_view.tpl');    
} else { 
    header("Location: ".$conf->app_url);
}


