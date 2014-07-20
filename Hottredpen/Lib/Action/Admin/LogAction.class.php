<?php
	/**
	*
	*前后台记录
	*
	*/
defined('THINK_PATH') or exit();
class LogAction extends AdminAction {
//后台首页
	public function QianTaiLog(){
        $Operation = D('User_log_hott');
        import('ORG.Util.Page');// 导入分页类
        $count      = $Operation->count();// 查询满足要求的总记录数
        $Page       = new Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $Operation->relation(true)->limit($Page->firstRow.','.$Page->listRows)->order('time DESC')->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);
        $this->display();
	}

//--------管理操作记录-----------
    public function HouTaiLog(){
        $Operation = M('operation_hott');
        import('ORG.Util.Page');// 导入分页类
        $count      = $Operation->count();// 查询满足要求的总记录数
        $Page       = new Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $Operation->limit($Page->firstRow.','.$Page->listRows)->order('time DESC')->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);
        $this->display();
    }
}

?>