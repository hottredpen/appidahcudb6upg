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
			<li><a href="__ROOT__/Admin/Article/<?php echo ($article["mod"]); ?>List.html"><?php echo ($article["modname"]); ?></a></li>
			<li class="active"><?php echo ($article["title"]); ?></li>
			<div  class="pull-right"> 
			    <a href="__ROOT__/Admin/Article/<?php echo ($article["mod"]); ?>tianduan/pid/<?php echo ($pid); ?>.html">添加段落</a>
			</div>
		</ul>
			<form method="post"  action='__URL__/<?php echo ($article["mod"]); ?>delduan' name="myform" id="myform">
				<input name="pid" type="hidden" value="<?php echo ($pid); ?>" />
					<div id="myTabContent" class="tab-content">

						<div class="tab-pane fade in active" id="home">
							<table class="table table-striped table-bordered table-condensed" id="articleList" name="articleList" title="<?php echo ($_GET['id']); ?>">
								<thead>
								  <tr>
									<th>文章ID</th>
									<th>段落ID</th>
									<th>类型(字0/图1)</th>
									<th>段落内容</th>
									<th>操作</th>
								  </tr>
								</thead>
								<tbody>
								 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
									<td><?php echo ($vo["pid"]); ?></td>
									<td><?php echo ($vo["duanid"]); ?></td>
									<td><?php echo ($vo["leixing"]); ?></td>
									<?php if(($vo['leixing'] == '0')): ?><td><?php echo ($vo["content"]); ?></td>
									<?php else: ?>
									<td><?php echo ($vo["content"]); ?></td><?php endif; ?>
									<td>删除<input name="del['<?php echo ($vo["duanid"]); ?>']" type="checkbox" value="<?php echo ($vo["duanid"]); ?>"></td>
								  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							   
							</table>          
					  </div>

					  <div class="modal-footer">
						  <button type="submit" class="btn btn-primary" >确认</button>
					  </div>
					 

					<div class="pagination pagination-centered">
					<ul><?php echo ($Page); ?></ul>
					</div>
				
				</div>
			   <!-- content end --> 
			</form>
    </div>
</div>
<div class="clean"></div>
</body>
</html>