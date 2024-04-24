<?php


require_once $conf->root_path.'/smarty-4.5.2/libs/smarty.class.php';
require_once $conf->root_path.'/app/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';

include $conf->root_path.'/app/security/check.php';

class CalcCtrl {
    
    private $msgs;
    private $form;
    private $result;

    public function __construct(){
        $this->form = new CalcForm();
        $this->result = new CalcResult();
        $this->msgs = new Messages();
        
    }
    
    public function getParams(){
            $this->form->x = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
            $this->form->y = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
            $this->form->z = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;	
    }

    public function validate(&$x,&$y,&$z){
        if ( ! (isset($x) && isset($y) && isset($z))) {
            return false;
        }
        // 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

        // sprawdzenie, czy parametry zostały przekazane
        if ( ! (isset($x) && isset($y) && isset($z))) {
                //sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
                $this->msgs->addError('Błędne wywołanie aplikacji. Brak jednego z parametrów.');
            return false;
        }

        // sprawdzenie, czy potrzebne wartości zostały przekazane
        if ( $x == "") {
            $this->msgs->addError('Nie podano kwoty');
        }
        if ( $y == "") {
            $this->msgs->addError('Nie podano miesięcy');
        }
        if ( $z == "") {
            $this->msgs->addError('Nie podano oprocentowania');
        }

        $x = intval($x);
        $y = intval($y);
        $z = intval($z);

        if ( $x <= 0) {
            $this->msgs->addError('Wartość kwoty musi być większa od 0');
        }
        if ( $y <= 0) {
            $this->msgs->addError('Wartość miesięcy musi być większa od 0');
        }
        if ( $z <= 0) {
            $this->msgs->addError('Wartość oprocentowania musi być większa od 0');
        }

        if (!$this->msgs->isError()) return true;

        return false;
    }
    // 3. wykonaj zadanie jeśli wszystko w porządku

    public function process(){
        $this->getParams();
        
        $this->form->x = intval($this->form->x);
        $this->form->y = intval($this->form->y);
        $this->form->z = intval($this->form->z);

        
        
        
        if ( $this->validate($this->form->x, $this->form->y, $this->form->z) ) {
            
                $this->result->result = ($this->form->x / $this->form->y) * (1 + ($this->form->z / 100));

        }
        
        $this->generateView();
    }


    public function generateView(){
        global $conf;
        
        $smarty = new Smarty();
        $smarty->assign('conf',$conf);
                
        $smarty->assign('result', $this->result);
        $smarty->assign('form',$this->form);
        $smarty->assign('messages',$this->msgs);

        $smarty->display($conf->root_path.'\app\calc_credit_view.tpl');
    }

}