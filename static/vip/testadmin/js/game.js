// JavaScript Document
'use strict';

$(document).ready(function(e) {
	document.addEventListener("touchmove",function(e){e.preventDefault();})
	game._width = $("#stage").width();
	game.j_height = $("#stage").height() - 120;
	game.l_height = $("#stage").height() + game.gold_height;
	$("#receive").width(game.receive_width);
	$("#receive").height(game.receive_height);
	var range = game._width - game.gold_width;
	var slide = new Slide("#wrap");
	$("#false .draw").bind("click",function(){ //
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
//	//继续游戏
//	$(".contin_btn").bind("click",function(){
//		game_star();
//	})
//	//退出游戏
//	$(".quit_btn").bind("click",function(){
//		gameOver(true);
//	})
	
	//开始游戏
	//game_star();
	//监听判断是否接住金币的事件
	document.addEventListener("webkitTransitionEnd", function(e){
		var target = e.target;
		var className = target.className;
		if(className == "feng show"){ 
			$(target).remove();
		}
		if(className=="gold pass"){ 
			$(target).remove();
			return false;
		}
		if(className=="gold"){ 
			getGold(target);
		}
		
	})
	document.addEventListener("transitionEnd", function(e){
		var target = e.target;
		var className = target.className;
		if(className == "feng show"){ 
			$(target).remove();
		}
		if(className=="gold pass"){ 
			$(target).remove();
			return false;
		}
		if(className=="gold"){ 
			getGold(target);
		}
		
	})
	
});
var timer;
//游戏开始初始化
//show_number();
function game_star(){
	var range = game._width - game.gold_width;
	if(game._sorc > game._max){ 
		game._max = game._sorc;
	}
	checkplay();
	game.over = false;
	game._sorc = 0;
//	game._interval = 500;
//	game.level = 1;
	$("#stage").attr("speed",game.level);
	$("#sore").text(game._sorc);
	insertNode(range);
	//间隔时间之后产生金币
	if(upspeed){ 
		clearInterval(upspeed);
	}
	timer = setInterval("times()",1000);

	var upspeed = setInterval(function(){ 
		if(game.level > 5){ 
			clearInterval(upspeed);
		}
		if($("#stage").attr("speed") < 5){
			$("#stage").attr("speed",++game.level);
		}

		game._interval= game._interval*.8;
	},game.up_level)
}
//判断是否可以被接住
function getGold(that){
	
	var _value = parseInt($(that).attr("value"));
	var gold_left = parseInt($(that).css("left"));
	var sore = 0;
	var _left = gold_left - game.receive_left;
	if(_left > -game.gold_width && _left < game.receive_width){ 
		$(".feng").show(500);
		$(that).remove();
		if(_value ==1){
			sore = 100;
		}else if(_value ==2){
			sore = 100;
		}else if(_value ==3){
			sore = 100;
		}else if(_value ==4){
			sore = 100;
		}else{
			sore = 100;
			/*game.over = true; 
			gameOver(false);
			return false;*/
		}
		game._sorc += sore;
		show_sore(sore,gold_left);
		//大于1000分结束
		/*if(game._sorc >= 1000){
			game.over = true; 
			gameOver(true);
		}*/
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

//倒计时
function times(){
   var num = $("#mtimer").html();
       //到0是停止计时
       if(num <= 0){
       		game.over = true; 
			gameOver(true);
       		
          clearInterval(timer);
        return 0;
           }
        $("#mtimer").html(--num);
    }


//产生金币
function insertNode(range){
	if(game.over){ 
		return false;
	}
	setTimeout(function(){ 
		var _left = Math.random()*range;
		var _val =  Math.floor(Math.random()*(3+game.level) + 1);
		var _text = "<li class=\"gold\" value=\""+_val+"\" style=\"left:"+_left+"px;\"></li>";
		$("#stage").append(_text);
		setTimeout(function(){ 
				if(!game.over){
					$(".gold:not(.pass)").css("-webkit-transform","translateY("+game.j_height+"px)");
				}
			},200)
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

//播放音乐
function audio_on(_dom){ 
	_dom.play();
}

//显示数字
function show_number(){
    $(".numbers").show();
    
    setTimeout(function(){
               document.getElementById("number_img").src="/static/vip/strasbourg/img/2.png";
               },1000);
    setTimeout(function(){
               document.getElementById("number_img").src="/static/vip/strasbourg/img/1.png";
               },2000);
    setTimeout(function(){
               $(".numbers").hide();
               //开始游戏
               game_star();
             
               },3000);
}

