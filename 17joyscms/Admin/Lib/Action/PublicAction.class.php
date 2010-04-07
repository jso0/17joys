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
class PublicAction extends Action {
	function left(){
		$menu=new MenuModel();
		$list=$menu->select();
		$this->assign('mlist',$list);
		$this->display();
	}
	function login(){
		if(empty($_SESSION[C('USER_AUTH_KEY')])){
			$this->display();
		}else{
			$this->redirect('Index/index');
		}
	}
	
	function verify(){
		import("ORG.Util.Image");
		Image::buildImageVerify();		
	}
	
	function checklogin(){
		if(empty($_POST['username'])) {
			$this->error('帐号错误！');
		}elseif (empty($_POST['password'])){
			$this->error('密码必须！');
		}elseif (empty($_POST['verify'])){
			$this->error('验证码必须！');
		}
		$map=array();
		$map['username']=$_POST['username'];
		$map['active']=array('gt',0);
		if($_SESSION['verify'] != md5($_POST['verify'])) {
			$this->error('验证码错误！');
		}
		
		import('ORG.Util.RBAC');
		$authInfo=RBAC::authenticate($map);
		
		if(empty($authInfo)){
			$this->error('账号不存在或者被禁用!');
		}else{
			if($authInfo['password']!=md5($_POST['password'])){
				$this->error('账号密码错误!');
			}
			$_SESSION[C('USER_AUTH_KEY')]=$authInfo['id'];
			$_SESSION['email']=$authInfo['email'];
			$_SESSION['nickname']=$authInfo['name'];
            $_SESSION['lastLoginDate']=$authInfo['last_login_date'];
			
			if($authInfo['username']=='admin'){
				$_SESSION[C('ADMIN_AUTH_KEY')]=true;
			}
			
			$user=M('User');
			$lastdate=date('Y-m-d H:i:s');
            $data=array();
			$data['id']=$authInfo['id'];
			$data['last_login_date']=$lastdate;
			$user->save($data);
			
			RBAC::saveAccessList();
			$this->assign('jumpUrl',__APP__.'/Index/index');
			$this->success('登录成功!');
		}
	}
	
	function logout(){
		if(!empty($_SESSION[C('USER_AUTH_KEY')])){
			unset($_SESSION[C('USER_AUTH_KEY')]);
			$_SESSION=array();
			session_destroy();
			$this->assign('jumpUrl',__URL__.'/login');
			$this->success('登出成功');
		}else{
			$this->error('已经登出了');
		}
	}
	
	function main(){
		$user=new Model('User');
		$count=$user->count();
		$this->assign('ucount',$count);
		$sec=new Model('Section');
		$count=$sec->count();
		$this->assign('scount',$count);
		$cat=new Model('Category');
		$count=$cat->count();
		$this->assign('ccount',$count);
		$art=new Model('Article');
		$count=$art->count();
		$this->assign('acount',$count);
		$menu=new Model('Menu');
		$count=$menu->count();
		$this->assign('mcount',$count);
		$menuitem=new Model('MenuItem');
		$count=$menuitem->count();
		$this->assign('micount',$count);
		$mod=new Model('Modules');
		$count=$mod->count();
		$this->assign('modcount',$count);
		$role=new Model('Role');
		$count=$role->count();
		$this->assign('rcount',$count);
		$node=new Model('Node');
		$count=$node->count();
		$this->assign('ncount',$count);
		
		$serverinfo = PHP_OS.' / PHP v'.PHP_VERSION;
		$serverinfo .= @ini_get('safe_mode') ? ' Safe Mode' : NULL;
		$dbversion = $user->query("SELECT VERSION()");
		$fileupload = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : '<font color="red">不支持上传</font>';
		$dbsize = $dbsize ? RealSize($dbsize) : '未知大小';
		$dbversion = $user->query("SELECT VERSION()");
		
		$array['serverinfo']=$serverinfo;
		$array['dbversion']=$dbversion;
		$array['fileupload']=$fileupload;
		$array['dbsize']=$dbsize;
		$array['dbversion']=$dbversion[0]['VERSION()'];
		$this->assign($array);
		
		
		@$f=fopen("http://www.17joys.com/info.html",'r');
		if($f){
			$this->assign('flg',true);
		}else{
			$this->assign('flg',false);
		}
		$this->display();
	}
}
?>