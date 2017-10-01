<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/pay_detail.css" rel="stylesheet">
<title>
斯特拉斯堡圣诞小镇
</title>
</head>

<body>
<!--请将屏幕竖向浏览-->
    <div class="orientation_set">
            <div>
                <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
            </div>
    </div>
<div id="wrap" class="pay_one" data-move>
    <div class="p_main">
    <h3 class="pay_tg_tit">
    <?php 
          switch ($type) {
                    case Constant::CHANNEL_LOTTERY:
                       echo '抽奖凭证';
                        break;
                    case Constant::CHANNEL_AUCTION:
                        echo '竞拍凭证';
                        break;
                    case Constant::CHANNEL_GAME:
                        echo '游戏凭证';
                        break;
                    case Constant::CHANNEL_GROUP:
                        echo '团购凭证';
                        break;
                    case Constant::CHANNEL_H5:
                        echo 'H5凭证';
                        break;
                    case Constant::CHANNEL_SECKILL:
                        echo '秒拍凭证';
                        break;
                }
    ?>

    </h3>
    <ul class="pay_tg_tab">
        <li class="<?php if($stype== 1){ echo 'current';}?>"><a href='<?php echo $this->createUrl('active/my_certificate',array('type'=>1,'atype'=>$type));?>'>未核销</a></li>
        <li class='<?php if($stype== 2){ echo 'current';}?>'><a href='<?php echo $this->createUrl('active/my_certificate',array('type'=>2,'atype'=>$type));?>'>已核销</a></a>
        
        </li>
    </ul>
    <p class="hx_rule tg_rule">
      规则说明：<br/>
      1、持凭证二维码页面，去北京蓝色港湾核销兑换<br/>
      <?php 
      switch ($type) {
                    case Constant::CHANNEL_LOTTERY:
                       echo '2、兑换时间：2015年12月5日-2016年1月4日<br/>';
                        break;
                    case Constant::CHANNEL_AUCTION:
                        echo '2、兑换时间：2015年12月5日-2016年1月4日<br/>';
                        break;
                    case Constant::CHANNEL_GAME:
                        echo '2、兑换时间：2015年12月5日、10日、11日、12日、17日<br/>';
                        break;
                    case Constant::CHANNEL_GROUP:
                        echo '2、兑换时间：2015年12月5日-2016年1月4日<br/>';
                        break;
                    case Constant::CHANNEL_H5:
                        echo '2、兑换时间：2015年12月5日-2016年1月4日<br/>';
                        break;
                    case Constant::CHANNEL_SECKILL:
                        echo '2、兑换时间：2015年12月5日-2016年1月4日<br/>';
                        break;
                }
                ?>
      
      3、活动解释归属于北京艺慧国际文化发展有限公司<br/>
    </p>

    <ul class="tg_list">
    <?php if(is_array($data)){
       foreach($data as $k=>$v){
     ?>
      <li class='qrlist'>
          <div class="tg_left" cid='<?php echo $v['id'];?>' code = '<?php echo $v['code'];?>'  is_true='<?php if(time() > $v['overtime'] && $v['overtime'] != 0){ echo 'true';}else{ echo  'false';} ?>'>
              <img src="<?php echo  Yii::app()->request->hostInfo.'/'.$v['erweimaurl']; ?>" class="pay_tg_er">
              <p><?php echo date('Y-m-d',$v['ctime']).'&nbsp;&nbsp;'.$v['type'];?></p>
              <p>有效期：<?php if($v['overtime'] == 0){ echo '2016-01-04 24:00:00';}elseif(time() > $v['overtime']){echo '已过期';}else{ echo date('Y-m-d H:i',$v['overtime']);};?></p>
          </div>
          <div class="tg_right">
              <p>1</p>
          </div>
      </li>
      <?php }}?>
    </ul>
    
    </div>
</div>

<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/touch.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      var hg=$(".pay_tg_tit").height() + $(".pay_tg_tab").height()+$(".tg_rule").height()+82;
      var window_height=$(window).height()-hg;
      $(".tg_list").css("height",window_height);

	})
	$('.qrlist').click(function(){
		var cid=$(this).children('.tg_left').attr('cid');
		var is_true=$(this).children('.tg_left').attr('is_true');
		var type='<?php echo $type;?>';
		var code=$(this).children('.tg_left').attr('code');
		if(is_true == 'true'){
	      var url='<?php echo $this->createUrl('active/certificate_validate');?>'+'?qrcode='+code+'&ctype=2';
	     }else{
		  var url='<?php echo $this->createUrl('active/Certificate_web');?>'+'?cid='+cid+'&type='+type; 
		}
		
		window.location.href=url
    });

</script>
 <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
$jssdk = new JSSDK(Yii::app()->params['strasbourg']['wxappid'], Yii::app()->params['strasbourg']['wxappsecret']);
$signPackage = $jssdk->GetSignPackage();
?>
<script>

wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"]; ?>',
    timestamp: <?php echo $signPackage["timestamp"]; ?>,
    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
    signature: '<?php echo $signPackage["signature"]; ?>',
    jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'closeWindow',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideOptionMenu'
    ]
});
</script>
<script>
wx.ready(function() {
	wx.hideOptionMenu();
});
</script>
</body>
</html>
