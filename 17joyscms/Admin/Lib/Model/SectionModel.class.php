<?php
class SectionModel extends Model {
	/*
	 * 表单验证
	 */
	protected  $_validate = array(
	//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
		array('title','require','单元名必须存在！',1,'regex',3),
		array('published',array(0,1),'启用：1 ; 停用：0',0,'in'),
	);
	
	/*
	 * 自动填充
	 */
	protected $_auto=array(
	//array(填充字段,填充内容,填充条件,附加规则)
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