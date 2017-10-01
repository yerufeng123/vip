-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 �?03 �?30 �?11:35
-- 服务器版本: 5.5.38
-- PHP 版本: 5.5.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `qizheng`
--

-- --------------------------------------------------------

--
-- 表的结构 `hui_administrator`
--

CREATE TABLE IF NOT EXISTS `hui_administrator` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员账号',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员真实姓名',
  `role` tinyint(1) NOT NULL DEFAULT '0' COMMENT '管理员角色',
  `sex` varchar(6) NOT NULL DEFAULT '保密' COMMENT '管理员性别',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '管理员地址',
  `qq` varchar(13) NOT NULL DEFAULT '' COMMENT '管理员qq',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '管理员电话',
  `ctime` int(9) NOT NULL DEFAULT '0' COMMENT '管理员注册时间',
  `enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '管理员账号是否启用',
  PRIMARY KEY (`id`),
  KEY `idx_role` (`role`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `hui_administrator`
--

INSERT INTO `hui_administrator` (`id`, `username`, `password`, `name`, `role`, `sex`, `address`, `qq`, `phone`, `ctime`, `enable`) VALUES
(1, 'gaoxiangdong', '42a4773c37620dd7f2ecc9db6ddce5aa', '高祥栋', 2, '1', '我的地址', '439875761', '15650765389', 1421976791, 1),
(31, 'qzadmin', 'f4973a411f4ffc094f16be34665f6599', '奇正管理员', 2, '1', '随机住址', '439875761', '15650765389', 1427529323, 1);

-- --------------------------------------------------------

--
-- 表的结构 `hui_information`
--

CREATE TABLE IF NOT EXISTS `hui_information` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT '产品资料id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '资料标题',
  `little_pic` varchar(255) NOT NULL DEFAULT '' COMMENT '资料列表小图片',
  `display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示0不显示1显示',
  `PX` smallint(3) NOT NULL DEFAULT '999' COMMENT '同级排序',
  `ctime` int(9) NOT NULL DEFAULT '0' COMMENT '活动发布时间',
  `pid` int(9) NOT NULL DEFAULT '0' COMMENT '所属产品id',
  `aid` int(9) NOT NULL DEFAULT '0' COMMENT '发布管理员id',
  PRIMARY KEY (`id`),
  KEY `idx_pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文献分类表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `hui_information`
--

INSERT INTO `hui_information` (`id`, `title`, `little_pic`, `display`, `PX`, `ctime`, `pid`, `aid`) VALUES
(15, '内科', 'uploads/tempFile/thumb_1427516664_90585675.jpg', 1, 999, 1422342299, 4, 1),
(14, '儿科', 'uploads/tempFile/water_thumb_1422342281_26281109.jpg', 1, 999, 1422342282, 2, 1),
(13, '骨科', 'uploads/tempFile/water_thumb_1422342249_71266000.jpg', 1, 999, 1422342250, 1, 1),
(12, '外科', 'uploads/tempFile/water_thumb_1422342232_99784757.jpg', 1, 999, 1422342233, 1, 1),
(11, '内科', 'uploads/tempFile/water_thumb_1422342169_79778548.jpg', 1, 999, 1422342170, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `hui_information_content`
--

CREATE TABLE IF NOT EXISTS `hui_information_content` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT '文献内容id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '文献标题',
  `content` text NOT NULL COMMENT '文献内容',
  `display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示1显示0不显示',
  `PX` smallint(3) NOT NULL DEFAULT '999' COMMENT '同级排序',
  `ctime` int(9) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `aid` int(9) NOT NULL DEFAULT '0' COMMENT '发布管理员id',
  `Iid` int(9) NOT NULL DEFAULT '0' COMMENT '文献分类ID',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文献内容表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `hui_information_content`
--

INSERT INTO `hui_information_content` (`id`, `title`, `content`, `display`, `PX`, `ctime`, `aid`, `Iid`) VALUES
(3, '小儿的教育', '小儿的教育', 1, 999, 1422342332, 1, 14),
(4, '耳朵的防护', '耳朵的防护', 1, 999, 1422342372, 1, 12),
(5, '心脏的移植', '心脏的移植', 1, 999, 1422342395, 1, 11),
(6, 'sdfsf', '<p>xcvzxcvzxv</p>', 1, 999, 1422412549, 1, 15),
(9, 'dgdsfgsdg', '<h2><a href=\\"http://news.ifeng.com/a/20150310/43305531_0.shtml\\" target=\\"_blank\\" title=\\"习近平借“二人转”点题东北转型(图)\\">近平借“二人转”点题东北转型(图)</a></h2><h3><a href=\\"http://news.ifeng.com/a/20150309/43303510_0.shtml\\" target=\\"_blank\\" title=\\"李克强：不能让国企老工人年轻时流汗 年老时流泪\\">李克强：不能让老工人年轻时流汗 年老时流泪</a> <a href=\\"http://news.ifeng.com/a/20150310/43305570_0.shtml\\" target=\\"_blank\\" title=\\"网络新政\\">网络新政</a></h3><h3><a href=\\"http://news.ifeng.com/a/20150309/43299328_0.shtml\\" target=\\"_blank\\" title=\\"王岐山：痛惜海南民政厅门口花梨木被盗伐至今未破案\\">王岐山：痛惜海南民政厅门口花梨木被盗伐至今未破案</a> </h3><h2><a href=\\"http://news.ifeng.com/a/20150310/43309430_0.shtml\\" target=\\"_blank\\" title=\\"尹蔚民：渐进实施延迟退休 延长交费年限\\">尹蔚民：渐进实施延迟退休 延长交费年限</a></h2><h3><a href=\\"http://news.ifeng.com/a/20150310/43309700_0.shtml\\" target=\\"_blank\\" title=\\"延迟退休方案时间表：2017年推出 最早2022年实施\\">延迟退休方案时间表：2017年推出 最早2022年实施</a></h3><h3><a href=\\"http://news.ifeng.com/a/20150310/43309339_0.shtml\\" target=\\"_blank\\" title=\\"“公务员职务与职级并行制度”今年在县以下机关实行\\">“公务员职务与职级并行制度”今年在县以下机关实行</a></h3><h2><a href=\\"http://news.ifeng.com/a/20150310/43304675_0.shtml\\" target=\\"_blank\\" title=\\"默克尔劝日本“正视历史” 安倍政府沉默不应(图)\\">默克尔劝日本正视历史 安倍沉默不应(图)</a></h2><h3><a href=\\"http://news.ifeng.com/a/20150308/43294888_0.shtml\\" target=\\"_blank\\" title=\\"王毅：70年前日本输掉战争 70年后不应再输掉良知\\">王毅：70年前日本输掉战争 70年后不应再输掉良知</a> </h3><h3><a href=\\"http://news.ifeng.com/a/20150228/43240030_0.shtml\\" target=\\"_blank\\" title=\\"村山富市：日本殖民统治和侵略历史不容否认\\">村山富市：日本殖民统治和侵略历史不容否认</a></h3><h2><a href=\\"http://news.ifeng.com/a/20150310/43309914_0.shtml\\" target=\\"_blank\\" title=\\"演员王学兵涉毒 在家中与其他演员一起被带走\\">王学兵涉毒 在家中与其他演员一起被带走</a></h2><h3>延伸：<a href=\\"http://news.ifeng.com/a/20150301/43240109_0.shtml\\" target=\\"_blank\\" title=\\"尹相杰涉毒获刑7个月 称丢这么大脸太不值当(图)\\">尹相杰涉毒获刑7个月 称丢这么大脸太不值当(图)</a></h3><h3><a href=\\"http://news.ifeng.com/a/20150115/42938480_0.shtml\\" target=\\"_blank\\" title=\\"陈柏霖首谈柯震东、房祖名吸毒案：沉默为保护好友\\">陈柏霖谈柯震东、房祖名吸毒案：沉默为保护好友</a></h3><p><img src=\\"/ueditor/php/upload/image/20150310/1425982791128273.gif\\" height=\\"20\\" width=\\"84\\"/><span id=\\"todayDate\\">2015-3-10</span></p><ul class=\\"list_tdnews list-paddingleft-2\\"><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43310638_0.shtml\\" target=\\"_blank\\" title=\\"中组部副部长：有企业主冒充工人农民身份获代表提名\n\\"><strong>中组部：许多企业主冒充工人农民获代表提名</strong></a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43310225_0.shtml\\" target=\\"_blank\\" title=\\"北京河北已取消手机长途漫游\n\\">北京河北已取消手机长途漫游</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43310806_0.shtml\\" target=\\"_blank\\" title=\\"格力副总裁：重点大学应限制学生毕业去向\\">格力副总裁：重点大学应限制学生毕业去向</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43303979_0.shtml\\" target=\\"_blank\\" title=\\"佳洁士因“只需1天牙齿变白”虚假广告被罚603万\\">佳洁士因“只需1天牙齿变白”虚假广告被罚603万</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43304348_0.shtml\\" target=\\"_blank\\" title=\\"委员：“非法吸收公众存款罪”应尽快废除\\">委员：“非法吸收公众存款罪”应尽快废除</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20141219/42756051_0.shtml\\" target=\\"_blank\\" title=\\"凤凰网招聘全职时政编辑、专题策划、产品经理\\">凤凰网招聘全职时政编辑、专题策划、产品经理</a></h4></li></ul><ul class=\\"list_tdnews list-paddingleft-2\\"><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43311477_0.shtml\\" target=\\"_blank\\" title=\\"高峰、聂远涉嫌故意伤害罪被刑拘 邱启明被取保候审\\"><strong>高峰聂远涉故意伤害被刑拘 邱启明取保候审</strong></a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43306251_0.shtml\\" target=\\"_blank\\" title=\\"男子6万买古玩瓷盘 发现“微波炉适用”字样\\">男子6万买古玩瓷盘 发现“微波炉适用”字样</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43304408_0.shtml\\" target=\\"_blank\\" title=\\"上海：女子凌晨死在电梯内 头被卡电梯门间(图)\n\\">上海：女子凌晨死在电梯内 头被卡电梯门间(图)</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43311040_0.shtml\\" target=\\"_blank\\" title=\\"女子内疚第一次没给丈夫 帮丈夫强奸未成年侄女\\">女子内疚第一次没给丈夫 帮丈夫强奸未成年侄女</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43310984_0.shtml\\" target=\\"_blank\\" title=\\"安徽一医院给职工发红头文件：不配合拆迁就停职(图)\\">医院给职工发红头文件：不配合拆迁就停职(图)</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43311296_0.shtml\\" target=\\"_blank\\" title=\\"男子记忆衰退只剩“十分钟记忆” 用笔记下生活点滴\\">男子记忆衰退只剩“十分钟记忆” 用笔记生活点滴</a></h4></li></ul><ul class=\\"list_tdnews bbn list-paddingleft-2\\"><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43309814_0.shtml\\" target=\\"_blank\\" title=\\"美军上百辆M1A2主战坦克逼近俄罗斯边境(图)\\"><strong>美军上百辆M1A2主战坦克逼近俄罗斯边境(图)</strong></a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43309238_0.shtml\\" target=\\"_blank\\" title=\\"默克尔提醒日本正视历史 朱立伦首度表态：延续九二共识\n\\">默克尔提醒日本正视历史 朱立伦：延续九二共识</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43304257_0.shtml\\" target=\\"_blank\\" title=\\"印度男生赴德实习遭拒 女教授：担心印度“强奸问题”\\">印度男生赴德实习遭拒 女教授：担心强奸问题</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43309899_0.shtml\\" target=\\"_blank\\" title=\\"美国北卡罗莱纳州火车与拖挂车相撞 至少55人伤\n\\">美国北卡罗莱纳州火车与拖挂车相撞 至少55人伤</a></h4></li><li><h4><a href=\\"http://news.ifeng.com/a/20150310/43309876_0.shtml\\" target=\\"_blank\\" title=\\"阿根廷直升机相撞致10人遇难 含25岁奥运女冠军(图)\\">阿根廷直升机相撞致10人遇难 含25岁奥运女冠军(图)</a></h4></li><li><h4><a href=\\"http://dol.deliver.ifeng.com/c?865970965MluuVuLEVCrlk7CiF1N5piUjVsuTNmWaw1nose1ZFLC76AWu7BJwkn0EiQRyq0ti6Yt2cLkfH-QghP3Y5mjylcbwdla4D-bPA_9DTcT8KwA1yg6LAeUZsdnPj9PYvykA18BiaOx4y3e4dctBtF9523JmYxXhfnRroz63Q529V-ti1Xhj8-Y_w\\" target=\\"_blank\\" title=\\"红旗H7携手首汽国宾车队 成功服务2015全国两会\\">红旗H7携手首汽国宾车队 成功服务2015全国两会</a></h4><p><span class=\\"sys_time\\"></span></p></li></ul><h5><a href=\\"http://news.ifeng.com/mainland/\\" target=\\"_blank\\" title=\\"大陆\\">大陆</a></h5><p>\n		\n		&nbsp; &nbsp; &nbsp; &nbsp;\n\n\n\n\n\n\n\n\n\n	 &nbsp; &nbsp;\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><ul class=\\"clearfix list-paddingleft-2\\"><li><p><a href=\\"http://news.ifeng.com/a/20150310/43304523_0.shtml\\" target=\\"_blank\\" title=\\"天津将出“津八条”治霾 市长：不来虚的(图)\\">\n &nbsp;<img src=\\"/ueditor/php/upload/image/20150310/1425982791912574.jpg\\" title=\\"天津将出“津八条”治霾 市长：不来虚的(图)\\" alt=\\"天津将出“津八条”治霾 市长：不来虚的(图)\\"/></a></p></li><li><h6><a href=\\"http://news.ifeng.com/a/20150310/43304523_0.shtml\\" target=\\"_blank\\" title=\\"天津将出“津八条”治霾 市长：不来虚的(图)\\">天津将出“津八条”治霾 市长：不来虚的(图)</a></h6></li></ul><p>黄兴国表示，2015年天津治理大气污染将“实打实，不来虚的”，并公开了八条“硬碰硬”举措。[<a href=\\"http://news.ifeng.com/a/20150310/43304523_0.shtml\\" target=\\"_blank\\" title=\\"天津将出“津八条”治霾 市长：不来虚的(图)\\">详细</a>]</p><ul class=\\"list01 list-paddingleft-2\\"><li><p><a href=\\"http://news.ifeng.com/a/20150310/43311017_0.shtml\\" target=\\"_blank\\" title=\\"美媒：中国阻止美军部署反导 要把美国赶出亚洲\\">美媒：中国阻止美军部署反导 要把美国赶出亚洲</a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43308365_0.shtml\\" target=\\"_blank\\" title=\\"中纪委网站：反腐败国家立法要确立腐败行为界限\\">中纪委网站：反腐败国家立法要确立腐败行为界限</a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43307337_0.shtml\\" target=\\"_blank\\" title=\\"广州一婴儿被居民楼扔下的瓶子砸伤 或需做开颅手术\\">广州一婴儿被居民楼扔下的瓶子砸伤 或需做开颅手术</a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43306089_0.shtml\\" target=\\"_blank\\" title=\\"代表：不少政府要警察护着才敢执法 这是很悲哀的事\\">代表：不少政府要警察护着才敢执法 这是很悲哀的事</a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43306052_0.shtml\\" target=\\"_blank\\" title=\\"四届老代表带计算器参加两会 一次发言引用30个数字\\">四届老代表带计算器参加两会 一次发言引用30个数字</a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43305675_0.shtml\\" target=\\"_blank\\" title=\\"释永信：网络神曲《法海你不懂爱》恶意诋毁法海禅师\\">释永信：网络神曲《法海你不懂爱》恶意诋毁法海禅师</a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43305625_0.shtml\\" target=\\"_blank\\" title=\\"成都“环保警察”现雏形 四类案件将启动联动执法 \\">成都“环保警察”现雏形 四类案件将启动联动执法 </a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43305349_0.shtml\\" target=\\"_blank\\" title=\\"浙江：区委给村官言行立规矩 负面言行清单上墙公示\\">浙江：区委给村官言行立规矩 负面言行清单上墙公示</a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43304743_0.shtml\\" target=\\"_blank\\" title=\\"朱永新：人大像清华比较严谨 政协像北大比较活跃\\">朱永新：人大像清华比较严谨 政协像北大比较活跃</a></p></li><li><p><a href=\\"http://news.ifeng.com/a/20150310/43304283_0.shtml\\" target=\\"_blank\\" title=\\"前国脚高峰被曝吸毒后殴打的哥 名嘴邱启明或涉事\\">前国脚高峰被曝吸毒后殴打的哥 名嘴邱启明或涉事</a></p></li></ul><p><a href=\\"http://news.ifeng.com/mainland/\\" target=\\"_blank\\" title=\\"进入大陆频道\\">进入大陆频道</a></p><p><a href=\\"http://news.ifeng.com/a/20150310/43306212_0.shtml#p=1\\" target=\\"_blank\\" title=\\"两会上的悄悄话\\">\n &nbsp; &nbsp;<img src=\\"/ueditor/php/upload/image/20150310/1425982792113109.jpg\\" title=\\"两会上的悄悄话\\" alt=\\"两会上的悄悄话\\" height=\\"160\\" width=\\"240\\"/></a>\n &nbsp;</p><p><a href=\\"http://news.ifeng.com/a/20150310/43306212_0.shtml#p=1\\" target=\\"_blank\\" title=\\"两会上的悄悄话\\">两会上的悄悄话</a></p><p>[2015两会] 19:15</p><p><a href=\\"http://news.ifeng.com/a/20150310/43308217_0.shtml#p=1\\" target=\\"_blank\\" title=\\"母狮教导幼师捕猎场景\\">\n &nbsp; &nbsp;<img src=\\"/ueditor/php/upload/image/20150310/1425982792765062.jpg\\" title=\\"母狮教导幼师捕猎场景\\" alt=\\"母狮教导幼师捕猎场景\\" height=\\"160\\" width=\\"240\\"/></a>\n &nbsp;</p><p><a href=\\"http://news.ifeng.com/a/20150310/43308217_0.shtml#p=1\\" target=\\"_blank\\" title=\\"母狮教导幼师捕猎场景\\">母狮教导幼师捕猎场景</a></p><p>[环球] 06:31</p><p><a href=\\"http://dolphin.deliver.ifeng.com/c?z=ifeng&la=0&si=2&cg=1&c=1&ci=2&or=1174&l=16157&bg=16157&b=16165&u=http://dxw.ifeng.com/\\" target=\\"_blank\\"><img src=\\"/ueditor/php/upload/image/20150310/1425982793712305.jpg\\" title=\\"\\" alt=\\"\\" height=\\"160\\" width=\\"240\\"/></a></p><p><span style=\\"font-size:12px;\\">广告：</span><a href=\\"http://dolphin.deliver.ifeng.com/c?z=ifeng&la=0&si=2&cg=1&c=1&ci=2&or=1174&l=16157&bg=16157&b=16165&u=http://dxw.ifeng.com/\\" target=\\"_blank\\" title=\\"做中国第一思想平台\\">做中国第一思想平台</a></p><p><a href=\\"http://news.ifeng.com/a/20150308/43294227_0.shtml\\" target=\\"_blank\\" title=\\"拯救红毛猩猩\\"><img src=\\"/ueditor/php/upload/image/20150310/1425982793769020.jpg\\" title=\\"拯救红毛猩猩\\" alt=\\"拯救红毛猩猩\\" height=\\"160\\" width=\\"240\\"/></a></p><p><a href=\\"http://news.ifeng.com/a/20150308/43294227_0.shtml\\" target=\\"_blank\\" title=\\"拯救红毛猩猩\\">拯救红毛猩猩</a></p><br/><p><br/></p>', 1, 999, 1422417468, 1, 15);

-- --------------------------------------------------------

--
-- 表的结构 `hui_link`
--

CREATE TABLE IF NOT EXISTS `hui_link` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT '链接id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '链接标题',
  `little_pic` varchar(255) NOT NULL DEFAULT '' COMMENT '链接列表小图片',
  `url` text NOT NULL COMMENT '推广链接',
  `display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示1显示0不显示',
  `PX` smallint(3) NOT NULL DEFAULT '999' COMMENT '同级排序',
  `ctime` int(9) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `pid` int(9) NOT NULL DEFAULT '0' COMMENT '所属产品id',
  `aid` int(9) NOT NULL DEFAULT '0' COMMENT '发布管理员id',
  PRIMARY KEY (`id`),
  KEY `idx_pid` (`pid`),
  KEY `idx_aid` (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='推广工具表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `hui_link`
--

INSERT INTO `hui_link` (`id`, `title`, `little_pic`, `url`, `display`, `PX`, `ctime`, `pid`, `aid`) VALUES
(8, '4444444', 'uploads/tempFile/water_thumb_1425265860_93609995.jpg', 'http://www.baidu.com', 1, 999, 1425265877, 1, 1),
(6, '推广产品1', 'uploads/tempFile/water_thumb_1422342453_83705247.jpg', 'http://www.baidu.com', 1, 999, 1422342454, 2, 1),
(7, 'dddddd', 'uploads/tempFile/water_thumb_1423386838_92676313.jpg', 'http://zhidao.baidu.com/link?url=3sQkPaZWEwLhziFKZpR1IK1CRaRT3jj5P4sTA1p_rfc6bRVjrXKAbAtVyTjKDtXQHAbqslADnYKkp979SNTAoK', 1, 999, 1423386840, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `hui_product`
--

CREATE TABLE IF NOT EXISTS `hui_product` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT '产品id',
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT '产品名称',
  `introduction` text NOT NULL COMMENT '适应症',
  `use_method` text NOT NULL COMMENT '用法用量',
  `bad_reaction` text NOT NULL COMMENT '不良反应',
  `taboo` text NOT NULL COMMENT '禁忌',
  `pic` text NOT NULL COMMENT '公司宣传图片',
  `product_pic` text NOT NULL COMMENT '产品展示图片',
  `PX` smallint(3) NOT NULL DEFAULT '999' COMMENT '排序',
  `ctime` int(9) NOT NULL DEFAULT '0' COMMENT '活动发布时间',
  `other` text NOT NULL COMMENT '保留用户自增字段，按一定格式存储',
  `aid` int(9) NOT NULL DEFAULT '0' COMMENT '发布管理员id',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='产品表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `hui_product`
--

INSERT INTO `hui_product` (`id`, `name`, `introduction`, `use_method`, `bad_reaction`, `taboo`, `pic`, `product_pic`, `PX`, `ctime`, `other`, `aid`) VALUES
(1, '1', '11', '11', '11', '11', 'uploads/businesspic/thumb_1426670342_68375653.jpg', 'uploads/productpic/thumb_1426670333_18234517.jpg', 0, 1426648780, '[]', 1),
(6, '测试', '测试测试测试', '测试测试测试', '测试测试', '测试测试测试', 'uploads/businesspic/thumb_1427530668_55491067.png,uploads/businesspic/thumb_1427530668_47305538.png,uploads/businesspic/thumb_1427530668_37254914.png,uploads/businesspic/thumb_1427530669_16227992.png', 'uploads/productpic/thumb_1427530673_75008331.jpg', 999, 1427530674, '[\\"测试测试测试@@@@测试测试测试测试\\",\\"测试@@@@测试测试测试\\",\\"测试@@@@测试测试\\"]', 1),
(2, 'asdasdas', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', 'uploads/businesspic/thumb_1426649289_25451792.jpg', 'uploads/productpic/thumb_1426649292_42501618.jpg', 999, 1426649295, '[]', 1),
(3, 'asdasdas', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', 'uploads/businesspic/thumb_1426649331_31919727.jpg', 'uploads/productpic/thumb_1426649335_19683184.jpg', 999, 1426649336, '[]', 1),
(4, 'dsfffffffffffffffff', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'uploads/businesspic/thumb_1426649471_17711744.png', 'uploads/productpic/thumb_1426649475_69056806.png', 999, 1426649477, '[]', 1),
(5, 'aaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'uploads/businesspic/thumb_1426670442_94407683.png', 'uploads/productpic/thumb_1426670446_10584085.jpg', 999, 1426649518, '[]', 1);

-- --------------------------------------------------------

--
-- 表的结构 `hui_user`
--

CREATE TABLE IF NOT EXISTS `hui_user` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户编号',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '用户姓名',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '用户手机号',
  `ctime` int(9) NOT NULL DEFAULT '0',
  `enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户是否启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `hui_user`
--

INSERT INTO `hui_user` (`id`, `username`, `name`, `phone`, `ctime`, `enable`) VALUES
(9, '002', '王麻子', '15010255569', 1427529447, 1),
(8, '001', '王二小', '15650765888', 1427529424, 1);

-- --------------------------------------------------------

--
-- 表的结构 `hui_web`
--

CREATE TABLE IF NOT EXISTS `hui_web` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `accessnum` int(9) NOT NULL DEFAULT '0' COMMENT '网站访问次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='网站信息配置表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hui_web`
--

INSERT INTO `hui_web` (`id`, `accessnum`) VALUES
(1, 16);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
