<?php
error_reporting(0);
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
defined("_STATIC_")  or  define('_STATIC_',"http://".$_SERVER['SERVER_NAME']."/static/");
defined("_STATICPATH_")  or  define('_STATICPATH_',$_SERVER['DOCUMENT_ROOT']."/static/");
$globals=dirname(__FILE__).'/protected/config/globals.php';
require_once($globals);
require_once($yii);
date_default_timezone_set('PRC'); //设置时间为北京时间，记得配置文件中配置下，一劳永逸
Yii::createWebApplication($config)->run();
