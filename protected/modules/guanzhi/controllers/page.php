<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$count = $result['count'] * 1; // 查询满足要求的总记录数

require_once (Yii::app()->basePath . '/extensions/Myclass/Page.class.php');
$Page = new Page($count, 20, '1'); // 实例化分页类 传入总记录数和每页显示的记录数
$show = $Page->show(); // 分页显示输出