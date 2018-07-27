<?php

namespace administrator\Controller;
use administrator\Core\Controller as BaseController;
use Model\ForexBrokers as Model;
//use A_Model\Contact as contactModel;
/**
 * Description of Contact
 *
 * @author Karen
 */
class ForexBrokers extends BaseController{
    protected $headerUrl = "/forexbrokers/add/";
    private $rr;
    private $rrr;

    public function __construct($route,$countRoute)
    {
        parent::__construct($route,$countRoute);

        $this->result = array("url"=>"forexbrokers", 'controller'=>'tips', "table"=>"tips");

        if($_SERVER['REQUEST_METHOD'] == "GET"){
           if($this->countRoute == 2 && is_numeric($this->route[1])){
                $this->itemView();
            }
            if($this->countRoute == 2 && $this->route[1]=="add"){
                $this->seeView();
            }
            if($this->countRoute == 3 && is_numeric($this->route[2])){
                $this->seeView($this->route[2]);
            }
            if($this->countRoute == 3 && is_numeric($this->route[1]) && $this->route[2]="asd"){
                $this->ifram($this->route[1]);
            }
           // if($this->countRoute == 3 && is_numeric($this->route[2]) && $this->route[3]="asd"){
              //  $this->iframe($this->route[2]);
           // }

        }elseif($_SERVER['REQUEST_METHOD'] == "POST"){
            if($this->countRoute == 2 && $this->route[1] == 'add'){
                $this->addItem();
            }elseif($this->countRoute == 3){
                $this->rr=$this->route[0];
                $this->rrr=$this->route[2];
                $this->editItem($this->route[2]);
                }elseif($this->countRoute == 4 && is_numeric($this->route[2]) && $this->route[1]="edit"){
                $this->rr=$this->route[0];
                $this->rrr=$this->route[2];
                $this->iframe($this->route[2]);
            }

        }else{
            echo "controller";
        }
    }


    private function itemView()
    {
        //$this->model = new Model();
        //$this->model->setId($id);
       // $this->result['result'] = $this->model->findById();
        $_oselect=new Model();
        $this->result['result']=$_oselect->findAll(array());
        $this->renderView("Pages/forex_brokers","forex_brokers",$this->result);

    }
    private function ifram($id)
    {
        $_oselect=new \Model\Forexmenu();
        $this->result['result']=$_oselect->findById($id);
        $this->renderView("Pages/forex_menu","forex_menu",$this->result);

    }
    public function seeView($id = FALSE)
    {
        if($id) {
            $this->result['update'] = $id;
            $_oselect = new Model();
            $this->result['result'] = $_oselect->findById($id);
        }
        $this->renderView("Pages/forex_brokers_chenge","product",$this->result);
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

        $this->sendHeaderId();

    }




    private function editItem($id){

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

        $_oadditem=new \Model\Forexmenu();
        $_oadditem->_put=$_aProduct;
        $_oadditem->setId($this->lastId);
        //var_dump( $_oadditem->_put);die;
        $_oadditem->update();
        header("LOCATION:$this->baseurl/forexbrokers/3/asd/");
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

