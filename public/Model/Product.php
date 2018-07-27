<?php

namespace Model;
use Core\Model;
use PDO as PDO;
/**
 * Description of AdminLog
 *
 * @author Karen
 */
class Product extends Model{

    protected $table = 'product';
    protected  $pdoObject;
    public $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function findByNameLimit(array $param,$limit,$start,$multy = FALSE)
    {
        $fildName = $param['fild_name'];
        $fildval = $param['fild_val'];

        $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table`  WHERE `$fildName`=:val LIMIT $limit,$start");
        $this->pdoObject->execute(array(
            ":val"=>$fildval
        ));
        $this->result = $this->pdoObject->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;

    }

    public function findByNameNum(array $param)
    {
        $fildName = $param['fild_name'];
        $fildval = $param['fild_val'];

        $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table`  WHERE `$fildName`=:val");
        $this->pdoObject->execute(array(
            ":val"=>$fildval
        ));
        $this->result = $this->pdoObject->rowCount();
        return $this->result;

    }


}