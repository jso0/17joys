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
class RoleAction extends CommonAction {

	function index(){
		import('ORG.Util.Page');
		$role=new RoleModel();
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
		
		$count=$role->where($where)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);
		$list=$role->order('id')->where($where)
		->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('rlist',$list);
		$this->display();
	}
	function insert(){
		$role=new RoleModel();
		if($data=$role->create()){
			if(false!==$role->add()){
				$uid=$role->getLastInsID();
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功，插入数据编号为：'.$uid);
			}else{
				$this->error('操作失败：addrole'.$role->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$role->getError().' )');
		}
	}

	function update(){
		$role=new RoleModel();
		if($data=$role->create()){
			if(!empty($data['id'])){
				if(false!==$role->save()){
					$this->assign('jumpUrl',__URL__.'/index');
					$this->success('操作成功');
				}else{
					$this->error('操作失败：'.$role->getDbError());
				}
			}else{
				$this->error('请选择编辑用户');
			}
		}else{
			$this->error('操作失败：数据验证( '.$role->getError().' )');
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
			$role=new RoleModel();
			$date=$role->getById($id);
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
			$role=new RoleModel();
			$id=implode(',',$did);
			if(false!==$role->delete($id)){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：'.$role->getDbError());
			}
		}else{
			$this->error('请选择删除用户');
		}
	}
}
?>