<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>



<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            链接标题:<input type="text" name="title" value="<?php echo $list['title'] ?>" class="input25" maxlength="125"/><font color="red">*必填</font><br/>
            所属产品:<select name="pid" class="select25" id="pid" onclick="levelchange(this)">
                <option value="" >请选择产品</option>    
            </select><font color="red">*必填</font><br />
            <input type="hidden" id="pid2" value="<?php echo $list['pid'] ?>">
            相关链接:<textarea name="url" class="textarea100" id="urlvalue"><?php echo $list['url'] ?></textarea><font color="red">*必填</font><br />
            链接排序:<input type="text" name="PX" value="<?php echo $list['PX'] ?>" class="input25"/><font color="green">*选填</font><br/>
            是否显示:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<input type="radio" name="display"  <?php
            if ($list['display'] == '0') {
                echo 'checked';
            }
            ?>  value="0"/>否&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="display" <?php
                                                                                    if ($list['display'] == '1') {
                                                                                        echo 'checked';
                                                                                    }
                                                                                    ?> value="1"/>是&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<br/>
            <input type='hidden' id='admin_id' name='id' value='<?php echo $list['id']; ?>' />

            <div class="clearbar10"></div>
            文献小图:<font color="red">*必填(140*110)</font><input id="file_upload1"  type="file" multiple="true">
            <div id="tu_photo1">
                <?php
                if (!empty($list['little_pic'])) {
                    echo '<img src="/' . $list['little_pic'] . '" width="140" height="110"/>';
                    echo '<input type="button" class="buttons" value="删除" onclick="delpic(this, \'little_pic\')"/>';
                }
                ?>
            </div><br /><br /><br /><br /><br /><br />
            <input type="hidden" name="little_pic" id="little_pic" value="<?php echo $list['little_pic']; ?>"/>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/qizheng/link/link_editor'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 

<script>
    function checkFormSerialize() {
        var str=$('#urlvalue').val();
        var RegUrl = new RegExp();
        RegUrl.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");//jihua.cnblogs.com
        if (!RegUrl.test(str)) {
            alert('链接格式不正确！');
            return false;
        }
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
</script>
<!--初始化导航分类-->
<script>
    $(function() {
        //初始化导航分类列表
        $.post('/qizheng/product/ajaxgetproduct', {}, function(data) {
            var list = eval(data);
            for (var i in list) {
                $('#pid').append("<option value=" + (list[i].id) + ">" + list[i].name + "</option>");
            }
            var e = document.getElementById('pid');
            for (var j = 0; j < e.length; j++) {
                if ($('#pid2').val() == e.options[j].value) {
                    e.options[j].selected = true;
                }
            }
        });
    });
</script>
<script>
//文献列表小图，不要上传多张，不支持
    $(function() {
        setTimeout(function() {
        $('#file_upload1').uploadify({
            'swf': '<?php echo _STATIC_.'vip/qizheng/'; ?>uploadify/uploadify.swf', //指定上传控件的主体文件
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