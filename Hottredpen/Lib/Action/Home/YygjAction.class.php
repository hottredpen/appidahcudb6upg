<?php
defined('THINK_PATH') or exit();
class YygjAction extends HomeAction{

    public function _initialize(){
		$this->modenname=strtolower(MODULE_NAME);
		parent::_initialize();
	}
    public function index(){
		$modenname=F("site_hott_catid_modenname");
		$catenname=F("site_hott_catid_catenname");
		$catname=F("site_hott_catid_catname");
		import('ORG.Util.Page');// 导入分页类
	    $count      =M("yygj")->where(array('isfabu'=>1))->count();// 查询满足要求的总记录数
	    $Page       = new Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数
	    $show       = $Page->show();// 分页显示输出
	  // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	    $list =M("yygj")->where(array('isfabu'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
		foreach($list as $key =>$val){
		    $list[$key]['modenname']=$modenname[$val['catid']];
			$list[$key]['catenname']=$catenname[$val['catid']];
			$list[$key]['catname']=$catname[$val['catid']];
		}
		
		$this->assign('list',$list);
		$this->assign('Page',$show);// 赋值分页输出	
		$this->display();
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
			    //原数据【找到uid=10】
			    $userdata=M($this->modenname."_jiexi")->where(array('pid'=>$article['id'],'uid'=>10))->select();
				/*=======按段落输出(防范的动作)=====*/
					foreach($userdata as $key =>$val){
						$userdata_see[$val['duanid']]=$val;
					}
					ksort($userdata_see);
				/*=========end======================*/
				//原数据
			    $yuandata=M($this->modenname."_content")->where(array('pid'=>$article['id']))->find();
				$yuandata_see11=unserialize($yuandata['content']);
				/*=======按段落输出(防范的动作)=====*/
					foreach($yuandata_see11 as $key =>$val){
						$yuandata_see[$val['duanid']]=$val;
						if($val['leixing']==0){
						    $yuandata_see[$val['duanid']]['duanyi']=$val['content'];
						}
						
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
				$article['description']=$yuandata_see[0]['content'];//第一段内容
				$article['modname']="英语广角";//title
                //将原文与翻译换位子
				foreach($yuandata_see as $key =>$val){
				    if($yuandata_see[$key]['leixing']==0){
					    $yuandata_see[$key]['content']=$userdata_see[$key]['duanyi'];
					}
				}
				
                $this->assign('article',$article);
		        $this->assign('yuandata',$yuandata_see);
				//$this->assign('yuandata',$userdata);
		        $this->assign("homeurl","-><a href='/".$this->modenname ."'>".$this->modname ."</a>->".$article['title']);
                $this->display("yygj/show");
			}
	}
	/**
	*
	*通用显示tags页面
	*
	*/
	public function Tags(){

					$tag=urldecode($_GET['w']);
					//非最细化，获取细化标签
							$zuowen_tags_title_id=F("zuowen_tags_title_id");
							$gettagsid=$zuowen_tags_title_id[$tag];
                            $zuowen_tags_id_title=F("zuowen_tags_id_title");
							
							if($gettagsid!==null){
							    $zuowen_tags_id_isxihua=F("zuowen_tags_id_isxihua");
							    $isxihua=$zuowen_tags_id_isxihua[$gettagsid];
							    $zuowen_tags_id_pid=F("zuowen_tags_id_pid");
							    $pid=$zuowen_tags_id_pid[$gettagsid];
							    /*******系统默认标签********/
							    if($isxihua==1){
								    //系统短标签
									$tagsx_xiangguan_data=M("zuowen_tags")->where(array('pid'=>array('eq',$pid),'id'=>array('neq',$gettagsid)))->select();
									$this->assign("tags_xiangguan_data",$tagsx_xiangguan_data);
									//获取文章
									$where['pid']=$gettagsid;
                                }else if($isxihua==2){
                                    //系统extend标签（用户提交标签）
									$tagsx_xi_data=M("zuowen_xi_tags")->where(array('pid'=>$gettagsid))->select();
									$this->assign("tags_xi_data",$tagsx_xi_data);
									$tags_xiangguan_data=M("zuowen_tags")->where(array('pid'=>array('eq',$pid),'id'=>array('neq',$gettagsid)))->select();
									$this->assign("tags_xiangguan_data",$tags_xiangguan_data);
									//获取文章
                                    $where['pid']=$gettagsid;
                                }else{
								    //系统大标签
									$tagsx_xi_data=M("zuowen_tags")->where(array('pid'=>$gettagsid))->select();
									$this->assign("tags_xi_data",$tagsx_xi_data);
									$tags_xiangguan_data=M("zuowen_tags")->where(array('pid'=>array('eq',$pid),'id'=>array('neq',$gettagsid)))->select();
									$this->assign("tags_xiangguan_data",$tags_xiangguan_data);
									//获取文章
									$where['ztagsid']=$gettagsid;
                                }								
							}else{
							    /*******用户提交标签********/
									$rrrdata=M("zuowen_xi_tags")->where(array('title'=>$tag))->find();
									$gettagsid=$rrrdata['id'];
									$pid=$rrrdata['pid'];
									$tags_xiangguan_data=M("zuowen_xi_tags")->where(array('pid'=>array('eq',$pid),'id'=>array('neq',$gettagsid)))->select();
									$this->assign("tags_xiangguan_data",$tags_xiangguan_data);
									//获取文章
									$where['id']=$gettagsid;
						    }
							
							/********获取文章*********/
									$articleid_arr=M("zuowen_xi_tags")->where($where)->select();//pid
									foreach($articleid_arr as $key =>$val){
									    $strrr.=$articleid_arr[$key]['allarticle'].",";
									}
									$id_arr=array_filter(explode(",",$strrr));
									sort($id_arr);//从小到大
									foreach($id_arr as $key =>$val){
									    $articlelist[$key]=M("zuowen")->where(array('id'=>$val))->find();
								    }

					$this->assign('list',$articlelist);
					$this->assign('tagstitle',$tag);
					$this->assign("homeurl","-><a href='/".$this->modenname."'>".$this->modname."</a>->".$this->actname);
					$this->display("tongyong/tags");


					
	}
	/**
	*
	*通用显示user页面
	*
	*/
	public function user(){
	
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
		            //$this->error("没有该用户的批注！");
					p($onedata);
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
                    $udata=M($this->modenname."_jiexi")->where(array('pid'=>$onedata['pid'],'uid'=>$onedata['uid']))->select();
					    
						foreach($yuandata_see as $key =>$val){
						    //替换该段的内容
 						    for($i=0;$i<count($udata);$i++){
						            if($yuandata_see[$key]['duanid']==$udata[$i]['duanid']){
						                $yuandata_see[$key]['content']=make_u_str($yuandata_see[$key]['content'],unserialize($udata[$i]['huaju']),unserialize($udata[$i]['quanzi']));
										$yuandata_see[$key]['duanyi']=$udata[$i]['duanyi'];
										//break防止重复提交时出现多个该段，重复出现问题其他地方会解决
										break;
									}
							}
						}
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
		    $this->display("yygj/show");
	}
}

?>