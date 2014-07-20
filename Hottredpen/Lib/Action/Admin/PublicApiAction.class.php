<?php
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
defined('THINK_PATH') or exit();
class PublicApiAction extends Action{
    public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
}

?>