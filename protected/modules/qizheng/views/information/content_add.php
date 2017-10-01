<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>





<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            文献标题:<input type="text" name="title" value="" class="input25" maxlength="125"/><font color="red">*必填</font><br/>
            所属产品:<select name="pid" class="select25" id="pid" onchange="changePro(this);">
                <option value="" >请选择产品</option>    
            </select><font color="red">*必填</font><br />
            所属分类:<select name="Iid" class="select25" id="Iid">
                <option value="" >请选择分类</option>    
            </select><font color="red">*必填</font><br /><br/>
            <center><script id="editor" type="text/plain" style="width:435px;height:500px;"></script></center>
            <input type="hidden" id="content" name="content" value="" />
            <div class="clearbar10"></div>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/qizheng/information/content_add'/>
        <input type='hidden' id='displayPath' value='/qizheng/information/content_index?model=3'/>
    </form>
</div>
<body>




<?php $this->renderPartial("/public/buttom") ?> 
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
     function getContent() {
        var arr = [];
        arr.push(UE.getEditor('editor').getContent());
        return arr.join("\n");
    }
</script>
<script>
    function checkFormSerialize() {
        setvalue();
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
    
    //将文本框中的值，赋给隐藏变量
    function setvalue(){
        var contentvalue=getContent();
        $('#content').val(contentvalue);
    }
</script>
<script>
    $(function() {
         //初始化产品列表
        $.post('/qizheng/product/ajaxgetproduct', {}, function(data) {
            var list = eval(data);
            for (var i in list) {
                $('#pid').append("<option value=" + (list[i].id) + ">" + list[i].name + "</option>");
            }
        });
        
    });
    function changePro(obj){
        var pid=$(obj).val();
        //初始化导航分类列表
        $.post('/qizheng/information/ajaxgetinformation', {'pid':pid}, function(data) {
            $('#Iid').html('');
            if(data == '[]'){
                $('#Iid').append('<option value="" >暂无分类</option>');
            }else{
                $('#Iid').append('<option value="" >请选择分类</option>');
            }
            
            var list = eval(data);
            for (var i in list) {
                $('#Iid').append("<option value=" + (list[i].id) + ">" + list[i].title + "</option>");
            }
        });
    }
</script>