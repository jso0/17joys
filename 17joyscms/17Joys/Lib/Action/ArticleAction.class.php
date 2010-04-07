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
class ArticleAction extends CommonAction {
	function view(){
		$id=$_GET['id'];
		$article=D('ArticleView','Admin');
		$data=$article->where('Article.id='.$id)->find();
		$this->assign('article',$data);
		$this->assign('title',$data['atitle']);
		$article->where('Article.id='.$id)
			->setField('hits',$article->hits+1);
		
		$prev=$article->where('Article.id<'.$id)->order('Article.id desc')->limit(1)->find();
		$next=$article->where('Article.id>'.$id)->order('Article.id')->limit(1)->find();

		$this->assign('prev_art',$prev);
		$this->assign('next_art',$next);
			
		$itemid=empty($_GET['itemid'])?0:$_GET['itemid'];
    	$mod=D('Modules','Admin');
    	$right=$mod->join('inner join joys_modules_menu
on id=modulesid')->where("`position`='right' and (menuid=".$itemid." or menuid=0)")->select();
    	$this->assign('right',$right);
    	
    	$this->getModules();
    	
    	$this->assign('content','Article:view');
		$this->display('Layout:index');
	}
}
?>