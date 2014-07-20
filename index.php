<?php
//定义项目名称和路径

define('WWW_PATH', dirname(__FILE__)); // 站点www目录
define('HTML_PATH','./');
define('APP_NAME', 'Home');
define('APP_PATH', './Hottredpen/');
define('APP_DEBUG',true);

//BAE上时开启
//define('ENGINE_NAME','cluster');

// 加载框架入口文件
require( "./ThinkPHP/ThinkPHP.php");