<?php
	/**
	*
	*后台登录
	*
	*/
defined('THINK_PATH') or exit();
class LogoAction extends AppstartAction {
	/**
	*
	*后台首页，及登录
	*
	*/
     public function index(){
		
        if(isset($_POST['name'])){
            if($this->_session('verify') != md5($_POST['proving'])) {
               $this->error('验证码错误！');
            }
            $User = D("Admin"); // 实例化User对象
            $condition['name'] = $_POST['name'];
			$condition['password'] = $User->adminMd5($_POST['passw']);
            $list = $User->where($condition)->find();
            if($list){
                session('admin_name',$list['username']);  //设置session
				session('admin_uid',$list['id']);
                session('verify',null); //删除验证码
                //记录后台操作
				$this->AdminLog("管理员登陆成功");
                $this->success('用户登录成功',U('Index/index'));
            }else{
                //记录后台操作
				$this->AdminLog("管理员登陆失败");
                $this->error('用户名或密码错误');
            }
        }else{
		    $this->display();
		}
    }
	/**
	*
	*后台登出
	*
	*/
	public 	function loginout(){
		if(isset($_SESSION['admin_name'])) {
		    //记录登出
			$this->AdminLog("管理员登出");
			//跳转
			$this->assign("jumpUrl",U("Admin/Logo/index"));
			unset($_SESSION['admin_name']);
			unset($_SESSION);
			session_destroy();
            $this->success('登出成功！');
        }else{
		    //记录登出
			$this->AdminLog("管理员登出失败");
            $this->error('已经登出！');
        }
	}
	
	 
}