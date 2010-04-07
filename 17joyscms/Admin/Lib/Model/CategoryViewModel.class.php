<?php
class CategoryViewModel extends ViewModel {
	public $viewFields=array(
		'Category'=>array('id'=>'cid','title'=>'ctitle','alias'=>'calias','published'=>'cpublished','order'=>'corder','access'=>'caccess','sectionid'),
		'Section'=>array('title'=>'sec_name','_on'=>'Category.sectionid=Section.id'),
	);
}
?>