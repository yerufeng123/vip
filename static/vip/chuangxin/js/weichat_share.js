

    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
      window.shareData = {
        "imgUrl": "http://www.kumanju.com/hr_ads/img/title10_img.png",
        "timeLineLink": "http://www.kumanju.com/hr_ads/index.html",
        "sendFriendLink": "http://www.kumanju.com/hr_ads/index.html",
        "weiboLink": "http://www.kumanju.com/hr_ads/index.html",
        "tTitle": "酷漫居大航海时代 船员召集令",
        "tContent": "英雄不问出身 只要你怀揣梦想 只要有一手绝技",
        "fTitle": "射鸡师、攻城狮、枭兽员、程序猿、另有水手、刀客、厨子等一大批技能岗虚位以待...",
        "fContent": "跟我们起航吧！",
        "wContent": "酷漫居大航海时代 船员召集令"
      };
      // 发送给好友
      WeixinJSBridge.on('menu:share:appmessage', function (argv) {
        WeixinJSBridge.invoke('sendAppMessage', {
          "img_url": window.shareData.imgUrl,
          "img_width": "640",
          "img_height": "640",
          "link": window.shareData.sendFriendLink,
          "desc": window.shareData.tContent,
          "title": window.shareData.fTitle
        }, function (res) {
          _report('send_msg', res.err_msg);
        })
      });

      // 分享到朋友圈
      WeixinJSBridge.on('menu:share:timeline', function (argv) {
        WeixinJSBridge.invoke('shareTimeline', {
          "img_url": window.shareData.imgUrl,
          "img_width": "640",
          "img_height": "640",
          "link": window.shareData.timeLineLink,
          "desc": window.shareData.fContent,
          "title": window.shareData.fContent
        }, function (res) {
          _report('timeline', res.err_msg);
        });
      });
	  // 分享到微博
      WeixinJSBridge.on('menu:share:weibo', function (argv) {
        WeixinJSBridge.invoke('shareWeibo', {
          "content": window.shareData.wContent,
          "url": window.shareData.weiboLink,
        }, function (res) {
          _report('weibo', res.err_msg);
        });
      });
    }, false)