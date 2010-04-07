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
class AccessAction extends CommonAction {

	function index(){
		$role=new RoleModel();
		$list=$role->select();
		$this->assign('rlist',$list);
				
		$this->display('Role:index');
	}

	function app(){
		$node=new NodeModel();
		$list=$node->where('level=1')->select();
		$this->assign('nlist',$list);
		
		$rid=$_GET['rid'];
		if(!empty($rid)){
			$access=new AccessModel();
			$list=$access->where('level=1 and role_id='.$rid)->getField('node_id,role_id');
			$this->assign('alist',$list);
		}
		
		$this->display();
	}

	function control(){
		$rid=$_GET['rid'];
		$nid=$_GET['nid'];
		if(!empty($rid) && !empty($nid)){
			$node=new NodeModel();
			$list=$node->where('level=2 and pid='.$nid)->select();
			$this->assign('nlist',$list);
			
			$access=new AccessModel();
			$list=$access->where('level=2 and role_id='.$rid)->getField('node_id,role_id');
			$this->assign('alist',$list);
		}
		$this->display();
	}

	function action(){
		$rid=$_GET['rid'];
		$nid=$_GET['nid'];
		if(!empty($rid) && !empty($nid)){
			$node=new NodeModel();
			$list=$node->where('level=3 and pid='.$nid)->select();
			$this->assign('nlist',$list);
			
			$access=new AccessModel();
			$list=$access->where('level=3 and role_id='.$rid)->getField('node_id,role_id');
			$this->assign('alist',$list);
		}
		
		$this->display();
	}
	
	function insert(){
		$rid=$_POST['rid'];
		$nid=$_POST['nid'];
		if(!empty($rid) && !empty($nid)){
			$node_id=implode(',',$nid);
			$node=new NodeModel();
			$list=$node->where('id in('.$node_id.')')->select();
			$access=new AccessModel();
			foreach($list as $node){
				$alist=$access->where('node_id ='.$node['id'].
					' and role_id='.$rid)->select();
				if(empty($alist)){
					$data['role_id']=$rid;
					$data['node_id']=$node['id'];
					$data["level"]=$node['level'];
					$data["pid"]=$node['pid'];
					$paccess=$access->where('role_id='.$rid.' and node_id='.$node['pid'])->find();
					if(empty($paccess) && $node['pid']!=0){
						$this->error('请先授权父层权限');
					}
					if(false!==$access->data($data)->add()){
						$flg=true;
					}else{
						$this->error($node['title'].'授权失败');
					}
				}
			}
			$this->success('授权成功');
		}else{
			$this->error('请选择用户组和权限');
		}
	}
	

	function delete(){
		$rid=$_POST['rid'];
		$nid=$_POST['nid'];
		if(!empty($rid) && !empty($nid)){
			$node_id=implode(',',$nid);
			$access=new AccessModel();
			if(false!==$access->where('node_id in('.$node_id.') and role_id='.$rid)->delete()){
				$this->success('取消授权成功');
			}else{
				$this->error('取消授权失败');
			}
			
		}else{
			$this->error('请选择用户组和权限');
		}
	}
}
?>