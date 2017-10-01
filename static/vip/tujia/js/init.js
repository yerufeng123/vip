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
			_top 	:0,			//滚动元素到页面顶上的距离
			_temp 	:0,			//临时缓存区
			_list	:[],		//页面动画动画元素
			_static	:[],		//资源列表
			_lazy	:[],		//懒加载列表
			mask_tit:[
				'白洋淀：途家美芦庄园豪华三卧园景温泉别墅<br/>（220平米，宜住6人）',
				'上海：菲尼克斯庄园星空别墅 <br/>（170平米，宜住2人）',
				'千岛湖：途家翡翠岛豪华四居室别墅<br/>（413平米，宜住8人）',
				'厦门：途家大云房车豪华庭院房<br/>（158平米，宜住2人）',
				'清远：九州驿站天门沟树屋村农庄别墅<br/>（12平米，宜住2人）',
				'三亚：途家亚龙湾独栋迷你别墅<br/>（80平米，宜住2人）',
				'青城山：途家青城郡三卧豪华度假别墅<br/>（158平米，宜住6人）',
			]
			};
			
	
	
$(document).ready(function(e) {
	//图片滚动效果
	var box1 = new Slide(".cont");
	box1.init();
	box1.SlideX = function(_dir){play(_dir)};
	
	$( ".cont .left_btn" ).bind("touchstart", function (){
		play(-1);
	});
	$( ".cont .right_btn" ).bind("touchstart", function (){
		play(1);
	});
	
	
	document.addEventListener('touchmove', function (e) {e.preventDefault();},false);
	page._num = $("[scene]").length;
	page._height = $("body").height();
	page._width = $("body").width();
	$("#page_list").addClass(h5.skip);
	$("#page_list").css({"-webkit-transform":"translateY(0px) translateZ(0)"});
	//加载背景音乐
	if(h5.bg_audio){ 
		var _audio = document.createElement("audio");
		_audio.loop = 'loop';
		_audio.src = h5.address + h5.bg_audio;
		h5.bg_audio = _audio;
	}
	init();
	//滑动组件初始化
	var slide = new Slide("#page_list");
	slide.SlideY = function(_dir){
		page_move(_dir);
	}
	//下一页跳转
	$("#bg_music").on("click",function(){
		var that = $(this);
		if(that.hasClass("on")){ 
			that.removeClass("on");
			audio_off(h5.bg_audio);
		}else{ 
			that.addClass("on");
			audio_on(h5.bg_audio);
		}
	})
	$("#drop_down").bind("click",function(){ 
		page_move(1);
	})
	$(".mask").on("touchstart",function(){ 
		$(this).hide();
	})
	$(".mask").bind("touchmove",function(e){ 
		e.preventDefault();
	})
	/*$("[data-mask]").bind("click",function(){ 
		var val = $(this).attr("data-mask");
		$(this).next("#sh_mask").show();
		$(this).parent().siblings(".mask").show().attr("picture",val)
	})*/
	
	$(".tit_name").on("touchend",function(){
		_address($(this).index()-16);
		$("#sh_mask").show();
		})
	var begain = setInterval(function(){ 
		if(h5.preload){
			clearInterval(begain);
			$('#preload').hide();
			ani_run(0);
			//audio_on(h5.bg_audio);
			
		}
	}, 1000)
//	$('.x_btn').on('touchstart',function(e){ 
//		alert(123);
//		page_move(1,true)
//	})
});
function _address(_index){
	$('.hx_photo').attr('src','/static/vip/tujia/img/'+_index+'.jpg');
	$('.mask_tit').html(page.mask_tit[_index]);
	}
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
	//加载前两个页面的图片
	for( var i=0;i< h5.lazy; i++){ 
		lazy_load(0);
	}
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
	$(_dom).css("-webkit-transform","scale("+page.zoom+")");
}
//页面移动
function page_move(_index,sign){ 
	//是否正在处于动画中
	if(!page.sign){return false;}
	//页面阻止移动
	var _stop = page._list[page._index]._stop;
	if(_stop==_index){
		if(!sign){
			return false;
		}
	}
	page.sign = false;
	page._index +=_index;
	if($("#drop_down").length){
		if(page._list[page._index]._stop == 1){ 
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
	if(page._lazy.length){ 
		lazy_load(0);
	}
	setTimeout(function(){$(".page").removeClass('show').eq(page._index).addClass("show");}, page._delay);
	setTimeout(function(){page.sign = true;}, page._delay+page._last);
	ani_run(page._index);
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
//触发动画
function touch_run(_dom){
	var _t = 0;
	var _d = null;
	var _doms = $(_dom).find("[touch-delay]");
	var _length = $(_doms).length;
	for( var i =0 ; i < _length; i++){ 
		_d = $(_doms)[i];
		_t = $(_d).attr("touch-delay");
		var c = function(_DOM,_TIME){
			setTimeout(function(){
				$(_DOM).addClass("active");
			},_TIME);
		}(_d,_t)
	}
} 
//懒加载
function lazy_load(_index){ 
	var _list = page._lazy[_index];
	var _src = "";
	for(var i =0; i < _list._num ; i++){
		var _dom = $(_list._dom[i]);
		_src = $(_dom).attr("lazy-src");
		if(_dom[0].tagName == "IMG"){ 
			$(_dom).attr("src",_src);
		}else{ 
			$(_dom).css("background-image","url("+_src+")");
		}
		$(_dom).bind("error",function(){
			this.removeAttribute("src");
		})
	}
	page._lazy.shift();
}
//倒计时
function countdown(_dom,_num){
	if(_num <= 0){return false;}
	var _D = _dom;
	var _N = _num - 1;
	setTimeout(function(){
		$(_D).html(_N);
		countdown(_D,_N);
	}, 1000)
}
//播放音乐
function audio_on(_dom){ 
	_dom.play();
}
//暂停音乐
function audio_off(_dom){ 
	_dom.pause();
}

$( ".page_box1 .left_btn" ).bind("touchend", function (){
		play(-1);
	});
	$( ".page_box1 .right_btn" ).bind("touchend", function (){
		play(1);
	});

function play(_dir){
	var that = $(".page_box1").find("li.select");
	var _index = ($(that).index()+_dir + 6)%6;
	$(that).removeClass("select");
	$(".page_box1 li").eq(_index).addClass("select");
}
