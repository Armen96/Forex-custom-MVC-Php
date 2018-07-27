<?php
namespace Core;

use Core\ImplimentFace\Rendering as renders;
use \DateTime;
use \DatePeriod;
use Model\Business as busModel;
use Model\Users as userModel;
use Mails\Mail as send_mail;

Class Controller implements renders{

    private $validPos = array('union','nion','\"','\'','--');
    protected $baseurl;
    protected $model;
    protected $ajaxResponse = array("error"=>false);
    protected $result = array();
    protected $refererUrl = array('petlox.ec','www.petlox.ec','www.petlox.ru','petlox.ru');
    protected $lastId;
    protected $_globalGet = array();
    protected $_post = array();
    protected $_cookie = array();

    public function __construct()
    {
        $this->result['user_in'] = false;
        $this->result['buss_in'] = false;
        $this->_cookie = $_COOKIE;
        
        $this->baseurl =  "https://".$_SERVER['HTTP_HOST'];

        if(isset($_COOKIE['void'])){
            $token = $_COOKIE['void'];
            $model = new \Model\Login();
            $this->userInfo = $model->findByName(array('fild_name'=>'token','fild_val'=>$token),TRUE);
            if(!$this->userInfo || empty($this->userInfo)){
                $this->result['user_in'] = FALSE;
            }else{
                $this->result['user_in'] = TRUE;
                $this->result['user_name'] = $this->userInfo['name'];
                $this->result['user_mail'] = $this->userInfo['mail'];
            }
        }

        if(isset($_COOKIE['lezu'])){
            if($_COOKIE['lezu'] == 'ru'){
                $this->result['lezu'] = 'ru';
            }elseif($_COOKIE['lezu'] == 'eng'){
                $this->result['lezu'] = 'eng';
            }else{
                $this->result['lezu'] = 'ru';
            }
        }else{
            $this->result['lezu'] = 'ru';
        }
        // languages!
        $x = file_get_contents('lang/header.json');
        $textLang = json_decode($x);
        $langIndex = $this->result['lezu'];
        $this->result['st_lang'] = $textLang->$langIndex;
    }

    public function setGlobalGet(array $param) {
        $this->_globalGet = $param;
    }

    public function renderView($pagePath,$page,array $params)
    {
        //header("Cache-Control: public");
       // header("Expires: " . date("r", time() - 3600));
        header('Content-Type: text/html');
        $baseurl = $this->baseurl;
        include ("View/Default/header.php");
        include ("View/".$pagePath.".php");
        include ("View/Default/footer.php");
    }

    public function renderPage($pagePath,$page,array $params)
    {
        header('Content-Type: text/html');
        $baseurl = $this->baseurl;
        include ("View/".$pagePath.".php");
    }

    public function renderBusinessView($pagePath,$page,array $params)
    {
        header('Content-Type: text/html');
        $baseurl = $this->baseurl;
        include ("View/Default/header.php");
        include ("View/".$pagePath.".php");
        include ("View/Default/BusinessFooter.php");
    }

    public function renderNotFound($path,array $params = NULL)
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        include ("View/404/".$path.".php");
    }

    public function renderLoginView($pagePath,$page,array $param) {

   }

   protected function checkVar($param) {
        if (ctype_alnum($param)) {
            return TRUE;
        } else {
            return FALSE;
        }

        return FALSE;
   }

    protected function validPost(array $param)
    {
        foreach($this->validPos as $val){
            $val = addslashes($val);
            foreach($param as $postvalue){
                if(strpos($postvalue, $val)){
                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    /**
     *
     * @param type $day
     * @param type $interval
     * @return type array
     *
     * by default return 62 days
     */
    protected function dateIntervalForMount($day = false,$interval = false)
    {

        if($day){
            $now = new DateTime($day);
            $ennDay = new DateTime($day);
        }else{
            $now = new DateTime("NOW");
            $ennDay = new DateTime("NOW");
        }

        if($interval){
            $intervals = "+$interval day";
        }else{
            $intervals = '+62 day';
        }


        $ennDay->modify($intervals);
        $period = new DatePeriod($now, new \DateInterval('P1D'), $ennDay);

        $arrayOfDates = array_map(
            function($item){return $item->format('Y-m-d');},
            iterator_to_array($period)
        );
        return $arrayOfDates;
    }

    protected function cookieSet($strings) {
        $strings = str_replace(' ', '&&', $strings);
        setcookie("not", $strings, time()+20, "/");
    }
    
    protected function setCookie($name,$strings,$time=FALSE) {
        if(!$time){
            setcookie($name, $strings, time()+3600, "/");
        }else{
            $time = intval($time);
            setcookie($name, $strings, time()+$time, "/");
        }
    }

    protected function sendHeaderId()
    {
        $gourl = $this->baseurl."/".$this->headerUrl.$this->lastId."/";
        header("LOCATION: $gourl");
        die;
    }
    protected function sendHeader()
    {
        $gourl = $this->baseurl."/".$this->headerUrl;
        header("LOCATION: $gourl");
        die;
    }

    protected function sendErrorHeader()
    {
        $gourl = $this->baseurl."/".$this->headerUrl.$this->lastId."/";
        header("LOCATION: $gourl");
        die;
    }

    protected function respose(array $param)
    {
        header('Content-Type: application/json');
        echo json_encode($param);
        die();
    }

    public function headers($param)
    {
        $gourl = $this->baseurl."/".$param."/";
        header("LOCATION: $gourl");
        die;
    }
    
    protected function setCookieSentHeadr($param)
    {   
        $gourl = $this->baseurl."/".$param."/";
        header("LOCATION: $gourl");
        die;
    }

    protected function redirectMainPage($param)
    {
        $gourl = $this->baseurl."/".$param."/";
        header("LOCATION: $gourl");
        die;
    }

    protected function _group_by($array, $key)
    {
        $return = array();
        foreach ($array as $val) {
            $return[$val[$key]][] = $val;
        }
        return $return;
    }

    protected function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    protected function sentMailTime($to, $subject, $message){
        //require_once "Mails/Mail.php";
        $mails = new send_mail();
        $from    = "no-reply@petlox.ru"; // the email address
        $body    = $message;

        $host    = "smtp.timeweb.ru";
        $port    =  "25";
        $user    = "no-reply@petlox.ru";
        $pass    = "S1lmfAyW";
        $headers = array("From"=> $from, "To"=>$to, "Subject"=>$subject,"Content-Type"=>"text/html; charset=UTF-8");
        $smtp    = $mails::factory("Smtp", array("host"=>$host, "port"=>$port, "auth"=> true, "username"=>$user, "password"=>$pass));
        $mail    = @$smtp->send($to, $headers, $body);

//        if (PEAR::isError($mail)){
//            echo "error: {$mail->getMessage()}";
//        }
    }

    protected function validGlobalPost(){
      foreach ($this->_post as $key => &$value) {
        $value = addslashes($value);
      }
    }
    
    protected function getWeekDay($data) {
        $currWeek = array();
        $date = new DateTime($data);
        switch($date->format('N')){
            case 1:
                $currWeek['full'] = 'Sunday';
                $currWeek['short'] = 'Sun';
            break;
            case 2:
                $currWeek['full'] = 'Monday';
                $currWeek['short'] = 'Mon';
            break;
            case 3:
                $currWeek['full'] = 'Tuesday';
                $currWeek['short'] = 'Tue';
            break;
            case 4:
                $currWeek['full'] = 'Wednesday';
                $currWeek['short'] = 'Wed';
            break;
            case 5:
                $currWeek['full'] = 'Thursday';
                $currWeek['short'] = 'Thu';
            break;
            case 6:
                $currWeek['full'] = 'Friday';
                $currWeek['short'] = 'Fri';
            break;
            case 7:
                $currWeek['full'] = 'Saturday';
                $currWeek['short'] = 'Sat';
            break;
        }
        return $currWeek;
    }
    
    protected function getMonthName($data) {
        $currMonth = array();
        $date = new DateTime($data);
        switch($date->format('M')){
            case 'Jan':
                $currMonth['full'] = 'January';
                $currMonth['short'] = 'Jan';
            break;
            case 'Feb':
                $currMonth['full'] = 'February';
                $currMonth['short'] = 'Feb';
            break;
            case 'Mar':
                $currMonth['full'] = 'March';
                $currMonth['short'] = 'Mar';
            break;
            case 'Apr':
                $currMonth['full'] = 'April';
                $currMonth['short'] = 'Apr';
            break;
            case 'May':;
                $currMonth['full'] = 'May';
                $currMonth['short'] = 'May';
            break;
            case 'Jun':
                $currMonth['full'] = 'June';
                $currMonth['short'] = 'Jun';
            break;
            case 'Jul':
                $currMonth['full'] = 'July';
                $currMonth['short'] = 'Jul';
            break;
            case 'Aug':
                $currMonth['full'] = 'August';
                $currMonth['short'] = 'Aug';
            break;
            case 'Sep':
                $currMonth['full'] = 'September';
                $currMonth['short'] = 'Sep';
            break;
            case 'Oct':
                $currMonth['full'] = 'October';
                $currMonth['short'] = 'Oct';
            break;
            case 'Nov':
                $currMonth['full'] = 'November';
                $currMonth['short'] = 'Nov';
            break;
            case 'Dec':
                $currMonth['full'] = 'December';
                $currMonth['short'] = 'Dec';
            break;
        }
        return $currMonth;
    }
    
    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function cleanStr($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}
