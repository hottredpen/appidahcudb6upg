<?php
class PingxingAction extends Action {
    //json格式
    public function cha() {
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
        $this->db = M(strtolower($tablename));
        $data=$this->db->where(array('id' => $id))->find();
		//获取原有数组
		$oldarr=unserialize($data['allstar']);
		//所有评星数
		if($oldarr==null){
		    $numb=0;
		}else{
		    $numb=count($oldarr);
		}
		$zongfen=0;
	    foreach($oldarr as $key =>$val){
		    $zongfen+=$oldarr[$key];
		}
		
		
		if($_SESSION['user_uid']){
			$uid_id="uid_".$_SESSION['user_uid'];
			if($oldarr[$uid_id]){
		        $return['xingxing']=$oldarr[$uid_id];
			}else{
			    $return['xingxing']=0;
			}
			$return['islogin']=1;
		}else{
		    $return['xingxing']=0;
			$return['islogin']=0;
		}
		//人数
		$return['renshu']=$numb;
        //平均分.保留小数两位
        $return['pingjunfen']=floor($zongfen/$numb*100)/100;
        //返回
		echo json_encode($return);


    }
    //json格式
    public function dian() {
     	//几星
        $jixing = $this->_post('jixing');
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
        $this->db = M(strtolower($tablename));
        $data=$this->db->where(array('id' => $id))->find();

		
			if($data){
			    //获取原有数组
			    $oldarr=unserialize($data['allstar']);
				
				if($oldarr){
				    $newarr=array("uid_".$_SESSION['user_uid']=>(int)$jixing);
                    $arr=array_merge($oldarr,$newarr);
									//需要返回的内容
									$numb=count($arr);
									$zongfen=0;
									foreach($arr as $key =>$val){
										$zongfen+=$arr[$key];
									}
									//人数
									$return['renshu']=$numb;
									//平均分.保留小数两位
									$return['pingjunfen']=floor($zongfen/$numb*100)/100;
         			$savedata['allstar']=serialize($arr);
					$savedata['starrenshu']=$return['renshu'];
					$savedata['starfenshu']=$return['pingjunfen'];
			    //原来是空的情况
			    }else{
									//需要返回的内容
									//人数
									$return['renshu']=1;
									//平均分.保留小数两位
									$return['pingjunfen']=(int)$jixing;
                    $savedata['allstar']=serialize(array("uid_".$_SESSION['user_uid']=>(int)$jixing));
					$savedata['starrenshu']=$return['renshu'];
					$savedata['starfenshu']=$return['pingjunfen'];
				}

			    $result	=	$this->db->where(array('id'=>$id))->save($savedata);
			    if(false !== $result) {
                    echo json_encode($return);
		        }
			}
    }
 
}

?>
