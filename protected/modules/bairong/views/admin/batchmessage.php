<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>img/icon_place.png" />您当前位置：<span>群发短信</span></span>
    </div>
    <div class="cont_right_page2">
            <!--查询结束-->
            <input id="file_upload1"  type="file" multiple="true">
            <input type="button" value="批量发送" onclick="send();"/>
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>手机号</th>
            <th>渠道</th>
            <th>短信内容</th>
            <th>操作</th>
            </thead>
            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['phone']; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['content']; ?></td>
                        <td>
                            <div>
                                <span class="del"><a href="/bairong/admin/message_delete?id=<?php echo $value['id']; ?>&model=1"><img src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>img/icon_error.png" /></a></span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>
        <div class="cont_right_page4" style="float: right;">
            <?php echo $page; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>








<?php $this->renderPartial("/public/buttom") ?> 
<script>
    $(function() {
        setTimeout(function() {
            $('#file_upload1').uploadify({
                'swf': '<?php echo _STATIC_; ?>extension/uploadify/uploadify.swf', //指定上传控件的主体文件
                'uploader': '/bairong/common/uploadify1', //指定服务器端上传处理文件
                'buttonText': '导入EXCEL',
                //其他配置项
                'onUploadStart': function(file) {
                    //$('#tu').remove();
                },
                'onUploadSuccess': function(file, data, response) {
                    if (data.indexOf('upload') < 0) {
                        alert(data);
                        return false;
                    }
                    var path = 'uploads' + data.substr(9);//uploadify插件有缺陷，会把返回的路径部分字符转为unicode编码,需要截取掉这部分
                    //异步通知后台进行读取excel
                    $.post('/bairong/admin/readexecl', {'path': path}, function(data) {
                        if (data != '') {
                            alert(data);
                        }
                        location.reload();
                    });

                }
            });
        }, 10);
    });

    function send() {
        //异步发送
        $.post('/bairong/admin/batchmessage', {'send': 'yes'}, function(data) {
            if (data != '') {
                alert(data);
            }
            location.reload();
        });
    }
</script>

