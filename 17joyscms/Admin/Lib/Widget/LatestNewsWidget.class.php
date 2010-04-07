<?php
class LatestNewsWidget extends Widget {
	function render($data){
		$section=new SectionModel();
		$list=$section->select();
		$data['slist']=$list;
		$cat=new CategoryModel();
		$list=$cat->select();
		$data['clist']=$list;
		$content=$this->renderFile('params',$data);
 		return $content;
	}
}
?>