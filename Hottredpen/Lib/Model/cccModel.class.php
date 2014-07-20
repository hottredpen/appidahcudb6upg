<?php

class cccModel extends Model {

		function ccc_cache(){
		
		    $data=$this->select();
			
			foreach($data as $key=>$val){
			     $arrce[$val["pid"]][$val["kewenid"]]=$val;
				 $arrce[$val["pid"]]["kelei"]=$data[$key]["kelei"];
				 $arrce[$val["pid"]]["kemulei"]=$data[$key]["kemulei"];
			}
			
			foreach($arrce as $key =>$val){
			
			     $kelei=$val["kelei"];
				 $kemulei=$val["kemulei"];
			     unset($val["kelei"]);
				 unset($val["kemulei"]);
			     F($kemulei."-".$kelei,$val,DATA_PATH."/ce/");
			
			}
			//F("kewen",$data,RUNTIME_PATH."/Data/ss/");
            return true;
		}



}