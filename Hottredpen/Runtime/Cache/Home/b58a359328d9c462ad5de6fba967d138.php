<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<?php if($actenname == 'user' ): ?><meta name="robots" content="nofollow" /><!--nofollow--><?php endif; ?>
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<?php if(!empty($indextitle)): ?><title><?php echo ($indextitle); ?>-<?php echo ($sys["sys_name"]); ?></title>
<?php else: ?>
<?php if(!empty($article["title"])): ?><title>《<?php echo ($article["title"]); ?>》<?php echo ($article["author"]); ?>-<?php echo ($lanmutitle); ?>-<?php echo ($sys["sys_name"]); ?></title>
<?php else: ?>
<title><?php echo ($sys["sys_name"]); ?>——<?php echo ($sys["sys_index_info"]); ?></title><?php endif; endif; ?>
<?php if(!empty($indexkeywords)): ?><meta name="KeyWords" content="<?php echo ($indexkeywords); ?>" />
<?php else: ?>
<?php if(!empty($article["keywords"])): ?><meta name="KeyWords" content="<?php echo ($article["keywords"]); ?>" />
<?php else: ?>
<meta name="KeyWords" content="<?php echo ($sys["sys_keyword"]); ?>" /><?php endif; endif; ?>
<?php if(!empty($indexdescription)): ?><meta name="description" content="<?php echo ($indexdescription); ?>" />
<?php else: ?>
<?php if(!empty($article["description"])): ?><meta name="description" content="<?php echo ($article["description"]); ?>" />
<?php else: ?>
<meta name="description" content="<?php echo ($sys["sys_describe"]); ?>" /><?php endif; endif; ?>
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
					<li>
					    <font>
							<div class="input-group">
								<input id="searchwords" type="text" class="form-control" placeholder="输入关键词搜索" />
								<span class="input-group-btn">
								    <button class="btn btn-default" type="button" id="searchsubmit"><span class="glyphicon glyphicon-search"></span></button>
							    </span>
							</div>
						</font>
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
						<span class="glyphicon glyphicon-home"></span><a href="/">首页</a>-><font>优秀作文</font>
						<!-- JiaThis Button BEGIN -->
						<div class="row pull-right"> <a class="jiathis jiathis_txt btn btn-default btn-sm pull-left">
								<span class="glyphicon glyphicon-thumbs-up"></span> 分享</a> 
								<div class="pull-right btn btn-default btn-sm">
									<a class="jiathis_counter_style"></a>
								</div>
						</div>
						<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1397096685796123" charset="utf-8"></script>
						<!-- JiaThis Button END -->			
				</div>
				<div class="clean"></div>
				<h1 class="text-center" itemprop="name">作文导航</h1>
				<div class="col-md-12">
				</div>
			</div>
			<div class="clean"></div>
			<!-- 文章内容 -->
			<article>
			<div class="content_body">
				<div class="panel panel-default">
				    <?php if(is_array($zuowentags)): $i = 0; $__LIST__ = $zuowentags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel-heading"><font><?php echo ($vo["title"]); ?></font>
							</div>
							<div class="panel-body">
							<?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><div class="btn-group">
									  <a href="/zuowen/tags?w=<?php echo ($voo["title"]); ?>" class="btn btn-default btn-xs"><?php echo ($voo["title"]); ?></a>
									  <?php if(!empty($voo["child"])): ?><button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
									         <?php if(is_array($voo["child"])): $i = 0; $__LIST__ = $voo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vooo): $mod = ($i % 2 );++$i;?><li><a href="/zuowen/tags?w=<?php echo ($vooo["title"]); ?>"><?php echo ($vooo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
									  </ul><?php endif; ?>
									</div>
									<span class="glyphicon"></span><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>

			</div>
			</article>
			<div class="clean"></div>
			<!-- 上一篇下一篇 -->
			<div class="panel pre_next panel-heading">
			  <div class="pull-left" >
				<?php if($preArticle != null): ?><font class="text-success">上一篇：</font><a title="<?php echo ($preArticle["title"]); ?>" href="/zuowen/html/<?php echo ($preArticle["indexid"]); ?>.html" ><span><?php echo ($preArticle["title"]); ?></span></a>
				<?php else: ?>
					<font class="text-success">没有上一篇了</font><?php endif; ?>
			  </div>
			  <div class="pull-right" >
				<?php if($nextArticle != null): ?><font class="text-danger">下一篇：</font><a title="<?php echo ($nextArticle["title"]); ?>" href="/zuowen/html/<?php echo ($nextArticle["indexid"]); ?>.html" ><span><?php echo ($nextArticle["title"]); ?></span></a>
				<?php else: ?>
					<font class="text-danger">没有下一篇了</font><?php endif; ?>
			  </div>
			</div>
			<div class="clean"></div>
			<!-- 点赞 -->
			<div class="dianzan">
				<!-- 将此标记放在您希望显示like按钮的位置 -->
				<div class="bdlikebutton"></div>
				<!-- 将此代码放在适当的位置，建议在body结束前 --> 
				<script id="bdlike_shell"></script> 
				<script>
				var bdShare_config = {
					"type":"medium",
					"color":"blue",
					"likeText":"喜欢,顶一个",
					"likedText":"亲.您已顶过"
				};
				document.getElementById("bdlike_shell").src="http://bdimg.share.baidu.com/static/js/like_shell.js?t=" + new Date().getHours();
				</script>
			</div>
			<div class="clean"></div>
			 <!-- 友言 -->
			<div class="col-md-12">
				<!-- UY BEGIN -->
				<div id="uyan_frame"></div>
				<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=1915631"></script>
				<!-- UY END -->
			</div>
			<div class="clean"></div>
        </div>
    </div>


    <div class="col-lg-4">
		<!-- UJian Button BEGIN -->
		<div class="ujian-hook"></div>
		<script type="text/javascript">var ujian_config = {num:6,fillet:0,lkrc:0,picSize:120,picHeight:72,textHeight:15};</script>
		<script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js?uid=1915631"></script>
		<a href="http://www.ujian.cc" style="border:0;"><img src="http://img.ujian.cc/pixel.png" alt="友荐云推荐" style="border:0;padding:0;margin:0;" /></a>
		<!-- UJian Button END -->
    </div>
    <div class="clean"></div>
</div>
<!-- container start --> 

<!-- container end -->
<!--底部  start-->
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