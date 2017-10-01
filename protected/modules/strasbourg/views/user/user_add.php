<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>
<script>
    function checkFormSerialize() {
        var str = $('#phone').val();
        if (str !='' && !check_phone(str)) {
            alert('手机格式不正确！');
            return false;
        }
        var aQuery = $("#myForm").formSerialize();
        var controlPath = $("#controlPath").val();
        var displayPath = $("#displayPath").val();
        $.post(controlPath, aQuery, function(data) {
            if (data != '') {
                alert(data);
            } else {
                location.href = displayPath;
            }
        });
        return false;
    }
    //验证手机号
    function check_phone(phone) {
        var reg = /^1[3|4|5|7|8][0-9]\d{4,8}$/;
        if (!reg.test(phone)) {
            return false;
        } else {
            return true;
        }
    }
</script>


<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            <span style="font-family: '宋体', Simsun;" mce_style="font-family: '宋体', Simsun;">员工姓名:</span><input type="text" name="name" value="" class="input25" maxlength="10"/><font color="green">*选填</font><br/>
            <span style="font-family: '宋体', Simsun;" mce_style="font-family: '宋体', Simsun;">员工编号:</span><input type="text" name="username" value="" class="input25" maxlength="15"/><font color="red">*必填</font><br/>
            <span style="font-family: '宋体', Simsun;" mce_style="font-family: '宋体', Simsun;">手&emsp;&emsp;机:</span><input type="text" name="phone" class="input25" id="phone" maxlength="11"/><font color="green">*选填</font><br />
            <div class="clearbar10"></div>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="user_reset"  value="重置" />
            <input class='button50' type="button" name="user_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/strasbourg/user/user_add'/>
        <input type='hidden' id='displayPath' value='/strasbourg/user/index?model=1'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 