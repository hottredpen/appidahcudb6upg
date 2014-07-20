<?php

defined('THINK_PATH') or exit();
class CenterAction extends HomeAction {
    function _initialize() {
	    parent::_initialize();
	    //会员是否登录验证
		$this->islogin();
	} 



//-------------个人中心--------------
//首页
	public function index(){

        //获取用户详情
		//$list=R('Sharing/user_details');	
		//$this->assign('list',$list);
		//$msgTools = A('msg','Event');
		//$msgCount = $msgTools->msgCount($this->_session('user_name'));
		//$this->assign('msgCount',$msgCount);
		//$head=$this->headPortrait('./Public/FaustCplus/php/img/big_user_'.$this->_session('user_uid').'.jpg');
		//$this->assign('heads',$head); 
		$this->assign("homeurl","->".$this->modname);
		$this->display();
    }

//认证中心	
	public function approve(){
		$unite=M('unite');
		$userinfo=M('userinfo');
		$list=$unite->field('name,value')->where('`state`=0 and `pid`=13')->order('`order` asc,`id` asc')->select();
		$this->assign('list',$list);
		$user_details=R('Sharing/user_details');
		$certification=$user_details[0][certification];
		$this->assign('user_details',$user_details);
		$userfo=$userinfo->field('qq,certification')->where('uid='.$this->_session('user_uid'))->find();

		$this->assign('certification',$certification);
		$this->assign('mid',$this->_get('mid'));
		//VIP
		$vip_points=M('vip_points');
		$vip_points=$vip_points->field('audit')->where(array('uid'=>$this->_session('user_uid')))->find();
		$this->assign('vip_points',$vip_points['audit']);
		$systems=$this->systems();
		$this->assign('systems',$systems);
		$endjs='
			/*
			*年月切换 
			*id		站内信ID
			*/
			 function vipmod(id){	
			 var length=$("#length").val();	//值
			 if(id){
				 $(".approve_vip a").removeClass("hove");
				 $("#vip_"+id).addClass("hove");
				 $("#mod").val(id);
			 }
			 	if(id==1){
					$("#year").html("月");
				}else if(id==2){
					$("#year").html("年");
				}
				var id=$("#mod").val();	//付费模式
				$(".approve_with").load("__URL__/vipAjax", {length:length,mod:id});
			 }
		';
		$this->assign('endjs',$endjs);
		$this->display();
    }
	
/* 	//手机手动认证
	function appphone(){
		$userinfo=D('Userinfo');
		if($create=$userinfo->create()){
			$create['cellphone_audit']=1;
			$userinfo->where(array('uid'=>$this->_session('user_uid')))->save($create);
			$this->success("申请成功");
		}else{
			$this->error($userinfo->getError());
		}
	} */
	
	//VIP显示费用
/* 	public function vipAjax(){
		$systems=$this->systems();
		if($this->_post('mod')==1){	//月
			$cost=$this->_post('length')*$systems['sys_vipm'];
		}else{
			$cost=$this->_post('length')*$systems['sys_vipy'];
		}
		echo $cost.'<input name="price" type="hidden" value="'.$cost.'" />';
	}
	
	//申请VIP
	public function updaVip(){
		//$this->homeVerify();
		$vip_points=M('vip_points');
		
		$money=M('money');
		$available_funds=$money->field('available_funds')->where('uid='.$this->_session('user_uid'))->find();	//可用余额
		if($available_funds['available_funds']<$this->_post('price')){
			$this->error("账户可用余额不足以开通VIP！",'__ROOT__/Center/fund/inject.html');
		}
		$save['audit']=1;
		$save['checktime']=time();
		$save['deadline']=$this->_post('length');
		$save['unit']=$this->_post('mod')==2?0:$this->_post('mod');
		$result = $vip_points->where(array('uid'=>$this->_session('user_uid')))->save($save);
		if($result){
			$this->userLog('申请VIP');//会员记录
			$this->success("申请成功");
		}else{
			$this->error("申请失败");
		}			 			
	} */
	
	//邮箱验证
	public function emailVerify(){
		$userinfo=M('user');
		$smtp=M('smtp_hott');
		$stmpArr=$smtp->find(1);
		$getfield = $userinfo->where("`id`=".$this->_session('user_uid')." and `email`='".$this->_post('email')."'")->find();
		if(!$getfield){		
			if($userinfo->create()){
				$result = $userinfo->where('`id`='.$this->_session('user_uid'))->save();
				if(!$result){
					$this->error("邮箱未能发送，请联系管理员");
				}		
			}else{
				$this->error($userinfo->getError());
			}
		}
		$stmpArr['receipt_email']	=$this->_post('email');
		$stmpArr['title']			="用户激活邮件";
		$stmpArr['content']			='<div>
											<p>您好，<b>'.$this->_session('user_name').'</b> ：</p>
										</div>
										<div style="margin: 6px 0 60px 0;">
											<p>欢迎加入<strong>'.$stmpArr['addresser'].'</strong>！请点击下面的链接来认证您的邮箱。</p>
											<p><a href="http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Center/emailVerifyConfirm/'.base64_encode($this->_session('user_uid')).'">http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Center/emailVerifyConfirm/'.base64_encode($this->_session('user_uid')).'</a></p>
											<p>如果您的邮箱不支持链接点击，请将以上链接地址拷贝到你的浏览器地址栏中认证。</p>
										</div>
										<div style="color: #999;">
											<p>发件时间：'.date('Y/m/d H:i:s').'</p>
											<p>此邮件为系统自动发出的，请勿直接回复。</p>
										</div>';
		$emailsend=R('Sharing/email_send',array($stmpArr));	

		if($emailsend){
			$this->success('邮件发送成功', '__ROOT__/Center/approve/email.html');
			//$userLog=R('Comm/userLog',array('邮件发送成功'));//会员记录
		}else{
			$this->error("邮箱激活失败，请联系管理员");
		}	
	}
	//邮箱验证确认
	public function emailVerifyConfirm(){
		//$this->homeVerify();
		$msgTools = A('msg','Event');
		$userinfo=M('userinfo');
		$username=base64_decode($this->_get('email_audit'));
			$emailVerifyConfirm['email_audit']=$username?2:0;
			$result = $userinfo->where("`uid`= ".$username)->save($emailVerifyConfirm);
			if($result){
			//记录添加点
			$sendMsg=$msgTools->sendMsg(3,'用户通过邮箱验证','用户通过邮箱验证','admin',$this->_session('user_uid'));//站内信
			$this->userLog('通过邮箱验证');//前台操作
			$arr['member']=array('uid'=>$this->_session('user_uid'),'name'=>'mem_email_audit');
			$vip_points=M('vip_points');	
			$vips=$vip_points->where('uid='.$this->_session('user_uid'))->find();
			if($vips['audit']==2){	//判断是不是开通了VIP
				$arr['vip']=array('uid'=>$this->_post('uid'),'name'=>'vip_email_audit');
			}
			$userss=M('user');
			$promotes=$userss->where('id='.$this->_session('user_uid'))->find();
			if($promotes['uid']){	//判断是不是有上线
				$arr['vip']=array('uid'=>$promotes['uid'],'name'=>'pro_email_audit');
			}
			$integralAdd=$this->integralAdd($arr);	//积分操作
				$this->success('邮箱已激活','__ROOT__/Center.html');
			}else{
				$this->error("邮箱激活失败，请联系管理员");
			}		
	}

//基本设置	
	public function basic(){

		$unite=M('unite_hott');
		$list=$unite->field('pid,name,value')->where('`state`=0 and `pid`=8 or `pid`=9 or `pid`=10 or `pid`=11 or `pid`=12')->order('`order` asc,`id` asc')->select();
		foreach($list as $lt){
			switch($lt[pid]){
				case 8:
				$education[]=$lt;
				break;
				case 9:
				$monthly_income[]=$lt;
				break;
				case 10:
				$housing[]=$lt;
				break;
				case 11:
				$buy_cars[]=$lt;
				break;
				case 12:
				$industry[]=$lt;
				break;
			}
		}
		$city	=	M('city');
		$city=$city->select();
		foreach($city as $cy){
			$citys[$cy['var']]=$cy[city];
		}
		$userinfo=M('userinfo');
		$userinfo=$userinfo->field('location,marriage,education,monthly_income,housing,buy_cars,qq,fixed_line,industry,company')->where('`uid`='.$this->_session('user_uid'))->order('`id` asc')->select();		
		$locationu=$userinfo[0]['location'];
		$sssss=explode("-",$locationu);
		foreach($sssss as $id=>$locations){
			$ggg[$id]=$citys[$locations];
		}
		$lon=implode("-",$ggg);
		$lonen=implode(",",$sssss);
		$userinfo[0]['location']=$lon;
		$this->assign('location',$lonen);
		$this->assign('userinfo',$userinfo);
		$this->assign('education',$education);
		$this->assign('monthly_income',$monthly_income);
		$this->assign('housing',$housing);
		$this->assign('buy_cars',$buy_cars);
		$this->assign('industry',$industry);
		$this->assign('list',$list);
		//站内信
		$endjs='
			/*
			*单条站内信显示AJAX 
			*shop猫
			*id		站内信ID
			*/
			 function msgcont(id){	
			 	var loading=\'<div class="invest_loading"><div><img src="__PUBLIC__/bootstrap/img/ajax-loaders/ajax-loader-1.gif"/></div><div>加载中...</div> </div>\';
				$("#basic_content").html(loading);	
				$("#basic_content").load("__URL__/stationview", {id:id});
			 }
		';
		$this->assign('endjs',$endjs);
		$msgTools = A('msg','Event');
		$msgCount = $msgTools->msgCount($this->_session('user_name'));
		if($this->_get('pid')=='unread'){	//未读
			$msgInfo = $msgTools->msgInfo($this->_session('user_name'),'unread');
		}else if($this->_get('pid')=='read'){	//已读
			$msgInfo = $msgTools->msgInfo($this->_session('user_name'),'read');
		}else if($this->_get('pid')=='inbox'){	//收件箱
			$msgInfo = $msgTools->msgInfo($this->_session('user_name'),'inbox');
		}else{	//全部
			$msgInfo = $msgTools->msgInfo($this->_session('user_name'));
			$msgInfo = $msgInfo['outbox'];
		}
		$this->assign('msgInfo',$msgInfo);	
        $msgTools->msgPage($this->_session('user_name'));
		$this->assign('msgCount',$msgCount);		
		$this->assign('mid',$this->_get('mid'));
		$active['center']='active';
		$this->assign('active',$active);
		//邀请好友
		$lsuid=$_SERVER['HTTP_HOST']."/Logo/register.html?".base64_encode("lsuid=".$this->_session('user_uid'));
		$this->assign('lsuid',$lsuid);
		

		$this->display();
    }
	
	//查看站内信
	public function stationview(){

		$msgTools = A('msg','Event');
		$instation=M('instation');
		$msgCount = $msgTools->msgSingle($this->_post('id'));
		if($msgCount){
			$instation->where('id='.$this->_post('id'))->save(array("rd"=>1));
		}
		$count.='<div class="basic_single">
				<h5>'.$msgCount[0]['title'].'</h5>
				<div>发件人：'.$msgCount[0]['hostname'].'</div>
				<div>发件时间：'.date('Y-m-d H:i:s',$msgCount[0]['addline']).'</div>
				<div>'.$msgCount[0]['msg'].'</div>
				<form class="form-horizontal" method="post" action="'.__ROOT__.'/Center/stationreply.html">
				<input name="id" type="hidden" value="'.$this->_post('id').'" />
				<input name="title" type="hidden" value="对'.$msgCount[0]['title'].'的回复" />
				';
				//if($msgCount[0]['hostname']=='admin'){	//系统信息不能回复
					//$count.='<div><a href="#" class="btn disabled reply">回复</a>';
				//}else{
					//$count.='<div><button class="btn btn-primary reply" type="submit">回复</button>';
				//}
				$count.='<a class="btn btn-info" href="'.$_SERVER["HTTP_REFERER"].'">返回</a></button>
				</div>
				</form>
			</div>
		';
		echo $count;
    }
	
	//删除站内信
	public function stationexit(){
		$msgTools = A('msg','Event');
		$instation=M('instation');
		$result=$instation->where('id='.$this->_get('id'))->delete();
		if($result){
			 $this->success("删除成功");
				
		}else{
			$this->error("删除失败");
		}			 
    }
	
	//回复
	/*
	public function stationreply(){
		$msgTools = A('msg','Event');
		$msgCount = $msgTools->reply($this->_post('id'),$this->_post('title'),$this->_post('msg'));
		if($msgCount){
			$this->success("回复成功",'__URL__/basic/mail?pid=outbox');		
		}else{
			$this->error("回复失败");
		}
    }*/

//安全中心
	public function security(){

		$this->assign('mid',$this->_get('mid'));

		$this->display();
    }

	//修改密码
	public function updaPass(){
		$user=D('User');
		$users=$user->where('id='.$this->_session('user_uid'))->find();
		if($user->create()){
			if($user->userMd5($this->_post('passwd'))==$users['password']){
				$result = $user->where(array('id'=>$this->_session('user_uid')))->save();
				if($result){
				    $this->success("密码重置成功","__ROOT__/Center/security/password.html");
				}else{
				    $this->error("新密码不要和原始密码相同！");
				}		
			}else{
				$this->error("原始密码错误！");
			}
		}else{
			$this->error($user->getError());
		}

	}


//头像上传	
	public function portrait(){

		$head=$this->headPortrait('./Public/FaustCplus/php/img/big_user_'.$this->_session('user_uid').'.jpg');
		$this->assign('heads',$head);
		$this->assign("homeurl","-><a href='/Center'>".$this->modname."</a>->头像上传");
		$this->display();
    }
/* 	public  function test(){

		 $tools = A('tools','Event');
		 $tools->aa();
	} */
	

	
	
}