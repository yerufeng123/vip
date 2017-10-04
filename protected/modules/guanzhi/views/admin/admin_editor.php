<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            账号:<input type="text" name="username" value="<?php echo $list['username']; ?>" class="input25" readonly="readonly" style="color:#d2d2d2" maxlength="15"/><font color="red">*必填</font><br/>
            姓名:<input type="text" name="name" value="<?php echo $list['name']; ?>" class="input25" maxlength="10"/><font color="red">*必填</font><br/>
            角色:<select name="role" class="select25" id="admin_role" onchange="rolechange()">
                <?php
                if ($this->session('admin_role') == 1) {
                    if ($list['role'] == '1') {
                        echo '<option value="1" selected ="selected">超级管理员</option>';
                    } else {
                        echo '<option value="1" >超级管理员</option>';
                    }
                }
                if ($this->session('admin_role') == 1 || $this->session('admin_role') == 2) {
                    if ($list['role'] == '1') {
                        echo '<option value="2" selected ="selected">普通管理员</option>';
                    } else {
                        echo '<option value="2">普通管理员</option>';
                    }
                }
                ?>
            </select><font color="red">*必填</font><br/>
            <div class="clearbar5"></div>
            性别:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<input type="radio" name="sex"  <?php
            if ($list['sex'] == '1') {
                echo 'checked';
            }
            ?>  value="1"/>男&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="sex" <?php
                                                                                        if ($list['sex'] == '2') {
                                                                                            echo 'checked';
                                                                                        }
                                                                                        ?> value="2"/>女&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<br/>
            <div class="clearbar5"></div>
            Q&ensp;Q:<input type="text" name="qq" class="input25" maxlength="13" value="<?php echo $list['qq']; ?>" /><font color="green">*选填</font><br/>
            手机:<input type="text" name="phone" class="input25" maxlength="11" value="<?php echo $list['phone']; ?>" id="phone"/><font color="red">*必填</font><br/>
            住址:<textarea name="address" class="textarea100" maxlength="100"><?php echo $list['address']; ?></textarea><font color="green">*选填</font><br/>
            <div class="clearbar5"></div>
            启用:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<input type="radio" name="enable"  <?php
            if ($list['enable'] == '0') {
                echo 'checked';
            }
            ?>  value="0"/>否&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="enable" <?php
                                                                                  if ($list['enable'] == '1') {
                                                                                      echo 'checked';
                                                                                  }
                                                                                  ?> value="1"/>是&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<br/>
            <div class="clearbar5"></div>
            <input type='hidden' id='admin_id' name='id' value='<?php echo $list['id']; ?>' />

            <div class="clearbar10"></div>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/guanzhi/admin/admin_editor'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 

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