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
class CommonAction extends Action {
	function _initialize(){
		header("Content-Type:text/html; charset=utf-8");
		if(C('USER_AUTH_ON') && !in_array(MODULE_NAME,explode(',',C('NOT_AUTH_MODULE')))){
			import('ORG.Util.RBAC');
			if(!RBAC::AccessDecision()){
				if(!$_SESSION[C('USER_AUTH_KEY')]){
					$this->assign('jumpUrl',__APP__.'/Public/login');
					$this->error('对不起，你没有登录！请重新登录');
				}
				
				if(C('GUEST_AUTH_ON')){
					//判断是否开启游客，如果开启则跳转到游客页面
				}
				$this->error(L('_VALID_ACCESS_'));
			}
		}
	}
}
?>