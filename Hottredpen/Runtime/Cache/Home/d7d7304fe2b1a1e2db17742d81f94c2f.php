<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<?php if($actenname == 'user' ): ?><meta name="robots" content="nofollow" /><!--nofollow--><?php endif; ?>
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<?php if(!empty($indextitle)): ?><title><?php echo ($indextitle); ?>-<?php echo ($sys["sys_name"]); ?></title>
<?php else: ?>
<?php if(!empty($article["title"])): ?><title>《<?php echo ($article["title"]); ?>》<?php if(!empty($article["author"])): echo ($article["author"]); else: ?>佚名<?php endif; ?>-<?php echo ($lanmutitle); ?>-<?php echo ($sys["sys_name"]); ?></title>
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
  <div class="col-lg-8 col-md-8 col-sm-8 content">
    <div id="carousel-example-generic" class="carousel slide mb20" data-ride="carousel"> 
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <a href="/" target="_blank"><img  style="margin:0 auto;max-height:300px;" src="__PUBLIC__/images/test.jpeg" alt="简看" /></a>
          <div class="carousel-caption"> </div>
        </div>
        <div class="item">
          <a href="/" target="_blank"><img  style="margin:0 auto;max-height:300px;" src="__PUBLIC__/images/test.jpeg" alt="简看" /></a>
          <div class="carousel-caption"> </div>
        </div>
		<div class="item">
          <a href="/" target="_blank"><img  style="margin:0 auto;max-height:300px;" src="__PUBLIC__/images/test.jpeg" alt="简看" /></a>
          <div class="carousel-caption"> </div>
        </div>
      </div>
      <!-- Controls --> 
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev" > <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next" > <span class="glyphicon glyphicon-chevron-right"></span> </a> 
	</div>
	
	




    <div class="row mb20">
         <div class="col-md-7">
			  <div class="panel panel-info">
				<div class="panel-heading">
				  <h3 class="panel-title">推荐作文</h3>
				</div>
			   <ul class="row list-group">
				<?php if(is_array($newartlist)): $i = 0; $__LIST__ = $newartlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i; if($art["bj"] == 1): ?><li>
							<a class="list-group-item" href="/zuowen/html/<?php echo ($art["indexid"]); ?>.html" >
								<div class="col-md-6">
									<?php echo ($art["title"]); ?><small class="text-muted">--<?php if(empty($art["author"])): ?>佚名<?php else: echo ($art["author"]); endif; ?></small>
								</div>
								<div class="col-md-6">
									<div class="rateit pull-right" data-rateit-value="<?php echo ($art["starfenshu"]); ?>" title="<?php echo ($art["starfenshu"]); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"><font>好句(0)</font><font>好段(0)</font></div>
									<div></div>
								</div>
								<div class="clean"></div>
							</a>
						</li>		
					<?php else: ?>
						<li>
							<a class="list-group-item bei2" href="/zuowen/html/<?php echo ($art["indexid"]); ?>.html" >
								<div class="col-md-6">
									<?php echo ($art["title"]); ?><small class="text-muted">--<?php if(empty($art["author"])): ?>佚名<?php else: echo ($art["author"]); endif; ?></small>
								</div>
								<div class="col-md-6">
									<div class="rateit pull-right" data-rateit-value="<?php echo ($art["starfenshu"]); ?>" title="<?php echo ($art["starfenshu"]); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"><font>好句(0)</font><font>好段(0)</font></div>
								</div>
								<div class="clean"></div>
							</a>
						</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			  </ul>
			  </div>
	     </div>
		 
         <div class="col-md-5">
			  <div class="panel panel-info">
				<div class="panel-heading">
				  <h3 class="panel-title">精彩图文</h3>
				</div>
			    <ul class="row list-group">
				       <?php if(is_array($jingcaituwendata)): $i = 0; $__LIST__ = $jingcaituwendata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$foo): $mod = ($i % 2 );++$i;?><li>
							
								<div class="col-md-6">
									<a title="<?php echo ($foo["title"]); ?>" href="/yygj/html/<?php echo ($foo["indexid"]); ?>.html" class="thumbnail"><img alt="<?php echo ($foo["title"]); ?>" src="<?php echo (substr($foo[img],0,-4)); ?>01.jpg" ></a>
								</div>
								<div class="col-md-6">
                                    <a href="/yygj/html/<?php echo ($foo["indexid"]); ?>.html" title=""><?php echo ($foo["title"]); ?></a>
									<p> <span class="muted"><i class="icon-user icon12"></i><?php if(empty($foo[author])): ?>佚名<?php else: echo ($foo[author]); endif; ?></span><span class="muted"><i class="icon-eye-open icon12"></i><?php echo ($foo[click]); ?>浏览</span> <span class="muted"></span>
										<a href="/<?php echo ($foo["modenname"]); ?>/<?php echo ($foo["catenname"]); ?>"><span class="label"><?php echo ($foo["catname"]); ?></span></a>
									</p>
								</div>
								<div class="clean"></div>
							
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
			    </ul>
			  </div>
	     </div>
		 <div class="clean"></div>
         <div class="col-md-7">
			  <div class="panel panel-info">
				<div class="panel-heading">
				  <h3 class="panel-title">好词好句</h3>
				</div>
			   <ul class="row list-group">
				<?php if(is_array($haocijudata)): $i = 0; $__LIST__ = $haocijudata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i; if($art["bj"] == 1): ?><li>
							<a class="list-group-item" href="/haocihaoju/html/<?php echo ($art["indexid"]); ?>.html" >
								<div class="col-md-6">
									<?php echo ($art["title"]); ?><small class="text-muted">--<?php if(empty($art["author"])): ?>佚名<?php else: echo ($art["author"]); endif; ?></small>
								</div>
								<div class="col-md-6">
									<div class="rateit pull-right" data-rateit-value="<?php echo ($art["starfenshu"]); ?>" title="<?php echo ($art["starfenshu"]); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"><font>好句(0)</font><font>好段(0)</font></div>
									<div></div>
								</div>
								<div class="clean"></div>
							</a>
						</li>		
					<?php else: ?>
						<li>
							<a class="list-group-item bei2" href="/haocihaoju/html/<?php echo ($art["indexid"]); ?>.html" >
								<div class="col-md-6">
									<?php echo ($art["title"]); ?><small class="text-muted">--<?php if(empty($art["author"])): ?>佚名<?php else: echo ($art["author"]); endif; ?></small>
								</div>
								<div class="col-md-6">
									<div class="rateit pull-right" data-rateit-value="<?php echo ($art["starfenshu"]); ?>" title="<?php echo ($art["starfenshu"]); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"><font>好句(0)</font><font>好段(0)</font></div>
								</div>
								<div class="clean"></div>
							</a>
						</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			  </ul>
			  </div>
	     </div>
		 <div class="clean"></div>
         <div class="col-md-7">
			  <div class="panel panel-info">
				<div class="panel-heading">
				  <h3 class="panel-title">简看教材</h3>
				</div>
			   <ul class="row list-group">
				<?php if(is_array($jiaocaidata)): $i = 0; $__LIST__ = $jiaocaidata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i; if($art["bj"] == 1): ?><li>
							<a class="list-group-item" href="/jiaocai/html/<?php echo ($art["indexid"]); ?>.html" >
								<div class="col-md-6">
									<?php echo ($art["title"]); ?><small class="text-muted">--<?php if(empty($art["author"])): ?>佚名<?php else: echo ($art["author"]); endif; ?></small>
								</div>
								<div class="col-md-6">
									<div class="rateit pull-right" data-rateit-value="<?php echo ($art["starfenshu"]); ?>" title="<?php echo ($art["starfenshu"]); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"><font>好句(0)</font><font>好段(0)</font></div>
									<div></div>
								</div>
								<div class="clean"></div>
							</a>
						</li>		
					<?php else: ?>
						<li>
							<a class="list-group-item bei2" href="/jiaocai/html/<?php echo ($art["indexid"]); ?>.html" >
								<div class="col-md-6">
									<?php echo ($art["title"]); ?><small class="text-muted">--<?php if(empty($art["author"])): ?>佚名<?php else: echo ($art["author"]); endif; ?></small>
								</div>
								<div class="col-md-6">
									<div class="rateit pull-right" data-rateit-value="<?php echo ($art["starfenshu"]); ?>" title="<?php echo ($art["starfenshu"]); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"><font>好句(0)</font><font>好段(0)</font></div>
								</div>
								<div class="clean"></div>
							</a>
						</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			  </ul>
			  </div>
	     </div>
    </div>

    
   
 


  </div>
  
  <div class="col-lg-4 col-md-4 col-sm-4 sidebar">
  
  
    <aside class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">站长寄语</h3>
      </div>
      <div class="panel-body">
      		网站全面改版！更多精彩体验尽请期待！
      </div>
    </aside>


    <aside class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">最新注册会员</h3>
      </div>
      <ul class="ds-recent-visitors" data-num-items="24" data-show-time="0" data-avatar-size="44" id="ds-recent-visitors">
        <?php if(is_array($userslist)): $i = 0; $__LIST__ = $userslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$portraits): $mod = ($i % 2 );++$i; if($portraits["haveimg"] == 1): ?><li>
				        <div class="userlist">
						    <a title="<?php echo ($portraits["username"]); ?>"><img style="width:44px;height:44px" src="/Public/FaustCplus/php/img/small_user_<?php echo ($portraits["id"]); ?>.jpg" alt=""></a>
						    <a href="#"><?php echo ($portraits["username"]); ?></a>
							<span class="pull-right text-muted"><?php echo (date('y-m-d',$portraits["time"])); ?></span>
						</div>
				</li>
            <?php else: ?>
                <li>
				        <div class="userlist">
						    <a title="<?php echo ($portraits["username"]); ?>"><img style="width:44px;height:44px" src="/Public/FaustCplus/php/img/noimg.png" alt=""></a>
						    <a href="#"><?php echo ($portraits["username"]); ?></a>
							<span class="pull-right text-muted"><?php echo (date('y-m-d',$portraits["time"])); ?></span>
						</div>
				</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </aside>
	
    <div id="ad" data-spy="affix" class="fade in"><a class="close" data-dismiss="alert" href="#" aria-hidden="true" style="position:absolute;color:#c5c5c5;" title="关闭"><span class="glyphicon glyphicon-ban-circle"></span></a>
      <aside class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">赞助商</h3>
        </div>
        <div class="panel-body" style="padding:0;text-align:left;">
        	<?php echo R('Siteinfo/info',array('ad'),'Widget');?>
        </div>
      </aside>
    </div>
    <!-- 右侧底部广告 --> 
    <script>var ad=$('#ad'),st;var sd=$('.sidebar'),st;ad.attr('data-offset-top',ad.offset().top+ad.innerWidth());var wd=sd.innerWidth()-30;ad.attr({style:'width:'+wd+'px'});</script> 
  
    <div class="panel-group mb20" id="accordion">
	
			<div class="panel panel-monthhot-border">
				<div class="panel-monthhot">
					<span class="glyphicon glyphicon-fire mr10"></span><font>热门文章</font>
				</div>
				<div class="panel-neirong">
				    <ul>
				    <?php if(is_array($monthclicklist)): $i = 0; $__LIST__ = $monthclicklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="__APP__/zuowen/html/<?php echo ($vo['indexid']); ?>.html"><?php echo ($vo['title']); ?></a><small class='text-muted'><?php echo ($vo['author']); ?></small></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			
			<div class="panel panel-weekhot-border">
				<div class="panel-weekhot">
					<span class="glyphicon glyphicon-fire mr10"></span><font>热门标签</font>
				</div>
				<div class="panel-neirong"></div>
			</div>
    </div>
  
  </div>
  <div class="clean"></div>
</div>

<!-- footer start -->
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