<?php
class ArticleModel extends Model {
	protected  $_validate = array(
		array('title','require','分类标题必须填写！',1),
		array('published',array(0,1),'启用：1 ; 停用：0',0,'in'),
	);
	protected $_auto=array(
		array('alias','getAlias',3,'callback'),
		array('title_alias','getTitleAlias',3,'callback'),
		array('order','0'),
		array('published','1'),
		array('created','getDate',1,'callback'),
		array('created_by','getUser',1,'callback'),
		array('modified','getDate',2,'callback'),
		array('modified_by','getUser',2,'callback'),
	);
	
	
	public function getAlias(){
		if(empty($_POST['alias'])){
			return date("Y-m-d-H-i-s");
		}else{
			//需要判断是否是中文
			return $_POST['alias'];
		}
	}
	public function getTitleAlias(){
		if(empty($_POST['title_alias'])){
			return substr(strip_tags($_POST['introtext']),0,30);
		}else{
			//需要判断是否是中文
			return $_POST['title_alias'];
		}
	}	
	function getDate(){
		return date('Y-m-d H:i:s');
	}
	function getUser(){
		return '1';
	}
}
?>