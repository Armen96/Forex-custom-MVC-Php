<?php
/*
 * auter Armen
 */

namespace Model;
use Core\Model;
use PDO;
class Login extends Model
{
    protected $table='registrations';

    public function __construct(){
        parent::__construct();
    }

}