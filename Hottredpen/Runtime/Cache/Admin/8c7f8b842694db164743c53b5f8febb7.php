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
						<li class=""><a href="__ROOT__/Admin/Jifen/index.html">积分等级</a></li>
						<li class=""><a href="__ROOT__/Admin/Jifen/peizhi.html">获得积分配置</a></li>
            </ul>
        </div>
</div>
	<div id="content" class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="__ROOT__/Admin.html">首页</a></li>
			<li><a href="__ROOT__/Admin/jifen/index.html">积分等级配置</a></li>
			<li class="active">获取积分配置</li>
			<div  class="pull-right"> 
			    <a href="#" data-toggle="modal" data-target="#myModal">添加<?php echo ($pname); ?></a>
			</div>
		</ul>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>变量名</th>
                <th>积分</th>
                <th>积分说明</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                       <?php echo ($vo["name"]); ?>
                </td>
                <td>
                      <?php echo ($vo["value"]); ?>
                </td>
                <td>
                      <?php echo ($vo["state"]); ?>
                </td>
                <td>
                    <a href="#edit" data-toggle="modal" data-target="#editmyModal" onclick="editpeizhi(<?php echo ($vo["id"]); ?>)">编辑</a>
                    <a href="#" onclick="if(confirm('是否要删除？'))window.location.href='__URL__/delepeizhi/id/<?php echo ($vo["id"]); ?>'">删除</a>
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table>
<div>
</div>
<!--添加<?php echo ($pname); ?> start-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">添加<?php echo ($pname); ?></h4>
      </div>
	  <form method="post"  action='__URL__/addpeizhi'>
      <div class="modal-body">

			<table class="table table-striped">
				<tbody>
				  <tr>
					<td>
						   变量名：
					</td>
					<td>
					  <input name="name" type="text" class="form-control" placeholder="请输入变量名...">
					</td>
				  </tr>
				  <tr>
					<td>
						   积分：
					</td>
					<td>
					  <input name="value" type="text" class="form-control" placeholder="请输入积分...">
					</td>
				  </tr>
				  <tr>
					<td>
						   说明：
					</td>
					<td>
					  <textarea name="state" class="form-control" rows="3" placeholder="说明不要超过100个字..."></textarea>
					</td>
				  </tr>
				</tbody> 
			</table>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">确认添加</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!--添加系统变量 结束-->
<!--添加<?php echo ($pname); ?> end-->
<!--编辑<?php echo ($pname); ?> start-->

<div class="modal fade" id="editmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">编辑<?php echo ($pname); ?></h4>
      </div>
	  <form method="post"  action='__URL__/updatepeizhi'>
      <div id='edits'></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">确认添加</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<!--编辑<?php echo ($pname); ?> end-->
<!--底部 -->
<script>
function editpeizhi(id){
		$("#edits").load("/index.php?g=Admin&m=jifen&a=editpeizhiajax", {id:id});
}
</script>

<div class="clean"></div>
</body>
</html>