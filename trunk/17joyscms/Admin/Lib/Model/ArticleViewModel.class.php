<?php
class ArticleViewModel extends ViewModel {
	public $viewFields=array(
		'Article'=>array('id'=>'aid','title'=>'atitle','introtext','published'=>'apublished','sectionid'=>'sid','catid'=>'cid','created','created_by','order'=>'aorder','access'=>'aaccess','hits'),
		'Section'=>array('title'=>'stitle','_on'=>'Section.id=Article.sectionid'),
		'Category'=>array('title'=>'ctitle','_on'=>'Category.id=Article.catid'),
		'User'=>array('username','name','_on'=>'User.id=Article.created_by'),
	);
}
?>