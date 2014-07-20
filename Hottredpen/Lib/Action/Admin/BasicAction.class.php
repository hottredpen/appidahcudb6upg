<?php
	/**
	*
	*后台基础设置
	*
	*/
defined('THINK_PATH') or exit();
class BasicAction extends AdminAction {
	/**
	*
	*后台基础设置首页
	*
	*/
	public function index(){
	    $System = M('system_hott');
        $list = $System->select();
        $this->assign('list',$list);
        $this->display();
	}
	/**
	*
	*系统参数添加
	*
	*/
    public function addsy(){
            $system=D('System_hott');
            if(!$system->create()){
                 $this->error($system->getError());
            }
            $last=$system->add();
            if($last){
			    //后台操作
				$this->AdminLog("管理员添加id=".$last."系统参数");
				F('huancun',NULL);
				$this->success('添加成功', '__URL__/index');
            }else{
				$this->AdminLog("管理员添加系统参数失败");//后台操作
				$this->error('系统参数添加失败');
            }

    }
	/**
	*
	*系统参数删除
	*
	*/
    public function delesy(){
		$c=M("System_hott");
		$id=$_GET['id'];
		$re=$c->where('id='.$id)->delete();
		if($re){
		    $this->AdminLog("管理员删除id=".$id."系统参数成功");//后台操作
			F('huancun',NULL);
		    $this->success("管理员删除id=".$id."系统参数成功", "__URL__/index");
		}else{
		    $this->AdminLog("管理员删除id=".$id."系统参数失败");//后台操作
		    $this->error($c->getError());
		}
    }
	/**
	*
	*系统参数编辑页
	*
	*/
    public function editsys(){
            $System = M('system_hott');
            $id=$this->_get('id');
            $edlist = $System->where('id='.$id)->select();
    		$this->assign('edlist',$edlist);
            $this->display();
    }
	/**
	*
	*系统参数值保存
	*
	*/
    public function savesy(){
            $system=D('System_hott');
            $value=$this->_post('value');
			if($system->create()){	
				foreach($this->_post('id') as $v=>$id){
						$data['id']			= $id;
						$data['value']		= $value[$v];
						$system->save($data);
				}
				F('huancun',NULL);
				$this->AdminLog("管理员修改系统参数成功");
				$this->success('参数修改成功', '__URL__/index');
			}else{
			    $this->AdminLog("管理员修改系统参数失败");
				$this->error($system->getError());
			}            
    }
	/**
	*
	*邮箱管理
	*
	*/
	public function email(){
        $email = M('smtp_hott');
        $list = $email->select();
        $this->assign('vo',$list);
        $this->display();
    }
	/**
	*
	*邮箱保存
	*
	*/
    public function email_send(){
            $system=D('Smtp_hott');
			if($system->create()){
				 $result = $system->save();
				 if($result){
					 $this->AdminLog("管理员对SMTP修改成功");
					 $this->success('修改成功', '__URL__/email');
				 }else{
					 $this->AdminLog("管理员对SMTP修改失败");
					 $this->error("修改失败");
				 }			 			
			}else{
				 $this->error($system->getError());
			}
    }
}
?>