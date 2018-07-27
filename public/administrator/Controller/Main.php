<?php

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;

class Main extends BaseController{
    
    public function __construct()
    {
        parent::__construct();
        
        $requestUri = trim($_SERVER['REQUEST_URI'], '/');
        if($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri == 'administrator'){
            $this->index();
        }
        
    }
    
    public function index()
    {
        $this->renderView("Pages/main","main",$this->result);
    }
    
}
