<?php

/**
 * 评论
 * Some rights reserved：abc3210.com
 * Contact email:admin@abc3210.com
 */
class TihuanAction extends Action {



    //显示信息评论,json格式
    public function json() {
		$mokuai=$_POST["mokuai"];
		$pid=$_POST["pid"];
		$uid=$_POST["uid"];
		

			    $c=M($mokuai."_content");
				$cc=M($mokuai."_jiexi");
				$ccc=M($mokuai."_jiexi_one");


					//$jjg=D($this->bjkebiaoname);
                    $udata=$cc->where(array('pid'=>$pid,'uid'=>$uid))->select();		
				    //$ccg=D($this->kebiaoname);
					$yuandata11=$c->where(array('pid'=>$pid))->find();
					
					$yuandata=unserialize($yuandata11['content']);
					//
					$gydata=$ccc->where(array('pid'=>$pid,'uid'=>$uid))->find();
					

					    foreach($yuandata as $key =>$val){
						    if($udata!==null){
								//替换该段的内容
								for($i=0;$i<count($udata);$i++){
										if($yuandata[$key]['duanid']==$udata[$i]['duanid']){
							
											$yuandata[$key]['c_name']=make_u_str($yuandata[$key]['content'],unserialize($udata[$i]['huaju']),unserialize($udata[$i]['quanzi']));
											$yuandata[$key]['duanyi']=$udata[$i]['duanyi'];
											//break防止重复提交时出现多个该段，重复出现问题其他地方会解决
											break;
										}else{
											$yuandata[$key]['c_name']=$yuandata[$key]['content'];
										}
								}
							}else{
							    $yuandata[$key]['c_name']=$yuandata[$key]['content'];
							}
                        }
	
	    $username=M("user")->where(array('uid'=>$uid))->find();
		

         $this->ajaxReturn(array(
            'data' => $yuandata,
			'gydata'=>$gydata,
            'info' => '',
			'username'=>$username['username'],
            'status' => true,
                ), 'JSONP');   
				
		//p($yuandata);
    }

 
}

?>
