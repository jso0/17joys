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
$config	=	require './config.inc.php';
$siteconfig= require './siteconfig.inc.php';
$array = array(
	//'配置项'=>'配置值'
	//'PAGESIZE'		=>	15,		//配置每页显示数据个数
	'URL_MODEL'		=>	1,
	'APP_DEBUG'		=>	false,	//调试模式开关
	'MODULES'		=>	array(
		'Menu'	=>	'菜单模块',
		'LatestNews'	=>	'最新文章模块',
	),
	
	'USER_AUTH_ON'			=>		true, 			//开启认证
	'USER_AUTH_TYPE'		=>		1,  			//用户认证使用SESSION标记
	'USER_AUTH_KEY'			=>		'authId',  		//设置认证SESSION的标记名称
	'ADMIN_AUTH_KEY'		=>		'administrator',//管理员用户标记
	'USER_AUTH_MODEL'		=>		'User',  		//验证用户的表模型joys_user
	'AUTH_PWD_ENCODER'		=>		'md5', 			//用户认证密码加密方式
	'USER_AUTH_GATEWAY'		=>		'/Public/login',//默认的认证网关
	'NOT_AUTH_MODULE'		=>		'Public',  		//默认不需要认证的模块'A,B,C'
	'REQUIRE_AUTH_MODULE'	=>		'',  			//默认需要认证的模块
	'NOT_AUTH_ACTION'		=>		'',				//默认不需要认证的动作
	'REQUIRE_AUTH_ACTION'	=>		'',				//默认需要认证的动作
	'GUEST_AUTH_ON'			=>		false,			//是否开启游客授权访问
	'GUEST_AUTH_ID'			=>		0, 				//游客标记
	
	'RBAC_ROLE_TABLE'		=>		'joys_role',
	'RBAC_USER_TABLE'		=>		'joys_role_user',
	'RBAC_ACCESS_TABLE'		=>		'joys_access',
	'RBAC_NODE_TABLE'		=>		'joys_node',
);

return array_merge($config,$siteconfig,$array);
?>