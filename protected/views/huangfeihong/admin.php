<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- 修改开始 -->
        <!-- 预加载页面 -->
        <link rel="prefetch" href="/bolonigame/gamedetail" /> 
        <!-- 修改开始 -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,user-scalable=no">
        <!--百度统计代码-->
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?eeaa8a516c91370264450e1eee60e97d";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
        <title>黄飞红</title>
    </head>
    <body>
        <div style="margin: auto;text-align: center;width:80%;border: 2px solid #ccc">
            <div>
                <form action="/huangfeihong/admin" method="post" >
                    城市：<input type="text" name="city" value="<?php echo $search['city']; ?>"> 
                    姓名：<input type="text" name="name" value="<?php echo $search['name']; ?>"> 
                    手机：<input type="text" name="phone" value="<?php echo $search['phone']; ?>"> 
                    奖项：<select name="level">
                        <option value="" <?php if($search['level']== ''){ echo 'selected="selected"';}?>>全部</option>
                        <option value="1" <?php if($search['level']== '1'){ echo 'selected="selected"';}?>>一等奖</option>
                        <option value="2" <?php if($search['level']== '2'){ echo 'selected="selected"';}?>>二等奖</option>
                    </select>
                    <input type="submit" value="检索"><input type="button" value="导出数据" id="dao_btn">
                </form>
            </div>
            <div style="margin: auto;text-align: center">
                <table border="1">
                    <tr><th>序号</th><th>城市</th><th>唯一标识</th><th>姓名</th><th>手机</th><th>地址</th><th>最后游戏次数</th><th>最后朋友点击量</th><th>历史分享量</th><th>奖项</th><th>获奖时间</th><th>扫码时间</th></tr>
                    <?php if (isset($list) && is_array($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                    <tr><td><?php echo $key + 1; ?></td><td><?php echo $value['city'] ?></td><td><?php echo $value['openid'] ?></td><td><?php echo $value['name'] ?></td><td><?php echo $value['phone'] ?></td><td><?php echo $value['address'] ?></td><td><?php echo $value['gamenum'] ?></td><td><?php echo $value['friendnum'] ?></td><td><?php echo $value['sharenum'] ?></td><td><?php echo $value['gid'] ?></td><td><?php if(!empty($value['gtime'])){ echo date('Y-m-d H:i:s', $value['gtime']);} ?></td><td><?php if(!empty($value['ctime'])){ echo date('Y-m-d H:i:s', $value['ctime']);} ?></td></tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
            <div >
                <?php echo $page; ?>
            </div>
        </div>
        <div style="margin: auto;width:80%;font-size: 15px;font-weight: bold;margin-top: 20px;">
            当前游戏人数：<span style="color: red;font-size: 28px"><?php echo $totalnum;?></span>
        </div>
        <div style="margin: auto;text-align: center;width:80%;height: 230px;border: 2px solid #ccc;margin-top: 40px">
            <h1>中奖配置</h1>
            <div style="width:50%;margin: auto;text-align: center">
                <form id="updategift">
                    <div style="width: 48%;float: left">
                        一等奖：<br>
                        &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;&nbsp;称：<input type="text" name="firstname" value="<?php echo $giftfirst->name; ?>"><br>
                        &nbsp;&nbsp;数&nbsp;&nbsp;&nbsp;&nbsp;量：<input type="text" name="firstnum" value="<?php echo $giftfirst->num; ?>"><br>
                        &nbsp;&nbsp;中&nbsp;奖&nbsp;率：<input type="text" name="firstchance" value="<?php echo intval($giftfirst->chance); ?>">‱<br>
                        &nbsp;&nbsp;文案描述：<textarea name="firstdescribe"><?php echo $giftfirst->describe ?></textarea><br>
                    </div>
                    <div style="width: 48%;float: right">
                        二等奖：<br>
                        &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;&nbsp;称：<input type="text" name="secondname" value="<?php echo $giftsecond->name; ?>"><br>
                        &nbsp;&nbsp;数&nbsp;&nbsp;&nbsp;&nbsp;量：<input type="text" name="secondnum" value="<?php echo $giftsecond->num; ?>"><br>
                        &nbsp;&nbsp;中&nbsp;奖&nbsp;率：<input type="text" name="secondchance" value="<?php echo intval($giftsecond->chance); ?>">‱<br>
                        &nbsp;&nbsp;文案描述：<textarea name="seconddescribe"><?php echo $giftsecond->describe; ?></textarea><br>
                    </div>
                    <input type="hidden" name="pwd" id="pwd" value="" >
                    <input type="button" id="sub_btn" value="提交">
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/jquery.form.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

    <script>
        document.addEventListener("touchmove", function(e) {
            e.preventDefault()
        })
    </script>
    <script>
        $(function() {
            $('#sub_btn').bind('click', function() {
                var str = prompt("请输入修改密码", "");
                if (str != '') {
                    $('#pwd').val(str);
                    $("#updategift").ajaxSubmit({
                        type: "POST",
                        url: "/huangfeihong/ajaxupdategift",
                        dataType: "json",
                        success: function(data) {
                            if (data.code != '10000') {
                                alert(data.result);
                                return false;
                            }
                            alert('保存成功！');
                            location.reload();
                        },
                    });
                }
            });
            
            //单击导出数据
            $('#dao_btn').bind('click',function(){
                window.location.href="/huangfeihong/ajaxpushdata"
            });

        });
    </script>
</html>