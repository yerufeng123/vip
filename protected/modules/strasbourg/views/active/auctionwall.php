<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/jp_big_detail.css" rel="stylesheet">
<title>竞拍大屏幕</title>
</head>

<body>
<div id="wrap" class="jp_web" data-move>
    <div class="jp_main">
      <div class="jp_big_ps">
        <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/big_tit.png" class="big_tit">
        <div class="jp_tu_left">
            <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png" class="jp_logo">
            <img src="<?php echo _STATIC_ . 'vip/strasbourg/img/'.$this->setting[Constant::CHANNEL_AUCTION]['setting']['img']; ?>" class="jp_img">
            <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_tu1.png" class="jp_tu1">
        </div>
        <div class="jp_tu_right">
            <div class="big_time">
                <p id='msg'>本次竞拍倒计时 <span id='time'>00:00:00</span></p>
                     
                <div class="big_list">
                    <h3 class="list_tit">竞拍排行榜</h3>
                    <ul id='list'> 
                    </ul>
                </div>
            </div>
        </div>

        </div>
    </div>
    
    
</div>

<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
     var t='<?php echo $t;?>';
      function check(){
          $.post('<?php echo $this->createUrl('active/auction_wall');?>',{},function(data){
             arr=eval(data);
           	 $('#list').html('');
             if(arr.data.length >= 1){
                 var str='';
               for(var i in arr.data){
                   str+="<li>";
                   str+="<span class='big_cion'><img src='"+arr.data[i].uinfo.headimgurl+"'/></span>";
                   str+="<span class='big_name'>"+arr.data[i].uinfo.name+"</span>";
     			  str+="<span class='big_phone'>"+arr.data[i].uinfo.phone+"</span>";
     			  str+="<span class='big_yuan'>"+arr.data[i].price+"元</span>";
     			  str+="</li>";
                 }
               $('#list').html(str);
            }
             if(arr.t != '00:00:00'){
          	   $('#msg').html("本次竞拍倒计时 <span id='time'>"+arr.t+"</span>");
               //  $('#time').html(arr.t);
              }else{
                  $('#msg').html('竞拍已结束');
                  $('#time').html('00:00:00');
             }
          },'json');
      }
      
      var start= setInterval(function(){
     	  check();
          }, 1000);
		})
</script>
</body>
</html>
