<?php
	/**
	*
	*后台权限
	*
	*/
defined('THINK_PATH') or exit();
class AdminAction extends AppstartAction {
	/**
	*
	*后台权限
	*
	*/
	function _initialize() {
	    parent::_initialize();
	    header("Content-Type:text/html; charset=utf-8");
        import('ORG.Util.Authority');//加载权限类库
        $auth=new Authority();	
	       //后台 admin_name
		   $uid=$this->_session('admin_uid');
		   $user =$this->_session('admin_name');
		  
	    $error_info=$uid?"你没有权限":"请登陆";
	    $error_url =$uid?"":"__ROOT__/Admin/Logo.html";
	    //admin为超级管理员不受限制
	    if($user !="admin"){
		    if(!$auth->getAuth(GROUP_NAME.'/'.MODULE_NAME.'/'.ACTION_NAME,$uid)){
			    $this->error($error_info,$error_url);
		    }
	    }
	}
}
?>