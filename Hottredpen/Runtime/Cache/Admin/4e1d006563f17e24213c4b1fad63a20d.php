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
<!--编辑器部分-->
			<script charset="utf-8" src="__PUBLIC__/editor/kindeditor-min.js"></script>
			<script type="text/javascript">
                    KindEditor.ready(function(K) {
                        window.editor = K.create('#editor_id',{
                            uploadJson : '/index.php?g=Comments&m=Uploadimg&a=ke_upimg',
                            //fileManagerJson : '__PUBLIC__/editor/php/file_manager_json.php',
                            //allowFileManager : true
						});
                    });
			</script>
    <!-- editor -->
	<script src="__PUBLIC__/editor/kindeditor.js"></script>
<!--编辑器部分结束-->
<div class="container">
	<div class="col-md-2">
        <div data-spy="affix" data-offset-top="60" data-offset-bottom="200" >
            <ul class="nav bs-docs-sidenav">
						<li class=""><a href="__ROOT__/Admin/Tags/alltags.html">所有tags</a></li>
						<li class=""><a href="__ROOT__/Admin/Tags/zuowenlist.html">作文tags</a></li>
						<li class=""><a href="__ROOT__/Admin/Tags/haocijulist.html">好词句tags</a></li>
            </ul>
        </div>
</div>
	<div id="content" class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="__ROOT__/Admin.html">首页</a></li>
			<li><a href="__ROOT__/Admin/Tags/alltags.html">Tags管理</a></li>
			<li><a href="__ROOT__/Admin/Tags/<?php echo ($article["mod"]); ?>List.html"><?php echo ($article["modname"]); ?>Tags</a></li>
			<li class="active">添加顶级作文Tags</li>
		</ul>   
            <ul id="myTab" class="nav nav-tabs">

              <li class="active"><a href="#home" data-toggle="tab">基本信息</a></li>
            </ul>
			
            <form method="post"  action='__URL__/<?php echo ($article["mod"]); ?>save' name="myform" id="myform">
			
			
                <div id="myTabContent" class="tab-content">

                    <div class="tab-pane fade in active" id="home">

								<table class="table">
												<tbody>
												  <tr>
													<td>
														   作文标签名称：
													</td>
													<td>
													  <input name="title" type="text" class="form-control" placeholder="请输入分类名称..." >
													</td>
												  </tr>
												  <tr>
													<td>
														   作文标签英文：
													</td>
													<td>
													  <input name="entitle" type="text" class="form-control" placeholder="请输入分类名称..." >
													</td>
												  </tr>
												  <tr>
													<td>
														   上级类目：
													</td>
													<td>
													<?php if(!empty($idtree)): ?><select name="pid" id="pid">
															<option value="<?php echo ($pid); ?>" id="Type"><?php echo ($data['title']); ?></option>
														</select>                                          
													<?php else: ?>
														<select name="pid" id="pid">
															<option value="0" id="Type">顶级类目</option>
														</select><?php endif; ?>
													</td>
												  </tr>
													<input name="idtree" id="id" type="hidden" value="<?php echo ($idtree); ?>" />
													 <?php if(!empty($data["newOrder"])): ?><input id="order" name="order" type="hidden" value="<?php echo ($data['newOrder']); ?>">
													 <?php else: ?>
													 <input id="order" name="order" type="hidden" value="1"><?php endif; ?>
												</tbody>

							
								</table>
                    </div>
				    <div class="modal-footer">
					    <button type="submit" class="btn btn-primary" >确认添加</button>
				    </div>
				</div>	
            </form>


            

          
          
    </div>
</div>
<div class="clean"></div>
</body>
</html>