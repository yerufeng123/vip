
var Game = function(){
	var self = this;
	
	this.sprites = [];
	
	this.images = [];
	this.imageUrls = [];
	
	this.startTime = 0;
	this.lastTime = 0;
	this.gameTime = 0;
	this.fps = 0;
	this.STARTING_FPS = 60;
	
	this.imagesLoaded = 0;
	this.imagesFailedToLoad = 0;
	
	this.paused = false;
	this.startedPauseAt = 0;
	this.PAUSE_TIMEOUT = 100;
		

	this.total = 51;
	return this;
}

Game.prototype = {
	start:function(){
		var self = this;
		this.startTime = getTimeNow();//record the start time.
	},
	////////////////////////////////////////////////
	loadImage:function(imageUrl,required){
		/*
		 * need to reload while function imageReLoad running if required equal to TRUE
		 *	
		*/
		var image = new Image();
		var self = this;
		
		image.src = imageUrl;
		//此处需要设定图片状态为0
		
		
		image.addEventListener('load',function(e){
			self.imageLoadedCallback(e);	
		});	
		image.addEventListener('error',function(e){
			self.imageLoadErrorCallback(e);	
		});
		this.images[imageUrl] = image;
	},
	////////////////////////////////////////////////
	queueImage:function(imageUrl){
		this.imageUrls.push(imageUrl);	
	},
	////////////////////////////////////////////////
	getImageByUrl:function(imageUrl){
		return this.images[imageUrl];
	},
	////////////////////////////////////////////////
	getImage:function(index){
		return this.getImageByUrl(this.imageUrls[index]);
	},
	////////////////////////////////////////////////
	imageReLoad:function(){

	},
	////////////////////////////////////////////////
	imageLoadedCallback:function(e){
		this.imagesLoaded ++;	
		var percent = parseInt(this.imagesLoaded / this.total * 100);
		document.getElementById("loadWord").innerHTML =  "精彩正在加载...<br/>" + percent + "%";
		if(this.imagesLoaded == this.total){
			init()
		}
	},
	////////////////////////////////////////////////
	imageLoadErrorCallback:function(e){
		this.imagesLoaded ++;	
		var percent = parseInt(this.imagesLoaded / this.total * 100);
		document.getElementById("loadWord").innerHTML = "精彩正在加载...<br/>" + percent + "%";
		if(this.imagesLoaded == this.total){
			init()
		}
	}
}
var game = new Game();
var _http = "http://192.168.0.3/RY_h5/img/";
game.loadImage(_http + "page1_bg.jpg",true);
game.loadImage(_http + "page1_icon1.png",true);
game.loadImage(_http + "page1_title1.png",true);
game.loadImage(_http + "page1_title2.png",true);

game.loadImage(_http + "page2_b_bg.png",true);
game.loadImage(_http + "page2_b_people.png",true);
game.loadImage(_http + "page2_b_sign.png",true);
game.loadImage(_http + "page2_b_word.png",true);
game.loadImage(_http + "page2_t_bg.png",true);
game.loadImage(_http + "page2_t_car.png",true);
game.loadImage(_http + "page2_t_word.png",true);

game.loadImage(_http + "page3_bg.png",true);
game.loadImage(_http + "page3_icon1.png",true);
game.loadImage(_http + "page3_icon2.png",true);
game.loadImage(_http + "page3_VS.png",true);
game.loadImage(_http + "page3_word1.png",true);
game.loadImage(_http + "page3_word2.png",true);

game.loadImage(_http + "page4_footer.png",true);
game.loadImage(_http + "page4_icon1.png",true);
game.loadImage(_http + "page4_word1.png",true);

game.loadImage(_http + "page5_bg.jpg",true);
game.loadImage(_http + "page5_footer.png",true);
game.loadImage(_http + "page5_icon1.png",true);
game.loadImage(_http + "page5_icon2.png",true);
game.loadImage(_http + "page5_word1.png",true);

game.loadImage(_http + "page6_bg.png",true);
game.loadImage(_http + "page6_footer.png",true);
game.loadImage(_http + "page6_icon1.png",true);
game.loadImage(_http + "page6_icon2.png",true);
game.loadImage(_http + "page6_people.png",true);
game.loadImage(_http + "page6_word1.png",true);
game.loadImage(_http + "page6_word2.png",true);

game.loadImage(_http + "page7_icon1.png",true);
game.loadImage(_http + "page7_icon2.png",true);
game.loadImage(_http + "page7_text1.png",true);
game.loadImage(_http + "page7_text2.png",true);
game.loadImage(_http + "page7_text3.png",true);
game.loadImage(_http + "page7_title.png",true);
game.loadImage(_http + "page7_word1.png",true);

game.loadImage(_http + "page8_icon1.png",true);
game.loadImage(_http + "page8_word1.png",true);
game.loadImage(_http + "page8_word2.png",true);

game.loadImage(_http + "page9_foot.png",true);
game.loadImage(_http + "page9_word1.png",true);
game.loadImage(_http + "page9_word2.png",true);
game.loadImage(_http + "page9_word3.png",true);
game.loadImage(_http + "page9_word4.png",true);

game.loadImage(_http + "page10_bg.jpg",true);
game.loadImage(_http + "page10_icon1.png",true);
game.loadImage(_http + "page10_icon2.png",true);
game.loadImage(_http + "page10_word.png",true);

function init(){
	var _loading = document.getElementById("loading");
	var _loader =  document.getElementById("loader");
	_loader.className = "";
	image_load();
	document.getElementById("loadWord").innerHTML = "加载完成<br/>点击屏幕开始精彩内容";
	_loading.addEventListener("click",function(){
		this.className = "hide"	;
		_run(1);
	})
}
