<?php
// 本类由系统自动生成，仅供测试用途
class AppstartAction extends Action {
    //主要为缓存
    function _initialize() {
		//生成缓存
		$huancun=F("huancun");
		if(!$huancun){
        /***************lanmu****************/
                        $lanmu=M("lanmu");
                        $lanmudata=$lanmu->select();
						foreach($lanmudata as $key =>$val){
						    $lanmu_id_title[$val['id']]=$val['title'];
							$lanmu_id_entitle[$val['id']]=$val['entitle'];
							$lanmu_entitle_title[$val['entitle']]=$val['title'];
							$lanmu_entitle_id[$val['entitle']]=$val['id'];
							$lanmu_title_entitle[$val['title']]=$val['entitle'];
							$lanmu_entitle_keywords[$val['entitle']]=$val['keywords'];
							$lanmu_entitle_description[$val['entitle']]=$val['description'];
						}
						F("lanmu_id_title",$lanmu_id_title);
						F("lanmu_id_entitle",$lanmu_id_entitle);
						F("lanmu_entitle_title",$lanmu_entitle_title);
						F("lanmu_entitle_id",$lanmu_entitle_id);
						F("lanmu_title_entitle",$lanmu_title_entitle);
						F("lanmu_entitle_keywords",$lanmu_entitle_keywords);
						F("lanmu_entitle_description",$lanmu_entitle_description);
		
		/***************sys****************/
						$system	=	M('system_hott');
						$system=$system->select();
						foreach($system as $s){
							$sys[$s['name']]=$s['value'];
						}
						F('systems',$sys);	//设置缓存
		/***************city****************/
						$city	=	M('city');
						$city=$city->select();
						foreach($city as $cy){
							$citys[$cy['var']]=$cy['city'];
						}
						F('city',$citys);
		/***************zuowen_tags****************/
						$zuowentags=M("zuowen_tags")->select();
						foreach($zuowentags as $key => $val){
							$zuowentags_id_title[$val['id']]=$val['title'];
							$zuowentags_title_id[$val['title']]=$val['id'];
							$zuowentags_id_isxihua[$val['id']]=$val['isxihua'];
							$zuowentags_id_pid[$val['id']]=$val['pid'];
						}
						F("zuowen_tags_id_title",$zuowentags_id_title);
						F("zuowen_tags_title_id",$zuowentags_title_id);
						F("zuowen_tags_id_isxihua",$zuowentags_id_isxihua);
						F("zuowen_tags_id_pid",$zuowentags_id_pid);
		/***************haociju_tags****************/
						$haocijutags=M("haociju_tags")->select();
						foreach($haocijutags as $key => $val){
							$haocijutags_id_title[$val['id']]=$val['title'];
							$haocijutags_title_id[$val['title']]=$val['id'];
							$haocijutags_id_isxihua[$val['id']]=$val['isxihua'];
							$haocijutags_id_pid[$val['id']]=$val['pid'];
						}
						F("haociju_tags_id_title",$haocijutags_id_title);
						F("haociju_tags_title_id",$haocijutags_title_id);
						F("haociju_tags_id_isxihua",$haocijutags_id_isxihua);
						F("haociju_tags_id_pid",$haocijutags_id_pid);
        /***************zuowen****************/
				        $zuowen=M("zuowen");
						$zuowenlist=$zuowen->where(array('isfabu'=>1))->select();
						foreach($zuowenlist as $key =>$val){
							$zuowen_id_title[$val['id']]=$val['title'];
							$zuowen_id_indexid[$val['id']]=$val['indexid'];
						}
						F("zuowen_id_title",$zuowen_id_title);
						F("zuowen_id_indexid",$zuowen_id_indexid);
		/***************user****************/
				        $user=M("user");
						$userlist=$user->select();
						foreach($userlist as $key =>$val){
							$user_id_username[$val['id']]=$val['username'];
						}
						F("user_id_username",$user_id_username);
		/******huancun*****/
		    F("huancun",array("ok"));
		}
    }
	/**
     * @后台操作记录
     * @type    记录说明
     * @id      是否开启
     */
    public function AdminLog($type){
            $Operation = M('operation_hott');
            $array['name']= $_SESSION['admin_name'];
            $array['page']= $_SERVER['PHP_SELF'];
            $array['type']= $type;
            $array['ip']= get_client_ip();
            $array['time']= time();
            $Operation->add($array);
    }
	/**
	*
	* @会员操作记录
	*
	*/
    public function userLog($arr,$uid){
            $array['uid']		= $uid?$uid:$this->_session('user_uid');
			$array['actionname']= $arr;
			$array['page']		= $_SERVER['PHP_SELF'];
            $array['ip']		= get_client_ip();
            $array['time']		= time();
			return D('user_log_hott')->add($array);
    }
	
    public function aa($path){
	    //localhost/supload/news/2013/07/21/1.jpg  

		//$path = isset($_GET['path'])? $_GET['path'] : '';     //传过来的参数(/supload/news/2013/07/21/1.jpg)		
		
 		if(!file_exists(ltrim($path,"/"))){
		    import('ORG.Util.PicThumb');
			//缩图配置
		    $thumb_config = C("SUOTU");	
			
		    //echo "不存在缩略图".$path;
			//echo "<br />";
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
					    //echo "配置文件里可没有这个模块";
						//exit();
						return false;
					}

					// 原图文件("www/upload/"+"【news_100_100】/2013/07/21/1.jpg"=>www/upload/"+"【news】/2013/07/21/1.jpg")不同尺寸配置找到原图
					$source = str_replace('/'.$mod.'/', '/'.$config['fromdir'].'/', $source_path.$relative_url);
					
					//获取原图的width height
					list($width, $height, $type, $attr) = getimagesize($source);
					//p($width);
					if($config['width']=="" && $config['height']==""){
						$config['width']=$width*$config['fangsuo'];
						$config['height']=$height*$config['fangsuo'];					
					} 

					
                    if(!file_exists(ltrim($source,"/"))){
					    //echo "天哪，居然也没有原图！";
					    //exit();
						return false;
					}else{
					    //echo "幸好，存在原图";
						// 目标文件 ("www/【supload】/"+"news_100_100/2013/07/21/1.jpg"
						$dest = $dest_path.$relative_url;

						 // 创建缩略图
						$obj = new PicThumb($logfile);
						$obj->set_config($config);
						 if($obj->create_thumb($source, $dest)){
							//echo "<br />";
							//echo "缩略图创建成功";
                            return true;						    
							ob_clean();

							//header('content-mod:'.mime_content_mod($dest));
							//exit(file_get_contents($dest));
						}
                    }					
		}else{
		    //echo "恭喜存在".$path;
			//echo "<br />";
			return true;
		} 
	
	}

}