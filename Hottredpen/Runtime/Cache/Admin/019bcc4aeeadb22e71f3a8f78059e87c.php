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
<!--头部 end -->
<!--左栏 starts -->
<div class="container-fluid">
		<div class="row-fluid">
			<!-- left menu starts -->
<!-- <div class="span2 main-menu-span">		
    <div class="well nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li class="nav-header hidden-tablet">菜单</li>
            <li><a class="ajax-link" href="__ROOT__/Admin/Index/system.html"><i class="icon-cog"></i><span class="hidden-tablet"> 系统设置</span></a></li>
            <li><a class="ajax-link" href="__ROOT__/Admin/Index/email.html"><i class="icon-envelope"></i><span class="hidden-tablet"> 邮箱设置</span></a></li>
            <li><a class="ajax-link" href="__ROOT__/Admin/Index/operation.html"><i class="icon-pencil"></i><span class="hidden-tablet"> 管理员操作记录</span></a></li>
            <li><a class="ajax-link" href="__ROOT__/Admin/Index/userrecord.html"><i class="icon-edit"></i><span class="hidden-tablet"> 用户操作记录</span></a></li>
            <li><a class="ajax-link" href="__ROOT__/Admin/Index/integralrecord.html"><i class="icon-fire"></i><span class="hidden-tablet"> 积分记录</span></a></li>
        	<li><a href="__ROOT__/Admin/Index/colour.html"><i class="icon-filter"></i><span class="hidden-tablet"> 界面风格</span></a></li>
            <li><a href="__ROOT__/Admin/Index/wcolour.html"><i class="icon-globe"></i><span class="hidden-tablet"> 微信界面风格</span></a></li>
        </ul>
    </div><!--/.well 
</div>  span-->
<!-- left menu ends -->
<div class="col-md-3">
          <div style="" class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix" role="complementary">
            <ul class="nav bs-docs-sidenav">
              
                <li class="">
  <a href="#js-overview">概览</a>
  <ul class="nav">
    <li class=""><a href="#js-individual-compiled">单个还是全部引入</a></li>
    <li><a href="#js-data-attrs">data 属性</a></li>
    <li class=""><a href="#js-programmatic-api">编程方式的 API</a></li>
    <li><a href="#js-noconflict">避免命名空间冲突</a></li>
    <li><a href="#js-events">事件</a></li>
    <li><a href="#callout-third-party-libs">第三方工具库</a></li>
  </ul>
</li>
<li class=""><a href="#transitions">过渡效果</a></li>
<li class="">
  <a href="#modals">模态框</a>
  <ul class="nav">
    <li class=""><a href="#modals-examples">实例</a></li>
    <li class=""><a href="#modals-sizes">Sizes</a></li>
    <li class=""><a href="#modals-remove-animation">Remove animation</a></li>
    <li class=""><a href="#modals-usage">用法</a></li>
  </ul>
</li>
<li>
  <a href="#dropdowns">下拉菜单</a>
  <ul class="nav">
    <li><a href="#dropdowns-examples">实例</a></li>
    <li><a href="#dropdowns-usage">用法</a></li>
  </ul>
</li>
<li>
  <a href="#scrollspy">滚动监听</a>
  <ul class="nav">
    <li><a href="#scrollspy-examples">实例</a></li>
    <li><a href="#scrollspy-usage">用法</a></li>
  </ul>
</li>
<li>
  <a href="#tabs">标签页</a>
  <ul class="nav">
    <li><a href="#tabs-examples">实例</a></li>
    <li><a href="#tabs-usage">用法</a></li>
  </ul>
</li>
<li class="">
  <a href="#tooltips">工具提示</a>
  <ul class="nav">
    <li class=""><a href="#tooltips-examples">实例</a></li>
    <li class=""><a href="#tooltips-usage">用法</a></li>
  </ul>
</li>
<li class="">
  <a href="#popovers">弹出框</a>
  <ul class="nav">
    <li class=""><a href="#popovers-examples">实例</a></li>
    <li class=""><a href="#popovers-usage">用法</a></li>
  </ul>
</li>
<li class="">
  <a href="#alerts">警告框</a>
  <ul class="nav">
    <li><a href="#alerts-examples">警告框实例</a></li>
    <li class=""><a href="#alerts-usage">用法</a></li>
  </ul>
</li>
<li class="">
  <a href="#buttons">按钮</a>
  <ul class="nav">
    <li class=""><a href="#buttons-examples">实例</a></li>
    <li class=""><a href="#buttons-usage">用法</a></li>
  </ul>
</li>
<li class="">
  <a href="#collapse">Collapse</a>
  <ul class="nav">
    <li class=""><a href="#collapse-examples">实例</a></li>
    <li class=""><a href="#collapse-usage">用法</a></li>
  </ul>
</li>
<li class="">
  <a href="#carousel">Carousel</a>
  <ul class="nav">
    <li class=""><a href="#carousel-examples">实例</a></li>
    <li class=""><a href="#carousel-usage">用法</a></li>
  </ul>
</li>
<li class="active">
  <a href="#affix">Affix</a>
  <ul class="nav">
    <li class=""><a href="#affix-examples">实例</a></li>
    <li class="active"><a href="#affix-usage">用法</a></li>
  </ul>
</li>

              
            </ul>
            <a class="back-to-top" href="#top">
              返回顶部
            </a>
            
            <a href="#" class="bs-docs-theme-toggle">
              主题预览
            </a>
            
          </div>
        </div>

			<div id="content" class="span10">
			<!-- content starts -->
<!--左栏 end -->
<ul class="breadcrumb">
      <li>
        <a href="__ROOT__/Admin.html">首页</a> <span class="divider">/</span>
      </li>
      <li class="active">系统设置</li>
    <div  class="pull-right"> <a data-toggle="modal" data-rel="tooltip" href="#aDdit">添加系统变量</a></div>
</ul>
<form method="post"  action='__URL__/savesy'>
<table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th>参数说明</th>
                <th>参数值</th>
                <th>变量名</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                       <?php echo ($vo["state"]); ?>：
                </td>
                <td>
				  <?php switch($vo["type"]): case "1": ?><input type="text" name="value[]" class="span5" placeholder="<?php echo ($vo["prompt"]); ?>..." value="<?php echo ($vo["value"]); ?>"><?php break;?>
					<?php case "2": ?><textarea name="value[]" class="span5" placeholder="<?php echo ($vo["prompt"]); ?>..." ><?php echo ($vo["value"]); ?></textarea><?php break;?>
					<?php case "3": ?><img id="feil"  src="__PUBLIC__/uploadify/uploads/logo/<?php echo ($vo["value"]); ?>"/>
                   <input id="img" name="value[]" type="hidden" value="<?php echo ($vo["value"]); ?>" />
                    <input id="folder" type="hidden" value="logo"/>
                    <input id="file_delete" type="hidden" value="/uploads/logo/<?php echo ($vo["value"]); ?>"/>
                    <input data-no-uniform="true" type="file" id="file_upload" /><?php break;?>
					<?php default: endswitch;?>

                </td>
                <td>
                  <code><?php echo ($vo["name"]); ?></code>
                </td>
                <td>
                    <a href="__ROOT__/Admin/Index/editsys/<?php echo ($vo["id"]); ?>.html" data-rel="tooltip" class="ajax-link icon icon-color icon-edit" title="编辑"></a>
                    <a href="#" data-rel="tooltip" class="icon icon-color icon-trash"title="删除" onclick="if(confirm('是否要删除？'))window.location.href='__URL__/delesy/id/<?php echo ($vo["id"]); ?>'"></a>
                </td>
              </tr>
			  <input name="id[]" type="hidden" value="<?php echo ($vo["id"]); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table>
<div>
<div class="span4">

</div>
<div class="span5">
          <button class="btn btn-primary" type="submit">
              确认修改
          </button>
            <a data-toggle="modal" data-rel="tooltip" href="#aDdit" class="btn btn-info">添加系统变量</a>
</div>
</div>
</form>
<!--底部 -->
<!--添加系统变量 开始-->
<div id="aDdit" class="modal hide fade">
    
    <div class="modal-header">
      <a class="close" data-dismiss="modal" >&times;</a>
      <h3>添加系统变量</h3>
    </div>
    <form method="post"  action='__URL__/addsy'>
    <table class="table">
                    <tbody>
                      <tr>
                        <td>
                               参数说明：
                        </td>
                        <td>
                          <input name="state" type="text" class="span10" placeholder="请输入参数说明...">
                        </td>
                      </tr>
                      <tr>
                        <td>
                               输入提示：
                        </td>
                        <td>
                          <input name="prompt" type="text" class="span10" placeholder="请输入输入提示...">
                        </td>
                      </tr>
					  <tr>
                        <td>
                               参数值：
                        </td>
                        <td>
                          <input name="value" type="text" class="span10" placeholder="请输入参数值...">
                        </td>
                      </tr>
                      <tr>
                        <td>
                               变量名：
                        </td>
                        <td>
                          <input name="name" type="text" class="span10" placeholder="请输入变量名以sys_开头...">
                        </td>
                      </tr>
                      <tr>
                        <td>
                               表单类型：
                        </td>
                        <td class="form-inline">
                          <label class="radio"><input type="radio" name="type" value="1" checked/> 文本域</label>
                          <label class="radio"><input type="radio" name="type" value="2" /> 文本区域</label>
                          <label class="radio"><input type="radio" name="type" value="3" /> 文件域</label>
                        </td>
                      </tr>
                    </tbody>
                
    </table>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">关闭</a>
        <button type="submit" class="btn btn-primary" >确认添加</button>
    </div>
    </form>
</div>
<!--添加系统变量 结束-->
<div class="clean"></div>
</body>
</html>