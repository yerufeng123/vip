<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/common.css" rel="stylesheet">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/page.css" rel="stylesheet">
<title>职位申请</title>
</head>

<body>
<div class="wrap" id="jan_offer">
  	<div class="top1">
    	<div class="logo">
        	<img src="<?php echo _STATIC_?>vip/jinganshun/images/logo.png">
        </div>
        <div class="logo_nav_mh"></div>
        <img src="<?php echo _STATIC_?>vip/jinganshun/images/ren_t1.png" class="offer_ren">
        <div class="offer_main">
        <p>
        	<label>姓名：</label>
            <input type="text" placeholder="请输入您的姓名" id="name">
        </p>
        <p>
        	<label>电话：</label>
            <input type="text" placeholder="请输入您的电话" id="phone">
        </p>
        <input type="hidden" id="position" value="<?php echo $_GET['position']; ?>">
        <a href="javascript:void(0)" class="offer_bt" id='sub_btn'>提交</a>
        </div>
        
        
    </div>
  
  <div class="diag_success" style="display:none;">
  		<div class="diag_block">
			<a href="javascript:void(0)" class="close">X</a>
            <p>提交成功<br/>稍后我们会与您<br/>联系</p>
        </div>
  </div>  
  
    
</div>
<script type="text/javascript" src="<?php echo _STATIC_?>vip/jinganshun/js/zepto.min.js"></script>
<script type="text/javascript">
 //页面大小初始化
        (function(){ 
            var _width = document.body.clientWidth;
            var _dom = document.querySelector('#viewport');
            var scale = _width/320;
            _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
        })()
	$(function(){
		$('#jan_offer').height($('body').height());
		$(".close").bind("click",function(){
			$(".diag_success").hide();
			})
		
		
        $("body").bind("touchmove",function(e){
            e.preventDefault();

        })	
		})
</script>
 <script type="text/javascript" src="<?php echo _STATIC_?>/js/globals.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['jinganshun']['wxappid'], Yii::app()->params['jinganshun']['wxappsecret']);
        $signPackage = $jssdk->GetSignPackage();
        ?>
        <script>
            /*
             * 注意：
             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
             */
                wx.config({
                    debug: false,
                    appId: '<?php echo $signPackage["appId"]; ?>',
                    timestamp: <?php echo $signPackage["timestamp"]; ?>,
                    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
                    signature: '<?php echo $signPackage["signature"]; ?>',
                    jsApiList: [
                        // 所有要调用的 API 都要加到这个列表中
                        'hideOptionMenu',
                    ]
                });
                wx.ready(function() {
                    //隐藏右上角菜单
                    wx.hideOptionMenu();
                });
        </script>
        <script type="text/javascript">
            $(function() {
                $('#jan_offer').height($('body').height()); 
                $(".close").bind("click", function() {
                    $(".diag_success").hide();
                    location.href = "/jinganshun/index/apply";
                })

//                $(".offer_bt").bind("click", function() {
//                    $(".diag_success").show();
//                })
            })
        </script>
        <script>
            $(function() {
                //单击提交
                $('#sub_btn').bind('click', function() {
                    var name = $('#name').val();
                    var phone = $('#phone').val();
                    var province = $('#province').val();
                    var address = $('#address').val();
                    var position = $('#position').val();
                    if(!check_phone(phone)){
                        alert('手机格式不正确');
                        return false;
                    }
                    $.post('/jinganshun/index/recruitadd', {'name': name, 'phone': phone, 'province': province, 'address': address, 'position': position}, function(data) {
                        var list = eval('(' + data + ')');
                        if (list.code != '100000') {
                            alert(list.result);
                        } else {
                            $(".diag_success").show();
                            //location.href = "/jinganshun/index/apply";
                        }
                    });
                });

            });
        </script>

</body>
</html>
