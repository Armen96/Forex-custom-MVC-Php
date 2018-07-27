<?php

namespace ImageTools;
/**
 * Description of Uploads
 *
 * @author Karen
 */
class Uploads {
    
    private $response = array();
    private $availableType = array("image/jpg","image/jpeg","image/png");
    private $types = array();
    private $imageType;
    private $imageCurrPath;
    private $imageName;
    private $dirUpload;
    private $imagesNameBlock = array();
    private $_file;
    private $responseImage;
    
    /**
     * 
     * @param array $files
     * @param array $param
     * 
     */
    public function multyUpload() 
    {
        
        // ready for upload image
        for($i=0;$i<count($this->_file['name']);$i++){
            if(in_array($this->_file['type'][$i], $this->availableType)){
                $this->types = explode("/",$this->_file['type'][$i]);
                $this->imageType = $this->types[1];
                $this->imageName = $this->randomImageName(8);
                $this->dirUpload = $this->imageCurrPath.$this->imageName.".".$this->imageType;
                $this->imagesNameBlock[$this->_file['tmp_name'][$i]] = $this->dirUpload;
                $this->responseImage[$this->_file['tmp_name'][$i]] = $this->imageName.".".$this->imageType;
            }else{
                $this->response['error'] = false;
                $wrongtype = $this->_file['type'][$i];
                $this->response['error_text'] = "wrong image type: $wrongtype not supported";
                return $this->response;
                die();
            }
        }
        
        // if enyting is ok -> go to uploads images
        if(count($this->response == 0)){
            $this->uploadsImg();
            $this->response['error'] = true;
            $this->response['data'] = $this->responseImage;
            return $this->response;
        }else{
            $this->response['error'] = false;
            $this->response['error_text'] = "Somting wrong with image name block";
            return $this->response;
            die();
        }
    }
    
    public function upload() 
    {
        if(in_array($this->_file['type'], $this->availableType)){
            $this->types = explode("/",$this->_file['type']);
            $this->imageType = $this->types[1];
            $this->imageName = $this->randomImageName(8);
            $this->dirUpload = $this->imageCurrPath.$this->imageName.".".$this->imageType;
            $this->imagesNameBlock[$this->_file['tmp_name']] = $this->dirUpload;
            $this->responseImage['img'] = $this->imageName.".".$this->imageType;
        }else{
            $this->response['error'] = false;
            $wrongtype = $this->_file['type'];
            $this->response['error_text'] = "wrong image type: $wrongtype not supported";
            return $this->response;
            die();
        }
        
        // if enyting is ok -> go to uploads images
        if(count($this->response == 0)){
            $this->uploadsImg();
            $this->response['error'] = true;
            $this->response['data'] = $this->responseImage;
            return $this->response;
        }else{
            $this->response['error'] = false;
            $this->response['error_text'] = "Somting wrong with image name block";
            return $this->response;
            die();
        }
    }
    
    /**
     * 
     * @param int $length
     * @return string $key
     * 
     * return uni image name
     */
    private function randomImageName($length) 
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        
        $mainPath = $this->imageCurrPath.$key.".".$this->imageType;
        if(!is_dir($mainPath)){
            return $key;
        }else{
            $this->randomImageName(10);
        }
    }
    
    /**
     * upload all images
     */
    private function uploadsImg() {
        foreach($this->imagesNameBlock as $key=>$val){
            move_uploaded_file($key, $val);
        }
    }
    
    public function setFile(array $param) 
    {
        $this->_file = $param;
    }
    
    public function setImageCurrPath($param) 
    {
        $this->imageCurrPath = $param;
    }
}
