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
	function view(){
		
		$id=$_GET['id'];
		
		$section=D('Section','Admin');
		$data=$section->getById($id);
		$this->assign('section',$data);
		$this->assign('title',$data['title']);
		
		import('ORG.Util.Page');		
		$category=D('Category','Admin');
		$count=$category->where('sectionid='.$id)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);		
		$data=$category->where('sectionid='.$id)
			->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('category',$data);
		
		$this->getModules();
		
		$this->assign('content','Section:view');
		$this->display('Layout:index');
	}
}
?>