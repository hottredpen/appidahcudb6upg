<?php
defined('THINK_PATH') or exit();
class DoApiAction extends Action{
    public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
	public function search(){
	    $words=htmlspecialchars(urldecode($_GET['words']));
		$zuowendata=M("zuowen")->where(array('isfabu'=>1,'title'=>array('like',"%".$words."%")))->select();
		$this->assign("words",$words);
		$this->assign("zuowendata",$zuowendata);
        $this->display("search/index");
		//p($zuowendata);
	}
}

?>