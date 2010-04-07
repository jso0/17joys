<?php
class ModulesModel extends Model {
	protected  $_validate = array(
		array('title','require','模块名称必须填写！',1),
	);
	protected $_auto=array(
		array('order','0'),
		array('published','1'),
		array('params','getParams',3,'callback'),
	);
	
	function getParams(){
		$params=$_POST['params'];
		foreach($params as $k=>$v){
			$p[]=$k.'='.$v;
		}
		return implode("\n",$p);
	}
}
?>