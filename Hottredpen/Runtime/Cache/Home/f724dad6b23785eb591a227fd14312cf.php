<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="robots" content="nofollow" /><!--nofollow-->
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<title>搜索到关于"<?php echo ($words); ?>"的文章-简看空间</title>
<meta name="KeyWords" content="简看空间,搜索页" />
<meta name="description" content="简单搜索" />
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
    <nav id="navbar" class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
		    <!--logo-->
			<div class="navbar-header nav navbar-nav col-lg-3">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">切换导航</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a href="/"><img class="logo img-responsive" alt="简看空间" href="/" src="__PUBLIC__/images/logo.png" /></a>
			</div>
			<!--logo右边-->
			<div class="nav navbar-nav col-lg-9">
				    <div id="header_info" class="col-md-7"></div>
					<div class="col-md-5">
						<div class="col-sm-12">
							<ul id="user" class="nav navbar-nav navbar-right header-nav-right">
								<?php if(empty($_SESSION['user_name'])): ?><li><a href="__ROOT__/login.html">登陆</a></li>
								<?php else: ?>
										<?php if($_SESSION['user_haveimg']== 1): ?><li class="txclass"><a  id="user_name" title="<?php echo (session('user_name')); ?>"><img style="width:44px;height:44px" src="/Public/FaustCplus/php/img/small_user_<?php echo (session('user_uid')); ?>.jpg" alt=""></a><a>暂无徽章</a></li>
										<?php else: ?>
											<li class="txclass"><a  id="user_name" title="<?php echo (session('user_name')); ?>"><img style="width:44px;height:44px" src="/Public/FaustCplus/php/img/noimg.png" alt=""></a><a>暂无徽章</a></li><?php endif; ?>
										<li><a href="__ROOT__/Center.html"><?php echo (session('user_name')); ?></a></li>
										<li><a href="__ROOT__/exits.html">退出</a></li><?php endif; ?>
							</ul>
						</div>
					</div>


			</div>
		    <div class="clean"></div>
		</div>
		<!--导航start-->
		<div class="collapse navbar-collapse nav_bj" id="bs-example-navbar-collapse-1">
			<div class="container">
				<ul id="headernav" class="nav navbar-nav">
				   
					<li <?php if(!empty($active["index"])): ?>class="<?php echo ($active["index"]); ?>"<?php endif; ?>><a href="__APP__/" title="首页">首页</a></li>
					<li <?php if(!empty($active["zuowen"])): ?>class="<?php echo ($active["zuowen"]); ?>"<?php endif; ?>><a href="__APP__/zuowen.html"  title="作文大全">作文大全</a></li>
					<li <?php if(!empty($active["haocihaoju"])): ?>class="<?php echo ($active["haocihaoju"]); ?>"<?php endif; ?>><a href="__APP__/haocihaoju.html"  title="好词好句">好词好句</a></li>
					<li <?php if(!empty($active["mingrenmingyan"])): ?>class="<?php echo ($active["mingrenmingyan"]); ?>"<?php endif; ?>><a href="__APP__/mingrenmingyan.html"  title="名人名言">名人名言</a></li>
					<li <?php if(!empty($active["zheligushi"])): ?>class="<?php echo ($active["zheligushi"]); ?>"<?php endif; ?>><a href="__APP__/zheligushi.html"  title="哲理故事">哲理故事</a></li>
                    <li <?php if(!empty($active["fenlei"])): ?>class="<?php echo ($active["fenlei"]); ?>"<?php endif; ?>><a href="__APP__/fenlei.html"  title="分类标记">分类标记</a></li> 					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="searchinput">
							<div class="input-group">
								<input id="searchwords" type="text" class="form-control" placeholder="输入关键词搜索" />
								<span class="input-group-btn">
								    <button class="btn btn-default" type="button" id="searchsubmit"><span class="glyphicon glyphicon-search"></span></button>
							    </span>
							</div>
					</li>
					<li>
						<a href="__APP__/tougao.html">投稿</a>
					</li>
				</ul>
			</div>
		</div>
	  <!--导航end-->
    </nav>
</header>





<!--头部 end -->
<div class="container">
    <div class="col-lg-8">
        <div class="content_box">
			<!-- 文章头部 -->
			<div class="content_head">
				<div class="col-md-12 ">
						<!-- 位置导航 -->
						<span class="glyphicon glyphicon-home"></span><a href="/">首页</a>-><font>搜索页</font>
				</div>
						<!-- Nav tabs -->
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#tabzuowen"  data-toggle="tab">作文</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="tabzuowen">
										<?php if(is_array($zuowendata)): $i = 0; $__LIST__ = $zuowendata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><div class="panel panel-default">
													 <div class="panel-heading ">
														<a  href="/zuowen/html/<?php echo ($art["indexid"]); ?>.html" >
															<div class="col-md-6">
																<?php echo ($art["title"]); ?><small class="text-muted">--<?php if(empty($art["author"])): ?>佚名<?php else: echo ($art["author"]); endif; ?></small>
															</div>
															<div class="col-md-6">
																<div class="rateit pull-right" data-rateit-value="<?php echo ($art["starfenshu"]); ?>" title="<?php echo ($art["starfenshu"]); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"><font>好句(0)</font><font>好段(0)</font></div>
															</div>
															<div class="clean"></div>
														</a>
                                                     </div>
													<div class="alert">
														<p><?php echo ($art["gaiyao"]); ?></p>
													</div>
											 </div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div class="tab-pane" id="tabhaocihaoju">

							</div>
						</div>


			</div>
        </div>
    </div>


    <div class="col-lg-4">

    </div>
    <div class="clean"></div>
</div>
<!-- container start --> 
<div class="clean"></div>
<footer id="footer">
	<?php if(empty($article["title"])): ?><!--友情链接 -->
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body">
				<ul>
				    <li><span class="text-muted">友情连接：</span></li>
				    <li><a href="http://www.jk-kj.com/zuowen.html" target="_blank">作文大全</a></li>
				</ul>
			</div>
		</div>
    </div><?php endif; ?>
    <!--说明 -->
	<div class="panel panel-default">
		<div class="panel-footer">
			<p class="text-muted">版权归作者所有，如果无意之中侵犯了您的版权，请来信告知，本站将在3个工作日内删除</p>
			<p class="text-muted">联系站长:277488199@qq.com</p>
			<p class="text-muted">Copyright ©2014 jk-kj.com Inc. All Rights Reserved.<a rel="nofollow" class="text-muted" href="http://www.miitbeian.gov.cn" ref="nofollow">浙ICP备13033425-2号</a></p>
		    <p class="text-muted"><a ref="nofollow" href="http://webscan.360.cn/index/checkwebsite/url/www.jk-kj.com" name="35c4968029238ffdce1707bfc21caf4c" >360网站安全检测平台</a></p>
		</div>
	</div>
</footer>
<!-- footer end -->
<!-- 右侧的刷新回顶 -->
<div class="btn-group-vertical floatButton">
  <button type="button" class="btn btn-default" id="goTop" title="去顶部"><span class="glyphicon glyphicon-arrow-up"></span></button>
  <button type="button" class="btn btn-default" id="refresh" title="刷新"><span class="glyphicon glyphicon-repeat"></span></button>
  <button type="button" class="btn btn-default" id="goBottom" title="去底部"><span class="glyphicon glyphicon-arrow-down"></span></button>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
  $('#goTop').click(function(){$('html,body').animate({scrollTop: '0px'}, 800);});
  $('#goBottom').click(function(){$('html,body').animate({scrollTop:$('#footer').offset().top}, 800);});
  $('#refresh').click(function(){location.reload();});
  $('#searchsubmit').bind('click', function (e) {
        var words=$("#searchwords")[0].value; ;
		window.location.href="/search?words="+words;
	});
<?php if(!empty($article["title"])): ?>var catid=<?php echo ($article["catid"]); ?>,id=<?php echo ($article["id"]); ?>;
		$.ajax({
			type: "POST",
			url: "/index.php?g=Home&m=Hits&a=gethits",
			dataType: "json",
			data: {
				'catid': catid,
				'id':id,
			},
			success: function (backdata) {
			    $("#header_info").html(backdata.header_infohtml);
			    $("#hits").html(backdata.click);
				$("#userpizhu").html(backdata.userpizhuhtml);
				$("#gaiyaorand").html(backdata.gaiyaorandhtml);
				$("#pingjia").html(backdata.pingjiahtml);
				$("#tuijian").html(backdata.tuijianhtml);
				$("#monthhot").html(backdata.monthhothtml);
				$("#weekhot").html(backdata.weekhothtml);
				//绑定
                ksllbind(catid,id);
			}
		}); 
	//激活tooltip
	$('a[rel=tooltip]').tooltip({});
	//激活popover
	$('.jiexiceng').popover();<?php endif; ?>


});
</script>
<!-- endjs -->
<script src="__PUBLIC__/js/star/jquery.rateit.js"></script>
<?php if(!empty($article["title"])): ?><script charset="utf-8" src="__PUBLIC__/js/jk-kj.js?v=jkkj"></script><?php endif; ?>
<?php if(!empty($active["center"])): ?><script type="text/javascript">
	(function($) {
		//三级联动
		$(function(){
			var yuyu=$("#sees").attr("title");
			$("#area").area({cache:region,shengshiqu:yuyu});
		});
	})(jQuery);
  //点击更换城市的a 的# 不会到顶部
	$('#show a').click(function (e) {
	e.preventDefault();
    })
</script><?php endif; ?>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F2dc4ce76f4e4904b954a3f42f3f8594d' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>