
var preLoad = function(){
	this.baseurl = ""||h5.address;
	//静态资源
	//js 	{type:"js",   src:""}
	//img 	{type:"img",  src:""}
	//css 	{type:"css",  src:""}
	//video {type:"video",src:""}
	//audio {type:"audio",src:""}
	this.res = [
		{type:"img",src:"/static/vip/dazhong/two/img/bg9_3.jpg"},//修改20151126
		{type:"img",src:"/static/vip/dazhong/two/img/btn_down.png"},
		{type:"img",src:"/static/vip/dazhong/two/img/music_on.gif"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg1.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg2_1.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg2_2.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg2_3.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg2_4.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg3_1.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg3_2.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg4_1.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg4_2.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg4_3.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg4_4.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg5_1.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg5_2.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg6.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg8.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg9_1.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg9_2.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/bg10.jpg"},
		{type:"img",src:"/static/vip/dazhong/two/img/car1.png"},
		{type:"img",src:"/static/vip/dazhong/two/img/car2.png"},
		{type:"img",src:"/static/vip/dazhong/two/img/car3.png"},
		{type:"img",src:"/static/vip/dazhong/two/img/car2.png"},
		{type:"img",src:"/static/vip/dazhong/two/img/word2.png"},
		{type:"img",src:"/static/vip/dazhong/two/img/word.png"},
		{type:"css",src:"/static/vip/dazhong/two/css/page.css"},
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
		this.preText = document.querySelector("#load_num");

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
		this.preText.innerHTML = prentent+"%";
		if(this.num == this.res_num){ 
			this.over();
		}
	},
	over: function(){ 
		this.preText.innerHTML ='100%';
		//图片加载
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
		h5.preload = true;
	}
}
	var preLoad = new preLoad();
