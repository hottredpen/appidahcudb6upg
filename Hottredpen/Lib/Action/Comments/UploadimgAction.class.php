<?php

/**

 */
class UploadimgAction extends Action {
	public $uploader = null;


	/* 上传图片 */
	public function upload(){
	    $mod=str_replace('/','',$_GET['mod']);
		/* 上传配置 */
		$setting = C('EDITOR_UPLOAD');
		$setting['savePath']=$mod."/";
        import("ORG.Util.Upload");
		/* 调用文件上传组件上传文件 */
		$this->uploader = new Upload($setting, 'Local');
		$info   = $this->uploader->upload($_FILES);
		if($info){
			$url = C('EDITOR_UPLOAD.rootPath').$info['imgFile']['savepath'].$info['imgFile']['savename'];
			$url = str_replace('./', '/', $url);
			$info['fullpath'] = __ROOT__.$url;
		}
		return $info;
	}
	//keditor编辑器上传图片处理
	public function ke_upimg(){
		/* 返回标准数据 */
		$return  = array('error' => 0, 'info' => '上传成功', 'data' => '');
		$img = $this->upload();
		/* 记录附件信息 */
		if($img){
			$return['url'] = $img['fullpath'];
			unset($return['info'], $return['data']);
		} else {
			$return['error'] = 1;
			$return['message']   = $this->uploader->getError();
		}

		/* 返回JSON数据 */
		exit(json_encode($return));
	}
	
	
}

?>
