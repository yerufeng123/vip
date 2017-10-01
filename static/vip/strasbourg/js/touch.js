 function bindTouchtest(e, t) {/*按下效果*/
        moveed = !1, $(e).unbind("touchstart"), $(e).unbind("touchmove"), $(e).unbind("touchend"), $(e).bind("touchstart", function(n) {
        n.stopPropagation(), moveed = !1;
        var r = $(this);
            setTimeout(function() {
                moveed == 0 && ($(e).removeClass(t), r.addClass(t))
                }, 200)
                  }), $(e).bind("touchmove", function(n) {
                moveed = !0, $(e).removeClass(t)
                }), $(e).bind("touchend", function(n) {
              n.stopPropagation(), $(e).removeClass(t), moveed || (moveed = !0, $(this).addClass(t), setTimeout(function() {
            $(e).removeClass(t)
          }, 200))
      })
  }
bindTouchtest(".tg_list li","x-current");
bindTouchtest(".jp_product","jx-current");
bindTouchtest(".mp_btn","mx-current");
bindTouchtest(".diag_close","jx-current");
bindTouchtest(".mp_name_close","mx-current");










