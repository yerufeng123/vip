// JavaScript Document
'use strict';
var game = {
	_width  :0,			//场景宽度
	j_height:0,			//判定高度
	l_height:0, 		//离开高度
	gold_width : 50,	//炸弹的宽度
	gold_height: 81,	//炸弹的高度
	receive_left: 0,	//左距离
	receive_width : 118,//饭盒的宽度
	receive_height: 55,//饭盒的高度
	num 	:0,			//页面中物品的个数
	level 	:1, 		//难度等级
	_interval : 0,	 	//出现金币间隔
	over 	  : false,	//游戏是否结束
	_sorc 	:0,			//分数
	_max 	:0,			//最高分数
	_id 	:"",		//用户ID
	timeout :300,    	//结束时间
	bg_audio:"/static/vip/licai/video/bg.mp3",//背景音乐
    coin_audio:"/static/vip/licai/video/goldCollection.mp3",//硬币音乐
    ding:null,//定时器
	};
$(document).ready(function(e) {
	document.addEventListener("touchmove",function(e){e.preventDefault();})
	game._width = $("#stage").width();
	game.j_height = $("#stage").height() - 120;
	game.l_height = $("#stage").height() + game.gold_height;
	$("#receive").width(game.receive_width);
	$("#receive").height(game.receive_height);
	//var range = game._width - game.gold_width;
	var slide = new Slide("#wrap");
	$("#false .draw").bind("click",function(){ 
		$("#false").hide();
		$("#share").show();
	})
	$("#share").bind("click",function(){ 
		$("#mask").hide();
		$(this).hide();
	})
	slide.moving = function(para){ 
		receive_position(para.dx)
	}
	//监听判断是否接住金币的事件
	document.addEventListener("webkitTransitionEnd", function(e){
		var target = e.target;
		var className = target.className;
		if(className=="gold pass"){ 
			target.remove();
			return false;
		}
		if(className=="gold"){ 
			getGold(target);
		}
		if(className == "feng show"){ 
			target.remove();
		}
	})
	document.addEventListener("transitionEnd", function(e){
		var target = e.target;
		var className = target.className;
		if(className=="gold pass"){ 
			target.remove();
			return false;
		}
		if(className=="gold"){ 
			getGold(target);
		}
		if(className == "feng show"){ 
			target.remove();
		}
	})
	var _audio = document.createElement("audio");
	_audio.loop = 'loop';
	_audio.src = game.bg_audio;
	_audio.addEventListener("canplaythrough", function(){ 
		audio_on(_audio);
	})
     
    show_number();
});
//游戏开始初始化
function game_star(){
	var range = game._width - game.gold_width;
	if(game._sorc > game._max){ 
		game._max = game._sorc;
	}
	game.over = false;
	game._sorc = 0;
	game._interval = 500;
	game.level = 1;
	$("#stage").attr("speed",game.level);
	$("#sore").text(game._sorc);
	insertNode(range);
	//间隔时间之后产生金币
	if(upspeed){ 
		clearInterval(upspeed);
	}
	var upspeed = setInterval(function(){ 
		if(game.level >= 3){ 
			clearInterval(upspeed);
		}
		$("#stage").attr("speed",++game.level);
		game._interval= game._interval*.8;
	},25000)
    
    function hello(){
        alert("hello");
    }
    
    //window.setTimeout(gameOver,500000);
    var t=30;
    function showLogin()
    {
        t--;

       // alert(c++);
        show_time();
        if (t < 0) {
            gameOver();
        } else {
            $("#mtimer").text(t);
        }
        
    }
    game.ding=setInterval(showLogin,"1000");
    window.onload=game.ding;
}
//判断是否可以被接住
function getGold(that){
	if(game.over){
		$(that).addClass("pass");
		$(that).css("-webkit-transform","translateY("+game.l_height+"px) translateZ(0)");
		return false;
	}
	var _value = parseInt($(that).attr("value"));
	var gold_left = parseInt($(that).css("left"));
	var sore = 0;
	var _left = gold_left - game.receive_left;
	if(_left > -game.gold_width && _left < game.receive_width){

		$(".feng").show(500);
		$(that).remove();
		if(_value ==1){
			sore = 5;
		}else if(_value ==2){
			sore = 10;
		}else if(_value ==3){
			sore = 20;
		}else{
            /*
			game.over = true; 
			gameOver(false);
			return false;
             */
		}
		game._sorc += sore;
		//show_sore(sore,gold_left);
        /*
		if(game._sorc >= 1000){
			game.over = true; 
			gameOver(true);
		}
         */
		$("#sore").text(game._sorc);
	}else{
		$(that).addClass("pass");
		$(that).css("-webkit-transform","translateY("+game.l_height+"px) translateZ(0)");
	}
}
//显示分数
function show_sore(_sore,left){ 
	var _text = "<div class=\"feng\" style=\"left:"+left+"px\">+"+_sore+"</div>"
	$("#stage").append(_text);
	setTimeout(function(){ 
		$(".feng:not(.show)").addClass("show");
	},200)
}
//显示时间
function show_time(_time){
    
}


//产生金币
function insertNode(range){
	if(game.over){ 
		return false;
	}
	setTimeout(function(){ 
		var _left = Math.random()*range;
		//var _val =  Math.floor(Math.random()*(3+game.level) + 1);
        var _val;
        var tmp =  Math.floor(Math.random()*(10) + 1);
        if (tmp > 9) {
               _val = 3;
        } else if (tmp > 6) {
               _val = 2;
        } else {
               _val = 1;
        }
		var _text = "<li class=\"gold\" value=\""+_val+"\" style=\"left:"+_left+"px;top:"+"-100"+"px;\"></li>";
               
		$("#stage").append(_text);
		setTimeout(function(){ 
				if(!game.over){
					$(".gold:not(.pass)").css("-webkit-transform","translateY("+game.j_height+"px) translateZ(0)");
				}
			},200)
            /*
               var alertString ="height:"+game.j_height+";"+"left:"+_left;
               alert(alertString);
             */
		insertNode(range);
	}, game._interval)	
}
//接金币的人位置
function receive_position(_left){
	game.receive_left += _left;
	var position = game.receive_left;
	if(position < 0){ 
		position = 0;
	}else if(position > game._width - game.receive_width){ 
		position = game._width - game.receive_width;
		$(".feng").show();
	}
	game.receive_left = position;
	$("#receive").css("-webkit-transform","translateX("+position+"px) translateZ(0)");
}
//游戏结束
function gameOver(flag){
	//$("#mask").show();
	$(".dialog").hide();
    /*
	if(flag){ 
		$("#success").show();
	}else{ 
		$("#false").show();
	}
	$(".gold").remove();
     */
    clearInterval(game.ding);
    gameend(game._sorc);
    //window.location.href="caifu.html";
    sessionStorage.setItem("game_score", game._sorc);
}
//播放音乐
function audio_on(_dom){ 
	_dom.play();
}

function playcoinsound(){
    //var myAuto = document.getElementById('myaudio');
    var music = new Audio();
    music.src = "/static/vip/licai/video/goldCollection.mp3";
    music.play();
    //myAuto.play();
}

//显示数字
function show_number(){
    $(".numbers").show();
    
    setTimeout(function(){
               document.getElementById("number_img").src="/static/vip/licai/img/hjy/2.png";
               },1000);
    setTimeout(function(){
               document.getElementById("number_img").src="/static/vip/licai/img/hjy/1.png";
               },2000);
    setTimeout(function(){
               $(".numbers").hide();
               //开始游戏
               game_star();
               },3000);
    
}

