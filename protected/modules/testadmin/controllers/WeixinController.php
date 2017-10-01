<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class WeixinController extends Controller
{

    public $weObj;
    // wechat工具类对象
    public $openid;
    // 用户openid
    public $mesObj;
    // 用户消息对象
    // public $callback = "http://www.hui.net/kabao/demos/blog/index.php"; //页面回调地址
    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        
        $options = array(
            'token' => Yii::app()->params['strasbourg']['wxtoken'], // 填写你设定的key
            'encodingaeskey' => Yii::app()->params['strasbourg']['wxencodingaeskey'], // 填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['strasbourg']['wxappid'], // 填写高级调用功能的app id
            'appsecret' => Yii::app()->params['strasbourg']['wxappsecret']
        ); // 填写高级调用功能的密钥
        
        $this->weObj = new Wechatg($options);
    }

    public function actionIndex()
    {
        $this->weObj->valid(); // 注释掉 本方法中全部的代码，先验证域名可用性
                               // 接收用户输入开始,可以根据用户输入，激活程序代码，实现数据库的增删改查，但不支持根据事件或者用户输入命令，进行代码跳转web页，只能用用户点击的形式跳转页面
        $this->mesObj = $this->weObj->getRev(); // 先获取用户消息对象
        $type = $this->mesObj->getRevType();
        switch ($type) { // 判断传入类型
            case 'event':
                $event = $this->mesObj->getRevEvent();
                switch ($event['event']) {
                    case 'subscribe': // 关注事件
                                      // 更改分享者关注状态
                        $this->mesObj->text('欢迎语：Hi！斯特拉斯堡圣诞集市欢迎各地的小伙伴们。美食、美景、邂逅、惊喜……体验 不一样的圣诞气息，相约2015.12.05~2016.01.04，北京蓝色港湾我们不见不散哦~')->reply();
                        break;
                    case 'CLICK': // 单击菜单
                        switch ($event['key']) {
                            case 'CLICK_KF':
                                $this->mesObj->text('您好，有什么可以帮到您？')->reply();
                                break;
                            default:
                                break;
                        }
                        break;
                    
                    default:
                }
                break;
            case 'text':
            case 'image':
            case 'voice':
            case 'video':
            case 'shortvideo':
            case 'link':
            case 'location': // 地理位置准确
                
                $openid = $this->mesObj->getRevFrom();
                $json = $this->mesObj->getKFSession($openid);
                // 判断用户是否已经接入客服
                if ($json['errmsg'] != 'ok') {
                    $data = array(
                        "touser" => $openid,
                        "msgtype" => "text",
                        "text" => array(
                            "content" => "客服接入中,请稍等！"
                        )
                    );
                    $message = $this->weObj->sendCustomMessage($data);
                }
                $this->mesObj->transfer_customer_service()->reply();
                break;
            default:
        }
    }
    
    // 创建微信菜单
    public function actionCreatemenu()
    {
        // $data = array(
        // 'button' => array(
        // 0 => array(
        // "type" => "click",
        // "name" => "集市介绍",
        // "key" => "CLICK_JS"
        // ),
        // 1 => array(
        // "name" => "互动游戏",
        // "sub_button" => array(
        // 0 => array(
        // "type" => "view",
        // "name" => "集铭牌",
        // "url" => "http://vip2.hui.net/strasbourg/register/tag?_wv=1"
        // ),
        // 1 => array(
        // "type" => "view",
        // "name" => "圣诞礼物",
        // "url" => "http://vip2.hui.net/strasbourg/active/christmasindex?_wv=1"
        // ),
        // 2 => array(
        // "type" => "view",
        // "name" => "积分管理",
        // "url" => "http://vip2.hui.net/strasbourg/active/view_score?_wv=1"
        // ),
        // )
        // ),
        // 2 => array(
        // "name" => "凭证管理",
        // "sub_button" => array(
        // 0 => array(
        // "type" => "view",
        // "name" => "邀请凭证",
        // "url" => "http://vip2.hui.net/strasbourg/certificate/index?_wv=1&type=h5"
        // ),
        // 1 => array(
        // "type" => "view",
        // "name" => "团购凭证",
        // "url" => "http://vip2.hui.net/strasbourg/certificate/index?_wv=1&type=group"
        // ),
        // 2 => array(
        // "type" => "view",
        // "name" => "秒拍凭证",
        // "url" => "http://vip2.hui.net/strasbourg/certificate/index?_wv=1&type=seckill"
        // ),
        // 3 => array(
        // "type" => "view",
        // "name" => "竞拍凭证",
        // "url" => "http://vip2.hui.net/strasbourg/certificate/index?_wv=1&type=auction"
        // ),
        // 4 => array(
        // "type" => "view",
        // "name" => "抽奖凭证",
        // "url" => "http://vip2.hui.net/strasbourg/certificate/index?_wv=1&type=lottery"
        // ),
        // )
        // ),
        // )
        // );
        $data = array(
            'button' => array(
                0 => array(
                    "name" => "圣诞集市",
                    "sub_button" => array(
                        0 => array(
                            "type" => "view",
                            "name" => "集市介绍",
                            "url" => "http://www.zgsdxz.com/Market.html?_wv=1"
                        ),
                        1 => array(
                            "type" => "view",
                            "name" => "联系我们",
                            "url" => "http://weibo.com/u/5699995690?noscale_head=1#_0?_wv=1"
                        ),
                        2 => array(
                            "type" => "click",
                            "name" => "在线客服",
                            "key" => "CLICK_KF"
                        ),
                    ),
                ),
                1 => array(
                    "name" => "集市活动",
                    "sub_button" => array(
                        0 => array(
                            "type" => "view",
                            "name" => "竞拍活动",
                            "url" => "http://vip2.hui.net/strasbourg/active/auction_goods?_wv=1"
                        ),
                        1 => array(
                            "type" => "view",
                            "name" => "秒杀活动",
                            "url" => "http://vip2.hui.net/strasbourg/active/miaoindex?_wv=1"
                        ),
                    )
                ),
                2 => array(
                    "name" => "凭证管理",
                    "sub_button" => array(
                        0 => array(
                            "type" => "view",
                            "name" => "游戏凭证",
                            "url" => "http://vip2.hui.net/strasbourg/active/my_certificate?type=1&atype=game"
                        ),
                        1 => array(
                            "type" => "view",
                            "name" => "抽奖凭证",
                            "url" => "http://vip2.hui.net/strasbourg/active/my_certificate?type=1&atype=lottery"
                        ),
                        2 => array(
                            "type" => "view",
                            "name" => "竞拍凭证",
                            "url" => "http://vip2.hui.net/strasbourg/active/my_certificate?type=1&atype=auction"
                        ),
                        3 => array(
                            "type" => "view",
                            "name" => "秒杀凭证",
                            "url" => "http://vip2.hui.net/strasbourg/active/my_certificate?type=1&atype=seckill"
                        ),
                    )
                ),
            )
        );
        
//         $data = array(
//             'button' => array(
//                 0 => array(
//                             "type" => "view",
//                             "name" => "集市介绍",
//                             "url" => "http://www.zgsdxz.com/Market.html?_wv=1"
//                         ),
                        
//                 1 => array(
//                     "type" => "view",
//                     "name" => "联系我们",
//                     "url" => "http://weibo.com/u/5699995690?noscale_head=1#_0?_wv=1"
//                 ),
//                 2 => array(
//                     "type" => "click",
//                                                  "name" => "敬请期待",
//                                                  "key" => "CLICK_JF"
//                 ),
//             )
//         );
        var_dump($this->weObj->createMenu($data));
    }
    
    // 私有方法，封装获取openid过程
    private function _Getopenid()
    {
        if (checkWeixinBrowser()) {
            if (! getYS('openid')) {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; // 此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, 'snsapi_base');
            }
            $this->openid = getYS('openid');
        } else {
            $this->openid = '9999999999999999999999999999'; // 非微信
        }
    }
    
    // 私有方法，封装页面授权过程（//$type:snsapi_base 静默获取用户openid snsapi_userinfo授权获取用户openid和用户信息）
    private function _Author($callback, $type)
    {
        if (! @$_GET['code']) {
            $url = $this->weObj->getOauthRedirect($callback, '', $type);
            $this->redirect($url);
            Yii::app()->end();
        }
        $res = $this->weObj->getOauthAccessToken();
        setYS('openid', $res['openid']);
        setYS('sq_access_token', $res['access_token']);
    }
    
    // 私有方法，检测是否屏蔽非微信浏览器
    private function _checkBrowser()
    {
        if (Yii::app()->params['shangqidatong']['checkBrowser'] && ! checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); // 以后替换成错误页面
            return false;
        }
        
        return true;
    }
    
    // 私有方法，检查用户是否关注过公众号
    // 获取已关注用户信息，如果未关注调用此方法，仅返回openid和describe信息
    public function _checkUserinfo()
    {
        if (! getYS('openid')) {
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

    private function _Gettoken()
    {
        $token = $this->weObj->checkAuth();
        return $token;
    }
    
    // 私有方法，用于将远程文档流写入文件
    private function _Uploadmedia($path, $filename)
    {
        $fp = @fopen($path, a);
        $wresult = fwrite($fp, $filename);
        $cresult = fclose($fp);
        if ($wresult && $cresult) {
            return $path;
        } else {
            return false;
        }
    }
}
