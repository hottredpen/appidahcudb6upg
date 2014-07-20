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
<style type="text/css">
.cla1{ font-weight:600; font-size:14px;}
.cla2{ font-weight:500; font-size:12px; margin-left:5px;}
.cla3{ font-weight:500; font-size:10px; margin-left:10px;}
</style>
<div class="container">
	<div class="col-md-2">
        <div data-spy="affix" data-offset-top="60" data-offset-bottom="200" >
            <ul class="nav bs-docs-sidenav">
						<li class=""><a href="__ROOT__/Admin/Article/lanmu.html">栏目管理</a></li>
						<?php if(is_array($lanmu_id_entitle)): $i = 0; $__LIST__ = $lanmu_id_entitle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="__ROOT__/Admin/Article/<?php echo ($vo); ?>List.html"><i class="icon-book"></i><span class="hidden-tablet"><?php echo ($vo); ?>管理</span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
</div>
	<div id="content" class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="__ROOT__/Admin.html">首页</a></li>
			<li><a href="__ROOT__/Admin/Article/lanmu.html">文章相关管理</a></li>
			<li class="active">栏目管理</li>
			<div  class="pull-right"> 
			    <a href="__ROOT__/Admin/Article/addlanmu.html">添加新栏目</a>
			</div>
		</ul>
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th>栏目ID</th>
                <th>栏目名称</th>
				<th>英文名称</th>
				<th>栏目关键词</th>
                <th>栏目描述</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
			 <?php if(is_array($lanmulist)): $i = 0; $__LIST__ = $lanmulist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["id"]); ?></td>
                <td>
                <a>
                  <span class="cla<?php echo ($vo["order"]); ?>">
                    <?php if($vo['order'] == 1 ): echo ($vo["title"]); ?>
                    <?php elseif($vo['order'] == 2 ): ?>
                       ├ <?php echo ($vo["title"]); ?>
                    <?php elseif($vo['order'] == 3 ): ?> 
                       │├ <?php echo ($vo["title"]); endif; ?>
                  </span>
                </a>
                </td>
				<td><?php echo ($vo["entitle"]); ?></td>
				<td><?php echo ($vo["keywords"]); ?></td>
                <td><?php echo ($vo["description"]); ?></td>
                <td>
                    <a href="__ROOT__/Admin/Article/editlanmu/id/<?php echo ($vo["id"]); ?>.html" title="编辑栏目"><span class="glyphicon glyphicon-pencil"></span></a>
                    <?php if(intval($vo['order']) < 3 ): ?><a href="__ROOT__/Admin/Article/addlanmu/pid/<?php echo ($vo["id"]); ?>.html" data-rel="tooltip"  class="icon icon-color icon-plus" title="添加子栏目"><span class="glyphicon glyphicon-tasks"></span></a><?php endif; ?>
                    <a href="#" title="删除栏目" onclick="if(confirm('是否要删除？'))window.location.href='__URL__/dellanmu/id/<?php echo ($vo["id"]); ?>'"><span class="glyphicon glyphicon-trash"></span></a>
                   
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table>          
    </div>
</div>
<div class="clean"></div>
</body>
</html>