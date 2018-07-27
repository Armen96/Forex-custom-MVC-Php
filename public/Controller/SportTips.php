<?php

namespace Controller;
use Core\Controller as BaseController;
use Model\Product;
/**
 * Description of Sport Tips
 *
 * auther Armen
 */
class SportTips extends BaseController
{
    public function __construct($route,$countRoute)
    {
        parent::__construct();
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            if (($countRoute==1 && $route[0]=='sporttips') || ($countRoute==3 && $route[0]=='sporttips' && $route[1]=='page' && is_numeric($route[2]))){
                if(isset($route[2])){
                    $this->index($route[2]);
                }else{
                    $this->index();
                }
            }elseif($countRoute==2 && $route[0]=='sporttips' && is_numeric($route[1])){
                $this->itemView($route[1]);
            }elseif ($route[0]=='sporttips' && $countRoute==2 && $route[1]=='statics'){
                $this->ststic();
            }else{
                $this->renderNotFound("main");
                die();
            }
        }
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            if ($route[0]=='sporttips' && $countRoute==2 && $route[1]=='statics'){
                $this->ststic();
            }
        }
    }

    public function index($start = false){
        $_oproduct=new Product();

        $limit = 10;
        if($start){
            $startNum = ($start-1)*$limit;
        }else{
            $startNum = 0;
        }
        //var_dump($startNum);
        $respons=$_oproduct->findByNameLimit(array('fild_name'=>'cid','fild_val'=>5),$startNum,$limit);
        $this->result['result']=$respons;
        //All Count
        $_aCountNum=$_oproduct->findByNameNum(array('fild_name'=>'cid','fild_val'=>5));
        $this->result['m_count']=ceil($_aCountNum/$limit);


        $_oMenu=new \Model\Indicators();
        $resmenu=$_oMenu->findByName(array('fild_name'=>'id','fild_val'=>5));
        $this->result['menu']=$resmenu;

        $_oButton=new \Model\Button();
        foreach($this->result['result'] as &$val){
            $val['button'] = $_oButton->findByName(array('fild_name'=>'proid','fild_val'=>$val['id']));
        }
        $this->renderView("Pages/sport_tips",'sport_tips',$this->result);
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
        $this->renderView("Pages/items",'sport_tips',$this->result);
    }

    private function ststic(){
        $_osport=new \Model\Statistic();
        $_aSportInfo=$_osport->groupOrder();
        $_aAllInfo=$_osport->findAll(array('order'=>array('asc'=>'data')));
        for ($i=0;$i<count($_aSportInfo);$i++){
            for ($j=0;$j<count($_aAllInfo);$j++) {
                $_aMonth = explode('-',$_aSportInfo[$i]['data']);
                if( $_aMonth[1]=="01"){
                    $_aNameManth="January";
                }elseif ($_aMonth[1]=="02"){
                    $_aNameManth="February";
                }elseif ($_aMonth[1]=="03"){
                    $_aNameManth="March";
                }elseif ($_aMonth[1]=="04"){
                    $_aNameManth="April";
                }elseif ($_aMonth[1]=="05"){
                    $_aNameManth="May";
                }elseif ($_aMonth[1]=="06"){
                    $_aNameManth="June";
                }elseif ($_aMonth[1]=="07"){
                    $_aNameManth="July";
                }elseif ($_aMonth[1]=="08"){
                    $_aNameManth="August";
                }elseif ($_aMonth[1]=="09"){
                    $_aNameManth="September";
                }elseif ($_aMonth[1]=="10"){
                    $_aNameManth="October";
                }elseif ($_aMonth[1]=="11"){
                    $_aNameManth="November";
                }elseif ($_aMonth[1]=="12"){
                    $_aNameManth="December";
                }
                $curr_month_start = strtotime(date("".$_aMonth[0]."-".$_aMonth[1]."-01")) ;
                $curr_month_end =  strtotime(date("".$_aMonth[0]."-".$_aMonth[1]."-31"));
                $checkDate =  strtotime(date($_aAllInfo[$j]['data']));
                if ($curr_month_start<=$checkDate && $checkDate<=$curr_month_end){
                    $timeZone[$i][]=$_aAllInfo[$j];
                    $manthName[$i][]=$_aNameManth;
                    $manthYear[$i][]=$_aMonth[0];
                    //$timeZone[$_aSportInfo[$i]['data']][]=$_aAllInfo[$j];
                }
            }
        }
        $this->result['year']=$manthYear;
        $this->result['manth']=$manthName;
        $this->result['time']=$timeZone;
        $this->renderView("Pages/sportstatistics",'sportstatistics',$this->result);
    }
}