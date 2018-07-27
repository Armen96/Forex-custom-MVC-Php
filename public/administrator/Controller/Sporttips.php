<?php

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;
use Model\SportTips as Model;
//use A_Model\Contact as contactModel;
/**
 * Description of Contact
 *
 * @author Karen
 */
class SportTips extends BaseController{
    protected $headerUrl = "sporttips/add/";
    private $rr;
    private $rrr;

    public function __construct($route,$countRoute)
    {
        parent::__construct($route,$countRoute);

        $this->result = array("url"=>"sporttips", 'controller'=>'tips', "table"=>"tips");

        if($_SERVER['REQUEST_METHOD'] == "GET"){
            if($this->countRoute == 2 && is_numeric($this->route[1])){
                $this->itemView($this->route[1]);
            }elseif ($this->countRoute == 4 && $this->route[1]="statistic"){
                $this->statics();
            }elseif($this->countRoute == 3 && $this->route[2] == 'add'){
                $this->addBanner();
            }elseif($this->countRoute == 3 && is_numeric($this->route[2])){
                $this->itemViewa($this->route[2]);
            }
        }elseif($_SERVER['REQUEST_METHOD'] == "POST"){
            if($this->countRoute == 2){
                $this->addItem();
            }elseif($this->countRoute == 4 && $this->route[1] == 'add'){
                $this->addStatistics();
            }elseif($this->countRoute == 5 && $this->route[1] == 'add' ){
                $this->updateStatistics($this->route[4]);
            }elseif($this->countRoute == 3){
                $this->rr=$this->route[0];
                $this->rrr=$this->route[2];
                $this->editItem($this->route[2]);
            }
        }else{
            echo "controller";
        }
    }

    private function itemView($id)
    {
            $this->model = new Model();
            $this->model->setId($id);
            $this->result['result'] = $this->model->findById();
            $this->renderView("Pages/sporttips","tips",$this->result);
    }

    private function editItem($id)
    {
        $this->lastId = $id;
        $_aProduct = array();
        $_aProduct = $_POST;

        if(empty($_aProduct['s_b'])){
            $_aProduct['s_b']=0;
        }

        if(isset($_FILES['img_b']) && $_FILES['img_b']['name'] != '') {
            $uploadImg = new \ImageTools\Uploads();
            $uploadImg->setImageCurrPath("../assets/images/product/");
            $uploadImg->setFile($_FILES['img_b']);
            $curImage = $uploadImg->upload();
            if($curImage['error']){
                unlink("../assets/images/product/".$_aProduct['real_img']);
                $_aProduct['img_b'] = $curImage['data']['img'];

            }else{
                $this->respose(array(
                    'error'=>false,
                    'text'=>$curImage['error_text']
                ));
                die();
            }
        }else{
            $_aProduct['img_b'] = $_POST['real_img'];
        }
        unset($_aProduct['real_img']);

        $_oadditem=new Model();
        $_oadditem->_put=$_aProduct;
        $_oadditem->setId($this->lastId);
        $_oadditem->update();
        header("LOCATION:$this->baseurl/$this->rr/$this->rrr/");
        // header("LOCATION:$this->baseurl$this->headerUrl$id/");
        /*
        if($bool || $bool_seo || $bool_img){
            setcookie("not", "up", time()+20, "/");
            $this->sendHeaderId();
        }else{
            $this->sendHeaderId();
        }
        */
    }

    private function statics(){

        $_oselect=new \Model\Statistic();
          $this->result['result']=$_oselect->findAll(array());
        $this->renderView("Pages/statistics","statistics",$this->result);
    }

    private function addBanner()
    {/*
        $_oadditem=new \Model\Statistic();
        $_aProduct =$_POST;
        $_oadditem->_put=$_aProduct;
        $_oadditem->setId($this->lastId);
        $this->lastId = $_oadditem->update();
        header("LOCATION:$this->baseurl/sporttips/statistic/4/8/");*/
        $this->renderView("Pages/statics_view","statics_view",$this->result);

    }

    private function addStatistics()
    {
        $_oadditem=new \Model\Statistic();
        $_aProduct = array();
        $_aProduct = $_POST;
        $_oadditem->_post=$_aProduct;

        $this->lastId = $_oadditem->insert();
        $this->sendHeaderId();
        header("Location:$this->baseurl/sporttips/statistic/4/8/");
    }

    public function itemViewa($id = FALSE)
    {
        if($id) {
            $this->result['update'] = $id;
            $_oselect = new \Model\Statistic();
            $this->result['result'] = $_oselect->findById($id);
        }
        $this->renderView("Pages/statics_view","statics_view",$this->result);
    }
    private function updateStatistics($id)
    {

        $this->lastId = $id;
        $_aProduct = array();
        $_aProduct = $_POST;

        $_oadditem=new \Model\Statistic();
        $_oadditem->_put=$_aProduct;
        $_oadditem->setId($this->lastId);
        $_oadditem->update();
        $this->sendHeaderId();

        $this->renderView("Pages/statics_view","statics_view",$this->result);
    }


}