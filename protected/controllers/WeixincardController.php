<?php

header("Content-Type:text/html;charset=utf-8");
/*
 * 卡包调用示例（需要加载下cardSDK类）
 * 高祥栋
 * 2015-4-1
 */

class WeixincardController extends Controller {

    public $weObj; //wechat类对象
    public $openid; //用户openid

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        include_once Yii::app()->basePath . '/components/cardSDK.php';//如果做卡包业务，这个一定要先引入
        $options = array(
            'token' => Yii::app()->params['common']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['common']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['common']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['common']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        
        $this->openid=  $this->_Getopenid();
    }
    
    //卡券相关功能测试首页
    public function actionIndex() {
        $this->renderPartial("cardlist");
    }
    
    

    //上传公司logo
    public function actionUploadlogo($dy = true) {
        $data = array(
            'buffer' => '@' . _STATICPATH_ . 'img/logo.png',
        );

        $data = $this->weObj->uploadLogo($data);
        if (!$data) {
            $this->_error('100001', '网络繁忙，logo上传失败！');
        }
        if ($dy) {
            echo '<pre>';
            var_dump($data['url']);
            die;
        } else {
            return $data['url'];
        }
    }

    //获取卡包颜色列表
    public function actionColorlist($dy = true) {
        $data = $this->weObj->getCardColors();  //$card['colors']
        if (!$data) {
            $this->_error('100002', '网络繁忙，获取卡包颜色列表失败！');
        }
        if ($dy) {
            echo '<pre>';
            var_dump($data['colors']);
            die;
        } else {
            return $data['colors'];
        }
    }

    //批量导入门店信息列表
    public function actionSetstore($dy = true) {
        $stores = array(
            'location_list' => array(
                array(
                    'business_name' => '麦当劳',
                    'branch_name' => '麦当劳清河店', //分店名，非必填
                    'province' => '北京市',
                    'city' => '北京',
                    'district' => '海淀区',
                    'address' => '清河小营桥北3000米',
                    'telephone' => '010-34515588',
                    'category' => '餐饮',
                    'longitude' => '116.336020',
                    'latitude' => '40.036584',
                ),
                array(
                    'business_name' => '麦当劳',
                    'branch_name' => '麦当劳上地店', //分店名，非必填
                    'province' => '北京市',
                    'city' => '北京',
                    'district' => '海淀区',
                    'address' => '上地地铁站路对面',
                    'telephone' => '010-87524569',
                    'category' => '餐饮',
                    'longitude' => '116.319680',
                    'latitude' => '40.032930',
                ),
            ),
        );
        $data = $this->weObj->addCardLocations($stores);
        if (!$data) {
            $this->_error('100003', '网络繁忙，门店导入失败！');
        }
        if ($dy) {
            echo '<pre>';
            var_dump($data['location_id_list']);
            die;
        } else {
            return $data['location_id_list'];
        }
    }

    //拉取门店列表
    public function actionStorelist($dy = true) {
        $data = $this->weObj->getCardLocations();
        if (!$data) {
            $this->_error('100004', '网络繁忙，门店列表获取失败！');
        }
        if ($dy) {
            echo '<pre>';
            var_dump($data['location_list']);
            die;
        } else {
            return $data['location_list']; //如果要看拉取的数量  在$data['count']  中
        }
    }

    //生成卡券
    public function actionCreatecard($dy = true) {
        //上传商家logo
        //$logo = $this->actionUploadlogo(false);
        $logo = 'http://mmbiz.qpic.cn/mmbiz/FJwicmbib6MXscBJrBTVEdKBgkH9fxD5XEZurkqjlp9RKGEWuvc2slcPgOTVLdF7XN2QeIGGxeBFY3YWicYfRPhDg/0';
        //获取随机卡券颜色
        $colors = $this->actionColorlist(false);
        $num = rand(0, count($colors) - 1);
        $color = $colors[$num]['name'];
        //拉取门店列表
        $locations = $this->actionStorelist(false);
        if (isset($locations) && is_array($locations)) {
            foreach ($locations as $k => $v) {
                $location[] = $v['id'];
            }
        } else {
            $locations = array();
        }



        $base_info = Array(
            "logo_url" => $logo,
            "code_type" => "CODE_TYPE_QRCODE", //CODE_TYPE_TEXT(文本)、CODE_TYPE_BARCODE（一维码）、CODE_TYPE_QRCODE（二维码）、CODE_TYPE_ONLY_QRCODE（二维码无code显示）、CODE_TYPE_ONLY_BARCODE（一维码无code显示）
            "brand_name" => "测试商家名称", //商户名，最多12个汉字
            "title" => "132元情侣红包", //券名，最多9个汉字
            "sub_title" => "测试副标题", //券名副标题，最多18个汉字【非必填】
            "color" => $color,
            "notice" => "请出示二维码核销卡券阿斯顿发撒的", //使用提醒，最多12个汉字(经测试最多16个汉字)
            "description" => "这是使用说明文字，可以很长很长\n听说可以分行，我试验一下\n不晓得能加链接不\n描述结束",
            "date_info" => Array(//使用日期
                "type" => 1, //1 固定日期区间 2 固定时长(领取后按天算）
                "begin_timestamp" => 1427168076, //固定日期区间专用，开始时间（需要转字符串么）
                "end_timestamp" => 1449276800, //固定日期区间专用，结束时间（需要转字符串么）
            //"fixed_term"=>2,//固定时长专用，表示领取后多少天内有效，0为只有当天有效
            //"fixed_begin_term"=>3,//固定时长专用，表示自领取后多少天开始生效
            ),
            "sku" => Array(
                "quantity" => 10000000, //库存数量，不能填写0
            ),
            "location_id_list" => $location, //门店位置ID 【非必填】
            //"use_custom_code"=>true,//是否自定义code码【非必填】
            //"bind_openid"=>true,//是否指定用户领取     【非必填】
            //"can_share"=>false,//是否可分享           【非必填】
            //"can_give_friend"=>false,//卡券是否可转增    【非必填】
            "get_limit" => 50, //没人最大领取次数，不填等于库存量【非必填】
            "service_phone" => "010-59413112", //客服电话     【非必填】
            "source" => "第三方来源名", //第三方来源  【非必填】
            //"url_name_type" => "URL_NAME_TYPE_USE_IMMEDIATELY", //【貌似这个属性过期了】自定义cell类型，与custom_url共同使用 【非必填】URL_NAME_TYPE_TAKE_AWAY（外卖）URL_NAME_TYPE_RESERVATION（在线预订）URL_NAME_TYPE_USE_IMMEDIATELY（立即使用）URL_NAME_TYPE_APPOINTMENT（在线预约）URL_NAME_TYPE_EXCHANGE（在线兑换）URL_NAME_TYPE_VIP_SERVICE（会员服务：仅会员卡类型可用）
            "custom_url_name" => "现在使用", //商户自定义入口名称【非必填】5个字以内
            "custom_url_sub_title" => "右边提示哦", //显示在入口右侧的tips，长度限制在6个汉字内。【非必填】
            "custom_url" => Yii::app()->params['prefixurl'] . "/weixin/usecard", //自定义cell跳转外链地址 【非必填】
            "promotion_url_name" => "再次使用", //营销场景的自定义入口【非必填】
            "promotion_url" => "http://www.baidu.com", //入口跳转外链的地址链接【非必填】
            "promotion_url_sub_title" => "右边提示2", //显示在入口右侧的tips，长度限制在6个汉字内。【非必填】
        );
        $datacard = array(
            0 => array(//通用券
                "card" => Array(
                    "card_type" => "GENERAL_COUPON", //卡券类型
                    "general_coupon" => Array(
                        "base_info" => $base_info,
                        'default_detail' => "这是通用券测试哦",
                    ),
                ),
            ),
            1 => array(//团购券
                "card" => Array(
                    "card_type" => "GROUPON", //卡券类型
                    "groupon" => Array(
                        "base_info" => $base_info,
                        'deal_detail' => "这是团购券测试详情哦",
                    ),
                ),
            ),
            2 => array(//折扣券
                "card" => Array(
                    "card_type" => "DISCOUNT", //卡券类型
                    "discount" => Array(
                        "base_info" => $base_info,
                        'discount' => "30", //打折额度百分比，填30 就是7折
                    ),
                ),
            ),
            3 => array(//礼品券
                "card" => Array(
                    "card_type" => "GIFT", //卡券类型
                    "gift" => Array(
                        "base_info" => $base_info,
                        'gift' => "脑白金至尊套装", //礼品名称
                    ),
                ),
            ),
            4 => array(//代金券
                "card" => Array(
                    "card_type" => "CASH", //卡券类型
                    "cash" => Array(
                        "base_info" => $base_info,
                        "least_cost" => "10000", //最低消费多钱才让使用，单位为分
                        "reduce_cost" => "1000", //减免金额，单位分
                    ),
                ),
            ),
            5 => array(//会员卡
                "card" => Array(
                    "card_type" => "MEMBER_CARD", //卡券类型
                    "member_card" => Array(
                        "base_info" => $base_info,
                        'supply_bonus' => true, //是否支持积分，填写true或false，如填写true，积分相关字段均为必填。填写false，积分字段无需填写。储值字段处理方式相同
                        'supply_balance' => false, //同上
                        'bonus_cleared' => "这里填写积分清零规则", //积分清零规则 【非必填】（supply_bonus为true时，必填）
                        "bonus_rules" => "这里填写积分规则", //积分规则 【非必填】（supply_bonus为true时，必填）
                        //"balance_rules" => "这里填写储值说明", //储值说明【非必填】(supply_balance 为true 时，必填)
                        "prerogative" => "这里填写特权说明", //特权说明
                        "bind_old_card_url" => "", //绑定旧卡的url，与“activate_url”字段二选一必填【二选一】
                        "activate_url" => Yii::app()->params['prefixurl'] . "/card/membercardactive", //激活会员卡的url，与“bind_old_card_url”字段二选一必填。【二选一】
                        "need_push_on_view" => true, //为用户点击进入会员卡时是否推送事件【非必填】
                    ),
                ),
            ),
            6 => array(//景点门票
                "card" => Array(
                    "card_type" => "SCENIC_TICKET", //卡券类型
                    "scenic_ticket" => Array(
                        "base_info" => $base_info,
                        "ticket_class" => "vip门票", //票类型【非必填】
                        "guide_url" => "http://img3.imgtn.bdimg.com/it/u=96134856,263763819&fm=21&gp=0.jpg", //导览图【非必填】
                    ),
                ),
            ),
            7 => array(//电影票
                "card" => Array(
                    "card_type" => "MOVIE_TICKET", //卡券类型
                    "movie_ticket" => Array(
                        "base_info" => $base_info,
                        'detail' => "这是电影票详情哦", //电影票详情【非必填】
                    ),
                ),
            ),
            8 => array(//飞机票
                "card" => Array(
                    "card_type" => "BOARDING_PASS", //卡券类型
                    "boarding_pass" => Array(
                        "base_info" => $base_info,
                        'from' => "北京", //起点，上限18字
                        'to' => "三亚", //终点，上限18字
                        'flight' => "MH5168", //航班
                        'departure_time' => time() + 2 * 3600, //起飞时间。Unix时间戳格式。【非必填】
                        'landing_time' => time() + 4 * 3600, //降落时间。Unix时间戳格式。【非必填】
                        'check_in_url' => Yii::app()->params['prefixurl'] . "/card/boardcheckin", //在线值机的链接【非必填】
                        'gate' => "北京飞机场A口", //登机口，若有变更请调接口实时更新【非必填】
                        'boarding_time' => time() + 1.5 * 3600, //登机时间，若有变更请调接口实时更新【非必填】
                        'air_model' => '波音747大型客机', //机型 【非必填】
                    ),
                ),
            ),
            9 => array(//红包
                "card" => Array(
                    "card_type" => "LUCKY_MONEY", //卡券类型  红包类型为非现金红包，不支持体现。
                    "lucky_money" => Array(
                        "base_info" => $base_info,
                    ),
                ),
            ),
            10 => array(//会议门票
                "card" => Array(
                    "card_type" => "MEETING_TICKET", //卡券类型
                    "meeting_ticket" => Array(
                        "base_info" => $base_info,
                        "meeting_detail" => "这是会议详情哦", //会议详情
                        "map_url" => "http://img3.imgtn.bdimg.com/it/u=96134856,263763819&fm=21&gp=0.jpg", //会场导览图【非必填】
                    ),
                ),
            ),
        );


        $data = $this->weObj->createCard($datacard[9]);
        if (!$data) {
            $this->_error('100005', '网络繁忙，生成卡券失败！');
        }
        if ($dy) {
            echo '<pre>';
            var_dump($data['card_id']);
            die;
        } else {
            return $data['card_id'];
        }
    }

    //添加测试白名单
    public function actionAddtester() {
        $openidlist = array();
        $userlist = array(
            'xueseyichu',
            'zhangfu517699814',
            'gkakashi',
        );
        $user = $this->weObj->setCardTestWhiteList($openidlist, $userlist);
        var_dump($user);
        die;
    }

    //创建二维码(用户扫描二维码，进入立即领取页面，点击领取加入卡包)
    public function actionCreate2weima($card_id = "p41zRjvnWmGx2Ow_MNRngp9JAOdA", $dy = true) {
        if (empty($card_id)) {
            $list = $this->actionQuerycardlist(0, 50, false);
            $num = rand(0, $list['total_num'] - 1);
            $card_id = $list['card_id_list'][$num];
        }
        //$ticket = $this->weObj->createCardQrcode($card_id); //$ticket['ticket'] 普通卡券
        //$ticket = $this->weObj->createCardQrcode($card_id,'M234567898'); //$ticket['ticket'] 指定code (卡券必须是use_custom_code 为true 生成的卡券 并且已经在微信公众平台卡券模块中开通了SN授权)
        //$ticket = $this->weObj->createCardQrcode($card_id,'','o41zRjkNEL7JFPyvjkJXGV3WqUdE'); //$ticket['ticket'] 指定用户领取，openid(卡券必须是bind_openid 为true 生成的卡券 )
        $ticket = $this->weObj->createCardQrcode($card_id,'','',0,false,10000,2); //$ticket['ticket'] 红包卡券 场景值2
        if (!$ticket) {
            $this->_error('100007', '网络繁忙，获取卡券ticket失败！');
        }
        $ticket2 = $this->weObj->getQRUrl($ticket['ticket']);
        if (!$ticket2) {
            $this->_error('100008', '网络繁忙，卡券ticket换取二维码图片失败！');
        }
        if ($dy) {
            $this->renderPartial('ticketpic', array('ticketpic' => $ticket2, 'url' => $ticket['url']));
        } else {
            return $ticket2;
        }
    }

    //单击页面按钮，调起JSapi 进入立即领取页面，点击领取加入卡包
    public function actionAddcardbox($card_id = "p41zRjvnWmGx2Ow_MNRngp9JAOdA", $dy = true) {
        if (empty($card_id)) {
            $list = $this->actionQuerycardlist(0, 50, false);
            $num = rand(0, $list['total_num'] - 1);
            $card_id = $list['card_id_list'][$num];
        }
        //$sign = $this->weObj->getJsSign2($card_id); //普通卡券
        //$sign = $this->weObj->getJsSign2($card_id,'M234567895'); //指定code(卡券必须是use_custom_code 为true 生成的卡券 并且已经在微信公众平台卡券模块中开通了SN授权)
        //$sign = $this->weObj->getJsSign2($card_id,'','o41zRjkNEL7JFPyvjkJXGV3WqUdE'); //指定用户领取，openid(卡券必须是bind_openid 为true 生成的卡券 )
        $sign = $this->weObj->getJsSign2($card_id,'','',0,1,10000);//红包卡券,场景值为1
        $temp = addslashes(json_encode($sign));
        $this->renderPartial('kabao', array('cardid' => $card_id, 'card_ext' => $temp));
    }
    
    //新版本，添加到卡包，调起JSapi,加入卡包
    public function actionAddcard(){
        if (empty($card_id)) {
            $list = $this->actionQuerycardlist(0, 50, false);
            $num = rand(0, $list['total_num'] - 1);
            $card_id = $list['card_id_list'][$num];
        }
        //$sign = $this->weObj->getJsSign2($card_id); //普通卡券
        //$sign = $this->weObj->getJsSign2($card_id,'M234567895'); //指定code(卡券必须是use_custom_code 为true 生成的卡券 并且已经在微信公众平台卡券模块中开通了SN授权)
        //$sign = $this->weObj->getJsSign2($card_id,'','o41zRjkNEL7JFPyvjkJXGV3WqUdE'); //指定用户领取，openid(卡券必须是bind_openid 为true 生成的卡券 )
        $sign = $this->weObj->getJsSign2($card_id,'','',0,1,10000);//红包卡券,场景值为1
        $temp = addslashes(json_encode($sign));
        $this->renderPartial('addcard', array('cardid' => $card_id, 'card_ext' => $temp));
    }

    //php程序核销code 当用户自定义code时，$card_id必填
    public function actionDeletecode($code = 'M234567894', $card_id = 'p41zRjhmRwxP3Uh4kBuiZy7Kufs8', $dy = true) {
        $result = $this->weObj->consumeCardCode($code, $card_id);
        if ($dy) {
            if ($result) {
                echo '核销成功';
            } else {
                $this->_error('100006', '卡券核销失败(网络繁忙或者code已核销)！');
            }
        } else {
            if ($result) {
                return true;
            } else {
                $this->_error('100006', '网络繁忙，卡券核销失败！');
            }
        }
    }

    //JSapi拉起用户已领取卡券列表并解码换取卡券code(进一步扩展可以在此处核销掉code)
    public function actionCardlist() {
        if (empty($_POST['encrypt_code'])) {
            $sign = $this->weObj->getJsSign3();
            $this->renderPartial('hexiao', array('sign' => $sign));
        } else {
            $card_id = $_POST['card_id'];
            $encrypt_code = $_POST['encrypt_code'];
            $code = $this->weObj->decryptCardCode($encrypt_code); //$code['code']
            if (!$code) {
                $this->_error('100016', 'code解析失败：网络繁忙');
            }
            //调起 核销程序
            $result = $this->actionDeletecode($code['code'], $card_id, false);
            echo 'code为：' . $code['code'] . '的卡券核销成功！';
        }
    }
    
    //Jsapi新版拉起卡券列表
    public function actionChoosecard(){
         $sign = $this->weObj->getJsSign3();
        $this->renderPartial('choosecard',array('sign' => $sign));
    }

    //删除某种卡券
    public function actionDeletecard($card_id = "", $dy = true) {
        if (empty($card_id)) {
            $list = $this->actionQuerycardlist(0, 50, false);
            $num = rand(0, $list['total_num'] - 1);
            $card_id = $list['card_id_list'][$num];
        }
        $result = $this->weObj->delCard($card_id);
        if (!$result) {
            $this->_error('100009', '卡券删除失败！:网络忙或者卡券id不存在');
        }
        if ($dy) {
            echo '卡券' . $card_id . '删除成功！';
        } else {
            return true;
        }
    }

    //查询code
    public function actionQuerycode($code = '272773961569', $dy = true) {
        $data = $this->weObj->checkCardCode($code);
        if (!$data) {
            $this->_error('100010', 'code查询失败！:网络忙或者code不存在');
        }
        if ($dy) {
            echo '<pre>';
            print_r($data);
        } else {
            return $data; //用户识别码：$data['openid']  卡券id:$data['card']['card_id'] 开始时间：$data['card']['begin_time"']结束时间：$data['card']['end_time"']
        }
    }

    //批量查询卡列表
    public function actionQuerycardlist($offset = 0, $count = 50, $dy = true) {
        $data = $this->weObj->getCardIdList($offset = 0, $count = 50);
        if (!$data) {
            $this->_error('100011', '网络繁忙，卡列表查询失败！');
        }
        if ($dy) {
            echo '<pre>';
            print_r($data);
        } else {
            return $data; //卡列表：$data['card_id_list']  卡数量:$data['total_num']
        }
    }

    //查询卡券详情
    public function actionQuerycardinfo($card_id = "", $dy = true) {
        if (empty($card_id)) {
            $list = $this->actionQuerycardlist(0, 50, false);
            $num = rand(0, $list['total_num'] - 1);
            $card_id = $list['card_id_list'][$num];
        }
        $data = $this->weObj->getCardInfo($card_id);
        if (!$data) {
            $this->_error('100012', '卡详情查询失败：网络繁忙或者卡券不存在');
        }
        if ($dy) {
            echo '<pre>';
            print_r($data);
        } else {
            return $data;
        }
    }

    //更改code(未成功,因为不是自定义code商户)
    public function actionChangecode($code = "272773961569", $card_id = "p41zRjkqfmFvxq3HCy6yFoHHdk_c", $new_code = "", $dy = true) {
        if (empty($new_code)) {
            $new_code = time() . rand(10, 99) . '';
        }
        $data = $this->weObj->updateCardCode($code, $card_id, $new_code);
        if (!$data) {
            $this->_error('100013', 'code更改失败：网络繁忙或者卡券id或code不合格或不是自定义code商户');
        }
        if ($dy) {
            echo '更改成功';
        } else {
            return true;
        }
    }

    //设置某个用户的某个卡券失效 ($card_id 自定义 code 的卡券必填。非自定义 code 的卡券不填)
    public function actionCancelcard($code = '516391756610', $card_id = '', $dy = true) {
        $data = $this->weObj->unavailableCardCode($code, $card_id = '');
        if (!$data) {
            $this->_error('100014', 'code更改失败：网络繁忙或者code已失效或是自定义code商户单没有填写card_id');
        }
        if ($dy) {
            echo '设置失效成功';
        } else {
            return true;
        }
    }

    //更改卡券信息
    public function actionUpdatecardinfo($dy = true) {
        $logo = $this->actionUploadlogo(false);
        $colors = $this->actionColorlist(false);
        $num = rand(0, count($colors) - 1);
        $color = $colors[$num]['name'];
        $base_info = Array(
            "logo_url" => $logo,
            "code_type" => "CODE_TYPE_QRCODE", //CODE_TYPE_TEXT(文本)、CODE_TYPE_BARCODE（一维码）、CODE_TYPE_QRCODE（二维码）、CODE_TYPE_ONLY_QRCODE（二维码无code显示）、CODE_TYPE_ONLY_BARCODE（一维码无code显示）
            "sub_title" => "测试副标题", //券名副标题，最多18个汉字【非必填】
            "color" => $color,
            "notice" => "请出示二维码核销卡", //使用提醒，最多12个汉字(经测试最多16个汉字)
            "description" => "这是使用说明文字，可以很长很长\n听说可以分行，我试验一下\n不晓得能加链接不\n描述结束",
            "date_info" => Array(//使用日期
                "type" => 1, //1 固定日期区间 2 固定时长(领取后按天算）
                "begin_timestamp" => 1427168076, //固定日期区间专用，开始时间（需要转字符串么）
                "end_timestamp" => 1849276800, //固定日期区间专用，结束时间（需要转字符串么）
            //"fixed_term"=>2,//固定时长专用，表示领取后多少天内有效，0为只有当天有效
            //"fixed_begin_term"=>3,//固定时长专用，表示自领取后多少天开始生效
            ),
            //"location_id_list" => $location, //门店位置ID 【非必填】
            //"can_share"=>false,//是否可分享           【非必填】
            //"can_give_friend"=>false,//卡券是否可转增    【非必填】
            "get_limit" => 5, //没人最大领取次数，不填等于库存量【非必填】
            "service_phone" => "010-59413112", //客服电话     【非必填】
            "url_name_type" => "URL_NAME_TYPE_USE_IMMEDIATELY", //自定义cell类型，与custom_url共同使用 【非必填】URL_NAME_TYPE_TAKE_AWAY（外卖）URL_NAME_TYPE_RESERVATION（在线预订）URL_NAME_TYPE_USE_IMMEDIATELY（立即使用）URL_NAME_TYPE_APPOINTMENT（在线预约）URL_NAME_TYPE_EXCHANGE（在线兑换）URL_NAME_TYPE_VIP_SERVICE（会员服务：仅会员卡类型可用）
            "custom_url" => "http://www.baidu.com", //自定义cell跳转外链地址 【非必填】
        );
        $dataarr = array(
            0 => array(//通用卡券类型更新
                "card_id" => "p41zRjkqfmFvxq3HCy6yFoHHdk_c",
                "general_coupon" => Array(
                    "base_info" => $base_info,
                ),
            ),
        );
        $data = $this->weObj->updateCard($dataarr[0]);
        if (!$data) {
            $this->_error('100015', '卡券信息更新失败：网络繁忙');
        }
        if ($dy) {
            echo '更新成功';
        } else {
            return true;
        }
    }

    //库存修改接口
    public function actionUpdatetotalnum($dy = true) {
        $dataarr = array(
            "card_id" => "p41zRjkqfmFvxq3HCy6yFoHHdk_c",
            "increase_stock_value" => "20", //增加多少库存，可以不填或填0
            "reduce_stock_value" => "", //减少多少库存，可以不填或填0
        );
        $data = $this->weObj->modifyCardStock($dataarr);
        if (!$data) {
            $this->_error('100015', '增删库存失败失败：网络繁忙');
        }
        if ($dy) {
            echo '更改库存成功';
        } else {
            return true;
        }
    }

    //激活/绑定会员卡
    public function actionMembercardactive($init_bonus = 50, $init_balance = 0, $bonus_url = 'www.google.com', $balance_url = '', $membership_number = 'AAA000001', $code = '', $card_id = '', $dy = true) {
        //以文件系统代替数据库，最好从数据库读取
        if (empty($code)) {
            $huiyuan = json_decode(file_get_contents(_STATICPATH_ . 'huiyuan' . $this->openid . '.txt'), true);
            $code = $huiyuan['code'];
            $card_id = $huiyuan['card_id'];
        }
        $dataarr = array(
            'init_bonus' => $init_bonus, //初始积分，不填为0。【非必填】
            'init_balance' => $init_balance, //初始余额，不填为0。【非必填】
            'bonus_url' => $bonus_url, //积分查询，仅用于init_bonus无法同步的情况填写，调转外链查询积分【非必填】
            'balance_url' => $balance_url, //余额查询，仅用于init_balance无法同步的情况填写，调转外链查询积分【非必填】
            'membership_number' => $membership_number, //会员卡编号，作为序列号显示在用户的卡包里 显示在普通卡券的code位置
            'code' => $code, //创建会员卡时获得的code
            'card_id' => $card_id, //卡券ID。自定义code的会员卡必填card_id，非自定义code的会员卡不必填。【非必填】
        );
        $data = $this->weObj->activateMemberCard($dataarr);
        if (!$data) {
            $this->_error('100017', '激活会员卡失败：网络繁忙');
        }
        if ($dy) {
            echo '激活成功';
        } else {
            return true;
        }
    }

    //会员卡交易
    public function actionMembercardupdate($code = '', $add_bonus = 10, $record_bonus = '消费100元,获10积分', $add_balance = 0, $record_balance = '', $card_id = '', $dy = true) {
        //以文件系统代替数据库，最好从数据库读取
        if (empty($code)) {
            $huiyuan = json_decode(file_get_contents(_STATICPATH_ . 'huiyuan' . $this->openid . '.txt'), true);
            $code = $huiyuan['code'];
            $card_id = $huiyuan['card_id'];
        }

        $dataarr = array(
            "code" => $code, //要消耗的序列号
            "add_bonus" => $add_bonus, //需要变更的积分，扣除积分用“-“表示。【非必填】
            "record_bonus" => $record_bonus, //商家自定义积分消耗记录，不超过14个汉字。【非必填】
            "add_balance" => $add_balance, //需要变更的余额，扣除金额用“-”表示。单位为分。【非必填】
            "record_balance" => $record_balance, //商家自定义金额消耗记录，不超过14个汉字。【非必填】
            "card_id" => $card_id, //要消耗序列号所述的card_id。自定义code的会员卡必填。【非必填】
        );
        $data = $this->weObj->updateMemberCard($dataarr);
        if (!$data) {
            $this->_error('100018', '会员卡交易失败：网络繁忙');
        }
        if ($dy) {
            echo '交易成功';
        } else {
            return true;
        }
    }

    //电影票信息更新（先让用户填写选票信息，当在推送中检测到用户领取了电影票后，同时调用此方法更新用户选座等信息）
    public function actionMovieticketupdate($code = '806606754855', $ticket_class = '4D', $show_time = '', $duration = 120, $screening_room = '5号影厅', $seat_number = array('5排14号', '5排15号'), $card_id = '', $dy = true) {

        if (empty($show_time)) {
            $show_time = time() + 2 * 3600;
        }

        $dataarr = array(
            "code" => $code, //序列号
            "ticket_class" => $ticket_class, //电影票的类别，如2D、3D
            "show_time" => $show_time, //电影放映时间对应的时间戳。
            "duration" => $duration, //放映时长，填写整数。
            "screening_room" => $screening_room, //该场电影的影厅信息。
            "seat_number" => $seat_number, //座位号。
            "card_id" => $card_id, //序列号所述的card_id。自定义code的会员卡必填。【非必填】
        );
        $data = $this->weObj->updateMovieTicket($dataarr);
        if (!$data) {
            $this->_error('100019', '电影票更新失败：网络繁忙');
        }
        if ($dy) {
            echo '更新成功';
        } else {
            return true;
        }
    }

    //飞机票信息更新（方法一：先让用户填写选座信息，然后领取卡券，当在推送中检测到用户领取了电影票后，立即调用此方法更新用户选座等信息 方法二：在飞机票卡券中点击在线办理登机牌，填写信息后，调用此方法）
    public function actionBoardcheckin($code = '162480830752', $passenger_name = '高祥栋', $class = '头等舱', $seat = '12号', $etkt_bnr = 'ABC00001', $qrcode_data = 'CBA00001', $is_cancel = false, $card_id = '', $dy = true) {

        if (empty($show_time)) {
            $show_time = time() + 2 * 3600;
        }

        $dataarr = array(
            "code" => $code, //序列号
            "passenger_name" => $passenger_name, //乘客姓名，上限为15个汉字。
            "class" => $class, //乘客姓名，上限为15个汉字。
            "seat" => $seat, //乘客座位号。【非必填】
            "etkt_bnr" => $etkt_bnr, //电子客票号，上限为14个数字。
            "qrcode_data" => $qrcode_data, //二维码数据。乘客用于值机的二维码字符串，微信会通过此数据为用户生成值机用的二维码。【非必填】显示在普通卡券的code位置
            "is_cancel" => $is_cancel, //是否取消值机。填写true或false。true代表取消，如填写true上述字段（如calss等）均不做判断，机票返回未值机状态，乘客可重新值机。默认填写false【非必填】
            "card_id" => $card_id, //序列号所述的card_id。自定义code的会员卡必填。【非必填】
        );
        $data = $this->weObj->boardingpassCheckin($dataarr);
        if (!$data) {
            $this->_error('100020', '飞机票更新失败：网络繁忙');
        }
        if ($dy) {
            echo '更新成功';
        } else {
            return true;
        }
    }

    /**
     * 更新红包余额
     * @param $balance 需要更新的金额 单位为分  示例为5元
     */
    
    public function actionRedpacketupdate($code = '480239914505', $balance = '500', $card_id = '',$dy=true) {
        $data=$this->weObj->updateLuckyMoney($code, $balance, $card_id);
        if (!$data) {
            $this->_error('100021', '红包金额更新失败：网络繁忙');
        }
        if ($dy) {
            echo '更新成功';
        } else {
            return true;
        }
    }

    //更新会议门票信息
    public function actionMeetingticketupdate($code='446924698755',$zone='D区',$entrance='西大门',$seat_number='3排22号',$begin_time='',$end_time='',$card_id='',$dy=true) {
        if(empty($begin_time)){
            $begin_time=time()+2*3600;
        }
        if(empty($end_time)){
            $end_time=time()+4*3600;
        }
        $dataarr = array(
            "code" => $code, //序列号
            "zone" => $zone, //区域【非必填】
            "entrance" => $entrance, //入口【非必填】
            "seat_number" => $seat_number, //座位号。【非必填】
            "begin_time" => $begin_time, //开场时间
            "end_time" => $end_time, //结束时间
            "card_id" => $card_id, //序列号所述的card_id。自定义code的会员卡必填。【非必填】
        );
        $data = $this->weObj->updateMeetingTicket($dataarr);
        if (!$data) {
            $this->_error('100022', '会议门票更新失败：网络繁忙');
        }
        if ($dy) {
            echo '更新成功';
        } else {
            return true;
        }
    }
    
    /*     * ***********************私有方法*************************************************** */

    //私有方法，封装获取openid过程
    private function _Getopenid() {
        if (checkWeixinBrowser()) {
            if (!getYS('openid')) {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, 'snsapi_base');
            }
            $this->openid = getYS('openid');
        } else {
            $this->openid = '9999999999999999999999999999'; //非微信
        }
    }

    //私有方法，封装页面授权过程（//$type:snsapi_base 静默获取用户openid   snsapi_userinfo授权获取用户openid和用户信息）
    private function _Author($callback, $type) {
        if (!@$_GET['code']) {
            $url = $this->weObj->getOauthRedirect($callback, '', $type);
            $this->redirect($url);
            Yii::app()->end();
        }
        $res = $this->weObj->getOauthAccessToken();
        setYS('openid', $res['openid']);
        setYS('sq_access_token', $res['access_token']);
    }

    //私有方法，检测是否屏蔽非微信浏览器
    private function _checkBrowser() {
        if (Yii::app()->params['shangqidatong']['checkBrowser'] && !checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); //以后替换成错误页面
            return false;
        }

        return true;
    }

    private function _error($errcode, $errmsg) {
        echo $errcode . ':' . $errmsg . '<br>系统提示错误原因：' . $this->weObj->errMsg;
        die;
    }

}

?>
