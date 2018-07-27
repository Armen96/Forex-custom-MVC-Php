<?php

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;
use Model\Service as Model;

/**
 * Description of Serives
 *
 * @author Karen
 */
class Services extends BaseController{
    
    protected $headerUrl = "services/add/";


    public function __construct($route,$countRoute) 
    {
        parent::__construct($route,$countRoute);
        
        $this->result = array("url"=>"services", 'controller'=>'services',"table"=>"serives");
        
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
        $this->model = new Model;
        $this->result['result'] = $this->model->getService();
        $this->renderView("Pages/services","services",$this->result);
    }
    
    private function itemView($id = FALSE)
    {
        if($id){
            $this->model = new Model();
            $this->model->setId($id);
            $this->result['result'] = $this->model->findById();
            $categories = new \Model\Categories();
            $this->result['categoris'] = $categories->findAll(array('order'=>array('asc'=>'id')));
            $this->renderView("Pages/services_chenge","services",$this->result);
        }else{
            $categories = new \Model\Categories();
            $this->result['categoris'] = $categories->findAll(array('order'=>array('asc'=>'id')));
            $this->renderView("Pages/services_chenge","services",$this->result);
        }
        
    }
    
    private function addItem()
    {   
        $this->model = new Model();
        $this->model->_post = $_POST;
        $this->lastId = $this->model->insert();

        if($this->lastId){
            setcookie("not", "save", time()+20, "/");
            $this->sendHeaderId();
        }else{
            $this->sendHeader();
        }
    }
    
    private function editItem($id){
        
        $this->lastId = $id;
        
        $_POST['id'] = $this->lastId;
        $this->model = new Model();
        $this->model->_put = $_POST;
        $bool = $this->model->update();
        
        if($bool){
            setcookie("not", "up", time()+20, "/");
            $this->sendHeaderId();
        }else{
            $this->sendHeaderId();
        }
    }
}
