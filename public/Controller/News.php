<?php

namespace Controller;
use Core\Controller as BaseController;
use Model\News as Newss;
/**
 * Description of News
 *
 * auther Armen
 */
class News extends BaseController{
    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            if (($countRoute==1 && $route[0]=='news') || ($countRoute==3 && $route[0]=='news' && $route[1]=='page' && is_numeric($route[2]))){
                if(isset($route[2])){
                    $this->index($route[2]);
                }else{
                    $this->index();
                }
            }elseif($route[0]=='news' && $countRoute==2 && is_numeric($route[1])){
                $this->item($route[1]);
            }else{
                $this->renderNotFound("main");
                die();
            }
        }
    }

    public function index($start = false){
        $_oproduct=new Newss();
        $limit = 10;
        if($start){
            $startNum = ($start-1)*$limit;
        }else{
            $startNum = 0;
        }
        //var_dump($startNum);
        $respons=$_oproduct->findByNameLimit($startNum,$limit);
        $this->result['result']=$respons;

        //All Count
        $_aCountNum=$_oproduct->findByNameNum();
        $this->result['m_count']=ceil($_aCountNum/$limit);


        $_oMenu=new \Model\Forexmenu();
        $resmenu=$_oMenu->findByName(array('fild_name'=>'id','fild_val'=>7));
        $this->result['menu']=$resmenu;

        $this->renderView("Pages/news",'news',$this->result);
    }
    private function item($id)
    {
        $_oproduct=new Newss();
        $res= $_oproduct->findByName(array('fild_name'=>'id','fild_val'=>$id));
        $this->result['result']=$res;
        $this->renderView("Pages/itemnews",'news',$this->result);
    }
}