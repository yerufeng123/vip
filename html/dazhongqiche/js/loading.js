
var preLoad = function(){
	this.baseurl = ""||h5.address;
	//图片资源
	this.img = [
	"p1_tit1.png",
	"p1_tit2.png",
	"means.png",
	"p2_tit1.png",
	"p2_tu.jpg",
	"p2_car.png",
	"p3_tit1.png",
	"p3_tit2.png",
	"p4_tit.png",
	"p4_tu1.png",
	"p4_tu2.png",
	"p4_tu3.png",
	"p5_tit.png",
	"p5_tu1.jpg",
	"p5_tu2.jpg",
	"p5_tu3.jpg",
	"p6_tit.png",
	"p6_tu1.jpg",
	"p6_tu2.jpg",
	"p6_tu3.jpg",
	"p7_tit.png",
	"p7_tu1.jpg",
	"p7_tu2.jpg",
	"p8_tit1.png",
	"p8_tit2.png",
	"p8_tit3.png",
	"p8_tit4.png",
	"p9_tit1.png",
	"p9_tit2.png",
	"p9_tu.jpg",
	"drop_down.png",
	"logo.png",
	"page1_bg.jpg",
	"page3_bg.jpg",
	"page8_bg.jpg"
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
	//this.m = null;
	//this.h = null;
	//this.tit = null;
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