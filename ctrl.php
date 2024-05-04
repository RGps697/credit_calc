<?php

require_once dirname(__FILE__).'/init.php';

//$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';


getRouter()->setDefaultRoute('calcShow');
getRouter()->setLoginRoute('login');

getRouter()->addRoute('calcShow', 'CalcCtrl', ['user','admin']);
getRouter()->addRoute('calcCompute', 'CalcCtrl', ['user','admin']);
getRouter()->addRoute('login', 'LoginCtrl');
getRouter()->addRoute('logout', 'LoginCtrl', ['user','admin']);

getRouter()->go();

/*

getConf()->login_action = 'login';

switch ($action) {
	default :
		control('app\\controllers', 'CalcCtrl',		'generateView', ['user','admin']);
	case 'login': 
		control('app\\controllers', 'LoginCtrl',	'doLogin');
	case 'calcCompute' : 
		//zamiast pierwszego parametru można podać null lub '' wtedy zostanie przyjęta domyślna przestrzeń nazw dla kontrolerów
		control(null, 'CalcCtrl',	'process',		['user','admin']);
	case 'logout' : 
		control(null, 'LoginCtrl',	'doLogout',		['user','admin']);
}


/*
switch ($action){
    default:
        control('app\\controllers', 'CalcCtrl', 'generateView', ['user','admin']);
    case 'login':
        control('app\\controllers', 'LoginCtrl', 'doLogin');
    case 'calcCompute':
        control(null, 'CalcCtrl', 'process', ['user','admin']);
    case 'logout':
        control(null, 'LoginCtrl', 'doLogout', ['user','admin']);
}


switch ($action){
    default:
        
        
        include 'check.php';
        include_once $conf->root_path.'/app/controllers/CalcCtrl.class.php';
        $ctrl = new CalcCtrl();
        $ctrl->generateView();
        break;
    case 'login':
        $ctrl = new app\security\LoginCtrl();
        $ctrl->doLogin();
        break;
    case 'calcCompute':
        include 'check.php';
        include_once $conf->root_path.'/app/controllers/CalcCtrl.class.php';
        $ctrl = new CalcCtrl();
        $ctrl->process();
        break;
    case 'logout':
        include 'check.php';
        include_once $conf->root_path.'/app/security/logout.php';
        //header("Location: ".$conf->app_url.'/app/security/logout.php');
        break;
    
            
            
    
}

*/