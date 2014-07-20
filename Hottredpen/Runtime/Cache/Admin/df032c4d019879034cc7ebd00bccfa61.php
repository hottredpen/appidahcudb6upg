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
.cla1{ background:#FC0; border:1px #3366FF solid;}
.cla2{ background:#CCC; border:1px #CCCCCC solid;}
</style>
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
            <li><a href="__ROOT__/Admin/User/userGroups.html">管理组</a></li>
			<li class="active">分配权限_<?php echo ($group['title']); ?></li>
		</ul>
          <div id="userGroups">
          <form method="post"  action='__URL__/upda'>
          <input name="gid" id="gid" type="hidden" value="<?php echo ($group['id']); ?>" />
        <input name="q" type="hidden" value="ag" />
        <input name="u" type="hidden" value="__ROOT__/Admin/User/userGroups.html" />
        <input name="sid" type="hidden" value="<?php echo ($group['id']); ?>" />
        <input name="n" type="hidden" value="权限分配更新" />
              <div class="row-fluid" id="addRule">
                 <?php if(is_array($rule)): $i = 0; $__LIST__ = $rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['cla'] == 'y' ): ?><div class="col-md-2"><div class='btn btn-success admi_groups' onclick="setCompetence(this)"  title="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></div></div>
                     <?php else: ?>
                        <div class="col-md-2"> <div class='btn btn-default admi_groups' onclick="setCompetence(this)"  title="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></div></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </div>
              </form>        
          </div>


        
      </div>
</div>
<script>

   function setCompetence(dom){
	   var cla = $(dom).attr("class");
	   var id = $(dom).attr("title");
	   var mdata = {};
	   if(cla.indexOf("btn-success")>-1){
		   mdata['action']="Cancel";
	   }else{
		  mdata['action']="Authorize";
	   }
	   mdata['id']=id;
	   mdata['gid'] = $("#gid").val();
       var url = "<?php echo U('Api/Ajax/setCompetence');?>";
		  $.ajax({			
			  type:"POST",
			  dataType: 'json',
			  data:mdata,
			  cache:false,
			  async:false,
			  url:url,
			  success: function(dat){
                 if(dat.status !="n"){
					 if(cla.indexOf("btn-success")>-1){
						$(dom).removeClass("btn-success");
					 }else{
						$(dom).addClass("btn-success");
					 }
				 }
				 alert(dat.info);
					

			  }
		 });
   }
</script>
<div class="clean"></div>
</body>
</html>