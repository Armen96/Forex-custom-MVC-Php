<?php

namespace Model;
use Core\Model;
use PDO as PDO;
/**
 * Description of AdminLog
 *
 * @author Karen
 */
class Adminlog extends Model{

    protected $table = 'adminlog';
    protected  $pdoObject;
    public $result;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function login($login, $pass)
    {
        $this->pdoObject = $this->db->prepare("SELECT `token` FROM `adminlog` WHERE `log`=:log AND `pass`=:pass");
        $this->pdoObject->execute(array(
            ':log' => $login,
            ':pass' => sha1($pass),
            ));
        $this->result = $this->pdoObject->fetch();
        if(!empty($this->result['token'])){
            return $this->result;
        }else{
            return false;
        }
    }
}