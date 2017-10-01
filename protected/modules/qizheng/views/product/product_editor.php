<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            产品名称:<input type="text" name="name" value="<?php echo $list['name'] ?>" class="input25" maxlength="100"/><font color="red">*必填</font><br/>
            产品排序:<input type="text" name="PX" value="<?php echo $list['PX'] ?>" class="input25" maxlength="3"/><font color="green">*选填</font><br/>
            适&ensp;用&ensp;证:<textarea name="introduction" class="textarea100"><?php echo $list['introduction'] ?></textarea><font color="red">*必填</font><br />
            用法用量:<textarea name="use_method" class="textarea100"><?php echo $list['use_method'] ?></textarea><font color="red">*必填</font><br />
            不良反应:<textarea name="bad_reaction" class="textarea100"><?php echo $list['bad_reaction'] ?></textarea><font color="red">*必填</font><br />
            产品禁忌:<textarea name="taboo" class="textarea100"><?php echo $list['taboo'] ?></textarea><font color="red">*必填</font><br />

            <input type='hidden' id='admin_id' name='id' value='<?php echo $list['id']; ?>' />

            <div class="clearbar10"></div>
            <div id="newinfo_box">
                <?php
                if (is_array($list['other'])) {
                    foreach ($list['other'] as $k => $v) {
                        echo'<div class="newinfo">显示标题：<input type="text"  value="' . $v['title'] . '" class="input25 newtitle"/><font color="red">*必填</font><br/>显示内容：<textarea  class="textarea100 newcontent">' . $v['content'] . '</textarea><font color="green">*选填</font><br/><input type="button" value="删除"  onclick="delectnew(this);" style="margin-left:327px;"/></div><br>';
                    }
                }
                ?>

            </div>
            <div class="clearbar10"></div>
            <input type="hidden" id="other" name="other" value=""/>
            <input type="button" id="addshow" value="添加显示项" style="background-color: #cccccc"/>
            <div class="clearbar10"></div>
            宣传图片:<font color="red">*必填(298*157)</font><input id="file_upload1"  type="file" multiple="true">
            <div id="tu_photo1">
                <?php
                if (!empty($list['pic2']) && is_array($list['pic2'])) {
                    foreach ($list['pic2'] as $key => $value) {
                        echo '<img src="/' . $value . '" width="298" height="157"/>';
                        echo'<input type="button" class="buttons" value="删除" onclick="delpic(this, \'pic\')"/>';
                    }
                }
                ?>
            </div><br />
            产品图片:<font color="red">*必填(125*125)</font><input id="file_upload2"  type="file" multiple="true">
            <div id="tu_photo2">
                <?php
                if (!empty($list['product_pic2']) && is_array($list['pic2'])) {
                    foreach ($list['product_pic2'] as $key => $value) {
                        echo '<img src="/' . $value . '" width="125" height="125"/>';
                        echo'<input type="button" class="buttons" value="删除" onclick="delpic(this, \'product_pic\')"/>';
                    }
                }
                ?>
            </div><br />
            <input type="hidden" name="pic" id="pic" value="<?php echo $list['pic'] ?>"/>
            <input type="hidden" name="pic_bk" id="pic_bk" value="<?php echo $list['pic'] ?>"/>
            <input type="hidden" name="product_pic" id="product_pic" value="<?php echo $list['product_pic'] ?>"/>
            <input type="hidden" name="product_pic_bk" id="product_pic_bk" value="<?php echo $list['product_pic'] ?>"/>

        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/qizheng/product/product_editor'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 
<script>
    function checkFormSerialize() {
        if (setOther()) {
            var aQuery = $("#myForm").formSerialize();
            var controlPath = $("#controlPath").val();
            $.post(controlPath, aQuery, function(data) {
                if (data != '') {
                    alert(data);
                } else {
                    location.href = document.referrer;
                }
            });
            return false;
        }
        return false;
    }
    //删除新选项框
    function delectnew(OBJ) {
        $(OBJ).parent().remove();
    }
</script>
<script>
    //设置用户自填字段
    function setOther() {
        var arr = [];
        for (var i = 0; i < $('.newinfo').length; i++) {
            if ($('.newtitle').eq(i).val() == '') {
                alert('请填写显示项标题');
                return false;
            }
            arr[i] = $('.newtitle').eq(i).val() + '@@@@' + $('.newcontent').eq(i).val();
        }
        $('#other').val(JSON.stringify(arr));
        return true;
    }
</script>
<script>
    //商家宣传图多张
    $(function() {
        setTimeout(function() {
        $('#file_upload1').uploadify({
            'swf': '<?php echo _STATIC_ .'vip/qizheng/'; ?>uploadify/uploadify.swf', //指定上传控件的主体文件
            'uploader': '/common/uploadify1?width=480&height=245', //指定服务器端上传处理文件
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
        },10);
    });
//产品图多张
//    $(function() {
//        $('#file_upload2').uploadify({
//            'swf': '<?php echo _STATIC_ .'vip/qizheng/'; ?>uploadify/uploadify.swf', //指定上传控件的主体文件
//            'uploader': '/common/uploadify1?width=480&height=245', //指定服务器端上传处理文件
//            'buttonText': '上传图片',
//            //其他配置项
//            'onUploadStart': function(file) {
//                //$('#tu').remove();
//            },
//            'onUploadSuccess': function(file, data, response) {
//                var path = 'uploads' + data.substr(9);//uploadify插件有缺陷，会把返回的路径部分字符转为unicode编码,需要截取掉这部分
//                $('#tu_photo2').append('<img width="480px" height="245px" id="tu" class="tu_class" name="tu_class" src="/' + path + '" />');
//                $('#tu_photo2').append('<input type="button" class="buttons" value="删除"/>');
//
//                $(".buttons").click(function() {
//                    //需要从拼好的字符串中删掉该图的src
//                    delpic(this, 'product_pic');
//                });
//
//                var str = rtrim($('#product_pic').val(), ',');//取出原有图片
//                str += ',' + path + ',';//新图添加进去
//                $('#product_pic').val(str);//重新将拼好的图片链接，赋给图片字段
//            }
//        });
//    });
</script>
<script>
//产品图,不要上传多张，不支持
    $(function() {
        setTimeout(function() {
        $('#file_upload2').uploadify({
            'swf': '<?php echo _STATIC_ .'vip/qizheng/'; ?>uploadify/uploadify.swf', //指定上传控件的主体文件
            'uploader': '/common/uploadify1?width=125&height=125', //指定服务器端上传处理文件
            'buttonText': '上传图片',
            //其他配置项
            'onUploadStart': function(file) {
                //$('#tu').remove();
            },
            'onUploadSuccess': function(file, data, response) {
                /*删除原有大图像*/
                var picsrc = $('#product_pic').val();
                var oldpic = $('#product_pic').val();
                $.post('/common/deletesrc', {'picsrc': picsrc, 'oldpic': oldpic}, function(src) {
                });
                $('#tu_photo2').html('');
                var temp = explode(',', data);
                var big = temp[0];
                var path = 'uploads' + big.substr(9);//uploadify插件有缺陷，会把返回的路径部分字符转为unicode编码,需要截取掉这部分
                $('#tu_photo2').append('<img width="125px" height="125px" id="tu" class="tu_class" name="tu_class" src="/' + path + '" />');
                $('#tu_photo2').append('<input type="button" class="buttons" value="删除"/>');
                $('#product_pic').val(path);//保存图片路径，便于存入数据库
                $(".buttons").click(function() {
                    //$('#product_pic').val('');//点删除就清空商家小图路径
                    //需要从拼好的字符串中删掉该图的src
                    delpic(this, 'product_pic');
                });
            }
        });
        },10);
    });


</script>
<script>
    $(function() {
        $('#addshow').bind('click', function() {
            $('#newinfo_box').append('<div class="newinfo">显示标题：<input type="text"  value="" class="input25 newtitle"/><font color="red">*必填</font><br/>显示内容：<textarea  class="textarea100 newcontent"></textarea><font color="green">*选填</font><br/><input type="button" value="删除"  onclick="delectnew(this);" style="margin-left:327px;"/></div><br>');
        });
    });
</script>