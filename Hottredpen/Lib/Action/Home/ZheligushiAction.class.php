<?php
defined('THINK_PATH') or exit();
class ZheligushiAction extends HomeAction{

    public function _initialize(){
	    parent::_initialize();
		$getcatname=F("site_hott_catenname_catname");
		$this->modenname=strtolower(MODULE_NAME);
		$this->modname=$getcatname[$this->modenname];
		$this->assign('modname',$this->modname);
		$this->assign('modenname',$this->modenname);
	}
    public function index(){
		//获取
		$modenname=F("site_hott_catid_modenname");
		$catenname=F("site_hott_catid_catenname");
		$catname=F("site_hott_catid_catname");
		$list =M($this->modenname)->where(array('isfabu'=>1))->limit(20)->order("id desc")->select();
		
		foreach($list as $key =>$val){
		    $list[$key]['modenname']=$modenname[$val['catid']];
			$list[$key]['catenname']=$catenname[$val['catid']];
			$list[$key]['catname']=$catname[$val['catid']];
            $list[$key]['tags']=array_filter(explode(' ',$list[$key]['tags']));
	    }
	
		$this->assign('list',$list);
		$this->assign("homeurl","->".$this->modname);
		
		$this->assign('actname',$this->actname);
		$this->assign('actenname',$this->actenname);
		$this->display();
    }
}

?>