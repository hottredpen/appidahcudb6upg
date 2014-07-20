<?php
defined('THINK_PATH') or exit();
class TongyongAction extends HomeAction{

    public function _initialize(){
	    parent::_initialize();
	}
	public function _empty(){
	    $arr=F("site_hott_catid_catenname");
	    $action=strtolower(ACTION_NAME);
		if(!in_array($action,$arr)){
		    $this->error("错误的地址！");
		}
		$indexid=$this->_get("html");
		$indexpuid=$this->_get("user");
		//获取操作的catid 及中文名称

		$getcatid=F("site_hott_catenname_catid");
		$getcatname=F("site_hott_catenname_catname");
		$this->actname=$getcatname[$action];
		$this->actenname=$action;
		$catid=$getcatid[$this->actenname];
		$this->assign('actname',$this->actname);
		$this->assign('actenname',$this->actenname);
		/*************************
		第几册
		*************************/
		if($indexid==null && $indexpuid==null){
		    if($action=="tags"){
  			        
					$tag=$this->_get('tag');
					$data=M($this->modenname)->select();
					$getcatenname=F("site_hott_catid_catenname");
					$getcatname=F("site_hott_catid_catname");
					foreach($data as $key =>$val){
					    if($val['tags'] && in_array($tag,array_filter(explode(" ",$val['tags'])))){
					        $tagsarr[$key]=$val;
							$tagsarr[$key]['modenname']=$this->modenname;
							$tagsarr[$key]['catenname']=$getcatenname[$val['catid']];
							$tagsarr[$key]['catname']=$getcatname[$val['catid']];
					    }
					}
					
					$this->assign('list',$tagsarr);
					$this->assign('tagstitle',$tag);
					$this->assign("homeurl","-><a href='/".$this->modenname."'>".$this->modname."</a>->".$this->actname);
					$this->display("tongyong/tags");

			}else{
					$list =M($this->modenname)->where(array('isfabu'=>1,'catid'=>$catid))->order("orderid asc")->select();
					foreach($list as $key =>$val){
						$list[$key]['url']="/".$this->modenname."/".$this->actenname."/html/".$list[$key]['indexpuid'].".html";
					}
					$this->assign('title',$this->actname);
					$this->assign('list',$list);
					$this->assign("homeurl","-><a href='/".$this->modenname."'>".$this->modname."</a>->".$this->actname);
					$this->display("tongyong/nianjiindex");
					
			}

		/*************************
		内容显示
		*************************/
		}elseif($indexid!==null && $indexpuid==null){

		    $article=M($this->modenname)->where(array('indexid'=>$indexid))->find();
			if(!$article){
				$this->error("没有找到该文章！");
		    }else{
				//原数据
			    $yuandata=M($this->modenname."_content")->where(array('pid'=>$article['id']))->find();
				$yuandata_see=unserialize($yuandata['content']);
 				//获取所有发布的用户
				$onedata=M($this->modenname."_jiexi_one")->where(array('pid'=>$article['id']))->select();
				if($onedata){
				    foreach($onedata as $key => $val){
				        $uname=M("user")->where(array('id'=>$onedata[$key]['uid']))->find();
                        $onedata[$key]['username']=$uname['username'];
					}	
			        $this->assign('teachers',$onedata);
				}
				//将tags数组化,并去空
				$article['tags']=array_filter(explode(' ',$article['tags']));
				$article['description']=$yuandata_see[0]['content'];//第一段内容
                $this->assign('article',$article);
		        $this->assign('yuandata',$yuandata_see);
		        $this->assign("homeurl","-><a href='/".$this->modenname ."'>".$this->modname ."</a>-><a href='/".$this->modenname ."/".$this->actenname ."'>".$this->actname ."</a>->".$article['title']);
                $this->display("tongyong/show");
				
				p($article['id']);
				p($yuandata_see);
			}
		/*************************
		用户批注显示
		*************************/
		}elseif($indexid==null && $indexpuid!==null){
		    $moshi=$this->_get('moshi');
		    switch ($moshi){
		        case "bianji":
			        //非登录用户转编辑为查看页面
			        $this->_session('user_uid')?$this->_session('user_uid'):header("Location: /".$this->modenname ."/".$this->actenname ."/user/".$indexpuid."?moshi=chakan");
				    $this->assign('moshi',"编辑");
				    break;
			    case "chakan":
			        //一般游客都可查看
			        $this->assign('moshi',"查看");
			        break;
			    default:
				    //一般游客都可查看
			        $this->assign('moshi',"查看");
			        break;
		    }

		        $onedata=M($this->modenname."_jiexi_one")->where(array('indexpuid'=>$indexpuid))->find();
			    if(!$onedata){
		            $this->error("没有该用户的批注！");
		        }else{
			        //article数据
			        $article=M($this->modenname)->where(array('id'=>$onedata['pid']))->find();
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
            $article['gaiyao']=$onedata['gaiyao'];
		    $this->assign('uid', $this->_session('user_uid'));
			$this->assign('indexid',$article['indexid']);
            $this->assign('article',$article);
		    $this->assign('yuandata',$yuandata_see);
		    $this->assign("homeurl","-><a href='/".$this->modenname."'>".$this->modname."</a>-><a href='/".$this->modenname."/".$this->actenname."'>".$this->actname."</a>->".$article['title']);
		    $this->display("Tongyong/usershow");
		
		}
	}

}

?>