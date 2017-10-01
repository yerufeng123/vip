/*此文档仅用于对IE和FF都支持的DOM操作的函数参考*/
window.onload=function(){
					if(typeof Node == "undefined"){
					//IE不支持node，所以要先给IE创建node对象，才能使用一下方法
						window.Node={
							ELEMENT_NODE:1,
							ATTRIBUTE_NODE:2,
							TEXT_NODE:3,
							CDATA_SECTION_NODE:4,
							ENTITY_REFERENCE_NODE:5,
							ENTITY_NODE:6,
							PROCESSING_INSTRUCTION_NODE:7,
							COMMENT_NODE:8,
							DOCUMENT_NODE:9,
							DOCUMENT_TYPE_NODE:10,
							DOCUMENT_FRAGMENT_NODE:11,
							NOTATION_NODE:12,
							DOCUMENT_POSITION_DISCONNECTED:1,
							DOCUMENT_POSITION_PRECEDING:2,
							DOCUMENT_POSITION_FOLLOWING:4,
							DOCUMENT_POSITION_CONTAINS:8,
							DOCUMENT_POSITION_CONTAINED_BY:16,
							DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC:32
						};
					}
					/**********************************************/
					/*				此处写js调用				  */
					/**********************************************/
					
}

var specialName={//此处可以添加FF和IE有区别的属性值
	//FF   :    IE
	"class":"className",
	"for":"htmlFor"

}


/*
 *通用获得对象函数
 *@id 要获得对象的id 
 *@高祥栋2013-08-26
 *@->Object
 */
function $(id){
	return document.getElementById(id);
}

/*
 *通用循环函数
 *@arr 表示要循环的数组 
 *@fn 表示循环时需要执行的内容
 *@高祥栋2013-08-23
 *@->NULL
 */
 function g_each(arr,fn){
	for(var i=0;i<arr.length;i++){
		fn(arr[i],i);
	}
 }


 /*
 *通用事件函数
 *@evt 事件变量 
 *@高祥栋2013-08-24
 *@->Object
 */
 function g_fixEvt(evt){
	evt=evt || window.event;
	if(!evt.target){//IE
		evt.target=evt.srcElement;
		evt.layerX=evt.offsetX;
		evt.layerY=evt.offsetY;
		evt.pageX=evt.clientX+document.documentElement.scrollLeft;
		evt.pageY=evt.clientY+document.documentElement.scrollTop;
		evt.charCode=("keypress"==evt.type)?evt.keyCode:0;
		evt.eventPhase=2;//IE仅工作在冒泡阶段
		evt.timeStamp=(new Date()).getTime();//仅将其设为当前事件
		if('mouseover'==evt.type)	//鼠标来自哪个元素
			evt.relatedTarget=evt.fromElement;
		else if('mouseout'==evt.type)//鼠标去向哪个元素
			evt.relatedTarget=evt.toElement;
		evt.stopPropagation=function(){//取消冒泡蔓延，阻止当前对象的父级及以上节点执行同事件操作
			evt.cancelBubble=true;
		};
		evt.preventDefault=function(){	//取消时间的默认行为，相当于return false
			evt.returnValue=false;
		};
	}
	return evt;
 }


/*
 *获取节点属性
 *@node节点对象
 *@attrName属性名
 *@高祥栋2013-08-23
 *@->String
 */
function g_getAttr(node,attrName){
	var attr=node.getAttribute(attrName);
	if(attr==null){
		if(attrName in specialName){//判断对象的属性值是否存在可以用 in
			attr=node.getAttribute(specialName[attrName]);
		}
	}
	return attr;
	
}


/*
 *设置节点属性
 *@node节点对象
 *@attrName属性名
 *@attrNewValue
 *@高祥栋2013-08-23
 *@->NULL
 */
function g_setAttr(node,attrName,attrNewValue){
	var attr=node.getAttribute(attrName);
	if(attr==null){
		if(attrName in specialName){//判断对象的属性值是否存在可以用 in
			node.setAttribute(specialName[attrName],attrNewValue);
		}
	}else{
		node.setAttribute(attrName,attrNewValue);
	}
	
}


/*
 *移除节点属性
 *@node节点对象
 *@attrName属性名
 *@高祥栋2013-08-23
 *@->NULL
 */
function g_removeAttr(node,attrName){
	var attr=node.getAttribute(attrName);
	if(attr==null){
		if(attrName in specialName){//判断对象的属性值是否存在可以用 in
			attrName=specialName[attrName];
		}
	}
	node.removeAttribute(attrName);
	
}


/*
 *获取第一个节点(去空白文本节点)
 *@node节点对象
 *@高祥栋2013-08-26
 *@->Object
 */
 function g_firstChild(node){
	if(node.firstChild){
		if(node.firstChild.nodeType==1){
			return node.firstChild;
		}else{
			var n=node.firstChild;
			while(n=n.nextSibling){
				if(n.nodeType==1) return n;
			}
			return null;
		}
	}
	return null;
 }


 /*
 *获取最后一个节点(去空白文本节点)
 *@node节点对象
 *@高祥栋2013-08-26
 *@->Object
 */
 function g_lastChild(node){
	if(node.lastChild){
		if(node.lastChild.nodeType==1){
			return node.lastChild;
		}else{
			var n=node.lastChild;
			while(n=n.previousSibling){
				if(n.nodeType==1) return n;
			}
			return null;
		}
	}
	return null;
 }


/*
 *获取下一个节点(去空白文本节点)
 *@node节点对象
 *@高祥栋2013-08-23
 *@->Object
 */
 function g_nextSibling(node){
	var next=node.nextSibling;
	if(next!=null && next.nodeType=='3' && /^\s+$/.test(next.nodeValue)){
	
		next=next.nextSibling;
	}
	return next;
 }


 /*
 *获取上一个节点(去空白文本节点)
 *@node节点对象
 *@高祥栋2013-08-23
 *@->Object
 */
 function g_previousSibling(node){
	var previous=node.previousSibling;
	if(previous!=null && previous.nodeType=='3' && /^\s+$/.test(previous.nodeValue)){
	
		previous=previous.previousSibling;
	}
	return previous;
 }


 /*
 *在选定节点前插入一个新节点(不用再找其父节点)
 *@newNode插入的节点
 *@oldNode选定的节点
 *@高祥栋2013-08-23
 *@->NULL
 */
 function g_before(newNode,oldNode){
	oldNode.parentNode.insertBefore(newNode,oldNode);
 }


  /*
 *在选定节点后一次性插入多个节点append(oldNode,new1Node,new2Node...)
 *@oldNode选定的节点
 *@new1Node插入的节点1...
 *@高祥栋2013-08-23
 *@->NULL
 */
 function g_append(node){
	if(g_nextSibling(node)==null){//调用了自定义函数g_nextSibling
		for(var i=1;i<arguments.length;i++){
			node.parentNode.appendChild(arguments[i]);
		}
	}else{
		for(var i=arguments.length-1;i>=1;i--){//选中节点不是新插入节点，所以从1开始
			node.parentNode.insertBefore(arguments[i],node.nextSibling);
		}
	}
 }


 /*
 *删除多个选定节点delNode(node1,node2,node3...)
 *@node1删除的节点1...
 *@高祥栋2013-08-23
 *@->NULL
 */
 function g_delNode(node){
//					for(var i=0;i<arguments.length;i++){
//						arguments[i].parentNode.removeChild(arguments[i]);
//					}
	g_each(arguments,function(node){	//调用自定义通用循环函数each()
		node.parentNode.removeChild(node)
	});
 }


 /*
  *给某个对象添加多个事件监听函数
  *@obj对象
  *@evt事件 onclick、onload...
  *@fn函数体
  *@高祥栋2013-08-23
  *@->NULL
  */
  //方法一
  /*function g_addEvent(obj,evt,fn){
	var saved;
	if(typeof obj[evt] == 'function'){
		saved=obj[evt];
	}
	obj[evt]=function(){
		if(saved) saved();
		fn();
	};
  }*/
  //方法二
  function g_addEvent(obj,evt,fn){
		if(obj.addEventListener){//FF优先使用下列方法
			//Opera浏览器既支持addEventListener，又支持offsetX
			obj.addEventListener(evt.substr(2),fn,false);
		}else{//通用添加对象方法，兼容IE和FF
			if(!obj.__functions__) obj.__functions__={};//__变量名__是js定义私有属性的一种写法，防止其他用户覆盖此变量
			if(!obj.__functions__[evt]) obj.__functions__[evt]=[];
			var __functions__=obj.__functions__[evt];
			for(var i=0;i<__functions__.length;i++){//如果要添加事件的对象已经存在该事件及操作，则直接返回该对象，不再添加此事件
				if(__functions__[i]===fn) return obj;
			}
			__functions__.push(fn);
			if(typeof obj[evt]=="function"){	//如果该对象的此事件上已经存在操作，就将此操作也放入数组中，等待循环执行
				if(obj[evt].toString()!=handler.toString()){//不能单纯的判断obj[evt]和handler是否相等，二者代码相同，确实不同的两个函数
					__functions__.push(obj[evt]);
				}
			}
			obj[evt]=handler;
			function handler(){				//循环执行数组中全部函数操作
				var __functions__=this.__functions__[evt];
				for(var i=0;i<__functions__.length;i++){
					if(__functions__[i]) __functions__[i].call(this);
				}	
			};
		}
  }


  /*
  *删除某个对象的事件监听函数
  *@obj对象
  *@evt事件 onclick、onload...
  *@fn函数体
  *@高祥栋2013-08-24
  *@->NULL
  */
  function g_delEvent(obj,evt,fn){
	var fns=obj.__functions__;//检测对象是否存在存储函数的functions数组
	if(fns !=null){
		fns=fns[evt];//检测对象是否存在要删除事件的操作
		if(fns !=null){
			for(var i=0;i<fns.length;i++){
				if(fns[i]==fn){
					delete fns[i];
				}
			}
		}
	 }
   }



   /*
  *为指定select下拉框添加选项
  *@sel 指定的下拉框对象
  *@opt 要添加的选项对象
  *@高祥栋2013-08-29
  *@->Object
  */
   function g_addOpt(sel,opt){
		/*var IE=navigator.userAgent.indexOf("MSIE")>-1;
		if(IE){
			sel.add(opt,index);
		} else {
			sel.add(opt,index===undefined?null:sel.options[index]);
		}
		return sel;*/
		try{//FF
			sel.add(opt,null);
		}catch(e){//IE
			sel.add(opt);
		}
   }
/******************************************************以下为样式函数*************************************************/
   /*
  *判断指定节点中是否存在该类名
  *@node节点对象
  *@className类名
  *@高祥栋2013-08-26
  *@->Boolean
  */
  function g_hasClass(node,className){
	  var names=node.className.split(/\s+/);
	  for(var i=0;i<names.length;i++){
		  if(names[i]==className) return true;
	  }
	  return false;
  }
  
  
  /*
  *给指定的元素增加一个类名
  *@obj对象
  *@className类名
  *@高祥栋2013-08-25
  *@->NULL
  */
  function g_addClass(obj,className){
	obj.className+=" "+className
  }


  /*
  *删除指定元素的一个类名
  *@obj对象
  *@className类名
  *@高祥栋2013-08-25
  *@->Object
  */
  function g_delClass(obj,className){
	var s=obj.className.split(/\s+/);
	for(var i=0;i<s.length;i++){
		if(s[i]==className){
			delete s[i];
		}
		obj.className=s.join(" ");
	}
	return obj;
  }


  /*
  *按类名获取对象数组
  *@className类名
  *@conttext搜索区域对象，默认为document,可写document.body
  *@高祥栋2013-08-25
  *@->Array
  */
  function g_getByClass(className,context){
	  context=context || document;
	  if(context.getElementsByClassName){
	 	 return context.getElementsByClassName(className);
	  }
	  var nodes=context.getElementsByTagName('*');
	  ret=[];
	  for(var i=0;i<nodes.length;i++){
	 	 if(g_hasClass(nodes[i],className)) ret.push(nodes[i]);
	  }
	  return ret;
  }


   /*
  *获取指定对象的某个样式属性的真实值
  *@obj对象
  *@s样式属性如'width','height'
  *@高祥栋2013-08-25
  *@->String
  */
  function g_getRealStyle(obj,s){
	var style;
	if(window.getComputedStyle){//W3C
		style=window.getComputedStyle(obj,null);
	}else if(obj.currentStyle){//IE
		style=obj.currentStyle;
	}
	return style[s];
  }


   /*
  *获取指定样式表的全部CSS规则
  *@i 指定样式表所属下标
  *@高祥栋2013-08-25
  *@->Array
  */
  function g_getRules(i){
	  var s=document.styleSheets[i];
	  return s.cssRules ||s.rules;
  }
  

  /*
  *向指定样式表中添加一个CSS规则
  *@sheet样式表如 document.styleSheets[0]
  *@selector 选择器名如 '.div'
  *@cssText 样式内容 如'color:red;font-weight:bold;'
  *@i
  *@高祥栋2013-08-25
  *@->NULL
  */
  function g_addRule(sheet,selector,cssText,i){
	  if(sheet.insertRule){//W3C
		  sheet.insertRule(selector+"{"+cssText+"}",i);
	  }else if(sheet.addRule){//IE
		  sheet.addRule(selector,cssText,i);
	  }
  }


  /*
  *删除指定样式表中的一个CSS规则
  *@sheet样式表如 document.styleSheets[0]
  *@index 要删除规则的下标
  *@高祥栋2013-08-25
  *@->NULL
  */
  function g_delRule(sheet,index){
	  if(sheet.deleteRule){
		  sheet.deleteRule(index);
	  } else{
		  sheet.removeRule(index);
	  }
  }
  /******************************************************以下为定位函数*************************************************/
   /*
  *获取当前窗体可视部分的大小
  *@高祥栋2013-08-25
  *@->Object
  */
  function g_innerSize(){
	//FF的innerWidth和innerHeight抛弃
	  return {//return后紧跟‘{’号
		  width:document.documentElement.clientWidth,
	   	  height:document.documentElement.clientHeight
	  };
  }
/*************************************以下为COOKIE函数(仅支持IE和FF，360、搜狗、Opera均不支持)***************************/
  /*
  *获得cookie
  *@cookieName 要取得的cookie的名
  *@高祥栋2013-08-25
  *@->String
  */
  function g_getCookie(cookieName){
		var cookies=document.cookie.split('; ');
		for(var i=0,c;i<cookies.length;i++){
			c=cookies[i].split('=');
			if(cookieName==c[0])return decodeURIComponent(c[1]);
		}
		return '';
  }


  /*
  *设置cookie
  *@cookieName 要设置的cookie的名
  *@value 要设置的cookie的值
  *@expires cookie过期时间
  *@path cookie访问路径
  *@domain cookie访问的子域名
  *@secure 是否仅支持http访问
  *@高祥栋2013-08-25
  *@->NULL
  */
  function g_setCookie(cookieName,value,expires,path,domain,secure){
		var str=cookieName+"="+encodeURIComponent(value);//不要忘了在对应的getCookie函数里面加上deCodeURIComponent方法
		if(expires){
			str+=";expires="+expires.toGMTString();
		}
		if(path){
			str+=";path="+path;
		}
		if(domain){
			str+=';domain='+domain;
		}
		if(secure){
			str+=";secure";
		}
		document.cookie=str;
  }


  /*
  *删除cookie
  *@cookieName 要删除的cookie的名
  *@高祥栋2013-08-25
  **@->NULL
  */
  function g_delCookie(cookieName){
		var expires=new Date();
		expires.setTime(expires.getTime()-1);//将expires设为一个过去的日期，浏览器会自动删除它
		document.cookie=cookieName+"=;expires="+expires.toGMTString();
  }

/******************************************************以下为特效函数(不单独命名)*************************************************/
 /*
  *渐入函数
  *@O对象
  *@start开始 从哪里开始
  *@alert步长 每次变化量
  *@dur 定时 多少秒改变一次
  *@fx 函数  每次改变执行那个函数
  *@高祥栋2013-08-27
  **@->NULL
  */
 function animate(o,start,alter,dur,fx){
	var curTime=0;
	var t=setInterval(function(){
		if(curTime>=dur) clearInterval(t);
		for(var i in start){
			o.style[i]=fx(start[i],alter[i],curTime,dur)+"px";
		}
		curTime+=50;
	},50);
	return function(){
		clearInterval(t);
	};
 }
 
 /*
  *透明度动态设置
  *@O对象
  *@start开始 从哪里开始
  *@alert步长 每次变化量
  *@dur 定时 多少秒改变一次
  *@fx 函数  每次改变执行那个函数
  *@高祥栋2013-08-27
  **@->NULL
  */

function opacityAnimate(o,start,alter,dur,fx) {

	var curTime=0;

	var t=setInterval(function () {

	if (curTime>=dur) clearTimeout(t);

		setOpacity(o,fx(start,alter,curTime,dur));

		curTime+=50;

	},50);

}


  /*
  *设置透明度的兼容函数
  *@O对象
  *@start开始 从哪里开始
  *@alert步长 每次变化量
  *@dur 定时 多少秒改变一次
  *@fx 函数  每次改变执行那个函数
  *@高祥栋2013-08-27
  **@->NULL
  */

var setOpacity = (document.documentElement.filters)?function (obj,val) {

	obj.style.filter = "alpha(opacity="+val+")";

	}:function (obj,val) {

	obj.style.opacity = val/100+"";

};

//以下就是变换函数

/*最简单的线性变化,即匀速运动*/

function Linear(start,alter,curTime,dur) {

	return start+curTime/dur*alter;

}

/*二次方缓动*/

function QuadSR(start,alter,curTime,dur) {//慢->快

	return start+Math.pow(curTime/dur,2)*alter;

}

function QuadRS(start,alter,curTime,dur) {//快->慢

	var progress =curTime/dur;

	return start-(Math.pow(progress,2)-2*progress)*alter;

}

function QuadSRS(start,alter,curTime,dur) {//慢->快->慢

	var progress =curTime/dur*2;

	return (progress<1?Math.pow(progress,2):-((--progress)*(progress-2) - 1))*alter/2+start;

}

/*三次方缓动*/

function CubicSR(start,alter,curTime,dur) {//慢->快

	return start+Math.pow(curTime/dur,3)*alter;

}

function CubicRS(start,alter,curTime,dur) {//快->慢

	var progress =curTime/dur*2;

	return (progress<1?Math.pow(progress,3):((progress-=2)*Math.pow(progress,2) + 2))*alter/2+start;

}

function CubicSRSBSR(start,alter,curTime,dur) {

	//慢->快->慢->回头->慢->快

	//此函数 使用时start的left与alter的left最好相同 例如都设置成8200如果上下移动那么top也应该相同

	var progress =curTime/dur;

	return start-(Math.pow(progress,3)-Math.pow(progress,2)+1)*alter;

}

/*四次方缓动*/

function QuartSR(start,alter,curTime,dur) {//慢->快

	return start+Math.pow(curTime/dur,4)*alter;

}

function Quart(start,alter,curTime,dur) {

	var progress =curTime/dur;

	return start-(Math.pow(progress,4)-Math.pow(progress,3)-1)*alter;

}

function Sine(start,alter,curTime,dur){

	if ((curTime/=dur) < (1/2.75)) {

		return alter*(7.5625*Math.pow(curTime,2))+start;

	} else if (curTime < (2/2.75)) {

		return alter*(7.5625*(curTime-=(1.5/2.75))*curTime + .75)+start;

	} else if (curTime< (2.5/2.75)) {

		return alter*(7.5625*(curTime-=(2.25/2.75))*curTime + .9375)+start;

	} else {

		return alter*(7.5625*(curTime-=(2.625/2.75))*curTime + .984375)+start;

	}

}


/******************************************************以下为常用函数*************************************************/
  /*
  *添加到收藏夹
  *@sURL收藏链接
  *@sTitle收藏题目
  *@高祥栋2013-08-26
  *@->NULL
  */
  function g_addFavorite(sURL, sTitle) {
 
            sURL = encodeURI(sURL); 
        try{   
 
            window.external.addFavorite(sURL, sTitle);   
 
        }catch(e) {   
 
            try{   
 
                window.sidebar.addPanel(sTitle, sURL, "");   
 
            }catch (e) {   
 
                alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
 
            }   
 
        }
 
    }




 /*
  *文本原样输出到页面上，阻止页面自动转义输入的特殊字符
  *@html 输入的内容
  *@高祥栋2013-09-03
  *@->String
  */
	function g_htmlEncode(html){
		arguments.callee.textNode.nodeValue=html;
		return arguments.callee.div.innerHTML;
	}
	g_htmlEncode.div=document.createElement("div");
	g_htmlEncode.textNode=document.createTextNode("");
	g_htmlEncode.div.appendChild(g_htmlEncode.textNode);


/******************************************************以下为时间函数*************************************************/
	/*
  *模仿php date函数格式化日期
  *@s想要的日期效果，用Y、m、d、H、i、s表示如：Y-m-d H:i:s   Y年m月d日 H时i分s秒
  *@t 时间戳，不填默认为当前时间戳
  *@高祥栋2013-09-03
  *@->String
  */
	function g_date(s,t){
		t=t || new Date();
		var re=/Y|m|d|H|i|s/g;
		return s.replace(re,function($1){
			switch($1){
				case "Y":return t.getFullYear();
				case "m":return t.getMonth()+1;
				case "d":return t.getDate();
				case "H":return t.getHours();
				case "i":return t.getMinutes();
				case "s":return t.getSeconds();
			}
			return $1;
		});
		
	}



  /*
  *检测年份是否是闰年
  *@y被检测年份
  *@高祥栋2013-08-29
  *@->Object
  */
	function g_isOverYear(y){
		return (y%4==0 && y%100!=0) || y%400==0;
	}

	
	
  /*
  *初始化下拉框（年月日初始化）
  *@select 下拉框对象
  *@start 下拉框开始数字
  *@end下拉框结束数字
  *@高祥栋2013-08-29
  *@->Null
  */
	function g_initSelect(select,start,end){
		select.options.length=1;
		for(var i=start;i<=end;i++){
			var op=new Option(i);
			g_addOpt(select,op,i);
		}
	}





/******************************************************以下为待测试函数*************************************************/
//屏蔽右键菜单
document.oncontextmenu = function (event){
	if(window.event){
		event = window.event;
	}try{
		var the = event.srcElement;
		if (!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
			return false;
		}
		return true;
	}catch (e){
		return false; 
	} 
}

//屏蔽粘贴
document.onpaste = function (event){
	if(window.event){
		event = window.event;
	}try{
		var the = event.srcElement;
		if (!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
			return false;
		}
		return true;
	}catch (e){
		return false;
	}
}

//屏蔽复制
document.oncopy = function (event){
	if(window.event){
		event = window.event;
	}try{
		var the = event.srcElement;
		if(!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
			return false;
		}
		return true;
	}catch (e){
		return false;
	}
}

//屏蔽剪切
document.oncut = function (event){
	if(window.event){
		event = window.event;
	}try{
		var the = event.srcElement;
		if(!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
			return false;
		}
		return true;
	}catch (e){
		return false;
	}
}

//屏蔽选中
document.onselectstart = function (event){
	if(window.event){
		event = window.event;
	}try{
		var the = event.srcElement;
		if (!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
			return false;
		}
		return true;
	} catch (e) {
		return false;
	}
}







