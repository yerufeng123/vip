// JavaScript Document
$(document).ready(function(e) {
	page._num = $("#page_list .page").length;
	page._height = $("body").height();
	page._width = $("body").width();
	_init();
	//滑动组件初始化
	var slide = new Slide("#page_list");
	slide.init();
	//设置滑动翻页
	$("#page_list").addClass(page.skip)
	if(page.skip == "jump"||page.skip == "card"){ 
		slide.gesture_top = function(){ 
		page_move(-page._dir);
		}
		slide.gesture_bottom = function(){ 
			page_move(page._dir);
		}
	}else{ 
		slide.gesture_left = function(){ 
		page_move(-page._dir);
		}
		slide.gesture_right = function(){ 
			page_move(page._dir);
		}

	}
	$("#drop_down").bind("click",function(){ 
		page_move(-page._dir)
	})
	//阻止页面滑动
	window.addEventListener("touchmove", function(){ 
		event.preventDefault();
	})
	_run(1);
});

function _init(){
	//屏幕初始化
	screen_init(".page_body");
	for( var i =0; i < page._num; i ++){
		var _Dom = $("#page_list .page").eq(i).find("[delay]");//
		var _Num = $("#page_list .page").eq(i).find("[delay]").length;
		page_list.push({"_dom":_Dom,"_num":_Num})
	}
	var img_num = $("[data-src]").length||1;
}
//图片初始化
function image_load(){ 
	$("[data-src]").each(function(index,element){ 
		var _src = $(this).attr("data-src");
		this.src = _src;
	})
	
}
//进行页面的缩放
function screen_init( _dom ){ 
	var dom_height = $(_dom).height();
	var dom_width = $(_dom).width();
	if( (page._height/dom_height) < (page._width/dom_width)){
		page.zoom = page._height/dom_height;
	}else{
		page.zoom = page._width/dom_width;
	}
	$(_dom).css("transform","scale("+page.zoom+")");
}

//动画运行
function _run(_index){
	var animation_list = page_list[_index-1];
	var _time = 0;
	var _dom = null
	for(var i = 0; i < animation_list._num; i++){
		_time = $(animation_list._dom).eq(i).attr("delay");
		_dom = $(animation_list._dom).eq(i);
		var c = function(_DOM,_TIME){
			setTimeout(function(){
				$(_DOM).addClass("show");
			},_TIME);
		}(_dom,_time)
	}
}
//页面正在移动
function page_moving(){}
//页面移动
function page_move(_index){ 
	//是否正在处于动画中
	if(!page.sign){return}
	page.sign = false;
	page._index +=_index;
	if (page._index < 0) {
		page._index = 0;
		page.sign = true;
		return;
	}
	if(page._index >= page._num){ 
		page._index -=_index;
		page.sign = true;
		return;
	}
	//跳转动画
	switch(page.skip){ 
		case "jump":$("#page_list").css({"-webkit-transform":"translateY("+(page._dir * page._index*page._height)+"px)"}); break;
	}
	
	if(page._index == (page._num -1)){ 
		$("#drop_down").hide();
	}else{ 
		$("#drop_down").show();
	}
	//是否移除原来动画结果
	if(page.clear){ 
		$(".show").removeClass("show");
	}
	$(".page").removeClass('show').eq(page._index).addClass("show");
	setTimeout(function(){page.sign = true;},1500);
	setTimeout(function(){_run(page._index+1);},500);
}