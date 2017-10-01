<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class OrderpayController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $tools; //工具类对象

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

    //支付导航页面
    public function actionIndex() {
        $this->renderPartial('index');
    }

    /*     * ******************************************************************微信专题开始***************************************************************************** */

    /**
     * 微信支付页面---》在该页面需要用户已存在订单信息，或者在此页面生成订单信息（老微信支付）
     * 需要配置的内容:
     * 1、项目protected/extensions/WxPayPubHelper/WxPay.pub.config.php
     * 2、公众后台/微信支付/开发配置/支付目录（http://域名/orderpay/）【一定要带最后的/,大小写统一】
     */
    public function actionWeixinpay() {
        $this->_Getopenid();
        $this->renderPartial('pay_weixin');
    }

    /**
     * 异步方法---》获取调起支付所需要的字符串（老微信支付）
     */
    public function actionAjaxweixinpay() {
        $this->_Getopenid();
        require_once yii::app()->basePath . '/extensions/WxPayPubHelper/WxPayPubHelper.php';
        new WxPayConf_pub();

        //使用jsapi接口
        $jsApi = new JsApi_pub();

        //=========步骤1：网页授权获取用户openid============
        //通过code获得openid
        $openid = $this->openid;

        //=========步骤2：使用统一支付接口，获取prepay_id============
        //使用统一支付接口
        $unifiedOrder = new UnifiedOrder_pub();

        //设置统一支付接口参数
        //设置必填参数
        //appid已填,商户无需重复填写
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
        $_POST['total_fee'] = ceil($_POST['total_fee'] * 100);
        $unifiedOrder->setParameter("openid", "$openid"); //商品描述
        $unifiedOrder->setParameter("body", $_POST['body']); //商品描述
        $unifiedOrder->setParameter("out_trade_no", $_POST['out_trade_no']); //商户订单号 
        $unifiedOrder->setParameter("total_fee", $_POST['total_fee']); //总金额
        $unifiedOrder->setParameter("notify_url", WxPayConf_pub::NOTIFY_URL); //通知地址 
        $unifiedOrder->setParameter("trade_type", "JSAPI"); //交易类型
        //非必填参数，商户可根据实际情况选填
        //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号 
        //$unifiedOrder->setParameter("attach","XXXX");//附加数据 
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID

        $prepay_id = $unifiedOrder->getPrepayId();
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);

        $jsApiParameters = $jsApi->getParameters();
        echo $jsApiParameters;
    }

    //微信-支付完毕回调方法（老微信支付）
    public function actionWeixinok() {
        $postStr = file_get_contents("php://input");
        $arr = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $return_code = $arr['result_code'];
        $result_code = $arr['return_code'];
        $order_sn = $arr['out_trade_no'];
        if ($return_code == 'SUCCESS' && $result_code == 'SUCCESS') {
            //支付成功，修改订单状态
        }

        file_put_contents(_STATICPATH_ . 'weixincache/' . date('Ymd') . 'weixinpayok.txt', json_encode($arr), FILE_APPEND);
        /**
         * 老微信支付返回参数 {"appid":"wxb86b63e07816bd2c","bank_type":"CFT","cash_fee":"1","fee_type":"CNY","is_subscribe":"Y","mch_id":"1234755802","nonce_str":"xcfc63ejc3ez0pdef1ejloxb0fmpqtxp","openid":"o41zRjkNEL7JFPyvjkJXGV3WqUdE","out_trade_no":"1438244214651","result_code":"SUCCESS","return_code":"SUCCESS","sign":"87F3B60F8675A69B9C0099AF824E21B9","time_end":"20150730161319","total_fee":"1","trade_type":"JSAPI","transaction_id":"1002170128201507300508525550"}{"appid":"wxb86b63e07816bd2c","bank_type":"CFT","cash_fee":"1","fee_type":"CNY","is_subscribe":"Y","mch_id":"1234755802","nonce_str":"xcfc63ejc3ez0pdef1ejloxb0fmpqtxp","openid":"o41zRjkNEL7JFPyvjkJXGV3WqUdE","out_trade_no":"1438244214651","result_code":"SUCCESS","return_code":"SUCCESS","sign":"87F3B60F8675A69B9C0099AF824E21B9","time_end":"20150730161319","total_fee":"1","trade_type":"JSAPI","transaction_id":"1002170128201507300508525550"}
         * 新微信支付返回参数 {"appid":"wxb86b63e07816bd2c","attach":"\u6d4b\u8bd5attach","bank_type":"CFT","cash_fee":"1","fee_type":"CNY","is_subscribe":"Y","mch_id":"1234755802","nonce_str":"9xbticsy8cxlk6i001m6tmcn7n61mvqg","openid":"o41zRjkNEL7JFPyvjkJXGV3WqUdE","out_trade_no":"1438325375398","result_code":"SUCCESS","return_code":"SUCCESS","sign":"BE12372A026936F1D4AFDC6F717E8FDD","time_end":"20150731144600","total_fee":"1","trade_type":"JSAPI","transaction_id":"1002170128201507310514424592"}
         * 扫码支付返回参数  {"appid":"wxb86b63e07816bd2c","attach":"\u6d4b\u8bd5attach","bank_type":"CFT","cash_fee":"1","fee_type":"CNY","is_subscribe":"Y","mch_id":"1234755802","nonce_str":"lvgoejyt0yghf9vvduvutisrxl7a4c97","openid":"o41zRjkNEL7JFPyvjkJXGV3WqUdE","out_trade_no":"123475580220150731112428","result_code":"SUCCESS","return_code":"SUCCESS","sign":"E7789F9A935B93830D7B85B0047835A6","time_end":"20150731112450","total_fee":"1","trade_type":"NATIVE","transaction_id":"1002170128201507310512955205"}{"appid":"wxb86b63e07816bd2c","attach":"\u6d4b\u8bd5attach","bank_type":"CFT","cash_fee":"1","fee_type":"CNY","is_subscribe":"Y","mch_id":"1234755802","nonce_str":"lvgoejyt0yghf9vvduvutisrxl7a4c97","openid":"o41zRjkNEL7JFPyvjkJXGV3WqUdE","out_trade_no":"123475580220150731112428","result_code":"SUCCESS","return_code":"SUCCESS","sign":"E7789F9A935B93830D7B85B0047835A6","time_end":"20150731112450","total_fee":"1","trade_type":"NATIVE","transaction_id":"1002170128201507310512955205"}
         */
        return 'success';
    }

    /**
     * 微信支付页面---》在该页面需要用户已存在订单信息，或者在此页面生成订单信息（新微信支付）
     * 需要配置的内容:
     * 1、项目protected/extensions/Wxpay/lib/WxPay.Config.php
     * 2、公众后台/微信支付/开发配置/支付目录（http://域名/orderpay/）【一定要带最后的/,大小写统一】
     */
    public function actionWeixinpay_new() {
//error_reporting(E_ERROR);
        require_once Yii::app()->basePath . "/extensions/Wxpay/lib/WxPay.Api.php";
        require_once Yii::app()->basePath . "/extensions/Wxpay/WxPay.JsApiPay.php";
        require_once Yii::app()->basePath . "/extensions/Wxpay/log.php";
        //初始化日志
        $logHandler = new CLogFileHandler(Yii::app()->basePath . "/extensions/Wxpay/logs/" . date('Y-m-d') . '.log');
        $log = Log::Init($logHandler, 15);




        $this->tools = new JsApiPay();
        //①、获取用户openid
        $openid = $this->tools->GetOpenid(); //必须执行一遍才能调用微信收货地址信息
        setYS('openid', $openid);
        $this->openid = getYS('openid');


        $editAddress = $this->tools->GetEditAddressParameters();
        $this->renderPartial('pay_weixin_new', array('editAddress' => $editAddress));
    }

    //新微信——异步获取参数（新微信支付）
    public function actionAjaxweixinpaynew() {
        //error_reporting(E_ERROR);
        require_once Yii::app()->basePath . "/extensions/Wxpay/lib/WxPay.Api.php";
        require_once Yii::app()->basePath . "/extensions/Wxpay/WxPay.JsApiPay.php";
        require_once Yii::app()->basePath . "/extensions/Wxpay/log.php";
        //初始化日志
        $logHandler = new CLogFileHandler(Yii::app()->basePath . "/extensions/Wxpay/logs/" . date('Y-m-d') . '.log');
        $log = Log::Init($logHandler, 15);
        $this->tools = new JsApiPay();

        $this->_Getopenid();
        $body = $_POST['body'];
        $out_trade_no = $_POST['out_trade_no'];
        $total_fee = $_POST['total_fee'] * 100;
        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody($body); //订单描述和标题
        $input->SetAttach("测试attach");
        $input->SetOut_trade_no($out_trade_no); //订单号
        $input->SetTotal_fee($total_fee); //订单金额
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600)); //10分钟过期时间
        $input->SetGoods_tag("测试标签");
        $input->SetNotify_url("http://vip.jellyideas.net/orderpay/weixinok");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($this->openid);

        $order = WxPayApi::unifiedOrder($input);
        //echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        //printf_info($order);
        $jsApiParameters = $this->tools->GetJsApiParameters($order);
        echo $jsApiParameters;
        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */
    }

    /**
     * 微信——扫码支付（扫二维码）
     * 需要配置的内容:
     * 1、项目protected/extensions/Wxpay/lib/WxPay.Config.php
     * 2、公众后台/微信支付/开发配置/支付目录（http://域名/orderpay/）【一定要带最后的/,大小写统一】
     */
    public function actionSao() {
        $this->renderPartial('pay_weixin_sao');
    }

    public function actionNative() {
        $body = $_POST['goodname'];
        $ordernum = $_POST['goodordernum'] . '';
        $totalfee = $_POST['goodtotalfee'] * 100;
        $goodid = $_POST['goodid'] . '';
        require_once Yii::app()->basePath . "/extensions/Wxpay/lib/WxPay.Api.php";
        require_once Yii::app()->basePath . "/extensions/Wxpay/WxPay.NativePay.php";
        require_once Yii::app()->basePath . "/extensions/Wxpay/log.php";
        //初始化日志
        $logHandler = new CLogFileHandler(Yii::app()->basePath . "/extensions/Wxpay/logs/" . date('Y-m-d') . '.log');
        $log = Log::Init($logHandler, 15);
        $notify = new NativePay();
        //模式二
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $input = new WxPayUnifiedOrder();
        $input->SetBody($body);
        $input->SetAttach("测试attach");
        $input->SetOut_trade_no($ordernum); //该处替换为订单号
        $input->SetTotal_fee($totalfee . ''); //金额，单位分
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600)); //创建开始，有10分钟有效期
        $input->SetGoods_tag("测试商品标签"); //商品标签
        $input->SetNotify_url("http://vip.jellyideas.net/orderpay/weixinok"); //回调地址在此处配置，公众后台/微信支付/开发配置/扫码支付无需配置，如果使用模式一扫码，需要配置公众后台
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($goodid); //商品编号，或者商品id
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        $this->renderPartial('pay_weixin_sao_pic', array(
            'url2' => $url2,
        ));
    }

    //微信------刷卡支付
    public function actionSwing() {
        $this->renderPartial('pay_weixin_swing');
    }

    /**
     * 微信----》刷卡支付完成
     * 注意：
     * 1、提交被扫之后，返回系统繁忙、用户输入密码等错误信息时需要循环查单以确定是否支付成功
     * 2、多次（一半10次）确认都未明确成功时需要调用撤单接口撤单，防止用户重复支付
     */
    public function actionSwingok() {
        require_once Yii::app()->basePath . "/extensions/Wxpay/lib/WxPay.Api.php";
        require_once Yii::app()->basePath . "/extensions/Wxpay/WxPay.MicroPay.php";
        require_once Yii::app()->basePath . "/extensions/Wxpay/log.php";
        //初始化日志
        $logHandler = new CLogFileHandler(Yii::app()->basePath . "/extensions/Wxpay/logs/" . date('Y-m-d') . '.log');
        $log = Log::Init($logHandler, 15);

        if (empty($_POST['gooddescribe']) || empty($_POST['totalprice']) || empty($_POST['auth_code'])) {
            returnJs('缺少必填项');
        }
        $body = $_POST['gooddescribe'];
        $totalfee = $_POST['totalprice'] * 100;
        $auth_code = $_REQUEST["auth_code"];
        $input = new WxPayMicroPay();

        $input->SetAuth_code($auth_code); //授权码：用户微信钱包---》单击刷卡--》二维码上边的数字
        $input->SetBody($body); //商品标题
        $input->SetTotal_fee($totalfee . ''); //支付总价格
        $input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis")); //订单号
        $microPay = new MicroPay();
        var_dump($microPay->pay($input));

        //array(19) { ["appid"]=> string(18) "wxb86b63e07816bd2c" ["attach"]=> array(0) { } ["bank_type"]=> string(3) "CFT" ["cash_fee"]=> string(1) "1" ["fee_type"]=> string(3) "CNY" ["is_subscribe"]=> string(1) "Y" ["mch_id"]=> string(10) "1234755802" ["nonce_str"]=> string(16) "5YHKXY27bVi6o0lg" ["openid"]=> string(28) "o41zRjkNEL7JFPyvjkJXGV3WqUdE" ["out_trade_no"]=> string(24) "123475580220150803165918" ["result_code"]=> string(7) "SUCCESS" ["return_code"]=> string(7) "SUCCESS" ["return_msg"]=> string(2) "OK" ["sign"]=> string(32) "7A1559FC62B1203DF6A34620CD697113" ["time_end"]=> string(14) "20150803165919" ["total_fee"]=> string(1) "1" ["trade_state"]=> string(7) "SUCCESS" ["trade_type"]=> string(8) "MICROPAY" ["transaction_id"]=> string(28) "1002170128201508030539407906" } 
    }

    /*     * ******************************************************************微信专题结束***************************************************************************** */

    /*     * ******************************************************************支付宝专题开始***************************************************************************** */

    //支付宝——电脑版首页
    public function actionZfb_pc() {
        $this->renderPartial('pay_zfb_pc');
    }

    /**
     * 支付宝——电脑版
     * 需要配置 extensions/Zhifubao/Alipay.php
     */
    public function actionZhifubao() {
        header("Content-type: text/html; charset=utf-8");
        //引入文件
        require_once Yii::app()->basePath . '/extensions/Zhifubao/Alipay.php';
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        //$notify_url = "http://www.hui.tld/pay/notify_url.php";
        $notify_url = Yii::app()->request->hostInfo . "/orderpay/zfb_ok"; //商户后台回调（可以不调用最新版的支付完成）
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        //$return_url = "http://www.hui.tld/pay/return_url.php";
        $return_url = Yii::app()->request->hostInfo . "/orderpay/zfb_userok"; //客户端跳转回调（可以不调用最新版的支付完成）
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = 'sunonlinecn@gmail.com';
        //必填
        //商户订单号
        $out_trade_no = $_POST['ordernum'];
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = $_POST['goodname'];
        //必填
        //付款金额
        $total_fee = $_POST['totalprice'];
        //必填
        //订单描述

        $body = $_POST['gooddescribe'];
        //商品展示地址
        $show_url = "http://test84.2weima.com/orderpay/index";
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
        /*         * ********************************************************* */
        $alipay = new Alipay;
        $alipay_config = $alipay->Alipay();
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type" => $payment_type,
            "notify_url" => $notify_url,
            "return_url" => $return_url,
            "seller_email" => $seller_email,
            "out_trade_no" => $out_trade_no,
            "subject" => $subject,
            "total_fee" => $total_fee,
            "body" => $body,
            "show_url" => $show_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip" => $exter_invoke_ip,
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "");
        echo $html_text;
    }

    //支付宝——支付完成(通用)
    public function actionZfb_ok() {
        file_put_contents(_STATICPATH_ . 'weixincache/' . date('Ymd') . 'zfbpayok.txt', json_encode($_REQUEST), FILE_APPEND); //不严谨的可以用这个判断
        //{"discount":"0.00","payment_type":"1","subject":"\u5546\u54c1\u540d3","trade_no":"2015080300001000320066121437","buyer_email":"gxd_dnjlw@163.com","gmt_create":"2015-08-03 18:26:55","notify_type":"trade_status_sync","quantity":"1","out_trade_no":"1438597692028","seller_id":"2088411109773386","notify_time":"2015-08-03 18:27:03","body":"\u5546\u54c1\u63cf\u8ff0","trade_status":"TRADE_SUCCESS","is_total_fee_adjust":"N","total_fee":"0.01","gmt_payment":"2015-08-03 18:27:02","seller_email":"sunonlinecn@gmail.com","price":"0.01","buyer_id":"2088502887312323","notify_id":"b39845b1e888df96ee174b6e1b5bbbfb3s","use_coupon":"N","sign_type":"MD5","sign":"de981776094ecd4f6183f92cc23df507"}
    }

    //支付宝——用户支付完成跳转页
    public function actionZfb_userok() {
        var_dump($_GET);
        die;
    }

    //支付宝——手机版首页
    public function actionZfb_phone() {
        $this->renderPartial('pay_zfb_phone');
    }

    /**
     * 支付宝——手机版
     * 需要配置 /extensions/Zhifubaophone/alipay.config.php
     */
    public function actionZhifubaophone() {
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/alipay.config.php");
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/lib/alipay_submit.class.php");
        //返回格式
        $format = "xml";
        //必填，不需要修改
        //返回格式
        $v = "2.0";
        //必填，不需要修改
        //请求号
        $req_id = date('Ymdhis');
        //必填，须保证每次请求都是唯一
        //**req_data详细信息**
        //服务器异步通知页面路径
        $notify_url = Yii::app()->request->hostInfo . "/orderpay/zfbp_ok";
        //需http://格式的完整路径，不允许加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $call_back_url = Yii::app()->request->hostInfo . "/orderpay/zfbp_userok";
        //需http://格式的完整路径，不允许加?id=123这类自定义参数
        //操作中断返回地址
        $merchant_url = Yii::app()->request->hostInfo . "/orderpay/zfbp_userfail";
        //用户付款中途退出返回商户的地址。需http://格式的完整路径，不允许加?id=123这类自定义参数
        //商户订单号
        //$out_trade_no = $_POST['ordernum'];
        $out_trade_no = '545343454' . rand(1000, 9999);
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        //$subject = $_POST['goodname'];
        $subject = 'dddd';
        //必填
        //付款金额
        //$total_fee = $_POST['totalprice'];
        $total_fee = 0.01;
        //必填
        //请求业务参数详细
        $req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . trim($alipay_config['seller_email']) . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee><merchant_url>' . $merchant_url . '</merchant_url></direct_trade_create_req>';
        //必填

        /*         * ********************************************************* */
        //构造要请求的参数数组，无需改动
        $para_token = array(
            "service" => "alipay.wap.trade.create.direct",
            "partner" => trim($alipay_config['partner']),
            "sec_id" => trim($alipay_config['sign_type']),
            "format" => $format,
            "v" => $v,
            "req_id" => $req_id,
            "req_data" => $req_data,
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestHttp($para_token);
        //URLDECODE返回的信息
        $html_text = urldecode($html_text);
        //解析远程模拟提交后返回的信息
        $para_html_text = $alipaySubmit->parseResponse($html_text);
        //获取request_token
        $request_token = $para_html_text['request_token'];
        /*         * ************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute************************* */

        //业务详细
        $req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
        //必填
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "alipay.wap.auth.authAndExecute",
            "partner" => trim($alipay_config['partner']),
            "sec_id" => trim($alipay_config['sign_type']),
            "format" => $format,
            "v" => $v,
            "req_id" => $req_id,
            "req_data" => $req_data,
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '');
        echo $html_text;
    }

    //支付宝手机——支付完成
    public function actionZfbp_ok() {
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/alipay.config.php");
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/lib/alipay_notify.class.php");
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if ($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            //解析notify_data
            //注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
            $doc = new DOMDocument();
            if ($alipay_config['sign_type'] == 'MD5') {
                $doc->loadXML($_POST['notify_data']);
            }

            if ($alipay_config['sign_type'] == '0001') {
                $doc->loadXML($alipayNotify->decrypt($_POST['notify_data']));
            }
            if (!empty($doc->getElementsByTagName("notify")->item(0)->nodeValue)) {
                //商户订单号
                $out_trade_no = $doc->getElementsByTagName("out_trade_no")->item(0)->nodeValue;

                //支付宝交易号
                $trade_no = $doc->getElementsByTagName("trade_no")->item(0)->nodeValue;
                //交易状态
                $trade_status = $doc->getElementsByTagName("trade_status")->item(0)->nodeValue;
                file_put_contents(_STATICPATH_ . 'weixincache/' . date('Ymd') . 'zfbpayok.txt', json_encode($out_trade_no), FILE_APPEND); //不严谨的可以用这个判断
                //经常会出现TRADE_FINISHED
                if ($trade_status == 'TRADE_FINISHED') {
                    //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                    //注意：
                    //该种交易状态只在两种情况下出现
                    //1、开通了普通即时到账，买家付款成功后。
                    //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。
                    //调试用，写文本函数记录程序运行情况是否正常
                    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

                    echo "success";  //请不要修改或删除
                } else if ($trade_status == 'TRADE_SUCCESS') {
                    //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                    //注意：
                    //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
                    //调试用，写文本函数记录程序运行情况是否正常
                    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
                    file_put_contents(_STATICPATH_ . 'weixincache/' . date('Ymd') . 'zfbpayok2.txt', json_encode($out_trade_no), FILE_APPEND); //不严谨的可以用这个判断
                    echo "success";  //请不要修改或删除
                }
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
        // $res1 = $_REQUEST;
        //$res2 = file_get_contents('php://input');
        //file_put_contents(_STATICPATH_ . 'weixincache/' . date('Ymd') . 'zhifubaopayok.txt', json_encode($res1) . '=================' . json_encode($res2), FILE_APPEND);
    }

    //支付宝手机——用户支付完成跳转页
    public function actionZfbp_userok() {
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/alipay.config.php");
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/lib/alipay_notify.class.php");
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if ($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号
            $trade_no = $_GET['trade_no'];

            //交易状态
            $result = $_GET['result'];
            var_dump($_GET);
            die;

            //array(18) { ["body"]=> string(18) "我的测试描述" ["buyer_email"]=> string(17) "gxd_dnjlw@163.com" ["buyer_id"]=> string(16) "2088502887312323" ["exterface"]=> string(25) "create_direct_pay_by_user" ["is_success"]=> string(1) "T" ["notify_id"]=> string(74) "RqPnCoPT3K9%2Fvwbh3InSPgivIt2IBTdjvl%2F3jLRYIlPJ8cqr5dPpYTu%2FuS7gVbSF71xF" ["notify_time"]=> string(19) "2015-08-03 18:19:24" ["notify_type"]=> string(17) "trade_status_sync" ["out_trade_no"]=> string(13) "1438597195943" ["payment_type"]=> string(1) "1" ["seller_email"]=> string(21) "sunonlinecn@gmail.com" ["seller_id"]=> string(16) "2088411109773386" ["subject"]=> string(18) "我的测试商品" ["total_fee"]=> string(4) "0.01" ["trade_no"]=> string(28) "2015080300001000320066120809" ["trade_status"]=> string(13) "TRADE_SUCCESS" ["sign"]=> string(32) "c712d5cf921489901bdbbbde9b5dbe0b" ["sign_type"]=> string(3) "MD5" } 
            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序

            echo "验证成功<br />";

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }

    //支付宝手机——用户支付中途取消或失败
    public function actionZfbp_userfail() {
        die('支付取消或失败！');
    }

    /**
     * 支付宝——扫二维码(暂未开通)
     * 1、需要配置 /extensions/Zhifubaophone/alipay.config.php
     * 2、确保cacert.pem存在
     */
    public function actionZfb_sao() {
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/alipay.config.php");
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/lib/alipay_submit.class.php");

        /*         * ************************请求参数************************* */

        //接口调用时间
        $timestamp = date('Y-m-d h:i:s');
        //格式为：yyyy-MM-dd HH:mm:ss
        //动作
        $method = "add";
        //创建商品二维码
        //业务类型
        $biz_type = "1"; //接口文档不对，有 9、10、11、12
        //目前只支持1
        //业务数据
        $biz_data = array(
            'trade_type' => 1, //交易类型：1及时到账 2担保交易
            'need_address' => 'T', //是否需要收货地址： T需要 F不需要
            'goods_info' => array(//商品明细
                'id' => '123456', //商品编号
//                'name' => '商品名称', //商品名称【非必填】
//                'price' => '11.23', //商品价格（元）【非必填】
//                'inventory' => '100', //库存量【非必填】
//                'sku_title' => '请选择颜色大小', //商品属性标题【非必填】
//                'sku' => '"sku_id": "123456","sku_name": "白色","sku_price": "30.20","sku_inventory": "100"', //山品属性【非必填】
//                'expiry_date' => "2012-09-09 01:01:01|2012-09-19 01:02:59 ", //商品有效期【非必填】
//                'desc' => "这里是商品描述", //商品描述【非必填】
            ),
//            'return_url' => "", //通知商户下单URL 【非必填】
//            'notify_url' => Yii::app()->request->hostInfo . "/orderpay/zhifubaook", //通知商户支付结果url 【非必填】
//            'query_url' => "", //查询商品信息url 【非必填】
//            'ext_info' => array(//扩展属性【非必填】
//                "single_limit" => '1', //单次购买上限【非必填】
//                "user_limit" => '1', //单用户购买上限【非必填】
//                "pay_timeout" => '15', //支付超时时间（分钟）【非必填】
//                "logo_name" => '二维码', //二维码logo名称【非必填】
//                "ext_field" => '{"input_title": "请输入手机号码","input_regex":"^[1][3-8]+\\d{9}$"}', //自定义收集用户信息扩展字段【非必填】
//            ),
//            'memo' => "备注信息", //备注信息【非必填】
        );
        //格式：JSON 大字符串，详见技术文档4.2.1章节
        $biz_data = json_encode($biz_data);
        var_dump($biz_data);
        die;
        /*         * ********************************************************* */

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "alipay.mobile.qrcode.manage",
            "partner" => trim($alipay_config['partner']),
            "timestamp" => $timestamp,
            "method" => $method,
            "biz_type" => $biz_type,
            "biz_data" => $biz_data,
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);

        $html_text = $alipaySubmit->buildRequestHttp($parameter);

        //解析XML
        //注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
        $doc = new DOMDocument();
        $doc->loadXML($html_text);

        //请在这里加上商户的业务逻辑程序代码
        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
        //解析XML
        if (!empty($doc->getElementsByTagName("alipay")->item(0)->nodeValue)) {
            $alipay = $doc->getElementsByTagName("alipay")->item(0)->nodeValue;
            echo $alipay;
        }
    }

    //网银支付——支付页面(需要支付宝后台开通网银直连业务)
    public function actionZfb_yinlian() {
        $this->renderPartial('pay_zfb_yinlian');
    }

    //网银支付---支付调起
    public function actionYinlianpay() {
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/alipay.config.php");
        require_once(Yii::app()->basePath . "/extensions/Zhifubaophone/lib/alipay_submit.class.php");
        
        $goodname=$_POST['goodname'];
        $ordernum=$_POST['ordernum'];
        $totalprice=$_POST['totalprice'];
        $gooddescribe=$_POST['gooddescribe'];
        $goodaddress=$_POST['goodaddress'];
        $yhcode=$_POST['yhcode'];
        /*         * ************************请求参数************************* */

        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = Yii::app()->request->hostInfo . "/orderpay/zfbp_ok";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = Yii::app()->request->hostInfo . "/orderpay/zfbp_userok";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //商户订单号
        $out_trade_no = $ordernum;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = $goodname;
        //必填
        //付款金额
        $total_fee = $totalprice;
        //必填
        //订单描述
        $body = $gooddescribe;
        //默认支付方式
        $paymethod = "bankPay";
        //必填
        //默认网银
        $defaultbank = $yhcode;
        //必填，银行简码请参考接口技术文档
        //商品展示地址
        $show_url = $goodaddress;
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /*         * ********************************************************* */

//构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "seller_email" => trim($alipay_config['seller_email']),
            "payment_type" => $payment_type,
            "notify_url" => $notify_url,
            "return_url" => $return_url,
            "out_trade_no" => $out_trade_no,
            "subject" => $subject,
            "total_fee" => $total_fee,
            "body" => $body,
            "paymethod" => $paymethod,
            "defaultbank" => $defaultbank,
            "show_url" => $show_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip" => $exter_invoke_ip,
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );

//建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config,'https://mapi.alipay.com/gateway.do?');
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
        echo $html_text;
    }

    /*     * ******************************************************************支付宝专题结束***************************************************************************** */





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

    //私有方法，检查用户是否关注过公众号
    //获取已关注用户信息，如果未关注调用此方法，仅返回openid和describe信息
    public function _checkUserinfo() {
        if (!getYS('openid')) {
            $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
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

}
