<?php


namespace Controller;
use Core\Controller as BaseController;
//use Mails\Mail;
//use PEAR;
use MailsTool\Mail;
class Main extends BaseController{
    
    public function __construct() 
    {
        parent::__construct();
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $this->index();
        }else{
            $this->renderNotFound('main');
            die();
        }
    }
    
    public function index(){
        
        $mail = new Mail();
        //$mail->sendMail();
        
//        $mail = new Mail();
//        $from    = "no-reply@petlox.ru"; // the email address
//        $body    = 'hi';
//
//        $host    = "smtp.timeweb.ru";
//        $port    =  "25";
//        $user    = "no-reply@petlox.ru";
//        $pass    = "S1lmfAyW";
//        $headers = array("From"=> $from, "To"=>'karenkostanyan89@gmail.com', "Subject"=>'my local',"Content-Type"=>"text/html; charset=UTF-8");
//        $smtp    = $mail->factory("Smtp", array("host"=>$host, "port"=>$port, "auth"=> true, "username"=>$user, "password"=>$pass));
//       
//        $mailss    = $smtp->send('karenkostanyan89@gmail.com', $headers, $body);

        $this->renderView("Pages/about","about",$this->result);
    }
    
}
