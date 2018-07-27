<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace administrator\Controller;

use administrator\Core\Controller as BaseController;
use Model\Indicators as Model;

/**
 * Description of Partners
 *
 * @author Karen
 */
class Indicators extends BaseController {

    private $rr;
    private $rrr;

    protected $headerUrl = "indicators/add/";

    public function __construct($route, $countRoute)
    {
        parent::__construct($route, $countRoute);

        $this->result = array("url" => "indicators", 'controller' => 'partners', "table" => "partners","images_path"=>"../assets/images/partner/");

        if($_SERVER['REQUEST_METHOD'] == "GET"){
            if($this->countRoute == 2 && is_numeric($this->route[1])){

                $this->itemView($this->route[1]);
            }

        }elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->countRoute == 2) {
                $this->addItem();
            } elseif ($this->countRoute == 3) {
                $this->rr=$this->route[0];
                $this->rrr=$this->route[2];
                $this->editItem($this->route[2]);
            }
        } else {
            echo "controller";
        }
    }


    private function itemView($id)
    {
            $this->model = new Model();
            $this->model->setId($id);
            $this->result['result'] = $this->model->findById();
            $this->renderView("Pages/indicators_chenge", "partners", $this->result);
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

}
