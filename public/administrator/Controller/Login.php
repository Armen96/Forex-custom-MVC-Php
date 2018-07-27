<?php

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;
use Model\Adminlog;

/**
 * Description of Login
 *
 * @author Karen
 */
class Login extends BaseController{
    
    private $userIsset = false;
    private $loginResult = false;
    
    public function __construct($route = false, $countGet = NULL) 
    {
        parent::__construct();

        $requestUri = trim($_SERVER['REQUEST_URI'], '/');
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $requestUri == 'administrator'){
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $this->login($_POST['login'],$_POST['password']);
            }else{
                $this->renderNotFound('main');
                die();
            }
        }elseif($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri == 'administrator'){
            $this->noUser();
        }elseif($_SERVER['REQUEST_METHOD'] == 'GET' && $route[1] == 'logout'){
            $this->logout();
        }else{
            //$this->renderNotFound('main');
            header("Location: ".$this->baseurl."");
            die();
        }
        
    }
    
    public function noUser() 
    {
        $this->renderLoginView("Pages/login","login",$this->result);  
    }
    
    private function login($login,$pass) 
    {
        $this->model = new AdminLog();
        $this->loginResult = $this->model->login($login,$pass);
                    
        if(!empty($this->loginResult)){
            setcookie("void", $this->loginResult['token'], time()+3600, "/");
            $_SESSION['us'] = $this->loginResult['token'];
            header("Location: ".$this->baseurl."");
        }else{
            header("Location: ".$this->baseurl."");
        }
    }
    
    private function logout()
    {
        session_destroy();
        setcookie("void", NULL, time()-3600, "/");
        header('Location:./');
    }
    
}