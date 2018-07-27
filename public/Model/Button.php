<?php

namespace Model;
use Core\Model;
use PDO as PDO;
/**
 * Description of AdminLog
 *
 * @author Karen
 */
class Button extends Model{

    protected $table = 'button';
    protected  $pdoObject;
    public $result;

    public function __construct()
    {
        parent::__construct();
    }

}