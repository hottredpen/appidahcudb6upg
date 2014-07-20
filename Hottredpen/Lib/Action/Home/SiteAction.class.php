<?php
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
defined('THINK_PATH') or exit();
class SiteAction extends HomeAction{
      //index send
      public function index(){
         if(!$id){
			 $this->error("请先选择栏目");
		 }	
		 $this->display();
	  }
	  
	  //预览文章
	  public function article(){
	    $id=$this->_get('id');
		if(!$id){
			 $this->error("请先选择文章");
		 }
		//标题、关键字、描述
		$Site = D("Site_hott");
		$mod = D("Article");
		$si=$mod->field('keyword,remark,title,catid')->where('id='.$id)->find();
		$sb=$Site->field('title,link')->where('id='.$si['catid'])->find();
		$sin['title']=','.$si['title'];
		$this->assign('so',$sin);
		$si['title']=$si['title']."-".$sb['title'];
		$si['link']=$sb['link']?$sb['link']:1;
		$si[$si['link']]='active';
		$this->assign('si',$si);
		$active[$si['link']]='active';
		$this->assign('active',$active);
		
		
		  //左边
		 $site=$Site->field('title,link,id,type')->where('type>1 and status=1')->select();
		 $this->assign('site',$site);

		 $list = $mod->where("id=".$id)->relation("site")->find();
		 $this->assign('list',$list);
		 $artic=$Site->field('title,id')->where('id='.$list['catid'])->find();
		 $this->assign('artic',$artic);
		 $this->display($list['content_tpl']);
	  }
	  
      //封面
	  
	  public function page(){
	  	$id=$this->_get('id');
		  //标题、关键字、描述
		$Site = D("Site_hott");
		$si=$Site->field('keyword,remark,title,link')->where('id='.$id)->find();
		if(!$si['link']){
			$si['link']=1;
		}
		$this->assign('si',$si);
		$active[$si['link']]='active';
		$this->assign('active',$active);
		$si['title']=','.$si['title'];
		$this->assign('so',$si);
		 //左边
		 $Site = D("Site_hott");
		 $site=$Site->field('title,id,type')->where('type>1 and status=1')->select();
		 $this->assign('site',$site);
		 $artic=$Site->field('title')->where('id='.$id)->find();
		 $this->assign('artic',$artic);
		 if(!$id){
			 $this->error("请先选择栏目");
		 }	
		 $mod = D("Site_hott");
		 $list = $mod->where("id=".$id)->relation("site_add")->find();
		 $this->assign('list',$list);
		//$this->display($list['page_tpl']);
		$this->display($list['content_tpl']);
	  }
	  
	  //列表
	  public function listTpl(){
	  	$id=$this->_get('id');
		//标题、关键字、描述
		$Site = D("Site_hott");
		$si=$Site->field('keyword,remark,title,link')->where('id='.$id)->find();
		if(!$si['link']){
			$si['link']=1;
		}
		$this->assign('si',$si);
		$active[$si['link']]='active';
		$this->assign('active',$active);
		  //左边
		 $Site = D("Site_hott");
		 $site=$Site->field('title,id,type')->where('type>1 and status=1')->select();
		 $this->assign('site',$site);
		 $artic=$Site->field('title')->where('id='.$id)->find();
		 $this->assign('artic',$artic);
		 if(!$id){
			 $this->error("请先选择栏目");
		 }
		$mod = D("Article");
		$list = $mod->where("catid=".$id)->relation("site")->select();
		 $this->assign('list',$list);
		 $this->display("list");
	  }	  
	 
	  
}
?>
