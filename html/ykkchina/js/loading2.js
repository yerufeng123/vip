
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
		

	this.total = 23;
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
		document.getElementById("loading_num").innerHTML = "精彩正在加载..." + percent + "%";
		//console.log(percent)
		if(this.imagesLoaded == this.total){
			init();	
		}
		
	},
	
	////////////////////////////////////////////////
	imageLoadErrorCallback:function(e){
		this.imagesLoaded ++;	
		var percent = parseInt(this.imagesLoaded / this.total * 100);
		document.getElementById("loading_num").innerHTML = "精彩正在加载..." + percent + "%";
		if(this.imagesLoaded == this.total){
			init();	
		}
	}
}
var game = new Game();
var _http = "http://vip.hui.net/html/ykkchina";
game.loadImage(_http + "/img/preloader5.gif",true);
game.loadImage(_http + "/img/page1.gif",true); 
/* game.loadImage(_http + "/img/page1.jpg",true);*/
game.loadImage(_http + "/img/drop_down2.png",true);
game.loadImage(_http + "/img/music.png",true);
game.loadImage(_http + "/img/music_off.png",true);
game.loadImage(_http + "/img/logo.png",true);
game.loadImage(_http + "/img/logo2.png",true);
game.loadImage(_http + "/img/map2.jpg",true);
game.loadImage(_http + "/img/page_text.png",true);
/* game.loadImage(_http + "/img/page_text1.png",true);
game.loadImage(_http + "/img/page_text2.png",true);
game.loadImage(_http + "/img/page_text3.png",true);
game.loadImage(_http + "/img/page_text4.png",true);
game.loadImage(_http + "/img/page_text5.png",true);
game.loadImage(_http + "/img/page_text6.png",true);
game.loadImage(_http + "/img/page_text7.png",true);
game.loadImage(_http + "/img/page_text8.png",true); */
game.loadImage(_http + "/img/page3_img1.jpg",true);
game.loadImage(_http + "/img/page2_bottom.png",true);
game.loadImage(_http + "/img/page2_left.png",true);
game.loadImage(_http + "/img/page2_right.png",true);
game.loadImage(_http + "/img/page3_bottom.png",true);
game.loadImage(_http + "/img/page3_left.png",true);
game.loadImage(_http + "/img/page3_right.png",true);
game.loadImage(_http + "/img/page4_bottom.png",true);
game.loadImage(_http + "/img/page4_left.png",true);
game.loadImage(_http + "/img/page4_right.png",true);
game.loadImage(_http + "/img/text.png",true);
game.loadImage(_http + "/img/text0.png",true);
game.loadImage(_http + "/img/text1.png",true);
game.loadImage(_http + "/img/text2.png",true);

function init(){
	page._pre =true;
	//_loading.className = "hide";
	//_audio()

}
