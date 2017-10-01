// JavaScript Document
'use strict';

$(document).ready(function(e) {
    game._width = $("#stage").width();
    game.j_height = $("#stage").height() - 90;
    game.l_height = $("#stage").height() + game.gold_height;
    $("#receive").width(game.receive_width);
    $("#receive").height(game.receive_height);
    var range = game._width - game.gold_width;
    var slide = new Slide("#stage");
    slide.moving = function(para) {
        receive_position(para.dx)
    }
    //开始游戏
    game_star();
    //监听判断是否接住金币的事件
    document.addEventListener("webkitTransitionEnd", function(e) {
        if (e.target.className == "gold pass") {
            e.target.remove();
            return false;
        }
        if (e.target.className == "gold") {
            getGold(e.target);
        }
    })
    document.addEventListener("transitionEnd", function(e) {
        if (e.target.className == "gold pass") {
            e.target.remove();
            return false;
        }
        if (e.target.className == "gold") {
            getGold(e.target);
        }
    })
    var _audio = document.createElement("audio");
    _audio.loop = 'loop';
    _audio.src = game.bg_audio;
    audio_on(_audio);

});
//游戏开始初始化
function game_star() {
    var range = game._width - game.gold_width;
    if (game._sorc > game._max) {
        game._max = game._sorc;
    }
    game.over = false;
    game._sorc = 0;
    game._interval = 500;
    game.level = 1;
    $("#stage").attr("speed", game.level);
    $("#sore").text(game._sorc);
    insertNode(range);
    //间隔时间之后产生金币
    /*
     if (upspeed) {
     clearInterval(upspeed);
     }
     var upspeed = setInterval(function() {
     if (game.level >= 3) {
     clearInterval(upspeed);
     }
     $("#stage").attr("speed", ++game.level);
     game._interval = game._interval * .8;
     }, 25000)
     */
}



//判断是否可以被接住
function getGold(that) {
    if (game.over) {
        $(that).addClass("pass");
        $(that).css("-webkit-transform", "translateY(" + game.l_height + "px) translateZ(0)");
        return false;
    }
    var _value = parseInt($(that).attr("value"));
    var gold_left = parseInt($(that).css("left"));
    var _left = gold_left - game.receive_left;
    if (_left > -game.gold_width && _left < game.receive_width) {
        $(that).remove();
        //--game.num;
        game._sorc += 10;
        if (_value > 5) {
            game.over = true;
            gameOver(false);
            $("#sore").text(game._sorc);
            return false;
        }
        if (game._sorc >= 1000) {
            game.over = true;
            gameOver(true);
            $("#sore").text(game._sorc);
            return false;
        }
        if (game._sorc == 300 || game._sorc == 600 || game._sorc == 900) {
            $("#stage").attr("speed", ++game.level);
        }
        $("#sore").text(game._sorc);

    } else {
        $(that).addClass("pass");
        $(that).css("-webkit-transform", "translateY(" + game.l_height + "px) translateZ(0)");
    }
}
//产生金币
function insertNode(range) {
    if (game.over) {
        return false;
    }
    ++game.num;
    setTimeout(function() {
        var _left = Math.random() * range;
        var _val = Math.floor(Math.random() * (5 + game.level) + 1);
        var _text = "<li class=\"gold\" value=\"" + _val + "\" style=\"left:" + _left + "px;\"></li>";
        $("#stage").append(_text);
        setTimeout(function() {
            $(".gold:not(.pass)").css("-webkit-transform", "translateY(" + game.j_height + "px) translateZ(0)");
        }, 200)
        insertNode(range);
    }, game._interval)
}
//接金币的人位置
function receive_position(_left) {
    game.receive_left += _left;
    var position = game.receive_left;
    if (position < 0) {
        position = 0;
    } else if (position > game._width - game.receive_width) {
        position = game._width - game.receive_width;
    }
    game.receive_left = position;
    $("#receive").css("-webkit-transform", "translateX(" + position + "px) translateZ(0)");
}
//游戏结束
function gameOver(flag) {
    $(".gold").remove();
    if (flag) {
        //通关
        $('#mask').show();
        $('#mask').children().hide();
        $('#sussess').show();
    } else {
        //失败
        $('#mask').show();
        $('#mask').children().hide();
        $('#false').show();
    }

}
//播放音乐
function audio_on(_dom) {
    _dom.play();
}
