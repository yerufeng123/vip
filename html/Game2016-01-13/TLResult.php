<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" type="text/css" href="css/css.css"/>
<title>Result</title>
</head>
<body >
<div >
  <img src="img/top.jpg" width="100%">
</div>
<h1 align="left">你的生命数字是</h1>

<?php 
//echo "<p>Order processed at".date('H:i, jS F Y')."</p>";
$year=$_POST['Yearqty'];
$month=$_POST['Monthqty'];
$day=$_POST['Dayqty'];
$Temp1=(int)($year/1000)+(int)($year%1000/100)+(int)($year%100/10)+(int)($year%10);
$Temp2=(int)($month/10)+(int)($month%10);
$Temp3=(int)($day/10)+(int)($day%10);
$Temp=$Temp1+$Temp2+$Temp3;
$A1=(int)($Temp/10);
$A2=(int)($Temp%10); 
$Res=$A1+$A2;
if($Res>=10)
{
	$Res=(int)($Res/10)+(int)($Res%10);
}
$x1='<html>
<body>
<div style=" width:100px; height:100px; background-color:red; border-radius:50px;margin:auto;text-align:center;">
         <span style="height:100px; line-height:100px; display:block; color:#FFF; text-align:center;font-size:80px">1</span>
    </div> 
<h3 align="center">数字1特点：<br/>
<span style="color:red">天生的领导者、骨子里带的自信心、卓越的创造力...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"1"或者"一"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p>
</body>
</html>';
$x2='<html>
<body>
<div style=" width:100px; height:100px; background-color:orange; border-radius:50px;margin:auto;text-align:center;">
         <span style="height:100px; line-height:100px; display:block; color:#FFF; text-align:center;font-size:80px">2</span>
    </div> 
<h3 align="center">数字2特点：<br/>
<span style="color:orange">性格温和，社交高手，善于沟通和合作；但经常在过于依赖或过度独立两个极端，需要学习平衡取舍...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"2"或者"二"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p>
</body>
</html>';

$x3='<html>
<body>
<div style=" width:100px; height:100px; background-color:yellow; border-radius:50px;margin:auto;text-align:center;">
         <span style="height:100px; line-height:100px; display:block; color:#666; text-align:center;font-size:80px">3</span>
    </div> 
<h3 align="center">数字3特点：<br/>
<span style="background-color:#666;color:#fe0">行动积极，充满热情，感性十足...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"3"或者"三"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p>
</body>
</html>';
$x4='<html>
<body>
<div style=" width:100px; height:100px; background-color:green; border-radius:50px;margin:auto;text-align:center;">
         <span style="height:100px; line-height:100px; display:block; color:#FFF; text-align:center;font-size:80px">4</span>
    </div> 
<h3 align="center">数字4特点：<br/>
<span style="color:green">性格谨慎，善于组织策划，稳定理智、趋于保守...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"4"或者"四"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p>
</body>
</html>';
$x5='<html>
<body>
<div style=" width:100px; height:100px; background-color:blue; border-radius:50px;margin:auto;text-align:center;">
         <span style="height:100px; line-height:100px; display:block; color:#FFF; text-align:center;font-size:80px">5</span>
    </div> 
<h3 align="center">数字5特点：<br/>
<span style="color:blue">向往自由无拘无束，方向感强有远见、坚强甚至偏固执...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"5"或者"五"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p>
</body>
</html>';
$x6='<html>
<body>
<div style=" width:100px; height:100px; background-color:#60f; border-radius:50px;margin:auto;text-align:center;">
         <span style="height:100px; line-height:100px; display:block; color:#FFF; text-align:center;font-size:80px">6</span>
    </div> 
<h3 align="center">数字6特点：<br/>
<span style="color:#60f">善于分析发现、非常敏感;富有爱心、但同时也希望对方有爱的回应...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"6"或者"六"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p>
</body>
</html>';
$x7='<html>
<body>
<div style=" width:100px; height:100px; background-color:#A757A8; border-radius:50px;margin:auto;text-align:center;">
         <span style="height:100px; line-height:100px; display:block; color:#FFF; text-align:center;font-size:80px">7</span>
    </div> 
<h3 align="center">数字7特点：<br/>
<span style="color:#A757A8">博学多闻、天生懂得提出和分析问题；处事圆滑、博爱包容、人缘好，但行动力稍弱，也比较害羞...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"7"或者"七"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p></body>
</html>';
$x8='<html>
<body>
<div style=" width:100px; height:100px; background-color:#da0; border-radius:50px;margin:auto;text-align:center;">
         <span style="height:100px; line-height:100px; display:block; color:#FFF; text-align:center;font-size:80px">8</span>
    </div> 
<h3 align="center">数字8特点：<br/>
<span style="color:#c90">责任感重、在9个数字中最有企业家潜质，在人群中有影响力；成熟后给人两种感觉，是生意人也是圣人，很实际又很超脱...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"8"或者"八"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p></body>
</html>';
$x9='<html>
<body>
<div style=" width:100px; height:100px; background-color:#fff; border-radius:50px;margin:auto;text-align:center;border-style: solid; border-color:#da0;">
         <span style="height:100px; line-height:100px; display:block; color:#da0; text-align:center;font-size:80px">9</span>
    </div> 
<h3 align="center">数字9特点：<br/>
<span style="color:#c90">全面型的多才多艺之人，个性开朗、机灵活泼、能随机应变、口才好、人缘佳、所以机会特别多；感情上多情、浪漫、爱梦想...</h3>
<div  style="height:10px">
</div>
<p style="margin-left:15px;margin-right:10px;font-size:25px">就这些吗？No，还多着咧~
</p>
<p id="me_info">
<br/>
还想check一下你的事业和金钱运势吗？<br/>
或者探寻一下你的人生目标或者转运关键？<br/>
还有，和你同样生命数的名人有哪些?<br/>
那么，只要30秒，30秒哦，<br/>
<span>关注</span>“Me心理”微信公众号，并<span>回复"9"或者"九"</span>，就能get到关于你的详细、全面的生命密码大揭秘！<br/>快戳一下啦！戳一下又不会怀孕！
</p></body>
</html>';
//echo '你的生命数是:'.$Res. '<br />';
//echo '你的天赋数是:'.$A1.'和' .$A2.'<br />';
switch($Res)
{case 1:
echo $x1;
break;
case 2:
echo $x2;
break;
case 3:
echo $x3;
break;
case 4:
echo $x4;
break;
case 5:
echo $x5;
break;
case 6:
echo $x6;	
break;
case 7:
echo $x7;
break;
case 8:
echo $x8;	
break;
case 9:
echo $x9;	
break;
default:
break;
}
?><br/>

<img src="img/wxlogo6.jpg" width="100%">
</body>
</html>