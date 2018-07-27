<?php

namespace Controller;
use Core\Controller as BaseController;
use Model\Product;
/**
 * Description of Dayly Signals
 *
 * auther Armen
 */
class DaylySignals extends BaseController
{
    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if ($_SERVER['REQUEST_METHOD']=="GET"){
           // if ($route[0]=='daylysignals' && $countRoute==1){
               // $this->index();
            if (($countRoute==1 && $route[0]=='daylysignals') || ($countRoute==3 && $route[0]=='daylysignals' && $route[1]=='page' && is_numeric($route[2]))){
                if(isset($route[2])){
                    $this->index($route[2]);
                }else{
                    $this->index();
                }

            }elseif($route[0]=='daylysignals' && is_numeric($route[1])){
                $this->itemView($route[1]);
            }else{
                $this->renderNotFound("main");
                die();
            }
        }
    }

    private function index($start = false){
        $_oproduct=new Product();
     //   $this->result['result']= $_oproduct->findByName(array('fild_name'=>'cid','fild_val'=>4));
        $limit = 10;
        if($start){
            $startNum = ($start-1)*$limit;
        }else{
            $startNum = 0;
        }
        //var_dump($startNum);
        $respons=$_oproduct->findByNameLimit(array('fild_name'=>'cid','fild_val'=>4),$startNum,$limit);
        $this->result['result']=$respons;
        //All Count
        $_aCountNum=$_oproduct->findByNameNum(array('fild_name'=>'cid','fild_val'=>4));
        $this->result['m_count']=ceil($_aCountNum/$limit);


        $_oMenu=new \Model\Indicators();
        $resmenu=$_oMenu->findByName(array('fild_name'=>'id','fild_val'=>4));
        $this->result['menu']=$resmenu;
		
		$_oButton=new \Model\Button();
	   foreach($this->result['result'] as &$val){
		   $val['button'] = $_oButton->findByName(array('fild_name'=>'proid','fild_val'=>$val['id']));
	   }
		
        $this->renderView("Pages/dayly_signals",'dayly_signals',$this->result);
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

        $this->renderView("Pages/items",'dayly_signals',$this->result);
    }

}