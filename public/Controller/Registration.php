<?php


namespace Controller;
use Core\Controller as BaseController;
use Model\Users;

class Registration extends BaseController{

    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($countRoute == 1 && $route[0] == 'registration'){
                $this->index();
            }elseif($countRoute == 3 && $route[0] == 'registration' && $route[2]=='english'){
                setcookie('lang','eng',time()+1000,'/');
                header("Location:$this->baseurl/");
            }elseif($countRoute == 3 && $route[0] == 'registration' && $route[2]=='russian'){
                setcookie('lang','ru',time()+1000,'/');
                header("Location:$this->baseurl/");
            }else{
                $this->renderNotFound('main');
                die();
            }
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($countRoute == 2 && $route[0] == 'registration' && $route[1] == 'aa'){
                $this->registr();
            }else if($countRoute == 2 && $route[0] == 'registration' && $route[1] == 'ajax'){
                $this->mailstug();
            }else if($countRoute==3 && $route[1]=='login' && $route[2] == 7){
                $this->login();
            }else if($countRoute==3 && $route[1]=='logout' && $route[2] == 7){
                $this->logout();
            }elseif($countRoute == 3 && $route[0] == 'registration' &&  $route[1]=='facebook' && $route[2]=='v1'){
                $this->checkFbId();
            }elseif($countRoute == 3 && $route[0] == 'registration' &&  $route[1]=='forgotpass' && $route[2]=='107'){
                $this->mailToken();
            }
        }
    }

    public function index()
    {

       $this->renderView("Pages/registration","",$this->result);
    }
    public function registr()
    {
        if ($_POST['password']==$_POST['repassword'] && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && isset($_POST['g-recaptcha-response'])){

            /*$recaptcha = $_POST['g-recaptcha-response'];
            if(!empty($recaptcha)){
                $google_url="https://www.google.com/recaptcha/api/siteverify";
                $secret='6LeubBcUAAAAAOCjeLxd_GUvP4FUWgW0PntPitGy';
                $ip=$_SERVER['REMOTE_ADDR'];
                $url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
                $response = $this->getCurlData($url);
                $response= json_decode($response, true);
                if($response['success'])
                {
                    header("Location:$this->baseurl/registration/");die();
                }
            }else{
                header("Location:$this->baseurl/registration/");die();
            }*/

            $rand=rand(10000,50000);
            $tok=sha1($rand.$_POST['mail']);
            $_oRegistr=new \Model\Registration();
            $_oRegistr->_post=array(
                'name'=>$_POST['name'],
                'mail'=>$_POST['mail'],
                'phone'=>$_POST['phone'],
                'password'=>$_POST['password'],
                'fb_id'=>$_POST['fb_id'],
                'token'=>$tok
            );

            $_oRegistr->insert();
            $result =$_oRegistr->findByName(array('fild_name'=>'token','fild_val'=>$tok));
            //var_dump($result);die;
            setcookie('void', $result[0]['token'], time() + 86400, '/');
            header("LOCATION:$this->baseurl/user/");
        }else{
            setcookie('reg_error','No - Valid,Try Again',time()+60,'/');
            header("LOCATION:$this->baseurl/registration/");
        }
    }

    private function mailToken()
    {
        if(filter_var($_POST['mail_token'] ,FILTER_VALIDATE_EMAIL)){
            $_aMail=$_POST;
            $_oMail=new \Model\Registration();
            $result=$_oMail->findByName(array('fild_name'=>'mail','fild_val'=> $_aMail['mail_token']));
                if(count($result) == 0){
                    $this->respose(array(
                        'error'=>false,
                        'text'=>'Undefined'
                    ));
                }else{
                    $id=$result[0]['id'];
                    $_aMail['mail_token']=rand(10000,99999);
                    $_oMail->_put=$_aMail;
                    $_oMail->setId($id);
                    $_oMail->update();

                    $this->respose(array(
                        'error'=>true
                    ));
                }
            }else{
                $this->respose(array(
                    'error'=>false,
                    'text'=>'Access denied'
                 ));
            }
    }


    public function login()
    {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $_aLogin = $_POST;
            $_oLogin = new \Model\Login();
            $result = $_oLogin->findByMultyName(array('password' => $_aLogin['password'], 'mail' => $_aLogin['mail']),TRUE);
            if (empty($result) && $result==NULL) {
                setcookie('reg_error', 'novalid', time() + 10, '/');
                header("LOCATION:$this->baseurl/");
            }else {
                setcookie('void', $result['token'], time() + 86400, '/');
                header("LOCATION:$this->baseurl/user/");
            }
        }else{
            setcookie('reg_error', 'novalid', time() + 10, '/');
            header("LOCATION:$this->baseurl/");
        }
    }
    public function logout(){
        setcookie('void', Null, time() - 86400, '/');
        header("LOCATION:$this->baseurl/");
    }


    public function mailstug()
    {
        if (filter_var($_POST['text'], FILTER_VALIDATE_EMAIL)){
            $_oRegistr=new \Model\Registration();
            $result = $_oRegistr->findByName(array('fild_name'=>'mail','fild_val'=>$_POST['text']));

            //var_dump($result);die();

            if(count($result) == 0){
                $this->respose(array("error"=>true));
            }else{
                $this->respose(array("error"=>false));
            }
        }else{
            $this->respose(array("error"=>false));
        }
    }

    private function getCurlData($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;
    }
/*
 *
 * registration fb
 *
 */

    private function checkFbId()
    {
        $userModel = new \Model\Registration();
        if(is_numeric($_POST['fb'])){
            $id = $_POST['fb'];
        }else{
            $this->respose(array(
                'error'=>false
            ));
            die;
        }

        $checkId = $userModel->findByName(array('fild_name'=>'fb_id','fild_val'=>$id),TRUE);

        if(!empty($checkId)){
            setcookie("void", $checkId['token'], time()+86400, "/");
            $this->respose(array(
                'error'=>true,
                'text'=>$this->baseurl.'/user/'
            ));
        }else{
            $this->respose(array(
                'error'=>false
            ));
        }
        die;
    }

}

