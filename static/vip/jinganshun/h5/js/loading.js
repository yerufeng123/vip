
var preLoad = function(){
	this.baseurl = ""||h5.address;
	//图片资源
	this.img = [
	"pre_time.png",
	"pre_h.png",
	"pre_m.png",
	"pre_tit.png",

	"icon1.png",
	"icon2.png",
	"icon3.png",
	"icon4.png",
	"mail.png",
	"music_off.png",
	"p1_photo1.png",
	"p1_photo2.png",
	"p1_show1.png",
	"p1_show2.png",
	"p1_tit.png",
	"p2_kettle.png",
	"p2_leaf.png",
	"p2_ligth.png",
	"p2_photo1.png",
	"p2_photo2.png",
	"p2_plant.png",
	"p2_show1.png",
	"p2_show2.png",
	"p2_sun.png",
	"p2_tit.png",
	"p3_bar.png",
	"p3_bird1.png",
	"p3_bird2.png",
	"p3_heart1.png",
	"p3_house.png",
	"p3_left.png",
	"p3_people.png",
	"p3_right.png",
	"p3_show.png",
	"p3_tit.png",
	"p3_tree.png",
	"p4_fly1.png",
	"p4_fly2.png",
	"p4_heart.png",
	"p4_text.png",
	"p4_tit.png",
	"p5_foot.png",
	"p5_head.png",
	"p5_heart.png",
	"p5_tit.png",
	"p6_mask.png",
	"p6_tit.png",
	"drop_down.png",
	"figuer.jpg",
	"p1_bg.jpg",
	"p4_show1.jpg",
	"p4_show2.jpg",
	"p4_show3.jpg",
	"p4_show4.jpg",
	"p4_show5.jpg",
	"p4_tree.jpg",
	"p5_bg.jpg",
	"p5_photo.jpg",
	"word.jpg",
	"p2_water.gif",
	"music.gif"
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
		this.m = document.getElementById("pre_m");
		this.h = document.getElementById("pre_h");
		this.tit = document.getElementById("pre_tit");
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
		this.m.style.cssText = mtext;
		this.h.style.cssText = htext;
		if(this.num == this.sum){ 
			this.over();
		}
	},
	over: function(){ 
		this.tit.style.opacity = 1;
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