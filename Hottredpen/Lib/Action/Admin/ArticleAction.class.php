<?php
	/**
	*
	*文章类管理
	*
	*/
defined('THINK_PATH') or exit();
class ArticleAction extends AdminAction {
	/**
	*
	*文章类所有列表选项
	*
	*/
    public function _initialize(){
	    parent::_initialize();
		$lanmu_id_entitle=F("lanmu_id_entitle");
        $this->listarr=$lanmu_id_entitle;
		$this->assign("lanmu_id_entitle",$lanmu_id_entitle);
	}
	/**
	*
	*栏目列表
	*
	*/
	public function lanmu(){
	  $mod = M("lanmu");
	  $lanmulist = $mod->field("id,pid,order,title,entitle,isxihua,keywords,description,concat(idtree,'-',id) as absPath")->order("absPath,id")->select();	
	  $this->assign("lanmulist",$lanmulist);
	  $this->display();
	}
	/**
	*
	*添加栏目
	*
	*/
	public function addlanmu(){
	    //如果是添加子栏目，则获取pid
	    $pid=$this->_get('pid');
		$user_id = $_SESSION['admin_uid'] ?$_SESSION['admin_uid'] : 0;
		if($pid){
			$pdata = M("lanmu")->where("id=".$pid)->find();
			$idtree=$pdata['idtree']."-".$pid;
			$pdata['neworder'] = intval($pdata['order'])+1;
			$pdata['newidtree'] = $pdata['idtree']."-".$pdata['id'];
		}else{
			$pdata=0;
			$pid=0;
			$idtree=0;
		}
		$this->assign('user_id',$user_id);
		$this->assign('pid',$pid);
		$this->assign('idtree',$idtree);
		$this->assign('pdata',$pdata);
		$this->display();
	}
	/**
	*
	*保存栏目
	*
	*/
    public function savelanmu(){
        $add = M("lanmu");
		$_POST['addtime']=time();
		if($add->create()){
			$re = $add->add();
			if($re){
			    F("huancun",null);
				$this->AdminLog("栏目id=".$re ."添加成功");//后台操作
				$this->success( "栏目id=".$re ."添加成功","lanmu"); 
				
			}else{
				$this->AdminLog("栏目添加失败");//后台操作
				$this->error( "栏目添加失败","lanmu"); 
			}
		}else{
			$this->error("添加失败");
		}
	}
	/**
	*
	*编辑栏目
	*
	*/
	public function editlanmu(){
	    $id=$this->_get('id');
		if(!$id){
			$this->error("请选择栏目");
		}
		$mod = M("lanmu");	
		$thisdata = $mod->where("id=".$id)->find();
		//$thisdata['newOrder'] = intval($thisdata['order']);
		$pdata = $mod->where("id=".$thisdata['pid'])->find();	
		if(!$pdata){
			$pdata['title']='顶级类目';
		}
		$this->assign('thisdata',$thisdata);
		$this->assign('pdata',$pdata);
		$this->display();
	}
	/**
	*
	*更新栏目
	*
	*/
    public function updatelanmu(){
	    $id=$_POST['id'];
        $c = M("lanmu");
		if($c->create()){
			$re = $c->save();
			if($re){
			    F("huancun",null);
				$this->AdminLog("栏目id=".$id."修改成功");//后台操作
				$this->success("栏目id=".$id."修改成功","lanmu"); 
			}else{
				$this->AdminLog("栏目id=".$id."修改失败");//后台操作
				$this->error( "栏目id=".$id."修改失败","lanmu"); 
			}
		}else{
			$this->error($c->getError());
		}
	}
	/**
	*
	*删除栏目
	*
	*/
	public function dellanmu(){
		$c=M("lanmu");
		$data=$c->select();
		$id=$_GET['id'];
		foreach($data as $key =>$val){
			if($id==$val['pid']){
			    $this->error("没法直接删除，下面还有子栏目");
			}
		}

		$re=$c->where(array('id'=>$id))->delete();
		if($re){
		    $this->AdminLog("管理员删除id=".$id."系统参数成功");//后台操作
			F('huancun',NULL);
		    $this->success("管理员删除id=".$id."系统参数成功", "__URL__/lanmu");
		}else{
		    $this->AdminLog("管理员删除id=".$id."系统参数失败");//后台操作
		    $this->error($c->getError());
		}
	}
	/**
	*
	*文章类(empty动作)
	*
	*/
	public function _empty(){
	    $action=strtolower(ACTION_NAME);
		/**
		*文章类List
		*/
		if(strstr($action,"list")){
			$mod=str_replace("list",'',$action);
			$year=$_GET['year']?$_GET['year']:0;
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			$article['mod']=$mod;
			$article[$year]=$year;
			$this->assign('article',$article);
			//进入对应的list动作
            $this->empty_list($mod,$year);
		/**
		*文章类Add
		*/			
		}else if(strstr($action,"add")){
			$mod=str_replace("add",'',$action);
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
            $this->empty_add($mod);	
	    }else if(strstr($action,"save")){
			$mod=str_replace("save",'',$action);
			$pdata=$_POST;
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			$lanmu_entitle_id=F("lanmu_entitle_id");
			$catid=$lanmu_entitle_id[$mod];
			//进入对应的add动作
            $this->empty_save($mod,$pdata,$catid);	
		}else if(strstr($action,"content")){
			$mod=str_replace("content",'',$action);
			$pid=$_GET['pid'];
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			$article=M($mod)->where(array('id'=>$pid))->find();
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			$article['mod']=$mod;
		    $this->assign('article',$article);
			//进入对应的add动作
            $this->empty_content($mod,$pid);	
		}else if(strstr($action,"tianduan")){
			$mod=str_replace("tianduan",'',$action);
			$pid=$_GET['pid'];
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			$article=M($mod)->where(array('id'=>$pid))->find();
			//article
			$lanmu_entitle_title=F("lanmu_entitle_title");
			$article['modname']=$lanmu_entitle_title[$mod];
			$article['mod']=$mod;
		    $this->assign('article',$article);
			//进入对应的add动作
            $this->empty_tianduan($mod,$pid);	
		}else if(strstr($action,"baoduan")){
			$mod=str_replace("baoduan",'',$action);
			$pdata=$_POST;
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//进入对应的add动作
            $this->empty_baotianduan($mod,$pdata);
        }else if(strstr($action,"delduan")){
			$mod=str_replace("delduan",'',$action);
			$pdata=$_POST;
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//进入对应的add动作
            $this->empty_delduan($mod,$pdata);
        }else if(strstr($action,"delarticle")){
			$mod=str_replace("delarticle",'',$action);
			$pid=$_GET['pid'];
			$arr=$this->listarr;
			if(!in_array($mod,$arr)){
				$this->error("错误的地址！");
			}
			//进入对应的add动作
            $this->empty_delarticle($mod,$pid);
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
        }			


	}
	protected function empty_list($mod,$year){
		switch($year){
			case "0":
				$where="isfabu=0";
				break;
			default:
				$where="isfabu=1";
				break;
		}
		$model = M($mod);
		import('ORG.Util.Page');// 导入分页类
		$count      = $model->where($where)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $model->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
	
	    $this->assign('list',$list);// 赋值数据集
	    $this->assign('Page',$show);// 赋值分页输出				
	    $this->display("List");	
	}
	/**
	*
	*添加文章
	*
	*/
	protected function empty_add($mod){
		$this->display("Add");
	}
	/**
	*
	*保存文章
	*
	*/
	protected function empty_save($mod,$pdata,$catid){
	
			$pdata['catid']=$catid;
		    $content=$pdata['content'];	
			$pdata['addtime']=mktime();
			$pdata['yearmonth']=date("Ymd",$_POST['addtime']);
            /////////////content_arr///////////////
			    if(substr($content,-4)=="</p>"){
                    $content=substr($content,0,-4);//去除最后的</p>,防止多个空白数组
				}
				//以</p>为分割符号
	            $content_arr=explode('</p>',$content);
	            foreach($content_arr as $key =>$val){
				       //去掉<p>后放进数组里
	                   $content_arr[$key]=trim(str_replace('　　','',str_replace('<p>','',$val)));
					   if($content_arr[$key]=="<br />"){
					        $content_arr[$key]=null;
					   }
	            }
				//去空
				$content_arr=array_filter($content_arr);
				//概要
				$pdata['gaiyao']=$content_arr[0].$content_arr[1];
            //////////////////////////////////////
            if($content!=null){
			        $result=M($mod)->data($pdata)->add();
					if($result){
					    $id=$result;
		                $re=M($mod)->where(array('id'=>$id))->find();
						//生成indexid,重新提交
                        $pppdata['indexid']=substr(md5($re['id']."hott"), 2,14);
			            $ree=M($mod)->where(array('id'=>$re['id']))->save($pppdata);
						//p($content_arr);
						foreach($content_arr as $key =>$val){
						    $new_content_arr[$key]['pid']=$id;
						    $new_content_arr[$key]['duanid']=$key+1;
						    
							if(substr($val,0,4)=="<img"){
								$new_content_arr[$key]['leixing']=1;
								$arr_imgcs[$key]=explode('"',$val);
								$new_content_arr[$key]['content']=$arr_imgcs[$key][1];
							}else{
								$new_content_arr[$key]['leixing']=0;
								$new_content_arr[$key]['content']=$val;
							}
						
						}
						$content_see=serialize($new_content_arr);
						//找到文章接着处理123
						if($ree){
                            $contentdata['pid']=$id;
							$contentdata['content']=$content_see;
							$rre=M($mod."_content")->data($contentdata)->add();
							//判断
							if($rre>0){
							    $this->success("发表成功！",$mod."List");
							}else{
							    $this->error("发表失败！！",$mod."List");
							}
			            }else{
			                $this->error("没找到这文章");
			            }
					}else{
					    $this->error("添加失败1");
					}
			}else{
                    $this->error("添加失败!是否忘记了标题");
            }
	}
	/**
	*
	*查看文章内容
	*
	*/
	protected function empty_content($mod,$pid){
			$data=M($mod."_content")->where(array('pid'=>$pid))->find();
			$data_see=unserialize($data['content']);

		    $this->assign('list',$data_see);
			$this->assign('pid',$pid);
		    $this->display("content");
	}
	/**
	*
	*添加文章段落
	*
	*/
	protected function empty_tianduan($mod,$pid){
		    $this->assign('pid',$pid);
		    $this->display("Tianduan");
	}
	/**
	*
	*保存文章段落
	*
	*/
	protected function empty_baotianduan($mod,$pdata){
			$pid=$pdata['pid'];
			$duanid=$pdata['duanid'];
			
			
			$c=M($mod."_content");
			
			$data=$c->where(array('pid'=>$pid))->find();
			
			if($data){
			    //获取原有数组
			    $oldarr=unserialize($data['content']);
				
				if($oldarr){
			            $newarr=array(array(
						                    'pid'=>$pdata['pid'],
											'duanid'=>$pdata['duanid'],
											'leixing'=>$pdata['leixing'],
											'content'=>$pdata['content']
											));
				        $arr=array_merge($oldarr,$newarr);
							foreach($arr as $key =>$val){
								$data_see[$val['duanid']]=$val;
							}
							ksort($data_see);
				        $pdata['content']=serialize($data_see);
			    //原来是空的情况
			    }else{
						$pdata['content']=serialize(array(array(
													'pid'=>$pdata['pid'],
													'duanid'=>$pdata['duanid'],
													'leixing'=>$pdata['leixing'],
													'content'=>$pdata['content']
										)));
				}
				//因为是序列化，所以是保存
			    $result	=	$c->where(array('pid'=>$pid))->save($pdata);
			    if(false !== $result) {
                    $this->success("添加save成功");
		        }else{
			        $this->error('添加失败!');
		        }			
			
			}else{   
			        $pppdata['pid']=$pid;
				    $pppdata['content']=serialize(array(array(
												'pid'=>$pdata['pid'],
												'duanid'=>$pdata['duanid'],
												'leixing'=>$pdata['leixing'],
												'content'=>$pdata['content']
									)));
				//因为是序列化，所以是保存
			    $result	=$c->data($pppdata)->add();
			    if(false !== $result) {
                    $this->success("添加add成功");
		        }else{
			        $this->error('添加失败!');
		        }
			}
	}
	/**
	*
	*删除文章段落
	*
	*/
	protected function empty_delduan($mod,$pdata){
		$pid=$pdata['pid'];
		$delarr=$pdata['del'];
		
		$c=M($mod."_content");
		$data=$c->where(array('pid'=>$pid))->find();

		if($data){
			//获取原有数组
			$oldarr=unserialize($data['content']);
			
			if($oldarr){
				foreach($oldarr as $key =>$val){
					if(in_array($oldarr[$key]['duanid'],$delarr)){
						unset($oldarr[$key]);
					}
				}
			$pppdata['content']=serialize($oldarr);
			//原来是空的情况
			}
			$result	=$c->where(array('pid'=>$pid))->save($pppdata);
			if(false !== $result) {
				$this->success("删除成功");
			}else{
				$this->error('删除失败!');
			}			
		
		}
	}
	/**
	*
	*删除文章(移入回收站isfabu=0)
	*
	*/
	protected function empty_delarticle($mod,$pid){
	    $c=M($mod);
	    $data=$c->where(array('id'=>$pid,'isfabu'=>1))->find();
		if($data){
		    $pdata['isfabu']=0;
		    $re=$c->where(array('id'=>$pid))->save($pdata);
			if($re>0){
			    $this->success("移入回收站成功！");
			}else{
			    $this->error("移入回收站失败！");
			}
			
		}else{
		    $this->error('文章可能已经被删除或移入回收站');
		}
	
	}
	/**
	*
	*修改文章
	*
	*/
	protected function empty_editarticle($mod,$pid){
	        $c=M($mod);
	        $data=$c->where(array('id'=>$pid))->find();
			$this->assign('data',$data);
		    $this->assign('pid',$pid);
		    $this->display("Edit");
	}
	/**
	*
	*更新文章
	*
	*/
	protected function empty_updatearticle($mod,$pdata){
	        $c=M($mod);
			$pid=$pdata['id'];
			$re=$c->where(array('id'=>$pid))->save($pdata);
			if($re>0){
			    $this->success("更新文章成功！",$mod."list");
			}else{
			    $this->error("更新文章失败！",$mod."list");
			}
	}
	public function sumb(){
	    $img=$this->_get("img");
	
	    $this->assign('img',$img);
	    $this->display();
	}
	public function cutimg(){
	    $img=$this->_get("img");
	    
	
	    import('ORG.Util.Cutimages');
		$images = new Cutimages("file");
		
	    $image = ".".$img;
		$images->getImageInfo($image);
	    $res = $images->thumb($image,false,1,'jpg');
	    if($res == false){
		    echo "裁剪失败";
	    }elseif(is_array($res)){
		    echo '<img src="/'.$res['big'].'" style="margin:10px;">';
		    echo '<img src="/'.$res['small'].'" style="margin:10px;">';
	    }
	}
}
?>