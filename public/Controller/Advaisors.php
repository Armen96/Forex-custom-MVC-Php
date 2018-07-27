<?php

namespace Controller;
use Core\Controller as BaseController;
use Model\Product;
/**
 * Description of Advaisors
 *
 * auther Armen
 */
class Advaisors extends BaseController{

    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            if (($countRoute==1 && $route[0]=='advaisors') || ($countRoute==3 && $route[0]=='advaisors' && $route[1]=='page' && is_numeric($route[2]))){
                if(isset($route[2])){
                    $this->index($route[2]);
                }else{
                    $this->index();
                }
            }elseif($countRoute==2 && $route[0]=='advaisors' && is_numeric($route[1])){
                $this->itemView($route[1]);
            }else{
                $this->renderNotFound("main");
                die();
            }
        }
    }

    private function index($start = false)
    {
        $_oproduct=new Product();
        /*if(isset($_COOKIE['num'])){
            $startNum=($_COOKIE['num']-1)*2;
            $endNum=$_COOKIE['num']*2;
        }else{
            $startNum=0;
            $endNum=2;
        }*/

        $limit = 10;
        if($start){
            $startNum = ($start-1)*$limit;
        }else{
            $startNum = 0;
        }
        //var_dump($startNum);
        $respons=$_oproduct->findByNameLimit(array('fild_name'=>'cid','fild_val'=>1),$startNum,$limit);


        //All Count
        $_aCountNum=$_oproduct->findByNameNum(array('fild_name'=>'cid','fild_val'=>1));
        $this->result['m_count']=ceil($_aCountNum/$limit);

       $_oMenu=new \Model\Advaisors();
       $this->result['menu']=$_oMenu->findByName(array('fild_name'=>'id','fild_val'=>1));

	   $_oButton=new \Model\Button();
	   foreach($respons as &$val){
		   $val['button'] = $_oButton->findByName(array('fild_name'=>'proid','fild_val'=>$val['id']));
	   }

        $this->result['result']=$respons;
		$this->renderView("Pages/advaisors",'advaisors',$this->result);
    }

    private function itemView($id)
    {
        $_oproduct=new Product();
        $res= $_oproduct->findByName(array('fild_name'=>'id','fild_val'=>$id));
        $this->result['result']=$res;

        $_oButton=new \Model\Button();
        foreach($this->result['result'] as &$val){
            $val['button'] = $_oButton->findByName(array('fild_name'=>'proid','fild_val'=>$val['id']));
        }

        $this->renderView("Pages/items",'advaisors',$this->result);
    }
}