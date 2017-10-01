var current_page;
var d_width = 640,
	d_height = 960,
	loaded = 0;

function page_init() {
	$(".page").css({
		"width": $(window).width() + "px",
		"height": $(window).height() + "px"
	});
	$(".page_outer").css({
		"height": ($(window).height() / $(window).width() > d_height / d_width ? $(window).height() : $(window).width() * d_height / d_width) + "px",
		"width": ($(window).height() / $(window).width() > d_height / d_width ? $(window).height() * d_width / d_height : $(window).width()) + "px",
		"top": ($(window).height() - ($(window).height() / $(window).width() > d_height / d_width ? $(window).height() : $(window).width() * d_height / d_width)) / 2 + "px",
		"left": ($(window).width() - ($(window).height() / $(window).width() > d_height / d_width ? $(window).height() * d_width / d_height : $(window).width())) / 2 + "px"
	});
	$(".page_inner").css({
		"height": ($(window).height() / $(window).width() > d_height / d_width ? $(window).width() * d_height / d_width : $(window).height()) + "px",
		"width": ($(window).height() / $(window).width() > d_height / d_width ? $(window).width() : $(window).height() * d_width / d_height) + "px",
		"top": ($(window).height() - ($(window).height() / $(window).width() > d_height / d_width ? $(window).width() * d_height / d_width : $(window).height())) / 2 + "px",
		"left": ($(window).width() - ($(window).height() / $(window).width() > d_height / d_width ? $(window).width() : $(window).height() * d_width / d_height)) / 2 + "px"
	});
	$(".sizetransform").css({
		"transform": "scale(" + $(window).width() / d_width + ") translateZ(0px)",
		"-ms-transform": "scale(" + $(window).width() / d_width + ") translateZ(0px)",
		"-moz-transform": "scale(" + $(window).width() / d_width + ") translateZ(0px)",
		"-webkit-transform": "scale(" + $(window).width() / d_width + ") translateZ(0px)"
	});
	$(".outer_sizetransform").css({
		"transform": "scale(" + ($(window).height() / $(window).width() > d_height / d_width ? $(window).height() * d_width / d_height : $(window).width()) / d_width + ") translateZ(0px)",
		"-ms-transform": "scale(" + ($(window).height() / $(window).width() > d_height / d_width ? $(window).height() * d_width / d_height : $(window).width()) / d_width + ") translateZ(0px)",
		"-moz-transform": "scale(" + ($(window).height() / $(window).width() > d_height / d_width ? $(window).height() * d_width / d_height : $(window).width()) / d_width + ") translateZ(0px)",
		"-webkit-transform": "scale(" + ($(window).height() / $(window).width() > d_height / d_width ? $(window).height() * d_width / d_height : $(window).width()) / d_width + ") translateZ(0px)"
	});
	$(".inner_sizetransform").css({
		"transform": "scale(" + ($(window).height() / $(window).width() > d_height / d_width ? $(window).width() : $(window).height() * d_width / d_height) / d_width + ") translateZ(0px)",
		"-ms-transform": "scale(" + ($(window).height() / $(window).width() > d_height / d_width ? $(window).width() : $(window).height() * d_width / d_height) / d_width + ") translateZ(0px)",
		"-moz-transform": "scale(" + ($(window).height() / $(window).width() > d_height / d_width ? $(window).width() : $(window).height() * d_width / d_height) / d_width + ") translateZ(0px)",
		"-webkit-transform": "scale(" + ($(window).height() / $(window).width() > d_height / d_width ? $(window).width() : $(window).height() * d_width / d_height) / d_width + ") translateZ(0px)"
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
$(window).load(function() {
	if ($(".music_btn").hasClass("music_play")) {
		$(".bgm")[0].play();
	}
});

$(document).ready(function() {
	page_init();
	$(document).on("touchstart", ".page", function(e) {
		e.preventDefault();
		start_y = e.originalEvent.targetTouches[0].clientY;
		end_y = e.originalEvent.targetTouches[0].clientY;
	});
	$(document).on("touchmove", ".page", function(e) {
		e.preventDefault();
		end_y = e.originalEvent.targetTouches[0].clientY;
	});
	$(document).on("touchend", ".page", function(e) {
		e.preventDefault();
		var obj = '';
		if (start_y - end_y > 50 && ($(this).index() >= 0) && ($(this).index() < $(".page").length - 1) && !$(this).hasClass("slidedisable")) {
			$(this).animate({
				top: "-100%"
			}, 500, function() {
				$(this).css({
					"display": "none",
					"top": 0
				});
			});
			$(this).next().css({
				"display": "block",
				"top": "100%"
			}).stop().animate({
				top: "0"
			}, 500);
			obj = $(this).next()[0];
			page_special_remove($(this)[0]);
			add_animation(obj);
			page_special(obj);
			current_page = obj;
		} else if ((end_y - start_y > 50) && ($(this).index() >= 1) && !$(this).hasClass("slidedisable")) {
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
	$(document).on("touchend", ".p4_real_form_submit", function(e) {
		$(".pop").fadeIn();
	});
});