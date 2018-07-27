<?php

namespace Core\ImplimentFace;
use Core\Model as Model;
/**
 * Description of QueryRequest
 *
 * @author Karen
 */
interface QueryRequest {
    
    public function insert();
    
    public function update();
    
    public function delete(); 
    
  //  public function gets(Model $param);
}


