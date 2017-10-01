'use strict';
var page = {
			_width 	:0,			//页面宽度
			_height	:0,			//页面高度
			_delay	:0,		//页面切换停留时间
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
			_text   :[
					'随着时代的发展和互联网技术的深度渗透，企业管理的信息化程度也有了极大地提高，在这样的基础上，有着深厚的互联网基因的京东凭借着自身的服务优势、技术优势赢得了日新月异的企业市场的青睐',
					'作为全国最大的自营电商，京东数千万种商品都经过市场的充分考验，保证了商品价格的透明，这也意味着通过市场机制保障了企业采购成本的降低和合理化。',
					'京东拥有业内最强大的供应链体系，轻松实现全国发货，按单配送，保障了标准化服务的同时也保证了成本的可控，让分部散布全国各地的大型集团公司可以轻松管控全国的采购工作，成本管控不再鞭长莫及。'

					]
			};
$(document).ready(function(e) {
	document.addEventListener('touchmove', function (e) {e.preventDefault();},false);
	page._num = $("[scene]").length;
	page._height = $("body").height();
	page._width = $("body").width();
	$("#page_list").addClass(h5.skip).height(page._height);
	$("#page_list").css({"-webkit-transform":"translateY(0px) translateZ(0)"});

	init();
	//滑动组件初始化
	var slide = new Slide("#page_list");
	slide.SlideY = function(dir){
		if(page._index == 0){ return false;}
		if(page._index == 7) $('.p8_mask').hide();
		if(dir) page_move(dir);
	}
	$('#music').on('click',function(){ 
		if($(this).hasClass('on')){
			_audioOff(h5.bg_audio);
			$(this).removeClass('on');
		}else{
			_audioon(h5.bg_audio);
			$(this).addClass('on');
		}
	})
	//下一页跳转
	$("#drop_down").bind("click",function(){ 
		page_move(1);
	})
	$('.p3_i').bind('click',function(){ 
		var _index = $(this).index()+1;
		page_move(_index,true);
	})
	$(window).resize(function(){ 
		page._height = $("body").height();
		page._width = $("body").width();
		$("#page_list").height(page._height);
	})
	$('.p1_touch').on('touchstart',function(){
		var _index = $(this).index();
		$('#page1 .light').eq(_index-5).addClass('active');
		$('.p1_point').attr('step',_index-4)

	})
	$('.p1_touch5').on('touchstart',function(){
		if($('#page1 .light.active').length == 4){
			page_move(1,true);
			$('.p1_point').attr('step',0)
		}
	})
	//运行动画
	var Time1 = setInterval(function(){
		if(h5.preload){
			clearInterval(Time1);
			$('#preload').hide();
			ani_run(0);
		}
	},1000)
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
		if(!sign)return false;
	}
	page.sign = false;
	page._index +=_index;

	//20150715 jia add,huxi change
	if(page._index==8){
		setTimeout(function(){
			page_move(1,true);
		}, 10000 )
		}

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
//打开音乐
function _audioon(){
	console.log(1);
	var audio = document.getElementById("audio");
	audio.play();
	}
//打开音乐
function _audioOff(){
	var audio = document.getElementById("audio");
	audio.pause();
	}
