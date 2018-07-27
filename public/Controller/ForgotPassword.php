<?php


namespace Controller;
use Core\Controller as BaseController;

class ForgotPassword extends BaseController{

    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($countRoute == 1 && $route[0] == 'forgotpassword'){
                $this->index();
            }elseif($countRoute == 2 && $route[0] == 'forgotpassword' && is_numeric($route[1])){
                $this->forgotIndex($route[1]);
            }else{
                $this->renderNotFound('main');
                die();
            }
        }else{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($countRoute == 2 && $route[0] == 'forgotpassword' && is_numeric($route[1])){
                    $this->newPass($route[1]);
                }
            }
        }
    }

    public function index()
    {
        $this->renderView("Pages/forgot_password","",$this->result);
    }

    private function forgotIndex($tok)
    {
        $_oForgot=new \Model\Registration();
        $result=$_oForgot->findByName(array('fild_name'=>'mail_token','fild_val'=>$tok ));
        if (count($result)==0){
            header("Location:$this->baseurl/forgotpassword/");
        }else{
            $this->result['token']=$tok;
            $this->renderView("Pages/change_password","",$this->result);
        }
    }
    private function newPass($id){
        $_oForgot=new \Model\Registration();

        if($_POST['password']==$_POST['re_password']){
            unset($_POST['re_password']);
            $_aNewPass=array();
            $_aNewPass=$_POST;
            $_aNewPass['mail_token']="";
            $result=$_oForgot->findByName(array('fild_name'=>'mail_token','fild_val'=>$id ));
            $userId=$result[0]['id'];
            $_oForgot->setId( $userId);
            $_oForgot->_put=$_aNewPass;
            $_oForgot->update();
            header("Location:$this->baseurl/user/");
        }



    }

}
