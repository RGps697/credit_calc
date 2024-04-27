<?php

require_once dirname(__FILE__).'/core/Config.class.php';

$conf = new core\Config();
include dirname(__FILE__).'/config.php';

function &getConf(){ global $conf; return $conf; }

require_once getConf()->root_path.'/core/Messages.class.php';
$msgs = new core\Messages();

function &getMessages(){ global $msgs; return $msgs; }

$smarty = null;

function &getSmarty(){
    global $smarty;
    if(!isset($smarty)){
        include_once getConf()->root_path.'/smarty-4.5.2/libs/Smarty.class.php';
        $smarty = new Smarty();
        
        $smarty->assign('conf',getConf());
        $smarty->assign('msgs',getMessages());
        
        $smarty->setTemplateDir(array(
            'one' => getConf()->root_path.'/app/views',
            'two' => getConf()->root_path.'/app/views/templates'
        ));
    }
    return $smarty;
}

require_once 'core/classLoader.class.php';
$cloader = new core\classLoader();
function &getLoader(){
    global $cloader;
    return $cloader;
}

require_once getConf()->root_path.'/core/functions.php';
$action = getFromRequest('action');