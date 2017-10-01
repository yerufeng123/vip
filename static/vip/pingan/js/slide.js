'use strict';
function Slide(_wrap) {
    this.wrap 	= document.querySelectorAll(_wrap);
    this.touchStart = "touchstart";
    this.touchMove 	= "touchmove";
    this.touchEnd 	= "touchend";
    //敏感度
    this.degreeX 	= 120;
    this.degreeY 	= 90;
    this.degree 	= 200;
    //是否滑动
    this.moveSign 	= true;
    this.transX 	= 0;
    this.transY 	= 0;
    this.pointX 	= 0;
    this.pointY 	= 0;
    //状态记录
    this.X_dir 	= 0;
    this.Y_dir 	= 0;
    this.etime 	= 0;
    this.isIE = false;
    //Internet Explorer 10 style
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
    touch_start: function (e) {
		this.pointX = this.point(e).x;
		this.pointY = this.point(e).y;
		var time = new Date();
		this.etime = time.getTime();
    },
    touch_move: function (e) {
    	this.transX =this.point(e).x - this.pointX;
    	this.transY =this.point(e).y - this.pointY;
    	this.moving(this.transX,this.transY);
        e.stopPropagation();
        e.preventDefault();
    },
    touch_end: function (e) {
    	if(e.touches.length){return 0;}
    	var time = new Date();
		this.etime = time.getTime() - this.etime;
		var X = this.transX;
    	var Y = this.transY;
    	var vX = X/this.etime*this.degree;
    	var vY = Y/this.etime*this.degree;
    	if((Y > this.degreeY)||( vY >this.degreeY)) {
    		this.Y_dir= -1;
    	}else if((Y < -this.degreeY)||( vY < -this.degreeY)){	
    		this.Y_dir= 1;
    	}
    	if((X < -this.degreeX)|| (vX < -this.degreeX)){
    		this.X_dir = 1;
    	}else if((X > this.degreeX)|| (vX > this.degreeX)){ 
    		this.X_dir = -1;
    	}
        this.over();
    },
    point:function(e){ 
    	var _x = 0;
    	var _y = 0;
    	if(this.isIE){ 
    		_x = e.pageX;
    		_y = e.pageY;
    	}else{ 
    		_x = e.touches[0].pageX;
    		_y = e.touches[0].pageY;
    	}
    	return {x:_x,y:_y}
    },
    //单指手势处理
	over:function(){
		if(this.Y_dir){this.SlideY(this.Y_dir);}
		if(this.X_dir){this.SlideX(this.X_dir);}
		this.X_dir = this.Y_dir = this.etime = this.transX = this.transY = 0;
    },
    //记录手势
    SlideY:function(dir){},
    SlideX:function(dir){},
    moving:function(x,y){},
}