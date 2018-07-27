<?php

namespace Model;
use Core\Model;
use PDO as PDO;
/**
 * Description of AdminLog
 *
 * @author Karen
 */


class Statistic extends Model {

    protected $table = 'statistic';
    protected  $pdoObject;
    public $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function groupOrder()
    {
        $this->pdoObject = $this->db->prepare("SELECT * FROM `$this->table`  GROUP BY YEAR(`data`), MONTH(`data`)  ORDER BY `data` DESC");
        $this->pdoObject->execute();
        $this->result = $this->pdoObject->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;
    }

}
