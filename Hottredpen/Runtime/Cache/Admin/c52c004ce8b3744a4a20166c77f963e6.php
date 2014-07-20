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
						<li class=""><a href="<?php echo U('Admin/User/index');?>">普通用户管理</a></li>
						<li class=""><a href="<?php echo U('Admin/User/manage');?>">管理员管理</a></li>
						<li class=""><a href="<?php echo U('Admin/User/userGroups');?>">管理组</a></li>
						<li class=""><a href="<?php echo U('Admin/User/competence');?>">权限管理</a></li>
            </ul>
        </div>
</div>
	<div id="content" class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="__ROOT__/Admin.html">首页</a></li>
			<li><a href="__ROOT__/Admin/user/index">用户管理</a></li>
			<li class="active">管理组</li>
			<div class="pull-right">
			    <a href="#" data-toggle="modal" data-target="#myModal" >添加管理组</a>
			</div>
		</ul>
          <div id="userGroups">
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th>分组ID</th>
                <th>分组名</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
			 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["title"]); ?></td>

                <td>
                   <a href="__ROOT__/Admin/User/viewUser/id/<?php echo ($vo["id"]); ?>.html" data-rel="tooltip"  class="icon icon-color icon-user" title="查看用户">查看用户</a>
                   <a href="__ROOT__/Admin/User/editUserGroups/id/<?php echo ($vo["id"]); ?>.html" data-rel="tooltip" class="icon icon-color icon-key" title="分配权限">分配权限</a>
                    <a href="#" onclick="if(confirm('是否要删除？'))window.location.href='__URL__/del/q/ag/id/<?php echo ($vo["id"]); ?>'">删除</a>
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
           
          </table>          
          </div>


        
      </div>
       <!-- content end -->
   </div>
   <!--添加新管理组 开始-->
<div id="aDdit" class="modal hide fade" style="width:900px;left:35%">

    <div class="modal-header">
      <a class="close" data-dismiss="modal">&times;</a>
      <h3>添加新管理组</h3>
    </div>
    <div class="modal-body">
    <form method="post"  action='__URL__/addGroup'>
    <table class="table">
                    <tbody>
                      <tr>
                        <td>
                               管理组名称：
                        </td>
                        <td>
                          <input name="title" type="text" class="span3" placeholder="请输入管理组名称...">
                        </td>
                      </tr>

                    </tbody>

    </table>
    <div class="modal-footer"> 
        <a href="#" class="btn" data-dismiss="modal">关闭</a>
        <button type="submit" class="btn btn-primary">确认添加</button>
    </div>
    </form>
    </div>
    
</div>

<!--添加新管理组 结束-->  
   
</div>
<div class="clean"></div>
</body>
</html>