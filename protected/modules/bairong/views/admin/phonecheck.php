<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div style="font-size: 32px;">短信发送</div>
            <div class="clearbar10"></div>
            手机:<input type="text" name="phone" class="input25" id="phone" maxlength="11"/><font color="red">*必填</font><br />
            渠道:<select name="sid" class="select25" id="sid">
                <option value="" >请选择渠道</option>    
            </select><font color="red">*必填</font><br />
            内容:<textarea name="content" class="textarea100" maxlength="100"></textarea><font color="green">*选填</font><br />
            <div class="clearbar10"></div>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/bairong/admin/sendmessage'/>
        <input type='hidden' id='displayPath' value='/bairong/admin/phonecheck?model=1'/>
    </form>
</div>







<?php $this->renderPartial("/public/buttom") ?> 
<script>
    $(function() {
        //初始化渠道列表
        $.post('/bairong/admin/ajaxgetstyle', {}, function(data) {
            var list = eval(data);
            for (var i in list) {
                $('#sid').append("<option value=" + (list[i].id) + ">" + list[i].name + "</option>");
            }
        });
    });

</script>
<script>
    function checkFormSerialize() {
        //检验手机号是否合理
        var phone=$('#phone').val();
        if(!check_phone(phone)){
            alert('手机号格式不正确');
            return false;
        }
        var aQuery = $("#myForm").formSerialize();
        var controlPath = $("#controlPath").val();
        var displayPath = $("#displayPath").val();
        $.post(controlPath, aQuery, function(data) {
            if (data != '') {
                alert(data);
                location.href = displayPath;
            } else {
                location.href = displayPath;
            }
        });
        return false;
    }


</script>
