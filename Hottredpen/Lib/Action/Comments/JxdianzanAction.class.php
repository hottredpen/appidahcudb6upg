<?php
class JxdianzanAction extends Action {
    //json格式
    public function dian() {
     	//几星
        $jixing =$_POST['zan'];
		//解析id
		$jxid=$_POST['jxid'];
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
		if($_SESSION['user_uid']==null){
		    //未登录
            $return['islogin']=0;
			echo json_encode($return);
		}else{
            $return['islogin']=1;
		
			$this->db = M(strtolower($tablename)."_jiexi");
			$data=$this->db->where(array('id' => $jxid))->find();

				if($data){
					//获取原有数组
					$oldarr=unserialize($data['allstar']);
					
					if($oldarr){
					
										$uid_id="uid_".$_SESSION['user_uid'];
										if($oldarr[$uid_id]){
											$return['iszan']=1;
											echo json_encode($return);
										}else{
										    $return['iszan']=0;
											$newarr=array("uid_".$_SESSION['user_uid']=>(int)$jixing);
											$arr=array_merge($oldarr,$newarr);
															//需要返回的内容
															$numb=count($arr);
															foreach($arr as $key =>$val){
																if($val==1){
																	//up人数
																	$return['uprenshu']+=1;										
																}else if($val==-1){
																	//up人数
																	$return['downrenshu']+=1;	
																}
															}
															$savedata['allstar']=serialize($arr);
															$savedata['uprenshu']=$return['uprenshu'];
															$savedata['downrenshu']=$return['downrenshu'];
															
											$result	=	$this->db->where(array('id'=>$jxid))->save($savedata);
											if(false !== $result) {
												echo json_encode($return);
											}															
															
										}
					//原来是空的情况
					}else{
											if($jixing==1){
											    //up人数
										        $return['uprenshu']=1;										
											}else if($jixing==-1){
											    //up人数
										        $return['downrenshu']=1;	
											}

						                $savedata['allstar']=serialize(array("uid_".$_SESSION['user_uid']=>(int)$jixing));
										$savedata['uprenshu']=$return['uprenshu'];
										$savedata['downrenshu']=$return['downrenshu'];
						
										$result	=	$this->db->where(array('id'=>$jxid))->save($savedata);
										if(false !== $result) {
											echo json_encode($return);
										}
					}


				}
		}
    }
 
}

?>
