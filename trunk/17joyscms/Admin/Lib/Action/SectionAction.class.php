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
class SectionAction extends CommonAction {

	function index(){
		import('ORG.Util.Page');
		$sec=new SectionModel();
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
		
		$count=$sec->where($where)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);
		$list=$sec->order('id')->where($where)
		->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('slist',$list);
		
		$role=new Model('Role');
		$list=$role->getField('id,name');
		$this->assign('rlist',$list);
		$this->display();
	}

	function insert(){
		$sec=new SectionModel();
		if($data=$sec->create()){
			if(false!==$sec->add()){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功，插入数据编号为：'.$sec->getLastInsID());
			}else{
				$this->error('操作失败：addsection'.$sec->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$sec->getError().' )');
		}
	}

	function update(){
		$sec=new SectionModel();
		if($data=$sec->create()){
			if(!empty($data['id'])){
				if(false!==$sec->save()){
					$this->assign('jumpUrl',__URL__.'/index');
					$this->success('操作成功');
				}else{
					$this->error('操作失败：'.$sec->getDbError());
				}
			}else{
				$this->error('请选择编辑用户');
			}
		}else{
			$this->error('操作失败：数据验证( '.$sec->getError().' )');
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
			$sec=new SectionModel();
			$date=$sec->getById($id);
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
			$sec=new SectionModel();
			$id=implode(',',$did);
			if(false!==$sec->delete($id)){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：'.$sec->getDbError());
			}
		}else{
			$this->error('请选择删除用户');
		}
	}
	
	function helper(){
		import('ORG.Util.Page');
		$sec=new SectionModel();
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
		$where['published']=array('gt',0);
		$count=$sec->where($where)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);
		$list=$sec->order('id')->where($where)
		->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('slist',$list);
		
		$role=new Model('Role');
		$list=$role->getField('id,name');
		$this->assign('rlist',$list);
		
		if(!empty($_GET['maction']))
			$this->assign('maction',$_GET['maction']);
		else
			$this->assign('maction','add');
		$this->display();
	}
}
?>