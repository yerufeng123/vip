var current_page, loader_text_interval, calendar_index = 0,
	draw_count = 100,
	allow_rolling = true,
	draw_random,
	score = 0,
	correct_answer = [1, 2, 2, 1, 0, 1],
	user_answer = [3, 3, 3, 3, 3, 3],
	bonus_list = [10, 50, 20, 0, 10, 30, 20, 0];

function pageinit() {
	$(".page").css({
		"width": $(window).width() + "px",
		"height": $(window).height() + "px"
	});
	$(".question_title").css({
		"height": $(window).width() * 0.204 + "px",
		"line-height": $(window).width() * 0.204 + "px"
	});
	$(".animation_box").css({
		"height": $(window).width() * 0.501 + "px"
	});
	$(".question_box").css({
		"transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-ms-transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-moztransform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-webkit-transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)"
	});
	$(".tip_hand_1").css({
		"top": $(window).height() * 0.09 + $(window).width() * 0.2947 + "px"
	});
	$(".tip_hand_2").css({
		"top": $(window).height() * 0.09 + $(window).width() * 0.811 + "px"
	});
	$(".tip_hand_3").css({
		"top": $(window).height() * 0.09 + $(window).width() * 0.6827 + "px"
	});
	$(".tip_hand_4").css({
		"top": $(window).height() * 0.09 + $(window).width() * 1.228 + "px"
	});
	$(".tip_hand_5").css({
		"top": $(window).height() * 0.09 + $(window).width() * 0.707 + "px"
	});
	$(".tip_hand_6").css({
		"top": $(window).height() * 0.09 + $(window).width() * 0.3 + "px"
	});
	if ($(window).height() / $(window).width() < 1.7) {
		$(".tip_main").css({
			"width": "70%",
			"left": "15%",
			"top": "6%"
		});
		$(".tip_hand_1").css({
			"top": $(window).height() * 0.06 + $(window).width() * 0.2947 * 0.921 + "px"
		});
		$(".tip_hand_2").css({
			"top": $(window).height() * 0.06 + $(window).width() * 0.811 * 0.921 + "px"
		});
		$(".tip_hand_3").css({
			"top": $(window).height() * 0.06 + $(window).width() * 0.6827 * 0.921 + "px"
		});
		$(".tip_hand_4").css({
			"top": $(window).height() * 0.06 + $(window).width() * 1.228 * 0.921 + "px"
		});
		$(".tip_hand_5").css({
			"top": $(window).height() * 0.06 + $(window).width() * 0.707 * 0.921 + "px"
		});
		$(".tip_hand_6").css({
			"top": $(window).height() * 0.06 + $(window).width() * 0.3 * 0.921 + "px"
		});
	}

	$(".page_12_animation_part_2").css({
		"line-height": $(window).width() * 0.064 + "px"
	});
	$(".result_btnbox").css({
		"top": $(window).width() * 1.17 + "px"
	});
	$(".btn_zhanshu").css({
		"top": $(window).width() * 1.33 + "px"
	});
	$(".draw_box").css({
		"transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-ms-transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-moztransform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-webkit-transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)"
	});
	$(".bonus_pop_content").css({
		"transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-ms-transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-moztransform": "scale(" + $(window).width() / 750 + ") translateZ(0px)",
		"-webkit-transform": "scale(" + $(window).width() / 750 + ") translateZ(0px)"
	});
}

function add_animation(obj) {
	$(obj).find(".will_animate").each(function() {
		$(this).removeClass($(this).attr("animation-class"));
	});
	$(obj).find(".will_animate").each(function() {
		$(this).addClass($(this).attr("animation-class"));
	});
}

function page_special(obj) {}

function page_special_remove(obj) {}

function page_6_calendar() {
	$(".page_6_calendar img").eq(calendar_index).hide();
	calendar_index = calendar_index + 1 > $(".page_6_calendar img").length - 1 ? 0 : calendar_index + 1;
	$(".page_6_calendar img").eq(calendar_index).fadeIn();
}

function page_12_mile() {
	$(".page_12_animation_part_2").text(parseInt($(".page_12_animation_part_2").text()) + 3 > 600 ? 0 : parseInt($(".page_12_animation_part_2").text()) + 3);
}

function correct_count() {
	score = 0;
	$.each(correct_answer, function(i, v) {
		if (user_answer[i] == v) {
			score++;
		}
	});
	if (score <= 3) {
		$(".btn_complete").attr("data-destination", "#page_16");
		$(".page_13").attr("page-jump", "#page_16");
	} else if (score <= 5) {
		$(".btn_complete").attr("data-destination", "#page_15");
		$(".page_13").attr("page-jump", "#page_15");
	} else if (score == 6) {
		$(".btn_complete").attr("data-destination", "#page_14");
		$(".page_13").attr("page-jump", "#page_14");
	}
}



function drawroll(i) {
	draw_count = draw_count + 20;
	var draw_index;
	if (i < 7) {
		draw_index = i + 1;
	} else {
		draw_index = 0;
	}
	if (draw_count > 300 && draw_index == draw_random) {
		setTimeout(function() {
			$(".draw_flight_box img").eq(i).hide();
			$(".draw_flight_box img").eq(draw_index).show();
			if (bonus_list[draw_index] != 0) {
				$(".bonus_pop").fadeIn();
				$(".bonus_pop_ammount").text(bonus_list[draw_index]);
			} else {
				alert("很遗憾啊！没中奖");
			}
		}, draw_count);
	} else {
		setTimeout(function() {
			$(".draw_flight_box img").eq(i).hide();
			$(".draw_flight_box img").eq(draw_index).show();
			drawroll(draw_index);
		}, draw_count);
	}

}

$(window).load(function() {
	$("audio").each(function() {
		this.play();
		this.pause();
	});
	if ($(".music_btn").hasClass("music_play")) {
		$(".bgm")[0].play();
	}
	$(".loader_inner").stop().animate({
		width: "100%"
	}, 1000);
	setTimeout(function() {
		$(".page_0_hideclick").click();
		clearInterval(loader_text_interval);
	}, 1000);
});
$(document).ready(function() {
	var touch_sy = 0,
		touch_ey = 0;
	pageinit();
	$(".loader_inner").animate({
		width: "98%"
	}, 3000);
	loader_text_interval = setInterval(function() {
		$(".loader_text").text(parseInt($(".loader_inner").width() / $(".loader").width() * 100) + "%");
	}, 50);
	var calendar_interval = setInterval(function() {
		page_6_calendar();
	}, 1000);
	var mile_interval = setInterval(function() {
		page_12_mile();
	}, 50);
	$(".clickjump").click(function() {
		if (!$(this).hasClass("jumpdisable")) {
			var thispage;
			if ($(this).hasClass("page")) {
				thispage = $(this);
			} else {
				thispage = $(this).parents(".page");
			}
			if ($(this).hasClass("immediately")) {
				thispage.hide();
				$($(this).attr("data-destination")).show();
			} else {
				thispage.fadeOut();
				$($(this).attr("data-destination")).fadeIn();
			}
			if ($(this).hasClass("once")) {
				$(this).addClass("jumpdisable");
			}
			var obj = $($(this).attr("data-destination"))[0];
			page_special_remove(thispage[0]);
			add_animation(obj);
			page_special(obj);
			current_page = obj;
		}
	});

	$(document).on("touchstart", ".slidepage", function(e) {
		e.preventDefault();
		touch_sy = e.originalEvent.targetTouches[0].clientY;
		touch_ey = e.originalEvent.targetTouches[0].clientY;
	});
	$(document).on("touchmove", ".slidepage", function(e) {
		e.preventDefault();
		touch_ey = e.originalEvent.targetTouches[0].clientY;
	});
	$(document).on("touchend", ".slidepage", function(e) {
		e.preventDefault();
		var obj;
		if (touch_sy - touch_ey > 50) {
			$(this).animate({
				top: "-100%"
			}, 500, function() {
				$(this).css({
					"display": "none",
					"top": 0
				});
			});
			$($(this).attr("page-jump")).css({
				"display": "block",
				"top": "100%"
			}).stop().animate({
				top: "0"
			}, 500);
			obj = $($(this).attr("page-jump"))[0];
			page_special_remove($(this)[0]);
			add_animation(obj);
			page_special(obj);
			current_page = obj;
		}else if(touch_ey - touch_sy > 50){
			$(this).animate({
				top: "100%"
			}, 500, function() {
				$(this).css({
					"display": "none",
					"top": 0
				});
			});
			$(this).prev().css({
				"display": "block",
				"top": "-100%"
			}).stop().animate({
				top: "0"
			}, 500);
			obj = $(this).prev()[0];
			page_special_remove($(this)[0]);
			add_animation(obj);
			page_special(obj);
			current_page = obj;
		}
	});

	$(document).on("touchend", ".music_btn", function(e) {
		if ($(this).hasClass("music_play")) {
			$(this).removeClass("music_play").addClass("music_pause");
			$(".bgm")[0].pause();
		} else {
			$(this).removeClass("music_pause").addClass("music_play");
			$(".bgm")[0].play();
		}
	});

	$(".question_selection").click(function() {
		user_answer[parseInt($(this).parent().attr("question-index"))] = $(this).index();
		$(this).addClass("selected").siblings().removeClass("selected");
		$(this).parents(".page").find(".question_btn img").removeClass("jumpdisable");
		correct_count();
	});

	
	

	//绑后台时要删掉，这里点击分享蒙层直接跳到抽奖页面
	$(".share_pop").click(function() {
		$('.share_pop').hide();
	});


	$(".draw_start").click(function() {
		if (allow_rolling) {
			$.post('/airchina/ajaxlottery',{'score':score},function(data){
				var list=eval(data);
				if(list.code != '10000'){
					alert(list.result);
					return false;
				}else{
					if(list.result.type=='4'){
						draw_random =1;
					}else if(list.result.type=='1'){
						if(parseInt(Math.random() * 8)%2 == 0){
							draw_random =0;
						}else{
							draw_random =4;
						}
					}else if(list.result.type=='2'){
						if(parseInt(Math.random() * 8)%2 == 0){
							draw_random =2;
						}else{
							draw_random =6;
						}
					}else if(list.result.type=='3'){
							draw_random =5;
					}else{
						if(parseInt(Math.random() * 8)%2 == 0){
							draw_random =3;
						}else{
							draw_random =7;
						}
						
					}
					$('.bonus_pop_code').text(list.result.number);
					draw_count = 100;
					drawroll(0);
					allow_rolling = false;
				}
			},'json');
			
		} else if (!allow_rolling) {
			alert("抽过奖品了哦");
		}
	});

	$(".draw_record").click(function() {
		if (allow_rolling) {
			alert("您尚未抽奖哦");
		} else if (!allow_rolling) {
			if(draw_random == 3 || draw_random ==7){
				alert('没有中奖记录');
			}else{
				$(".bonus_pop").fadeIn();
			}
		}
	});
	$(".bonus_pop_close").click(function() {
		$(this).parents(".bonus_pop").fadeOut();
	});
        $(document).on("touchstart",".page_1_sectitle",function(e){
		e.stopPropagation();
		e.preventDefault();
		$(".page_1_hideclick").click();
	});
});
$(window).resize(function() {
	pageinit();
});