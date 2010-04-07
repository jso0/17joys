<?php
// +----------------------------------------------------------------------
// | 17Joys [ 让我们一起开发内容管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://www.17joys.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 马明 <alex0018@126.com>
// +----------------------------------------------------------------------
//
if(!file_exists("config.inc.php"))
	header("location: Install/index.php");
define('APP_NAME','17Joys');
define('APP_PATH','./17Joys');
define('THINK_PATH','./ThinkPHP');
require THINK_PATH.'/ThinkPHP.php';
App::run();
?>