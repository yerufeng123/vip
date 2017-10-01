function page_init() {
	$(".page_3_1_main").css({
		"top": ($(window).height() - $("body").width() * 1.3344) / 2 + "px"
	});
	$(".page_3_1_text").css({
		"height": $("body").width() * 0.4688 + "px",
		"line-height": $("body").width() * 0.0781 + "px",
		"top": ($(window).height() - $("body").width() * 1.3344) / 2 + $("body").width() * 0.525 + "px"
	});
	$(".page_3_1_input").css({
		"height": $("body").width() * 0.0781 + "px",
		"line-height": $("body").width() * 0.0781 + "px",
		"top": ($(window).height() - $("body").width() * 1.3344) / 2 + $("body").width() * 0.99 + "px"
	});
	$(".page_3_1_btn_box").css({
		"left": ($("body").width() - 125) / 2 + "px"
	});
	$(".page_3_1_heart").css({
		"height": $("body").width() * 0.25 + "px",
		"top": ($(window).height() - $("body").width() * 1.3344) / 2 - $("body").width() * 0.05 + "px"
	});
	$(".page_3_2_main").css({
		"top": ($(window).height() - $("body").width() * 1.2) * 0.22 + "px"
	});
	$(".page_3_2_text").css({
		"height": $("body").width() * 0.5156 + "px",
		"line-height": $("body").width() * 0.1031 + "px",
		"top": ($(window).height() - $("body").width() * 1.2) * 0.22 + $("body").width() * 0.49 + "px"
	});
	$(".page_3_2_input").css({
		"height": $("body").width() * 0.1031 + "px",
		"line-height": $("body").width() * 0.1031 + "px",
		"top": ($(window).height() - $("body").width() * 1.2) * 0.22 + $("body").width() * 1.0094 + "px"
	});
	$(".page_3_2_btn_box").css({
		"left": ($("body").width() - 125) / 2 + "px"
	});
	$(".page_3_3_main").css({
		"top": ($(window).height() - $("body").width() * 1.16) * 0.23 + "px"
	});
	$(".page_3_3_gold_box").css({
		"height": ($(window).height() - $("body").width() * 1.16) * 0.23 + $("body").width() * 0.4969 + "px"
	});
	$(".page_3_3_text").css({
		"height": $("body").width() * 0.6 + "px",
		"line-height": $("body").width() * 0.1 + "px",
		"top": ($(window).height() - $("body").width() * 1.16) * 0.23 + $("body").width() * 0.4969 + "px"
	});
	$(".page_3_3_input").css({
		"height": $("body").width() * 0.1 + "px",
		"line-height": $("body").width() * 0.1 + "px",
		"top": ($(window).height() - $("body").width() * 1.16) * 0.23 + $("body").width() * 1.0969 + "px"
	});
	$(".page_3_3_btn_box").css({
		"left": ($("body").width() - 125) / 2 + "px"
	});
	$(".page_3_4_main").css({
		"top": ($(window).height() - $("body").width() * 1.2) * 0.23 + "px"
	});
	$(".page_3_4_text").css({
		"height": $("body").width() * 0.6281 + "px",
		"line-height": $("body").width() * 0.1047 + "px",
		"top": ($(window).height() - $("body").width() * 1.2) * 0.23 + $("body").width() * 0.3453 + "px"
	});
	$(".page_3_4_input").css({
		"height": $("body").width() * 0.1047 + "px",
		"line-height": $("body").width() * 0.1047 + "px",
		"top": ($(window).height() - $("body").width() * 1.2) * 0.23 + $("body").width() * 0.9765 + "px"
	});
	$(".page_3_4_flower").css({
		"top": ($(window).height() - $("body").width() * 1.2) * 0.23 + $("body").width() * 0.01875 + "px"
	});
	$(".page_3_4_btn_box").css({
		"left": ($("body").width() - 125) / 2 + "px"
	});
	$(".page_3_pop_img").css({
		"top": ($(window).height() - $("body").width() * 0.9172) * 0.2143 + "px"
	});

	$(".page_4_main").css({
		"top": ($(window).height() - $("body").width() * 0.6063) * 0.5 + "px"
	});
	$(".page_4_tip").css({
		"top": ($(window).height() - $("body").width() * 0.6063) * 0.5 + $("body").width() * 0.5 + "px"
	});
	$(".page_4_rollbtn").css({
		"height": $("body").width() * 0.2313 + "px",
		"line-height": $("body").width() * 0.2313 + "px",
		"top": $("body").width() * 0.1156 + "px"
	});
	$(".page_5_text").css({
		"transform": "scale(" + $("body").width() / 640 + ")",
		"-ms-transform": "scale(" + $("body").width() / 640 + ")",
		"-moz-transform": "scale(" + $("body").width() / 640 + ")",
		"-webkit-transform": "scale(" + $("body").width() / 640 + ")",
	});
	$(".page_6_main").css({
		"top": ($(window).height() - $("body").width() * 1) * 0.24 + "px"
	});
	$(".page_6_sec").css({
		"top": ($(window).height() - $("body").width() * 1) * 0.24 + $("body").width() * 0.34 + "px"
	});
	$(".page_7_top").css({
		"height": $("body").width() * 0.7453 + "px",
		"line-height": $("body").width() * 0.7453 + "px"
	});
}

function show_next(obj) {
	if ($(obj).hasClass("page")) {
		$(obj).hide();
	} else {
		$(obj).parents(".page").hide();
	}
	$($(obj).attr("data-destination")).show();
}

function check_num(obj) {
	var text_num = $(obj).val().length;
	if (text_num > 200) {
		$(obj).val($(obj).val().substring(0, 200));
		alert("字数不能超过200哦！！！");
	}
}

var height_test = 0;
$(document).ready(function() {
	var start_y = 0,
		end_y = 0;
	height_test = $(window).height();
	NProgress.start();
	setTimeout(function() {
		NProgress.done();
		$(".page").hide();
		$($(".page_0").attr("data-destination")).hide().stop().fadeIn();
	}, 1000);
	page_init();
	$(document).on("appear", ".page_1_newyear", function() {
		$(this).removeClass("page_1_newyear_act");
		$(this).addClass("page_1_newyear_act");
	});
	$(".page_1_newyear").appear({
		force_process: true
	});
	$(document).on("appear", ".page_1_lady", function() {
		$(this).removeClass("page_1_lady_act");
		$(this).addClass("page_1_lady_act");
	});
	$(".page_1_lady").appear({
		force_process: true
	});
	$(document).on("appear", ".choose_item", function() {
		$(this).removeClass("page_1_newyear_act");
		$(this).addClass("page_1_newyear_act");
	});
	$(".choose_item").appear({
		force_process: true
	});
	$(".page_1").on("touchstart", function(e) {
		e.preventDefault();
		start_y = e.originalEvent.targetTouches[0].clientY;
	});
	$(".page_1").on("touchmove", function(e) {
		e.preventDefault();
		end_y = e.originalEvent.targetTouches[0].clientY;
	});
	$(".page_1").on("touchend", function() {
		if (start_y - end_y > 30) {
			$(this).fadeOut();
			$($(this).attr("data-destination")).css({
				"top": "100%"
			}).show().animate({
				top: "0"
			});
		}
	});
	$(".choose_item").click(function() {
		show_next(this);
	});

	$(".page_3_1_text").focusin(function() {
		$(".page_3_1_btn_box").fadeOut();
	});
	$(".page_3_1_text").focusout(function() {
		$(".page_3_1_btn_box").fadeIn();
	});

	$(".page_3_2_text").focusin(function() {
		$(".page_3_2_ballon").fadeOut();
		$(".page_3_2_rainbow").fadeOut();
		$(".page_3_2_btn_box").fadeOut();
	});
	$(".page_3_2_text").focusout(function() {
		$(".page_3_2_ballon").fadeIn();
		$(".page_3_2_rainbow").fadeIn();
		$(".page_3_2_btn_box").fadeIn();
	});

	$(".page_3_3_text").focusin(function() {
		$(".page_3_3_btn_box").fadeOut();
	});
	$(".page_3_3_text").focusout(function() {
		$(".page_3_3_btn_box").fadeIn();
	});

	$(".page_3_4_text").focusin(function() {
		$(".page_3_4_btn_box").fadeOut();
	});
	$(".page_3_4_text").focusout(function() {
		$(".page_3_4_btn_box").fadeIn();
	});
	$(".page_3_1_text").keyup(function() {
		check_num(this);
	});
	$(".page_3_2_text").keyup(function() {
		check_num(this);
	});
	$(".page_3_3_text").keyup(function() {
		check_num(this);
	});
	$(".page_3_4_text").keyup(function() {
		check_num(this);
	});
	$(".page_3_1_btn_box input").click(function() {
		//show_next(this);
	});
	$(".page_3_2_btn_box input").click(function() {
		//show_next(this);
	});
	$(".page_3_3_btn_box input").click(function() {
		//show_next(this);
	});
	$(".page_3_4_btn_box input").click(function() {
		//show_next(this);
	});
	$(".page_btn_box_input").click(function() {
		//show_next(this);
		//setTimeout('$(".page_3_pop").click()', 2000);
	});
	$(".page_3_pop").click(function() {
		location.href = $(this).attr("href");
		//		show_next(this);
	});
	/*$(".page_4_rollbtn").click(function() {
		if (!$(this).hasClass("disabled")) {
			var r = parseInt(Math.random() * 5);
			switch (r) {
				case 0:
					$(this).attr("data-destination", "#page_5_1");
					break;
				case 1:
					$(this).attr("data-destination", "#page_5_2");
					break;
				case 2:
					$(this).attr("data-destination", "#page_5_3");
					break;
				case 3:
					$(this).attr("data-destination", "#page_5_4");
					break;
				case 4:
					$(this).attr("data-destination", "#page_5_5");
					break;
				default:
					alert("出错了哦！！！");
					break;
			}
			$(".page_4_coin").animate({
				top: "-75%",
				rotate: "360"
			}, 1000, "easeOutSine", function() {
				show_next($(".page_4_rollbtn")[0]);
			});
			$(this).addClass("disabled");
		}
	});*/
	$(".page_4_btn_box input").click(function() {
		show_next(this);
		$(".page_6_back").attr("data-destination", "#" + $(this).parents(".page").attr("id"));
	});
	//	$(".page_5_text_right_3").click(function() {
	//		$(this).prev().select();
	//		document.execCommand("Copy");
	//		alert("复制成功!!!");
	//	});

	$(document).on("appear", ".page_5_text_left_1", function() {
		$(this).removeClass("page_5_text_lefttransform");
		$(this).addClass("page_5_text_lefttransform");
	});
	$(".page_5_text_left_1").appear({
		force_process: true
	});
	$(document).on("appear", ".page_5_text_right_2", function() {
		$(this).removeClass("page_5_text_righttransform");
		$(this).addClass("page_5_text_righttransform");
	});
	$(".page_5_text_right_2").appear({
		force_process: true
	});

	$(document).on("appear", ".page_6", function() {
		$(this).find(".page_6_sec_1").removeClass("page_6_sec_1_act");
		$(this).find(".page_6_sec_1").addClass("page_6_sec_1_act");
		$(this).find(".page_6_sec_2").removeClass("page_6_sec_2_act");
		$(this).find(".page_6_sec_2").addClass("page_6_sec_2_act");
		$(this).find(".page_6_sec_3").removeClass("page_6_sec_3_act");
		$(this).find(".page_6_sec_3").addClass("page_6_sec_3_act");
		$(this).find(".page_6_sec_4").removeClass("page_6_sec_4_act");
		$(this).find(".page_6_sec_4").addClass("page_6_sec_4_act");
	});
	$(".page_6").appear({
		force_process: true
	});
	$(".page_6_back").click(function() {
		show_next(this);
	});
	$(".page_7_envelope").click(function() {
		show_next(this);
	});
});
$(window).resize(function() {
	page_init();
	if ($(window).height() < height_test) {
		$("textarea").focusin();
	} else {
		$("textarea").focusout();
	}
});