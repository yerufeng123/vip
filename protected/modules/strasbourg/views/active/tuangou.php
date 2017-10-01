<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>斯特拉斯堡圣诞小镇</title>
</head>
<style type="text/css">
/******************通用*******************/
html,body{-webkit-tap-highlight-color:rgba(0,0,0,0);color:#302e31;font:13px/1.6 "微软雅黑",Helvetica;margin:0;padding:0;-webkit-user-select:none;width:100%;height:100%;position:relative}
form,table,td,h1,h2,h3,h4,ul,ol,li,p{margin:0;padding:0;border:0;list-style:none}
input,img{vertical-align:middle}
html,body{min-width:100%;background:#EAEAEC;}
body{-webkit-text-size-adjust:none;}
img{border:0 none;max-width:100%;height:auto;}
ol,ul{list-style:none;}
:focus{outline:0;}
textarea{resize:none;overflow:auto;}
a{-webkit-touch-callout:none;-webkit-user-select:none;text-decoration:none}
a:link {-webkit-tap-highlight-color:rgba(229,59,44,0)}
table{border-collapse: collapse;border-spacing: 0;}
input:focus,textarea:focus{outline:0}
.tuned{ position:absolute;top:50%;left:50%;-webkit-transform: translate(-50%,-50%);font-size:48px;color:#bdbdd3;}


</style>

<body>
    <h1 id="text">本次团购倒计时：0天0时0分0秒</h1><br>
    <img src="" width="100px" height="100px"><br>
    团购人数：<?php echo $data['setting']['nowpeple'];?>人<br>
  团购价格：<?php echo $data['setting']['nowprice'];?>元<br>
  <button id="sub_btn"> 我要团购</button>

</body>
<script src="<?php echo _STATIC_?>vip/strasbourg/js/zepto.min.js"></script>
<?php $nowtime = time();?>
<script type="text/javascript">
var timer_rt=null;
var istuanlog='<?php echo $istuanlog?>';//是否已下单
var flag='<?php echo $flag?>';//是否读秒
	//var startTime = new Date();
	//startTime.setFullYear(2015, 10, 29);
	//startTime.setHours(23);
	//startTime.setMinutes(59);
	//startTime.setSeconds(59);
	//startTime.setMilliseconds(999);
	//var EndTime=startTime.getTime();
	var EndTime=new Date(<?php echo strtotime($data['tuan_stop_time'])*1000;?>);
	var NowTime=new Date(<?php echo $nowtime*1000;?>);
	EndTime=EndTime.getTime();
	NowTime=NowTime.getTime();
	function GetRTime(){
		//var NowTime = new Date();
		//var nMS = EndTime - NowTime.getTime();
		var nMS = EndTime - NowTime;
		NowTime=parseInt(NowTime)+1000;
		var nD = Math.floor(nMS/(1000 * 60 * 60 * 24));
		var nH = Math.floor(nMS/(1000*60*60)) % 24;
		var nM = Math.floor(nMS/(1000*60)) % 60;
		var nS = Math.floor(nMS/1000) % 60;
		if (nMS < 0){
			//$("#text").text('本次团购倒计时：0天0时0分0秒');
			if(istuanlog == '1'){
				clearInterval(timer_rt);
				window.location.href="/strasbourg/active/tuan_result";
			    return false;
			}
			return false;
			//$("#dao").hide();
			//$("#daoend").show();
		}else{
		   $("#text").text('本次团购倒计时：'+nD+'天'+nH+'时'+nM+'分'+nS+'秒');
		   //$("#dao").show();
		   //$("#daoend").hide();
		   //$("#RemainD").text(nD);
		   //$("#RemainH").text(nH);
		   //$("#RemainM").text(nM);
		   //$("#RemainS").text(nS); 
		}
	}
	
	$(document).ready(function () {
		if(flag == '3'){
			$("#text").text('您已参加过该活动');
	    }else if(flag == '2'){
	    	$("#text").text('活动未开始');
	    }else if(flag == '0'){
	    	$("#text").text('活动已结束');
		 }else{
	    	timer_rt = window.setInterval("GetRTime()", 1000);
		}

	    $('#sub_btn').bind('click',function(data){
		    if(flag == 1){
    	        $.post('/strasbourg/active/ajaxtuangou',{},function(data){
    	        	  var list=eval('('+data+')');
    	        	  if(list.code != 1000){
    	        		    alert(list.msg);
    			      }else{
    			    	  istuanlog = '1';
    				      alert('团购成功,请等待读秒结束后再支付');
    				  }
    		    });
		    }else{
		        alert('暂不能参加团购');
			}
		    return false;
		});
	});
	</script>
</html>
