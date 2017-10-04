'use strict';
var page = {
			_width 	:0,			
			_height	:0,			
			_delay	:0,			
			_last	:300,		
			_zoom 	:1,			
			_index	:0, 		
			_num 	:0,   		
			sign 	:true,		
			_top 	:0,			
			_temp 	:0,			
			_list	:[],		
			_static	:[],		
			_lazy	:[],
			};
$(document).ready(function(e) {
	document.addEventListener('touchmove', function (e) {e.preventDefault();},false);
	page._num = $("[scene]").length;
	page._height = $("body").height();
	page._width = $("body").width();
	$("#page_list").addClass(h5.skip).height(page._height);
	init();
	//初始化组件
	var slide = new Slide("#page_list");
	//页面跳转
	slide.swipe = function(x_dir,y_dir,points){
		if(points > 1|| h5.sign){return false;}
		if(y_dir) page_move(y_dir);
	}
	$("#page_list").bind("touchend",function(){page_skip();});
	//页面操作
	slide.moving = function(x,y,points,rotate,longe){
		if(points >1 && h5.sign == false){ 
			h5.sign = true;
			$("#drop_down").hide();
		}
		//页面移动
		if(!h5.sign){ 
			page_moving("[stage]",x,y);
		 	return false; 
		 }
		 //页面缩放
		if(points > 1){ 
			h5.maskZ = h5.z*longe;
			if(h5.maskZ > 350){h5.maskZ = 350;}
			$(".photo").eq(page._index).css({"background-size":h5.maskZ+"% auto","-webkit-transition":"background-size 0s"});
		}else{ 
			x=x/3.20;
			y=y/3.20;
			h5.maskX = h5.x - x;
			h5.maskY = h5.y - y;
			if(h5.maskX > 100 && x <0){h5.maskX =100;}
			if(h5.maskX < 0 && x >0){h5.maskX =0;}
			if(h5.maskY > 100){h5.maskY =100;}
			if(h5.maskY < 0){h5.maskY =0;}
			$(".photo").eq(page._index).css({"background-position":h5.maskX+"% "+h5.maskY+"%"});
		}
	}
	//双击页面
	slide.tap = function(sign,points){
		if(!sign){ return false;} 
		h5.sign = false;
		$(".photo").eq(page._index).removeAttr("style");
		h5.x = h5.y = h5.maskX = h5.maskY = 50;
		h5.z = h5.maskZ =100;
		if(page._index !=(page._num -1)){ 
			$("#drop_down").show();
		}
	}
	$("#drop_down").bind("click",function(){ 
		page_move(1);
	})
	$(window).resize(function(){ 
		page._height = $("body").height();
		page._width = $("body").width();
	})
	$(".photo").bind("touchend",function(e){ 
		if(e.touches.length){return false;}
		h5.x = h5.maskX;
		h5.y = h5.maskY;
		h5.z = h5.maskZ;
		if(h5.z < 100){ 
			$(".photo").eq(page._index).css({"background-size":"100% auto",
							"-webkit-transition":"background-size .1s"});
			h5.z =100;
		}
		if(h5.z > 300){ 
			$(".photo").eq(page._index).css({"background-size":"300% auto",
							"-webkit-transition":"background-size .1s"});
			h5.z =300;
		}
	})
});
function init(){
	for( var i =0; i < page._num; i ++){
		var scene= $("[scene]").eq(i);
		var _Dom = scene.find("[delay]");
		var _Num = _Dom.length;
		var _Top = scene.offset().top;
		var _stop = scene.attr("stop-move")||0;
		page._list.push({"_dom":_Dom,"_num":_Num,"_top":-_Top,"_stop":_stop,});
		_Dom = scene.find("[lazy-src]");
		_Num = scene.find("[lazy-src]").length;
		page._lazy.push({"_dom":_Dom,"_num":_Num});
	}
	$("#page_list").css({"-webkit-transform":"translateY(0px) translateZ(0)"});
}
//页面移动
function page_move(_index){ 
	if(!page.sign){return false;}
	var _stop = page._list[page._index]._stop;
	if(_stop==_index){return false;}
	page.sign = false;
	page._index +=_index;
	if($("#drop_down").length){
		if(page._list[page._index]._stop == 1){ 
			$("#drop_down").hide();
		}else if(_stop == 1){ 
			$("#drop_down").show();
		}
	}
	$(".page").removeClass('show').eq(page._index).addClass("show");
	setTimeout(function(){page.sign = true;}, page._delay+page._last);
}
//页面切换
function page_skip(){ 
	page._top = page._list[page._index]._top;
	$("#page_list").css({"-webkit-transform":"translate(0,"+(page._top)+"px) translateZ(0)","-webkit-transition-duration":page._last+"ms"});
}
//页面跳转
function page_moving(_dom,_x,_y){
	page._temp = page._top + _y;
	if(page._temp > 0){page._temp = 0};
	if(page._temp < -(page._num-1)*page._height){page._temp = -(page._num-1)*page._height};
	$(_dom).css({"-webkit-transform":"translate(0,"+(page._temp)+"px) translateZ(0)","-webkit-transition-duration":"0"});
}
//获取背景图片的URL地址
function getBgImg(_dom){ 
	var ret = $(_dom).css('background-image');
	var re = /url\((.*?)\)/;
	var match = re.exec(ret);
	return match[1];
}