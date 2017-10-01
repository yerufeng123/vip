<?php
class Model{
	public static function brick($frame,$logo,$pixelPerPoint,$r){
		//$frame:二维码阵列
		//$logo:logo图像
		
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint + $outerFrame * 2;
		$imgH = $h* $pixelPerPoint + $outerFrame * 2;
            
		$base_image = imagecreatetruecolor($imgW,$imgH);
		imageantialias($base_image ,true);		
		
		
		
		return $base_image;
	}	
	
	public static function main($frame,$base_image,$pixelPerPoint,$outerFrame,$margin,$r,$col,$colTop){
		//绘制主体部分，带R参数的版本
		$h = count($frame);
		$w = strlen($frame[0]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					if($x < 7 && $y < 7){
						imagefilledrectangle($base_image,($x)* $pixelPerPoint + $outerFrame ,($y) * $pixelPerPoint + $outerFrame ,($x + 1 )* $pixelPerPoint+ $outerFrame -$margin,($y+ 1) * $pixelPerPoint+ $outerFrame -$margin,$colTop); 
					}else{
						if(($x - $w/2) * ($x - $w/2) + ($y - $h/2) * ($y - $h/2) < $r * $r){
						}else{
							imagefilledrectangle($base_image,($x)* $pixelPerPoint + $outerFrame ,($y) * $pixelPerPoint + $outerFrame ,($x + 1 )* $pixelPerPoint+ $outerFrame -$margin,($y+ 1) * $pixelPerPoint+ $outerFrame -$margin,$col); 
						}
					}
				}
			}
		}
	}
	public static function shadow($frame,$base_image,$pixelPerPoint,$outerFrame,$margin,$r,$colS){
		//绘制阴影部分，带R参数的版本
		$h = count($frame);
		$w = strlen($frame[0]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1') {
					if(($x - $w/2) * ($x - $w/2) + ($y - $h/2) * ($y - $h/2) < $r * $r){
					}else{
						imagefilledrectangle($base_image,($x)* $pixelPerPoint+ 1 + $outerFrame ,($y) * $pixelPerPoint + 1 + $outerFrame ,($x + 1 )* $pixelPerPoint+ 1+ $outerFrame -$margin,($y+ 1) * $pixelPerPoint + 1 + $outerFrame -$margin,$colS); 
					}
				}
			}
		}
	}
	
	public static function getImageWithLogo($data,$level,$pixelPerPoint,$margin,$col,$col2,$hasShadow = false,$logo = false){
		
		//返回带logo的二维码，直接调用上面的接口
		$frame = self::getFrame($data,$level,$pixelPerPoint);//获取数据点阵
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint;
		$imgH = $h* $pixelPerPoint;
		$base_image = imagecreate($imgW,$imgH);
		$bg = imagecolorallocate($base_image,255,255,255);
		$col = QRimage::getColor($col);
		$col = imagecolorallocate($base_image,$col[0],$col[1],$col[2]);
		$col2 = QRimage::getColor($col2);
		$col2 = imagecolorallocate($base_image,$col2[0],$col2[1],$col2[2]);
		$r = $w / 5;
		

		if($logo){
			$logoimg = Model::getIcon($logo);
			//$logo_bg = imagecolorallocate($logo,255,255,255);
			$bx=imagesx($logoimg);//logo的实际宽度
			$by=imagesy($logoimg);//logo的实际高度
			
			if($bx > $by){
				$mx = $r * 2 * $pixelPerPoint;//logo的转换宽度
				$my = $mx * ($by / $bx);//logo的转换高度	
			}else{
				$my = $r * 2 * $pixelPerPoint;//logo的转换宽度
				$mx = $my * ($bx / $by);//logo的转换高度	
			}
			
			$cx = ($w/2+ 1)*$pixelPerPoint - $mx / 2;
			$cy = ($h/2+ 1)*$pixelPerPoint - $my / 2;
			//imagecolortransparent($logo,$logo_bg);
			ImageCopyResized($base_image,$logoimg,$cx,$cy,0, 0,$mx,$my,$bx,$by);
		}
		if($hasShadow){
			//如果需要绘制阴影
			Model::shadow($frame,$base_image,$pixelPerPoint,0,$margin,$r,$col2);
		}
		Model::main($frame,$base_image,$pixelPerPoint,0,$margin,$r,$col,$col);
		
		imagecolortransparent($base_image,$bg);
		return $base_image;
	}
	
	public static function getImage($base_image,$left,$top,$frame,$pixelPerPoint,$margin,$bg){
		//imageantialias ($base_image ,true);
		
		//$bg_color = imagecolorallocatealpha($base_image,255,255,255,127);
		//imagefilledrectangle($base_image,0,0,$imgW,$imgH,$bg_color);
		$h = count($frame);
		$w = strlen($frame[0]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagecopy($base_image,$bg,($x)* $pixelPerPoint +$left ,($y) * $pixelPerPoint  + $top,($x)* $pixelPerPoint  ,($y) * $pixelPerPoint ,$pixelPerPoint -$margin,$pixelPerPoint -$margin);
					//imagefilledrectangle($base_image,($x)* $pixelPerPoint  ,($y) * $pixelPerPoint ,($x + 1 )* $pixelPerPoint -$margin,($y+ 1) * $pixelPerPoint -$margin,$col); 
				}
			}
		}
		//return $base_image;
	}
	
	public static function getImageCode($frame,$pixelPerPoint,$margin,$bg){
		//返回以图片为格子的二维码

		$bg = imagecreatefrompng($bg);

		
		
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint + 50;
		$imgH = $h* $pixelPerPoint + 50;

		$base_image = imagecreate($imgW,$imgH);

		$bgc = imagecolorallocate($base_image,$bgcolor[0],$bgcolor[1],$bgcolor[2]);
		
		
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagecopy($base_image,$bg,($x)* $pixelPerPoint,($y) * $pixelPerPoint,($x)* $pixelPerPoint,($y) * $pixelPerPoint,$pixelPerPoint,$pixelPerPoint);
				}
			}
		}
		imagecolortransparent($base_image,$bgc);
		return $base_image;
		
	}
	
	public static function getCode($frame,$pixelPerPoint,$margin,$color){
		/***************绘制带颜色二维码*********************/
		$c = QRimage::getColor($color);
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint;
		$imgH = $h* $pixelPerPoint;

		$base_image = imagecreate($imgW,$imgH);
		$bgcolor = imagecolorallocate($base_image,1,1,1);
		$col = imagecolorallocatealpha($base_image,$c[0],$c[1],$c[2],0);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagefilledrectangle($base_image,($x)* $pixelPerPoint,($y) * $pixelPerPoint,($x + 1 )* $pixelPerPoint -$margin,($y+ 1) * $pixelPerPoint -$margin,$col); 
				}
			}
		}
		imagecolortransparent($base_image,$bgcolor);
		
		return $base_image;
	}
	
	public static function getColorImage($base_image,$left,$top,$frame,$pixelPerPoint,$margin,$color,$trans){
		//绘制主体部分，带R参数的版本
		//imageantialias ($base_image ,true);
		$c = QRimage::getColor($color);
		$col = imagecolorallocatealpha($base_image,$c[0],$c[1],$c[2],$trans);
		//imagefilledrectangle($base_image,0,0,$imgW,$imgH,$bg_color);
		$h = count($frame);
		$w = strlen($frame[0]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					//imagecopy($base_image,$bg,($x)* $pixelPerPoint +$left ,($y) * $pixelPerPoint  + $top,($x)* $pixelPerPoint  ,($y) * $pixelPerPoint ,$pixelPerPoint -$margin,$pixelPerPoint -$margin);
					imagefilledrectangle($base_image,($x)* $pixelPerPoint +$left ,($y) * $pixelPerPoint + $top,($x + 1 )* $pixelPerPoint -$margin + $left,($y+ 1) * $pixelPerPoint -$margin + $top,$col); 
				}
			}
		}
		//return $base_image;
	}
	
	public static function drawInnerShadow($base_image,$left,$top,$frame,$pixelPerPoint,$imgS,$bgcolor,$angel=0,$distance=3){
		//根据指定的底色生成内阴影二维码图
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint + 50;
		$imgH = $h* $pixelPerPoint + 50;

		$imgShadow = self::getInnerShadow($frame,$pixelPerPoint,$imgS,$bgcolor,$distance);
		if($angel != 0){
			imageantialias($imgShadow,true);
			$imgShadow = imagerotate($imgShadow,$angel,0,0);
		}

		imagecopy($base_image,$imgShadow,$left,$top,0,0,imagesx($imgShadow),imagesy($imgShadow));
	}
	
	public static function drawImageByBg($base_image,$left,$top,$frame,$pixelPerPoint,$bg){
		//用指定的图形来绘制二维码图（以图形本身作为二维码块的构成）
		//根据背景图生成渐变码
		$h = count($frame);
		$w = strlen($frame[0]);

		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagecopy($base_image,$bg,($x)* $pixelPerPoint +$left,($y) * $pixelPerPoint + $top,($x)* $pixelPerPoint + $left,($y) * $pixelPerPoint+$top,$pixelPerPoint,$pixelPerPoint);
				}
			}
		}
	}
	
	public static function drawImageByColor($base_image,$left,$top,$frame,$pixelPerPoint,$color){
		$h = count($frame);
		$w = strlen($frame[0]);

		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagefilledrectangle($base_image,($x)* $pixelPerPoint + $left,($y) * $pixelPerPoint + $top,($x + 1 )* $pixelPerPoint + $left,($y+ 1) * $pixelPerPoint + $top,$color); 
				}
			}
		}
	}
	
	public static function drawInnerShadowByBg($base_image,$left,$top,$frame,$pixelPerPoint,$imgS,$bg){
		//根据指定的背景图生成内阴影二维码图
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint + 50;
		$imgH = $h* $pixelPerPoint + 50;
		$imgShadow = self::getInnerShadowImage($frame,$pixelPerPoint,$imgS,$bg,$left,$top);

		imagecopy($base_image,$imgShadow,$left,$top,0,0,imagesx($imgShadow),imagesy($imgShadow));
	}
	
	public static function getInnerShadowImage($frame,$pixelPerPoint,$imgS,$bg,$left,$top){
		//根据背景图生成渐变码
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint + 50;
		$imgH = $h* $pixelPerPoint + 50;
		$image_shadow = imagecreatetruecolor($imgW,$imgH);
		//$bgsc = imagecolorallocatealpha($image_shadow,255,255,0,127);
		//imagefill($image_shadow,0,0,$bgsc);
		//$distance=5;
		$base_image = imagecreatetruecolor($imgW,$imgH);				//底图
		
		$bgc = imagecolorallocatealpha($base_image,0,0,0,127);
		imagefill($base_image,0,0,$bgc);

		imagecopyresized($image_shadow,$bg,0,0,0,0,$imgW,$imgH,$imgW,$imgH);
		
		for($y=-1; $y<$h + 1; $y++) {
			for($x=-1; $x<$w + 1; $x++) {
				if ($frame[$y][$x] != '1'){
					for($ty = 0 ; $ty < $pixelPerPoint ; $ty ++){
						for($tx = 0 ; $tx < $pixelPerPoint ; $tx ++){
							imagecopy($image_shadow,$imgS,($x)* $pixelPerPoint + $tx +$left - 3,($y) * $pixelPerPoint + $ty + $top - 3,0,0,15,15);
						}
					}
				}
			}
		}
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagecopy($base_image,$image_shadow,($x)* $pixelPerPoint,($y) * $pixelPerPoint,($x)* $pixelPerPoint + $left,($y) * $pixelPerPoint+$top,$pixelPerPoint,$pixelPerPoint);
				}
			}
		}
		imagecolortransparent($base_image,$bgc);
		return $base_image;
	}
	
	public static function getInnerShadow($frame,$pixelPerPoint,$imgS,$bgcolor,$distance=3){
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint + 50;
		$imgH = $h* $pixelPerPoint + 50;
		$image_shadow = imagecreatetruecolor($imgW,$imgH);
		$base_image = imagecreatetruecolor($imgW,$imgH);
		$bgcolor = QRimage::getColor($bgcolor);
		
		$bgcolor = imagecolorallocate($image_shadow,$bgcolor[0],$bgcolor[1],$bgcolor[2]);
		$bgc = imagecolorallocate($base_image,$bgcolor[0],$bgcolor[1],$bgcolor[2]);
		
		
		imagefilledrectangle($image_shadow,0,0,$imgW,$imgH,$bgcolor);
		
		for($y=-1; $y<$h + 1; $y++) {
			for($x=-1; $x<$w + 1; $x++) {
				if ($frame[$y][$x] != '1'){
					for($ty = 0 ; $ty < $pixelPerPoint ; $ty ++){
						for($tx = 0 ; $tx < $pixelPerPoint ; $tx ++){
							imagecopy($image_shadow,$imgS,($x)* $pixelPerPoint + $tx ,($y) * $pixelPerPoint + $ty,0,0,15,15);
						}
					}
					
				}
			}
		}
		
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagecopy($base_image,$image_shadow,($x)* $pixelPerPoint,($y) * $pixelPerPoint,($x)* $pixelPerPoint + $distance,($y) * $pixelPerPoint+$distance,$pixelPerPoint,$pixelPerPoint);
				}
			}
		}
		imagecolortransparent($base_image,$bgc);
		return $base_image;
	}
	
	public static function drawShadowAt($base_image,$base_x,$base_y,$frame,$pixelPerPoint,$imgS,$r=0){
		//返回正常阴影（有扩散效果)
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint + 50;
		$imgH = $h* $pixelPerPoint + 50;
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					if(($x - $w/2) * ($x - $w/2) + ($y - $h/2) * ($y - $h/2) < $r * $r){
						
					}else{
						for($ty = 0 ; $ty < $pixelPerPoint ; $ty ++){
							for($tx = 0 ; $tx < $pixelPerPoint ; $tx ++){
								imagecopy($base_image,$imgS,($x)* $pixelPerPoint + $tx +$base_x,($y) * $pixelPerPoint + $ty + $base_y,0,0,imagesx($imgS),imagesy($imgS));
							}
						}	
					}
				}
			}
		}
		//imagecolortransparent($image_shadow,$bgcolor);
		//imagecopy($base_image,$image_shadow,0,0,0,0,$imgW,$imgH);
	}
	
	public static function getColorCodeImage($data,$errorCorrectionLevel, $matrixPointSize,$color){
		//返回指定颜色的二维码
		$color = QRimage::getColor($color);
		
		$frame = self::getFrame($data,$errorCorrectionLevel, $matrixPointSize);
		$pixelPerPoint = $matrixPointSize;
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w* $pixelPerPoint;
		$imgH = $h* $pixelPerPoint;
		$base_image = imagecreate($imgW,$imgH);
		imageantialias($base_image,true);
		$bg = imagecolorallocate($base_image,255,255,255);
		$color = imagecolorallocate($base_image,$color[0],$color[1],$color[2]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagefilledrectangle($base_image,($x)* $pixelPerPoint ,($y) * $pixelPerPoint,($x + 1 )* $pixelPerPoint,($y+ 1) * $pixelPerPoint,$color); 
				}
			}
		}
		imagecolortransparent($base_image,$bg);
		
		return $base_image;
	}
	
	public static function getFrame($data,$errorCorrectionLevel, $matrixPointSize){
		$enc = qrencode::factory($errorCorrectionLevel, $matrixPointSize, $margin = 1);
		return $enc->getFrame($data);
	}
	
	public static function getIcon($url){
		$im = @imagecreatefromjpeg($url);
		if(!$im){
			$im = @imagecreatefromgif($url);
			if(!$im){
				$im = @imagecreatefrompng($url);
				if(!$im){
					return imagecreatefromgif("resource/temp.gif");
				}
			}
		}
		return $im;
	}
	
	public static function getInitP($p,$width){
		//按指定宽度给段落文字添加换行符
		
		$length = mb_strlen($p,"utf-8");//字符串总长度
		$return_value = "";
		for($i = 0 ; $i < $length; $i += $width){
			$templength = $i + $width > $length?$length - $i:$width;
			$return_value = $return_value.mb_substr($p,$i,$templength,"utf-8")."\n";	

		}
		return $return_value;
	}
}
?>