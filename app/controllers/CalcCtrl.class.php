<?php


namespace app\controllers;

//require_once $conf->root_path.'/smarty-4.5.2/libs/smarty.class.php';
//require_once $conf->root_path.'/app/Messages.class.php';
use app\forms\CalcForm;
use app\transfers\CalcResult;
//require_once $conf->root_path.'/app/forms/CalcForm.class.php';
//require_once $conf->root_path.'/app/transfers/CalcResult.class.php';

//include $conf->root_path.'/app/security/check.php';

class CalcCtrl {
    
    private $msgs;
    private $form;
    private $result;
    private $data;

    public function __construct(){
        $this->form = new CalcForm();
        $this->result = new CalcResult();
        //$this->msgs = new Messages();
        
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
           getMessages()->addError('Nie podano kwoty');
        }
        if ( $y == "") {
            getMessages()->addError('Nie podano miesięcy');
        }
        if ( $z == "") {
            getMessages()->addError('Nie podano oprocentowania');
        }

        $x = intval($x);
        $y = intval($y);
        $z = intval($z);

        if ( $x <= 0) {
            getMessages()->addError('Wartość kwoty musi być większa od 0');
        }
        if ( $y <= 0) {
            getMessages()->addError('Wartość miesięcy musi być większa od 0');
        }
        if ( $z <= 0) {
            getMessages()->addError('Wartość oprocentowania musi być większa od 0');
        }

        if (!getMessages()->isError()) return true;

        return false;
    }
    // 3. wykonaj zadanie jeśli wszystko w porządku

    public function action_calcCompute(){
        
        $this->getParams();
        
        $this->form->x = intval($this->form->x);
        $this->form->y = intval($this->form->y);
        $this->form->z = intval($this->form->z);

        
        
        
        if ( $this->validate($this->form->x, $this->form->y, $this->form->z) ) {
            
                $this->result->result = ($this->form->x / $this->form->y) * (1 + ($this->form->z / 100));

            try {

                $database = new \Medoo\Medoo([
                    'database_type' => 'mysql',
                    'database_name' => 'kalk',
                    'server' => 'localhost',
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                    'collation' => 'utf8_polish_ci',
                    'option' => [
                        \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ]
                ]);

                $database->insert("wyniki", [
                    "kwota" => $this->form->x,
                    "lat" => 10,
                    "procent" => $this->form->y,
                    "rata" => $this->result->result,
                    "data" => date("Y-m-d H:i:s")
                ]);

            } catch (Exception $ex) {
                getMessages()->addError("DB Error: ".$ex->getMessage());
            }     
        }
        
        
        $this->generateView();
        
        
    }
    
    public function action_calcShow(){
            getMessages()->addInfo('Witaj w kalkulatorze');
            $this->generateView();
    }


    public function generateView(){
        //global $conf;
        
        //$smarty = new Smarty();
        //$smarty->assign('conf',$conf);
        
        try {
            
            $database = new \Medoo\Medoo([
                'database_type' => 'mysql',
                'database_name' => 'kalk',
                'server' => 'localhost',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'collation' => 'utf8_polish_ci',
                'option' => [
                    \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                ]
            ]);
            
            $this->data = $database->select("wyniki", [
                "kwota",
                "lat",
                "procent",
                "rata",
                "data"
            ]);
            
        } catch (Exception $ex) {
            getMessages()->addError("DB Error: ".$ex->getMessage());
        }
        
        getSmarty()->assign('historyData', $this->data);
                
        getSmarty()->assign('result', $this->result);
        getSmarty()->assign('form',$this->form);
        //getSmarty()->assign('messages',getMessages()->msgs);

        getSmarty()->display(getConf()->root_path.'\app\views\calc_credit_view.tpl');
    }

}