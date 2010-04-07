<?php
class MenuModel extends Model {
	protected $_validate=array(
		array('title','require','菜单名称必须存在！',1),
		array('menutype','require','菜单类别必须存在！',1),
		array('menutype','','菜单类别已经存在！',1,'unique',1),
	);
}
?>