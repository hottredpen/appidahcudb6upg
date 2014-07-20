<?php

/**
 * 评论
 * Some rights reserved：abc3210.com
 * Contact email:admin@abc3210.com
 */
class IndexAction extends Action {

    public $setting;
    protected $db;

    /**
     * 生成树型结构所需要的2维数组
     * @var array
     */
    protected $arr = array();

    function _initialize() {
       // parent::_initialize();
        $this->db = D("Comments");
        //$this->setting = F("Comments_setting");
        //if (!$this->setting) {
            //$this->setting = $this->db->comments_cache();
        //}
    }

    //显示信息评论,json格式
    public function json() {
        
		$id=$_GET["id"];

		$c=M("comments");



		
	    $data=$c->where(array('comment_id'=>$id))->select();
		
		foreach($data as $key =>$val){
		    if($val['parent']==0){
		        $uudu[$key]=$val;
			}else{
			    $wwdu[$key]=$val;
			}
		
		}
		
		foreach($uudu as $key =>$val){
		
		    $ii=0;
		    foreach($wwdu as $key2 =>$val2){
		        if($val2['parent']==$val['id'] ){
				    $ii+=1;
			        $uudu[$key]['child'][$val2['id']]=$val2;
					if($ii>2){
					
					$uudu[$key]['child'][$val2['id']]['display']='none';
				    break;
					}
					
			    }			
			}

		}

		
        //最终返回数组
        $return = array(
            //配置
            'config' => array(
                'guest' => 1,//是否运行游客评论
                'code' => 0, //验证码
                'strlength' => 300, //评论长度
                'expire' => 60, //评论间隔
                'noallow' => true //是否允许评论
            ),
            //当前登陆会员信息
            'users' => array(
                'user_id' => 0,
                'name' => '',
                'email' => '',
                'avatar' =>'',
            ),
            //评论列表 去除键名，不然json输出会印象排序
            'response' => $uudu,
            //分页相关
            'cursor' => array(
                'pagetotal' => 2, //总页数
                'total' => count($data), //总信息数
				'page'=> 1, //当前分页
                'size' => 10, //每页显示多少
                //C("VAR_PAGE") => $page, //当前分页号
            )
        );	
	

        $this->ajaxReturn(array(
            'data' => $return,
            'info' => '',
            'status' => true,
                ), 'JSONP');  
				
		//dump($uudu);
    }

    //取得某条评论下的全部回复评论
    public function json_reply() {
        $parent =$_GET["parent"];
        $mokuai=$_GET["mokuai"];
		$pid=$_GET["pid"];
	
		switch ($mokuai){
		    case "knjx":
			    $c=M("comments");
				break;
		    case "ydxl":
			    $c=M("yuedu_pilun");
				break;
		    case "new":
			    //$c=M("zuowen_pilun");
				$c=M("comments");
				break;					
		}

	    $data=M("comments")->where(array('parent'=>$parent))->select();

	
		
        //最终返回数组
        $return = array(
            //评论列表 去除键名，不然json输出会印象排序
            'response' => $data,
        );		
          $this->ajaxReturn(array(
            'data' => $return,
            'info' => '',
            'status' => true,
                ), 'JSONP');  
				
		//dump($return);
    }

    //获取评论表情
    public function json_emote() {

        $cacheReplaceExpression = D('Comments/Emotion')->cacheReplaceExpression();

        // jsonp callback
        $callback = I('get.callback');
        $this->ajaxReturn(array(
            'data' => array('<img src="http://127.0.0.1/fdzzj/Public/images/logo.gif" alt="[haha]" title="[haha]" />'),
            'info' => '',
            'status' => true,
                ), (isset($_GET['callback']) && $callback ? 'JSONP' : 'JSON'));
    }

    //显示某篇信息的评论页面
    public function comment() {
        //所属文章id
        $comment_id = I('get.commentid', '', '');
        //评论
        $id = I('get.id', 0, 'intval');
        if (!$comment_id && !$id) {
            $this->error('缺少参数！');
        }
    }

    //添加评论 
    public function add() {
		$pid=$_POST["comment_id"];

		$c=M("comments");

			
		    if(!$c->create()) {
			        $this->error($c->getError());
		    }
            $_POST['date']=mktime();
		    $commentsId	=$c->add($_POST);
		    if(false !== $commentsId) {
				$this->ajaxReturn(array(
                        $this->ajaxReturn(array(
                            'info' => "ssss",
                            'status' => $commentsId,
                        ));
				));
		    }else{
			    $this->error('课类修改失败!','index');
		    }

	

    }

    /**
     * 使用递归的方式查询出回复评论...效率如何俺也不清楚，能力限制了。。
     * @param type $id
     * @return boolean
     */
    protected function getParentComment($id) {
        if (!$id) {
            return false;
        }
        $where = array(
            'parent' => $id,
            'approved' => 1,
        );
        $count = $this->db->where($where)->count();
        //如果大于5条以上，只显示最久的第一条，和最新的3条
        if ($count > 2) {
            $oldData = $this->db->where($where)->order(array('date' => 'ASC'))->find();
            $newsData = $this->db->where($where)->limit(2)->order(array('date' => 'DESC'))->select();
            //数组从新排序
            sort($newsData);
            array_unshift($newsData, $oldData, array(
                'id' => 'load',
                'display' => 'none', //标识这条评论不显示
                'comment_id' => $oldData['comment_id'],
                'parent' => $oldData['parent'],
                'info' => '已经省略中间部分...',
            ));
            $data = $newsData;
        } else {
            $data = $this->db->where($where)->order(array('date' => 'ASC'))->select();
        }
        if ($data) {
            foreach ($data as $r) {
                $this->getParentComment((int) $r['id']);
                $this->arr[] = $r;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 得到子级数组
     * @param int
     * @return array
     */
    protected function get_child($myid) {
        $a = $newarr = array();
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['parent'] == $myid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr ? $newarr : false;
    }

    /**
     * 得到树型结构数组
     * @param int $myid，开始父id
     */
    protected function get_tree_array($myid = 0) {
        $retarray = array();
        //一级栏目数组
        $child = $this->get_child($myid);
        if (is_array($child)) {
            //数组长度
            $total = count($child);
            foreach ($child as $id => $value) {
                @extract($value);
                $retarray[$value['id']] = $value;
                $retarray[$value['id']]["child"] = $this->get_tree_array($id, '');
            }
        } else {
            return false;
        }
        return array_values($retarray);
    }

}

?>
