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
        $.post(controlPath, aQuery, function(data) {
            if (data != '') {
                alert(data);
            } else {
                location.href = document.referrer;
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
            员工姓名:<input type="text" name="name" value="<?php echo $list['name']; ?>" class="input25" maxlength="10"/><font color="green">*选填</font><br/>
            员工编号:<input type="text" name="username" value="<?php echo $list['username']; ?>" class="input25"  maxlength="15"readonly="readonly" style="color:#d2d2d2"/><font color="red">*必填</font><br/>
            手&emsp;&emsp;机:<input type="text" name="phone" class="input25" value="<?php echo $list['phone']; ?>" id="phone" maxlength="11"/><font color="green">*选填</font><br/>
            <div class="clearbar5"></div>
            启&emsp;&emsp;用:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<input type="radio" name="enable"  <?php
            if ($list['enable'] == '0') {
                echo 'checked';
            }
            ?>  value="0"/>否&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="enable" <?php
                                                                                                          if ($list['enable'] == '1') {
                                                                                                              echo 'checked';
                                                                                                          }
                                                                                                          ?> value="1"/>是&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<br/>
            <div class="clearbar5"></div>
            <input type='hidden' id='user_id' name='id' value='<?php echo $list['id']; ?>' />

            <div class="clearbar10"></div>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="user_reset"  value="重置" />
            <input class='button50' type="button" name="user_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/qizheng/user/user_editor'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 