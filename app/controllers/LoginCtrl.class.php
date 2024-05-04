<?php

namespace app\controllers;

use app\transfers\User;
use app\forms\LoginForm;

class LoginCtrl{
    private $form;
    
	
    public function __construct(){
            //stworzenie potrzebnych obiektów
            $this->form = new LoginForm();
    }

    public function getParams(){
            // 1. pobranie parametrów
            $this->form->login = getFromRequest('login');
            $this->form->pass = getFromRequest('pass');
    }

    public function validate(){
                
        if( !(isset ($this->form->login) && isset ($this->form->pass) ) ){
            getMessages()->addError('Bledne wywolanie aplikacji !');   
            getMessages()->addError(isset($this->form->login));   
            getMessages()->addError(isset($this->form->pass));
        }
        
        if( !getMessages()->isError()){
            
            if($this->form->login == ""){
                getMessages()->addError( 'Nie podano loginu' );
            }
            if($this->form->pass  == ""){
                getMessages()->addError( 'Nie podano hasla' );
            }
            
        }
        
        if ( !getMessages()->isError() ){
                    
            if ($this->form->login == "admin" && $this->form->pass == "admin"){
             
                if(session_status() == PHP_SESSION_NONE){
                 
                    session_start();
                    
                }
                
                $user = new User($this->form->login, 'admin');
                
                $_SESSION['user'] = serialize($user);
                
                addRole($user->role);
            }
            
            else if ($this->form->login == "user" && $this->form->pass = "user") {
                if (session_status() == PHP_SESSION_NONE){
                    session_start();
                }
                
                $user = new User($this->form->login, 'user');
                        
                $_SESSION['user'] = serialize($user);
                
                addRole($user->role);
            }
            
            else {
             
                getMessages()->addError('Niepoprawny login lub hasło');
                
            }
            
            return !getMessages()->isError();
        }
    }
    
    public function action_login(){
     
        $this->getParams();
                
        if($this->validate()){
            header("Location: ".getConf()->app_url."/");
        }
        else{
            $this->generateView();
            print "sh";
        }
        
    }
    
    public function action_logout(){
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        session_destroy();
        
        getMessages()->addInfo('Poprawnie wylogowano z systemu');
        
        $this->generateView();
    }
    
    public function generateView(){
     
        getSmarty()->assign('page_title','Strona logowania');
        getSmarty()->assign('form',$this->form);
        getSmarty()->display('login_view.tpl');
        
    }
    
}

/*
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


    $smarty->display($conf->root_path.'\app\views\login_view.tpl');    
} else { 
    header("Location: ".$conf->app_url);
}


*/