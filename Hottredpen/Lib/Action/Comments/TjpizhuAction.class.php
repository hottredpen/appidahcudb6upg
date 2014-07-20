<?php

/**
 * 评论
 * Some rights reserved：abc3210.com
 * Contact email:admin@abc3210.com
 */
class TjpizhuAction extends Action {

    //显示,json格式
    public function C_duanyi() {
		$catid=$_POST["catid"];
        //获取表名
		$lanmu_id_entitle=F('lanmu_id_entitle');
        $tablename = $lanmu_id_entitle[$catid];
        if (empty($tablename)) {
            exit;
        }
		
		$pid=$_POST["pid"];
		$uid=$_POST["uid"];
		$duanid=$_POST["duanid"];
        //查找
        $data=M($tablename."_jiexi")->where(array('pid'=>$pid,'duanid'=>$duanid,'uid'=>$uid))->find();
		

		if($data){
				$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><div class="clean"></div>
										<form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_duanyi" method="post">
											<table width="100%" id="general-table">
												<tr>
													<td class="label label-default">批注该段:</td>
												</tr>
												<tr>
													<td><textarea name="duanyi" class="form-control" rows="6">'.$data['duanyi'].'</textarea> </td>
														<input type="hidden" name="id" value="'.$data['id'].'">
														<input type="hidden" name="duanid" value="'.$duanid.'">
														<input type="hidden" name="catid" value="'.$catid.'">
												</tr>
											</table>
											<div class="btn_wrap">
											   <div class="btn_wrap_pd">
													 <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
											   </div>
											</div>
										</form>
								</div>';
		}else{
				$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><div class="clean"></div>
										<form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_duanyi" method="post">
											<table width="100%" id="general-table">
												<tr>
													<td class="label label-default">批注该段:</td>
												</tr>
												<tr>
													<td> <textarea name="duanyi" class="form-control" rows="6"></textarea> </td>
													<input type="hidden" name="pid" value="'.$pid.'">
													<input type="hidden" name="uid" value="'.$uid.'">
													<input type="hidden" name="duanid" value="'.$duanid.'">
													<input type="hidden" name="catid" value="'.$catid.'">
												</tr>
											</table>
											<div class="btn_wrap">
											   <div class="btn_wrap_pd">
													 <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
											   </div>
											</div>
										</form>
								</div>';
		}
        //返回输出
		echo json_encode($return);		

    }
	//提交
	public function T_duanyi(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
		
	        $id=$_POST['id'];//如果存在id时有用
			$pid=$_POST['pid'];
			$uid=$_POST['uid'];
			$duanid=$_POST['duanid'];
			$duanyi=$_POST['duanyi'];

			$cc=M($tablename."_jiexi");

		    if(!$cc->create()) {
			        $this->error($cc->getError());
		    }
			//修改		
			if($id){
			    $result	=	$cc->save();
				if(false !== $result) {
                        $return['info']="更新成功";
						$return['btn']="duanyi";
						$return['duanyi']=$duanyi;
						$return['duanid']=$duanid;
                        echo json_encode($return);							
				}else{
                        echo json_encode(null);	
				}					
			//新建
			}else{
			    $result	=	$cc->add();
			    if(false !== $result) {
                        $return['info']="添加成功";
						$return['btn']="duanyi";
						$return['duanyi']=$duanyi;
						$return['duanid']=$duanid;
                        echo json_encode($return);	
				}else{
						echo json_encode(null);	
				}
			}
			
			

	
	}
	public function C_gaiyao(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
			$pid=$_POST["pid"];
			$uid=$_POST["uid"];

		//查询
        $data=M($tablename."_jiexi_one")->where(array('pid'=>$pid,'uid'=>$uid))->find();
        //返回
		if($data){
				$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><div class="clean"></div>
								<form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_gaiyao" method="post">
									<table width="100%" id="general-table">
										<tr>
											 <td class="label label-default">提交的概要:</td>
										</tr>
                                             <td> <textarea name="gaiyao" class="form-control" rows="6">'.$data['gaiyao'].'</textarea> </td>
								                    <input type="hidden" name="id" value="'.$data['id'].'">
													<input type="hidden" name="catid" value="'.$catid.'"
										<tr>
										</tr>
									</table>
									<div class="btn_wrap">
									   <div class="btn_wrap_pd">
											 <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
									   </div>
									</div>
								</form>
							</div>';
		}else{
				$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><div class="clean"></div>
								<form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_gaiyao" method="post">
									<table width="100%" id="general-table">
										<tr>
											 <td class="label label-default">提交的概要:</td>
										</tr>
                                             <td> <textarea name="gaiyao" class="form-control" rows="6"></textarea> </td>\
												    <input type="hidden" name="pid" value="'.$pid.'">\
								                    <input type="hidden" name="uid" value="'.$uid.'">\
													<input type="hidden" name="catid" value="'.$catid.'">
										<tr>
										</tr>
									</table>
									<div class="btn_wrap">
									   <div class="btn_wrap_pd">
											 <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
									   </div>
									</div>
								</form>
							</div>';
		}	
        //返回输出
		echo json_encode($return);	
	}
	public function T_gaiyao(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
	        $id=$_POST['id'];//如果存在id时有用
			$pid=$_POST['pid'];
			$uid=$_POST['uid'];
			$gaiyao=$_POST['gaiyao'];

			$cc=M($tablename."_jiexi_one");

		    if(!$cc->create()) {
			        $this->error($cc->getError());
		    }
			//修改		
			if($id){
			    $result	=	$cc->save();
				if(false !== $result) {
                        $return['info']="更新成功";
						$return['btn']="gaiyao";
						$return['gaiyao']=$gaiyao;
						$return['duanid']=$duanid;
                        echo json_encode($return);	
				}else{
                        echo json_encode(null);
				}					
			//新建
			}else{
			    $result	=	$cc->add();
			    if(false !== $result) {
                        $return['info']="添加成功";
						$return['btn']="gaiyao";
						$return['gaiyao']=$gaiyao;
						$return['duanid']=$duanid;
                        echo json_encode($return);	
				}else{
                        echo json_encode(null);
				}
			}
	}
	public function C_huaju(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
			$pid=$_POST["pid"];
			$uid=$_POST["uid"];
			$duanid=$_POST["duanid"];
			$txt=$_POST["txt"];


        $data=M($tablename."_jiexi")->where(array('pid'=>$pid,'duanid'=>$duanid,'uid'=>$uid))->find();

        //返回
		if($data){
		        if($txt){
						$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a>
												  <form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_huaju" method="post">
														<table width="100%" id="general-table">
															<tr>
																<td class="label label-default">批注文字:</td>
																<td><input type="text"name="huaju" value="'.$txt.'"></td>
																<input type="hidden" name="id" value="'.$data['id'].'">
																<input type="hidden" name="duanid" value="'.$duanid.'">
																<input type="hidden" name="catid" value="'.$catid.'">
																<input type="hidden" name="uid" value="'.$uid.'">
															</tr>
															<tr>
																<td class="label label-default">class:</td>
																<td>
																	<select  name="class">
																		   <option value="1">划线</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td class="label label-default">Tags:</td>
																<td><input type="text" name="tags" value="">(可不填)</td>
															</tr>
														</table>
												  <div class="btn_wrap">
														 <div class="btn_wrap_pd">
															  <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
														</div>
												  </div>
												  </form>
										</div>';				
				}else{
					$zhaiarr=unserialize($data['huaju']);
					if($zhaiarr){
					    $yuyuy="";
					    foreach($zhaiarr as $key =>$val){
						    $yuyuy.='<tr><td>'.$val['huaju'].'</td><td class="text-info">'.$val['tags'].'</td><td>删除<input name="del['.$key.']" type="checkbox" value="0"></td></tr>';
						}
						$return['html']='<div class="alert alert-warning"><span class="text-muted pull-left">jk-kj：如果在已批注句子上再批注，请选择“批注字词”</span><a class="close" data-dismiss="alert" href="#">&times;</a><div class="clean"></div>
												  <form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=del_huaju" method="post">
												  <table width="100%" id="general-table">
                                                            <tr>
								                            <td class="col-sm-5"><span class="label label-default">选择文字:</span></td><td class="col-sm-5"><span class="label label-default">当前批注:</span></td><td class="col-xs-1"><span class="label label-default">是否删除</span></td>
									                            <input type="hidden" name="id" value="'.$data['id'].'">
													            <input type="hidden" name="duanid" value="'.$duanid.'">
													            <input type="hidden" name="catid" value="'.$catid.'">
													            <input type="hidden" name="uid" value="'.$uid.'">
											                </tr>
															'.$yuyuy.'
															</table>
												  <div class="btn_wrap">
														<div class="btn_wrap_pd">
															 <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
														</div>
												  </div>
												  </form>
										</div>';
					}else{
						$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a>
										<p>没有内容！（选中本段文字，点击“批注句子”按钮）</p>
										</div>';
					}
				
				}

		}else{
		    if($txt){
				$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a>
													  <form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_huaju" method="post">
															<table width="100%" id="general-table">
																   <tr><td class="label label-default">批注文字:</td><td> <input type="text"name="huaju" value="'.$txt.'"></td>
																		<input type="hidden" name="pid" value="'.$pid.'">
																		<input type="hidden" name="duanid" value="'.$duanid.'">
																		<input type="hidden" name="catid" value="'.$catid.'">
																		<input type="hidden" name="uid" value="'.$uid.'">
																		</tr>
																		<tr>
																		<td class="label label-default">class:</td>
																		<td>
																			<select  name="class">
																				   <option value="1">划线</option>
																			</select>
																		</td>
																   </tr>
																   <tr>
																		<td class="label label-default">Tags:</td>
																		<td><input type="text" name="tags" value="">(可不填)</td>
																   </tr>
															</table>
													  <div class="btn_wrap">
															 <div class="btn_wrap_pd">
																  <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
															</div>
													  </div>
													  </form>
			                    </div>';			
			}else{
						$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a>
										<p>没有内容！（选中本段文字，点击“批注句子”按钮）</p>
										</div>';
			}

		}	
        //返回输出
		echo json_encode($return);	
		
		


			
	}
	//提交
	public function T_huaju(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
	        $id=$_POST['id'];
			$uid=$_POST['uid'];
			$pid=$_POST['pid'];
			$duanid=$_POST['duanid'];

			$c=M($tablename."_jiexi");
			
			$data=$c->where(array('id'=>$id))->find();

			if($data){
			    //获取原有数组
			    $oldarr=unserialize($data['huaju']);
				
				if($oldarr){
			            $newarr=array(array(
						                    'class'=>$_POST['class'],
											'huaju'=>$_POST['huaju'],
											'tags'=>$_POST['tags'],
											'uid'=>$uid
											));
				        $arr=array_merge($oldarr,$newarr);
				        $_POST['huaju']=serialize($arr);
	        
			    //原来是空的情况
			    }else{
				    $_POST['huaju']=serialize(array(array(
					                                       'class'=>$_POST['class'],
														   'huaju'=>$_POST['huaju'],
														   'tags'=>$_POST['tags'],
														   'uid'=>$uid
														   )));
				}
				//修改
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
			    $result	=	$c->save();
			    if(false !== $result) {
					    $return['info']="更新成功";
						$return['btn']="huaju";
						$return['duanid']=$duanid;
                        echo json_encode($return);	
		        }else{
                        echo json_encode(null);
		        }				
			}else{
				$_POST['huaju']=serialize(array(array(
					                                       'class'=>$_POST['class'],
														   'huaju'=>$_POST['huaju'],
														   'tags'=>$_POST['tags'],
														   'uid'=>$uid
														   )));

				//修改
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
			    $result	=	$c->add();
			    if(false !== $result) {
					    $return['info']="添加成功";
						$return['btn']="huaju";
						$return['duanid']=$duanid;
                        echo json_encode($return);	
		        }else{
			            echo json_encode(null);
		        }
			}
	

	
	}
	//删除
	public function del_huaju(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
	        $id=$_POST['id'];
			$uid=$_POST['uid'];//无批注时，post
			$pid=$_POST['pid'];
			$duanid=$_POST['duanid'];
			
			
			$delarr=$_POST['del'];

			$c=M($tablename."_jiexi");
			
			$data=$c->where(array('id'=>$id))->find();

			if($data){
			    //获取原有数组
			    $oldarr=unserialize($data['huaju']);
				
				if($oldarr){
                    foreach($oldarr as $key =>$val){
					     if($delarr[$key]=="0"){
						    $oldarr[$key]="";
						 }
					}
				$oldarr=array_values(array_filter($oldarr));
				
				
				$_POST['huaju']=serialize($oldarr);
	        
			    //原来是空的情况
			    }
				//修改
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
			    $result	=	$c->save();
			    if(false !== $result) {
					    $return['info']="更新成功";
						$return['btn']="huaju";
						$return['duanid']=$duanid;
                        echo json_encode($return);	
		        }else{
			            echo json_encode(null);
		        }				
			}
	

	
	}
	public function C_quanzi(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
			$pid=$_POST["pid"];
			$uid=$_POST["uid"];
			$duanid=$_POST["duanid"];
			$txt=$_POST["txt"];


        $data=M($tablename."_jiexi")->where(array('pid'=>$pid,'duanid'=>$duanid,'uid'=>$uid))->find();

        //返回
		if($data){
		        if($txt){
						$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a>
												  <form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_quanzi" method="post">
														<table width="100%" id="general-table">
															<tr>
																<td class="label label-default">批注文字:</td>
																<td><input type="text"name="quanzi" value="'.$txt.'"></td>
																<input type="hidden" name="id" value="'.$data['id'].'">
																<input type="hidden" name="duanid" value="'.$duanid.'">
																<input type="hidden" name="catid" value="'.$catid.'">
																<input type="hidden" name="uid" value="'.$uid.'">
															</tr>
															<tr>
																<td class="label label-default">class:</td>
																<td>
																	<select  name="class">
																		   <option value="1">划线</option>
																		   <option value="2">改正</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td class="label label-default">Tags:</td>
																<td><input type="text" name="tags" value="">(可不填)</td>
															</tr>
														</table>
												  <div class="btn_wrap">
														 <div class="btn_wrap_pd">
															  <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
														</div>
												  </div>
												  </form>
										</div>';				
				}else{
					$zhaiarr=unserialize($data['quanzi']);
					if($zhaiarr){
					    $yuyuy="";
					    foreach($zhaiarr as $key =>$val){
						    $yuyuy.='<tr><td>'.$val['quanzi'].'</td><td class="text-info">'.$val['tags'].'</td><td>删除<input name="del['.$key.']" type="checkbox" value="0"></td></tr>';
						}
						$return['html']='<div class="alert alert-warning"><span class="text-muted pull-left">jk-kj：如果在已批注句子上再批注，请选择“批注字词”</span><a class="close" data-dismiss="alert" href="#">&times;</a><div class="clean"></div>
												  <form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=del_quanzi" method="post">
												  <table width="100%" id="general-table">
                                                            <tr>
								                            <td class="col-sm-5"><span class="label label-default">选择文字:</span></td>
															<td class="col-sm-5"><span class="label label-default">当前批注:</span></td>
															<td class="col-xs-1"><span class="label label-default">是否删除</span></td>
									                            <input type="hidden" name="id" value="'.$data['id'].'">
													            <input type="hidden" name="duanid" value="'.$duanid.'">
													            <input type="hidden" name="catid" value="'.$catid.'">
													            <input type="hidden" name="uid" value="'.$uid.'">
											                </tr>
															'.$yuyuy.'
															</table>
												  <div class="btn_wrap">
														<div class="btn_wrap_pd">
															 <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
														</div>
												  </div>
												  </form>
										</div>';
					}else{
						$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a>
										<p>没有内容！（选中本段文字，点击“批注句子”按钮）</p>
										</div>';
					}
				
				}

		}else{
		    if($txt){
				$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a>
													  <form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_quanzi" method="post">
															<table width="100%" id="general-table">
																   <tr><td class="label label-default">批注文字:</td>
																       <td> <input type="text"name="quanzi" value="'.$txt.'"></td>
																		<input type="hidden" name="pid" value="'.$pid.'">
																		<input type="hidden" name="duanid" value="'.$duanid.'">
																		<input type="hidden" name="catid" value="'.$catid.'">
																		<input type="hidden" name="uid" value="'.$uid.'">
																		</tr>
																		<tr>
																		<td class="label label-default">class:</td>
																		<td>
																			<select  name="class">
																				   <option value="1">划线</option>
																				   <option value="2">改正</option>
																			</select>
																		</td>
																   </tr>
																   <tr>
																		<td class="label label-default">Tags:</td>
																		<td><input type="text" name="tags" value="">(可不填)</td>
																   </tr>
															</table>
													  <div class="btn_wrap">
															 <div class="btn_wrap_pd">
																  <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
															</div>
													  </div>
													  </form>
			                    </div>';			
			}else{
						$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a>
										<p>没有内容！（选中本段文字，点击“批注句子”按钮）</p>
										</div>';
			}

		}	
        //返回输出
		echo json_encode($return);	
		
		


			
	}
	//提交
	public function T_quanzi(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
	        $id=$_POST['id'];
			$uid=$_POST['uid'];
			$pid=$_POST['pid'];
			$duanid=$_POST['duanid'];

			$c=M($tablename."_jiexi");
			
			$data=$c->where(array('id'=>$id))->find();

			if($data){
			    //获取原有数组
			    $oldarr=unserialize($data['quanzi']);
				
				if($oldarr){
			            $newarr=array(array(
						                    'class'=>$_POST['class'],
											'quanzi'=>$_POST['quanzi'],
											'tags'=>$_POST['tags'],
											'uid'=>$uid
											));
				        $arr=array_merge($oldarr,$newarr);
				        $_POST['quanzi']=serialize($arr);
	        
			    //原来是空的情况
			    }else{
				    $_POST['quanzi']=serialize(array(array(
					                                       'class'=>$_POST['class'],
														   'quanzi'=>$_POST['quanzi'],
														   'tags'=>$_POST['tags'],
														   'uid'=>$uid
														   )));
				}
				//修改
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
			    $result	=	$c->save();
			    if(false !== $result) {
					    $return['info']="更新成功";
						$return['btn']="quanzi";
						$return['duanid']=$duanid;
                        echo json_encode($return);	
		        }else{
                        echo json_encode(null);
		        }				
			}else{
				$_POST['quanzi']=serialize(array(array(
					                                       'class'=>$_POST['class'],
														   'quanzi'=>$_POST['quanzi'],
														   'tags'=>$_POST['tags'],
														   'uid'=>$uid
														   )));

				//修改
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
			    $result	=	$c->add();
			    if(false !== $result) {
					    $return['info']="添加成功";
						$return['btn']="quanzi";
						$return['duanid']=$duanid;
                        echo json_encode($return);	
		        }else{
			            echo json_encode(null);
		        }
			}
	

	
	}
	//删除
	public function del_quanzi(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
	        $id=$_POST['id'];
			$uid=$_POST['uid'];//无批注时，post
			$pid=$_POST['pid'];
			$duanid=$_POST['duanid'];
			
			
			$delarr=$_POST['del'];

			$c=M($tablename."_jiexi");
			
			$data=$c->where(array('id'=>$id))->find();

			if($data){
			    //获取原有数组
			    $oldarr=unserialize($data['quanzi']);
				
				if($oldarr){
                    foreach($oldarr as $key =>$val){
					     if($delarr[$key]=="0"){
						    $oldarr[$key]="";
						 }
					}
				$oldarr=array_values(array_filter($oldarr));
				
				
				$_POST['quanzi']=serialize($oldarr);
	        
			    //原来是空的情况
			    }
				//修改
		        if(!$c->create()) {
			        $this->error($c->getError());
		        }
			    $result	=	$c->save();
			    if(false !== $result) {
					    $return['info']="更新成功";
						$return['btn']="quanzi";
						$return['duanid']=$duanid;
                        echo json_encode($return);	
		        }else{
			            echo json_encode(null);
		        }				
			}
	

	
	}
	public function C_buchong(){
		$catid=$_POST["catid"];
        //获取表名
		$lanmu_id_entitle=F('lanmu_id_entitle');
        $tablename = $lanmu_id_entitle[$catid];
        if (empty($tablename)) {
            exit;
        }
		
		$pid=$_POST["pid"];
		$uid=$_POST["uid"];
		$duanid=$_POST["duanid"];
		//防止某人刷数据库。锁定他不给提交
		if($uid==0){
		   $return['lock']=1;
		   $return['lockinfo']="您之前提交的内容，部分内容正在审核，暂时无法再添加！";
		}
				$return['html']='<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><div class="clean"></div>
		                        <form class="J_ajaxForm" action="/index.php?g=Comments&m=Tjpizhu&a=T_buchong" method="post">
                                    <table width="100%" id="general-table">
		                                <tr>
				                            <td class="label label-default">补充:</td>
							            </tr>
										<tr>
                                            <td> <textarea name="duanyi" class="form-control" rows="6"></textarea> </td>
												    <input type="hidden" name="pid" value="'.$pid.'">
								                    <input type="hidden" name="uid" value="'.$uid.'">
								                    <input type="hidden" name="duanid" value="'.$duanid.'">
													<input type="hidden" name="catid" value="'.$catid.'">
										</tr>
                                    </table>
									<div class="btn_wrap">
									   <div class="btn_wrap_pd">
                                             <button class="btn btn-default J_ajax_submit_btn" type="submit">提交</button>
                                       </div>
                                    </div>
                                </form>
			                </div>';
		//返回						
		echo json_encode($return);	
	
	}
	public function T_buchong(){
			$catid=$_POST["catid"];
			//获取表名
			$lanmu_id_entitle=F('lanmu_id_entitle');
			$tablename = $lanmu_id_entitle[$catid];
			if (empty($tablename)) {
				exit;
			}
			
	        //$id=$_POST['id'];//如果存在id时有用
			$pid=$_POST['pid'];
			$uid=$_POST['uid'];
			$duanid=$_POST['duanid'];
			$duanyi=$_POST['duanyi'];
			//$_POST['duanyi']= str_replace("/r", 'rl',nl2br($_POST['duanyi']));

			    //$c=M($tablename."_123");
			$cc=M($tablename."_jiexi");

		    if(!$cc->create()) {
			        $this->error($cc->getError());
		    }

			    $result	=	$cc->add();
			    if(false !== $result) {
/* 			    	$this->ajaxReturn(array(
                        'info' => '添加成功！',
                        'state' => 'success',
					    'duanyi'=>$_POST['duanyi'],
						'duanid' =>$duanid,
			            'referer' =>'',//跳转地址
						'isshuaxin' =>1,//是否刷新
                    ), 'JSON');  */
                        $return['info']="添加成功";
						$return['btn']="buchong";
						$return['duanyi']=$duanyi;
						$return['duanid']=$duanid;
                        echo json_encode($return);	
				}else{
                        echo json_encode(null);	
				}	

			
			

	
	}

}

?>
