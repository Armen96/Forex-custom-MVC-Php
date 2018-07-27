<?php

namespace Model;
use Core\Model;
use PDO as PDO;
/**
 * Description of Tips
 *
 * @author Karen
 */
class ForexBrokers extends Model{

    protected $table = 'forex_br';
    protected  $pdoObject;
    public $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function findByNameLimit($limit,$start,$multy = FALSE)
    {
        $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table` LIMIT $limit,$start");
        $this->pdoObject->execute();
        $this->result = $this->pdoObject->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;

    }

    public function findByNameNum()
    {
        $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table`");
        $this->pdoObject->execute();
        $this->result = $this->pdoObject->rowCount();
        return $this->result;

    }

}