<?php

namespace Controller;
use Core\Controller as BaseController;
/**
 * Description of Contacts
 *
 * auther Armen
 */
class Contacts extends BaseController{
    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            if ($route[0]=='contacts' && $countRoute==1){
                $this->index();
            }else{
                $this->renderNotFound("main");
                die();
            }
        }
    }

    public function index(){
        $this->renderView("Pages/contacts",'contacts',$this->result);
    }
}