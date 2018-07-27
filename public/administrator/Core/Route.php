<?php

namespace administrator\Core;

Class Route {

    private $route;
    private $validPos = array('union','nion','\"','\'','--');
    private $_page;
    private $user = false;

    public function __construct() 
    {    
       if(isset($_GET['route']) && count($_GET['route'])>0) {
            $this->route = trim($_GET['route'], '/\\');
       }
       $this->validPos();
    }

    public function start()
    {
        if (!isset($_COOKIE['void']) || !isset($_SESSION['us'])) {
            new \administrator\Controller\Login;
        } else {
            if (is_null($this->route)) {  
                new \administrator\Controller\Main();
            } else {
                $route = explode('/', $this->route);
                $countGet = count($route);
                $controllerName = $route[0];
                $this->_page = ucfirst($controllerName);
                $includeController = "administrator\Controller\\" . $this->_page;
                new $includeController($route, (int) $countGet);
                
            }
        }
    }

    private function validPos()
    {
        if(!is_null($this->route)){
            $this->route = addslashes($this->route);
            foreach($this->validPos as $val){
                if(strpos($this->route, $val)){
                    Controller::renderNotFound('main');
                    die();
                }
            }
        }
        self::start();
    }

}