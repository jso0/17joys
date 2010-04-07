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
class UserAction extends CommonAction {
	function index(){
		import('ORG.Util.Page');
		$user=new UserModel();
		$keyword=$_POST['keyword'];
		$ftype=$_POST['ftype'];
		if(!empty($keyword) && !empty($ftype)){
			$where[$ftype]=array('like','%'.$keyword.'%');
			$_SESSION['keyword']=$where;
		}else{
			if(empty($keyword) && !empty($ftype)){
				unset($_SESSION['keyword']);
			}else if(!empty($_SESSION['keyword'])){
				$where=$_SESSION['keyword'];	
			}
		}
		
		$count=$user->where($where)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);
		$list=$user->order('id')->where($where)
		->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('ulist',$list);
		$this->display();
	}

	function insert(){
		$user=new UserModel();
		if($data=$user->create()){
			if(false!==$user->add()){
				$uid=$user->getLastInsID();
				$ru['role_id']=$_POST['role_id'];
				$ru['user_id']=$uid;
				$roleuser=new Model('RoleUser');
				$roleuser->add($ru);
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功，插入数据编号为：'.$uid);
			}else{
				$this->error('操作失败：adduser'.$user->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$user->getError().' )');
		}
	}

	function update(){
		$user=new UserModel();
		if($data=$user->create()){
			if(!empty($data['id'])){
				$opwd=$_POST['opwd'];
				$user->password=empty($user->password)?$opwd:md5($user->password);
				if(false!==$user->save()){
					$ru['role_id']=$_POST['role_id'];
					$roleuser=new Model('RoleUser');
					$roleuser->where('user_id='.$user->id)->save($ru);
					$this->assign('jumpUrl',__URL__.'/index');
					$this->success('操作成功');
				}else{
					$this->error('操作失败：'.$user->getDbError());
				}
			}else{
				$this->error('请选择编辑用户');
			}
		}else{
			$this->error('操作失败：数据验证( '.$user->getError().' )');
		}
	}

	function add(){
		$role=new Model('Role');
		$list=$role->select();
		$this->assign('rlist',$list);
		$this->display();
	}

	function edit(){
		$id=$_GET['id'];
		if(!empty($id)){
			$user=new UserModel();
			$date=$user->field('id,username,name,password,email,active,role_id')
			->join('joys_role_user on id=user_id')->getById($id);
			$this->assign('udate',$date);
			$role=new Model('Role');
			$list=$role->select();
			$this->assign('rlist',$list);
		}
		$this->display();
	}

	function delete(){
		
		$did=$_POST['did'];
		if(!empty($did) && is_array($did)){
			$user=new UserModel();
			$id=implode(',',$did);
			if(false!==$user->delete($id)){
				$roleuser=new Model('RoleUser');
				$roleuser->where('user_id in('.$id.')')->delete();
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：'.$user->getDbError());
			}
		}else{
			$this->error('请选择删除用户');
		}
	}
}
?>