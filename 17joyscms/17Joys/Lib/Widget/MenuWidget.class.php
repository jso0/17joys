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
class MenuWidget extends Widget {
	function render($data){
		
		$params=$data['params'];
		$params=parseParams($params);
		$menuitem=D('MenuItem','Admin');
		$list=$menuitem->field("id,name,link,`order`,access,concat(path,'-',id) as bpath")
		->order("bpath,id")->where('menuid='.$params['id'])->select();
		
		foreach($list as $key=>$value){
			$list[$key]['signnum']= count(explode('-',$value['bpath']))-1;
			$list[$key]['marginnum']= (count(explode('-',$value['bpath']))-1)*20;
		}
		$data['milist']=$list;
		$content=$this->renderFile(empty($params['style'])?'verticalmenu':$params['style'],$data);
 		return $content;
	}
}
?>