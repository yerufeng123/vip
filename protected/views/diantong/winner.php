
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>一汽丰田</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/diantong/css/main.css?random=<?php echo time();?>"/>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/diantong/js/jquery-2.1.1.min.js"></script>
    </head>
    <body style="background:#000;">
        <div class="box box_list">
            <div class="list_bg"></div>
            <ul class="box1" id="box1">
                
            </ul>


        </div>

    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>js/jquery-1.8.3.min.js<?php echo (Yii::app()->params['diantong']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
    <script type="text/javascript">
        $(function () {
            setInterval('getwinner()',1000);
        })

        //获取最新赢家
        function getwinner() {
            $.post('/diantong/ajaxgetnewwinner2', {}, function (data) {
                var list = eval('(' + data + ')');
                if (list.code != '10000') {
                    alert(list.result);
                } else {
                    if (list.result != '') {
                        $('#box1').html('');
                        if (list.result[0].phone != '' && list.result[0].phone != undefined) {
                            $('#box1').append('<li class="first"><img src="'+list.result[0].headpic+'"><span><strong class="name"> ' + list.result[0].nickname + '</strong> ' + list.result[0].phone + '   获得<strong>' + list.result[0].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[1].phone != '' && list.result[1].phone != undefined) {
                            $('#box1').append('<li class="second"><img src="'+list.result[1].headpic+'"><span><strong class="name"> ' + list.result[1].nickname + '</strong> ' + list.result[1].phone + '   获得<strong>' + list.result[1].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[2].phone != '' && list.result[2].phone != undefined) {
                            $('#box1').append('<li class="third"><img src="'+list.result[2].headpic+'"><span><strong class="name"> ' + list.result[2].nickname + '</strong> ' + list.result[2].phone + '   获得<strong>' + list.result[2].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[3].phone != '' && list.result[3].phone != undefined) {
                            $('#box1').append('<li class="four"><img src="'+list.result[3].headpic+'"><span><strong class="name"> ' + list.result[3].nickname + '</strong> ' + list.result[3].phone + '   获得<strong>' + list.result[3].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[4].phone != '' && list.result[4].phone != undefined) {
                            $('#box1').append('<li class="five"><img src="'+list.result[4].headpic+'"><span><strong class="name"> ' + list.result[4].nickname + '</strong> ' + list.result[4].phone + '   获得<strong>' + list.result[4].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[5].phone != '' && list.result[5].phone != undefined) {
                            $('#box1').append('<li class="six"><img src="'+list.result[5].headpic+'"><span><strong class="name"> ' + list.result[5].nickname + '</strong> ' + list.result[5].phone + '   获得<strong>' + list.result[5].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[6].phone != '' && list.result[6].phone != undefined) {
                            $('#box1').append('<li class="seven"><img src="'+list.result[6].headpic+'"><span><strong class="name"> ' + list.result[6].nickname + '</strong> ' + list.result[6].phone + '   获得<strong>' + list.result[6].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[7].phone != '' && list.result[7].phone != undefined) {
                            $('#box1').append('<li class="eight"><img src="'+list.result[7].headpic+'"><span><strong class="name"> ' + list.result[7].nickname + '</strong> ' + list.result[7].phone + '   获得<strong>' + list.result[7].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[8].phone != '' && list.result[8].phone != undefined) {
                            $('#box1').append('<li class="nine"><img src="'+list.result[8].headpic+'"><span><strong class="name"> ' + list.result[8].nickname + '</strong> ' + list.result[8].phone + '   获得<strong>' + list.result[8].price1 + '</strong>元红包</span></li>');
                        }
                        if (list.result[9].phone != '' && list.result[9].phone != undefined) {
                            $('#box1').append('<li class="ten"><img src="'+list.result[9].headpic+'"><span><strong class="name"> ' + list.result[9].nickname + '</strong> ' + list.result[9].phone + '  获得<strong>' + list.result[9].price1 + '</strong>元红包</span></li>');
                        }

                    }
                }
            });
        }

    </script>

</html>