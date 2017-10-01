<?php

/*
 * 本文件存放项目的所有额外配置信息
 * 2015-05-16
 * 高祥栋
 */

return array(
    /**
     * 公司外包通用项目配置
     */
    'common' => array(
        /* 系统配置 */
        'adminEmail' => 'webmaster@example.com',
        /* 公众号配置----果冻配置 */
        'wxtoken' => '3qmygys4ssjtwmy4tsgx', //微信公众号 token值
        'wxencodingaeskey' => '1PI5cU2XnQbNjcehjH5ZHXNCzQw1V4rUF0EYDLbzZ', //微信公众号加密EncodingAESKey
        'wxappid' => 'wx6e7ae31a2156727a', //微信公众号appid
        'wxappsecret' => 'f5266e9f1bf36b08dd71a2f4b38b1f3e', //微信公众号appsecret

        /* 项目配置 */
        'checkBrowser' => false, //是否开启微信浏览器检测，默认否(个别项目需要单独配置的，请另写)
        'isradom' => true, //是否开启缓存清楚，默认是（生产环境，建议关闭，缓存可以提高效率)
    ),
    /*
     * 英纳格项目配置
     */
    'enicar' => array(
        /* 系统配置 */
        'adminEmail' => 'webmaster@example.com',
        'wxtoken' => '3qmygys4ssjtwmy4tsgx', //微信公众号 token值
        'wxencodingaeskey' => '1PI5cU2XnQbNjcehjH5ZHXNCzQw1V4rUF0EYDLbzZ', //微信公众号加密EncodingAESKey
        'wxappid' => 'wx6e7ae31a2156727a', //微信公众号appid
        'wxappsecret' => 'f5266e9f1bf36b08dd71a2f4b38b1f3e', //微信公众号appsecret

        /* 项目配置 */
        'checkBrowser' => false, //是否开启微信浏览器检测，默认否
        'isradom' => false, //是否开启缓存清楚，默认是（生产环境，建议关闭，缓存可以提高效率)
    ),
    /**
     * 民生项目配置
     */
    'minsheng' => array(
        /* 系统配置 */
        'adminEmail' => 'webmaster@example.com',
        'wxtoken' => '3qmygys4ssjtwmy4tsgx', //微信公众号 token值
        'wxencodingaeskey' => '1PI5cU2XnQbNjcehjH5ZHXNCzQw1V4rUF0EYDLbzZ', //微信公众号加密EncodingAESKey
        'wxappid' => 'wx6e7ae31a2156727a', //微信公众号appid
        'wxappsecret' => 'f5266e9f1bf36b08dd71a2f4b38b1f3e', //微信公众号appsecret

        /* 项目配置 */
        'checkBrowser' => false, //是否开启微信浏览器检测，默认否
        'isradom' => true, //是否开启缓存清楚，默认是（生产环境，建议关闭，缓存可以提高效率)
    ),
    /**
     * 盛景项目配置
     */
    'shengjing' => array(
        /* 系统配置 */
        'adminEmail' => 'webmaster@example.com',
        'wxtoken' => '3qmygys4ssjtwmy4tsgx', //微信公众号 token值
        'wxencodingaeskey' => '1PI5cU2XnQbNjcehjH5ZHXNCzQw1V4rUF0EYDLbzZ', //微信公众号加密EncodingAESKey
        'wxappid' => 'wx6e7ae31a2156727a', //微信公众号appid
        'wxappsecret' => 'f5266e9f1bf36b08dd71a2f4b38b1f3e', //微信公众号appsecret

        /* 项目配置 */
        'checkBrowser' => false, //是否开启微信浏览器检测，默认否
        'isradom' => true, //是否开启缓存清楚，默认是（生产环境，建议关闭，缓存可以提高效率)

        /**
         * 说明：配置在各事件点用户可摇到的类型信息
         * 规则：时间格式只按小时设置 格式为 xx:xx
         */
        'timetype' => array(
            'text' => array(//文字类型
                'stime' => '00:00',
                'etime' => '24:00'
            ),
            'image' => array(//图片类型
                'stime' => '00:00',
                'etime' => '24:00'
            ),
            'imageone' => array(//单张图片类型
                'stime' => '00:00',
                'etime' => '24:00'
            ),
            'voice' => array(//语音类型
                'stime' => '00:00',
                'etime' => '24:00'
            ),
            'card' => array(//卡券类型
                'stime' => '00:00',
                'etime' => '24:00'
            ),
        ),
    ),
	 'strasbourg' => array(
        /* 系统配置 */
        'adminEmail' => 'webmaster@example.com',
        /* 公众号配置----果冻配置 */
        'wxtoken' => '3qmygys4ssjtwmy4tsgx', //微信公众号 token值
        'wxencodingaeskey' => '1PI5cU2XnQbNjcehjH5ZHXNCzQw1V4rUF0EYDLbzZ', //微信公众号加密EncodingAESKey
        'wxappid' => 'wx6e7ae31a2156727a', //微信公众号appid
        'wxappsecret' => 'f5266e9f1bf36b08dd71a2f4b38b1f3e', //微信公众号appsecret

        /* 项目配置 */
        'checkBrowser' => true, //是否开启微信浏览器检测，默认否(个别项目需要单独配置的，请另写)
        'isradom' => true, //是否开启缓存清楚，默认是（生产环境，建议关闭，缓存可以提高效率)
    ),
    'base_host'=>'vip.jellyideas.net',
);
