
var preLoad = function(){
	this.baseurl = ""||h5.address;
	//静态资源
	//js 	{type:"js",   src:""}
	//img 	{type:"img",  src:""}
	//css 	{type:"css",  src:""}
	//video {type:"video",src:""}
	//audio {type:"audio",src:""}
	this.res = [
		{type:"img",src:"/static/vip/jingdong/img/logos.jpg"},
		{type:"img",src:"/static/vip/jingdong/img/p8_i.png"},
		{type:"img",src:"/static/vip/jingdong/img/p2_tit.png"},
		{type:"img",src:"/static/vip/jingdong/img/p10.png"},
		{type:"img",src:"/static/vip/jingdong/img/p4_t1.png"},
		{type:"img",src:"/static/vip/jingdong/img/p4_t2.png"},
		{type:"img",src:"/static/vip/jingdong/img/p4_t3.png"},
		{type:"img",src:"/static/vip/jingdong/img/p4_t4.png"},
		{type:"img",src:"/static/vip/jingdong/img/icon1.png"},
		{type:"img",src:"/static/vip/jingdong/img/icon2.png"},
		{type:"img",src:"/static/vip/jingdong/img/icon3.png"},
		{type:"img",src:"/static/vip/jingdong/img/icon4.png"},
		{type:"img",src:"/static/vip/jingdong/img/icon-s.png"},
		{type:"img",src:"/static/vip/jingdong/img/line_top.png"},
		{type:"img",src:"/static/vip/jingdong/img/logo1.png"},
		{type:"img",src:"/static/vip/jingdong/img/p1_t1.png"},
		{type:"img",src:"/static/vip/jingdong/img/p1_t2.png"},
		{type:"img",src:"/static/vip/jingdong/img/p1_t3.png"},
		{type:"img",src:"/static/vip/jingdong/img/p1_t4.png"},
		{type:"img",src:"/static/vip/jingdong/img/p8_t3.png"},
		{type:"img",src:"/static/vip/jingdong/img/p4_b.png"},
		{type:"img",src:"/static/vip/jingdong/img/p7_t1.png"},
		{type:"img",src:"/static/vip/jingdong/img/p7_t2.png"},
		{type:"img",src:"/static/vip/jingdong/img/p7_t3.png"},
		{type:"img",src:"/static/vip/jingdong/img/p7_t4.png"},
		{type:"img",src:"/static/vip/jingdong/img/p7_t5.png"},
		{type:"img",src:"/static/vip/jingdong/img/p7_t6.png"},
		{type:"img",src:"/static/vip/jingdong/img/p8_btn.png"},
		{type:"img",src:"/static/vip/jingdong/img/p8_dia.png"},
		{type:"img",src:"/static/vip/jingdong/img/powerd.png"},
		{type:"img",src:"/static/vip/jingdong/img/p8_t3.png"},
		{type:"img",src:"/static/vip/jingdong/img/p8_t2.png"},
		{type:"img",src:"/static/vip/jingdong/img/p8_t1.png"},
		{type:"img",src:"/static/vip/jingdong/img/p8_tit.png"},
		{type:"img",src:"/static/vip/jingdong/img/p10_btn.png"},
		{type:"img",src:"/static/vip/jingdong/img/p10_logo.png"},
		{type:"img",src:"/static/vip/jingdong/img/p1_btn.png"},
		{type:"img",src:"/static/vip/jingdong/img/line3.png"},
		{type:"img",src:"/static/vip/jingdong/img/line2.png"},
		{type:"img",src:"/static/vip/jingdong/img/line1.png"},
		{type:"img",src:"/static/vip/jingdong/img/diag_bg.png"},
		{type:"img",src:"/static/vip/jingdong/img/diag_tit.png"},
		{type:"img",src:"/static/vip/jingdong/img/p6.jpg"},
		{type:"img",src:"/static/vip/jingdong/img/p5.jpg"},
		{type:"img",src:"/static/vip/jingdong/img/p4.jpg"},
		{type:"img",src:"/static/vip/jingdong/img/p3.jpg"},
		{type:"img",src:"/static/vip/jingdong/img/p2.jpg"},
		{type:"img",src:"/static/vip/jingdong/img/p1.jpg"},
		{type:"css",src:"/static/vip/jingdong/css/common.min.css"},
	];
	this.res_num = this.res.length;
	//失败资源列表
	this.fail = [];

	this.num = 0;
	//预加载页面
	this.preLoad = null;
	this.preText = null;
	this.pre_icon = null;
	this.pre_bar = null;
	this._height = 0;


	this.init();
	this.loadRes();
}

preLoad.prototype = {
	bind_fn : function(obj,func){
        return function(){
            func.apply(obj,arguments);
        }
    },
	init:function(){
		this.preLoad = document.querySelector("#preload");
		this.preText = document.querySelector("#pre_pot");
		this.pre_icon = document.querySelector('#pre_icon');
		this.pre_bar = document.querySelector('#pre_bar_body');
		this._height = document.body.clientHeight - 380;

		document.addEventListener("touchmove",function(e){ 
			e.preventDefault();
		})
	},
	//资源添加
	addres:function(){
	},

	//资源预加载
	loadRes:function(){
		var arr = this.res;
		var dom = null;
		for(var i =this.res_num -1; i >= 0; i--){
			dom = arr[i];
			switch(dom.type){
				case "img"	:this.loadImg(dom);break;
				case "js"	:this.loadJs(dom);break;
				case "css"	:this.loadCss(dom);break;
				case "audio":this.loadAudio(dom);break;
				case "video":this.loadVideo(dom);break;
				default:console.log("error");;
			}
		}
	},
	//图片预加载
	loadImg:function(res){
		var img = new Image();
		img.src = this.baseurl+res.src;
		img.addEventListener("load", this.bind_fn(this,this.ok));
		img.addEventListener("error",this.bind_fn(this,this.no));
	},
	//JS预加载
	loadJs:function(res){
		var _script = document.createElement("script");
		_script.type = "text/javascript";
		_script.src  = this.baseurl+res.src;
		document.body.insertBefore(_script, document.body.lastChild);
		this.ok();
	},
	//css预加载
	loadCss:function(res){
		var _style = document.createElement("link");
		_style.rel = "stylesheet";
		_style.href  = this.baseurl+res.src;
		document.body.insertBefore(_style, document.body.firstChild);
		this.ok();
	},
	//视频预加载
	loadVideo:function(res){
		var _video = document.createElement("video");
		_video.src  = this.baseurl+res.src;
		_video.addEventListener("load", this.bind_fn(this,this.ok));
		_video.addEventListener("error",this.bind_fn(this,this.no));
	},
	//音频预加载
	loadAudio:function(res){
		var _audio = document.createElement("audio");
		_audio.src  = this.baseurl+res.src;
		_audio.addEventListener("load", this.bind_fn(this,this.ok));
		_audio.addEventListener("error",this.bind_fn(this,this.no));
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
		var prentent = parseInt(this.num/this.res_num*100);
		var _left = 3*prentent-115;
		var _top = this._height/100*prentent;
		this.pre_icon.style.cssText = 'left:'+_left+'px;top:'+_top+'px';
		this.preText.innerHTML = prentent+"%";
		if(this.num == this.res_num){ 
			this.over();
		}
	},
	over: function(){ 
		this.preText.innerHTML ='';
		//图片加载
		var Timer = null;
		document.querySelector('#pre_text').style.opacity = '1';
		document.querySelector('#pre_point').className = 'active';
		document.querySelector('#pre_rate').style.opacity = '1';

		this.preText.className = 'active';

		this.preText.addEventListener('touchstart',function(){
			
			document.querySelector('#pre_rate').className = 'active';

			Timer = setTimeout(function(){
				var dom = document.querySelector('#pre_bar_body');
				document.querySelector('#pre_icon').className = "rotate";
				document.querySelector('#pre_b').style.opacity = '1';
				setTimeout(function(){
					_audioon()
					h5.preload = true;
				},3000)
			},400)
		})
		this.preText.addEventListener('touchend',function(){
			document.querySelector('#pre_rate').className = '';
			clearTimeout(Timer);
		})
		var _dom = document.querySelectorAll("[pre-src]");
		for(var i =0; i < _dom.length;i++){
			var this_dom = _dom[i];
			var _src = this_dom.getAttribute("pre-src")
			if(this_dom.tagName == "IMG"){ 
				this_dom.setAttribute("src",_src);
			}else{ 
				this_dom.style.backgroundImage = "url("+_src+")";
			}
		}
		document.querySelector('#wrap').style.display = 'block';
		
	}
}
	var preLoad = new preLoad();
