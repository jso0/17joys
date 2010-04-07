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
class MenuItemAction extends CommonAction {

	function index(){		
		import('ORG.Util.Page');
		$menuitem=new MenuItemModel();
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
		if(!empty($_REQUEST['id'])){
			$_SESSION['menuid']=$_REQUEST['id'];
			$where['menuid']=$_SESSION['menuid'];
		}elseif($_SESSION['menuid']){
			$where['menuid']=$_SESSION['menuid'];
		}else{
			$this->error('请选择菜单');
		}
		
		$count=$menuitem->where($where)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);
		
		$list=$menuitem
		->field("id,name,pid,type,componentid,`order`,published,access,concat(path,'-',id) as bpath")
		->order("bpath,id")->limit($page->firstRow.','.$page->listRows)
		->where($where)->select();
		foreach($list as $key=>$value){
			$list[$key]['signnum']= count(explode('-',$value['bpath']))-1;
			$list[$key]['marginnum']= (count(explode('-',$value['bpath']))-1)*20;
		}
		$this->assign('milist',$list);
		
		$role=new Model('Role');
		$list=$role->getField('id,name');
		$this->assign('rlist',$list);
		
		$this->display();
	}

	function update(){
		$menuitem=new MenuItemModel();
		if($data=$menuitem->create()){
			if(!empty($data['id'])){
				if(false!==$menuitem->save()){
					$this->assign('jumpUrl',__URL__.
					'/index/id/'.$_SESSION['menuid']);
					$this->success('操作成功');
				}else{
					$this->error('操作失败：'.$menuitem->getDbError());
				}
			}else{
				if(false!==$menuitem->add()){
					$this->assign('jumpUrl',__URL__.
					'/index/id/'.$_SESSION['menuid']);
					$this->success('操作成功，插入数据编号为：'.$menuitem->getLastInsID());
				}else{
					$this->error('操作失败：'.$menuitem->getDbError());
				}
			}
		}else{
			$this->error('操作失败：数据验证( '.$menuitem->getError().' )');
		}
	}

	function add(){		
		$comid=$_SESSION['componentid'];
		$cid=$_POST['cid'];
		$com=new Model('Component');
		if(!empty($comid) && !empty($cid)){		
			$cdata=$com->where('enabled=1')->find($comid);
			$link="index.php/".$cdata['link']."/".$cdata['option']."/id/".$cid;
			$this->assign('link',$link);
			$this->assign('type',$cdata['link']);
		}else{
			$this->error('请选择菜单项内容');
		}
		$menuitem=new MenuItemModel();
		$list=$menuitem
		->field("id,name,pid,type,componentid,`order`,published,access,concat(path,'-',id) as bpath")
		->order("bpath,id")->where('menuid='.$_SESSION['menuid'])->select();
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
		$cid=$_POST['cid'];
		$comid=$_SESSION['componentid'];
		$this->assign('comid',$comid);
		$menuid=$_SESSION['menuid'];
		
		$menuitem=new MenuItemModel();
		$list=$menuitem
		->field("id,name,pid,type,componentid,`order`,published,access,concat(path,'-',id) as bpath")
		->order("bpath,id")->where('menuid='.$_SESSION['menuid'])->select();
		foreach($list as $key=>$value){
			$list[$key]['signnum']= count(explode('-',$value['bpath']))-1;
			$list[$key]['marginnum']= (count(explode('-',$value['bpath']))-1)*20;
		}
		$this->assign('milist',$list);
		$role=new Model('Role');
		$list=$role->select();
		$this->assign('rlist',$list);
		
		$menuitemid=empty($_GET['id'])?$_SESSION['menuitemid']:$_GET['id'];
		if(empty($menuitemid)){
			$com=new Model('Component');
			$cdata=$com->where('enabled=1')->find($comid);
			$link="index.php/".$cdata['link']."/".$cdata['option']."/id/".$cid;
			$this->assign('link',$link);
			$this->assign('type',$cdata['link']);
		}else{
			$menuitem=new MenuItemModel();
			$data=$menuitem->getById($menuitemid);
			if(!empty($_SESSION['componentid'])){
				$com=new Model('Component');
				$cdata=$com->where('enabled=1')->find($comid);
				$link="index.php/".$cdata['link']."/".$cdata['option']."/id/".$cid;
				$this->assign('link',$link);
				$this->assign('type',$cdata['link']);
			}
			$this->assign('udate',$data);
		}
		unset($_SESSION['componentid']);
		$this->display();
	}
	
	function delete(){
		
		$did=$_POST['did'];
		if(!empty($did) && is_array($did)){
			$menuitem=new MenuItemModel();
			$id=implode(',',$did);
			if(false!==$menuitem->delete($id)){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：'.$menuitem->getDbError());
			}
		}else{
			$this->error('请选择删除用户');
		}
	}

	function component(){
		$comid=$_GET['comid'];
		$menuitemid=$_GET['menuitemid'];
		if(!empty($menuitemid)){
			$_SESSION['menuitemid']=$menuitemid;
		}else{
			unset($_SESSION['menuitemid']);
		}
		
		$com=new Model('Component');
		if(!empty($comid)){
			$data=$com->getById($comid);
			$_SESSION['componentid']=$comid;
			$this->redirect(__APP__.'/'.$data['link'].'/helper');
		}else{
			$list=$com->where('enabled=1')->select();
			$this->assign('comlist',$list);
			$this->display();
		}
	}
	
}
?>