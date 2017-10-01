<?php
/*
	Transmit类说明：
	拆分参数，分发到不同类别中
*/
class Transmit{
	/***************分流函数******************/
	public static function getImage($Parameter){
		$Type = $Parameter["Type"];
		$Stype = $Parameter["Stype"];
		$Config = $Parameter["Config"];
		$Test = $Parameter["Test"];
		$Data = $Parameter["Data"];
		
		
		
		switch($Type){
			//一级分流：Type分流
			case "Card":
				$QR = new Card($Parameter);		//Type = Card
				$base_image = $QR->getImage();
				break;
			case "Fancy":
				$QR = new Fancy($Parameter);		//Type = Fancy
				$base_image = $QR->getImage();
				break;
			case "Normal":
				$QR = new Normal($Parameter);	//Type = Normal
				$base_image = $QR->getImage();
				break;
			case "Color":
				$QR = new Color($Parameter);	//Type = Normal
				$base_image = $QR->getImage();
				break;
			case "Logo":
				$QR = new FancyLogo($Parameter);	//Type = Normal
				$base_image = $QR->getImage();
				break;
			case "Customized":
				$QR = new Customized($Parameter);	//Type = Normal
				$base_image = $QR->getImage();
				break;
			case "EPS":
				$QR = new EPS($Parameter);	//Type = Normal
				$base_image = $QR->getImage();
				break;
			default:
				break;	
		}
		
		return $base_image;
	}
}

?>