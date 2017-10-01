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
<title>登录</title>
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
            <form action="/jinganshun/index/register" method="post" id="myform">
        <p>
        	<label>姓名：</label>
            <input type="text" placeholder="请输入您的姓名" id="name" name="name">
        </p>
        <p>
        	<label>电话：</label>
            <input type="text" placeholder="请输入您的电话" id="phone" name="phone">
        </p>
        <input type="hidden" id="position" value="<?php echo $_GET['position']; ?>">
        <a href="javascript:void(0)" class="offer_bt" id='sub_btn'>登录</a>
        </form>
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
		
		$(".offer_bt").bind("click",function(){
			$(".diag_success").show();
			})
        $("body").bind("touchmove",function(e){
            e.preventDefault();

        })	
		})
</script>
<script type="text/javascript" src="<?php echo _STATIC_?>/js/globals.js"></script>
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
                    }else{
                        $('#myform').submit();
                    }
                    
//                    $.post('/jinganshun/index/recruitadd', {'name': name, 'phone': phone, 'province': province, 'address': address, 'position': position}, function(data) {
//                        var list = eval('(' + data + ')');
//                        if (list.code != '100000') {
//                            alert(list.result);
//                        } else {
//                            $(".diag_success").show();
//                            //location.href = "/jinganshun/index/apply";
//                        }
//                    });
                });

            });
        </script>

</body>
</html>
