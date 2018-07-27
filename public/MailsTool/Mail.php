<?php

namespace MailsTool;
use Mails\Mail as mainMail;

/**
 * Description of Mail
 *
 * @author Karen
 */
class Mail extends mainMail{
    
    private $host = "smtp.timeweb.ru";
    private $port =  "25";
    
    public $user = "no-reply@petlox.ru";
    public $pass = "S1lmfAyW";
    
    public $subject = "Petlox";
    public $to = 'karenkostanyan89@gmail.com';
    public $body = "sdasdasd";

    public function sendMail() {
        $headers = array("From"=> $this->user, "To"=>$this->to, "Subject"=>$this->subject,"Content-Type"=>"text/html; charset=UTF-8");
        $smtp = $this->factory("Smtp", array("host"=>$this->host, "port"=>$this->port, "auth"=> true, "username"=>$this->user, "password"=>$this->pass));
        $smtp->send('karenkostanyan89@gmail.com', $headers, $this->body);
    }
    
}
