<?php

namespace Controller;
use Core\Controller as BaseController;
use Model\ForexBrokers as Forex;
/**
 * Description of Forex Brokers
 *
 * auther Armen
 */
class ForexBrokers extends BaseController
{
    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            if (($countRoute==1 && $route[0]=='forexbrokers') || ($countRoute==3 && $route[0]=='forexbrokers' && $route[1]=='page' && is_numeric($route[2]))){
                if(isset($route[2])){
                    $this->index($route[2]);
                }else{
                    $this->index();
                }
            }elseif($route[0]=='forexbrokers' && $countRoute==2 && is_numeric($route[1])){
                $this->item($route[1]);
            }else{
                $this->renderNotFound("main");
                die();
            }
        }
    }

    public function index($start = false)
    {
        $_oproduct=new Forex();
       // $res= $_oproduct->findAll(array());
       // $this->result['result']=$res;

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
        $resmenu=$_oMenu->findByName(array('fild_name'=>'id','fild_val'=>3));
        $this->result['menu']=$resmenu;
        $this->renderView("Pages/forex_brokers",'forex_brokers',$this->result);
    }

    private function item($id)
    {
        $_oproduct=new Forex();
        $res= $_oproduct->findByName(array('fild_name'=>'id','fild_val'=>$id));
        $this->result['result']=$res;
        $this->renderView("Pages/itemnews",'forex_brokers',$this->result);
    }
}