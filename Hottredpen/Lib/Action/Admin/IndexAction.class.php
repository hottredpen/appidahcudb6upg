<?php
	/**
	*
	*后台首页
	*
	*/
defined('THINK_PATH') or exit();
class IndexAction extends AdminAction {
//后台首页
	public function index(){
	    //$c=M("lanmu");
	    //$lanmudata=$c->select();
		//$this->assign("lanmudata",$lanmudata);
        $this->display();
	}
}

?>