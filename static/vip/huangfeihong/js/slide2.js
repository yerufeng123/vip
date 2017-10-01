//============================================================
//2015.02.02	胡曦	迅鸥在线
//============================================================
'use strict';
function Slide(_wrap) {
    this.wrap 	= document.querySelectorAll(_wrap);
    this.touchStart = "touchstart";
    this.touchMove 	= "touchmove";
    this.touchEnd 	= "touchend";
    this.touchCancel= "touchcancel";
    //敏感度
    this.degreeX 	= 120;
    this.degreeY 	= 90;
    this.lastT 		= 200;
    this.intervalT 	= 200;
    this.times 		= 4;
    //过程状态 
    this.transX 	= 0;
    this.transY 	= 0;
    this.pointX 	= 0;
    this.pointY 	= 0;
    this.dx 		= 0;
    this.dy 		= 0;
    this.longe 		= 0;
    this.deg 		= 0;
    this.odeg 		= 0;
    this.ndeg 		= 0;
    this.num 		= 0;
    //结果状态
    this.timer 	= null;
    this.delay 	= null;
    this.X_dir 	= 0;
    this.Y_dir 	= 0;
    this.max 	= 0;
    this.rotate = 0;
    this.scale 	= 1;
    this.last 	= 0;
    this.interval = 0;

    this.isIE = false;
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
    		this.wrap[i].addEventListener(this.touchMove, this.bind_fn(this,this.touch_move));
    		this.wrap[i].addEventListener(this.touchEnd, this.bind_fn(this,this.touch_end));
    		//this.wrap[i].addEventListener(this.touchCancel, this.bind_fn(this,this.over));
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
    	if(!num){ 
    		this.pointX = this.point(e,0).x;
    		this.pointY = this.point(e,0).y;
    		
    		this.timer = setTimeout(this.bind_fn(this,function(){ 
    			this.last = 1;
				this.hold();
    		}),this.lastT);
			clearTimeout(this.delay);
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
    	var num = this.num-1;
    	this.dx = this.transX;
    	this.dy = this.transY;
    	this.transX = this.point(e,num).x - this.pointX;
    	this.transY = this.point(e,num).y - this.pointY;
    	this.dx = this.transX - this.dx;
    	this.dy = this.transY - this.dy;
    	this.move_res(e,num);
        e.stopPropagation();
        e.preventDefault();
    },
    move_res:function(e,num){ 
    	if(num >= 1){ 
    		var x = this.transX;
    		var y = this.transY;
    		this.scale 	= Math.pow((x * x + y * y), 0.5)/this.longe;
    		this.rotate = 180*Math.atan(y/x)/(Math.PI);
    		if(this.ndeg*this.rotate < 0){ 
    			if(this.rotate > 45){ 
    				this.deg -= 180;
    			}
    			if(this.rotate < -45){ 
    				this.deg += 180;
    			}
    		}
    		this.ndeg = this.rotate;
    		this.rotate = this.rotate + this.deg - this.odeg;
    	}
    	this.moving({x:this.transX,y:this.transY,dx:this.dx,dy:this.dy,point:this.num,rotate:this.rotate,scale:this.scale});
    },
    touch_end: function (e) {
    	if(this.isIE){ 
    		this.num--;
    	}
    	this.num = e.touches.length;
    	if(this.num){ 
    		if(this.num == 1){
	    		this.pointX = this.point(e).x;
	    		this.pointY = this.point(e).y;
	    	}
    		return 0;
    	}
    	clearTimeout(this.timer);
    	this.delay = setTimeout(this.bind_fn(this,function(){
				this.interval = 1;
			}),this.intervalT);
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
    	if(!this.last){ 
    		if(this.interval){
	    		this.tap(false,this.max);
	    		this.interval = 0;
	    	}else{ 
	    		this.tap(true,this.max);
	    	}
    	}
    	if(this.X_dir||this.Y_dir){ 
    		this.swipe(this.X_dir,this.Y_dir,this.max);
    	}
    	this.over();
    },
    over:function(){ 
    	this.scale = 1;
    	this.last =  
    	this.max = this.num =
    	this.X_dir = this.Y_dir = this.deg = this.rotate = 
    	this.pointX = this.pointY =  this.transX = this.transY = 0;
    },
    //记录手势
    swipe:function(x_dir,y_dir,points){},
    moving:function(){},
    tap:function(sign,points){},
    hold:function(){},
}