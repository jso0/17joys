<?php
class MenuItemModel extends Model {

	protected $_validate=array(
		array('name','require','菜单项名称必须存在！',1),
		array('order','number','排序必须是数字！',2),
	);
	
	protected $_auto=array(
		array('path','getPath',3,'callback'),
		array('alias','getAlias',1,'callback'),
	);
	
	function getPath(){
		$pid=$_POST['pid'];
		$mi=$this->field('id,path')->getById($pid);
		$path=$pid!=0?$mi['path'].'-'.$mi['id']:0;
		return $path;
	}
	
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