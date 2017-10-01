
var preLoad = function(){
	this.baseurl = ""||h5.address;
	//图片资源
	this.img = [
	"logo.png",
	"p1_tit.png",
	"p1_tu.png",
	"p1_jane.png",
	"p1_peter.png",
	"p1_mark.png",
	"p1_tu.png",
	"p1_car.png",
	"p2_name.png",
	"p2_tu.png",
	"p2_car.png",
	"p2_tit.png",
	"p3_name.png",
	"p3_tu.png",
	"p3_car.png",
	"p3_tit.png",
	"p4_name.png",
	"p4_tu.png",
	"p4_car.png",
	"p4_tit.png",
	"p6_mh_bg.png",
	"p6_show.png",
	"p6_cion.png",
	"icon_left.png",
	"list_tu1.png",
	"list_tu2.png",
	"list_tu3.png",
	"icon_right.png",
	"p6_show.png",
	"p8_car.png",
	"drop_down.png",
	"music.png",
	"music_off.png",
	"page1_bg.jpg",
	"page2_bg.jpg",
	"p8_form.png",
	"bt_tu.png",
	"hand_cursor.gif"
	];
	this.img_num = this.img.length;
	//JS资源
	this.js = [ 
	];
	this.js_num = this.js.length;
	//静态资源
	this.res = [
	"bg.mp3"
	];
	this.res_num = this.js.length;
	//失败资源列表
	this.fail = [];

	this.sum = this.img_num + this.js_num + this.res_num;
	this.num = 0;
	//预加载页面
	this.m = null;
	this.h = null;
	this.tit = null;
	this.pre = null
	this.init();
}

preLoad.prototype = {
	bind_fn : function(obj,func){
        return function(){
            func.apply(obj,arguments);
        }
    },
	init:function(){
		//this.m = document.getElementById("pre_m");
		//this.h = document.getElementById("pre_h");
		//this.tit = document.getElementById("pre_tit");
		this.pre = document.getElementById("preload");
		this.pre.addEventListener("touchmove",function(e){ 
			e.preventDefault();
		})
		this.loadRes();
		this.loadImg();
	},
	//图片预加载
	loadImg:function(){
		for(var i =0; i < this.img_num; i++){ 
			var img = new Image();
			img.src = this.baseurl+"img/"+this.img[i];
			img.addEventListener("load", this.bind_fn(this,this.ok));
			img.addEventListener("error",this.bind_fn(this,this.no));
		}
	},
	//JS预加载
	loadJs:function(_src){

	},
	//资源预加载
	loadRes:function(){
		for(var i =0; i < this.res_num; i++){ 
			var _audio = document.createElement("audio");
			_audio.src = this.baseurl +"video/"+ this.res[i];;
			img.addEventListener("load", this.bind_fn(this,this.ok));
			img.addEventListener("error",this.bind_fn(this,this.no));
		}
	},
	ok:function(){ 
		this.num++;
		this.callback(true);
	},
	no:function(){ 
		this.num++;
		this.callback(false);
	},
	callback:function(sign){
		var prentent = Math.floor(this.num/this.sum*100)
		if( prentent > 90){ 
			var _wrap = document.getElementById("wrap");
			_wrap.style.display = "block";
		}
		var m = prentent*3.6;
		var s = prentent*0.3+330;
		var mtext = "-webkit-transform: rotate("+m+"deg);transform: rotate("+m+"deg);";
		var htext = "-webkit-transform: rotate("+s+"deg);transform: rotate("+s+"deg);";
		//this.m.style.cssText = mtext;
		//this.h.style.cssText = htext;
		if(this.num == this.sum){ 
			this.over();
		}
	},
	over: function(){ 
		//this.tit.style.opacity = 1;
		//图片加载
		var _dom = document.querySelectorAll("[pre_src]");
		for(var i =0; i < _dom.length;i++){
			var this_dom = _dom[i];
			var _src = this.baseurl + this_dom.getAttribute("pre_src")
			if(this_dom.tagName == "IMG"){ 
				this_dom.setAttribute("src",_src);
			}else{ 
				this_dom.style.backgroundImage = "url("+_src+")";
			}
		}+
		setTimeout(function(){
			h5.preload = true;
		}, 1500)
		
	}
}
var preLoad = new preLoad();