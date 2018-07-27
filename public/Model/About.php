<?php

namespace Model;
use Core\Model;
use PDO as PDO;
/**
 * Description of Tips
 *
 * @author Karen
 */
class About extends Model{

    protected $table = 'menu';
    protected  $pdoObject;
    public $result;

    public function __construct()
    {
        parent::__construct();
    }

}