var winW,
winH,
adfri = !0,
vdSupp = !0,
t1num = 1;
$(function() {
    winW = document.documentElement.clientWidth || document.body.clientWidth;
    winH = document.documentElement.clientHeight || document.body.clientHeight;
    document.body.style.width = winW + "px";
    document.body.style.height = winH + "px"
});
$(function() {
    var c = 0,
    k = 0,
    h = 0,
    e = !1,
    f = !1,
    d = $(".itemlist li"),
    g = d.length;
    $(document).bind("touchstart", 
    function(a) {
        a.stopPropagation();
        k = h = parseInt(a.touches[0].clientY);
        d.css({
            "z-index": "10",
            visibility: "hidden"
        });
        $(d.get(c)).css({
            "z-index": "20",
            visibility: "visible"
        });
        0 == c ? $(d.get(c + 1)).css({
            "z-index": "30",
            visibility: "visible",
            "-webkit-transition-duration": "0ms",
            "-webkit-transform": "translate3d(0," + winH + "px,0)",
            "-moz-transition-duration": "0ms",
            "-moz-transform": "translate3d(0," + winH + "px,0)",
            "-ms-transition-duration": "0ms",
            "-ms-transform": "translate3d(0," + winH + "px,0)",
            "-o-transition-duration": "0ms",
            "-o-transform": "translate3d(0," + winH + "px,0)",
            "transition-duration": "0ms",
            transform: "translate3d(0," + winH + "px,0)"
        }) : c == g - 1 ? $(d.get(c - 1)).css({
            "z-index": "30",
            visibility: "visible",
            "-webkit-transition-duration": "0ms",
            "-webkit-transform": "translate3d(0," + -winH + "px,0)",
            "-moz-transition-duration": "0ms",
            "-moz-transform": "translate3d(0," + -winH + "px,0)",
            "-ms-transition-duration": "0ms",
            "-ms-transform": "translate3d(0," + -winH + "px,0)",
            "-o-transition-duration": "0ms",
            "-o-transform": "translate3d(0," + -winH + "px,0)",
            "transition-duration": "0ms",
            transform: "translate3d(0," + -winH + "px,0)"
        }) : 0 < c && c < g - 1 && ($(d.get(c + 1)).css({
            "z-index": "30",
            visibility: "visible",
            "-webkit-transition-duration": "0ms",
            "-webkit-transform": "translate3d(0," + winH + "px,0)",
            "-moz-transition-duration": "0ms",
            "-moz-transform": "translate3d(0," + winH + "px,0)",
            "-ms-transition-duration": "0ms",
            "-ms-transform": "translate3d(0," + winH + "px,0)",
            "-o-transition-duration": "0ms",
            "-o-transform": "translate3d(0," + winH + "px,0)",
            "transition-duration": "0ms",
            transform: "translate3d(0," + winH + "px,0)"
        }), $(d.get(c - 1)).css({
            "z-index": "30",
            visibility: "visible",
            "-webkit-transition-duration": "0ms",
            "-webkit-transform": "translate3d(0," + -winH + "px,0)",
            "-moz-transition-duration": "0ms",
            "-moz-transform": "translate3d(0," + -winH + "px,0)",
            "-ms-transition-duration": "0ms",
            "-ms-transform": "translate3d(0," + -winH + "px,0)",
            "-o-transition-duration": "0ms",
            "-o-transform": "translate3d(0," + -winH + "px,0)",
            "transition-duration": "0ms",
            transform: "translate3d(0," + -winH + "px,0)"
        }))
    });
    $(document).bind("touchmove", 
    function(a) {
        a.stopPropagation();
        a.preventDefault();
        h = parseInt(a.touches[0].clientY);
        a = parseInt(h - k);
        0 == c ? -10 > a && !f && (e = !0, $(d.get(c + 1)).css({
            "-webkit-transform": "translate3d(0," + (winH + a) + "px,0)",
            "-moz-transform": "translate3d(0," + (winH + a) + "px,0)",
            "-ms-transform": "translate3d(0," + (winH + a) + "px,0)",
            "-o-transform": "translate3d(0," + (winH + a) + "px,0)",
            transform: "translate3d(0," + (winH + a) + "px,0)"
        })) : c == g - 1 ? 10 < a && !e && (f = !0, $(d.get(c - 1)).css({
            "-webkit-transform": "translate3d(0," + ( - winH + a) + "px,0)",
            "-moz-transform": "translate3d(0," + ( - winH + a) + "px,0)",
            "-ms-transform": "translate3d(0," + ( - winH + a) + "px,0)",
            "-o-transform": "translate3d(0," + ( - winH + a) + "px,0)",
            transform: "translate3d(0," + ( - winH + a) + "px,0)"
        })) : 0 < c && c < g - 1 && ( - 10 > a ? f || (e = !0, 0 != winH + a && $(d.get(c + 1)).css({
            "-webkit-transform": "translate3d(0," + (winH + a) + "px,0)",
            "-moz-transform": "translate3d(0," + (winH + a) + "px,0)",
            "-ms-transform": "translate3d(0," + (winH + a) + "px,0)",
            "-o-transform": "translate3d(0," + (winH + a) + "px,0)",
            transform: "translate3d(0," + (winH + a) + "px,0)"
        })) : 10 < a && !e && (f = !0, $(d.get(c - 1)).css({
            "-webkit-transform": "translate3d(0," + ( - winH + a) + "px,0)",
            "-moz-transform": "translate3d(0," + ( - winH + a) + "px,0)",
            "-ms-transform": "translate3d(0," + ( - winH + a) + "px,0)",
            "-o-transform": "translate3d(0," + ( - winH + a) + "px,0)",
            transform: "translate3d(0," + ( - winH + a) + "px,0)"
        })))
    });
    $(document).bind("touchend", 
    function(a) {
        a.stopPropagation();
        a = 0;
        if (e) {
            var b = $(d.get(c + 1));
            a = parseInt(b.css("-webkit-transform").split(/[(]|[,]|[)]/)[2]);.9 > Math.abs(a / winH) ? (b.css({
                "-webkit-transition-duration": "500ms",
                "-webkit-transform": "translate3d(0,0px,0)",
                "-moz-transition-duration": "500ms",
                "-moz-transform": "translate3d(0,0px,0)",
                "-ms-transition-duration": "500ms",
                "-ms-transform": "translate3d(0,0px,0)",
                "-o-transition-duration": "500ms",
                "-o-transform": "translate3d(0,0px,0)",
                "transition-duration": "500ms",
                transform: "translate3d(0,0px,0)"
            }), c++) : b.css({
                "-webkit-transition-duration": "500ms",
                "-webkit-transform": "translate3d(0," + winH + "px,0)",
                "-moz-transition-duration": "500ms",
                "-moz-transform": "translate3d(0," + winH + "px,0)",
                "-ms-transition-duration": "500ms",
                "-ms-transform": "translate3d(0," + winH + "px,0)",
                "-o-transition-duration": "500ms",
                "-o-transform": "translate3d(0," + winH + "px,0)",
                "transition-duration": "500ms",
                transform: "translate3d(0," + winH + "px,0)"
            });
            f = e = !1
        }
        f && (b = $(d.get(c - 1)), a = parseInt(b.css("-webkit-transform").split(/[(]|[,]|[)]/)[2]), .9 > Math.abs(a / winH) ? (b.css({
            "-webkit-transition-duration": "500ms",
            "-webkit-transform": "translate3d(0,0px,0)",
            "-moz-transition-duration": "500ms",
            "-moz-transform": "translate3d(0,0px,0)",
            "-ms-transition-duration": "500ms",
            "-ms-transform": "translate3d(0,0px,0)",
            "-o-transition-duration": "500ms",
            "-o-transform": "translate3d(0,0px,0)",
            "transition-duration": "500ms",
            transform: "translate3d(0,0px,0)"
        }), c--) : b.css({
            "-webkit-transition-duration": "500ms",
            "-webkit-transform": "translate3d(0," + -winH + "px,0)",
            "-moz-transition-duration": "500ms",
            "-moz-transform": "translate3d(0," + -winH + "px,0)",
            "-ms-transition-duration": "500ms",
            "-ms-transform": "translate3d(0," + -winH + "px,0)",
            "-o-transition-duration": "500ms",
            "-o-transform": "translate3d(0," + -winH + "px,0)",
            "transition-duration": "500ms",
            transform: "translate3d(0," + -winH + "px,0)"
        }), f = e = !1);
        0 == c ? $(".pageup").show() : c == g - 1 ? $(".pageup").hide() : 0 < c && c < g - 1 && $(".pageup").show()
    });
    $(".musicplay").bind("touchstart", 
    function(a) {
        a.stopPropagation();
        a = $(this);
        try {
            var b = $(".music").get(0)
        } catch(c) {
            alert("\u62b1\u6b49\uff0c\u60a8\u7684\u8bbe\u5907\u4e0d\u652f\u6301audio\uff01");
            return
        }
        b.paused ? a.hasClass("musicplay") ? a.removeClass("musicplay").addClass("musicpause") : (b.play(), a.removeClass("musicpause").addClass("musicplay")) : (b.pause(), a.removeClass("musicplay").addClass("musicpause"))
    });
    document.readyState;
    document.onreadystatechange = function() {
        "complete" == document.readyState && ($(".itemlist").css("display", "block"), $(".musicplay").css("display", "block"), $(".pageup").css("display", "block"), setTimeout(function() {
            $(".item01").find(".tit01").addClass("tran01");
            $(".item01").find(".tit02").addClass("tran02")
        },
        0))
    };
    $(".item01").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit01").addClass("tran01");
            b.find(".tit02").addClass("tran02")
        },
        0)
    });
    $(".item01").bind("touchstart", 
    function() {
        try {
            var a = $(".music").get(0);
            adfri && a.paused && $(document).find(".musicplay").length && a.play();
            adfri = !1
        } catch(b) {}
        a = $(".item02");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02");
        a.find(".tit04").removeClass("tran02")
    });
    $(".item02").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit01").addClass("tran01");
            b.find(".tit02").addClass("tran01");
            b.find(".tit03").addClass("tran02");
            b.find(".tit04").addClass("tran02")
        },
        0)
    });
    $(".item02").bind("touchstart", 
    function() {
        var a = $(".item01");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit02").removeClass("tran02");
        a = $(".item03");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit02").removeClass("tran01");
		a.find(".tit03").removeClass("tran02");
		a.find(".tit04").removeClass("tran01");
		a.find(".tit05").removeClass("tran01");
		a.find(".tit06").removeClass("tran01");
		a.find(".tit07").removeClass("tran01");
    });
    $(".item03").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit01").addClass("tran01");
            setTimeout(function() {
				b.find(".tit03").addClass("tran02");
            },
            500);
			setTimeout(function() {
               b.find(".tit02").addClass("tran01");
			   setTimeout(function() {b.find(".tit04").addClass("tran01");},200);
			   setTimeout(function() {b.find(".tit05").addClass("tran01");},400);
			   setTimeout(function() {b.find(".tit06").addClass("tran01");},600);
			   setTimeout(function() {b.find(".tit07").addClass("tran01");},800);
            },
            3200)
        },
        0)
    });
    $(".item03").bind("touchstart", 
    function() {
        var a = $(".item02");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02");
        a.find(".tit04").removeClass("tran02");
        $(".item04").find("tit01").removeClass("tran01");
    });
    $(".item04").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit01").addClass("tran01")
        },
        0)
    });
    $(".item04").bind("touchstart", 
    function() {
        var a = $(".item03");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit02").removeClass("tran01");
		a.find(".tit03").removeClass("tran02");
		a.find(".tit04").removeClass("tran01");
		a.find(".tit05").removeClass("tran01");
		a.find(".tit06").removeClass("tran01");
		a.find(".tit07").removeClass("tran01");
        a = $(".item05");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit02").removeClass("tran01");
    });
    $(".item05").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit01").addClass("tran01");
            b.find(".tit02").addClass("tran01")
        },
        0)
    });
    $(".item05").bind("touchstart", 
    function() {
        $(".item04").find(".tit01").removeClass("tran01");
        var a = $(".item06");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit03").removeClass("tran01");
        a.find(".tit04").removeClass("tran01")
    });
    $(".item06").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit01").addClass("tran01");
            setTimeout(function() {
                b.find(".tit03").addClass("tran01")
            },
            500);
            setTimeout(function() {
                b.find(".tit04").addClass("tran01")
            },
            1E3)
        },
        0)
    });
    $(".item06").bind("touchstart", 
    function() {
        var a = $(".item05");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit02").removeClass("tran01");
        $(".item07").find("p").removeClass("tran01")
    });
    $(".item07").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        "30" == $(this).css("z-index") && setTimeout(function() {
            setTimeout(function() {
                $(".i4t1p2,.i4t2p6").addClass("tran01")
            },
            500);
            setTimeout(function() {
                $(".i4t1p1,.i4t2p5").addClass("tran01")
            },
            1E3);
            setTimeout(function() {
                $(".i4t1p3,.i4t2p3").addClass("tran01")
            },
            1500);
            setTimeout(function() {
                $(".i4t1p4,.i4t2p4").addClass("tran01")
            },
            2E3);
            setTimeout(function() {
                $(".i4t1p6,.i4t2p2").addClass("tran01")
            },
            2500);
            setTimeout(function() {
                $(".i4t1p5,.i4t2p1").addClass("tran01")
            },
            3E3)
        },
        0)
    });
    $(".item07").bind("touchstart", 
    function() {
        var a = $(".item06");
        a.find(".tit01").removeClass("tran01");
        a.find(".tit03").removeClass("tran01");
        a.find(".tit04").removeClass("tran01");
        $(".item08").find("p").removeClass("tran02")
    });
    $(".item08").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        "30" == $(this).css("z-index") && setTimeout(function() {
            setTimeout(function() {
                $(".i5t1p1,.i5t2p3").addClass("tran02")
            },
            500);
            setTimeout(function() {
                $(".i5t1p5,.i5t2p5").addClass("tran02")
            },
            1E3);
            setTimeout(function() {
                $(".i5t1p3,.i5t2p1").addClass("tran02")
            },
            1500)
        },
        0)
    });
    $(".item08").bind("touchstart", 
    function() {
        $(".item07").find("p").removeClass("tran01");
        var a = $(".item09");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02")
    });
    $(".item09").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit02").addClass("tran01");
            b.find(".tit03").addClass("tran02")
        },
        0)
    });
    $(".item09").bind("touchstart", 
    function() {
        var a = $(".item08");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02");
        a = $(".item10");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02")
    });
    $(".item10").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit02").addClass("tran01");
            b.find(".tit03").addClass("tran02")
        },
        0)
    });
    $(".item10").bind("touchstart", 
    function() {
        var a = $(".item09");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02");
        a = $(".item11");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02")
    });
    $(".item11").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit02").addClass("tran01");
            b.find(".tit03").addClass("tran02")
        },
        0)
    });
    $(".item11").bind("touchstart", 
    function() {
        var a = $(".item10");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02");
        a = $(".item12");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02")
    });
    $(".item12").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit02").addClass("tran01");
            b.find(".tit03").addClass("tran02")
        },
        0)
    });
    $(".item12").bind("touchstart", 
    function() {
        var a = $(".item11");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02");
        a = $(".item13");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran01")
    });
    $(".item13").bind("webkitTransitionEnd MSTransitionEnd oTransitionEnd TransitionEnd", 
    function(a) {
        var b = $(this);
        "30" == b.css("z-index") && setTimeout(function() {
            b.find(".tit02").addClass("tran01");
            b.find(".tit03").addClass("tran01")
        },
        0)
    });
    $(".item13").bind("touchstart", 
    function() {
        var a = $(".item12");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran02")
    });
    $(".item14").bind("touchstart", 
    function() {
        var a = $(".item13");
        a.find(".tit02").removeClass("tran01");
        a.find(".tit03").removeClass("tran01")
    });
    $(".tel").bind("touchend", 
    function() {
        var a = $(this).text().replace(/\D/g, "");
        location.href = "tel:" + a
    })
});