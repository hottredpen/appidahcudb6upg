<?php
	/**
	*
	*Tags管理
	*
	*/
defined('THINK_PATH') or exit();
class TagsAction extends AdminAction {
	/**
	*
	*标签类所有列表选项
	*
	*/
    public function _initialize(){
	    parent::_initialize();
		$lanmu_id_entitle=F("lanmu_id_entitle");
        $this->listarr=$lanmu_id_entitle;
	}
	/**
	*
	*栏目列表
	*
	*/
	public function alltags(){
	  $mod = M("alltags");
	  
	  
	  import('ORG.Util.Page');// 导入分页类
	  $count      = $mod->count();// 查询满足要求的总记录数	
	  $Page       = new Page($count,50);// 实例化分页类 传入总记录数和每页显示的记录数
	  $show       = $Page->show();// 分页显示输出
	  $alltagsdata = $mod->order("id desc")->limit($Page->firstRow.','.$Page->listRows)->select();
	  $zuowen_tags_id_title=F("zuowen_tags_id_title");
	  $haociju_tags_id_title=F("haociju_tags_id_title");
      foreach($alltagsdata as $key =>$val){
	      if($alltagsdata[$key]['from']=="zuowen"){
		       $alltagsdata[$key]['ptitle']=$zuowen_tags_id_title[$val['pid']];
		  }else if($alltagsdata[$key]['from']=="haociju"){
		       $alltagsdata[$key]['ptitle']=$haociju_tags_id_title[$val['pid']];
		  }
	      
	  }	  
	  $this->assign("alltagsdata",$alltagsdata);
	  $this->assign('Page',$show);// 赋值分页输出
	  $this->display();

	}
	/**
	*
	*编辑栏目
	*
	*/
	public function editalltags(){
	    $id=$_GET['id'];
		$from=$_GET['from'];
		if(!$id || !$from){
			$this->error("请选择栏目");
		}
		$mod = M("alltags");	
		$thisdata = $mod->where("id=".$id)->find();

			$pmod=M($from."_tags");
			$pdata = $pmod->field("id,pid,order,title,entitle,isxihua,concat(idtree,'-',id) as absPath")->order("absPath,id")->select();

		
 		if(!$pdata){
			$pdata['title']='顶级类目';
		} 
		$this->assign('thisdata',$thisdata);
		$this->assign('pdata',$pdata);
		$this->assign('pid',$thisdata['pid']);
		$this->display();
	}
	/**
	*
	*更新栏目
	*
	*/
    public function updatealltags(){
	    $id=$_POST['id'];
		
        $c = M("alltags");
		if($c->create()){
			$re = $c->save();
			if($re){
			    F("huancun",null);
				$this->AdminLog("栏目id=".$id."修改成功");//后台操作
				$this->success("栏目id=".$id."修改成功","alltags");
			}else{
				$this->AdminLog("栏目id=".$id."修改失败");//后台操作
				$this->error( "栏目id=".$id."修改失败","alltags"); 
			}
		}else{
			$this->error($c->getError());
		}
	}
	/**
	*
	*标签类(empty动作)
	*
	*/
	public function _empty(){
	    $action=strtolower(ACTION_NAME);
		/**
		*标签类List
		*/
		if(strstr($action,"list")){
			$mod=str_replace("list",'',$action);
			//$year=$_GET['year']?$_GET['year']:0;
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			$article['mod']=$mod;
			//$article[$year]=$year;
			$this->assign('article',$article);
			//进入对应的list动作
            $this->empty_list($mod);
		/**
		*标签类Add
		*/			
		}else if(strstr($action,"add")){
			$mod=str_replace("add",'',$action);
			$pid=$_GET['pid'];
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			$article['mod']=$mod;
			$this->assign('article',$article);
			//进入动作
            $this->empty_add($mod,$pid);	
	    }else if(strstr($action,"save")){
			$mod=str_replace("save",'',$action);
			$pdata=$_POST;
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//进入动作
            $this->empty_save($mod,$pdata);	
		/**
		*标签类修改Edit
		*/		
		}else if(strstr($action,"edit")){
			$mod=str_replace("edit",'',$action);
			$pid=$_GET['pid'];
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			$article['mod']=$mod;
		    $this->assign('article',$article);
			//进入对应的add动作
            $this->empty_editarticle($mod,$pid);
        }else if(strstr($action,"updatearticle")){
			$mod=str_replace("updatearticle",'',$action);
			$pdata=$_POST;
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//进入对应的add动作
            $this->empty_updatearticle($mod,$pdata);
		/**
		*标签类删除del
		*/		
        }else if(strstr($action,"delarticle")){
			$mod=str_replace("delarticle",'',$action);
			$id=$_GET['id'];
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//进入对应的add动作
            $this->empty_delarticle($mod,$id);
		/**
		*搜索未添加标签
		*/	
        }else if(strstr($action,"auto")){
			$mod=str_replace("auto",'',$action);
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			//进入对应的add动作
            $this->empty_auto($mod,$article['modname']);
        }else if(strstr($action,"small_f_big")){
			$mod=str_replace("small_f_big",'',$action);
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			//进入对应的add动作
            $this->empty_small_f_big($mod,$article['modname']);
        }else if(strstr($action,"into")){
			$mod=str_replace("into",'',$action);
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			//进入对应的add动作
            $this->empty_into($mod,$article['modname']);
        }			


	}
	/**
	*
	*标签列表
	*
	*/
	protected function empty_list($mod){

		$model = M($mod."_tags");
		import('ORG.Util.Page');// 导入分页类
		$count      = $model->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$count);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $model->limit($Page->firstRow.','.$Page->listRows)->field("id,pid,order,title,entitle,isxihua,concat(idtree,'-',id) as absPath")->order("absPath,id")->select();
	
	    $this->assign('list',$list);// 赋值数据集
	    $this->assign('Page',$show);// 赋值分页输出				
	    $this->display("List");	
		
	}
	/**
	*
	*添加标签
	*
	*/
	protected function empty_add($mod,$pid){
	
		if($pid){
			$data = M($mod."_tags")->where("id=".$pid)->find();
			$idtree=$data['idtree']."-".$pid;
			$data['newOrder'] = intval($data['order'])+1;
		}else{
			$data=0;
			$pid=0;
			$idtree=0;
		}
		$this->assign('pid',$pid);
		$this->assign('idtree',$idtree);
		$this->assign('data',$data);
		$this->display("Add");
	}
	/**
	*
	*保存标签
	*
	*/
	protected function empty_save($mod,$pdata){
        $add = M($mod."_tags");
		$pdata['addtime']=time();

			$re = $add->add($pdata);
			if($re>0){
			    F("huancun",null);
				$this->AdminLog($mod."tags添加成功");//后台操作
				$this->success($mod."tags添加成功",$mod."list"); 
				
			}else{
				$this->AdminLog($mod."tags添加失败");//后台操作
				$this->error( $mod."tags添加失败",$mod."list"); 
			}

	}
	/**
	*
	*修改标签
	*
	*/
	protected function empty_editarticle($mod,$pid){
	        $c=M($mod."_tags");
	        $thisdata=$c->where(array('id'=>$pid))->find();
			$thisdata['newOrder'] = intval($thisdata['order']);
			
			$pdata = $c->where(array("id=".$thisdata['pid']))->find();	
			if(!$pdata){
				$pdata['title']='顶级类目';
		    }
			$this->assign('thisdata',$thisdata);
		    $this->assign('pdata',$pdata);
		    $this->display("Edit");
	}
	/**
	*
	*更新标签
	*
	*/
	protected function empty_updatearticle($mod,$pdata){
	        $c=M($mod."_tags");
			$id=$pdata['id'];
			$re=$c->where(array('id'=>$id))->save($pdata);
			if($re>0){
			    $this->success("更新标签成功！",$mod."list");
			}else{
			    $this->error("更新标签失败！",$mod."list");
			}
	}
	/**
	*
	*删除标签(移入回收站isfabu=0)
	*
	*/
	protected function empty_delarticle($mod,$id){
	    $c=M($mod."_tags");
		$data=$c->select();
		//$id=$_GET['id'];
		foreach($data as $key =>$val){
			if($id==$val['pid']){
			    $this->error("没法直接删除，下面还有子tags");
			}
		}
	    $re=$c->where(array('id'=>$id))->delete();
		if($re){
		    $this->AdminLog("管理员删除id=".$id.",".$mod."_tags成功");//后台操作
			F('huancun',NULL);
		    $this->success("管理员删除id=".$id.",".$mod."_tags成功", "__URL__/".$mod."list");
		}else{
		    $this->AdminLog("管理员删除id=".$id.",".$mod."_tags失败");//后台操作
		    $this->error($c->getError());
		}
	
	}
	/**
	*
	*搜索未添加tags
	*
	*/
	protected function empty_auto($mod,$modname){
	    $c=M($mod);
		$data=$c->select();
		$new=array();
		foreach($data as $key => $val){
		    $new=array_merge(array_filter(explode(' ',$val['tags'])),$new);
		}
		$new=array_unique($new);
		
		$mod = M("alltags");
	    $tagsdata = $mod->select();
		foreach($tagsdata as $key =>$val){
		    $nnn[$key]=$val['title'];
		}
		$newtags=array_diff($new,$nnn);
		if($newtags){
			foreach($newtags as $key =>$val){
				$ddas=M("alltags")->data(array('title'=>$val,'from'=>$mod))->add();
				if($ddas>0){
					echo $modname."标签：".$val."=》添加ok<br />";
				}
			}
		}else{
		    $this->error("没有新增的".$modname."tags");
		}

	}
	/*********细标签获取大标签id********/
	protected function empty_small_f_big($mod,$modname){
	    
		$xtags=M("alltags")->select();
		foreach($xtags as $key =>$val){
		    //不存在ztagsid的情况下
		    if($val['pid']>0 && $val['ztagsid']==0){
			    $ztags[$key]=M($mod."_tags")->where(array('id'=>$val['pid']))->find();
				if($ztags[$key]['order']==3){
				    $val['ztagsid']=$ztags[$key]['pid'];
				}else if($ztags[$key]['order']==2){
				    $val['ztagsid']=$val['pid'];
				}
				$re=M("alltags")->where(array('id'=>$val['id']))->data(array('ztagsid'=>$val['ztagsid']))->save();
				if($re>0){
					echo $val['title']."=>添加了它的父级标签id<br />";
				}
			}

		}
	}
	/****************/
	protected function empty_into($mod,$modname){
	    $data=M($mod)->where(array('isfabu'=>1))->select();
        $xtags=M("alltags")->select();
		foreach($xtags as $key =>$val){
					foreach($data as $key2 =>$val2){
					    if($val2['tags'] && in_array($val['title'],array_filter(explode(" ",$val2['tags'])))){
                            $newoo[$val['title']]['articleid'][$key2]=$val2['id'];
							$newoo[$val['title']]['id']=$val['id'];
					    }
					}
		}
		foreach($newoo as $val){
		        $re=M("alltags")->where(array('id'=>$val['id']))->data(array('allarticle'=>implode(',',$val['articleid'])))->save();
				if($re>0){
					echo $modname."文章id=".$val['id']."添加到对应id成功<br />";
				}
		}
	}
}
?>