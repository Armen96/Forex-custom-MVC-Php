<?php
namespace administrator\Core;

use Core\ImplimentFace\Rendering as renders;

Class Controller implements renders{
    
    protected $route = array();
    protected $countRoute = 0;


    protected $baseurl;
    protected $baseurlM;
    
    protected $model = NULL;
    protected $modelSeo = NULL;
    
    protected $lastId = NULL;
    protected $result = array();
    protected $page;
    
    protected $seo = array();
    
    protected $multyUploadData = NULL;
    protected $uploadData = NULL;


    public function __construct(&$route=NULL,&$countRoute=NULL) {
        $this->route = $route;
        $this->countRoute = $countRoute;
        $route = NULL;
        $countRoute = NULL;
        $this->baseurl =  "https://".$_SERVER['HTTP_HOST']."/administrator";
        $this->baseurlM =  "https://".$_SERVER['HTTP_HOST'];
    }
    
    public function renderView($pagePath,$page,array $params){
        
        header('Content-Type: text/html');
        $baseurl = $this->baseurl;
        $baseurlM = $this->baseurlM;
        include ("A_View/Default/header.php");
        include ("A_View/Default/menu.php");
        include ("A_View/".$pagePath.".php");
        include ("A_View/Default/footer.php");
    }
    
    public function renderNotFound($path,array $params = NULL)
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        include ("A_View/404/".$path.".php");
    }
    
     public function renderLoginView($pagePath,$page,array $params)
    {
        header('Content-Type: text/html');
        $baseurl = $this->baseurl;
        $baseurlM = $this->baseurlM;
        include ("A_View/".$pagePath.".php");
    }
    
    protected function sendHeaderId()
    {
        $gourl = $this->baseurl."/".$this->headerUrl.$this->lastId."/";
        header("LOCATION: $gourl");
    }
    protected function sendHeader()
    {
         $gourl = $this->baseurl."/".$this->headerUrl;
        header("LOCATION: $gourl");
    }
    
    protected function sendErrorHeader()
    {
        $gourl = $this->baseurl."/".$this->headerUrl.$this->lastId."/";
        header("LOCATION: $gourl");
    }
}