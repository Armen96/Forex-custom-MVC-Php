<?php

namespace Controller;
use Core\Controller as BaseController;
/**
 * Description of News
 *
 * auther Armen
 */
class User extends BaseController{
    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            if ($route[0]=='user' && $countRoute==1){
                $this->index();
            }else{
                $this->renderNotFound("main");
                die();
            }
        }
    }

    public function index(){
        //$user=new \Model\Registration();
       // $res=$user->findByName(array('fild_name'=>'token','fild_val'=>$_COOKIE['void']));
        //$this->result['result']=$res;
        $this->renderView("Pages/user",'user',$this->result);
    }
}