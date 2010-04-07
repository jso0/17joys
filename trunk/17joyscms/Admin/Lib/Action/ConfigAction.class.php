<?php
// +----------------------------------------------------------------------
// | 17Joys [ 让我们一起开发内容管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://www.17joys.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 马明 <alex0018@126.com>
// +----------------------------------------------------------------------
//
class ConfigAction extends CommonAction {
	function config(){
		$this->display();
	}
	
	function server(){
		$this->display();
	}
	
	function save(){
		$data=$_POST;
		$file=$data['file'];
		unset($data['file']);
		unset($data['__hash__']);
		//填充为空的项目	
		if($file=="siteconfig.inc.php"){	
			if($data["sitename"]=='')$data["sitename"]='17Joys CMS' ;
			if($data["siteurl"]=='')$data["siteurl"]='http://www.17joys.com' ;
			if($data["metakeys"]=='')$data["metakeys"]='17Joys, 17joys, 乐学PHP' ;
			if($data["metadesc"]=='')$data["metadesc"]='17Joys!（ 17Joys! ）——乐学PHP学院是国内专业的PHP培训机构，天津最好的PHP培训机构！' ;
			if($data["pagesize"]=='')$data["pagesize"]='15' ;
			if($data["email"]=='')$data["email"]='alex0018@126.com' ;
			if($data["contact"]=='')$data["contact"]='马明' ;
			if($data["company"]=='')$data["company"]='乐学PHP学院' ;
			if($data["phone"]=='')$data["phone"]='022-24458257' ;
			if($data["address"]=='')$data["address"]='天津' ;
			if($data["offline"]=='')$data["offline"]=0 ;
			if($data["offlinemessage"]=='')$data["offlinemessage"]='本站正在维护中，暂不能访问。<br /> 请稍后再访问本站。' ;
		}		
		
		$content = "<?php\r\n//17Joys CMS 网站配置文件\r\nif (!defined('THINK_PATH')) exit();\r\nreturn array(\r\n";
        //获取数组
		foreach ($data as $key=>$value){
			$key=strtoupper($key);
			if(strtolower($value)=="true" || strtolower($value)=="false" || is_numeric($value))
				$content .= "\t'$key'=>$value, \r\n";
			else
				$content .= "\t'$key'=>'$value',\r\n";
				
			C($key,$value);
		}
		$content .= ");\r\n?>";
		
		//dump($content);
		
      	$r=@chmod($file,0777);
		$hand=file_put_contents($file,$content);
		if (!$hand) $this->error($file.'配置文件写入失败！');
       	$this->success('配置文件保存成功!');
	}
}
?>