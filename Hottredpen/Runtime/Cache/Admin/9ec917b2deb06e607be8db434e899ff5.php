<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="robots" content="nofollow" /><!--nofollow-->
<title>后台管理系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="__PUBLIC__/css/boot3/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="__PUBLIC__/css/boot3/style.css" rel="stylesheet" media="screen" />
<link href="__PUBLIC__/js/star/rateit.css" rel="stylesheet" media="screen" />
<link href="__PUBLIC__/js/colorbox/colorbox.css" rel="stylesheet" media="screen" />
<script src="__PUBLIC__/js/boot3/jquery.js"></script>
<script src="__PUBLIC__/js/boot3/bootstrap.min.js"></script>
<script src="__PUBLIC__/js/ajaxForm.js"></script>
<script src="__PUBLIC__/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$(".jk-kj_com").colorbox({ rel: 'group1',loop:false});
});
</script>
</head>
<body id="body">
<header>
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><font class="text-info">简看空间</font><small>后台管理</small></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/admin">后台首页</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">栏目切换<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="__ROOT__/Admin/basic/index.html">全站基础设置</a></li>
            <li><a href="__ROOT__/Admin/Log/QianTaiLog.html">前后操作记录</a></li>
            <li><a href="__ROOT__/Admin/jifen/index.html">积分等级配置</a></li>
            <li class="divider"></li>
            <li><a href="__ROOT__/Admin/Article/lanmu.html">文章相关管理</a></li>
            <li class="divider"></li>
            <li><a href="__ROOT__/Admin/Tags/alltags.html">Tags管理</a></li>
            <li class="divider"></li>
            <li><a href="__ROOT__/Admin/User.html">用户管理</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/">前台首页</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo (session('admin_name')); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">修改密码</a></li>
            <li class="divider"></li>
            <li><a  href="<?php echo U('Admin/Logo/loginout');?>" >退出</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>
<div class="container">
        	<h2>主要功能</h2>
            <div class="col-md-10 col-md-offset-2">
                <div class="col-md-2">
					<a  class="btn btn-default btn-md" href="__ROOT__/Admin/basic/index.html">
					  <span class="glyphicon glyphicon-star"></span>全站基础设置
					</a>
                </div>
                <div class="col-md-2">
					<a  class="btn btn-default btn-md" href="__ROOT__/Admin/Log/QianTaiLog.html">
					  <span class="glyphicon glyphicon-star"></span>前后操作记录
					</a>
                </div>
                <div class="col-md-2">
					<a  class="btn btn-default btn-md" href="__ROOT__/Admin/jifen/index.html">
					  <span class="glyphicon glyphicon-star"></span>积分等级配置
					</a>
                </div>
                <div class="col-md-2">
					<a  class="btn btn-default btn-md" href="__ROOT__/Admin/Article/lanmu.html">
					  <span class="glyphicon glyphicon-star"></span>文章相关管理
					</a>
                </div>
                <div class="col-md-2">
					<a  class="btn btn-default btn-md" href="__ROOT__/Admin/Tags/alltags.html">
					  <span class="glyphicon glyphicon-star"></span>Tags管理
					</a>
                </div>
                <div class="col-md-2">
					<a  class="btn btn-default btn-md" href="__ROOT__/Admin/User.html">
					  <span class="glyphicon glyphicon-star"></span>用户管理
					</a>
                </div>
            </div>
			<div class="clean"></div>
			<h2>快捷导航</h2>
            <div  class="col-md-10 col-md-offset-2">
                <div class="col-md-2">
					<a  class="btn btn-default btn-md" href="__ROOT__/Admin/Article/zuowenList/year/2014.html">
					  <span class="glyphicon glyphicon-star"></span>添加作文（2014）
					</a>
                </div>
            </div>
			<div class="clean"></div>
            <h3>服务器信息</h3>
            <div  class="col-md-10">
            	<div class="col-md-4">
                    <dl class="dl-horizontal">
                        <dt>环境：</dt><dd><?php echo php_sapi_name();?></dd>
                        <dt>PHP版本：</dt><dd><?php echo PHP_VERSION;?></dd>
                        <dt>Zend版本：</dt><dd><?php echo Zend_Version();?></dd>
                        <dt>PHP安装路径：</dt><dd><?php echo DEFAULT_INCLUDE_PATH;?></dd>
                        <dt>mysql版本：</dt><dd><?php echo mysql_get_server_info();;?></dd>  
                    </dl>
                </div>
                <div class="col-md-4">
                    <dl class="dl-horizontal">
                    	<dt>系统类型：</dt><dd><?php echo php_uname('s');?></dd>
                        <dt>系统版本号：</dt><dd><?php echo php_uname('r');?></dd>
                        <dt>服务器IP：</dt><dd><?php echo GetHostByName($_SERVER['SERVER_NAME']);?></dd>
                        <dt>服务器解译引擎：</dt><dd><?php echo $_SERVER['SERVER_SOFTWARE'];?></dd>
                        <dt>服务器语言：</dt><dd><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></dd>
                    </dl>
                </div>
            </div>
<!--底部 -->
<div class="clean"></div>
</body>
</html>