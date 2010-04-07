
function $(id)
{
return document.getElementById(id);
}
function copyIdText(id)
{
  copy( $(id).innerText,$(id) );
}
function copyIdHtml(id)
{
  copy( $(id).innerHTML,$(id) );
}
function copy(txt,obj)
{       
   if(window.clipboardData) 
   {        
        window.clipboardData.clearData();        
        window.clipboardData.setData("Text", txt);
        alert("复制成功！")
        if(obj.style.display != 'none'){
   var rng = document.body.createTextRange();
   rng.moveToElementText(obj);
   rng.scrollIntoView();
   rng.select();
   rng.collapse(false);  
       }
   }
   else
    alert("请选中文本 , 使用 Ctrl + C 复制！");
}

