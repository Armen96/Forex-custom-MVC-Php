<?php
namespace Core;

use PDO as PDO;

class Model implements ImplimentFace\QueryRequest{
    
    private $host = "127.0.0.1";
    private $dbName = "cq45962_fortiko";
    private $dbPass = "f5XBNLy8";
    private $dbUser = "cq45962_fortiko";
    protected $db;
    
    private $executeArray = array();
    
    private $keys = array();
    private $vals = array();
    
    private $colums = array();
    private $values = array();
    
    public $_post = array();
    public $_put = array();
    public $_get = array();
    public $_delete = array();

    private $id;
    
    public $delFildName = NULL;
    public $delValue = NULL;
    
    public $delResponse = array();


    public function __construct()
    {
        $this->db = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName.";charset=utf8", $this->dbUser, $this->dbPass);
        $this->db->exec("set names utf8");
    }
    
    public function setId($id) 
    {
        $this->id = $id;
    }
    /**
     *
     * @param String
     * @return type array
     *
     */
    public function findAllGroup($group)
    {
        $groupBy = NULL;
        if($group) {
            $groupBy = "GROUP BY `$group`";
        }

        if(is_null($groupBy) && !$group){
            $this->pdoObject = $this->db->prepare("SELECT * FROM $this->table");
        }else{
            $this->pdoObject = $this->db->prepare("SELECT * FROM $this->table $groupBy");
        }

        $this->pdoObject->execute();
        $this->result = $this->pdoObject->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;
    }
    
    /**
     * 
     * @param array $selected
     * @return type
     * 
     * array('order'=>array('desc || asc'=>'fild_name'),'limit'=>array('limit'=>(int)2,'start'=>(int)5))
     * 
     */
    public function findAll(array $selected)
    {

        if(array_key_exists('order', $selected)) {
            if(array_key_exists('desc', $selected['order'])) {
                $descData = $selected['order']['desc'];  
                $order = "ORDER BY `$descData` DESC";
            }
            if(array_key_exists('asc', $selected['order'])) {
                $descData = $selected['order']['asc'];
                $order = "ORDER BY $descData ASC";
            }
        }else{
            $order = NULL;
        }
        
        if(array_key_exists('limit', $selected)) {
            if(array_key_exists('limit', $selected['limit'])) {
                $limit = $selected['limit']['limit'];
                $fulllimit = "LIMIT $limit";
            }
            if(array_key_exists('start', $selected['limit'])) {
                $start = $selected['limit']['start'];
                $fulllimit = "LIMIT $limit $start";
            }
        }else{
            $fulllimit = NULL;
        }
        
        if(!is_null($order) && !is_null($fulllimit)){
            $select = $order." ".$fulllimit;        
        }elseif(!is_null($order) && is_null($fulllimit)){
            $select = $order;
        }elseif(is_null($order) && !is_null($fulllimit)) {
            $select = $fulllimit;
        }else{
            $select = NULL;
        }

        if(is_null($select)){
            $this->pdoObject = $this->db->prepare("SELECT * FROM $this->table");
        }else{
            $this->pdoObject = $this->db->prepare("SELECT * FROM $this->table $select");
        }

        
        $this->pdoObject->execute();
        $this->result = $this->pdoObject->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;
    }
    
    public function findById($id=false)
    {
        if($id){
            $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table` WHERE `id`=:id");
            $this->pdoObject->execute(array(":id"=>$id));
            $this->result = $this->pdoObject->fetch(PDO::FETCH_ASSOC);
        }else{
            $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table` WHERE `id`=:id");
            $this->pdoObject->execute(array(":id"=>$this->id));
            $this->result = $this->pdoObject->fetch(PDO::FETCH_ASSOC);
        }
        return $this->result;
    }
    /**
     * 
     * @param array $param
     * @return type
     * array('fild_name'=>'fild_name','fild_val'=>'fild_val','order'=>array('desc || asc'=>'fild_name'))
     */
    public function findByName(array $param,$multy = FALSE)
    {   
        $order = NULL;
        if(array_key_exists('order', $param)) {
            if(array_key_exists('desc', $param['order'])) {
                $descData = $param['order']['desc'];  
                $order = "ORDER BY `$descData` DESC";
            }
            if(array_key_exists('asc', $param['order'])) {
                $descData = $param['order']['asc'];
                $order = "ORDER BY `$descData` ASC";
            }
        }else{
            $order = NULL;
        }
        
        $fildName = $param['fild_name'];
        $fildval = $param['fild_val'];
        $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table` WHERE `$fildName`=:val $order");
        $this->pdoObject->execute(array(
                                ":val"=>$fildval
                                ));
        if(!$multy) {
            $this->result = $this->pdoObject->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $this->result = $this->pdoObject->fetch(PDO::FETCH_ASSOC);
        }
        
        return $this->result;
    }
    
    /**
     * 
     * @param array $param
     * @return type
     * array('fild_name'=>'fild_val')
     * multy false => fetchAll
     */
    public function findByMultyName(array $param,$multy = FALSE)
    {   
        $selectParam = '';
        $i = 0;
        foreach($param as $key=>$val){
            if($i==0){
                $selectParam .= "`$key`=:$key";
            }else{
                $selectParam .= " AND `$key`=:$key";
            }
            $this->executeArray[":$key"] = $val;
            $i++;
        }

        $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table` WHERE $selectParam");

        $this->pdoObject->execute($this->executeArray);
        if(!$multy) {
            $this->result = $this->pdoObject->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $this->result = $this->pdoObject->fetch(PDO::FETCH_ASSOC);
        }
        
        return $this->result;
    }
    
    public function findSeo()
    {
        $this->pdoObject = $this->db->prepare("SELECT * FROM `seo` WHERE `tab_id`=:tab_id && `tab_name`=:tab_name");
        $this->pdoObject->execute(array(
                                        ":tab_id"=>$this->id,
                                        ":tab_name"=>$this->table
                                        ));
        $this->result = $this->pdoObject->fetch(PDO::FETCH_ASSOC);
        return $this->result;
    }
    
    protected function notFound()
    {
        include ("View/404/main.php");
        die();
    }

    public function delete() 
    {
        $this->pdoObject = $this->db->prepare("DELETE FROM `$this->table` WHERE `$this->delFildName`=:val");
        $this->pdoObject->execute(array(
            ':val'=>$this->delValue
        ));
        
        $this->delResponse['error'] = false;  
        
        if($this->pdoObject->rowCount()>0){  
            $this->delResponse['row_count'] = $this->pdoObject->rowCount();
            $this->delResponse['error'] = True;
        }else{
            $this->delResponse['row_count'] = $this->pdoObject->rowCount();
        }
        
        return $this->delResponse;
    }
    
    public function insert() 
    {

        $this->keys= NULL;
        $this->vals = NULL;
        
        foreach($this->_post as $key=>$val){
            $this->keys["`".$key."`"] = $key;
            $this->vals[] = ":".$key."";
            $this->executeArray[$key] = $val;
        }
        
        $key = NULL;
        $val = NULL;

        $this->columns = implode(",",array_keys($this->keys));
        $this->values  = implode(",", $this->vals);
        $this->pdoObject = $this->db->prepare("INSERT INTO `$this->table` ($this->columns)VALUES ($this->values)");

        if($this->pdoObject->execute($this->executeArray)){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    public function update() 
    {
        $this->keys= NULL;
        $execute = array();
        foreach($this->_put as $key=>$val){
            $this->keys["`" . $key . "`=:$key"] = $val;
            $execute[$key] = $val;
        }
        
        if($this->id){
            $execute[':id'] = $this->id;
        }
        
        $key = NULL;
        $val = NULL;
        
        $this->columns = implode(",", array_keys($this->keys));
        $this->pdoObject = $this->db->prepare("UPDATE `$this->table` SET $this->columns WHERE `id`=:id");
        $this->pdoObject->execute($execute);

        if($this->pdoObject->rowCount()>0){  
            return true;
        }else{
            return false;
        }
    }
    
    public function updateSeo() 
    {
        
        $this->keys= NULL;
        
        foreach($this->_put as $key=>$val){
            $this->keys["`" . $key . "`=:$key"] = $val;
            $this->executeArray[$key] = $val;
        }
        
        $key = NULL;
        $val = NULL;
        
        $this->columns = implode(",", array_keys($this->keys));
        $this->pdoObject = $this->db->prepare("UPDATE `$this->table` SET $this->columns WHERE `tab_name`=:tab_name AND `tab_id`=:tab_id");
        $this->pdoObject->execute($this->executeArray);

        if($this->pdoObject->rowCount()>0){  
            return true;
        }else{
            return false;
        }
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
}