<?php


    function pre($arr){
       echo "<pre>";
	   print_r($arr);
	   echo "</pre>";
	}
  function RJson($arr){
		    header('Content-Type: application/json');
		    echo json_encode ($arr); 
			exit;
  }	
  
  function bfb($fl){
	  return ($fl * 100) ."%";
  }
/**
 *  通过用户邮箱，取得gravatar头像
 * @since 2.5
 * @param int|string|object $id_or_email 一个用户ID，电子邮件地址
 * @param int $size 头像图片的大小
 * @param string $default 如果没有可用的头像是使用默认图像的URL
 * @param string $alt 替代文字使用中的形象标记。默认为空白
 * @return string <img>
 */
function get_avatar($id_or_email, $size = '96', $default = '', $alt = false) {

    //头像大小
    if (!is_numeric($size))
        $size = '96';
    //邮箱地址
    $email = '';
    //如果是数字，表示使用会员头像 暂时没有写！
    if (is_int($id_or_email)) {
        $id = (int) $id_or_email;
        $userdata = service("Passport")->getLocalUser($id);
        $email = $userdata['email'];
    } else {
        $email = $id_or_email;
    }
    //设置默认头像
    if (empty($default)) {
        $default = 'mystery';
    }

    if (!empty($email))
        $email_hash = md5(strtolower($email));

    if (!empty($email))
        $host = sprintf("http://%d.gravatar.com", ( hexdec($email_hash[0]) % 2));
    else
        $host = 'http://0.gravatar.com';

    if ('mystery' == $default)
        $default = "$host/avatar/ad516503a11cd5ca435acc9bb6523536?s={$size}"; // ad516503a11cd5ca435acc9bb6523536 == md5('unknown@gravatar.com')
    elseif (!empty($email) && 'gravatar_default' == $default)
        $default = '';
    elseif ('gravatar_default' == $default)
        $default = "$host/avatar/s={$size}";
    elseif (empty($email))
        $default = "$host/avatar/?d=$default&amp;s={$size}";

    if (!empty($email)) {
        $out = "$host/avatar/";
        $out .= $email_hash;
        $out .= '?s=' . $size;
        $out .= '&amp;d=' . urlencode($default);

        $avatar = $out;
    } else {
        $avatar = $default;
    }

    return $avatar;
}

	/*
	 * 输出各种类型的数据，调试程序时打印数据使用。
	 * 参数：可以是一个或多个任意变量或值
	 */
	function p(){
		$args=func_get_args();  //获取多个参数
		if(count($args)<1){
			//Debug::addmsg("<font color='red'>必须为p()函数提供参数!");
			return;
		}	

		echo '<div style="width:100%;text-align:left"><pre>';
		//多个参数循环输出
		foreach($args as $arg){
			if(is_array($arg)){  
				print_r($arg);
				echo '<br>';
			}else if(is_string($arg)){
				echo $arg.'<br>';
			}else{
				var_dump($arg);
				echo '<br>';
			}
		}
		echo '</pre></div>';	
	}
	
//////////////////////////////////////////////////*/
//////////////////////////////////////////////////*/
 		function make_u_str($str='',$juarrjiexi=array(),$ciarrjiexi=array()){
		        //段
/*  		        $str="我看见过波澜壮阔的大海，玩赏过水平如镜的西湖，水平如镜的西湖却从没看见过漓江这样的水。漓江的水真静啊漓江，静得让你感觉不到它在流动；漓江的水真清啊，清得可以看见江底的沙石；水平如镜的西湖漓江的水真绿啊，绿得仿佛那是一块无瑕的翡翠。船桨激起的微波扩散出一道道水纹，才让你感觉到船在前进，岸在后移。";
		
		        //句子
		        $ju="水平如镜的西湖=>2|却从没看见过漓江这样的水。|水平如镜的西湖=>3|漓江的水真绿啊，绿得仿佛那是一块无瑕的翡翠。";
		        $jujiexi="水平如镜的西湖【2】|却从没看见过漓江这样的水。jx|水平如镜的西湖【3】|漓江的水真绿啊，绿得仿佛那是一块无瑕的翡翠。jx";
				
				
				//词语
				$ci="波澜壮阔|水平如镜=>2|漓江=>2|这样的水|漓江=>3|仿佛|无瑕的翡翠";
				//词语解析
				$jiexi="波澜壮阔jx|水平如镜【2】jx|漓江【2】jx|这样的水jx|漓江【3】jx|仿佛jx|无瑕的翡翠jx";

                //句子class
				$juclass="biyuju|paibiju|biyuju|paibiju";
				//词语class
                $ciclass="zdzi|zdzi|zdzi|zdzi|zdzi|zdzi|zdzi"; */

				
/*【第一部分】
$arr_ci_tjiexie     用户提交的词语解析
$arr_ju_tjiexi      用户提交的句子解析
$arr_ci_t           重组后用户提交的词语
$arr_ju_t           重组后用户提交的句子
$arr_ci_class     用户提交的词语class
$arr_ju_class      用户提交的句子class


$arr_ci_09_t_z      用户指定的第几个词语
$arr_ju_09_t_z      用户指定的第几个句子
*/     				$arr_ci_tclass=array();
				    $arr_ci_tjiexi=array();
				    $arr_ci_t=array();         
				    $arr_ju_tclass=array();
				    $arr_ju_tjiexi=array();
				    $arr_ju_t=array();

                    foreach($ciarrjiexi as $key =>$val){
				        $arr_ci_tclass[$key]=$val['class'];
				        $arr_ci_tjiexi[$key]=$val['tags'];
				        $arr_ci_t[$key]=$val['quanzi'];
						if($arr_ci_tjiexi[$key]==''){
						    $arr_ci_tjiexi[$key]="【意空】";
						}
				    }

                    foreach($juarrjiexi as $key =>$val){
				         $arr_ju_tclass[$key]=$val['class'];
				         $arr_ju_tjiexi[$key]=$val['tags'];
				         $arr_ju_t[$key]=$val['huaju'];
						 if($arr_ju_tjiexi[$key]==''){
						      $arr_ju_tjiexi[$key]="【意空】";
						 }
				    }



				//词语class
				//$arr_ci_tclass=explode('|',$ciclass);
				//句子class
				//$arr_ju_tclass=explode('|',$juclass);
				
				//词语解析
				//$arr_ci_tjiexi=explode('|',$jiexi);
				//句子解析
				//$arr_ju_tjiexi=explode('|',$jujiexi);	

				
				//将“漓江==2”加入$arr_ci_09_t_z数组，且重组了$arr_ci_t
				//$arr_ci_t=explode('|',$ci);
				
				            foreach($arr_ci_t as $key =>$val){
					                if(substr($val,-3,2)=="=="){
						                $arr_ci_t[$key]=substr($val,0,-3);//重组$arr_ci_t
						                $arr_ci_09_t_z[$key][substr($val,0,-3)]=substr($val,-1);
						            }else{
						                $arr_ci_09_t_z[$key][$val]=1;
						            }
					        }
				//重组了$arr_ju_t
				//$arr_ju_t=explode('|',$ju);
				            foreach($arr_ju_t as $key =>$val){
					                if(substr($val,-3,2)=="=="){
                                        $arr_ju_t[$key]=substr($val,0,-3);//重组$arr_ju_t
						                $arr_ju_09_t_z[$key][substr($val,0,-3)]=substr($val,-1);
                					}else{
						                $arr_ju_09_t_z[$key][$val]=1;
						            }
					        }
/*【第二部分】
$arr_shuang_t       重组后用户提交的词语和句子  ！！注意一定要先加入句子在加入词语
$str_new_quan       用$标记后的新总cijuzi划分段落
$str_new_ju         用|标记后的新总juzi划分的段落
*/

				//合并划线句和圈点词语
		        $arr_shuang_t=array_merge($arr_ju_t,$arr_ci_t);
                
                //将所有用户提交的句子词语重组str为str_new_quan，为
				$str_new_quan=$str;
		            foreach($arr_shuang_t as $key =>$val){
		            $str_new_quan=str_replace($val,"$".$val."$",$str_new_quan);
		            }			

				//将所有用户提交的句子重组str为str_new_ju，为了juid标记
				$str_new_ju=$str;
		            foreach($arr_ju_t as $key =>$val){
 		            $str_new_ju=str_replace($val,"|".$val."|",$str_new_ju);
		        }
/*【第三部分】
$arr_duan_q           所有断点数组
$arr_ju_q             句子断点数组
*/	        
                //所有断点数组
				$arr_duan_q=explode('$',$str_new_quan);//
				//句子的所有断点，为了juid标记
				$arr_ju_q=explode('|',$str_new_ju);
/*【第四部分】
每个小部分
$ok[key][content]     内容
$ok[key][in_ciarr]    是否在词语arr里面
$arr_duan_cf_val_id_09  整个段落里面相同片段
*/	 		
		        foreach($arr_duan_q as $key =>$val){
				
				    //如果为空，填充【空】
				    if($val==null){
					    $val="【空】";
						$arr_duan_q[$key]="";
					}
					//显示值
				    $ok[$key]['content']=$val;
					//判断是否是词语
					if(in_array($val,$arr_ci_t)){
					    $ok[$key]['in_ciarr']=true;
					}else{
					    $ok[$key]['in_ciarr']=false;
					}
					
					
					//////判断是否有重复
                    $arr_duan_cf_val_id_09[$val][]=$key;

		        }
				
				//重组$arr_duan_cf_val_id_09将次数与id对换
				foreach($arr_duan_cf_val_id_09 as $key =>$val){
					$arr_duan_cf_val_id_09[$key]=array_flip($val);
				}			
/*【第五部分】
$ok[$key]['whichtime']   每个在（整个段落里面相同片段）的对应次数 ！！片段里的‘’对应的是【空】，所以每个【空】没有whichtime
*/	 
				$fff=array_keys($arr_duan_cf_val_id_09);
		        foreach($arr_duan_q as $key =>$val){
				    
					
					//每个都比较下。如果相同就取值
				    for($i=0;$i<count($arr_duan_cf_val_id_09);$i++){

				        if($val==$fff[$i]){
  					        $ok[$key]['whichtime']=$arr_duan_cf_val_id_09[$val][$key]+1;
					    }
					}

		        }
/*【第六部分】
$juok[$key]['content']    句子的内容
$juok[$key]['in_juarr']   是否在句子arr里面
$ok[$i]['juid']           给所有片段加上juid
$arr_ju_cf_val_id_09  整个段落里面相同句子
*/	
				//给每个小段标记juid
				$hh=0;
				foreach($arr_ju_q as $key =>$val){
				    $stroo="";
					//如果句子为空
				    if($val==null){
					    $val="【句空】";
						$arr_ju_q[$key]="";
					}

					//创建新juok
					     $juok[$key]['content']=$val;	
                          //$juok[$key]['jujiexi']="jiexi";

					//是否在划线句子里
					if(in_array($val,$arr_ju_t)){
					    
						$juok[$key]['in_juarr']=true;				
					
					}else{
					    $juok[$key]['in_juarr']=false;
					}

					//给所有片段加上juid					
				        for($i=$hh;$i<count($arr_duan_q);$i++){
                            
 							if($ok[$i]['content']!="【空】"){
						        $stroo.=$ok[$i]['content'];
							} 
							if($val==$stroo ){
							    $stroo="";
								$hh=$i+1;


							}
						    $ok[$i]['juid']=$key;
						}

				    //////判断是否有重复
                    $arr_ju_cf_val_id_09[$val][]=$key;				


				}
				//重组$arr_ju_cf_val_id_09将次数与id对换
				foreach($arr_ju_cf_val_id_09 as $key =>$val){
					$arr_ju_cf_val_id_09[$key]=array_flip($val);
				}
/*【第七部分】
$juok[$key]['whichtime']   每个在（整个juzi里面相同片段）的对应次数 ！！片段里的‘’对应的是【句空】，所以每个【句空】没有whichtime
*/					
                $jufff=array_keys($arr_ju_cf_val_id_09);
				foreach($arr_ju_q as $key =>$val){
					//每个都比较下。如果相同就取值
				    for($i=0;$i<count($arr_ju_cf_val_id_09);$i++){

				        if($val==$jufff[$i]){
  					        $juok[$key]['whichtime']=$arr_ju_cf_val_id_09[$val][$key]+1;
					    }
					}

				}
/*【第八部分】
$arr_t_ci_jiexi_dijige[$key]['ci']     用户提交的词语
$arr_t_ci_jiexi_dijige[$key]['jiexi']  用户提交的解析
$arr_t_ci_jiexi_dijige[$key]['dijiege']用户提交的第几个

$arr_t_ju_jiexi_dijige[$key]['ci']     用户提交的词语
$arr_t_ju_jiexi_dijige[$key]['jiexi']  用户提交的解析
$arr_t_ju_jiexi_dijige[$key]['dijiege']用户提交的第几个
*/					
				
				//词语的具体内容
				foreach($arr_ci_t as $key =>$val){


					$arr_t_ci_jiexi_dijige[$key]['ci']=$val;
					$arr_t_ci_jiexi_dijige[$key]['jiexi']=$arr_ci_tjiexi[$key];
					$arr_t_ci_jiexi_dijige[$key]['ciclass']=$arr_ci_tclass[$key];
                    $arr_t_ci_jiexi_dijige[$key]['dijigezi']=$arr_ci_09_t_z[$key][$val];

		        }
				
				//
				foreach($arr_ju_t as $key =>$val){


					$arr_t_ju_jiexi_dijige[$key]['ju']=$val;
					$arr_t_ju_jiexi_dijige[$key]['jiexi']=$arr_ju_tjiexi[$key];
					$arr_t_ju_jiexi_dijige[$key]['juclass']=$arr_ju_tclass[$key];
                    $arr_t_ju_jiexi_dijige[$key]['dijigezi']=$arr_ju_09_t_z[$key][$val];

		        }
/*【第九部分】
$ok[$key]['jiexi']          词语解析
$juok[$key]['jiexi']        句子解析
*/					

				foreach($ok as $key =>$val){
                        $ok[$key]['jiexi']="";
						$ok[$key]['ciclass']="";
						for($i=0;$i<count($arr_t_ci_jiexi_dijige);$i++){
						
						    if($ok[$key]['content']==$arr_t_ci_jiexi_dijige[$i]['ci'] and $ok[$key]['whichtime']==$arr_t_ci_jiexi_dijige[$i]['dijigezi']){
							   
							   $ok[$key]['jiexi']=$arr_t_ci_jiexi_dijige[$i]['jiexi'];
							   $ok[$key]['ciclass']=$arr_t_ci_jiexi_dijige[$i]['ciclass'];
							}
						
						
						}

						

		        }
				foreach($juok as $key =>$val){
                        $juok[$key]['jiexi']="";
						$juok[$key]['juclass']="";
						for($i=0;$i<count($arr_t_ju_jiexi_dijige);$i++){
						       
						    if($juok[$key]['content']==$arr_t_ju_jiexi_dijige[$i]['ju'] and $juok[$key]['whichtime']==$arr_t_ju_jiexi_dijige[$i]['dijigezi']){
							   
							   $juok[$key]['jiexi']=$arr_t_ju_jiexi_dijige[$i]['jiexi'];
							   $juok[$key]['juclass']=$arr_t_ju_jiexi_dijige[$i]['juclass'];
							}

						}
				

		        }
				
/*【第十部分】
$juok[$i]['ciid'][$key]        将词语全部嫁接到同句子id里面
*/					
  			    foreach($ok as $key=> $val){
				
				    $ioio=$val;
					for($i=0;$i<count($arr_ju_q);$i++){
					
					    if($ioio['juid']==$i){
						    $juok[$i]['ciid'][$key]=$ok[$key];
						
						}
					
					
					
					}
				}
				
/*【第十一部分】
$new_ok         带词语解释的所有片段
$pstr           带词语解析的总段落
*/	

   				foreach($ok as $key => $val){
				    $new_ok[$key]['juid']=$ok[$key]['juid'];
					    if($ok[$key]['in_ciarr'] && $ok[$key]['jiexi']!=""){
						    switch($ok[$key]['ciclass']){
							    case "1":
								    if($ok[$key]['jiexi']=="【意空】"){
									    $new_ok[$key]['content']="<a class='huaci_0'>".$ok[$key]['content']."</a>";
									}else{
							            $new_ok[$key]['content']="<a class='huaci_1' rel='tooltip' data-placement='top' title='".$ok[$key]['jiexi']."'>".$ok[$key]['content']."</a>";
									}
                                    break;
							    case "2":
								    if($ok[$key]['jiexi']=="【意空】"){
									    $new_ok[$key]['content']="<i class='text-huaqu text-muted' title='划去'>".$ok[$key]['content']."</i>";
									}else{
							            $new_ok[$key]['content']="<i class='text-huaqu text-muted' title='划去'>".$ok[$key]['content']."</i><i class='text-primary' title='修正后'>".$ok[$key]['jiexi']."</i>";
									}
                                    break;
								default:
								    $new_ok[$key]['content']=$ok[$key]['content'];
							}
						}else{
						    $new_ok[$key]['content']=$ok[$key]['content'];
						}
				}

				
                foreach($juok as $key => $val){
						    $d_content[$key]['content']="";
		
						    for($i=0;$i<count($new_ok);$i++){
							    if($new_ok[$i]['juid']==$key and $new_ok[$i]['content']!="【空】"){
							        $d_content[$key]['content'].=$new_ok[$i]['content'];
								}
							}				    
					    if($juok[$key]['in_juarr']  && $juok[$key]['jiexi']!=""){
                            switch($juok[$key]['juclass']){
							    case "1":
								
								    if($juok[$key]['jiexi']=="【意空】"){
									    $new_juok[$key]['content']="<font class='jiexiceng huaxian_1' title='' >".$d_content[$key]['content']."</font>";
							        }else{
									    $new_juok[$key]['content']="<font class='jiexiceng huaxian_2' title='' data-content='".$juok[$key]['jiexi']."' data-placement='bottom' data-toggle='popover'  data-original-title='' >".$d_content[$key]['content']."</font>";
									}
									break;
								default:
								    $new_juok[$key]['content']=$d_content[$key]['content'];		
							
							}
						}else{
                            $new_juok[$key]['content']=$d_content[$key]['content'];						
						}
				}
				
			$pstr="";

			
				foreach($new_juok as $key => $val){
                        if($val['content']!=""){
					        $pstr.=$val['content'];
				        }
				} 
				
				
				
				
			
/*【第十二部分】

*/					

                
				return($pstr);
				
				
				//$uui=implode('',$new_ok);
		}
/////////////////////////////////////////////////////
/*【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【【
】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】】
============================================================================================*/


	
	
	
/**************************************************************
 *
 *	使用特定function对数组中所有元素做处理
 *	@param	string	&$array		要处理的字符串
 *	@param	string	$function	要执行的函数
 *	@return boolean	$apply_to_keys_also		是否也应用到key上
 *	@access public
 *
 *************************************************************/
function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    static $recursive_counter = 0;
    if (++$recursive_counter > 1000) {
        die('possible deep recursion attack');
    }
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }
 
        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter--;
}
 
/**************************************************************
 *
 *	将数组转换为JSON字符串（兼容中文）
 *	@param	array	$array		要转换的数组
 *	@return string		转换得到的json字符串
 *	@access public
 *
 *************************************************************/
function JSON($array) {
	arrayRecursive($array, 'urlencode', true);
	$json = json_encode($array);
	return urldecode($json);
}



/**
 * 分页输出
 * @staticvar array $_pageCache
 * @param type $Total_Size 信息总数
 * @param type $Page_Size 每页显示信息数量
 * @param type $Current_Page 当前分页号
 * @param type $List_Page 每次显示几个分页导航链接
 * @param type $PageParam 接收分页号参数的标识符
 * @param type $PageLink 分页规则 
 *                          array(
  "index"=>"http://www.abc3210.com/192.html",//这种是表示当前是首页，无需加分页1
  "list"=>"http://www.abc3210.com/192-{page}.html",//这种表示分页非首页时启用
  )
 * @param type $static 是否开启静态
 * @param string $TP 模板
 * @param array $Tp_Config 模板配置
 * @return array|\Page
 */
function page($Total_Size = 1, $Page_Size = 0, $Current_Page = 0, $List_Page = 6, $PageParam = '', $PageLink = '', $static = FALSE, $TP = "", $Tp_Config = "") {
    static $_pageCache = array();
    $cacheIterateId = to_guid_string(func_get_args());
    if (isset($_pageCache[$cacheIterateId])) {
        return $_pageCache[$cacheIterateId];
    }
    import('ORG.Util.Page');
    //分页数
    if ($Page_Size == 0) {
        $Page_Size = C("PAGE_LISTROWS");
    }
    //接收分页号参数的标识符
    if (!$PageParam) {
        $PageParam = C("VAR_PAGE");
    }
    //生成静态，需要传递一个常量URLRULE，来生成对应规则
    //不建议使用常量定义分页规则，推荐直接传统参数方式
    if (empty($PageLink) && $static) {
        $URLRULE = $GLOBALS['URLRULE'] ? $GLOBALS['URLRULE'] : URLRULE;
        $PageLink = array();
        if (!is_array($URLRULE)) {
            $URLRULE = explode("~", $URLRULE);
        }
        $PageLink['index'] = $URLRULE['index'] ? $URLRULE['index'] : $URLRULE[0];
        $PageLink['list'] = $URLRULE['list'] ? $URLRULE['list'] : $URLRULE[1];
    }
    if (!$Tp_Config) {
        $Tp_Config = array("listlong" => "6", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => "");
    }
    $Page = new Page($Total_Size, $Page_Size, $Current_Page, $List_Page, $PageParam, $PageLink, $static);
    $Page->SetPager('default', $TP, $Tp_Config);
    $_pageCache[$cacheIterateId] = $Page;

    return $_pageCache[$cacheIterateId];
}