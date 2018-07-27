<?php

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;
use Model\News as Model;
/**
 * Description of News
 *
 * @author Karen
 */
class News extends BaseController{
    
    protected $headerUrl = "/news/add/";
    private $rr;
    private $rrr;

    public function __construct($route,$countRoute) 
    {
        parent::__construct($route,$countRoute);
        
        $this->result = array("url"=>"news", 'controller'=>'events',"table"=>"news",'images_path'=>'../assets/images/event_gallery/','image_table'=>'events_img','image_table_id'=>'pid');
        
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            if($this->countRoute == 2 && is_numeric($this->route[1])){
                $this->itemView($this->route[1]);
            }
            if($this->countRoute == 2 && $this->route[1]=="add"){
                $this->iView();
            }
            if($this->countRoute == 3 && is_numeric($this->route[2])){
                $this->iView($this->route[2]);
            }
            if($this->countRoute == 3 && is_numeric($this->route[1]) && $this->route[2]="asd"){
                $this->ifram($this->route[1]);
            }
        }elseif($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->countRoute == 2) {
                $this->addItem();
            } elseif ($this->countRoute == 3) {
                $this->rr = $this->route[0];
                $this->rrr = $this->route[2];
                $this->editItem($this->route[2]);
            } elseif ($this->countRoute == 4 && is_numeric($this->route[2]) && $this->route[1] = "edit") {
                $this->rr = $this->route[0];
                $this->rrr = $this->route[2];
                $this->iframe($this->route[2]);
            } else {
                echo "controller";
            }
        }
    }

    private function ifram($id)
    {
        $_oselect=new \Model\Newsmenu();
        $this->result['result']=$_oselect->findById($id);
        $this->renderView("Pages/news_menu","news_menu",$this->result);
    }

    public function iView($id = FALSE)
    {
        if($id) {
            $this->result['update'] = $id;
            $_oselect = new Model();
            $this->result['result'] = $_oselect->findById($id);
        }
        $this->renderView("Pages/news_chenge","product",$this->result);
    }
    private function addItem()
    {
        $buttons = $_POST['button'];
        unset($_POST['button']);
        unset($_POST['real_img']);
        $_oadditem=new Model();
        $_aProduct = array();
        $_aProduct = $_POST;
        if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $uploadImg = new \ImageTools\Uploads();
            $uploadImg->setImageCurrPath("../assets/images/product/");
            $uploadImg->setFile($_FILES['image']);
            $curImage = $uploadImg->upload();
            if($curImage['error']){
                $_aProduct['img'] = $curImage['data']['img'];
            }else{
                $this->respose(array(
                    'error'=>false,
                    'text'=>$curImage['error_text']
                ));
                die();
            }
        }

        $_oadditem->_post=$_aProduct;
        $this->lastId = $_oadditem->insert();

        if(count($buttons)>0) {
            $_oButton=new Button();
            for ($i = 0; $i < count($buttons); $i++) {
                $_oButton->_post=array(
                    'proid'=>$this->lastId,
                    'text'=>$buttons[$i]
                );
                $_oButton->insert();
            }
        }

        $this->sendHeaderId();
    }
    
    private function itemView($id)
    {

        $this->model = new Model();
        //$this->model->setId($id);
        $this->result['result'] = $this->model->findAll(array());
        $this->renderView("Pages/news","news",$this->result);
    }

    private function editItem($id)
    {
        $this->lastId = $id;
        $buttons = $_POST['button'];
        unset($_POST['button']);
        $_aProduct = array();
        $_aProduct = $_POST;
        unset($_aProduct['real_img']);

        if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $uploadImg = new \ImageTools\Uploads();
            $uploadImg->setImageCurrPath("../assets/images/product/");
            $uploadImg->setFile($_FILES['image']);
            $curImage = $uploadImg->upload();
            if($curImage['error']){
                $_aProduct['img'] = $curImage['data']['img'];

            }else{
                $this->respose(array(
                    'error'=>false,
                    'text'=>$curImage['error_text']
                ));
                die();
            }
        }else{
            $_aProduct['img'] = $_POST['real_img'];
        }


        $_oadditem=new Model();
        $_oadditem->_put=$_aProduct;
        $_oadditem->setId($this->lastId);
        $_oadditem->update();
        //header("LOCATION:$this->baseurl/$this->rr/$this->rrr/");
        header("LOCATION:$this->baseurl$this->headerUrl$id/");
        /*
        if($bool || $bool_seo || $bool_img){
            setcookie("not", "up", time()+20, "/");
            $this->sendHeaderId();
        }else{
            $this->sendHeaderId();
        }
        */
    }

    private function iframe($id)
    {
        $this->lastId = $id;
        $_aProduct = array();
        $_aProduct = $_POST;
        //var_dump($_FILES['img_b']);
        //var_dump($_aProduct);die;
        //var_dump($_aProduct['real_img']);die;
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

        $_oadditem=new \Model\Newsmenu();
        $_oadditem->_put=$_aProduct;
        $_oadditem->setId($this->lastId);
        //var_dump( $_oadditem->_put);die;
        $_oadditem->update();
        header("LOCATION:$this->baseurl/news/7/asd/");
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

}