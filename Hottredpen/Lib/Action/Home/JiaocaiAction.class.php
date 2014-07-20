<?php
defined('THINK_PATH') or exit();
class JiaocaiAction extends HomeAction{

    public function _initialize(){
	    parent::_initialize();
		$getcatname=F("site_hott_catenname_catname");
		$this->modenname=strtolower(MODULE_NAME);
		$this->modname=$getcatname[$this->modenname];
		$this->assign('modname',$this->modname);
		$this->assign('modenname',$this->modenname);
	}
    public function index(){
		$mod = D("zuowen_tags");	
        $tagsdata = $mod->field("id,pid,order,title,entitle,concat(idtree,'-',id) as absPath")->order("absPath,id")->select();
		foreach($tagsdata as $key =>$val){
            $tagsdata_id[$val['id']]=$val;
		}
		foreach($tagsdata_id as $key =>$val){
		    if($val['order']==3){
			    $tagsdata_id[$val['pid']]['child'][$key]=$val;
				unset($tagsdata_id[$key]);
			}
		}
		foreach($tagsdata_id as $key =>$val){
		    if($val['order']==2){
			    $tagsdata_id[$val['pid']]['child'][$key]=$val;
				unset($tagsdata_id[$key]);
			}
		}
		$this->assign('zuowentags',$tagsdata_id);
		$this->display();
    }
	public function fenlei(){
	    
	    $c=M("zuowen_jiexi");
		$cc=M("zuowen_content");
        $zuowen_id_title=F("zuowen_id_title");
		$zuowen_id_indexid=F("zuowen_id_indexid");
		$data=$c->select();
		foreach($data as $key =>$val){
		    $data[$key]['huaju']=unserialize($data[$key]['huaju']);
			$data[$key]['indexid']=$zuowen_id_indexid[$val['pid']];
			$data[$key]['articletitle']=$zuowen_id_title[$val['pid']]; 
			$content[$key]=$cc->where(array('pid'=>$val['pid']))->find();
			$content[$key]['content']=unserialize($content[$key]['content']);
			$duanid[$key]=$val['duanid']-1;
			$data[$key]['articleduanwen']=$content[$key]['content'][$duanid[$key]]['content'];
			foreach($data[$key]['huaju'] as $key2 =>$val2){
			    $data[$key]['huaju'][$key2]['articleduanwen']=str_replace($val2['huaju'],"<font class='text-danger'>".$val2['huaju']."</font>",$data[$key]['articleduanwen']);
				$data[$key]['huaju'][$key2]['numb']=$key2;
			}
			
			
		}
		   
	
	    $this->assign("data",$data);
	    $this->display();
		//p($data);
	}
}

?>