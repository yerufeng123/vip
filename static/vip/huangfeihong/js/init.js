// JavaScript Document
$(document).ready(function(e) {
	page._num = $("#page_list .page").length;
	page._height = $("body").height();
	page._width = $("body").width();
	$("#wrap").height(page._height);
	_init();
	
	//滑动组件初始化
	var slide = new Slide("#page_list");
	slide.init();
	slide.degreeX = page._width/3;
	slide.degreeY = page._height/4;
	slide.degree = 10;
	//console.log(slide.degreeX+","+slide.degreeY+","+slide.degree);
	//设置滑动翻页
	$("#page_list").addClass(page.skip)
	//页面跳转
	if(page.skip == "jump"||page.skip == "card"||page.skip =="line"){ 
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
	if(page.skip == "line"){  
		slide.gesture_moving = function(x,y){ 
			page_moving(y);
		}
		$("#page_list").bind("touchend",function(){ 
			page_skip();
		})
	}
	
	$("#drop_down").bind("click",function(){ 
		page_move(-page._dir)
	})
	$("#page10 > .page_body > img").bind("touchstart",function(){ 
		$(".page10_detail").addClass("show").find("li").addClass("show")
	})
	//音乐
	$("#sound").bind("touchstart",function(){
		if($(this).hasClass("off")){
			$(this).removeClass("off");
			_audio();
		}else{
			$(this).addClass("off");
			$(this).css({"-webkit-transform:":"rotate(0deg)"});
			_audioOff();
		}
	})
	//打开音乐
	function _audio(){
		var audio = document.getElementById("audio");
		audio.volume = 0.1;
		audio.play();
	}
	//关闭音乐
	function _audioOff(){
		var audio = document.getElementById("audio");
		audio.pause();
	}
	$("#drop_down").bind("touchmove",function(){ 
		event.preventDefault();
	})
	var _time = setInterval(function(){ 
		if(page._pre){
			var _loading = document.getElementById("loading");
			_loading.style.display = "none";
			var _wrap = document.getElementById("wrap");
			_wrap.style.display = "block";
			_run(1);
			clearInterval(_time);
		}
	},500)
	$("#myvideo").bind("touchstart",function(e){ 
		var that = $(this)[0];
		that.play();
		that.webkitRequestFullScreen();
	})
	$("#myvideo").bind("play",function(){
		_audioOff();
	});
	$("#myvideo").bind("pause",function(){ 
		_audio();
	});
	$("#myvideo").bind("ended",function(){ 
		_audio();
	});
});

function launchFullScreen(element) {  
   var element = document.getElementById("#myvideo");
}  

function _init(){
	//屏幕初始化
	screen_init(".page_body");
	for( var i =0; i < page._num; i ++){
		var _Dom = $("#page_list .page").eq(i).find("[delay]");
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
function page_moving(_y){
	var _top = page._top + _y;
	if(_top > 0||_top < -(page._num-1)*page._height){return;}

	$("#page_list").css({"-webkit-transform":"translate3d(0,"+(page._top + _y)+"px,0)","-webkit-transition-duration":"0"})
}
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
		case "jump":page_skip(); break;
		case "line":page_skip(); break;
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

function page_skip(){ 
	page._top = page._dir * page._index*page._height;
	$("#page_list").css({"-webkit-transform":"translate3d(0,"+(page._top)+"px,0)","-webkit-transition-duration":".3s"})

}