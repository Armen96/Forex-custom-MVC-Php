<?php

namespace ImageTools;
/**
 * Description of Upload
 * @author Armen
 */
class Upload {


    /**
     *
     * @param array $files
     * @param array $param
     *
     */
    private $imageType=array("image/jpeg","image/png","image/jpg");
    private $_file;
    public function uploads()
    {
        //var_dump($_FILES["img"]);die;
        if(isset($_FILES["img"])){
            if($_FILES['img']['name']!="" && $_FILES['img']['type']=='image'){
                $this->_file=$_FILES['img']['type'];
                if(in_array($this->_file,$this->imageType)){
                    $imgInfoType=explode("/",$this->_file);
                    $randName=rand(10000,99999);
                    $imgName=$randName.".".$imgInfoType[1];
                    move_uploaded_file($_FILES['img']['tmp_name'],$imgName);
                }else{
                    echo "No valid";
                }
            }else{
                echo "No valid";
            }
        }

    }




}
