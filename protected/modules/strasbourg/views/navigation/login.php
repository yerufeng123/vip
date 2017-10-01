<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>斯特拉斯堡圣诞小镇商户后台</title>
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
                    <label>商户手机:</label>
                    <input type="text" style="width:120px" id='phone'>
                </div>
                <div class="password" style="float:left">
                    <label>木屋编号:</label>
                    <input type="text" style="width:120px" id='roomnumer'>
                </div>
                <div style='float:left;margin-left: 70px;margin-top: 10px;'>
                    <input type='button' value='提交' style="width: 55px;height: 30px;" id='sub_btn'>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/yiqi/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/yiqi/js/jquery-2.1.1.min.js"></script>
    <script src="<?php echo _STATIC_ ;?>js/globals.js"></script>
    
    <script>
        $(function(){
            //单击提交
            $('#sub_btn').bind('click',function(){
                var phone=$('#phone').val();
                var roomnumer=$('#roomnumer').val();
            if(phone == ''){
                alert('请输入手机');
                return false;
            }
            if(!check_phone(phone)){
            	alert('手机格式不正确');
                return false;
            }
            if(roomnumer == ''){
                alert('请输入木屋编号');
                return false;
            }
            
                $.post('/strasbourg/navigation/login',{'phone':phone,'roomnumer':roomnumer},function(data){
                    var list=eval('('+data+')');
                    if(list.code != '10000'){
                        alert(list.result);
                    }else{
                        location.href='/strasbourg/navigation/admin';
                    }
                    
                });
            });
        });
    </script>
</html>
