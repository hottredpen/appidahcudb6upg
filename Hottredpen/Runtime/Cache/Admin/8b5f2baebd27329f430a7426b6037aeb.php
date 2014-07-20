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
	<!-- left menu starts 
<div class="span2 main-menu-span">		
    <div class="well nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li class="nav-header hidden-tablet">菜单</li>
            <li><a class="ajax-link" href="__ROOT__/Admin/Basic/index.html"><i class="icon-cog"></i><span class="hidden-tablet"> 系统设置</span></a></li>
            <li><a class="ajax-link" href="__ROOT__/Admin/Basic/email.html"><i class="icon-envelope"></i><span class="hidden-tablet"> 邮箱设置</span></a></li>
        </ul>
    </div> well --
</div><!--/span-->
<!-- left menu ends -->

<div class="col-md-2">
        <div data-spy="affix" data-offset-top="60" data-offset-bottom="200" >
            <ul class="nav bs-docs-sidenav">
						<li class=""><a href="__ROOT__/Admin/Basic/index.html">系统设置</a></li>
						<li class=""><a href="__ROOT__/Admin/Basic/email.html">邮箱设置</a></li>
            </ul>
        </div>
</div>
    <div id="content" class="col-md-10">
		<ul class="breadcrumb">
			  <li><a href="__ROOT__/Admin.html">首页</a></li>
			  <li><a href="__ROOT__/Admin/basic/index">全站基础设置</a></li>
			  <li class="active">系统设置</li>
			  <li class="active">修改</li>
		</ul>
<form method="post"  action='__URL__/upda'>
<input name="q" type="hidden" value="sys" />
<input name="u" type="hidden" value="__ROOT__/Admin/Index/system.html" />
<input name="sid" type="hidden" value="<?php echo ($_GET['id']); ?>" />
<input name="n" type="hidden" value="参数更新" />
 <table class="table table-striped table-bordered table-condensed">
 <?php if(is_array($edlist)): $i = 0; $__LIST__ = $edlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ed): $mod = ($i % 2 );++$i;?><tbody>
	  <tr>
		<td>
			   参数说明：
		</td>
		<td>
		  <input name="state" type="text" class="span5" placeholder="请输入参数说明..." value="<?php echo ($ed["state"]); ?>">
		</td>
	  </tr>
	  <tr>
		<td>
			   输入提示：
		</td>
		<td>
		  <input name="prompt" type="text" class="span5" placeholder="请输入输入提示..." value="<?php echo ($ed["prompt"]); ?>">
		</td>
	  </tr>
	  <tr>
		<td>
			   参数值：
		</td>
		<td>
		  <input name="value" type="text" class="span5" placeholder="请输入参数值..." value="<?php echo ($ed["value"]); ?>">
		</td>
	  </tr>
	  <tr>
		<td>
			   变量名：
		</td>
		<td>
		  <input name="name" type="text" class="span5" placeholder="请输入变量名以sys_开头..."  value="<?php echo ($ed["name"]); ?>">
		</td>
	  </tr>
	  <tr>
		<td>
			   表单类型：
		</td>
		<td class="form-inline">
		  <label class="radio"><input type="radio" name="type" value="1" <?php if(($ed["type"]) == "1"): ?>checked<?php endif; ?>/> 文本域</label>
		  <label class="radio"><input type="radio" name="type" value="2" <?php if(($ed["type"]) == "2"): ?>checked<?php endif; ?>/> 文本区域</label>
		  <label class="radio"><input type="radio" name="type" value="3" <?php if(($ed["type"]) == "3"): ?>checked<?php endif; ?>/> 文件域</label>
		</td>
	  </tr>
	</tbody><?php endforeach; endif; else: echo "" ;endif; ?>
 </table>
<div>
<div class="span4">

</div>
<div class="span5">
          <button class="btn btn-primary" type="submit">
              确认修改
          </button>
            <a href="__ROOT__/Admin/Index/system.html" class="btn btn-info ajax-link">取消</a>
			<input name="id" type="hidden" value="<?php echo ($ed["id"]); ?>" />
</div>
</div>
</form>
<!--底部 -->
<div class="clean"></div>
</body>
</html>