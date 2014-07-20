<?php

defined('THINK_PATH') or exit();
class LogoAction extends HomeAction {
	/**
	*
	*前台登录
	*
	*/
     public function login(){
		$backurl=$_SERVER['HTTP_REFERER'];
		if(strstr($backurl,"html")){
		    cookie("backurl",$backurl);
		}
		$this->display();
    }
	public function loging(){
		if($this->_session('verify') != md5($_POST['verify'])) {
		   $this->error('验证码错误！');
			exit;
		}
		$user = D("User");
		$condition['username'] = $this->_post('username');
		$condition['password'] = $user->userMd5($this->_post('password'));
		$list = $user->where($condition)->find();
	   if($list){
			session('user_name',$this->_post('username'));  //设置session
			session('user_uid',$list['id']);
			session('user_haveimg',$list['haveimg']);
			session('verify',null); //删除验证码
			$this->userLog('会员登陆',$this->_session('user_uid'));	//会员记录
			$backurl=cookie("backurl");
			if(strstr($backurl,"html")){
			    $this->success("用户登录成功",$backurl);
			}else{
			    $this->success("用户登录成功","__APP__/Index/index");
			}
		}else{
			 $this->error('用户名或密码错误');
		}
	}
	/**
	*
	*前台注册
	*
	*/
	public function register(){
		$this->display();  
    }
	public function addreg(){
		if($this->_session('verify') != md5($_POST['verify'])) {
		   $this->error('验证码错误！');
			exit;
		}
		$msgTools = A('msg','Event');
		$model=D('User');
		//会员积分
		$ufees=M('ufees');
		//虚拟币
		$money=M('money');
		//vip积分
		$vip_points=M('vip_points');
		//用户详细资料
		$userinfo=M('userinfo');
		//获取积分配置
		$inf=$this->integralConf();
		if($model->create()){
		    $result = $model->add();
			if($result){
				//记录添加点
				$ufees->add(array('uid'=>$result,'total'=>$inf['mem_register'][0],'available'=>$inf['mem_register'][0]));	//会员积分
				$money->add(array('uid'=>$result));	//资金表
				$vip_points->add(array('uid'=>$result));	//VIP积分
				$userinfo->add(array('uid'=>$result));	//用户资料表
				$this->userLog('会员id='.$result.'注册成功');	//会员记录
				$gggg=$msgTools->sendMsg(3,'会员注册成功',$this->_post('username').'您的账号已注册成功！','admin',$this->_post('username'));//站内信
				session('user_name',$this->_post('username'));  //设置session
				session('user_uid',$result);
				session('user_haveimg',0);
				session('verify',null); //删除验证码
				$this->success("注册成功","__APP__/Index/index");	
			}else{
				 $this->error("注册失败");
			}	
		}else{
			$this->error($model->getError());
		} 
    }
	/**
	*
	*前台退出
	*
	*/
	public function exits(){
	    $this->userLog('会员id='.$_SESSION['user_uid'].'退出');	//会员记录
		session('user_uid',null);
		session('user_name',null);
		session('user_haveimg',null);
		$backurl=$_SERVER['HTTP_REFERER'];
		$this->success("用户退出成功",$backurl);
	}
	/**
	*
	*找回密码
	*
	*/
     public function forgotpass(){
		$this->display();  
	 }
	public function rPassword(){
		if($this->_session('verify') != md5($this->_post('verify'))) {
		   $this->error('验证码错误！');
			exit;
		}
 		$userinfo=D('Userinfo');
		$user=D('User');
		$users=$user->where(array('username'=>$this->_post('username')))->find();
		if($users){
			$email=$users['email'];
			if($email!==$this->_post('email')){
			    $this->userLog('会员id='.$users['id'].'找回密码输入邮箱与注册邮箱不符合');	//会员记录
			    $this->error("输入邮箱与注册邮箱不符合！");
			}
		}else{
			$this->error("账号不存在");
		}
		$smtp=M('smtp_hott');
		$stmpArr=$smtp->find(1);
		$stmpArr['receipt_email']	=$email;
		$cache = cache(array('expire'=>3600));
		$cache->set('rpawss'.$users['id'],md5($email));	//设置缓存
		$stmpArr['title']			="找回密码";
		$stmpArr['content']			='  <div>
											<p>您好，<b>'.$this->_post('user').'</b> ：</p>
										</div>
										<div style="margin: 6px 0 60px 0;">
											<p>请点击这里，修改您的密码</p>
											<p><a href="http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Logo/rppage?pass='.$cache->get('rpawss'.$users['id']).'&uid='.$users['id'].'">http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Logo/rppage?pass='.$cache->get('rpawss'.$users['id']).'&uid='.$users['id'].'</a></p>
											<p>如果您的邮箱不支持链接点击，请将以上链接地址拷贝到你的浏览器地址栏中认证。</p>
										</div>
										<div style="color: #999;">
											<p>发件时间：'.date('Y/m/d H:i:s').'</p>
											<p>此邮件为系统自动发出的，请勿直接回复。</p>
										</div>';
		$emailsend=R('HottTool/email_send',array($stmpArr));	
		if($emailsend){
		    $this->userLog('会员id='.$users['id'].'找回密码邮件发送成功');	//会员记录
			$this->success('邮件发送成功', '__APP__/forgotpass.html');
		}else{
		    $this->userLog('会员id='.$users['id'].'找回密码邮件发送失败');	//会员记录
			$this->error("找回密码失败，请联系管理员");
		} 	
	}
	/**
	*
	*找回密码，链接回来修改页
	*
	*/
	 public function rppage(){
		$cache = cache(array('expire'=>50));
		$value = $cache->get('rpawss'.$this->_get('uid'));  // 获取缓存
		$user=D('User');
		$users=$user->where('id="'.$this->_get('uid').'"')->find();
		if(!md5($users['email'])==$value){	//判断链接是否过期
			$this->error("链接已过期！","__APP__/Index/index");
		}
		$this->display();  
	 }
	public function rsPassword(){
		if($this->_session('verify') != md5($this->_post('verify'))) {
		   $this->error('验证码错误！');
		}
		$user=D('User');
		$users=$user->where('id='.$this->_post('uid'))->find();
		if($user->create()){
			$result = $user->where(array('id'=>$this->_post('uid')))->save();
			if($result){
				$cache = cache(array('expire'=>50));
				$cache->rm('rpawss'.$this->_post('uid'));// 删除缓存
			 	$this->success("密码重置成功","__APP__/login.html");
			}else{
			    $this->error("新密码不要和原始密码相同！");
			}		
		}else{
			$this->error($user->getError());
		}
	}
	/**
	*
	*用来检测用户是否存在！
	*
	*/
	function check_u(){
		$username=$_GET["username"];
		$user=M("user")->where(array("username"=>$username))->find();
		if($user>0){
			echo false;
		}else{
			echo true;
		}
	}
	/**
	*
	*用来检测邮箱是否存在！
	*
	*/
	function check_e(){
		$email=$_GET["email"];
		$mail=M("user")->where(array("email"=>$email))->find();
		if($mail>0){
			echo false;
		}else{
			echo true;
		}
	}
	/**
	*
	*用来检测验证码！
	*
	*/

	function check_v(){
	    $verify=$_GET['verify'];
		if($this->_session('verify') != md5($verify)) {
            echo false;
		}else{
			echo true;
		}
	}
}