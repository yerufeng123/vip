<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
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
    </head>
    <body>
        <div style="margin: auto;width: 300px;text-align: center">
            <input type='button' style='width: 100px;height: 30px;' value="导出完善" onclick="javascript:location.href='/shangqidatong/outdata?type=1'" />
            <input type='button' style='width: 100px;height: 30px;' value="导出非完善" onclick="javascript:location.href='/shangqidatong/outdata?type=2'"/>
        </div>
    </body>
    
</html>
