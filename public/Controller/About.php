<?php

namespace Controller;
use Core\Controller as BaseController;
/**
 * Description of About
 *
 * auther Armen
 */
class About extends BaseController{
    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            if ($countRoute == 1 && $route[0] == 'about'){
                $this->index();
            }else{
                $this->renderNotFound("main");
                die();
            }
        }
    }

    public function index(){
        $this->renderView("Pages/about",'about',$this->result);
    }
}