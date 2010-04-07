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
class LatestNewsWidget extends Widget {
	function render($data){
		$params=$data['params'];
		$params=parseParams($params);
		$article=D('Article','Admin');
		
		if(!empty($params['sid']) && $params['sid']>0){
			$where='sectionid='.$params['sid'];
			if(!empty($params['cid']) && $params['cid']>0)
				$where.=' and catid='.$params['cid'];
		}
		
		$list=$article->order('created desc')->where($where)->limit(10)->select();
		
		$menuitem=D('MenuItem','Admin');
		$milist=$menuitem->where("link like 'index.php/Section/view/id/%'")->select();
		foreach ($list as &$a){
			foreach($milist as $mi){
				if($a['sectionid']==(int)substr($mi['link'],-1))
					$a['itemid']=$mi['id'];
			}
		}
		$data['alist']=$list;
		
		$content=$this->renderFile('latestnews',$data);
 		return $content;
	}
}
?>