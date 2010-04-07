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
class IndexAction extends CommonAction{
    public function index(){
    	$article=D('Article','Admin');
    	$list=$article->order('created desc,id desc')->limit('19')
    		->where('published=1')->select();
    	$this->assign('atop',$list);
    	
    	$section=D('Section','Admin');
    	$sdata=$section->where('id=1')->find();
    	$category=D('Category','Admin');
    	$list=$category->order('id')->where('sectionid='.$sdata['id'])->select();
    	
    	foreach ($list as $k=>$row){
    		$alist=$article->order('created desc,id desc')->limit('18')
    		->where('catid='.$row['id'].' and published=1')->select();
    		$ctitle[$k]=$row['title'];
    		$this->assign('a'.$k,$alist);
    	}

    	$this->assign('ctitle',$ctitle);
    	
    	$this->getModules();
    	$this->assign('content','Index:index');
    	$this->display('Layout:index');
    }
}
?>