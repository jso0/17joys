<?php
class CategoryModel extends Model {
	protected  $_validate = array(
		array('title','require','分类标题必须填写！',1),
		array('published',array(0,1),'启用：1 ; 停用：0',0,'in'),
	);
	protected $_auto=array(
		array('alias','getAlias',1,'callback'),
		array('order','0'),
		array('published','1'),
	);
	
	
	public function getAlias(){
		if(empty($_POST['alias'])){
			return date("Y-m-d-H-i-s");
		}else{
			//需要判断是否是中文
			return $_POST['alias'];
		}
	}
}
?>