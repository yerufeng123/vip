
var preLoad = function(){
	this.baseurl = ""||h5.address;
	//静态资源
	this.res = [
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
	
}

preLoad.prototype = {
	bind_fn : function(obj,func){
        return function(){
            func.apply(obj,arguments);
        }
    },
	init:function(){
		document.addEventListener("touchmove",function(e){ 
			e.preventDefault();
		})
		this.addres();
		
	},
	//资源添加
	addres:function(){
		var doms = document.querySelectorAll('[pre-src]');
		for(var i = doms.length-1;i>0;i--){
			var dom = doms[i];
			var obj ={type:dom.tagName,src:dom.getAttribute('pre-src')};
			this.res.push(obj);
		}
		this.res_num = this.res.length;
		this.loadRes();
	},

	//资源预加载
	loadRes:function(){

		var arr = this.res;
		var dom = null;
		
		for(var i =this.res_num -1; i >= 0; i--){
			dom = arr[i];

			switch(dom.type){
				case "IMG"	:this.loadImg(dom);break;
				case "js"	:this.loadJs(dom);break;
				case "css"	:this.loadCss(dom);break;
				case "AUDIO":this.loadAudio(dom);break;
				case "VIDEO":this.loadVideo(dom);break;
				default:this.loadImg(dom);
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
		if(this.num == this.res_num){ 
			this.over();
		}
	},
	over: function(){ 
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
