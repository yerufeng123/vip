<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>一汽丰田</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <style>
            .login_box{
                width: 300px;
                height: 200px;
                background:#eeeeee;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -150px;
                margin-top: -100px;
                text-align: center;
            }
        </style>
    </head>
    <body>

        <div class="login_box">
            <div style='margin:auto;width: 200px;margin-top: 50px;line-height: 30px'>
                <div class="user" style="float:left">
                    <label>用&nbsp;户&nbsp;名:</label><span >一汽丰田</span>
                </div>
                <div class="password" style="float:left">
                    <label>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:</label>
                    <input type="text" style="width:120px" id='psw'>
                </div>
                <div style='float:left;margin-left: 70px;margin-top: 10px;'>
                    <input type='button' value='提交' style="width: 55px;height: 30px;" id='sub_btn'>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/yiqi/js/jquery-2.1.1.min.js"></script>
    
    <script>
        $(function(){
            //单击提交
            $('#sub_btn').bind('click',function(){
                var psw=$('#psw').val();
            if(psw == ''){
                alert('请输入密码');
                return false;
            }
                $.post('/diantong/ajaxlogin',{'psw':psw},function(data){
                    var list=eval('('+data+')');
                    if(list.code != '10000'){
                        alert(list.result);
                    }else{
                        location.href=list.result;
                    }
                    
                });
            });
        });
    </script>
</html>
