<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>卡包相关功能介绍</title>

    </head>
    <body>
        <h2>创建卡券：</h2><br>
        上传公司logo:<a href="/weixincard/uploadlogo">/weixincard/uploadlogo</a><br>
        卡包颜色列表:<a href="/weixincard/colorlist">/weixincard/colorlist</a><br>
        批量导入门店信息:<a href="/weixincard/setstore">/weixincard/setstore</a><br>
        拉取门店列表:<a href="/weixincard/storelist">/weixincard/storelist</a><br>
        创建卡券:<a href="/weixincard/createcard">/weixincard/createcard</a><br><br>
        <h2>卡券投放</h2><br>
        添加测试白名单:<a href="/weixincard/addtester">/weixincard/addtester</a><br>
        创建二维码添加到卡包:<a href="/weixincard/create2weima">/weixincard/create2weima</a><br>
        调起JS添加到卡包:<a href="/weixincard/addcardbox?wechat_card_js=1">/weixincard/addcardbox?wechat_card_js=1</a>(参数必须，否则无法调起JS，另外需要配置卡券访问JSAPI域名)<br><br>
        新版JS添加到卡包:<a href="/weixincard/addcard?wechat_card_js=1">/weixincard/addcard</a>（新版本，添加到卡包）<br>
        
        <h2>卡券核销</h2>
        消耗code:<a href="/weixincard/deletecode">/weixincard/deletecode</a><br>
        拉起卡券列表并解码:<a href="/weixincard/cardlist">/weixincard/cardlist</a><br>
        Jsapi拉起卡券列表:<a href="/weixincard/choosecard">/weixincard/cardlist</a>(新版本，需要jsapi配置，提供更少参数)<br>

        <h2>卡券管理</h2>
        删除某种卡券:<a href="/weixincard/deletecard">/weixincard/deletecard</a>(重复删除卡券不报错，用户已经领取的卡券可以正常使用)<br>
        查询code:<a href="/weixincard/querycode">/weixincard/querycode</a><br>
        批量查询卡列表:<a href="/weixincard/querycardlist">/weixincard/querycardlist</a>(最大一次查询50个,已经删除的卡券也能查到)<br>
        查询某种卡券详情:<a href="/weixincard/querycardinfo">/weixincard/querycardinfo</a><br>
        更改code:<a href="/weixincard/changecode">/weixincard/changecode</a>(仅自定义code用户可用，建议仅在发生转赠行为后,对用户的code进行更改)<br>
        设置某个卡券失效:<a href="/weixincard/cancelcard">/weixincard/cancelcard</a><br>
        更改卡券信息接口:<a href="/weixincard/updatecardinfo">/weixincard/updatecardinfo</a>（更改后，用户已领取的实时更新票面信息）<br>
        库存修改接口:<a href="/weixincard/updatetotalnum">/weixincard/updatetotalnum</a><br>
        
        <h2>特殊卡券</h2>
        会员卡激活:<a href="/weixincard/membercardactive">/weixincard/membercardactive</a><br>
        会员卡交易：<a href="/weixincard/membercardupdate">/weixincard/membercardupdate</a><br>
        电影票选座：<a href="/weixincard/movieticketupdate">/weixincard/movieticketupdate</a><br>
        飞机票选座：<a href="/weixincard/boardcheckin">/weixincard/boardcheckin</a><br>
        更新红包金额：<a href="/weixincard/redpacketupdate">/weixincard/redpacketupdate</a><br>
        更新会议门票：<a href="/weixincard/meetingticketupdate">/weixincard/meetingticketupdate</a><br>
    </body>
</html>
