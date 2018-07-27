<?php

namespace Model;
use Core\Model;
use PDO as PDO;
/**
 * Description of AdminLog
 *
 * @author Karen
 */
class Banner extends Model{

    protected $table = 'banner';
    protected  $pdoObject;
    public $result;

    public function __construct()
    {
        parent::__construct();
    }

}