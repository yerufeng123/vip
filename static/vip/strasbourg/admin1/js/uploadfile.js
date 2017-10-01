/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//上传一张
//商家店标小，不要上传多张，不支持
for (var i = 1; i <= 100; i++) {
    $(function() {
        var product_upload='#product_upload'+i;
        var product_pic='#product_pic'+i;
        var product_photo='#product_photo'+i;
        var product_pic1='product_pic'+i;
        $(product_upload).uploadify({
            'swf': '/Public/uploadify/uploadify.swf', //指定上传控件的主体文件
            'uploader': '/tcback.php/Common/uploadify1?width=480&height=195', //指定服务器端上传处理文件
            'buttonText': '上传图片',
            //其他配置项
            'onUploadStart': function(file) {
                //$('#tu').remove();
            },
            'onUploadSuccess': function(file, data, response) {
                /*删除原有大图像*/
               var picsrc = $(product_pic).val();
                var oldpic = $(product_pic).val();
                $.post('/tcback.php/Common/deletesrc', {'picsrc': picsrc, 'oldpic': oldpic}, function(src) {
                });
                $(product_photo).html('');
                var temp = explode(',', data);
                var big = temp[0];
                var path = 'uploads' + big.substr(9); //uploadify插件有缺陷，会把返回的路径部分字符转为unicode编码,需要截取掉这部分
                $(product_photo).append('<img width="480px" height="195px" id="tu" class="tu_class" name="tu_class" src="/' + path + '" />');
                $(product_photo).append('<input type="button" class="buttons" value="删除"/>');
                $(product_pic).val(path); //保存图片路径，便于存入数据库
                $(".buttons").click(function() {
                    //$('#fourable_little_pic3').val('');//点删除就清空商家小图路径
                    //需要从拼好的字符串中删掉该图的src
                    delpic(this, product_pic1);
                });
            }
        });
    });
}
/*$(function() {
        $('#product_upload1').uploadify({
            'swf': '/Public/uploadify/uploadify.swf', //指定上传控件的主体文件
            'uploader': '/tcback.php/Common/uploadify1?width=480&height=195', //指定服务器端上传处理文件
            'buttonText': '上传图片',
            //其他配置项
            'onUploadStart': function(file) {
                //$('#tu').remove();
            },
            'onUploadSuccess': function(file, data, response) {
                var picsrc = $('#product_pic1').val();
                var oldpic = $('#product_pic1').val();
                $.post('/tcback.php/Common/deletesrc', {'picsrc': picsrc, 'oldpic': oldpic}, function(src) {
                });
                $('#product_photo1').html('');
                var temp = explode(',', data);
                var big = temp[0];
                var path = 'uploads' + big.substr(9); //uploadify插件有缺陷，会把返回的路径部分字符转为unicode编码,需要截取掉这部分
                $('#product_photo1').append('<img width="480px" height="195px" id="tu" class="tu_class" name="tu_class" src="/' + path + '" />');
                $('#product_photo1').append('<input type="button" class="buttons" value="删除"/>');
                $('#product_pic1').val(path); //保存图片路径，便于存入数据库
                $(".buttons").click(function() {
                    //$('#fourable_little_pic3').val('');//点删除就清空商家小图路径
                    //需要从拼好的字符串中删掉该图的src
                    delpic(this, 'product_pic1');
                });
            }
        });
    });
    $(function() {
        $('#product_upload2').uploadify({
            'swf': '/Public/uploadify/uploadify.swf', //指定上传控件的主体文件
            'uploader': '/tcback.php/Common/uploadify1?width=480&height=195', //指定服务器端上传处理文件
            'buttonText': '上传图片',
            //其他配置项
            'onUploadStart': function(file) {
                //$('#tu').remove();
            },
            'onUploadSuccess': function(file, data, response) {
                var picsrc = $('#product_pic2').val();
                var oldpic = $('#product_pic2').val();
                $.post('/tcback.php/Common/deletesrc', {'picsrc': picsrc, 'oldpic': oldpic}, function(src) {
                });
                $('#product_photo2').html('');
                var temp = explode(',', data);
                var big = temp[0];
                var path = 'uploads' + big.substr(9); //uploadify插件有缺陷，会把返回的路径部分字符转为unicode编码,需要截取掉这部分
                $('#product_photo2').append('<img width="480px" height="195px" id="tu" class="tu_class" name="tu_class" src="/' + path + '" />');
                $('#product_photo2').append('<input type="button" class="buttons" value="删除"/>');
                $('#product_pic2').val(path); //保存图片路径，便于存入数据库
                $(".buttons").click(function() {
                    //$('#fourable_little_pic3').val('');//点删除就清空商家小图路径
                    //需要从拼好的字符串中删掉该图的src
                    delpic(this, 'product_pic2');
                });
            }
        });
    });*/
