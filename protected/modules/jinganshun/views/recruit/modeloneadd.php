<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>



<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            名称:<input type="text" name="title" value="" class="input25" maxlength="125"/><font color="red">*必填</font><br/>
            <div class="clearbar10"></div>
            图片:<font color="red">*必填(298*157)</font><input id="file_upload1"  type="file" multiple="true">
            <input type="hidden" name="pic" id="pic" value=""/>
            <div id="tu_photo1"></div><br />
            <input type="hidden" name="oid" value="<?php echo $_GET['oid']; ?>">
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/jinganshun/recruit/modeloneadd'/>
        <input type='hidden' id='displayPath' value='/jinganshun/recruit/modeleditor?model=3&id=<?php echo $_GET['oid'] ?>&oid=<?php echo $_GET['oid'] ?>'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 
<script>
    function checkFormSerialize() {
        var aQuery = $("#myForm").formSerialize();
        var controlPath = $("#controlPath").val();
        var displayPath = $("#displayPath").val();
        $.post(controlPath, aQuery, function(data) {
            var list = eval('(' + data + ')');
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
    //商家宣传图多张
    $(function() {
        setTimeout(function() {
            $('#file_upload1').uploadify({
                 'swf': '<?php echo _STATIC_; ?>extension/uploadify/uploadify.swf', //指定上传控件的主体文件
                'uploader': '/common/uploadify1?width=298&height=157', //指定服务器端上传处理文件
                'buttonText': '上传图片',
                //其他配置项
                'onUploadStart': function(file) {
                    //$('#tu').remove();
                },
                'onUploadSuccess': function(file, data, response) {
                    var path = 'uploads' + data.substr(9);//uploadify插件有缺陷，会把返回的路径部分字符转为unicode编码,需要截取掉这部分
                    $('#tu_photo1').append('<img width="298px" height="157px" id="tu" class="tu_class" name="tu_class" src="/' + path + '" />');
                    $('#tu_photo1').append('<input type="button" class="buttons" value="删除"/>');

                    $(".buttons").click(function() {
                        //需要从拼好的字符串中删掉该图的src
                        delpic(this, 'pic');
                    });

                    var str = rtrim($('#pic').val(), ',');//取出原有图片
                    str += ',' + path + ',';//新图添加进去
                    $('#pic').val(str);//重新将拼好的图片链接，赋给图片字段
                }
            });
        }, 10);
    });

</script>