<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 25.02.2017
 * Time: 18:42
 */

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;
use Model\Product as Model;
use Model\Button as Button;
class Product extends BaseController
{

    protected $headerUrl = 'product/add/';

    public function __construct($route,$countRoute)
    {
        parent::__construct($route,$countRoute);

        $this->result = array("url"=>"product", 'controller'=>'product',"table"=>"product",'images_path'=>'../assets/images/event_gallery/','image_table'=>'events_img','image_table_id'=>'pid');

        if($_SERVER['REQUEST_METHOD'] == "GET"){

            if ($this->countRoute == 1){
                $this->index();
            }elseif($this->countRoute == 2 && $this->route[1]=="banner"){
                $this->itemBanner();
            }elseif($this->countRoute == 2 ){
                $this->itemView();
            }elseif($this->countRoute == 3 && is_numeric($this->route[2])){
                $this->itemView($this->route[2]);
            }

        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if ($this->countRoute == 1){
                $this->index();
            }elseif($this->countRoute == 2 && $this->route[1] == 'add'){
                $this->addItem();
            }elseif($this->countRoute == 3 && $this->route[2] == 'add'){
                $this->addBanner();
            }elseif($this->countRoute == 3 && is_numeric($this->route[2])){
                $this->editItem($this->route[2]);
            }
        }
    }

    public function index()
    {
        $_oselect=new Model();
        $this->result['result']=$_oselect->findAll(array());
        $this->renderView("Pages/product","product",$this->result);
    }

    public function itemView($id = FALSE)
    {
        if($id) {
            $this->result['update'] = $id;
            $_oselect = new Model();
            $this->result['result'] = $_oselect->findById($id);
            $_oButton=new Button();
            $this->result['button']=$_oButton->findByName(array('fild_name'=>'proid','fild_val'=>$id));
        }
        $this->renderView("Pages/product_view","product",$this->result);
    }

    public function itemBanner()
    {
        $_oselect = new \Model\Banner();
        $this->result['result'] = $_oselect->findAll(array());
        $this->renderView("Pages/product_banner","banner",$this->result);
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

    private function addBanner()
    {
        $this->lastId = 1;
        $_oadditem=new \Model\Banner();
        $_aProduct =$_POST;
        if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $uploadImg = new \ImageTools\Uploads();
            $uploadImg->setImageCurrPath("../assets/images/product/");
            $uploadImg->setFile($_FILES['image']);
            $curImage = $uploadImg->upload();
            if($curImage['error']){
                unlink("../assets/images/product/".$_aProduct['real_img']);
                $_aProduct['image'] = $curImage['data']['img'];

            }else{
                $this->respose(array(
                    'error'=>false,
                    'text'=>$curImage['error_text']
                ));
                die();
            }
        }else{
            $_aProduct['image'] = $_POST['real_img'];
        }
        unset($_aProduct['real_img']);

        $_oadditem->_put=$_aProduct;
        $_oadditem->setId($this->lastId);
        $this->lastId = $_oadditem->update();
        header("LOCATION:$this->baseurl/product/banner/");

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


        $_oButton=new Button();
        $_oButton->delFildName='proid';
        $_oButton->delValue=$this->lastId;
        $_oButton->delete();


        if(count($buttons)>0) {
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

}