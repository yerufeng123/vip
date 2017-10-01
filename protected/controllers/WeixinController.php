<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class WeixinController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象
    public $callback = "http://www.hui.net/kabao/demos/blog/index.php"; //页面回调地址

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);

        $options = array(
            'token' => Yii::app()->params['common']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['common']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['common']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['common']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);

        
    }
    
    public function actionIndex() {
        $this->weObj->valid();//注释掉 本方法中全部的代码，先验证域名可用性
        //接收用户输入开始,可以根据用户输入，激活程序代码，实现数据库的增删改查，但不支持根据事件或者用户输入命令，进行代码跳转web页，只能用用户点击的形式跳转页面
        $this->mesObj = $this->weObj->getRev(); //先获取用户消息对象
        $type = $this->mesObj->getRevType();
        switch ($type) {//判断传入类型
            case 'event':
                $event = $this->mesObj->getRevEvent();
                switch ($event['event']) {
                    case 'subscribe'://关注事件
                        //更改分享者关注状态
                        $this->mesObj->text('欢迎关注果冻工作室')->reply();
                        break;
                    case 'CLICK'://单击菜单
                        switch ($event['key']) {
                            case 'CLICK_KF':
                                $this->mesObj->text('您好，有什么可以帮到您？')->reply();
                                break;
                            default:
                                break;
                        }
                        break;
    
                    default :
                }
                break;
            case'text':
            case 'image':
            case 'voice':
            case'video':
            case'shortvideo':
            case'link':
            case 'location'://地理位置准确
    
                $openid=$this->mesObj->getRevFrom();
                $json=$this->mesObj->getKFSession($openid);
                //判断用户是否已经接入客服
                if($json['errmsg'] != 'ok'){
                    $data=array(
                        "touser"=>$openid,
                        "msgtype"=>"text",
                        "text"=>array(
                            "content"=>"客服接入中,请稍等！如果您长时间未得到回复,请直接拨打手机15652157728联系客服人员,果冻工作室竭诚为您服务！",
                        ),
                    );
                    $message = $this->weObj->sendCustomMessage($data);
                }
                $this->mesObj->transfer_customer_service()->reply();
                break;
            default :
        }
    }
    

//     public function actionIndex() {
//         $this->weObj->valid();//注释掉 本方法中全部的代码，先验证域名可用性
//         //接收用户输入开始,可以根据用户输入，激活程序代码，实现数据库的增删改查，但不支持根据事件或者用户输入命令，进行代码跳转web页，只能用用户点击的形式跳转页面
//         $this->mesObj = $this->weObj->getRev(); //先获取用户消息对象
//         $type = $this->mesObj->getRevType();
//         switch ($type) {//判断传入类型
//             case 'text':
//                 //$this->mesObj->text('这是文本')->reply();//只能有一个回复
//                 $text = $this->mesObj->getRevContent();
//                 switch ($text) {
//                     case '文字':
//                         $this->mesObj->text('我不好')->reply(); //回复一句文本
//                         break;
//                     case '图片':
//                         $this->mesObj->image('VjWqmw9hrP4ZK56PGEQif0dtWS3RuBVHz9lVKyhcDQTAEH5HI3eccOeQcK5yowIs')->reply(); //回复一张图片
//                         break;
//                     case '声音':
//                         $this->mesObj->voice('6U_v60Uaer5YiAU-_MKFPWpwnWVHOOdfRa0Pn1Hs_FWHwFtuQ7di9Ux8etgEHeWo')->reply(); //回复一段声音
//                         break;
//                     case '图文1':
//                         $data = array(
//                             array(
//                                 'Title' => '奇正藏药',
//                                 'Description' => '这是一个神奇的网站，不信，你点开试试',
//                                 'PicUrl' => 'http://qz.2weima.com/ueditor/php/upload/image/20150310/1425971285807501.jpg',
//                                 'Url' => 'http://qz.2weima.com/weixin/testticket',
//                             ),
//                         );
//                         $this->mesObj->news($data)->reply(); //回复图文消息
//                         break;

//                     case '图文2':
//                         $data = array(
//                             array(
//                                 'Title' => '奇正藏药',
//                                 'Description' => '这是一个神奇的网站，不信，你点开试试',
//                                 'PicUrl' => 'http://qz.2weima.com/ueditor/php/upload/image/20150310/1425971285807501.jpg',
//                                 'Url' => 'http://qz.2weima.com/content/contentinfo?Icid=9',
//                             ),
//                             array(
//                                 'Title' => '奇正藏药2',
//                                 'Description' => '神不神奇你试试被',
//                                 'PicUrl' => 'http://qz.2weima.com/ueditor/php/upload/image/20150310/1425983129487735.jpg',
//                                 'Url' => 'http://qz.2weima.com/content/contentinfo?Icid=9',
//                             ),
//                             array(
//                                 'Title' => '奇正藏药3',
//                                 'Description' => '描述信息不显示',
//                                 'PicUrl' => 'http://pic35.nipic.com/20131125/11678986_113639001309_2.jpg',
//                                 'Url' => 'http://image.baidu.com/i?ct=503316480&z=0&tn=baiduimagedetail&ipn=d&word=%E4%BA%8C%E7%BB%B4%E7%A0%81&step_word=&pn=10&spn=0&di=140395609090&pi=&rn=1&is=&istype=&ie=utf-8&oe=utf-8&in=7805&cl=2&lm=-1&st=&cs=760786151%2C1456972083&os=645129400%2C488528190&adpicid=0&ln=1000&fr=&fmq=1426744292755_R&ic=&s=&se=&sme=0&tab=&width=&height=&face=&ist=&jit=&cg=&objurl=http%3A%2F%2Fpic35.nipic.com%2F20131125%2F11678986_113639001309_2.jpg&fromurl=ippr_z2C%24qAzdH3FAzdH3Fooo_z%26e3Bgtrtv_z%26e3Bv54AzdH3Ffi5oAzdH3Fld00cl0_z%26e3Bip4s',
//                             ),
//                         );
//                         $this->mesObj->news($data)->reply(); //回复图文消息
//                         break;
//                     case '音乐':
//                         $this->mesObj->music('越长大越孤单', '请欣赏越长大越孤单', 'http://tongchenghui365.com/PUBLIC/Img/main_54.mp3')->reply(); //回复一段音乐，可设置第四个参数（wifi环境音乐播放链接），第五个参数（媒体id）；
//                         break;
//                     default:
//                         $this->mesObj->text($text)->reply();
//                         break;
//                 }
//                 break;
//             case 'image':
//                 $pic = $this->mesObj->getRevPic();
//                 $this->mesObj->text('这张图片的id是：' . $pic['mediaid'])->reply();
//                 break;
//             case 'voice':
//                 //$this->mesObj->text('这是声音')->reply();
//                 $voice = $this->mesObj->getRevVoice();
//                 //$this->mesObj->text('这段声音的id是：' . $voice['mediaid'])->reply();
//                 $this->mesObj->text(json_encode($voice))->reply();
//                 break;
//             case 'location'://地理位置准确
//                 $location = $this->mesObj->getRevGeo();
//                 $this->mesObj->text('我记住你了，坐标' . $location['x'] . '、' . $location['y'] . ';scale=' . $location['scale'] . 'label=' . $location['label'])->reply();
//                 break;
//             case 'event':
//                 $event = $this->mesObj->getRevEvent();
//                 switch ($event['event']) {
//                     case 'subscribe'://关注事件
//                         if (empty($event['key'])) {//搜索公众号，进行关注
//                             $this->mesObj->text('欢迎关注公众号')->reply();
//                         } else {//扫描二维码，先关注，后进场景
//                             $scene = substr($event['key'], 8);
//                             switch ($scene) {
//                                 case '{场景值1}':
//                                     $this->mesObj->text('场景值1')->reply();
//                                     break;
//                                 case '{场景值1}':
//                                     $this->mesObj->text('场景值1')->reply();
//                                     break;
//                                 default :
//                                     $this->mesObj->text('未知的未关注场景key：' . $scene . '领取人:' . $this->mesObj->getRevFrom())->reply();
//                             }
//                         }

//                         break;
//                     case 'unsubscribe'://取消关注事件
//                         file_put_contents(_STATICPATH_ . '/weixincache/' . date('Y-m-d_H-i-s', time()) . '.txt', '捕捉到取消关注事件了');
//                     case 'CLICK'://单击菜单
//                         switch ($event['key']) {
//                             case '57_349':
//                                 $this->mesObj->text('我要抽奖')->reply();
//                                 break;
//                             case 'CLICK_001':
//                                 $data = array(
//                                     array(
//                                         'Title' => '这是新游戏哦',
//                                         'Description' => '赶快分享试一下',
//                                         'PicUrl' => 'http://qz.2weima.com/ueditor/php/upload/image/20150310/1425971285807501.jpg',
//                                         'Url' => 'http://test84.2weima.com/weixin/game1?openid=' . $this->mesObj->getRevFrom(),
//                                     ),
//                                 );
//                                 $this->mesObj->news($data)->reply(); //回复图文消息
//                             default:
//                                 $this->mesObj->text('未识别的单击事件：' . $event['key'])->reply();
//                                 break;
//                         }
//                         break;
//                     case 'SCAN'://已关注，扫描二维码进公众号事件
//                         switch ($event['key']) {
//                             case '{场景值1}':
//                                 $this->mesObj->text('场景值1')->reply();
//                                 break;
//                             case '{场景值1}':
//                                 $this->mesObj->text('场景值1')->reply();
//                                 break;
//                             default :
//                                 $this->mesObj->text('未知的已关注场景key：' . $event['key'] . '领取人:' . $this->mesObj->getRevFrom())->reply();
//                         }
//                         break;
//                     case 'LOCATION'://根据公众号设置，主动获取用户当前地理位置，该事件不稳定，有时候半天没反应，而且地理位置不准确，向左方稍微下一点偏移
//                         $location = $this->mesObj->getRevEventGeo();
//                         $this->mesObj->text('你当前地理位置 latx:' . $location['x'] . ',lony=' . $location['y'] . ',precision=' . $location['precision'])->reply();
//                         break;
//                     case 'scancode_waitmsg' ://不成功的事件
//                         $this->mesObj->text('扫码带提示事件：' . json_encode($event))->reply();
//                         break;
//                     case 'scancode_push'://不成功的事件
//                         $this->mesObj->text('扫码推事件：' . json_encode($event))->reply();
//                         break;
//                     case 'pic_sysphoto'://不成功的事件
//                         $this->mesObj->text('弹出系统拍照发图的事件推送 ：' . json_encode($event))->reply();
//                         break;
//                     case 'pic_photo_or_album'://不成功的事件
//                         $this->mesObj->text('弹出拍照或者相册发图的事件推送 ：' . json_encode($event))->reply();
//                         break;
//                     case 'pic_weixin'://不成功的事件
//                         $this->mesObj->text('弹出微信相册发图器的事件推送 ：' . json_encode($event))->reply();
//                         break;
//                     case 'user_get_card':
//                         $card = $this->mesObj->getRevCardEvent();
//                         if ($card['isgive']) {
//                             $this->mesObj->text('用户' . $this->mesObj->getRevFrom() . '领取了朋友' . $card['fopenid'] . '赠送的一张卡券' . $card['cardid'] . '，卡券code为：' . $card['ucode'] . '，场景值为：' . $card['outerid'])->reply();
//                         } else {
//                             $this->mesObj->text('用户' . $this->mesObj->getRevFrom() . '领取了一张卡券' . $card['cardid'] . '，卡券code为：' . $card['ucode'] . '，场景值为：' . $card['outerid'])->reply();
//                         }

//                         break;
//                     case 'user_consume_card':
//                         //以文件系统代替了数据库，如果有必要，此处最好存储到数据库中
//                         $file = _STATICPATH_ . 'weixincache/huiyuan' . $this->mesObj->getRevFrom() . '.txt';
//                         if (file_exists($file)) {
//                             unlink($file);
//                         }

//                         $card = $this->mesObj->getRevCardEvent();
//                         $this->mesObj->text('用户' . $this->mesObj->getRevFrom() . '核销了一张卡券' . $card['cardid'] . '，卡券code为：' . $card['ucode'])->reply();
//                         break;
//                     case 'user_del_card':
//                         //以文件系统代替了数据库，如果有必要，此处最好存储到数据库中
//                         $file = _STATICPATH_ . 'weixincache/huiyuan' . $this->mesObj->getRevFrom() . '.txt';
//                         if (file_exists($file)) {
//                             unlink($file);
//                         }

//                         $card = $this->mesObj->getRevCardEvent();
//                         $this->mesObj->text('用户' . $this->mesObj->getRevFrom() . '删除了一张卡券' . $card['cardid'] . '，卡券code为：' . $card['ucode'])->reply();
//                         break;
//                     case 'card_pass_check'://监听不到
//                         $card = $this->mesObj->getRevCardEvent();
//                         file_put_contents(_STATICPATH_ . 'weixincache/shenhe.txt', '卡券' . $card['cardid'] . '审核通过', FILE_APPEND);
//                         $this->mesObj->text('卡券' . $card['cardid'] . '审核通过')->reply();
//                         break;
//                     case 'card_not_pass_check'://监听不到
//                         $card = $this->mesObj->getRevCardEvent();
//                         file_put_contents(_STATICPATH_ . 'weixincache/shenhe.txt', '卡券' . $card['cardid'] . '审核不通过', FILE_APPEND);
//                         $this->mesObj->text('卡券' . $card['cardid'] . '审核不通过')->reply();
//                         break;
//                     case 'user_view_card'://同时会触发 user_get_card事件
//                         $card = $this->mesObj->getRevCardEvent();

//                         //以文件系统代替了数据库，如果有必要，此处最好存储到数据库中
//                         $huiyuan = array(
//                             'card_id' => $card['cardid'],
//                             'code' => $card['ucode'],
//                             'outer_id' => $card['outerid'],
//                         );
//                         file_put_contents(_STATICPATH_ . 'weixincache/huiyuan' . $this->mesObj->getRevFrom() . '.txt', json_encode($huiyuan));

//                         $this->mesObj->text('用户领取了一张会员卡' . $card['cardid'] . '卡券code:' . $card['ucode'])->reply();
//                         break;
//                     default :
//                         $this->mesObj->text('未识别事件：' . $event['event'])->reply();
//                 }
//                 break;
//             default :
//                 $this->mesObj->text($type)->reply();
//         }
//     }

    //创建微信菜单
    public function actionCreatemenu() {
        $data = array(
            'button' => array(
                 0=>array(
                    'type'=>"view",
                    'name'=>'官网入口',
                    'url'=>'http://www.jellyideas.net?_wv=1'
                ),
               1 => array(
                   "name" => "小游戏",
                   "sub_button" => array(
                       0 => array(
                           "type" => "view",
                           "name" => "吃粽子",
                           "url" => "http://vip.jellyideas.net/quanjude/index?_wv=1"
                       ),
                       1 => array(
                           "type" => "view",
                           "name" => "接食品",
                           "url" => "http://vip.jellyideas.net/huangfeihong/index?_wv=1"
                       )
                   )
               ),
               2 => array(
                            "type" => "click",
                            "name" => "人工客服",
                            "key" => "CLICK_KF"
                )
//                0 => array(
//                    "name" => "常规菜单",
//                    "sub_button" => array(
//                        0 => array(
//                            "type" => "view",
//                            "name" => "百度搜索",
//                            "url" => "http://www.baidu.com/"
//                        ),
//                        1 => array(
//                            "type" => "click",
//                            "name" => "最新游戏",
//                            "key" => "CLICK_001"
//                        ),
//                        2 => array(
//                            'type' => 'location_select',
//                            'name' => '发送位置',
//                            'key' => 'rselfmenu_2_0'
//                        ),
//                    )
//                ),
//                1 => array(
//                    'name' => '扫码',
//                    'sub_button' => array(
//                        0 => array(
//                            'type' => 'scancode_waitmsg',
//                            'name' => '扫码带提示',
//                            'key' => 'rselfmenu_0_0',
//                        ),
//                        1 => array(
//                            'type' => 'scancode_push',
//                            'name' => '扫码推事件',
//                            'key' => 'rselfmenu_0_1',
//                        ),
//                    ),
//                ),
//                2 => array(
//                    'name' => '发图',
//                    'sub_button' => array(
//                        0 => array(
//                            'type' => 'pic_sysphoto',
//                            'name' => '系统拍照发图',
//                            'key' => 'rselfmenu_1_0',
//                        ),
//                        1 => array(
//                            'type' => 'pic_photo_or_album',
//                            'name' => '拍照或者相册发图',
//                            'key' => 'rselfmenu_1_1',
//                        ),
//                        2 => array(
//                            "type" => "pic_weixin",
//                            "name" => "微信相册发图",
//                            "key" => "rselfmenu_1_2",
//                        ),
//                    ),
//                ),
            ),
        );
        var_dump($this->weObj->createMenu($data));
    }

    //获取未关注用户信息
    public function actionGetuserinfo() {
        if (!getYS('openid') || !getYS('sq_access_token')) {
            $callback = $this->callback . '/weixin/getuserinfo'; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
            $this->_Author($callback, 'snsapi_userinfo');
        }
        $openid = getYS('openid');
        $access_token = getYS('sq_access_token');
        $userinfo = $this->weObj->getOauthUserinfo($access_token, $openid);

        return $userinfo;
    }

    //获取已关注用户信息，如果未关注调用此方法，仅返回openid和describe信息
    public function actionGetuserinfo2() {
        if (!getYS('openid')) {
            $callback = $this->callback . '/weixin/getuserinfo2'; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
            $this->_Author($callback, 'snsapi_userinfo');
        }
        $openid = getYS('openid');
        $userinfo = $this->weObj->getUserInfo($openid);
        return $userinfo;
    }

    //获取普通接口需要的access_token
    public function actionGettoken() {
        if (!file_exists(_STATICPATH_ . '/weixincache/access_token.txt')) {//txt文件不存在
            $this->_Creattoken();
        } else {
            $result = file_get_contents(_STATICPATH_ . '/weixincache/access_token.txt');
            if (empty($result)) {//txt文件没内容
                $this->_Creattoken();
            } else {
                $result1 = json_decode($result, true);
                $currenttime = time() - 7000;
                if ($result1['time'] < $currenttime) {
                    $this->_Creattoken();
                } else {
                    return $result1['token'];
                }
            }
        }
    }

    //获取微信服务器ip
    public function actionGetip() {
        $ip = $this->weObj->getServerIp();
        var_dump($ip);
    }

    //获取二维码
    //int $type 0:临时二维码；1:永久二维码(此时expire参数无效：永久数字)；2:永久二维码(此时expire参数无效：永久字符串)
    // int $expire 临时二维码有效期，最大为1800秒
    public function actionGetticket($scene_id = '3', $type = 0, $expire = 1800, $dy = true) {
        //创建二维码
        $ticket = $this->weObj->getQRCode($scene_id, $type, $expire); //$ticket['url] 二维码解析后的地址
        $ticket2 = $this->weObj->getQRUrl($ticket['ticket']);
        if ($dy) {
            $this->renderPartial('ticketpic', array('ticketpic' => $ticket2));
        } else {
            return $ticket2;
        }
    }

    //发送客服信息
    public function actionSendmessage() {
        $openid = $this->_Getopenid();

        //客服回复文本
        /* $data=array(
          "touser"=>$openid,
          "msgtype"=>"text",
          "text"=>array(
          "content"=>"你是高祥栋么？",
          ),
          ); */

        //客服回复图片
        /* $data=array(
          "touser"=>$openid,
          "msgtype"=>"image",
          "image"=>array(
          "media_id"=>"RbwzDlNVCjLXmA7LvRRB9hqd2JwsCJoJ63UZRoqsk5FrN-hmdkXmx2PViRG0y8Kv",
          ),
          ); */

        //客服回复语音
        /* $data = array(
          "touser" => $openid,
          "msgtype" => "voice",
          "voice" => array(
          "media_id" => "6U_v60Uaer5YiAU-_MKFPWpwnWVHOOdfRa0Pn1Hs_FWHwFtuQ7di9Ux8etgEHeWo",
          ),
          ); */
        //客服回复视频
        /* $data = array(
          "touser" => $openid,
          "msgtype" => "video",
          "video" => array(
          "media_id" => "",
          "thumb_media_id"=>"",
          "title"=>"视频标题",
          "description"=>"视频描述",
          ),
          ); */
        //客服回复音乐
        /* $data = array(
          "touser" => $openid,
          "msgtype" => "music",
          "music" => array(
          "title" => "越长大越孤单",
          "description"=>"请欣赏越长大越孤单",
          "musicurl"=>"http://tongchenghui365.com/PUBLIC/Img/main_54.mp3",
          "hqmusicurl"=>"",
          "thumb_media_id"=>"",
          ),
          ); */
        //客服回复图文
        $data = array(
            "touser" => $openid,
            "msgtype" => "news",
            "news" => array(
                "articles" => array(
                    array(
                        "title" => "测试1",
                        "description" => "这是测试1",
                        "url" => "http://www.baidu.com",
                        "picurl" => "http://qz.2weima.com/ueditor/php/upload/image/20150310/1425971285807501.jpg",
                    ),
                    array(
                        "title" => "测试2",
                        "description" => "这是测试2",
                        "url" => "http://www.baidu.com",
                        "picurl" => "http://pic35.nipic.com/20131125/11678986_113639001309_2.jpg",
                    ),
                ),
            ),
        );
        $message = $this->weObj->sendCustomMessage($data);
        echo '<pre>';
        var_dump($message);
        die;
    }

    //上传临时图文素材（返回正常了，可是后台根本没有看到图文素材）
    public function actionUploadfile() {
        $data = array(
            "articles" => array(
                array(
                    "thumb_media_id" => "9faLByrKwviinXpb2R2VDiabKyHEYi6I8qp441cpNXrwheKJ4KyYo7NL8U8_ippx", // 图文消息缩略图的media_id，可以在基础支持-上传多媒体文件接口中获得 
                    "author" => "高祥栋", //图文消息的作者 
                    "title" => "测试1",
                    "content_source_url" => "http://www.baidu.com", //在图文消息页面点击“阅读原文”后的页面 
                    "content" => "这都是我自己胡乱填写的<a href='http://www.baidu.com'>跳吧</a>sdfsadfsdfsf", //图文消息页面的内容，支持HTML标签 
                    "digest" => "这是测试1", //图文消息的描述 
                    "show_cover_pic" => "0", //是否显示封面，1为显示，0为不显示 
                ),
                array(
                    "thumb_media_id" => "9faLByrKwviinXpb2R2VDiabKyHEYi6I8qp441cpNXrwheKJ4KyYo7NL8U8_ippx", // 图文消息缩略图的media_id，可以在基础支持-上传多媒体文件接口中获得 
                    "author" => "高祥栋", //图文消息的作者 
                    "title" => "测试2",
                    "content_source_url" => "http://www.baidu.com", //在图文消息页面点击“阅读原文”后的页面 
                    "content" => "asdfasdfasdfasdfsafdasdfasdfasdfasddddddddddddddddddddddddddddddddddddddddddddasdf", //图文消息页面的内容，支持HTML标签 
                    "digest" => "这是测试2", //图文消息的描述 
                    "show_cover_pic" => "0", //是否显示封面，1为显示，0为不显示 
                ),
            ),
        );

        $file = $this->weObj->uploadArticles($data);
        if (!$file) {
            echo $this->weObj->errMsg;
            die;
        }
        var_dump($file);
        die;
    }

    //新增临时素材
    public function actionUploadmedia() {
        //上传图片(1M 以内)
        /* $data = array(
          'media' => '@' . _STATICPATH_ . 'uploads/2.jpg'
          );
          $type = 'image'; */

        //上传语音（2M 以内，长度不超过60秒，支持AMR\MP3格式）
        /* $data=array(
          'media'=>'@'._STATICPATH_.'uploads/aaa.mp3'
          );
          $type='voice'; */

        //上传视频（10M以内，支持MP4格式）
        set_time_limit(0);
        $data = array(
            'media' => '@' . _STATICPATH_ . 'uploads/bbb.mp4'
        );
        $type = 'video';

        //上传缩略图（64KB，支持JPG格式 ）
        /* $data = array(
          'media' => '@' . _STATICPATH_ . 'uploads/3.jpg'
          );
          $type = 'thumb'; */

        $media = $this->weObj->uploadMedia($data, $type);
        if (!$media) {
            echo $this->weObj->errMsg;
            die;
        }
        echo '<pre>';
        var_dump($media);
        die;
    }

    //获取临时素材(视频和永久的一样，下载了无法播放)
    public function actionGetmedia() {
        $media_id = 'mLSsGPPnQzRiFVtd6deDAbmtEVsPuuXA5DF_8fGm4cqmvUuZ0q6OZn6n6T9pdce8';
        $media = $this->weObj->getMedia($media_id); //获取其他
        //$media = $this->weObj->getMedia($media_id,'video');//获取视频
        if (!$media) {
            echo $this->weObj->errMsg;
            die;
        }
        $path = $this->_Uploadmedia(_STATICPATH_ . 'uploads/tempsucai' . time(), $media);
        echo $path;
        die;
    }

    //上传永久图文素材
    public function actionUploadfile2() {
        $data = array(
            "articles" => array(
                array(
                    "thumb_media_id" => "8796358360", // 图文消息缩略图的media_id，可以在基础支持-上传多媒体文件接口中获得 
                    "author" => "高祥栋", //图文消息的作者 
                    "title" => "测试1",
                    "content_source_url" => "http://www.baidu.com", //在图文消息页面点击“阅读原文”后的页面 
                    "content" => "这都是我自己胡乱填写的<a href='http://www.baidu.com'>跳吧</a>sdfsadfsdfsf", //图文消息页面的内容，支持HTML标签 
                    "digest" => "这是测试1", //图文消息的描述 
                    "show_cover_pic" => "0", //是否显示封面，1为显示，0为不显示 
                ),
                array(
                    "thumb_media_id" => "8796358360", // 图文消息缩略图的media_id，可以在基础支持-上传多媒体文件接口中获得 
                    "author" => "高祥栋", //图文消息的作者 
                    "title" => "测试2",
                    "content_source_url" => "http://www.baidu.com", //在图文消息页面点击“阅读原文”后的页面 
                    "content" => "asdfasdfasdfasdfsafdasdfasdfasdfasddddddddddddddddddddddddddddddddddddddddddddasdf", //图文消息页面的内容，支持HTML标签 
                    "digest" => "这是测试2", //图文消息的描述 
                    "show_cover_pic" => "0", //是否显示封面，1为显示，0为不显示 
                ),
            ),
        );

        $file = $this->weObj->uploadArticles2($data);
        if (!$file) {
            echo $this->weObj->errMsg;
            die;
        }
        var_dump($file);
        die;
    }

    //修改永久图文素材
    public function actionUpdatefile() {
        $data = array(
            "media_id" => "", //要修改的图文消息的id 
            "index" => "", //要更新的文章在图文消息中的位置（多图文消息时，此字段才有意义），第一篇为0 
            "articles" => array(
                array(
                    "thumb_media_id" => "8796358360", // 图文消息的封面图片素材id（必须是永久mediaID） 
                    "author" => "高祥栋", //图文消息的作者 
                    "title" => "测试1",
                    "content_source_url" => "http://www.baidu.com", //在图文消息页面点击“阅读原文”后的页面 
                    "content" => "这都是我自己胡乱填写的<a href='http://www.baidu.com'>跳吧</a>sdfsadfsdfsf", //图文消息的具体内容，支持HTML标签，必须少于2万字符，小于1M，且此处会去除JS 
                    "digest" => "这是测试1", //图文消息的描述 
                    "show_cover_pic" => "0", //是否显示封面，1为显示，0为不显示 
                ),
                array(
                    "thumb_media_id" => "8796358360", // 图文消息缩略图的media_id，可以在基础支持-上传多媒体文件接口中获得 
                    "author" => "高祥栋", //图文消息的作者 
                    "title" => "测试2",
                    "content_source_url" => "http://www.baidu.com", //在图文消息页面点击“阅读原文”后的页面 
                    "content" => "asdfasdfasdfasdfsafdasdfasdfasdfasddddddddddddddddddddddddddddddddddddddddddddasdf", //图文消息页面的内容，支持HTML标签 
                    "digest" => "这是测试2", //图文消息的描述 
                    "show_cover_pic" => "0", //是否显示封面，1为显示，0为不显示 
                ),
            ),
        );

        $file = $this->weObj->uploadArticles2($data);
        if (!$file) {
            echo $this->weObj->errMsg;
            die;
        }
        var_dump($file);
        die;
    }

    //新增永久素材(视频素材新增一次，后台会看到两个)
    public function actionUploadmaterial() {
        //上传图片(1M 以内)
        /* $type='image';
          $data=array(
          'media'=>'@'._STATICPATH_.'uploads/2.jpg'
          );
         */

        //上传语音（2M 以内，长度不超过60秒，支持AMR\MP3格式）
        /* $type='voice';
          $data=array(
          'media'=>'@'._STATICPATH_.'uploads/aaa.mp3'
          );
         */

        //上传视频（10M以内，支持MP4格式）
        set_time_limit(0);
        $type = 'video';
        $data = array(
            'media' => '@' . _STATICPATH_ . 'uploads/bbb.mp4',
            'description' => json_encode(array(
                'title' => '这是视频的标题',
                'introduction' => '这是描述信息',
            )),
            'type' => $type,
        );


        //上传缩略图（64KB，支持JPG格式 ）
        /* $type = 'thumb';
          $data = array(
          'media' => '@' . _STATICPATH_ . 'uploads/3.jpg'
          );
         */

        $media = $this->weObj->uploadMaterial($data);
        if (!$media) {
            echo $this->weObj->errMsg;
            die;
        }
        echo '<pre>';
        var_dump($media);
        die;
    }

    //获取永久素材(视频成功下载，但播放不出来，其他正常)
    public function actionGetmetarial() {
        $data = array(
            'media_id' => '13091328099',
        );
        $media = $this->weObj->getMaterial($data);

        //图文素材
//        if (!$media) {
//            echo $this->weObj->errMsg;
//            die;
//        }
//        $media=  json_decode($media,true);
//        echo '<pre>';
//        var_dump($media);
//        die;
        //其他媒体素材
        $path = $this->_Uploadmedia(_STATICPATH_ . 'uploads/sucai' . time(), $media);
        echo $path;
        die;
    }

    //删除永久素材
    public function actionDelmetarial() {
        $data = array(
            "media_id" => '13091326073',
        );
        $result = $this->weObj->delMaterial($data);
        if (!$result) {
            echo $this->weObj->errMsg;
            die;
        }
        echo '<pre>';
        var_dump($result);
        die;
    }

    /*     * ***********************JS 接口*************************************************** */

    //隐藏右上角按钮功能
    public function actionYcfx() {
        $this->renderPartial('yinchangfenxiang');
    }

    //调取摇一摇接口
    public function actionSys() {
        $this->renderPartial('saoyisao');
    }

    //调起拍照或者手机相册中选图接口
    public function actionChooseimg() {
        $this->renderPartial('chooseimg');
    }

    /*     * ***********************私有方法*************************************************** */

    // 私有方法，封装获取openid过程
    private function _Getopenid($type = 'snsapi_base') {
        if (checkWeixinBrowser()) {
            if (!getYS('openid') || $type == 'snsapi_userinfo') {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; // 此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, $type);
            }
            $this->openid = getYS('openid');
        } else {
            $this->openid = '9999999999999999999999999999'; // 非微信
        }
    }

    // 私有方法，封装页面授权过程（//$type:snsapi_base 静默获取用户openid snsapi_userinfo授权获取用户openid和用户信息）
    private function _Author($callback, $type) {
        if (!@$_GET['code'] || ($type == 'snsapi_userinfo' && !@$_GET['info'])) {
            if ($type != 'snsapi_userinfo') {
                $url = $this->weObj->getOauthRedirect($callback, '', $type);
            } else {
                if ($_GET['code']) {
                    $url = $this->weObj->getOauthRedirect($callback . '&info=1', '', $type);
                } else {
                    $url = $this->weObj->getOauthRedirect($callback . '?info=1', '', $type);
                }
            }

            $this->redirect($url);
            Yii::app()->end();
        }
        $res = $this->weObj->getOauthAccessToken();
        setYS('openid', $res['openid']);
        if ($type == 'snsapi_userinfo') {
            $data['access_token'] = $res['access_token'];
            $data['expiretime'] = time() + 7000; // 保留两个小时
            setYS('sq_access_token', json_encode($data));
        }
    }

    // 私有方法，检测是否屏蔽非微信浏览器
    private function _checkBrowser() {
        if (Yii::app()->params['shangqidatong']['checkBrowser'] && !checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); // 以后替换成错误页面
            return false;
        }

        return true;
    }

    // 私有方法，检查用户是否关注过公众号
    // 获取已关注用户信息，如果未关注调用此方法，仅返回openid和describe信息
    public function _checkUserinfo() {
        if (!getYS('openid')) {
            $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; // 此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
            $this->_Author($callback, 'snsapi_userinfo');
        }
        $openid = getYS('openid');
        $userinfo = $this->weObj->getUserInfo($openid);
        if ($userinfo['subscribe'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    //获取全局token，用于调用微信全部接口（用户授权获取详情信息除外）
    private function _Gettoken() {
        $token = $this->weObj->checkAuth();
        return $token;
    }

    //获取授权token,用户获取未关注公众号用户详情信息
    private function _GetSqtoken() {
        $sq_access_token = getYS('sq_access_token');
        $data = isset($sq_access_token) ? $sq_access_token : '{}';
        $data = json_decode($data, true);
        if (!isset($data['access_token']) || $data['expiretime'] < time()) {
            $this->_Getopenid('snsapi_userinfo');
            $data = json_decode(getYS('sq_access_token'), true);
        }
        return $data['access_token'];
    }

    //私有方法，用于将远程文档流写入文件
    private function _Uploadmedia($path, $filename) {
        $fp = @fopen($path, a);
        $wresult = fwrite($fp, $filename);
        $cresult = fclose($fp);
        if ($wresult && $cresult) {
            return $path;
        } else {
            return false;
        }
    }


    private function _Creattoken() {
        $token = $this->weObj->checkAuth();
        $arr['time'] = time();
        $arr['token'] = $token;
        file_put_contents(_STATICPATH_ . '/weixincache/access_token.txt', json_encode($arr));
        return $token;
    }

}
