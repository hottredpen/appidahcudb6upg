<?php

/**
 * 评论
 * Some rights reserved：abc3210.com
 * Contact email:admin@abc3210.com
 */
class IntomyurlAction extends Action {



    //显示信息评论,json格式
    public function makeurl() {

		$mokuai=$_GET["mokuai"];
		$pid=$_GET["pid"];
		$uid=$_SESSION['user_uid'];
 
        $c=M($mokuai);
		$ccc=M($mokuai."_jiexi_one");

        $indexid=$c->where(array('id'=>$pid))->find();
		$puid=$ccc->where(array('pid'=>$pid,'uid'=>$uid))->find();
		if($puid){			
            $url="/".$mokuai."/user/".$puid['indexpuid'];
        }else{
		    $_POST['pid']=$pid;
			$_POST['uid']=$uid;
		        if(!$ccc->create()) {
			        $this->error($ccc->getError());
		        }
		        $result	=	$ccc->add($_POST);
			if($result){
			    $_POST['indexpuid']=substr(md5($uid.$pid.$result), 2,14);
				$_POST['id']=$result;
			    $ccc->save($_POST);
			    $url="/".$mokuai."/user/".$_POST['indexpuid'];
			}
			
		}
	    if($uid==null){
         $this->ajaxReturn(array(
            'info' => '',
			'url'  =>'',
			'no_uid' =>true,
            'status' => true,
                ), 'JSONP'); 
		}else{
         $this->ajaxReturn(array(
            'info' => '',
			'url'  =>$url,
            'status' => true,
                ), 'JSONP');  		
		
		}
	

 
				
		//p($yuandata);
    }

 
}

?>
