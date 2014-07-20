<?php
	/**
	*
	*积分配置
	*
	*/
defined('THINK_PATH') or exit();
class JiFenAction extends AdminAction {
	/**
	*
	*积分等级（页面）
	*
	*/
    public function index(){
		$grade=M('membership_grade_hott');
		$list=$grade->order('`id` asc')->select();
		$this->assign('list',$list);
        $this->display();
    }
	/**
	*
	*积分等级添加——————————————————添加页面为弹窗的
	*
	*/
	public function adddengji(){
	    $c=D('membership_grade_hott');
		if($c->create()){
		    $re=$c->add();
			if($re){
			    $this->AdminLog("添加id=".$re."积分等级成功");
			    $this->success("添加成功","__URL__/index");
			}else{
			    $this->AdminLog("添加id=".$re."积分等级失败");
			    $this->error("添加失败","__URL__/index");
			}
		}else{
		    $this->error($c->getError());
		}
	}
	/**
	*
	*积分等级修改（页面）
	*
	*/
	public function editdengji(){
		$grade=M('membership_grade_hott');
		$edlist=reset($grade->where('`id`='.$this->_get('id'))->select());
		$this->assign('vo',$edlist);
        $this->display();
    }
	/**
	*
	*积分等级修改
	*
	*/
	public function updatedengji(){
	    $c=D('membership_grade_hott');
		if($c->create()){
		    $re=$c->save();
			if($re){
			    $this->AdminLog("修改id=".$_POST['id']."积分等级成功");
			    $this->success("修改成功","__URL__/index");
			}else{
			    $this->AdminLog("修改id=".$_POST['id']."积分等级失败");
			    $this->error("修改失败","__URL__/index");
			}
		}else{
		    $this->error($c->geterror());
		}
	}
	/**
	*
	*积分等级删除
	*
	*/
	public function deledengji(){
		$grade=M('membership_grade_hott');
		$edlist=reset($grade->where('`id`='.$this->_get('id'))->select());
		unlink('./Public/uploadify/uploads/grade_img/'.$edlist['img']);	//删除图片
		$result = $grade->where(array('id'=>$this->_get('id')))->delete();
		if($result){
			$this->AdminLog('删除id='.$_GET['id'].'积分等级成功');//后台操作
			$this->success("删除成功","__URL__/index");
				
		}else{
			$this->AdminLog('删除id='.$_GET['id'].'积分等级失败');//后台操作
			$this->error("删除失败","__URL__/index");
		}			
    }
	/**
	*
	*积分配置（页面）
	*
	*/
	public function peizhi(){
		$unite=M('integralconf');
		$id=$this->_get('id')?$this->_get('id'):0;
		switch($id){
			case 0:
			$pname='会员积分配置';
			break;
		}
		$list=$unite->where('`pid`='.$id)->select();
		$this->assign('list',$list);
		$this->assign('pname',$pname);
		$endjs='
//编辑
function edit(id){
	var loading=\'<div class="invest_loading"><div><img src="__PUBLIC__/bootstrap/img/ajax-loaders/ajax-loader-1.gif"/></div><div>加载中...</div> </div>\';
	    $(".integral_subject").html(loading);
		$("#edits").load("__URL__/editpeizhiajax", {id:id});
}
		';
		$this->assign('endjs',$endjs);
		$this->display();
	}
	/**
	*
	*积分配置添加
	*
	*/
	public function addpeizhi(){
	    $c=D('Integralconf');
		if($c->create()){
		    $re=$c->add();
			if($re){
			    $this->AdminLog("添加id=".$re."积分配置成功");
			    $this->success("添加成功","__URL__/peizhi");
			}else{
			    $this->AdminLog("添加id=".$re."积分配置失败");
			    $this->error("添加失败","__URL__/peizhi");
			}
		}else{
		    $this->error($c->geterror());
		}
	}
	/**
	*
	*积分配置修改（ajax返回页面）
	*
	*/
    public function editpeizhiajax(){
		$unite=D('Integralconf');
		$id=$this->_post("id");
		$list=$unite->where('`id`='.$id)->find();
		echo '
	<table class="table">
        <tbody>
          <tr>
            <td>变量名：</td>
            <td><input name="name" type="text" class="form-control" placeholder="请输入变量名..." value="'.$list['name'].'"></td>
          </tr>
          <tr>
            <td>积分：</td>
            <td><input name="value" type="text" class="form-control" placeholder="请输入积分..." value="'.$list['value'].'"></td>
          </tr>
		  <tr>
            <td>说明：</td><td> <textarea name="state" class="form-control" rows="3" placeholder="说明不要超过100个字...">'.$list['state'].'</textarea></td>
          </tr>
		  <input name="id" type="hidden" value="'.$id.'" />
        </tbody>      
    </table>
		';
    }
	/**
	*
	*积分配置修改
	*
	*/
	public function updatepeizhi(){
	    $c=D('Integralconf');
		if($c->create()){
		    $re=$c->save();
			if($re){
			    $this->AdminLog("修改id=".$_POST['id']."积分配置成功");
			    $this->success("修改成功","__URL__/peizhi");
			}else{
			    $this->AdminLog("修改id=".$_POST['id']."积分配置失败");
			    $this->error("修改失败","__URL__/peizhi");
			}
		}else{
		    $this->error($c->geterror());
		}
	}
	/**
	*
	*积分配置删除
	*
	*/
    public function delepeizhi(){
		$unite=D('Integralconf');
		$result = $unite->where(array('id'=>$this->_get('id')))->delete();
		if($result){
			$this->AdminLog('删除id='.$_GET['id'].'积分配置成功');//后台操作
			$this->success("删除成功","__URL__/peizhi");
		}else{
			$this->AdminLog('删除id='.$_GET['id'].'积分配置失败');//后台操作
			$this->error("删除失败","__URL__/peizhi");
		}		
	}

}