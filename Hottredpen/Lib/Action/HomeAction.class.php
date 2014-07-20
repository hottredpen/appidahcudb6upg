<?php
defined('THINK_PATH') or exit();
class HomeAction extends AppstartAction{

	public function _initialize(){
	    parent::_initialize();
		header("Content-Type:text/html; charset=utf-8");
		C('TMPL_ACTION_ERROR','Index/jump');	//默认错误跳转对应的模板文件Home
		C('TMPL_ACTION_SUCCESS','Index/jump');	//默认成功跳转对应的模板文件Home
		//获取系统属性
		$system=F("systems");
		$this->assign('sys',$system);
		//站点关闭
		if($system['sys_site_switch']==1){	
			$this->display('Index/close');
			exit;
		}
		//导航active
		$active[strtolower(MODULE_NAME)]='active';
		$this->assign('active',$active);
		
		$lanmu_entitle_title=F("lanmu_entitle_title");
		$lanmu_entitle_keywords=F("lanmu_entitle_keywords");
		$lanmu_entitle_description=F("lanmu_entitle_description");
		if(strtolower(ACTION_NAME)=="index"){
		    $indextitle=$lanmu_entitle_title[strtolower(MODULE_NAME)];
		    $indexkeywords=$lanmu_entitle_keywords[strtolower(MODULE_NAME)];
			$indexdescription=$lanmu_entitle_description[strtolower(MODULE_NAME)];
			$this->assign("indextitle",$indextitle);
		    $this->assign("indexkeywords",$indexkeywords);
			$this->assign("indexdescription",$indexdescription);
		}else{
		    //显示article的栏目名称
		    $lanmutitle=$lanmu_entitle_title[strtolower(MODULE_NAME)];
		    $this->assign("lanmutitle",$lanmutitle);
			$this->assign("lanmuentitle",strtolower(MODULE_NAME));
		}
    }
	/***
	*
	是否登录
	*
	****/
	function islogin(){
		if(!$this->_session('user_uid')){
			$this->error("请先登陆",'__ROOT__/login.html');
		}
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
			    //$this->error("没有找到该文章！");
				$this->go404();
			}
			
			

		    
			if(!$article){
			    //$this->error("没有找到该文章！");
				$this->go404();
		    }else{
				//原数据
			    $yuandata=M($this->modenname."_content")->where(array('pid'=>$article['id']))->find();
				$yuandata_see11=unserialize($yuandata['content']);
				/*=======按段落输出(防范的动作)=====*/
					foreach($yuandata_see11 as $key =>$val){
						$yuandata_see[$val['duanid']]=$val;
					}
					ksort($yuandata_see);
				/*=========end======================*/

 			foreach($yuandata_see as $key =>$val){
			    if($yuandata_see[$key]['leixing']==1){
				    $yuandata_see[$key]['content']=str_replace('/Uploads/','/sUploads/',$yuandata_see[$key]['content']);
				    $this->aa($yuandata_see[$key]['content']);
				}
			
			}

				
				
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
				$article['description']=$yuandata_see[1]['content'];//

                $this->assign('article',$article);
		        $this->assign('yuandata',$yuandata_see);
		        $this->assign("homeurl","-><a href='/".$this->modenname ."'>".$this->modname ."</a>->".$article['title']);
                $this->display("Tongyong/show");
			}
	}
	/**
	*
	*通用显示tags页面
	*
	*/
	public function Tags(){

					$tag=htmlspecialchars(urldecode($_GET['w']));
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
									$tagsx_xi_data=M("alltags")->where(array('pid'=>$gettagsid))->select();
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
									    $articlelist[$key]=M("zuowen")->where(array('id'=>$val))->find();
								    }

					$this->assign('list',$articlelist);
					$this->assign('tagstitle',$tag);
					$indextitle="有关".$tag."的作文,描写".$tag."的作文";
					$this->assign('indextitle',$indextitle);
					//$this->assign("homeurl","-><a href='/".$this->modenname."'>".$this->modname."</a>->".$this->actname);
					$this->display("tongyong/tags");


					
	}
	/**
	*
	*通用显示user页面
	*
	*/
	public function user(){
	        //p("yuan");
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
		    $this->display("Tongyong/show");
	}
   /**
	* @积分配置
	*/
	public function integralConf(){
		$system=M('integralconf');
		$system=$system->select();
		foreach($system as $s){
			$sys[$s['name']]=array($s['value'],$s['state']);
		}
		return $sys;
	}
/*
*
kong
*
*/
	public function _empty(){
		$this->go404();
	}
/*
*
404
*
*/
	public function go404(){
                header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
                $this->display("Index:404");
	
	}
	
}
?>