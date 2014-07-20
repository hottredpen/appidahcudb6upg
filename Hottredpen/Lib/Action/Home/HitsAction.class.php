<?php

/**
 * 点击数获取与增加

 */
class HitsAction extends HomeAction {
    //内容模型
    protected $db;
    //获取点击数
    public function gethits() {
        //栏目ID
        $catid = $_POST['catid'];
        //信息ID
        $id = $this->_post('id');
        //获取表名
		$lanmu_id_entitle=F('lanmu_id_entitle');
        $tablename = $lanmu_id_entitle[$catid];
        if (empty($tablename)) {
            exit;
        }
		$mod=strtolower($tablename);

        $article=M($mod)->where(array('id' => $id))->find();
        if ($article==null) {
            exit;
        }
/*
*
头部文字说明header_infohtml
*
*/
		        $article['header_infohtml']="<font class='text-warning'>欢迎来到简看空间！</font>";
/*
*
发布的用户批注userpizhuhtml
*
*/
 				//获取所有发布的用户
				$onedata=M($mod."_jiexi_one")->where(array('pid'=>$article['id']))->select();
				//获取用户名称
				$user_id_username=F("user_id_username");
				if($onedata){
				    foreach($onedata as $key => $val){
						$onedata[$key]['username']=$user_id_username[$onedata[$key]['uid']];
					}	
				}
				//输出todo
				foreach($onedata as $key => $val){
					$article['userpizhuhtml'].="<font>".$val['username']."<a href='javascript:void(0)' class='ksliulan' data-pid=".$val['pid']." data-mokuai=".strtolower($tablename)."  data-uid=".$val['uid'].">点击浏览</a></font>";
				}
/*
*
随机概要gaiyaorandhtml
*
*/
				$randid = rand(0, count($onedata)-1);
				$article['gaiyaorandhtml']="<i class='text-danger'>随机推荐</i>用户<a href='javascript:void(0)'  class='ksliulan' data-pid=".$onedata[$randid]['pid']." data-mokuai=".strtolower($tablename)."  data-uid=".$onedata[$randid]['uid'].">".$onedata[$randid]['username']."</a>的简要说明：<p class='text-primary'>".$onedata[$randid]['gaiyao']."</p>";
/*
*
评价pingjiahtml
*
*/
				$article['pingjiahtml']='<div id="mystars" class="rateit bigstars" data-rateit-step="1" data-rateit-readonly="true" data-rateit-value="0" data-rateit-resetable="false" data-rateit-starwidth="24" data-rateit-starheight="24"></div>
										 <div class="description"></div>';
		
		
		
/*
*
相关推荐tuijianhtml
*
*/		
/* 				if(F("article_xiangguan/catid_".$catid."_pid_".$id)){
					$kkkk=F("article_xiangguan/catid_".$catid."_pid_".$id);
				}else{ */
						//所有数据
						$alldata=M($mod)->where(array('isfabu'=>1))->select();
						//将tags数组化,并去空
						$article['tags']=array_filter(explode(' ',$article['tags']));
						//每个tags获得5篇文章		
						foreach($article['tags'] as $key =>$val){
							$shu=0;
							foreach($alldata as $key2 => $val2){
								$uiui[$key2]=array_filter(explode(' ',$val2['tags']));
								if(in_array($val,$uiui[$key2]) && $val2['id']!==$id){
									if($shu==5){
										break;
									}
									$koko[$val][$key2]['indexid']=$val2['indexid'];
									$koko[$val][$key2]['title']=$val2['title'];
									$koko[$val][$key2]['name']=$val;

									$shu=$shu+1;

								}
							}		    
						}
						//生成该文章的相关文章
						//F("article_xiangguan/catid_".$catid."_pid_".$id,$koko);
						$kkkk=$koko;

				//}
				$article['tuijianhtml']="<ul>";
						foreach($kkkk as $key =>$val){
							foreach($val as $key2 =>$val2){
								$article['tuijianhtml'].="<li><a class='text-muted' ref='nofollow' href='/".strtolower($tablename)."/tags?w=".$val2['name']."'>[".$val2['name']."]</a><a href='/".$mod."/html/".$val2['indexid'].".html'>".$val2['title']."</a></li>";
							}
						}
				$article['tuijianhtml'].="</ul>";	   
/*
*
月点击和周点击
*
*/	
                //月点击
/*                 if(F("article_dianjipaihang/".$mod."-month-".date("Y-m-d"))){
				    $ddddm=F("article_dianjipaihang/".$mod."-month-".date("Y-m-d"));
				}else{ */
					$monthclicklist=M($mod)->where(array('isfabu'=>1))->order("monthclick desc")->limit(10)->select();
					//F("article_dianjipaihang/".$mod."-month-".date("Y-m-d"),$monthclicklist);
					$ddddm=$monthclicklist;
				//}
				$article['monthhothtml']="<ul>";
						foreach($ddddm as $key =>$val){
							$article['monthhothtml'].="<li><a href='/".$mod."/html/".$val['indexid'].".html'>".$val['title']."</a><small class='text-muted'>".$val['author']."</small></li>";
						}
				$article['monthhothtml'].="</ul>";
                //周点击
/*                 if(F("article_dianjipaihang/".$mod."-week-".date("Y-m-d"))){
				    $ddddw=F("article_dianjipaihang/".$mod."-week-".date("Y-m-d"));
				}else{ */
					$weekclicklist=M($mod)->where(array('isfabu'=>1))->order("weekclick desc")->limit(10)->select();
					//F("article_dianjipaihang/".$mod."-week-".date("Y-m-d"),$weekclicklist);
					$ddddw=$weekclicklist;
				//}
				$article['weekhothtml']="<ul>";
						foreach($ddddw as $key =>$val){
							$article['weekhothtml'].="<li><a href='/".$mod."/html/".$val['indexid'].".html'>".$val['title']."</a><small class='text-muted'>".$val['author']."</small></li>";
						}
				$article['weekhothtml'].="</ul>";

        /*****************增加点击率*******************/
        $this->hits($article);
		$article['click']=$article['click']+1;//页面中先显示加1
			 
		//json输出
        echo json_encode($article);

    }
    /**
     * 增加点击数 
     * @param type $article 点击相关数据
     * @return boolean
     */
    private function hits($article) {
        //当前时间
        $time = time();
        //总点击+1
        $click = $article['click'] + 1;
        //昨日
        $yesterdayclick = (date('Ymd', $article['clickupdatetime']) == date('Ymd', strtotime('-1 day'))) ? $article['todayclick'] : $article['yesterdayclick'];
        //今日点击
        $todayclick = (date('Ymd', $article['clickupdatetime']) == date('Ymd', $time)) ? ($article['todayclick'] + 1) : 1;
        //本周点击
        $weekclick = (date('YW', $article['clickupdatetime']) == date('YW', $time)) ? ($article['weekclick'] + 1) : 1;
        //本月点击
        $monthclick = (date('Ym', $article['clickupdatetime']) == date('Ym', $time)) ? ($article['monthclick'] + 1) : 1;
        $data = array(
            'click' => $click,
            'yesterdayclick' => $yesterdayclick,
            'todayclick' => $todayclick,
            'weekclick' => $weekclick,
            'monthclick' => $monthclick,
            'clickupdatetime' => $time
        );
        $status =M($mod)->where(array('id' => $article['id']))->save($data);
        return false !== $status ? true : false;
    }
}   