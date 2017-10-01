//============================================================
//2014.11.29	胡曦	迅鸥在线
//============================================================
function Gesture(_wrap,_sign) {
    this.wrap 	= document.querySelectorAll(_wrap);
    this.dom 	= null;
    this.touchStart = "touchstart";
    this.touchMove 	= "touchmove";
    this.touchEnd 	= "touchend";
    //敏感度
    this.degreeX 	= 120;
    this.degreeY 	= 60;
    this.degree 	= 5;
    //是否滑动
    this.moveSign 	= _sign||true;
    this.transX 	= 0;
    this.transY 	= 0;
    this.pointX 	= 0;
    this.pointY 	= 0;
    this.trans 		= [];
    //状态记录
    this._left 	= 0;
    this._right = 0;
    this._top 	= 0;
    this._bottom= 0;
    this.longer = 0;
    this.deg 	= 0;
    this._spin 	= 0;
    this._zoom 	= 0;
    this._vX 	= 0;
    this._vY 	= 0;
     //Internet Explorer 10 style
    if (window.navigator.msPointerEnabled) {
	    this.touchStart    = "MSPointerDown";
	    this.touchMove     = "MSPointerMove";
	    this.touchEnd      = "MSPointerUp";
	}
}
Gesture.prototype = {
    init:function(){
    	for( var i = 0; i < this.wrap.length; i++){
    		this.wrap[i].addEventListener(this.touchStart, this.bind_fn(this,this.touch_start));
    		this.wrap[i].addEventListener(this.touchMove, this.bind_fn(this,this.touch_move))
    		this.wrap[i].addEventListener(this.touchEnd, this.bind_fn(this,this.touch_end))
			//this.addHandler(this.wrap[i],this.touchStart,this.bind_fn(this,this.touch_start));
        	//this.addHandler(this.wrap[i],this.touchMove,this.bind_fn(this,this.touch_move));
       		//this.addHandler(this.wrap[i],this.touchEnd,this.bind_fn(this,this.touch_end));
    	}
    },
    /*addHandler : function(elem,evtype,fn){
        if(elem.attachEvent){
          elem.attachEvent('on'+evtype,fn);
        }else if(elem.addEventListener){
          elem.addEventListener(evtype,fn,false);
        }else{
          elem["on"+evtype] = fn;
        }
    },*/
    bind_fn : function(obj,func){
        return function(){
            func.apply(obj,arguments);
        }
    },
    touch_start: function (e) {
    	this.dom = event.target;
    	if(e.touches.length > 1){ 
    		this.transX = e.touches[0].clientX - e.touches[1].clientX;
    		this.transY = e.touches[0].clientY - e.touches[1].clientY;
    		this.longer = Math.pow((this.transX * this.transX + this.transY * this.transY), 0.5);
    		this.deg 	= 360*Math.atan(this.transX/this.transY)/(2*Math.PI);
    	}else{ 
    		this.pointX = e.touches[0].clientX;
    		this.pointY = e.touches[0].clientY;
    	}
    },
    touch_move: function (e) {
    	if("this.moveSign"){ 
    		event.preventDefault();
    	}
    	if(e.touches.length > 1){ 
        	this.gesture_move(e);
        }else{ 
        	this.gesture_way(e);
        }
    },
    touch_end: function (e) {
        if(e.touches.length == 0){
			var X = 0;
			var Y = 0;
			var _length = this.trans.length;
			if(_length > 2){ 
				this._vX = (this.trans[_length-1].X - this.trans[_length-2].X)*this.degree;
		        this._vY = (this.trans[_length-1].Y - this.trans[_length-2].Y)*this.degree;
		        this.trans.push({"X":this._vX,"Y":this._vY});
	        	for( var i = 1; i <= _length;i++ ){ 
		        	X = this.trans[i].X;
		        	Y = this.trans[i].Y;
		        	if(Y > this.degreeY) {this._bottom= 4;}
		        	if(X > this.degreeX) {this._right = 8;}
		        	if(Y < -this.degreeY){this._top   = 1;}
		        	if(X < -this.degreeX){this._left  = 2;}
		        }
			}
	        this.gesture_over(this._top + this._right + this._bottom + this._left);
	    }
    },
    //记录滑动路线
    gesture_way:function(e){
    	this.transX = this.transY = 0;
    	var _touch  = e.touches;
		this.transX = _touch[0].clientX - this.pointX;
		this.transY = _touch[0].clientY - this.pointY;
    	this.trans.push({"X":this.transX,"Y":this.transY});
    	this.gesture_moving(this.transX,this.transY);
    },
    //单指手势处理
	gesture_over:function(_state){
		this.transT = this.transX = this.transY=this._top=this._right=this._bottom=this._left = 0;
		this.trans = [];
		switch(_state){ 
			case 14 : this.gesture_refresh(); 	break;
			case 1 	: this.gesture_top(); 		break;
			case 2 	: this.gesture_right(); 	break;
			case 4 	: this.gesture_bottom(); 	break;
			case 8 	: this.gesture_left(); 		break;
			case 12 : this.gesture_back();		break;
			case 6 	: this.gesture_forwark();	break;
			default : this.gesture_default()
		}
    },
    //多指手势处理
    gesture_move:function(e){
    	this.transX = e.touches[0].clientX - e.touches[1].clientX;
    	this.transY = e.touches[0].clientY - e.touches[1].clientY;
    	this._zoom 	= Math.pow((this.transX * this.transX + this.transY * this.transY), 0.5)/this.longer/2;
    	this.spin 	= this.deg - 360*Math.atan(this.transX/this.transY)/(2*Math.PI);
    	this.gestures(this._zoom.toFixed(2),this.spin.toFixed(0))
    },
    //记录手势
	gestures:function(zoom,spin){},
    gesture_left:function(){},
    gesture_right:function(){},
    gesture_top:function(){}, 
    gesture_bottom:function(){},
    gesture_back:function(){},
    gesture_forwark:function(){},
    gesture_refresh:function(){},
    gesture_default:function(){},
    gesture_moving:function(x,y){},
}