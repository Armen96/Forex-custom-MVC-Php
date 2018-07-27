<?php

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;
use Model\About as Model;
/**
 * Description of About
 *
 * @author Karen
 */
class About extends BaseController{
    protected $headerUrl = "about/8/";


    public function __construct($route,$countRoute) 
    {
        parent::__construct($route,$countRoute);
        
        $this->result = array("url"=>"about", 'controller'=>'about',"table"=>"about_us");
        
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            if($this->countRoute == 2){
                $this->itemView();
            }elseif($this->countRoute == 3 && is_numeric($this->route[2])){
                $this->itemView($this->route[2]);
            }
        }elseif($_SERVER['REQUEST_METHOD'] == "POST"){
            if($this->countRoute == 2){
                $this->editItem();
            }
        }else{
            echo "controller";
        }
    }
    
    private function itemView($id = false)
    {
        $this->model = new Model();
        $this->model->setId($id);
        $this->result['result'] = $this->model->findById();
        $this->result['result']['seo'] = $this->model->findSeo();
        $this->renderView("Pages/about","about",$this->result);
        
    }
    
    private function editItem(){
        
        $this->lastId = 1;
       
        if(array_key_exists('seo', $_POST)) {
            $this->seo = $_POST['seo'];
            unset($_POST['seo']);
            $this->modelSeo = new  \Model\Seo();
            $this->seo['tab_name'] = $this->result['table'];
            $this->seo['tab_id'] = $this->lastId;
            $this->modelSeo->_put = $this->seo;
            $bool_seo = $this->modelSeo->updateSeo();
        }
        
        $_POST['id'] = $this->lastId;
        $this->model = new Model();
        $this->model->_put = $_POST;
        $bool = $this->model->update();
        
        if($bool || $bool_seo || $bool_img){
            setcookie("not", "up", time()+20, "/");
            $this->sendHeaderId();
        }else{
            $this->sendHeaderId();
        }
    }
}