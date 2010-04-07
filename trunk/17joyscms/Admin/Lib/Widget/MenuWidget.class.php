<?php
class MenuWidget extends Widget {
	function render($data){
		$menu=new MenuModel();
		$list=$menu->select();
		$data['mlist']=$list;
		//分割参数，给编辑使用
		$data['params']=parseParams($data['params']);
		$content=$this->renderFile('params',$data);
 		return $content;
	}
}
?>