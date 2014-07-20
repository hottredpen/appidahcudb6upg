<?php

defined('THINK_PATH') or exit();
class IndexAction extends HomeAction {
    public function index(){
	
	
	
	
	    /* 最近注册用户 */
		$user=M('user');
		$userslist=$user->limit('5')->order('id desc')->select();
		$this->assign("userslist",$userslist);
		/* 最新文章 */
		$art=M("zuowen");
		$artdata=$art->limit('15')->where(array('isfabu'=>1))->order('id desc')->select();
		//背景切换
		foreach($artdata as $key =>$val){
		    if($key%2 == 0){
		        $artdata[$key]['bj']=1;
			}else{
			    $artdata[$key]['bj']=0;
			}
		}
		//精彩图文
		$jingcaituwendata =M("yygj")->where(array('isfabu'=>1))->limit(6)->order("id desc")->select();

		//好词句
		$haocijudata =M("haocihaoju")->where(array('isfabu'=>1))->limit(6)->order("id desc")->select();
		//背景切换
		foreach($haocijudata as $key =>$val){
		    if($key%2 == 0){
		        $haocijudata[$key]['bj']=1;
			}else{
			    $haocijudata[$key]['bj']=0;
			}
		}
		//简看教材
		$jiaocaidata =M("jiaocai")->where(array('isfabu'=>1))->limit(10)->order("id desc")->select();
		//背景切换
		foreach($jiaocaidata as $key =>$val){
		    if($key%2 == 0){
		        $jiaocaidata[$key]['bj']=1;
			}else{
			    $jiaocaidata[$key]['bj']=0;
			}
		}
		//热门作文
		$monthclicklist=M("zuowen")->where(array('isfabu'=>1))->order("monthclick desc")->limit(10)->select();
		$this->assign("monthclicklist",$monthclicklist);
		$this->assign("newartlist",$artdata);
		$this->assign("jingcaituwendata",$jingcaituwendata);
		$this->assign("haocijudata",$haocijudata);
		$this->assign("jiaocaidata",$jiaocaidata);
		$this->display();

	}
    public function aa(){
	    //localhost/supload/news/2013/07/21/1.jpg  

		$path = isset($_GET['path'])? $_GET['path'] : '';     //传过来的参数(/supload/news/2013/07/21/1.jpg)		
		
 		if(!file_exists(ltrim($path,"/"))){
		    import('ORG.Util.PicThumb');
			//缩图配置
		    $thumb_config = C("SUOTU");	
			
		    echo "不存在缩略图".$path;
			echo "<br />";
					$logfile = WWW_PATH.'/createthumb.log';  // 日志文件
					$source_path = WWW_PATH.'/Uploads/';      // 原路径
					$dest_path = WWW_PATH.'/sUploads/';       // 目标路径

					//localhost/supload/news_100_100/2013/07/21/1.jpg
					// 获取图片URI(news_100_100/2013/07/21/1.jpg )
					$relative_url = str_replace($dest_path, '', WWW_PATH.$path);

					// 获取mod(news)
					$mod = substr($relative_url, 0, strpos($relative_url, '/'));

					// 获取config(news对应的配置)
					$config = isset($thumb_config[$mod])? $thumb_config[$mod] : '';

					// 检查config
					if(!$config || !isset($config['fromdir'])){
					    echo "配置文件里可没有这个模块";
						exit();
					}

					// 原图文件("www/upload/"+"【news_100_100】/2013/07/21/1.jpg"=>www/upload/"+"【news】/2013/07/21/1.jpg")不同尺寸配置找到原图
					$source = str_replace('/'.$mod.'/', '/'.$config['fromdir'].'/', $source_path.$relative_url);
					
                    if(!file_exists(ltrim($source,"/"))){
					    echo "天哪，居然也没有原图！";
					    exit();
					}else{
					    echo "幸好，存在原图";
						// 目标文件 ("www/【supload】/"+"news_100_100/2013/07/21/1.jpg"
						$dest = $dest_path.$relative_url;

						 // 创建缩略图
						$obj = new PicThumb($logfile);
						$obj->set_config($config);
						 if($obj->create_thumb($source, $dest)){
							//ob_clean();
							echo "<br />";
							echo "缩略图创建成功";
							//header('content-mod:'.mime_content_mod($dest));
							//exit(file_get_contents($dest));
						}
                    }					
		}else{
		    echo "恭喜存在".$path;
			echo "<br />";
		} 
	
	}
	public function ooo(){
	    $c=M("jiaocai_content");
	    $data=$c->select();
		
		foreach($data as $key =>$val){
		    $data[$key]['content']=unserialize($data[$key]['content']);
			
 			foreach($data[$key]['content'] as $key2 =>$val2){
			    if($data[$key]['content'][$key2]['leixing']==1){
				    $data[$key]['content'][$key2]['content']=str_replace('/Uploads/jiaocai/Uploads/jiaocai/','/Uploads/jiaocai/',$data[$key]['content'][$key2]['content']);
					
				}
			
			}
			$dataok[$key]['content']=$data[$key]['content'];
			$oopp[$key]=serialize($dataok[$key]['content']);
			
			$save['content']=$oopp[$key];
			
			$re=$c->where(array('pid'=>$data[$key]['pid']))->save($save);
			
			if($re){
			    echo "ok";
			}else{
			    echo "no";
			}
		
		}
	p($dataok);
	
	}
	

}