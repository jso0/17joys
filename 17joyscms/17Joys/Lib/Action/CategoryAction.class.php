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
class CategoryAction extends CommonAction {
	function view(){
		$id=$_GET['id'];
		
		$category=D('Category','Admin');
		$data=$category->getById($id);
		$this->assign('category',$data);
		$this->assign('title',$data['title']);
		
		$section=D('Section','Admin');
		$data=$section->getById($data['sectionid']);
		$this->assign('section',$data);
		
		import('ORG.Util.Page');
		$article=D('Article','Admin');
		$count=$article->where('catid='.$id)->count();
		$page=new Page($count,C('PAGESIZE'));
		$show=$page->show();
		$this->assign("show",$show);
		$data=$article->where('catid='.$id)
			->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('article',$data);
		
		$this->getModules();
		
		$this->assign('content','Category:view');
		$this->display('Layout:index');
	}
}
?>