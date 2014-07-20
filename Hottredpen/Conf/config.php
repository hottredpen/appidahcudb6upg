<?php
return array(
	//'配置项'=>'配置值'
	//'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
	'URL_CASE_INSENSITIVE'=>true,//模块名不区分大小写
	'URL_MODEL'=>2,
/*
*
开启局部静态
*
*/	
    'HTML_CACHE_ON'=>false,
    'HTML_CACHE_RULES'=> array(
        //'empty:index'=>array('{:module}_{:action}_{to}_{keid}_{uid}',3600),//指定静态
		'Index:index'=>array('Index/index',3600),//指定静态
		'English:ArtShow'=>array('English/Art/title/{tid}',3600),//指定静态
		'English:Art'=>array('English/Art/{mid}',3600)//指定静态
     ),
/*
*
开启日志记录
*
*/	
	'LOG_RECORD' => true, 
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误

       //数据库
  'DB_SQL' => 'mysql',
  'DB_HOST' => 'sqld.duapp.com',
  'DB_NAME' => 'qBDgtvIptekxhBEvgzIH',
  'DB_USER' => 'mkFjr6riGk8Oh1A2ILH5p342',
  'DB_PWD' => 'DOy0YxhBEs3BtLQLMHZ8IsI0h7W6gDDU',
  'DB_PORT' => '4050',
  'DB_PREFIX' => 'fdz_',
  'USER_AUTH_KEY'=>'userid',   
  
/*        //数据库
  'DB_SQL' => 'mysql',
  'DB_HOST' => 'localhost',
  'DB_NAME' => 'fdzzj',
  'DB_USER' => 'root',
  'DB_PWD' => '111',
  'DB_PORT' => '3306',
  'DB_PREFIX' => 'fdz_',
  'USER_AUTH_KEY'=>'userid',  */   
  
/*
*
模板引擎
*
*/	
  'TMPL_L_DELIM'=>'{',
  'TMPL_R_DELIM'=>'}',
/*
*
分组模式
*
*/	 
    'APP_GROUP_LIST' => 'Home,Admin,Member,Comments,Api', //项目分组设定
    'DEFAULT_GROUP'  => 'Home', //默认分组
    'VAR_GROUP' => 'g', // 默认分组获取变量
    'VAR_MODULE' => 'm', // 默认模块获取变量
    'VAR_ACTION' => 'a', // 默认操作获取变量


/*
*
二级域名【暂时不用】
*
*/	
		'APP_SUB_DOMAIN_DEPLOY'=>0, // 开启子域名配置
		/*子域名配置 
		*格式如: '子域名'=>array('分组名/[模块名]','var1=a&var2=b'); 
		*/ 
		'APP_SUB_DOMAIN_RULES'=>array(   
			'admin'=>array('Admin/'),  // admin域名指向Admin分组
		),
	
/*
*
编辑器图片上传相关配置 
*
*/	
    'EDITOR_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath' => './Uploads/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),	
/*
*
与数据MD5关联 
*
*/	
	//系统变量不要更改，更改将引响系统正常动作
	'DS_ENTERPRISE'			=>	'简看空间',
	'DS_EN_ENTERPRISE'		=>	'jk-kj.com',
	'DS_TOP_POWERED'		=>	'Powered by jk-kj.com',
	'DS_POWERED'			=>	'<p class="pull-left">Powered by <strong><a href="http://www.jk-kj.com" target="_blank">jk-kj.com</a></strong><br/>&copy; 2013-2015</p>',

/*
*
定义路由规则
*
*/	
 'URL_ROUTER_ON'   => true, //开启路由
 'URL_ROUTE_RULES' => array( 
        //以下与用户登录注册，找回密码有关，在logo模块
        'login'                                 => 'Logo/login',
		'loging'                                => 'Logo/loging',
		'register'                              => 'Logo/register',
		'addreg'                                => 'Logo/addreg',
		'exits'                                 => 'Logo/exits',
		'forgotpass'                            => 'Logo/forgotpass',
		'rPassword'                             => 'Logo/rPassword',
		'rsPassword'                            => 'Logo/rsPassword',
		//投稿与搜索
		'search'                                => 'DoApi/search',
		//以下为作文部分
		//'fenlei'                                => 'Zuowen/fenlei',

        'zuowen/tags/:tag\s'                    => 'zuowen/tags',
		'zuowen/html/:indexid\s'                => 'zuowen/html',
		'zuowen/user/:indexpuid\s'              => 'zuowen/user',
		'biaoqian/:words\s'                     => 'biaoqian/tags',
		//'jiaocai/xy4x/list'                     => 'shuji/kaka',
		//以前收录的
		'yygj/boredpanda/id/:indexid\s'       => 'yygj/html',
		'yygj/tags/:tag\s'                    => 'yygj/tags',
		'yygj/html/:indexid\s'                => 'yygj/html',
		'yygj/user/:indexpuid\s'              => 'yygj/user',
		//好词句
        'haocihaoju/tags/:tag\s'                    => 'haocihaoju/tags',
		'haocihaoju/html/:indexid\s'                => 'haocihaoju/html',
		'haocihaoju/user/:indexpuid\s'              => 'haocihaoju/user',
		//教材
        'jiaocai/tags/:tag\s'                    => 'jiaocai/tags',
		'jiaocai/html/:indexid\s'                => 'jiaocai/html',
		'jiaocai/user/:indexpuid\s'              => 'jiaocai/user',
		

		'Center/invest/:mid\s'        			=> 'Center/invest',
		'Center/loan/:mid\s'         			=> 'Center/loan',
		'Center/security/:mid\s'         		=> 'Center/security',
		'Center/fund/:mid\s'          			=> 'Center/fund',
		'Center/approve/:mid\s'      			=> 'Center/approve',
		'Center/basic/:mid\s'         			=> 'Center/basic',
		'Center/emailVerifyConfirm/:email_audit'=> 'Center/emailVerifyConfirm',
		'Center/stationexit/:id\s'         		=> 'Center/stationexit',
	),
/*
*
缩略图大小配置
*
*/	
	'SUOTU'=>array(
			'news' => array(
				'fromdir' => 'news', // 来源目录
				'type' => 'fit',
				'width' => 100,
				'height' => 100,
				'bgcolor' => '#FF0000'
			),
            //news模块下的另一个尺寸
			'news_1' => array(
				'fromdir' => 'news',
				'type' => 'fit',
				'width' => 200,
				'height' => 200,
				'bgcolor' => '#FFFF00'
			),
			'article' => array(
				'fromdir' => 'article',
				'type' => 'crop',
				'width' => 250,
				'height' => 250,
				'watermark' => WWW_PATH.'/supload/watermark.png'
			),
			'zuowen' => array(
				'fromdir' => 'zuowen', // 来源目录
				'type' => 'fit',
				'width' => 100,
				'height' => 100,
				'bgcolor' => '#FF0000'
			),
			'jiaocai' => array(
				'fromdir' => 'jiaocai', // 来源目录
				'type' => 'fit',
				'width' => '',
				'height' => '',
				'fangsuo'=>0.4,//宽高按比例放缩
				'bgcolor' => '#FF0000'
			),
	),
	
);
?>