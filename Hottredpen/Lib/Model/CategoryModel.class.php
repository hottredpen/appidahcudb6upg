<?php

class CategoryModel extends Model {
	
		function category_cache(){
		
		    $data=$this->select();
			foreach($data as $key =>$val){
			    $ffff[$val['id']]=$val;
			}
			F("category",$ffff);
            return true;
		}
		
		function category2_cache(){
		
		    $data=$this->select();
			
			foreach($data as $key =>$val){
			    //存在en_name
			    if($val['letter']){
			        $ffff[$val['module']."-".$val['dongzuo']."-".$val['letter']]=$val;
				}
			}
			F("category2",$ffff);
            return true;
		}

}