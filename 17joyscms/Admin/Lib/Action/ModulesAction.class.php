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
class ModulesAction extends CommonAction {

	function index(){
		import('ORG.Util.Page');
		$mod=new ModulesModel();
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
		
		$count=$mod->where($where)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);
		$list=$mod->order('id')->where($where)
		->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('modlist',$list);		
		
		$role=new Model('Role');
		$list=$role->getField('id,name');
		$this->assign('rlist',$list);
		
		$this->display();
	}

	function insert(){
		$mod=new ModulesModel();
		if($data=$mod->create()){
			if(false!==$mod->add()){
				$menuid=$mod->getLastInsID();
				$modmenu=new Model('ModulesMenu');
				$modmenu->modulesid=$menuid;
				if(empty($_POST['menuid'])){
					$modmenu->menuid=0;
					$modmenu->add();
				}else{
					foreach ($_POST['menuid'] as $v){
						$modmenu->menuid=$v;
						$modmenu->add();
					}
				}
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功，插入数据编号为：'.$menuid);
			}else{
				$this->error('操作失败：addsection'.$mod->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$mod->getError().' )');
		}
	}

	function update(){
		$mod=new ModulesModel();
		if($data=$mod->create()){
			if(!empty($data['id'])){
				if(false!==$mod->save()){
					$modmenu=new Model('ModulesMenu');
					$modmenu->where('modulesid='.$mod->id)->delete();
					$modmenu->modulesid=$mod->id;
					if(empty($_POST['menuid'])){
						$modmenu->menuid=0;
						$modmenu->add();
					}else{
						foreach ($_POST['menuid'] as $v){
							$modmenu->menuid=$v;
							$modmenu->add();
						}
					}
					$this->assign('jumpUrl',__URL__.'/index');
					$this->success('操作成功');
				}else{
					$this->error('操作失败：'.$mod->getDbError());
				}
			}else{
				$this->error('请选择编辑用户');
			}
		}else{
			$this->error('操作失败：数据验证( '.$mod->getError().' )');
		}
	}

	function add(){
		$menu=new MenuModel();
		$list=$menu->select();
		$this->assign('mlist',$list);
		
		$menuitem=new MenuItemModel();
		$list=$menuitem
		->field("id,name,menuid,pid,type,componentid,`order`,published,access,concat(path,'-',id) as bpath")
		->order("bpath,id")->select();
		foreach($list as $key=>$value){
			$list[$key]['signnum']= count(explode('-',$value['bpath']))-1;
			$list[$key]['marginnum']= (count(explode('-',$value['bpath']))-1)*20;
		}
		$this->assign('milist',$list);
		$role=new Model('Role');
		$list=$role->select();
		$this->assign('rlist',$list);
		
		$this->display();
	}
	function edit(){
		$id=$_GET['id'];
		if(!empty($id)){
			$mod=new ModulesModel();
			$date=$mod->getById($id);
			$this->assign('udate',$date);
			
			$menu=new MenuModel();
			$list=$menu->select();
			$this->assign('mlist',$list);
			
			$menuitem=new MenuItemModel();
			$list=$menuitem
			->field("id,name,menuid,pid,type,componentid,`order`,published,access,concat(path,'-',id) as bpath")
			->order("bpath,id")->select();
			foreach($list as $key=>$value){
				$list[$key]['signnum']= count(explode('-',$value['bpath']))-1;
				$list[$key]['marginnum']= (count(explode('-',$value['bpath']))-1)*20;
			}
			$this->assign('milist',$list);

			$role=new Model('Role');
			$list=$role->select();
			$this->assign('rlist',$list);

			$modmenu=new Model('ModulesMenu');
			$list=$modmenu->where('modulesid='.$id)->select();
			$this->assign('modmenu',$list);
			
		}
		$this->display();
	}
	
	function delete(){
		
		$did=$_POST['did'];
		if(!empty($did) && is_array($did)){
			$mod=new ModulesModel();
			$id=implode(',',$did);
			if(false!==$mod->delete($id)){
				$modmenu=new Model('ModulesMenu');
				$modmenu->where('modulesid in('.$id.')')->delete();
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：'.$mod->getDbError());
			}
		}else{
			$this->error('请选择删除用户');
		}
	}
	
	function modules(){
		$mod=C('MODULES');
		$this->assign('mod',$mod);
		$this->display();
	}
}
?>