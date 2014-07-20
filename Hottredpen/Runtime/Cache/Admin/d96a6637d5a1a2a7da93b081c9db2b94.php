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

<div class="container-fluid">
	<div class="row-fluid">
        <!--左栏 starts -->
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
        <!--左栏 end -->
			
			
       <!-- content starts -->
      <div id="content" class="span10">
          <ul class="breadcrumb">
              <li>
                  <a href="__ROOT__/Admin.html">首页</a> <span class="divider">/</span>
              </li>
              
              <li class="active">管理组用户管理</li>
              <div  class="pull-right"> <a data-toggle="modal" data-rel="tooltip" href="#aDdit" onclick="getUser(<?php echo ($id); ?>)">添加用户</a></div>
 
          </ul>
          <div id="viewGroupUser">
          <table class="table table-striped table-bordered table-condensed datatable">
            <thead>
              <tr>
                <th>用户名</th>
                <th>用户ID</th>
                <th>email</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
			 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["username"]); ?></td>
                <td><?php echo ($vo["id"]); ?></td>
                <td>
                   <?php echo ($vo["email"]); ?> 
                </td>
                <td><a href="#" data-rel="tooltip" class="icon icon-color icon-trash"title="删除" 
                    onclick="if(confirm('是否要删除？'))window.location.href='__URL__/delGroupUser/uid/<?php echo ($vo["id"]); ?>'"></a>
                </td>
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
           
          </table>          
          </div>


        
      </div>
       <!-- content end -->
   </div>
 <!--添加用户 开始-->
<div id="aDdit" class="modal hide fade" style="width:900px;left:35%">

    <div class="modal-header">
      <a class="close" data-dismiss="modal">&times;</a>
      <h3>添加新用户</h3>
    </div>
    <div class="modal-body">
    <form method="post"  action='__URL__/saveUser'>
     <div class="row-fluid" id="addUsers">
 
     </div>
    <div class="modal-footer"> 
        <a href="#" class="btn" data-dismiss="modal">关闭</a>
        <input name="group_id" id="group_id" type="hidden" value="<?php echo ($id); ?>" />
        <button type="submt" class="btn btn-primary" >确认添加</button>
    </div>
    </form>
    </div>
    
</div>

<!--添加用户 结束-->  
   
</div>
<script>
   function getUser(id){
	   var div = $("#addUsers").find("div");
	   if(div.length>0){
	   }else{
	    var mdata={'id':id};
		var url = "<?php echo U('Api/Ajax/getGroupUsersJson');?>";
		  $.ajax({			
			  type:"POST",
			  dataType: 'json',
			  data:mdata,
			  cache:false,
			  async:false,
			  url:url,
			  success: function(dat){
                 if(dat.status !="n"){
				    $.each(dat,function(k,v){
						var div =$("<div class='span2'><input type='checkbox' name='guser[]' value ='"+v.id+"'>&nbsp;&nbsp;"+v.username+"<div>")
						
						$("#addUsers").append(div);
					})
				 }
					

			  }
		 });
	   }
   }
</script>
<div class="clean"></div>
</body>
</html>