<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>



<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            区域名称:<input type="text" name="name" value="" class="input25" maxlength="125"/><font color="red">*必填</font><br/>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/jinganshun/recruit/areaeditor'/>
        <input type='hidden' id='displayPath' value='/jinganshun/recruit/area?model=3'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 
<script>
    function checkFormSerialize() {
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