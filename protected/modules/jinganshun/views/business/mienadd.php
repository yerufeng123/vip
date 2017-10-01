<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>



<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            标题:<input type="text" name="content" value="" class="input25" maxlength="125"/><font color="red">*必填</font><br/>

            <div class="clearbar10"></div>
            图片:<font color="red">*必填(140*110)</font><input id="file_upload1"  type="file" multiple="true">
            <div id="tu_photo1"></div><br /><br /><br /><br /><br /><br />
            <input type="hidden" name="little_pic" id="little_pic" value=""/>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/jinganshun/business/mienadd'/>
        <input type='hidden' id='displayPath' value='/jinganshun/business/mien?model=2'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 
<script>
    function checkFormSerialize() {
//        var str=$('#urlvalue').val();
//        var RegUrl = new RegExp();
//        RegUrl.compile("((http|ftp|https)://)(([a-zA-Z0-9\._-]+\.[a-zA-Z]{2,6})|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,4})*(/[a-zA-Z0-9\&%_\./-~-]*)?");//jihua.cnblogs.com
//        if (!RegUrl.test(str)) {
//            alert('链接格式不正确！');
//            return false;
//        }
        var aQuery = $("#myForm").formSerialize();
        var controlPath = $("#controlPath").val();
        var displayPath = $("#displayPath").val();
        $.post(controlPath, aQuery, function(data) {
            var list=eval('('+data+')');
            if (list.code != '100000') {
                alert(list.result);
            } else {
                location.href = displayPath;
            }
        });
        return false;
    }
</script>

<script>
    $('#little_pic').val('');
    //商家店标小，不要上传多张，不支持
    $(function() {
        setTimeout(function() {//解决谷歌不兼容问题
        $('#file_upload1').uploadify({
            'swf': '<?php echo _STATIC_; ?>extension/uploadify/uploadify.swf', //指定上传控件的主体文件
            'uploader': '/common/uploadify1?width=140&height=110', //指定服务器端上传处理文件
            'buttonText': '上传图片',
            //其他配置项
            'onUploadStart': function(file) {
                //$('#tu').remove();
            },
            'onUploadSuccess': function(file, data, response) {
                /*删除原有大图像*/
                var picsrc = $('#little_pic').val();
                var oldpic = $('#little_pic').val();
                $.post('/common/deletesrc', {'picsrc': picsrc, 'oldpic': oldpic}, function(src) {
                });
                $('#tu_photo1').html('');
                var temp = explode(',', data);
                var big = temp[0];
                var path = 'uploads' + big.substr(9);//uploadify插件有缺陷，会把返回的路径部分字符转为unicode编码,需要截取掉这部分
                $('#tu_photo1').append('<img width="140px" height="110px" id="tu" class="tu_class" name="tu_class" src="/' + path + '" />');
                $('#tu_photo1').append('<input type="button" class="buttons" value="删除"/>');
                $('#little_pic').val(path);//保存图片路径，便于存入数据库
                $(".buttons").click(function() {
                    //$('#little_pic').val('');//点删除就清空商家小图路径
                    //需要从拼好的字符串中删掉该图的src
                    delpic(this, 'little_pic');
                });
            }
        });
        },10);
    });

</script>