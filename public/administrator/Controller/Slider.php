<?php

namespace administrator\Controller;

use administrator\Core\Controller as BaseController;
use Model\Slider as Model;
/**
 * Description of Slider
 *
 * @author Karen
 */
class Slider extends BaseController {

    protected $headerUrl = "slider/add/";

    public function __construct($route, $countRoute)
    {
        parent::__construct($route, $countRoute);

        $this->result = array("url" => "slider", 'controller' => 'slider', "table" => "main_slide","images_path"=>"../assets/images/slide/");

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($this->countRoute == 1) {
                $this->index();
            } elseif ($this->countRoute == 2) {
                $this->itemView();
            } elseif ($this->countRoute == 3) {
                $this->itemView($this->route[2]);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->countRoute == 2) {
                $this->addItem();
            } elseif ($this->countRoute == 3) {
                $this->editItem($this->route[2]);
            }
        } else {
            echo "controller";
        }
    }

    private function index() 
    {
        $this->model = new Model();
        $this->result['result'] = $this->model->findAll(array('order' => array('desc' => 'id')));
        $this->renderView("Pages/slider", "slider", $this->result);
    }

    private function itemView($id = FALSE)
    {
        if ($id) {
            $this->model = new Model();
            $this->model->setId($id);
            $this->result['result'] = $this->model->findById();
            $this->result['result']['seo'] = $this->model->findSeo();
            $this->renderView("Pages/slider_chenge", "slider", $this->result);
        } else {
            $this->renderView("Pages/slider_chenge", "slider", $this->result);
        }
    }

    private function addItem() 
    {
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            if ($_FILES['image']['error'] != 0) {
                setcookie("error", "Error Image format", time()+20, "/");
                $this->sendErrorHeader();
                die();
            }
        
            $this->objImage = new \ImageTools\Uploads();
            $this->objImage->setFile($_FILES['image']);
            $this->objImage->setImageCurrPath($this->result['images_path']);
            $this->uploadData = $this->objImage->upload();

            if ($this->uploadData['error']) {
                $_POST['img'] = $this->uploadData['data']['img'];
            }
        }
        
        $this->model = new Model();
        $this->model->_post = $_POST;
        $this->lastId = $this->model->insert();

        if ($this->lastId) {
            setcookie("not", "save", time() + 20, "/");
            $this->sendHeaderId();
        } else {
            $this->sendHeader();
        }
    }
    
    private function editItem($id){
        
        $this->lastId = $id;
        $upimg = $_POST['upimg'];
        unset($_POST['upimg']);
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            if ($_FILES['image']['error'] != 0) {
                setcookie("error", "Error Image format", time()+20, "/");
                $this->sendErrorHeader();
                die();
            }
        
            $this->objImage = new \ImageTools\Uploads();
            $this->objImage->setFile($_FILES['image']);
            $this->objImage->setImageCurrPath($this->result['images_path']);
            $this->uploadData = $this->objImage->upload();

            if ($this->uploadData['error']) {
                $_POST['img'] = $this->uploadData['data']['img'];
            }
            
            $filename = $this->result['images_path'].$upimg;
            unlink($filename);
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
