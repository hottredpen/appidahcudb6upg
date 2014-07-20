<?php

class catModel extends Model {

		function artmuselect($name="pid", $value="0"){
		    
			$data=$this->field('id,c_name,concat(c_path,"-",id) abspath')->order("abspath,id asc")->select();
			

			$html='<select name="'.$name.'">';
			$html.='<option value="0">根分类</option>';
			foreach($data as $val){
				if($value==$val["id"])
					$html.='<option selected value="'.$val['id'].'">';
				else
					$html.='<option value="'.$val['id'].'">';

				$num=count(explode("-", $val["abspath"]))-2;
				$space=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$num);	
				$name=$val["c_name"];
				$html.=$space."|--".$name;
				$html.='</option>';	
			}
			$html.='</select>';

			return $html;
		}
		function artwenselect($name="pid", $value="0",$ceid){
		    
			$dd=$this->where(array('id'=>$ceid))->find();
			$data=$this->field('id,c_name,concat(c_path,"-",id) abspath')->where(array('c_path'=>$dd['c_path']."-".$dd['id']))->order("abspath,id asc")->select();
			

			$html='<select name="'.$name.'">';
			$html.='<option value="'.$ceid.'">'.$dd["c_name"].'</option>';
			foreach($data as $val){
				if($value==$val["id"])
					$html.='<option selected value="'.$val['id'].'">';
				else
					$html.='<option value="'.$val['id'].'">';

				$num=count(explode("-", $val["abspath"]))-2;
				$space=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$num);	
				$name=$val["c_name"];
				$html.=$space."|--".$name;
				$html.='</option>';	
			}
			$html.='</select>';

			return $html;
		}
		
		
		function cat_cache(){
		
		    $data=$this->select();
			
			foreach($data as $key =>$val){
			    $ffff[$val['id']]=$val;
			}
			F("cat",$ffff);
            return true;
		}
		function cat2_cache(){
		
		    $data=$this->select();
			
			foreach($data as $key =>$val){
			    //存在en_name
			    if($val['en_name']){
			        $ffff[$val['model']."-".$val['dongzuo']."-".$val['en_name']]=$val;
				}
			}
			F("cat2",$ffff);
            return true;
		}


}