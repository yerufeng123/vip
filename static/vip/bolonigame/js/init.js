// JavaScript Document
'use strict';

$(document).ready(function(e) {
	document.addEventListener("touchmove",function(e){e.preventDefault()})
	inti();
	var range = game._width - game.gold_width;
	//开始游戏
        //if(game.play){ 
           //game_star();
        //}
	//监听判断是否接住金币的事件
	document.addEventListener("webkitTransitionEnd", function(e,range){ 
		if(e.target.id=="gold"){
			$(e.target).remove();
			game._fly = false;
			insertNode(range);
		}
		if(game.over){ 
			gameOver();
		}
	})
	document.addEventListener("transitionEnd", function(e){ 
		if(e.target.id=="gold"){
			$(e.target).remove();
			game._fly = false;
			insertNode(range);
		}
		if(game.over){ 
			gameOver();
		}
	})
	
	$("#stage").on("touchstart",function(){ 
		if(game._fly){ return false;}
		var gold = $("#gold");
		var _text =gold.css("-webkit-transform");
		var val = _text.split(',');
		if(getGold(gold,val[4])){
			gold.css("bottom","80%");
			if(game.rec_val){ 
				game._sore2 += 1;
			}else{ 
				game._sore1 += 1;
			}
		}else{ 
			gold.css("bottom","100%");
		}
		gold.removeClass("move");
		
		gold.css("left",val[4]+"px");
		game._fly = true;
	})
        //修改开始 04-22
	//加载背景音乐
	if(game.bg_audio){ 
		var _audio = document.createElement("audio");
		_audio.loop = 'loop';
		_audio.src = game.bg_audio;
		game.bg_audio = _audio;
		audio_on(game.bg_audio);
	}
//修改开始 04-22
});
function inti(){ 
	game._width = $("#stage").width();
	//game.j_height = 20;
	//game.l_height = $("#stage").height() + game.gold_height;
}
//游戏开始初始化
function game_star(){
        var range = game._width - game.gold_width;
	game._fly = false;
	game.over = false;
	game.timeout = 60;
	insertNode(range);
	count_down();
	game._time = setInterval(function(){ 
		if(game._fly){return false;}
		game.rec_val = (++game.rec_val)%2;
		$("#receive").attr("value",game.rec_val);
	}, game._interval)
}
//判断是否可以被接住
function getGold(that,gold_l){
	if(game.gold_val != game.rec_val){ 
		return false;
	}
	var index = "receive"+game.rec_val;
	var left = game[index] - gold_l;
	var re_wid = game.receive;
	var gold_wid = -game.gold_width;
	if(left<=re_wid&&left>=gold_wid){ 
		return true;
	}else{ 
		return false;
	}
}
//产生金币
function insertNode(range){
	if(game.over){ 
			console.log('1');
		gameOver();
		return false;
	}
	var _val =  Math.floor(Math.random()*2);
	game.gold_val = _val;
	var _text = "<li class=\"move\" id=\"gold\" value=\""+_val+"\" ></li>";
	$("#stage").append(_text);
	$(".gold").css("-webkit-transform","translateY(0) translateZ(0)");
}
//游戏结束
function gameOver(){ 
	clearInterval(game._time);
	$("#sore1").html(game._sore1);
	$("#sore2").html(game._sore2);
	$("#result").show();
        play(game._sore1,game._sore2);
        game.play=false;
}
//倒计时
function count_down(){ 
	if(game.timeout <= 0){game.over = true;return false;}
	setTimeout(function(){ 
		--game.timeout;
		var min = parseInt(game.timeout/60);
		var sec = game.timeout%60;
		$("#time").html(sec);
		count_down()
	}, 1000)
}

//修改开始 04-22
//播放音乐
function audio_on(_dom){ 
	_dom.play();
}
//暂停音乐
function audio_off(_dom){ 
	_dom.pause();
}
//修改结束 04-22
