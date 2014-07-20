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
			<li class="active">权限管理</li>
			<div class="pull-right">
			    <a href="#" data-toggle="modal" data-target="#myModal" >添加权限 </a>
			</div>
		</ul>
          <table class="table table-striped table-bordered table-condensed datatable">
            <thead>
              <tr>
                <th>权限ID</th>
                <th>授权名称</th>
                <th>描述</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
			 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["name"]); ?></td>
                <td>
                   <?php echo ($vo["condition"]); ?> 
                </td>
                <td>
                    <a href="#edit" data-toggle="modal" data-target="#editmyModal" onclick="edit(<?php echo ($vo["id"]); ?>)" >编辑</a>
                    <a href="#" onclick="if(confirm('是否要删除？'))window.location.href='__URL__/exitcom?id=<?php echo ($vo["id"]); ?>'">删除</a>
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
           
          </table> 
          


        
      </div>
      
       <!-- content end -->
   </div>
   <!--添加用户组 开始-->
<div id="aDdit" class="modal hide fade" style="width:900px;left:35%">

    <div class="modal-header">
      <a class="close" data-dismiss="modal">&times;</a>
      <h3>添加权限规则</h3>
    </div>
    <div class="modal-body">
    <form method="post"  action='__URL__/add'>
    <input name="q" id="q" type="hidden" value="ar" />
	<input name="u" type="hidden" value="__ROOT__/Admin/User/competence.html" />
    <table class="table">
                    <tbody>
                      <tr>
                        <td>
                               授权名称：
                        </td>
                        <td>
                          <input name="name" type="text" class="span5" placeholder="请输入权限名称...">
                        </td>
                      </tr>
                      <tr>
                        <td>
                               分组：
                        </td>
                        <td>
                          	<select name="fid">
                            <?php if(is_array($unt)): $i = 0; $__LIST__ = $unt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["value"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td>
                               控制器：
                        </td>
                        <td>
                          <input name="condition" type="text" class="span5" placeholder="Group-Controller-action">
                        </td>
                      </tr>                      
                    </tbody>

    </table>
    <div class="row-fluid" id="addRule">
    
    </div>
    <div class="modal-footer"> 
        <a href="#" class="btn" data-dismiss="modal">关闭</a>
        <button type="submit" class="btn btn-primary" >确认添加</button>
    </div>
    </form>
    </div>
    
</div>

<!--添加用户组 结束-->  
<!--编辑 start-->
<div id="edit" class="modal hide fade">
    
    <div class="modal-header">
      <a class="close" data-dismiss="modal" >&times;</a>
      <h3>编辑</h3>
    </div>
    <form method="post"  action='__URL__/upda'>
    <input name="q" type="hidden" value="ar" />
    <input name="u" type="hidden" value="__ROOT__/Admin/User/competence.html" />
    <input name="n" type="hidden" value="更新" />
    <div id='edits'></div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">关闭</a>
        <button type="submit" class="btn btn-primary" >确认更新</button>
    </div>
    </form>
</div>
<!--编辑 end-->
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">添加权限规则</h4>
      </div>
	  <form method="post"  action='__URL__/updatepeizhi'>
    <table class="table">
                    <tbody>
                      <tr>
                        <td>
                               授权名称：
                        </td>
                        <td>
                          <input name="name" type="text" class="form-control" placeholder="请输入权限名称...">
                        </td>
                      </tr>
                      <tr>
                        <td>
                               分组：
                        </td>
                        <td>
                          	<select name="fid">
                            <?php if(is_array($unt)): $i = 0; $__LIST__ = $unt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["value"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td>
                               控制器：
                        </td>
                        <td>
                          <input name="condition" type="text" class="form-control" placeholder="Group-Controller-action">
                        </td>
                      </tr>                      
                    </tbody>

    </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">确认添加</button>
      </div>
	  </form>
    </div>
  </div>
</div>



<!--编辑<?php echo ($pname); ?> start-->

<div class="modal fade" id="editmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">修改管理员密码</h4>
      </div>
	  <form method="post"  action='__URL__/updatepeizhi'>
      <div id='editss'></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">确认添加</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<!--编辑<?php echo ($pname); ?> end-->
<script>
function edit(id){
		$("#editss").load("/index.php?g=Admin&m=user&a=editajax", {id:id});
}
</script>
<div class="clean"></div>
</body>
</html>