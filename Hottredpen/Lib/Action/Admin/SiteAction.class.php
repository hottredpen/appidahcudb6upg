<?php
	/**
	*
	*文章类管理
	*
	*/
defined('THINK_PATH') or exit();
class SiteAction extends AdminAction {
    public function _initialize(){
	    parent::_initialize();
        $this->listarr=array("jiaocailist","shujilist","zuowenlist","yygjlist");
	}
	/**
	*
	*栏目列表
	*
	*/
	public function index(){
	  $mod = M("Site_hott");
	  $site= $mod->field("id,pid,entitle,title,keyword,link,type,status,order,orde,concat(catpid,'-',id) as absPath")->order("absPath,id")->select();	
	  $this->assign('site',$site);
	  $this->display();
	}
	/**
	*
	*添加栏目
	*
	*/
	public function addSite(){
	    //如果是添加子栏目，则获取pid
	    $pid=$this->_get('pid');
		$user_id = $_SESSION['admin_uid'] ?$_SESSION['admin_uid'] : 0;
		if($pid){
			$list = D("Site_hott")->where("id=".$pid)->find();
			$catpid=$list['catpid']."-".$pid;
			$list['newOrder'] = intval($list['order'])+1;
		}else{
			$mod = D("Site_hott");
		    $field = "id,pid,concat(catpid,'-',id) as absPath,title,order";
		    $order = " absPath,id ";
			$site = $mod->field($field)->order($order)->select();
			$list=0;
			$pid=0;
			$catpid=0;
		}
		$this->assign('user_id',$user_id);
		$this->assign('pid',$pid);
		$this->assign('catpid',$catpid);
		$this->assign('site',$site);
		$this->assign('list',$list);
		$this->display();
	}
	
	//编辑栏目
	public function editSite(){
	    $id=$this->_get('id');
		if(!$id){
			$this->error("请选择栏目");
		}
		$mod = D("Site_hott");	
		$field = "id,pid,remark,concat(catpid,'-',id) as absPath,title,order";
		$order = " absPath,id ";
		$site = $mod->field($field)->order($order)->select();
		$list = $mod->where("id=".$id)->find();
		$list['newOrder'] = intval($list['order']);
		$sites = D("Site_hott")->where("id=".$list['pid'])->find();	
		if(!$sites){
			$sites['title']='顶级类目';
		}
		$this->assign('list',$list);
		$this->assign('site',$site);
		$this->assign('sites',$sites);
		$this->display();
	}
	
	//添加文章
	public function addArticle(){
		$id=$this->_get('id');
		$mod = D("Site_hott");
		//没有id,就显示所要添加的pid
		if(!$id){
			$field = "id,pid,concat(catpid,'-',id) as absPath,title,order";
			$order = " absPath,id ";
			$list = $mod->field($field)->where('type=2')->order($order)->select();
		}else{
		    $site = $mod->where("id=".$id)->find();
		}
		$user_id = $_SESSION['admin_uid'];
		$this->assign('site',$site);
		$this->assign('list',$list);
		$this->assign('user_id',$user_id);
		$this->display();		
	}
	
 	//保存添加文章
	public function saveArticle($id=0){
        $add = D("Article_add");
		$art = D("Article");
		if($add->create()){
			$ret1 = $add->add();
			if($ret1){
				if($art->create()){
					$art->fid = $ret1;
					$ret2 = $art->add();
					if($ret2){
						$this->Record('文章添加成功','__URL__/articleList');//后台操作
						$this->success("添加成功");
						//echo "添加成功";
					}else{
						$this->error( "添加失败art");
					//	echo "添加失败art";
					}
				}else{
					$this->Record('文章添加失败');//后台操作
					$this->error( "art不能添加");
					//echo "art不能添加";
				}
			}
		}else{
			$this->error("添加失败add");
			//echo "添加失败add";
		}

		
	} 	
	
	//显示文章
	public function articleList(){
	    //有id的情况是选项选择某pid的内容
		$id=$this->_get('id');
        if($id){
	        $where = "catid=".$id;
		}else{
			$where = "id>0";

		}
		$field = "id,pid,concat(catpid,'-',id) as absPath,title,order";
		$order = " absPath,id ";
		$site = D("Site_hott")->field($field)->where('type=2')->order($order)->select();
        if($id){
	       foreach($site as $k=>$v){
			   if(intval($v['id']) == $id){
				   $title = $v['title'];
			   }
		   }
		}else{
			$title = "显示全部";

		}		
		$mod = D("Article");
		
	    import('ORG.Util.Page');// 导入分页类
	    $count      = $mod->where($where)->count();// 查询满足要求的总记录数
	    $Page       = new Page($count,50);// 实例化分页类 传入总记录数和每页显示的记录数
	    $show       = $Page->show();// 分页显示输出
	  // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	    $list = $mod->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

	    $this->assign('list',$list);// 赋值数据集
	    $this->assign('Page',$show);// 赋值分页输出				
		$this->assign('site',$site);
		$this->assign('id',$id);
		$this->assign('title',$title);
	    $this->display();	
		
	}
	
	//修改文章
	public function editArticle(){
	    $id=$this->_get('id');
		if(!$id){
			$this->error("请先选择文章");
		}	
		$mod = D("Article");
		$list = $mod->where("id=".$id)->relation("Article_add")->find();	
		if(!$list){
			$this->error("找不到文章");
		}	
		$mod = D("Site_hott");
		$field = "id,pid,concat(catpid,'-',id) as absPath,title,order";
		$order = " absPath,id ";
		//site所有pid
		$site = $mod->field($field)->where('type=2')->order($order)->select();
		//sites当前pid
		$sites = $mod->where("id=".$list['catid'])->find();	
		$this->assign('site',$site);
		$this->assign('sites',$sites);
		$this->assign('list',$list);
		$this->display();			
	}
	
	//删除文章
	public function dellelist(){
		$id=$this->_get('id');
		if(!$id){
			$this->error("请先选择文章");
		}
		$mod = M("article");
		$mod_add = M("article_add");
		$dfdf=$mod->where('id='.$id)->find();
		$dele1=$mod->where('id='.$id)->delete();
		$dele2=$mod_add->where('id='.$dfdf['fid'])->delete();
		if($dele1 && $dele2){
			$this->Record('删除文章成功');//后台操作
			$this->success('删除成功');
		}else{
			
			$this->Record('删除文章失败');//后台操作
			$this->error("删除失败");
		}	
	}

		function do_caifen_img(){
		    $biaoname=$_GET['biaoname'];
			
			$c=M($biaoname."_123");
			$data=$c->where(array('leixing'=>'1'))->select();
            $c->create();			
			foreach($data as $key =>$val){
			
                $arr_imgcs[$key]=explode('"',$val['c_name']);

                $_POST['id']=$val['id'];
				$_POST['lxcs1']=$arr_imgcs[$key][1];
				$_POST['lxcs2']=$arr_imgcs[$key][3];
                $c->save($_POST);

			}
		    // p($data);
		}
		function do_leixing_pd(){
		    $biaoname=$_GET['biaoname'];
			
			$c=M($biaoname."_123");
			$data=$c->select();
            $c->create();			
			foreach($data as $key =>$val){
			    if(substr($data[$key]['c_name'],0,4)=="<img"){
                    $data[$key]['leixing']=1;
				}else{
				    $data[$key]['leixing']=0;
				}
                $_POST['id']=$val['id'];
				$_POST['leixing']=$data[$key]['leixing'];
                $c->save($_POST);

			}
		    // p($data);
		}
		
		
		
		
		//显示所有段落
		public function show123(){
		    //获取全部enname
		    $arr=F("site_hott_catid_catenname");
			$mod=$this->_get('mod');
		    if(!in_array($mod,$arr)){
		        $this->error("错误的地址！");
		    }
			$id=$this->_get('pid');
			$data=M($mod."_content")->where(array('pid'=>$id))->find();
			$data_see=unserialize($data['content']);
			$article=M($mod)->where(array('id'=>$id))->find();
			        $getcatname=F('site_hott_catenname_catname');
				    $article['modname']=$getcatname[$mod];
					$article['mod']=$mod;
		    $this->assign('article',$article);
		    $this->assign('list',$data_see);
			$this->assign('pid',$id);
		    $this->display();

            //p($data_see);
		}

		//添加段落
		public function add123(){
		    //获取全部enname
		    $arr=F("site_hott_catid_catenname");
			$mod=$this->_get('mod');
		    if(!in_array($mod,$arr)){
		        $this->error("错误的地址！");
		    }
		    $pid=$this->_get('pid');
			$article=M($mod)->where(array('id'=>$pid))->find();
			        $getcatname=F('site_hott_catenname_catname');
				    $article['modname']=$getcatname[$mod];
					$article['mod']=$mod;
		    $this->assign('article',$article);
		    $this->assign('pid',$pid);
		    $this->display();
		}
		//保存添加段落
		public function addsave123(){
		    $mokuai=$_POST["mod"];
			//防止查询其他模块
			if(!in_array($mokuai,array('yygj','zuowen','shuji','jiaocai'))){
				exit;
			}
			$pid=$_POST['pid'];
			$duanid=$_POST['duanid'];
			
			
			$c=D($mokuai."_content");
			
			$data=$c->where(array('pid'=>$pid))->find();
			
			if($data){
			    //获取原有数组
			    $oldarr=unserialize($data['content']);
				
				if($oldarr){
			            $newarr=array(array(
						                    'pid'=>$_POST['pid'],
											'duanid'=>$_POST['duanid'],
											'leixing'=>$_POST['leixing'],
											'content'=>$_POST['content']
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
													'pid'=>$_POST['pid'],
													'duanid'=>$_POST['duanid'],
													'leixing'=>$_POST['leixing'],
													'content'=>$_POST['content']
										)));
				}
				//修改
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
				//因为是序列化，所以是保存
			    $result	=	$c->where(array('pid'=>$pid))->save($pdata);
			    if(false !== $result) {
                    $this->success("添加save成功");
		        }else{
			        $this->error('添加失败!');
		        }			
			
			}else{   
			        $pdata['pid']=$pid;
				    $pdata['content']=serialize(array(array(
												'pid'=>$_POST['pid'],
												'duanid'=>$_POST['duanid'],
												'leixing'=>$_POST['leixing'],
												'content'=>$_POST['content']
									)));
				//添加
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
				//因为是序列化，所以是保存
			    $result	=	$c->add($pdata);
			    if(false !== $result) {
                    $this->success("添加add成功");
		        }else{
			        $this->error('添加失败!');
		        }
			}
			
			
			
		}
        //删除段落
		public function del123(){
		    $mokuai=$_POST["mod"];
			//防止查询其他模块
			if(!in_array($mokuai,array('yygj','zuowen','shuji','jiaocai'))){
				exit;
			}
			$pid=$_POST['pid'];
			$duanid=$_POST['duanid'];
			$delarr=$_POST['del'];
			
			$c=M($mokuai."_content");
			
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
				$pdata['content']=serialize($oldarr);
	            //$_POST['id']=$pid;
			    //原来是空的情况
			    }
				//修改
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
			    $result	=	$c->where(array('pid'=>$pid))->save($pdata);
			    if(false !== $result) {
                    $this->success("删除成功");
		        }else{
			        $this->error('删除失败!');
		        }			
			
			}
		}
		//修改文章
		public function edit(){
		    //获取全部enname
		    $arr=F("site_hott_catid_catenname");
			$mod=$this->_get('mod');
		    if(!in_array($mod,$arr)){
		        $this->error("错误的地址！");
		    }
		    $id=$this->_get('id');
			$article=M($mod)->where(array('id'=>$id))->find();
			        $getcatname=F('site_hott_catenname_catname');
				    $article['modname']=$getcatname[$mod];
					$article['mod']=$mod;
			$site = M("Site_hott");
			$field = "id,pid,concat(catpid,'-',id) as absPath,title,order";
			$order = " absPath,id ";
			$list = $site->where(array('id'=>$article['catid']))->find();
			$sitelist = $site->field($field)->where(array('pid'=>$list['pid'],'iswanjie'=>0))->order($order)->select();
		    $this->assign('article',$article);
			$this->assign('catid',$article['catid']);
			$this->assign('sitelist',$sitelist);
			$this->assign('list',$article);
		    $this->display();

		}
		//准备添加文章
		public function addhott(){
		    //获取全部enname
		    $arr=F("site_hott_catid_catenname");
			$mod=$this->_get('mod');
		    if(!in_array($mod,$arr)){
		        $this->error("错误的地址！");
		    }
			        //获取栏目id
			        $getcatid=F("site_hott_catenname_catid");
			        $pid=$getcatid[$mod];
					//
			        $getcatname=F('site_hott_catenname_catname');
				    $article['modname']=$getcatname[$mod];
					$article['mod']=$mod;
			$user_id = $_SESSION['admin_uid'];
			$site = D("Site_hott");	
			$newarr=$site->returntree($pid);
		    $this->assign('article',$article);
			$this->assign('list',$newarr);
			$this->assign('user_id',$user_id);
		    $this->display();
			p($newarr);
		}
		//保存添加文章
		public function savehott(){
			$catid=$_POST['catid'];
		    $content=$_POST['content'];			
			//获取模块名
			$getmodenname=F("site_hott_catid_modenname");
			$mokuai=$getmodenname[$catid];
			//处理提交内容

			$_POST['addtime']=mktime();
			$_POST['yearmonth']=date("Ymd",$_POST['addtime']);
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
				$_POST['gaiyao']=$content_arr[0].$content_arr[1];
            //////////////////////////////////////
            if($catid!=0 && $content!=null){
			        $result=M($mokuai)->add($_POST);
					if($result){
					    $id=$result;
		                $re=M($mokuai)->where(array('id'=>$id))->find();
						//生成indexid,重新提交
                        $_POST['indexid']=substr(md5($re['id']."hott"), 2,14);
				        $_POST['id']=$re['id'];
			            $ree=M($mokuai)->save($_POST);
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
			                    $rre=M($mokuai."_content")->query("INSERT INTO `".C("DB_NAME")."`.`".C("DB_PREFIX").$mokuai."_content` (
                                   `id` ,`pid` ,`content`
                                )VALUES (
                                   '".$id."' , '".$id."', '".$content_see."'
                                );","","");
								

							//判断
							if($rre>0){
							    $this->success("发表成功！",$mokuai."List");
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

	//显示List
	public function _empty(){
	    $action=strtolower(ACTION_NAME);
		$arr=$this->listarr;
		if(!in_array($action,$arr)){
		    $this->error("错误的地址！");
		}
	    $mod=str_replace("list",'',$action);
			        $getcatname=F('site_hott_catenname_catname');
				    $article['modname']=$getcatname[$mod];
					$article['mod']=$mod;
		//显示查看的catid
		$id=$this->_get('id')?$this->_get('id'):0;
			switch($id){
			    case "1":
				    $where="isfabu=0";
 				    break;
				default:
				    $where="catid=".$id;
					break;
			}
	    //
		$model = M($mod);
	    import('ORG.Util.Page');// 导入分页类
	    $count      = $model->where($where)->count();// 查询满足要求的总记录数
	    $Page       = new Page($count,50);// 实例化分页类 传入总记录数和每页显示的记录数
	    $show       = $Page->show();// 分页显示输出
	  // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	    $list = $model->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("id asc")->select();
		
			$getcatenname=F('site_hott_catid_catenname');
			$getcatname=F('site_hott_catid_catname');
            foreach((array)$list as $key =>$val){
			    $list[$key]['catenname']=$getcatenname[$val['catid']];
				$list[$key]['catname']=$getcatname[$val['catid']];
				$list[$key]['mod']=$mod;
			}
		//
		$getcatid=F('site_hott_catenname_catid');
		$catid=$getcatid[$mod];
		$site = D("Site_hott");	
        $newarr=$site->returntree($catid);
		$this->assign("selectsite",$newarr);
	    $this->assign('list',$list);// 赋值数据集
	    $this->assign('Page',$show);// 赋值分页输出				
		$this->assign('article',$article);
	    $this->display("List");	
	}

    public function Tags(){
	    $arr=F("site_hott_catid_catenname");
	    $mod=strtolower(ACTION_NAME);
		if(!in_array($mod,$arr)){
		    $this->error("错误的地址！");
		}
			        $getcatname=F('site_hott_catenname_catname');
				    $article['modname']=$getcatname[$mod];
					$article['mod']=$mod;
	    //
		$model = M($mod);
	    import('ORG.Util.Page');// 导入分页类
	    $count      = $model->where($where)->count();// 查询满足要求的总记录数
	    $Page       = new Page($count,50);// 实例化分页类 传入总记录数和每页显示的记录数
	    $show       = $Page->show();// 分页显示输出
	  // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	    $list = $model->limit($Page->firstRow.','.$Page->listRows)->order("tagid asc")->select();

	    $this->assign('list',$list);// 赋值数据集
	    $this->assign('Page',$show);// 赋值分页输出	
		$this->assign('article',$article);
        $this->display();
    }

    public function editags(){
	    $id=$this->_get('id');
		if(!$id){
			$this->error("请选择tagsID");
		}
		$model=M("Tags");
        $data=$model->where(array('tagid'=>$id))->find();
	    $this->assign('list',$data);// 赋值数据集
        $this->display();
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
	
    //排序修改
    public function order(){
	        $mod=$_GET['mod'];
            $Shuff=M($mod);
            $id=$this->_post('id');
			$orderid=$this->_post('orderid');
			$state=$this->_post('state');
			$data['id']			= $id;
			if(isset($orderid)){
			$data['orderid']	= $orderid;
			}else if(isset($state)){
			$data['state']		= $state;	
			}
			$Shuff->save($data);
    }
	
	
	
	public function zuowentags(){
	  $mod = M("zuowen_tags");
	  $tagsdata = $mod->field("id,pid,order,title,entitle,isxihua,concat(idtree,'-',id) as absPath")->order("absPath,id")->select();	
	  $this->assign("tagsdata",$tagsdata);
	  $this->display();

	}
	
	public function addzuowentags(){
	    //如果是添加子栏目，则获取pid
	    $pid=$this->_get('pid');
		$user_id = $_SESSION['admin_uid'] ?$_SESSION['admin_uid'] : 0;
		if($pid){
			$list = M("zuowen_tags")->where("id=".$pid)->find();
			$idtree=$list['idtree']."-".$pid;
			$list['newOrder'] = intval($list['order'])+1;
		}else{
			$list=0;
			$pid=0;
			$idtree=0;
		}
		$this->assign('user_id',$user_id);
		$this->assign('pid',$pid);
		$this->assign('idtree',$idtree);
		$this->assign('list',$list);
		$this->display();
	}
    public function savezuowentags(){
        $add = D("zuowen_tags");
		$_POST['addtime']=time();
		if($add->create()){
			$re = $add->add();
			if($re){
			    F("huancun",null);
				$this->Record('zuowentags添加成功');//后台操作
				$this->success( "zuowentags添加成功","zuowentags"); 
				
			}else{
				$this->Record('zuowentags添加失败');//后台操作
				$this->error( "zuowentags添加失败","zuowentags"); 
			}
		}else{
			$this->error("添加失败");
		}
	}
	public function editzuowentags(){
	    $id=$this->_get('id');
		if(!$id){
			$this->error("请选择栏目");
		}
		$mod = D("zuowen_tags");	
        //$tagsdata = $mod->field("id,pid,order,title,entitle,concat(idtree,'-',id) as absPath")->order("absPath,id")->select();
		$thisdata = $mod->where("id=".$id)->find();
		$thisdata['newOrder'] = intval($thisdata['order']);
		
		
		
		$pdata = $mod->where(array("id=".$thisdata['pid']))->find();	
		if(!$pdata){
			$pdata['title']='顶级类目';
		}
		$this->assign('thisdata',$thisdata);
		$this->assign('pdata',$pdata);
		$this->display();
	}
    public function updatazuowentags(){
        $add = D("zuowen_tags");
		if($add->create()){
			$re = $add->save();
			if($re){
			    F("huancun",null);
				$this->Record('zuowentags修改成功');//后台操作
				$this->success( "zuowentags修改成功","zuowentags"); 
				
			}else{
				$this->Record('zuowentags修改失败');//后台操作
				$this->error( "zuowentags修改失败","zuowentags"); 
			}
		}else{
			$this->error("修改失败");
		}
	}
    /************自动添加新增xitags*************/
 	public function savezuowenxitags(){
	    $c=M("zuowen");
		$data=$c->select();
		$new=array();
		foreach($data as $key => $val){
		    $new=array_merge(array_filter(explode(' ',$val['tags'])),$new);
		}
		$new=array_unique($new);
		
		$mod = M("zuowen_xi_tags");
	    $tagsdata = $mod->select();
		foreach($tagsdata as $key =>$val){
		    $nnn[$key]=$val['title'];
		}
		$newtags=array_diff($new,$nnn);
		if($newtags){
			foreach($newtags as $key =>$val){
				$ddas=M("zuowen_xi_tags")->data(array('title'=>$val))->add();
				if($ddas>0){
					echo "标签：".$val."=》添加ok<br />";
				}
			}
		}else{
		    $this->error("没有新增的xitags");
		}

	}
	public function zuowenxitags(){
	  $mod = M("zuowen_xi_tags");
	  $tagsdata = $mod->select();
	  $zuowen_tags_id_title=F("zuowen_tags_id_title");
      foreach($tagsdata as $key =>$val){
	      $tagsdata[$key]['ptitle']=$zuowen_tags_id_title[$val['pid']];
	  }
	  $this->assign("tagsdata",$tagsdata);
	  $this->display();
	}
	public function editzuowenxitags(){
	    $id=$this->_get('id');
		if(!$id){
			$this->error("请选择栏目");
		}
		$mod = D("zuowen_xi_tags");	
		$thisdata = $mod->where("id=".$id)->find();
		$thisdata['newOrder'] = intval($thisdata['order']);
		
		$cc = M("zuowen_tags");
		$tagsdata = $cc->field("id,pid,order,title,entitle,concat(idtree,'-',id) as absPath")->order("absPath,id")->select();
		
		
		$pdata = $mod->where("id=".$thisdata['pid'])->find();	
		if(!$pdata){
			$pdata['title']='未分类';
		}
		$this->assign('thisdata',$thisdata);
		$this->assign('tagsdata',$tagsdata);
		$this->assign('pdata',$pdata);
		$this->display();
	}
    public function updatazuowenxitags(){
        $add = D("zuowen_xi_tags");
		if($add->create()){
			$re = $add->save();
			if($re){
				$this->Record('zuowentags修改成功');//后台操作
				$this->success( "zuowentags修改成功","zuowenxitags"); 
			}else{
				$this->Record('zuowentags修改失败');//后台操作
				$this->error( "zuowentags修改失败","zuowenxitags"); 
			}
		}else{
			$this->error("修改失败");
		}
	}
	/*********细标签获取大标签id********/
	public function zuowenxitags_ztagsid(){
	    
		$xtags=M("zuowen_xi_tags")->select();
		foreach($xtags as $key =>$val){
		    //不存在ztagsid的情况下
		    if($val['pid']>0 && $val['ztagsid']==0){
			    $ztags[$key]=M("zuowen_tags")->where(array('id'=>$val['pid']))->find();
				if($ztags[$key]['order']==3){
				    $val['ztagsid']=$ztags[$key]['pid'];
				}else if($ztags[$key]['order']==2){
				    $val['ztagsid']=$val['pid'];
				}
				$re=M("zuowen_xi_tags")->where(array('id'=>$val['id']))->data(array('ztagsid'=>$val['ztagsid']))->save();
				if($re>0){
					echo "ok<br />";
				}
			}else{
			    echo "没有内容更新<br />";
			}

		}
	}
	
	/***********刷新每个细标签下的文章id组***************/
	public function zuowenxitags_allarticle(){
	    $data=M("zuowen")->where(array('isfabu'=>1))->select();
        $xtags=M("zuowen_xi_tags")->select();
		foreach($xtags as $key =>$val){
					foreach($data as $key2 =>$val2){
					    if($val2['tags'] && in_array($val['title'],array_filter(explode(" ",$val2['tags'])))){
                            $newoo[$val['title']]['articleid'][$key2]=$val2['id'];
							$newoo[$val['title']]['id']=$val['id'];
					    }
					}
		}
		foreach($newoo as $val){
		        $re=M("zuowen_xi_tags")->where(array('id'=>$val['id']))->data(array('allarticle'=>implode(',',$val['articleid'])))->save();
				if($re>0){
					echo "ok<br />";
				}else{
				    echo "没内容更新<br />";
				}
		}

	}
}
?>