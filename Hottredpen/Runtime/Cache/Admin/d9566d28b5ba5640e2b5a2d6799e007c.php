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
<script src="__PUBLIC__/js/boot3/jquery.js"></script>
<script src="__PUBLIC__/js/boot3/bootstrap.min.js"></script>
</head>
<body id="body">
<!--头部 end -->
			<div class="row">
				<div class="text-center">
					<h2>欢迎来到本站</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row">
				<div class="well col-md-8 col-md-offset-2">
					<div class="alert alert-info">
						<p class="text-center">请登录你的账号和密码.<p>
					</div>
					<form class="form-horizontal col-md-10 col-lg-offset-1" name="myform" method="post">
					  <div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">账号:</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="输入用户名">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-4 control-label">密码:</label>
						<div class="col-sm-4">
						  <input type="password" class="form-control" id="inputPassword3" name="passw" placeholder="输入密码">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-4 control-label">验证码:</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" id="inputPassword3" name="proving" placeholder="输入验证码">
						  <img id="verifyImg" src='__APP__/DoApi/verify/' onClick="changeVerify()" title="点击刷新验证码" style="cursor:pointer"/>
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
						  <button type="submit" class="btn btn-primary">登录</button>
						</div>
					  </div>
					</form>					
				</div><!--/span-->
			</div><!--/row-->
<!--底部 -->
 <script language="JavaScript">
	function changeVerify(){
		var timenow = new Date().getTime();
		document.getElementById('verifyImg').src='__APP__/DoApi/verify/'+timenow;
	}
</script>
<div class="clean"></div>
</body>
</html>
<!--底部 end-->