//============================================================
//2014.11.29	胡曦	迅鸥在线
//============================================================
function Slide(_wrap,_sign) {
    this.wrap = document.querySelectorAll(_wrap);
    this.dom = null;
    //敏感度
    this.degreeX = 120;
    this.degreeY = 30;
    this.degreeT = 100;
    //是否滑动
    this.moveSign = _sign||false;
    this.transT = 0;
    this.transX = 0;
    this.transY = 0;
    this.trans = [];
    this.point = 0;
    this.longer = 0;
    this.deg = 0;
    //状态记录
    this._left = 0;
    this._right = 0;
    this._top = 0;
    this._bottom = 0;
    this._spin = 0;
    this._zoom = 0;
}
Slide.prototype = {
    init:function(){
    	for( var i = 0; i < this.wrap.length; i++){
			this.addHandler(this.wrap[i],"touchstart",this.bind_fn(this,this.touch_start));
        	this.addHandler(this.wrap[i],"touchmove",this.bind_fn(this,this.touch_move));
       		this.addHandler(this.wrap[i],"touchend",this.bind_fn(this,this.touch_end));
    	}
        this.addHandler(document,"touchmove",function(){ 
        	event.preventDefault();
        });
    },
    addHandler : function(elem,evtype,fn){
        if(elem.attachEvent){
          elem.attachEvent('on'+evtype,fn);
        }else if(elem.addEventListener){
          elem.addEventListener(evtype,fn,false);
        }else{
          elem["on"+evtype] = fn;
        }
    },
    bind_fn : function(obj,func){
        return function(){
            func.apply(obj,arguments);
        }
    },
    touch_start: function (e) {
    	++this.point;
    	this.dom = event.target;
    	this.gesture_way(e);
    	if(e.touches.length > 1){ 
    		var _length = this.trans.length;
    		this.transX = this.trans[_length-2].X - this.trans[_length-1].X;
    		this.transY = this.trans[_length-2].Y - this.trans[_length-1].Y;
    		this.longer = Math.pow((this.transX * this.transX + this.transY * this.transY), 0.5);
    		this.deg =360*Math.atan(this.transX/this.transY)/(2*Math.PI);
    	}
        var now = new Date();
        this.transT = now.getTime();
    },
    touch_move: function (e) {
    	this.gesture_way(e);
    	var pre = this.trans[this.trans.length-2];
    	this.transX -= pre.X;
    	this.transY -= pre.Y;
    	if(this.moveSign){ 
    		this.gesture_moving(this.transX,this.transY);
    	}
        //是否多指手势
        if(e.touches.length > 1){ 
        	this.gesture_move(e);
        }
    },
    touch_end: function (e) {
        if(this.point<2){
        	var now = new Date();
			var X = 0;
			var Y = 0;
			var _degreeY = this.degreeY;
			var _degreeX = this.degreeX;
			this._top =this._right = this._left = this._bottom =0;
	        this.transT = now.getTime() - this.transT;
	        if(this.transT < this.degreeT){ 
	        	_degreeY = _degreeY/3;
	        	_degreeX = _degreeX/3;
	        }
        	for( var i = 1; i < this.trans.length;i++ ){ 
	        	X = this.trans[0].X-this.trans[i].X;
	        	Y = this.trans[0].Y-this.trans[i].Y;
	        	if(Y > _degreeY){this._top = 1;}
	        	if(X > _degreeX){this._right = 1000;}
	        	if(Y < -_degreeY){this._bottom = 100;}
	        	if(X < -_degreeX){this._left = 10;}
	        }
	        this.gesture_over(this._top + this._right + this._bottom + this._left);
	    }
		if(e.touches.length == 0){ 
			this.point = this.transT = this.transX = this.transY=this._top=this._right=this._bottom=this._left = 0;
			this.trans = [];
		}
    },
    //记录滑动路线
    gesture_way:function(e){
    	this.transX = this.transY = 0;
    	var _touch = e.touches;
    	if(_touch.length){
        	for ( var i = 0; i < _touch.length; i++) {
        		this.transX += _touch[i].screenX;
        		this.transY += _touch[i].screenY;
        	}
        	this.transX = this.transX/i;
        	this.transY = this.transY/i;
        }
        this.trans.push({"X":this.transX,"Y":this.transY});
    },
    //单指手势处理
	gesture_over:function(_state){
		switch(_state){ 
			case 1110 : this.gesture_refresh(); break;
			case 1 : this.gesture_top(); break;
			case 10 : this.gesture_right(); break;
			case 100 : this.gesture_bottom(); break;
			case 1000 : this.gesture_left(); break;
			case 1100 : this.gesture_back();break;
			case 110 : this.gesture_forwark();break;
			default : this.gesture_default()
		}
    },
    //多指手势处理
    gesture_move:function(e){
    	this.transX = e.touches[0].screenX - e.touches[1].screenX;
    	this.transY = e.touches[0].screenY - e.touches[1].screenY;
    	this._zoom = Math.pow((this.transX * this.transX + this.transY * this.transY), 0.5)/this.longer/2;
    	this.spin = this.deg - 360*Math.atan(this.transX/this.transY)/(2*Math.PI);
    	this.gestures(this._zoom.toFixed(2),this.spin.toFixed(0))
    },
    //记录手势
	gestures :function(zoom,spin){},
    gesture_left:function(){},
    gesture_right:function(){},
    gesture_top:function(){}, 
    gesture_bottom:function(){},
    gesture_back:function(){},
    gesture_forwark:function(){},
    gesture_refresh:function(){},
    gesture_default:function(){},
    gesture_moving:function(x,y){}
}