'use strict';
var page = {
			_width 	:0,			//页面宽度
			_height	:0,			//页面高度
			_delay	:0,			//页面切换停留时间
			_last	:300,		//页面切换持续时间
			_zoom 	:1,			//页面适配缩放比
			_index	:0, 		//当前显示第几个页面
			_num 	:0,   		//页面个数
			sign 	:true,		//页面跳转标识
			tabsign	:true,
			_top 	:0,			//滚动元素到页面顶上的距离
			_temp 	:0,			//临时缓存区
			_list	:[],		//页面动画动画元素
			_static	:[],		//资源列表
			_lazy	:[],		//懒加载列表
			};
$(document).ready(function(e) {
	
	document.addEventListener('touchmove', function (e) {e.preventDefault();},false);
	//$("#wrap").show();
	page._num = $("[scene]").length;
	page._height = $("body").height();
	page._width = $("body").width();
	$("#page_list").addClass(h5.skip).height(page._height);
	$("#page_list").css({"-webkit-transform":"translateY(0px) translateZ(0)"});
	$('#music').on('click',function(){ 
		if($(this).hasClass('on')){
			_audioOff()
			$(this).removeClass('on');
		}else{
			_audioon()
			$(this).addClass('on');
		}
	})
	init();
	$('.p5_p').on('click',function(){
		var _src = $(this)[0].src;
		$(".dia")[0].src = _src;
		$('.mask').show();
	})
	$('.mask').on('click',function(){
		$(this).hide()
	})
	
	//下一页跳转
	$("#drop_down").bind("click",function(){ 
		page_move(1);
	})
	$(window).resize(function(){ 
		page._height = $("body").height();
		page._width = $("body").width();
		$("#page_list").height(page._height);
	})
	var slide = new Slide("#page_list");
	slide.SlideY = function(dir){
		if(page._index === 2){
			var _index = $('.p3_li.select').index();
			if(_index==0&&dir==-1){
				page_move(dir);
			}else if(_index==6&&dir==1){
				page_move(dir);
			}else{
				tab_move(dir);
			}
		}else if(dir) page_move(dir);
	}
	slide.SlideX = function(dir){
		if(page._index !== 2) return
		if(dir) tab_move(dir);
	}
	//运行动画
	var timer = setInterval(function(){
		if(h5.preload){
			$('#preload').hide();
			//page_move(1);
			clearInterval(timer);
			
		}	
	},500)
});

//初始化
function init(){
	for( var i =0; i < page._num; i ++){
		//动画
		var scene= $("[scene]").eq(i);
		var _Dom = scene.find("[delay]");
		var _Num = _Dom.length;
		var _Top = scene.offset().top;
		var _stop = scene.attr("stop-move")||0;//记录页面移动的状态
		page._list.push({"_dom":_Dom,"_num":_Num,"_top":-_Top,"_stop":_stop,});
		//图片
		_Dom = scene.find("[lazy-src]");
		_Num = scene.find("[lazy-src]").length;
		page._lazy.push({"_dom":_Dom,"_num":_Num});
	}
}
//tab切换
function tab_move(dir){
	if(!page.tabsign) {
		return
	}else{
		page.tabsign = false;
	}
	var _index = $('.p3_li.select').index();
	$('.p3_li').removeClass('select');
	$('.p3_li').find('.active').removeClass('active');
	var length = $('.p3_li').length;
	_index= (_index - 0 + dir + length)%length;
	$('.p3_li').eq(_index).addClass('select');
	console.log(_index)
	var left = (_index+1)*12.5 + "%"
	$('#p3 .point').css('left',left)
	setTimeout(function(){
		$('.p3_li').eq(_index).find('.p3_p').addClass('active');
	},200)
	setTimeout(function(){
		$('.p3_li').eq(_index).find('.p3_i').addClass('active');
		page.tabsign = true;
	},2700)

}
//页面移动
function page_move(_index){ 
	//是否正在处于动画中
	if(!page.sign){return false;}
	//页面阻止移动
	var _stop = page._list[page._index]._stop;
	if(_stop==_index){return false;}
	page.sign = false;
	_index = page._index+_index
	page._index = _index
	if($("#drop_down").length){
		if(_index<0||_index>=page._num) {page.sign = true;return false};
		page._index = _index
		var moveSign = page._list[_index]._stop||0;
		if( moveSign == 1){ 
			$("#drop_down").hide();
		}else if(_stop == 1){ 
			$("#drop_down").show();
		}
	}
	//是否移除原来动画结果
	if(h5.clear){ 
		$(".active").removeClass("active");	
	}
	//懒加载
	setTimeout(function(){$(".page").removeClass('show').eq(_index).addClass("show");}, page._delay);
	setTimeout(function(){page.sign = true;}, page._delay+page._last);
	ani_run(_index);
}
//页面跳转
function page_skip(){ 
	page._top = page._list[page._index]._top;
	$("#page_list").css({"-webkit-transform":"translate(0,"+(page._top)+"px) translateZ(0)","-webkit-transition-duration":page._last+"ms"});
}
//页面正在移动
function page_moving(_dom,_x,_y){
	page._temp = page._top + _y;
	if(page._temp > 0){page._temp = 0};
	if(page._temp < -(page._num-1)*page._height){page._temp = -(page._num-1)*page._height};
	$(_dom).css({"-webkit-transform":"translate(0,"+(page._temp)+"px) translateZ(0)","-webkit-transition-duration":"0"});
}
//动画运行
function ani_run(_index){
	var _list = page._list[_index];
	var _t = 0;
	var _d = null;
	for(var i = 0; i < _list._num; i++){
		_d = $(_list._dom[i]);
		_t = $(_d).attr("delay");
		var c = function(_DOM,_TIME){
			setTimeout(function(){
				$(_DOM).addClass("active");
			},_TIME);
		}(_d,_t)
	}
} 
//懒加载
function lazy_load(_index){ 
}
//打开音乐
function _audioon(){
	var audio = document.getElementById("audio");
	audio.play();
	}
//打开音乐
function _audioOff(){
	var audio = document.getElementById("audio");
	audio.pause();
	}