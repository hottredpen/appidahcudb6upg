<?php
defined('THINK_PATH') or exit();
class HaocijuAction extends HomeAction{

    public function _initialize(){
	    parent::_initialize();
		//$getcatname=F("site_hott_catenname_catname");
		$this->modenname=strtolower(MODULE_NAME);
		//$this->modname=$getcatname[$this->modenname];
		$this->assign('modname',$this->modname);
		$this->assign('modenname',$this->modenname);
	}
	/**
	*
	*通用显示html页面
	*
	*/
	public function html(){
	
		    $indexid=$this->_get("indexid");
			$indexpuid=$this->_get("indexpuid");
			if($indexid){
			    $article=M($this->modenname)->where(array('indexid'=>$indexid))->find();
			}else if($indexpuid){
			    $article=M($this->modenname)->where(array('indexpuid'=>$indexpuid))->find();
			}else{
			    $this->error("没有找到该文章！");
			}
			
			

		    
			if(!$article){
				$this->error("没有找到该文章！");
		    }else{
			    //原数据【找到isrenzheng】
			    $userdata_see=M($this->modenname."_jiexi")->where(array('pid'=>$article['id'],'isrenzheng'=>0))->select();

				/*=========end======================*/
				//原数据
			    $yuandata=M($this->modenname."_content")->where(array('pid'=>$article['id']))->find();
				$yuandata_see11=unserialize($yuandata['content']);
				/*=======按段落输出(防范的动作)=====*/
					foreach($yuandata_see11 as $key =>$val){
						$yuandata_see[$val['duanid']]=$val;
/* 						if($val['leixing']==0){
						    $yuandata_see[$val['duanid']]['duanyi']=$val['content'];
						} */
					}
					ksort($yuandata_see);
				/*=========end======================*/
				//前一篇文章
				$preArticle=M($this->modenname)->field("id,indexid,title,isfabu")->where(array('id'=>array('lt',$article['id']),'isfabu'=>1))->limit(1)->order("id desc")->find();
				$this->assign('preArticle',$preArticle);
				//后一篇文章
				$nextArticle=M($this->modenname)->field("id,indexid,title,isfabu")->where(array('id'=>array('gt',$article['id']),'isfabu'=>1))->limit(1)->order("id asc")->find();
				$this->assign('nextArticle',$nextArticle);

				//将tags数组化,并去空
				$article['tags']=array_filter(explode(' ',$article['tags']));
				$article['yuan_tags']=implode(',',$article['tags']);//用于head中的关键词
				$article['keywords']=$article['yuan_tags'];//
				$article['description']=$article['gaiyao'];//
                //将原文与翻译换位子
				$user_id_username=F("user_id_username");
				foreach($yuandata_see as $key =>$val){
					    //$yuandata_see[$key]['duanyi']=$userdata_see[$key]['duanyi'];
						
                            foreach($userdata_see as $key2 =>$val2){
							     
								 if($yuandata_see[$key]['duanid']==$userdata_see[$key2]['duanid']){
								     $yuandata_see[$key]['duanyi_haociju'][$key2]['duanyi']=$userdata_see[$key2]['duanyi'];
									 //$yuandata_see[$key]['duanyi_haociju'][$key2]['uid']=$udata[$key2]['uid'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['starfenshu']=$userdata_see[$key2]['starfenshu'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['isrenzheng']=$userdata_see[$key2]['isrenzheng'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['jxid']=$userdata_see[$key2]['id'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['uprenshu']=$userdata_see[$key2]['uprenshu'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['downrenshu']=$userdata_see[$key2]['downrenshu'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['username']=$user_id_username[$userdata_see[$key2]['uid']];
								 }
							}
						
				}
                $this->assign('article',$article);
		        $this->assign('yuandata',$yuandata_see);
		        $this->assign("homeurl","-><a href='/".$this->modenname ."'>".$this->modname ."</a>->".$article['title']);
                $this->display("tongyong/show");
				//p($yuandata_see);
				//p($userdata);
			}
	}
	/**
	*
	*通用显示user页面
	*
	*/
	public function user(){
	        //p("dd");
		    $moshi=$this->_get('moshi');
			$indexpuid=$this->_get("indexpuid");
			
			$onedata=M($this->modenname."_jiexi_one")->where(array('indexpuid'=>$indexpuid))->find();
			

            if($this->_session('user_uid')!=null && $this->_session('user_uid')==$onedata['uid']){
			    $this->assign('moshi',"批注");
				$this->assign('actenname',"user");
			}else{
			    $this->assign('moshi',"查看");
				$this->assign('actenname',"user");
			}

			    if(!$onedata){
		            $this->error("没有该用户的批注！");
					//p($onedata);
		        }else{
			        //article数据
			        $article=M($this->modenname)->where(array('id'=>$onedata['pid']))->find();
					//前一篇文章
					$preArticle=M($this->modenname)->field("id,indexid,title,isfabu")->where(array('id'=>array('lt',$article['id']),'isfabu'=>1))->limit(1)->order("id desc")->find();
					$this->assign('preArticle',$preArticle);
					//后一篇文章
					$nextArticle=M($this->modenname)->field("id,indexid,title,isfabu")->where(array('id'=>array('gt',$article['id']),'isfabu'=>1))->limit(1)->order("id asc")->find();
					$this->assign('nextArticle',$nextArticle);

					//原数据
					$yuandata=M($this->modenname."_content")->where(array('pid'=>$article['id']))->find();
					$yuandata_see=unserialize($yuandata['content']);
			        //用户数据
                    $udata=M($this->modenname."_jiexi")->where(array('pid'=>$onedata['pid'],'isrenzheng'=>0))->select();
					$user_id_username=F("user_id_username");
 						foreach($yuandata_see as $key =>$val){

                            foreach($udata as $key2 =>$val2){
							     
								 if($yuandata_see[$key]['duanid']==$udata[$key2]['duanid']){
								     $yuandata_see[$key]['duanyi_haociju'][$key2]['duanyi']=$udata[$key2]['duanyi'];
									 //$yuandata_see[$key]['duanyi_haociju'][$key2]['uid']=$udata[$key2]['uid'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['starfenshu']=$udata[$key2]['starfenshu'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['isrenzheng']=$udata[$key2]['isrenzheng'];
									 $yuandata_see[$key]['duanyi_haociju'][$key2]['username']=$user_id_username[$udata[$key2]['uid']];
								 }
							}
						    

						} 
						//p($yuandata_see);
						
/* 						foreach($yuandata_see as $key =>$val){
						    //替换该段的内容
 						    for($i=0;$i<count($udata);$i++){
						            if($yuandata_see[$key]['duanid']==$udata[$i]['duanid']){
						                $yuandata_see[$key]['content']=make_u_str($yuandata_see[$key]['content'],unserialize($udata[$i]['huaju']),unserialize($udata[$i]['quanzi']));
										$yuandata_see[$key]['duanyi']=$udata[$i]['duanyi'];
										//break防止重复提交时出现多个该段，重复出现问题其他地方会解决
										break;
									}
							}
						} */
						
						
			    }
			$uname=M("user")->where(array('id'=>$onedata['uid']))->find();
			
			//将tags数组化,并去空
			$article['tags']=array_filter(explode(' ',$article['tags']));
            $article['gaiyao']=$onedata['gaiyao'];
			$article['modname']="优秀作文";//title
			$article['pizhuwith']=$uname['username'];//title
		    $this->assign('uid', $this->_session('user_uid'));
			$this->assign('indexid',$article['indexid']);
            $this->assign('article',$article);
		    $this->assign('yuandata',$yuandata_see);
		    $this->assign("homeurl","-><a href='/".$this->modenname."'>".$this->modname."</a>-><a href='/".$this->modenname."/".$this->actenname."'>".$this->actname."</a>->".$article['title']);
		    $this->display("Tongyong/show");
	}
	/**
	*
	*通用显示tags页面
	*
	*/
	public function Tags(){

					$tag=urldecode($_GET['w']);
					//非最细化，获取细化标签
							$haociju_tags_title_id=F("haociju_tags_title_id");
							$gettagsid=$haociju_tags_title_id[$tag];
                            $haociju_tags_id_title=F("haociju_tags_id_title");
							
							if($gettagsid!==null){
							    $haociju_tags_id_isxihua=F("haociju_tags_id_isxihua");
							    $isxihua=$haociju_tags_id_isxihua[$gettagsid];
							    $haociju_tags_id_pid=F("haociju_tags_id_pid");
							    $pid=$haociju_tags_id_pid[$gettagsid];
							    /*******系统默认标签********/
							    if($isxihua==1){
								    //系统短标签
									$tagsx_xiangguan_data=M("haociju_tags")->where(array('pid'=>array('eq',$pid),'id'=>array('neq',$gettagsid)))->select();
									$this->assign("tags_xiangguan_data",$tagsx_xiangguan_data);
									//获取文章
									$where['pid']=$gettagsid;
                                }else if($isxihua==2){
                                    //系统extend标签（用户提交标签）
									$tagsx_xi_data=M("alltags")->where(array('pid'=>$gettagsid))->select();
									$this->assign("tags_xi_data",$tagsx_xi_data);
									$tags_xiangguan_data=M("haociju_tags")->where(array('pid'=>array('eq',$pid),'id'=>array('neq',$gettagsid)))->select();
									$this->assign("tags_xiangguan_data",$tags_xiangguan_data);
									//获取文章
                                    $where['pid']=$gettagsid;
                                }else{
								    //系统大标签
									$tagsx_xi_data=M("haociju_tags")->where(array('pid'=>$gettagsid))->select();
									$this->assign("tags_xi_data",$tagsx_xi_data);
									$tags_xiangguan_data=M("haociju_tags")->where(array('pid'=>array('eq',$pid),'id'=>array('neq',$gettagsid)))->select();
									$this->assign("tags_xiangguan_data",$tags_xiangguan_data);
									//获取文章
									$where['ztagsid']=$gettagsid;
                                }								
							}else{
							    /*******用户提交标签********/
									$rrrdata=M("alltags")->where(array('title'=>$tag))->find();
									$gettagsid=$rrrdata['id'];
									$pid=$rrrdata['pid'];
									$tags_xiangguan_data=M("alltags")->where(array('pid'=>array('eq',$pid),'id'=>array('neq',$gettagsid)))->select();
									$this->assign("tags_xiangguan_data",$tags_xiangguan_data);
									//获取文章
									$where['id']=$gettagsid;
						    }
							
							/********获取文章*********/
									$articleid_arr=M("alltags")->where($where)->select();//pid
									foreach($articleid_arr as $key =>$val){
									    $strrr.=$articleid_arr[$key]['allarticle'].",";
									}
									$id_arr=array_filter(explode(",",$strrr));
									sort($id_arr);//从小到大
									foreach($id_arr as $key =>$val){
									    $articlelist[$key]=M("haociju")->where(array('id'=>$val))->find();
								    }

					$this->assign('list',$articlelist);
					$this->assign('tagstitle',$tag);
					$this->assign("homeurl","-><a href='/".$this->modenname."'>".$this->modname."</a>->".$this->actname);
					$this->display("haociju/tags");


					
	}
}

?>