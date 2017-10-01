<?php
    error_reporting(0);
	/*
		1.所有二维码程序入口，统一的参数规格，分流
		2.参数列表：
			a.Type		//二维码类型，必填
			b.Stype		//二维码子类型，选填
			c.Config	//参数组，必填
			d.Test		//测试组，选填，隐藏参数
			e.Data		//二维码数据，必填
	*/
	include "qrlib.php";   
	$Parameter = array();
	$Parameter["Type"] = "Default";
	$Parameter["Stype"] = "Default";
	$Parameter["Config"] = "Default";
	$Parameter["Test"] = "Default";
	$Parameter["Data"] = "Default";
	
	if(isset($_REQUEST['Type'])){
		$Parameter["Type"] = $_REQUEST['Type'];
	}
	if(isset($_REQUEST['Config'])){	
		$Parameter["Config"] = $_REQUEST['Config'];
	}
	if(isset($_REQUEST['Stype'])){	
		$Parameter["Stype"] = $_REQUEST['Stype'];
	}
	if(isset($_REQUEST['Test'])){	
		$Parameter["Test"] = $_REQUEST['Test'];
	}
	if(isset($_REQUEST['Data'])){	
		$Parameter["Data"] = $_REQUEST['Data'];
	}
	$data = Transmit::getImage($Parameter);

	Header("Content-type: image/png");
	ImagePng($data);
	ImageDestroy($data);

