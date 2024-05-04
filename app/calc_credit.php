<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

include $conf->root_path.'/app/security/check.php';

require_once $conf->root_path.'/app/CalcCtrl.class.php';

$ctrl = new CalcCtrl();
$ctrl->action_calcCompute();

/*
include _ROOT_PATH.'/app/security/check.php';

$smarty = new Smarty();

function getParams(&$x,&$y,&$z){
	$x = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
	$y = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
	$z = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;	
}

function validate(&$x,&$y,&$z,&$messages){
    if ( ! (isset($x) && isset($y) && isset($z))) {
        return false;
    }
    // 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

    // sprawdzenie, czy parametry zostały przekazane
    if ( ! (isset($x) && isset($y) && isset($z))) {
            //sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
            $messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
        return false;
    }

    // sprawdzenie, czy potrzebne wartości zostały przekazane
    if ( $x == "") {
        $messages [] = 'Nie podano kwoty';
    }
    if ( $y == "") {
        $messages [] = 'Nie podano miesięcy';
    }
    if ( $z == "") {
        $messages [] = 'Nie podano oprocentowania';
    }

    $x = intval($x);
    $y = intval($y);
    $z = intval($z);

    if ( $x <= 0) {
        $messages [] = 'Wartość kwoty musi być większa od 0';
    }
    if ( $y <= 0) {
        $messages [] = 'Wartość miesięcy musi być większa od 0';
    }
    if ( $z <= 0) {
        $messages [] = 'Wartość oprocentowania musi być większa od 0';
    }
    
    if (count ( $messages ) > 0) return false;

    return true;
}
// 3. wykonaj zadanie jeśli wszystko w porządku

function process(&$x,&$y,&$z,&$messages,&$result){
    if (empty ( $messages )) { // gdy brak błędów

            $result = ($x / $y) * (1 + ($z / 100));
    }
}
    
$x = null;
$y = null;
$z = null;
$result = null;
$messages = array();

getParams($x,$y,$z);
if ( validate($x,$y,$z,$messages) ) {
	process($x,$y,$z,$messages,$result);
        
}

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('result', $result);
$smarty->assign('x', $x);
$smarty->assign('y', $y);
$smarty->assign('z', $z);
$smarty->assign('messages',$messages);

$smarty->display(_ROOT_PATH.'\app\calc_credit_view.tpl');    
*/