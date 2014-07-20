<?php
defined('THINK_PATH') or exit();
class ZuowenAction extends HomeAction{

    public function _initialize(){
	    parent::_initialize();
		$this->modenname=strtolower(MODULE_NAME);
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
		$user_id_username=F("user_id_username");
		
		$data=$c->order("id desc")->select();
		foreach($data as $key =>$val){
		
		    
		    $data[$key]['huaju']=unserialize($data[$key]['huaju']);
			$data[$key]['quanzi']=unserialize($data[$key]['quanzi']);
			
			$data[$key]['username']=$user_id_username[$data[$key]['uid']];
			$data[$key]['indexid']=$zuowen_id_indexid[$val['pid']];
			$data[$key]['articletitle']=$zuowen_id_title[$val['pid']]; 
			
			
			$content[$key]=$cc->where(array('pid'=>$val['pid']))->find();
			$content[$key]['content']=unserialize($content[$key]['content']);
			
			foreach($content[$key]['content'] as $key11 =>$val11){
			    $mkcontent[$key]['content'][$val11['duanid']]=$val11;
			}

			$data[$key]['articleduanwen']=$mkcontent[$key]['content'][$data[$key]['duanid']]['content'];
			
			foreach($data[$key]['huaju'] as $key2 =>$val2){
			    $data[$key]['huaju'][$key2]['articleduanwen']=str_replace($val2['huaju'],"<font class='text-danger'>".$val2['huaju']."</font>",$data[$key]['articleduanwen']);
				$data[$key]['huaju'][$key2]['numb']=$key2;
			}
			foreach($data[$key]['quanzi'] as $key3 =>$val3){
			    $data[$key]['quanzi'][$key3]['articleduanwen']=str_replace($val3['quanzi'],"<font class='text-danger'>".$val3['quanzi']."</font>",$data[$key]['articleduanwen']);
				$data[$key]['quanzi'][$key3]['numb']=$key3;
			}
			//p($mkcontent[$key]['content']);
		}
		   
	
	    $this->assign("data",$data);
	    $this->display();
		//p($data);
	}
}

?>