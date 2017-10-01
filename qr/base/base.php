<?php
class Base{
	/*
		Base类说明：
		1.提供基础QR码封装服务
	*/
	
	//简化参数，仅根据Data和错误等级返回Frame数组
	public static function getFrame($data,$errorCorrectionLevel){
		$enc = qrencode::factory($errorCorrectionLevel, $matrixPointSize = 0, $margin = 1);
		return $enc->getFrame($data);
	}
	
	//返回pixelPerPoint尺寸下的Grid
	//Grid表示网格上的节点坐标，是一个三维数组，前两位分别是x和y方向的维度，大小比frame多1.第三个维度有两个参数，x和y，表示坐标点的x和y值
	public static function getGrid($frame,$pixelPerPoint,$dist=0){
		/*
		**$frame:原始的二维码数组
		**$pixelPerPoint:每个格子的宽度（像素）
		**$dist:Grid的抖动程度，默认是0
		*/
		srand((double)microtime()*1000000);
		
		$h = count($frame);
		$w = strlen($frame[0]);
		$Arr = Array();
		for($y=0; $y<$h + 1; $y++) {
			$ArrY = Array();
			for($x=0; $x<$w + 1; $x++) {
				$ArrXY = Array();
				//让坐标x和y在dist范围内抖动
				$rand_number= rand(-100,100);
				$ArrXY['x'] = $x * $pixelPerPoint + $rand_number / 100 * $dist;
				$rand_number= rand(-100,100);
				$ArrXY['y'] = $y * $pixelPerPoint + $rand_number / 100 * $dist;
				$ArrY[$x] = $ArrXY;
			}
			$Arr[$y] = $ArrY;
		}
		return $Arr;
	}
	
	//按Grid来进行二维码填充
	public static function fillWithGrid($base_image,$frame,$grid,$color){
		$h = count($frame);
		$w = strlen($frame[0]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if($frame[$y][$x] == '1'){
					$values = Array();
					$values[0]= $grid[$y][$x]['x'];
					$values[1]= $grid[$y][$x]['y'];
					$values[2]= $grid[$y][$x+1]['x'];
					$values[3]= $grid[$y][$x+1]['y'];
					$values[4]= $grid[$y+1][$x+1]['x'];
					$values[5]= $grid[$y+1][$x+1]['y'];
					$values[6]= $grid[$y+1][$x]['x'];
					$values[7]= $grid[$y+1][$x]['y'];
					Base::PolygenFill($base_image,$values,$color);
				}
			}
		}
	}
	
	public static function PolygenFill($base_image,$values,$color){
		imageantialias($base_image,true);
		imagefilledpolygon($base_image, $values, count($values) / 2, $color);	
		for($i = 0 ; $i < count($values) - 2;$i+=2){
			imageline($base_image, $values[$i], $values[$i + 1], $values[$i+2], $values[$i + 3], $color);
		}
		imageline($base_image, $values[count($values) - 2], $values[count($values) - 1], $values[0], $values[1], $color);
	}
	
	//解析$Config字段，并返回数组
	public static function getConfig($Config){
		$con = array();
		if($Config){
			$temArr = explode(";",$Config);
			$temlen = count($temArr);
			if($temlen > 0){
				for($i = 0 ; $i < $temlen ; $i ++){
					$temstr = $temArr[$i];
					$temArrT = explode(":",$temstr);
					
					$temstrT = $temArrT[1];
					for($j = 2 ; $j < count($temArrT); $j++){
						$temstrT = $temstrT.":".$temArrT[$j];
					}
					$con[$temArrT[0]] = $temstrT;
				}
			}
		}
		
		return $con;
	}
	
	public static function setFrameByBlack($frame,$pixelPerPoint,$left,$top,$null_bg){
		$h = count($frame);
		$w = strlen($frame[0]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if($frame[$y][$x] == '1'){
					$x1 = $pixelPerPoint * $x + $left;
					$y1 = $pixelPerPoint * $y + $top;
					$x2 = $pixelPerPoint * ($x + 1) + $left;
					$y2 = $pixelPerPoint * ($y + 1) + $top;;
					for($yy = $y1; $yy < $y2; $yy ++){
						for($xx = $x1 ; $xx < $x2 ; $xx ++){
							$rgb = imagecolorat($null_bg, $xx, $yy); // Get current background color
							$rB = ($rgb >> 16) & 0xFF;
							$gB = ($rgb >> 8) & 0xFF;
							$bB = $rgb & 0xFF;
							if($rB < 100){
								$frame[$y][$x] = 0;
							}
						}
					}
				}
			}
		}
		return $frame;
	}
	
	public static function getColor($colorStr,$mode='rgb'){
		$color = array();
		if($mode == 'rgb'){
			if(preg_match('/#[0-9a-fA-F]{6}/', $colorStr)){
				$color[0] = hexdec("0x".$colorStr[1].$colorStr[2]); 
				$color[1] = hexdec("0x".$colorStr[3].$colorStr[4]); 
				$color[2] = hexdec("0x".$colorStr[5].$colorStr[6]);  
			}else{
				$color[0] = 255; 
				$color[1] = 255; 
				$color[2] = 255; 
			}
		}else if($mode == 'cmyk'){
			if(preg_match('/#[0-9a-fA-F]{8}/', $colorStr)){
				$color[0] = hexdec("0x".$colorStr[1].$colorStr[2]) / 255; 
				$color[1] = hexdec("0x".$colorStr[3].$colorStr[4]) / 255; 
				$color[2] = hexdec("0x".$colorStr[5].$colorStr[6]) / 255;
				$color[3] = hexdec("0x".$colorStr[7].$colorStr[8]) / 255; 
			}else{
				$color[0] = 255 / 255; 
				$color[1] = 255 / 255; 
				$color[2] = 255 / 255; 
				$color[3] = 255 / 255; 
			}
		}

		return $color;
	}
	
	public static function colorAllocate($base_image,$color){
		$c = Base::getColor("#".$color);
		return imagecolorallocate($base_image,$c[0],$c[1],$c[2]);
	}
	
	public static function trueColor($base_image,$color){
		$c = Base::getColor("#".$color);
		return imagecolorallocatealpha($base_image,$c[0],$c[1],$c[2],0);
	}
	
	public static function setNormal($value,$normal){
		return $value?$value:$normal;
	}
}
?>