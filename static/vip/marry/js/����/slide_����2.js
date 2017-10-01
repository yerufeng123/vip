//============================================================
//2015.02.02	胡曦	迅鸥在线
//============================================================
'use strict';
function Slide(_wrap) {
    this.wrap 	= document.querySelectorAll(_wrap);
    this.touchStart = "touchstart";
    this.touchMove 	= "touchmove";
    this.touchEnd 	= "touchend";
    //敏感度
    this.degreeX 	= 120;
    this.degreeY 	= 90;
    this.lastT 		= 200;
    this.intervalT 	= 200;
    this.times 		= 1;
    //过程状态 
    	//过程点位置
    this.transX 	= 0;
    this.transY 	= 0;
    	//原始点位置
    this.pointX 	= 0;
    this.pointY 	= 0;

    this.longe 		= 0;
    this.deg 		= 0;
    this.ndeg 		= 0;
    this.num 		= 0;
    this.stime 		= 0;
    this.etime 		= 0;
    //结果状态
    this.timer 	= null;
    this.X_dir 	= 0;
    this.Y_dir 	= 0;
    this.max 	= 0;
    this.rotate = 0;
    this.scale 	= 1;
    this.last 	= 0;
    this.interval = 0;

    this.isIE = false;
    this.text1 	= document.querySelectorAll(".text1");
    //IE
    if (window.navigator.msPointerEnabled) { 
    	this.isIE = true;
    }
    if (this.isIE) {
	    this.touchStart = "MSPointerDown";
	    this.touchMove  = "MSPointerMove";
	    this.touchEnd   = "MSPointerUp";

	}
	this.init(this.wrap);
}
Slide.prototype = {
    init:function(){
    	for( var i = 0; i < this.wrap.length; i++){
    		this.wrap[i].addEventListener(this.touchStart, this.bind_fn(this,this.touch_start));
    		this.wrap[i].addEventListener(this.touchMove, this.bind_fn(this,this.touch_move))
    		this.wrap[i].addEventListener(this.touchEnd, this.bind_fn(this,this.touch_end))
    	}
    },
    bind_fn : function(obj,func){
        return function(){
            func.apply(obj,arguments);
        }
    },
    point:function(e,j){
    	var i= j||0;
    	var _x = 0;
    	var _y = 0;
    	if(this.isIE){ 
    		_x = e.pageX;
    		_y = e.pageY;
    	}else{ 
    		_x = e.touches[i].pageX;
    		_y = e.touches[i].pageY;
    	}
    	return {x:_x,y:_y}
    },
    touch_start: function (e) {
    	var num = this.num++;
    	this.max++;
		var time = new Date();
		this.stime = time.getTime();
		if(!num){ 
			this.pointX = this.point(e,num).x;
			this.pointY = this.point(e,num).y;
		}
    	this.timer = setTimeout(function(){ 
			this.last = 1;
			this.hold();
		},800);
		this.intervalT = this.stime -  this.etime;
    	if(this.intervalT < 200){
			this.interval = true;
		}
    	if(num){
    		this.start_res(e,num);
    	}
    },
    start_res:function(e,num){ 
		var x = this.point(e,num).x - this.pointX;
    	var y = this.point(e,num).y - this.pointY;
    	this.longe 	= Math.pow((x * x + y * y), 0.5);
    	this.ndeg = this.odeg = 180*Math.atan(y/x)/(Math.PI);
    },
    touch_move: function (e) {
       	clearTimeout(this.timer);
    	this.transX = this.point(e,0).x - this.pointX;
    	this.transY = this.point(e,0).y - this.pointY;
    	this.move_res(e);
        e.stopPropagation();
        e.preventDefault();
    },
    move_res:function(e){ 
    	if(this.num >= 1){ 
    		var x = this.point(e,this.num-1).x - this.point(e,0).x;
    		var y = this.point(e,0).y - this.point(e,this.num-1).y;
    		this.scale 	= Math.pow((x * x + y * y), 0.5)/this.longe;
    		this.rotate = 180*Math.atan(y/x)/(Math.PI);
    		if( x*y > 0){ 


    		}else{ 


    		}
    		
    		this.ndeg = this.rotate;
    		this.rotate = this.rotate + this.deg;
    		//text
    		for(var i = 0; i < this.text1.length; i++){ 
    			//this.text1[i].textContent = "rotate:"+this.rotate+"; scale:"+this.scale+"; longe:"+this.longe+";deg:"+this.deg;
    			this.text1[i].textContent = "x:"+x+"; y:"+y;
    		}
    	}
    	this.moving(this.transX,this.transY,this.num,this.rotate,this.scale);
    },
    touch_end: function (e) {
    	this.num--;
    	if(this.num){ 
    		if(this.num == 1){
	    		this.pointX = this.point(e).x;
	    		this.pointY = this.point(e).y;
	    	}
    		return 0;
    	}
    	clearTimeout(this.timer);
    	var time = new Date();
    	this.etime = time.getTime();
    	this.lastT = this.etime - this.stime
		var times = 0;
		times = this.last ? 1:this.times;
		var X = this.transX*times;
    	var Y = this.transY*times;
    	if(Y > this.degreeY) {
    		this.Y_dir= -1;
    	}else if(Y < -this.degreeY){	
    		this.Y_dir= 1;
    	}
    	if(X < -this.degreeX){
    		this.X_dir = 1;
    	}else if(X > this.degreeX){ 
    		this.X_dir = -1;
    	}
    	this.end_res();
    },
    end_res:function(){
    	if(this.lastT < 100){ 
    		if(this.interval){
	    		this.tap(2,this.max);
	    	}else{ 
	    		this.tap(1,this.max);
	    	}
    	}
    	if(this.X_dir||this.Y_dir){ 
    		this.swipe(this.X_dir,this.Y_dir,this.max);
    	}
    	this.rotate = this.last = this.interval = this.lastT = this.X_dir = this.Y_dir = this.max = this.pointX = this.pointY = this.num = this.deg = 0;
    	this.scale = 1;
    },
    //记录手势
    swipe:function(x_dir,y_dir,points){},
    moving:function(x,y,points,rotate,longe){},
    tap:function(times,points){},
    hold:function(){},
}