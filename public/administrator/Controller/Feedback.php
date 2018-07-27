<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;
use Model\Feedback as Model;
/**
 * Description of Feedback
 *
 * @author Karen
 */
class Feedback extends BaseController{
    
    protected $headerUrl = "events/add/";


    public function __construct($route,$countRoute) 
    {
        parent::__construct($route,$countRoute);
        
        $this->result = array("url"=>"feedback", 'controller'=>'feedback',"table"=>"feedback");
        
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            if($this->countRoute == 1){
                $this->index();
            }elseif($this->countRoute == 2){
                $this->itemView();
            }elseif($this->countRoute == 3){
                $this->itemView($this->route[2]);
            }
        }elseif($_SERVER['REQUEST_METHOD'] == "POST"){
            if($this->countRoute == 2){
                $this->addItem();
            }elseif($this->countRoute == 3){
                $this->editItem($this->route[2]);
            }
        }else{
            echo "controller";
        }
    }
    
     private function index()
    {    
        $this->model = new Model();
        $this->result['result'] = $this->model->findAll(array('order'=>array('desc'=>'data')));
        $this->renderView("Pages/feedback","feedback",$this->result);
    }
}
