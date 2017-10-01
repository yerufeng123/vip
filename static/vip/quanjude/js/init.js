// JavaScript Document
'use strict';
$(document).ready(function(e) {
	document.addEventListener("touchmove",function(e){e.preventDefault()})
	init();
	//开始游戏
	game_star();
	//监听判断是否接住金币的事件
	document.addEventListener("webkitTransitionEnd", function(e){ 
		var that = $(e.target);
		if(that.hasClass('boat')){
			that.remove();
			if($('.boat').length == 0){
				gameOver(game._sore);
			}
			return false;
		}
		if(that.hasClass('pass')){ 
			that.remove();
			return false;
		}
		if(that.hasClass('food_fly')){
			if(getGold(that)){
				$('#sore').html(game._sore);
				that.remove();
			}
		}
		if(that.hasClass('feng show')){ 
			that.remove();
		}
		
	})
	document.addEventListener("transitionEnd", function(e){ 
		var that = $(e.target);
		var classList = e.target.className;
		if(that.hasClass('boat')){
			that.remove();
			if($('.boat').length == 0){
				gameOver(game._sore);
			}
			return false;
		}
		if(that.hasClass('pass')){ 
			that.remove();
			return false;
		}
		if(that.hasClass('food_fly')){
                    
			if(getGold(that)){
                            
				$('#sore').html(game._sore);
				that.remove();
			}
		}
		if(that.hasClass('feng show')){ 
			that.remove();
		}
	})
	
	$(".boat").live("touchstart",function(e){
                if(e.touches.length>1){ 
                    return false;
                }
		var gold = $(this);
		if(gold.hasClass('click')){ 
			return false;
		}
		var _text =gold.css("-webkit-transform");
		var val = _text.split(',');
		gold.addClass('click');
		_text = '<img src="/static/vip/quanjude/img/food.png" class="food_fly" style="left:'+(val[4]-90)+'px">';
		$("#stage").append(_text);
		setTimeout(function(){ 
			$('.food_fly').last().css('bottom',game.j_height+"px")
		},50)
	})

	var _audio = document.createElement("audio");
	_audio.loop = 'loop';
	_audio.src = game.bg_audio;
	_audio.addEventListener("canplaythrough", function(){ 
		_audio.play();
	})


});
function init(){ 
	game._height = $("#stage").height();
	game.j_height = game._height - game.j_height;
	//game.l_height = $("#stage").height() + game.gold_height;		//修改04-22
}
//游戏开始初始化
function game_star(){
	game.over = false;
	game.timeout = 40;
        game._sore= 0;
        $('#sore').html(0);
	insertNode();
	count_down();
	game._time = setInterval(function(){ 
		if(game._fly){return false;}
		if(game.rec_val){
			game.rec_val = 0;
			$("#receive1").addClass('mouth');
			$("#receive2").removeClass('mouth');
		}else{
			game.rec_val = 1;
			$("#receive1").removeClass('mouth');
			$("#receive2").addClass('mouth');
		}
		
		$("#receive").attr("value",game.rec_val);
	}, game._interval)
}
//判断是否可以被接住
function getGold(that){
	var index = "receive" + game.rec_val;
	var min = game[index] - game.gold_width;
	var max = game[index] + game.receive;
	var gold_l = that.css('left');
	gold_l = parseInt(gold_l);
	if((gold_l<=max)&&(gold_l>=min)){
		$('#eat')[0].play();
		var _sore = game.gold_sore;
		show_sore(_sore,gold_l)
		game._sore = game._sore+_sore;
		return true;
	}else{ 
		that.css('bottom','-50px')
		return false;
	}
}
//产生金币
function insertNode(){
	if(game.over){ 
		return false;
	}
	//var _time = Math.random()*2000+1500;
	var _time = Math.random()*500+800;
	//var _bottom = Math.random()*10 + 30;
	var _text = '<div class="boat"></div>';
	$("#stage").append(_text);
	setTimeout(function(){ 
		insertNode()
	},_time);
	setTimeout(function(){ 
			$('.boat').last().addClass('move')
		},50)
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
//显示分数
function show_sore(_sore,left){ 
	var _text = "<div class=\"feng\" style=\"left:"+left+"px\">+"+_sore+"</div>"
	$("#stage").append(_text);
	setTimeout(function(){ 
		$(".feng").addClass("show");
	},200)
}