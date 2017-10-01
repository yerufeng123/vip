<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- 修改开始 -->
        <!-- 预加载页面 -->
        <!-- 修改开始 -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,user-scalable=no">
        <title>电通后台</title>
    </head>
    <body>
        <div style="margin: auto;text-align: center;width:80%;border: 2px solid #ccc">
            <div>
                <form action="/diantong/admin" method="post" >

                    审核状态：<select name="enable">
                        <option value="" <?php if ($search['enable'] == '') echo 'selected="selected"'; ?>>全部</option>
                        <option value="0" <?php if ($search['enable'] == '0') echo 'selected="selected"'; ?>>待审核</option>
                        <option value="1" <?php if ($search['enable'] == '1') echo 'selected="selected"'; ?>>通过</option>
                        <option value="2" <?php if ($search['enable'] == '2') echo 'selected="selected"'; ?>>未通过</option>
                        <option value="3" <?php if ($search['enable'] == '3') echo 'selected="selected"'; ?>>已读取</option>
                    </select>

                    <input type="submit" value="检索"><input type="button" <?php if($state == '1'){ echo 'value="关闭动效"';}else{echo 'value="开启动效"';}?> id="playpic"><input type="button" value="批量通过" id="allcheck"><input type="button" value="重新审核" id="reset"><input type="button" <?php if($end == '1'){ echo 'value="关闭结束动效"';}else{echo 'value="开启结束动效"';} ?> id="endbutton">
                </form>
            </div>
            <div style="margin: auto;text-align: center">
                <table border="1">
                    <tr><th>序号</th><th>微信标识符</th><th>图片</th><th>状态</th><th>创建时间</th><th>操作</th></tr>
                    <?php if (isset($list) && is_array($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr><td><?php echo $key + 1; ?></td><td><?php echo $value['openid'] ?></td><td><img src="<?php echo $value['pic'] ?>" width="150px" height="150px"></td><td><?php
                                    if ($value['enable'] == '0') {
                                        echo '<font color="blue">待审核</font>';
                                    } elseif ($value['enable'] == '1') {
                                        echo '<font color="green">通过</font>';
                                    } elseif ($value['enable'] == '2') {
                                        echo '<font color="red">未通过</font>';
                                    } else {
                                        echo '<font color="black">已读取</font>';
                                    }
                                    ?></td><td><?php echo date('Y-m-d H:i:s', $value['ctime']); ?></td><td><a href="javascript:void(0)" onclick="check(1,<?php echo $value['id'] ?>)" style="margin-right: 30px;">通过</a><a href="javascript:void(0)" onclick="check(2,<?php echo $value['id'] ?>)" style="margin-right: 30px;">未通过</a><a href="javascript:void(0)" onclick="check(3,<?php echo $value['id'] ?>)">删除</a></td></tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                </table>
            </div>
            <div >
                <?php echo $page; ?>
            </div>
        </div>
        <div style="margin: auto;text-align: center;width:80%;border: 2px solid #ccc;margin-top: 100px;" >
            <h1>当前状态：<b id="currentstate">关闭</b></h1>
            <span><input type="button" value="关闭摇奖" onclick="setstate(0)" style="margin-right: 100px"></span><span><input type="button" value="开启第一轮" onclick="setstate(1)" style="margin-right: 100px"></span><span><input type="button" value="开启第二轮" onclick="setstate(2)"></span>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/jquery-1.8.3.min.js"></script>
    <script>
                document.addEventListener("touchmove", function (e) {
                    e.preventDefault()
                })
    </script>
    <script>
        function setstate(state) {
            $.post('/diantong/ajaxsetstate', {'state': state}, function (data) {
                var list = eval('(' + data + ')');
                if (list.code != '10000') {
                    alert(list.result);
                } else {
                    if (state == 2) {
                        $('#currentstate').html('第二轮');
                    } else if (state == 1) {
                        $('#currentstate').html('第一轮');
                    } else {
                        $('#currentstate').html('关闭');
                    }
                    alert('操作成功！');
                }
            })
        }
        function check(state, pid) {
            $.post('/diantong/ajaxcheckphoto', {'state': state, 'pid': pid}, function (data) {
                var list = eval('(' + data + ')');
                if (list.code != '10000') {
                    alert(list.result);
                } else {
                    location.reload();
                }
            })
        }
        $(function () {
            $('#playpic').bind('click', function () {
                $.post('/diantong/ajaxchangephoto', {}, function (data) {
                    var list = eval('(' + data + ')');
                    if (list.code != '10000') {
                        alert(list.result);
                    } else {
                        if (list.result == '动效开启成功') {
                            alert(list.result);
                            $('#playpic').attr('value', '关闭动效');
                        } else if (list.result == '动效关闭成功') {
                            alert(list.result);
                            $('#playpic').attr('value', '开启动效');
                        } else {
                            //异常
                        }
                    }
                });
            });
            //批量通过
            $('#allcheck').bind('click', function () {
                $.post('/diantong/ajaxsetallpic', {}, function (data) {
                    var list = eval('(' + data + ')');
                    if (list.code != '10000') {
                        alert(list.result);
                    } else {
                        location.reload();
                    }
                });
            });
            //重新审核
            $('#reset').bind('click', function () {
                $.post('/diantong/ajaxresetpic', {}, function (data) {
                    var list = eval('(' + data + ')');
                    if (list.code != '10000') {
                        alert(list.result);
                    } else {
                        alert('重置成功！');
                        location.reload();
                    }
                })
            })
            
            //结束特效
            $('#endbutton').bind('click',function(){
                $.post('/diantong/ajaxsetend', {}, function (data) {
                    var list = eval('(' + data + ')');
                    if (list.code != '10000') {
                        alert(list.result);
                    } else {
                        if (list.result == '结束动效开启成功') {
                            alert(list.result);
                            $('#endbutton').attr('value', '关闭结束动效');
                        } else if (list.result == '结束动效关闭成功') {
                            alert(list.result);
                            $('#endbutton').attr('value', '开启结束动效');
                        } else {
                            //异常
                        }
                    }
                })
            });
        });
    </script>





</html>