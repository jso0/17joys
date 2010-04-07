<!--
//xmlhttp和xmldom对象
var XHTTP = null;
var XDOM = null;
var Container = null;
var ShowError = false;
var ShowWait = false;
var ErrCon = "";
var ErrDisplay = "下载数据失败";
var WaitDisplay = "正在下载数据...";

//获取指定ID的元素
//function $(eid){
//	return document.getElementById(eid);
//}

function $DE(id) {
	return document.getElementById(id);
}

//gcontainer 是保存下载完成的内容的容器
//mShowError 是否提示错误信息
//ShowWait 是否提示等待信息
//mErrCon 服务器返回什么字符串视为错误
//mErrDisplay 发生错误时显示的信息
//mWaitDisplay 等待时提示信息
//默认调用 Ajax('divid',false,false,'','','')

function Ajax(gcontainer,mShowError,mShowWait,mErrCon,mErrDisplay,mWaitDisplay){

Container = gcontainer;
ShowError = mShowError;
ShowWait = mShowWait;
if(mErrCon!="") ErrCon = mErrCon;
if(mErrDisplay!="") ErrDisplay = mErrDisplay;
if(mErrDisplay=="x") ErrDisplay = "";
if(mWaitDisplay!="") WaitDisplay = mWaitDisplay;


//post或get发送数据的键值对
this.keys = Array();
this.values = Array();
this.keyCount = -1;

//http请求头
this.rkeys = Array();
this.rvalues = Array();
this.rkeyCount = -1;

//请求头类型
this.rtype = 'text';

//初始化xmlhttp
if(window.ActiveXObject){//IE6、IE5
   try { XHTTP = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) { }
   if (XHTTP == null) try { XHTTP = new ActiveXObject("Microsoft.XMLHTTP");} catch (e) { }
}
else{
	 XHTTP = new XMLHttpRequest();
}

//增加一个POST或GET键值对
this.AddKey = function(skey,svalue){
	this.keyCount++;
	this.keys[this.keyCount] = skey;
	svalue = svalue.replace(/\+/g,'$#$');
	this.values[this.keyCount] = escape(svalue);
};

//增加一个Http请求头键值对
this.AddHead = function(skey,svalue){
	this.rkeyCount++;
	this.rkeys[this.rkeyCount] = skey;
	this.rvalues[this.rkeyCount] = svalue;
};

//清除当前对象的哈希表参数
this.ClearSet = function(){
	this.keyCount = -1;
	this.keys = Array();
	this.values = Array();
	this.rkeyCount = -1;
	this.rkeys = Array();
	this.rvalues = Array();
};


XHTTP.onreadystatechange = function(){
	//在IE6中不管阻断或异步模式都会执行这个事件的
	if(XHTTP.readyState == 4){
    if(XHTTP.status == 200){
       if(XHTTP.responseText!=ErrCon){
         Container.innerHTML = XHTTP.responseText;
       }else{
       	 if(ShowError) Container.innerHTML = ErrDisplay;
       }
       XHTTP = null;
    }else{ if(ShowError) Container.innerHTML = ErrDisplay; }
  }else{ if(ShowWait) Container.innerHTML = WaitDisplay; }
};

//检测阻断模式的状态
this.BarrageStat = function(){
	if(XHTTP==null) return;
	if(typeof(XHTTP.status)!=undefined && XHTTP.status == 200)
  {
     if(XHTTP.responseText!=ErrCon){
         Container.innerHTML = XHTTP.responseText;
     }else{
       	if(ShowError) Container.innerHTML = ErrDisplay;
     }
  }
};

//发送http请求头
this.SendHead = function(){
	if(this.rkeyCount!=-1){ //发送用户自行设定的请求头
  	for(;i<=this.rkeyCount;i++){
  		XHTTP.setRequestHeader(this.rkeys[i],this.rvalues[i]); 
  	}
  }
　if(this.rtype=='binary'){
  	XHTTP.setRequestHeader("Content-Type","multipart/form-data");
  }else{
  	XHTTP.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  }
};

//用Post方式发送数据
this.SendPost = function(purl){
	var pdata = "";
	var i=0;
	this.state = 0;
	XHTTP.open("POST", purl, true); 
	this.SendHead();
  if(this.keyCount!=-1){ //post数据
  	for(;i<=this.keyCount;i++){
  		if(pdata=="") pdata = this.keys[i]+'='+this.values[i];
  		else pdata += "&"+this.keys[i]+'='+this.values[i];
  	}
  }
  XHTTP.send(pdata);
};

//用GET方式发送数据
this.SendGet = function(purl){
	var gkey = "";
	var i=0;
	this.state = 0;
	if(this.keyCount!=-1){ //get参数
  	for(;i<=this.keyCount;i++){
  		if(gkey=="") gkey = this.keys[i]+'='+this.values[i];
  		else gkey += "&"+this.keys[i]+'='+this.values[i];
  	}
  	if(purl.indexOf('?')==-1) purl = purl + '?' + gkey;
  	else  purl = purl + '&' + gkey;
  }
	XHTTP.open("GET", purl, true); 
	this.SendHead();
  XHTTP.send(null);
};

//用GET方式发送数据，阻塞模式
this.SendGet2 = function(purl){
	var gkey = "";
	var i=0;
	this.state = 0;
	if(this.keyCount!=-1){ //get参数
  	for(;i<=this.keyCount;i++){
  		if(gkey=="") gkey = this.keys[i]+'='+this.values[i];
  		else gkey += "&"+this.keys[i]+'='+this.values[i];
  	}
  	if(purl.indexOf('?')==-1) purl = purl + '?' + gkey;
  	else  purl = purl + '&' + gkey;
  }
	XHTTP.open("GET", purl, false); 
	this.SendHead();
  XHTTP.send(null);
  //firefox中直接检测XHTTP状态
  this.BarrageStat();
};

//用Post方式发送数据
this.SendPost2 = function(purl){
	var pdata = "";
	var i=0;
	this.state = 0;
	XHTTP.open("POST", purl, false); 
	this.SendHead();
  if(this.keyCount!=-1){ //post数据
  	for(;i<=this.keyCount;i++){
  		if(pdata=="") pdata = this.keys[i]+'='+this.values[i];
  		else pdata += "&"+this.keys[i]+'='+this.values[i];
  	}
  }
  XHTTP.send(pdata);
  //firefox中直接检测XHTTP状态
  this.BarrageStat();
};


} // End Class Ajax

//初始化xmldom
function InitXDom(){
  if(XDOM!=null) return;
  var obj = null;
  if (typeof(DOMParser) != "undefined") { // Gecko、Mozilla、Firefox
    var parser = new DOMParser();
    obj = parser.parseFromString(xmlText, "text/xml");
  } else { // IE
    try { obj = new ActiveXObject("MSXML2.DOMDocument");} catch (e) { }
    if (obj == null) try { obj = new ActiveXObject("Microsoft.XMLDOM"); } catch (e) { }
  }
  XDOM = obj;
};

-->
