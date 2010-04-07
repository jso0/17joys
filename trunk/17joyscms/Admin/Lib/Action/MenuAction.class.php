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
class MenuAction extends CommonAction {
	function index(){

		import('ORG.Util.Page');
		$menu=new MenuModel();
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
		
		$count=$menu->where($where)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);
		$list=$menu->order('id')->where($where)
		->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('mlist',$list);
		$this->display();
	}

	function insert(){
		$menu=new MenuModel();

		if($data=$menu->create()){
			if(false!==$menu->add()){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功，插入数据编号为：'.$menu->getLastInsID());
			}else{
				$this->error('操作失败：addsection'.$menu->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$menu->getError().' )');
		}
	}

	function update(){
		$menu=new MenuModel();
		if($data=$menu->create()){
			if(!empty($data['id'])){
				if(false!==$menu->save()){
					$this->assign('jumpUrl',__URL__.'/index');
					$this->success('操作成功');
				}else{
					$this->error('操作失败：'.$menu->getDbError());
				}
			}else{
				$this->error('请选择编辑用户');
			}
		}else{
			$this->error('操作失败：数据验证( '.$menu->getError().' )');
		}
	}

	function add(){
		$this->display();
	}

	function edit(){
		$id=$_GET['id'];
		if(!empty($id)){
			$menu=new MenuModel();
			$date=$menu->getById($id);
			$this->assign('udate',$date);
		}
		$this->display();
	}
	
	function delete(){
		
		$did=$_POST['did'];
		if(!empty($did) && is_array($did)){
			$menu=new MenuModel();
			$id=implode(',',$did);
			if(false!==$menu->delete($id)){
				$menuitem=new MenuItemModel();
				$menuitem->where('menuid='.$id)->delete();
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：'.$menu->getDbError());
			}
		}else{
			$this->error('请选择删除用户');
		}
	}
}
?>