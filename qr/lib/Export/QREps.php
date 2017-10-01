<?php
define('QR_EPS', true);
class QREps{	
	public static function EPSHead($width,$height,$pixelPerPoint = 4,$left=4,$top=4){
        $output = 
            '%!PS-Adobe EPSF-3.0'." \n".
            '%%Creator: 2weima.com'." \n".
            '%%Title: QR'." \n".
            '%%CreationDate: '.date('Y-m-d')." \n".
            '%%DocumentData: ok'." \n".
            '%%LanguageLevel: 2'." \n".
            '%%Pages: 1'." \n".
            '%%BoundingBox: 0 0 '.$width.' '.$height." \n";
            
        // set the scale
        $output .= $pixelPerPoint.' '.$pixelPerPoint.' scale'." \n";
        // position the center of the coordinate system
            
        $output .= $left.' '.$top.' translate'." \n";
		
        // redefine the 'rectfill' operator to shorten the syntax
        $output .= '/F { rectfill } def'." \n";
		
		return $output;
	}
	
	
	//绘制正方形
	public static function Square($x,$y,$r,$color,$mode,$type = 'fill'){
		/*
		**$x,$y:圆心坐标
		**$r:圆半径
		**$color:颜色
		**$mode:模式（cmyk or rgb）
		**$type:种类（fill or stroke）
		*/
		$output = '';
		$output .= self::getColorStr($color,$mode);
		$output .= ($x - $r).' '.($y - $r).' moveto'." \n";		//移动到左上角
		$output .= ($x + $r).' '.($y - $r).' lineto'." \n";
		$output .= ($x + $r).' '.($y + $r).' lineto'." \n";
		$output .= ($x - $r).' '.($y + $r).' lineto'." \n";
		$output .= 'closepath'." \n";
		$output .= $type.''." \n";
		
		return $output;
	}
	
	//绘制矩形
	public static function Rectangle($sx,$sy,$kx,$ky,$color,$mode,$type = 'fill'){
		/*
		**$x,$y:圆心坐标
		**$r:圆半径
		**$color:颜色
		**$mode:模式（cmyk or rgb）
		**$type:种类（fill or stroke）
		*/
		$output = '';
		$output .= self::getColorStr($color,$mode);
		$output .= ($x - $r).' '.($y - $r).' moveto'." \n";		//移动到左上角
		$output .= ($x + $r).' '.($y - $r).' lineto'." \n";
		$output .= ($x + $r).' '.($y + $r).' lineto'." \n";
		$output .= ($x - $r).' '.($y + $r).' lineto'." \n";
		$output .= 'closepath'." \n";
		$output .= $type.''." \n";
		imagefilledrectangle($base_image,$sx,$sy,$kx,$ky,$col);
		return $output;
	}
	
	public static function RoundRectangle($x,$y,$w,$h,$r,$color,$mode,$type = 'fill'){
		/*
		**$x,$y:中心坐标
		**$w,$h:方块的宽高
		**$r:圆角半径
		**$color:颜色
		**$mode:模式（cmyk or rgb）
		**$type:种类（fill or stroke）
		*/
		$output = '';
		$output .= self::getColorStr($color,$mode);

		$output .= ($x - $w / 2 + $r).' '.($y - $h / 2 + $r).' '.$r.' 180 270 arc'." \n";		//绘制圆的函数
		$output .= ($x + $w / 2 - $r).' '.($y - $h / 2).' lineto'." \n";
		
		$output .= ($x + $w / 2 - $r).' '.($y - $h / 2 + $r).' '.$r.' 270 360 arc'." \n";		//绘制圆的函数
		$output .= ($x + $w / 2).' '.($y + $h / 2 - $r).' lineto'." \n";
		
		$output .= ($x + $w / 2 - $r).' '.($y + $h / 2 - $r).' '.$r.' 0 90 arc'." \n";		//绘制圆的函数
		$output .= ($x - $w / 2 + $r).' '.($y + $h / 2).' lineto'." \n";
		
		$output .= ($x - $w / 2 + $r).' '.($y + $h / 2 - $r).' '.$r.' 90 180 arc'." \n";		//绘制圆的函数
		$output .= ($x - $w / 2).' '.($y - $h / 2 + $r).' lineto'." \n";
		
		$output .= $type.''." \n";
		
		return $output;
	}
	
	//绘制圆形
	public static function Round($x,$y,$r,$color,$mode,$type = 'fill'){
		/*
		**$x,$y:圆心坐标
		**$r:圆半径
		**$color:颜色
		**$mode:模式（cmyk or rgb）
		**$type:种类（fill or stroke）
		*/
		$output = '';
		$output .= self::getColorStr($color,$mode);
		$output .= $x.' '.$y.' '.$r.' 0 360 arc'." \n";		//绘制圆的函数
		$output .= $type.''." \n";
		
		return $output;
	}
	
	public static function randerRoundSmooth($frame,$pixelPerPoint,$r,$color,$mode,$type = 'fill'){
		$output = '';
		$output .= self::getColorStr($color,$mode);
		$h = count($frame);
		$w = strlen($frame[0]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$x][$y] == '1'){
					//有码的情况
					//move to 
					$cx = $x * $pixelPerPoint;
					$cy = $y * $pixelPerPoint + $pixelPerPoint / 2;
					$output .= $cx.' '.$cy.' moveto'." \n";			//移动到起始位置
					if(($frame[$x - 1][$y] == '1' || $frame[$x][$y - 1] == '1') || ($frame[$x - 1][$y - 1] == '1')){
						//写直角	
						$output .= self::drawRightAngle($x,$y,$pixelPerPoint,0);
					}else{
						//写圆角
						$output .= self::drawRoundBrick($x,$y,$pixelPerPoint,$r,0);
					}
					
					if(($frame[$x][$y - 1] == '1' || $frame[$x + 1][$y] == '1') || ($frame[$x + 1][$y - 1] == '1')){
						//写直角	
						$output .= self::drawRightAngle($x,$y,$pixelPerPoint,1);
					}else{
						//写圆角
						$output .= self::drawRoundBrick($x,$y,$pixelPerPoint,$r,1);
					}
					
					if(($frame[$x][$y + 1] == '1' || $frame[$x + 1][$y] == '1') || ($frame[$x + 1][$y + 1] == '1')){
						//写直角	
						$output .= self::drawRightAngle($x,$y,$pixelPerPoint,2);
					}else{
						//写圆角
						$output .= self::drawRoundBrick($x,$y,$pixelPerPoint,$r,2);
					}

					if(($frame[$x][$y + 1] == '1' || $frame[$x - 1][$y] == '1') || ($frame[$x - 1][$y + 1] == '1')){
						//写直角	
						$output .= self::drawRightAngle($x,$y,$pixelPerPoint,3);
					}else{
						//写圆角
						$output .= self::drawRoundBrick($x,$y,$pixelPerPoint,$r,3);
					}

					$output .= $type.''." \n";
				}else{
					//无码的情况
					if($frame[$x][$y - 1] == '1' && $frame[$x - 1][$y] == '1'){
						$output .= self::fillRound($x,$y,$pixelPerPoint,$r,0,$type);
					}
					if($frame[$x][$y + 1] == '1' && $frame[$x - 1][$y] == '1'){
						$output .= self::fillRound($x,$y,$pixelPerPoint,$r,3,$type);
					}
					if($frame[$x][$y + 1] == '1' && $frame[$x + 1][$y] == '1'){
						$output .= self::fillRound($x,$y,$pixelPerPoint,$r,2,$type);
					}
					if($frame[$x][$y - 1] == '1' && $frame[$x + 1][$y] == '1'){
						$output .= self::fillRound($x,$y,$pixelPerPoint,$r,1,$type);
					}
				}
			}
		}
		return $output;
	}
	
	private static function fillRound($x,$y,$pixelPerPoint,$r,$dir,$type){
		$output = '';
		switch($dir){
			case 0:
				$cx = $x * $pixelPerPoint + $r;
				$cy = $y * $pixelPerPoint + $r;
				$output .= $cx.' '.$cy.' '.$r.' 180 270 arc'." \n";		//绘制圆的函数
				$cx = $x * $pixelPerPoint;
				$cy = $y * $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$output .= 'closepath'." \n";
				$output .= $type.''." \n";
				break;
			case 1:
				$cx = $x * $pixelPerPoint + $pixelPerPoint - $r;
				$cy = $y * $pixelPerPoint + $r;
				$output .= $cx.' '.$cy.' '.$r.' 270 360 arc'." \n";		//绘制圆的函数
				$cx = $x * $pixelPerPoint + $pixelPerPoint;
				$cy = $y * $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$output .= 'closepath'." \n";
				$output .= $type.''." \n";
				break;
			case 2:
				$cx = $x * $pixelPerPoint + $pixelPerPoint - $r;
				$cy = $y * $pixelPerPoint + $pixelPerPoint - $r;
				$output .= $cx.' '.$cy.' '.$r.' 0 90 arc'." \n";		//绘制圆的函数
				$cx = $x * $pixelPerPoint + $pixelPerPoint;
				$cy = $y * $pixelPerPoint + $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$output .= 'closepath'." \n";
				$output .= $type.''." \n";
				break;
			case 3:
				$cx = $x * $pixelPerPoint + $r;
				$cy = $y * $pixelPerPoint + $pixelPerPoint - $r;
				$output .= $cx.' '.$cy.' '.$r.' 90 180 arc'." \n";		//绘制圆的函数
				$cx = $x * $pixelPerPoint;
				$cy = $y * $pixelPerPoint + $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$output .= 'closepath'." \n";
				$output .= $type.''." \n";
				break;
			default:
			break;	
		}
		return $output;
	}
	
	private static function drawRoundBrick($x,$y,$pixelPerPoint,$r,$dir){
		$output = '';
		switch($dir){
			case 0:
				$cx = $x * $pixelPerPoint;
				$cy = $y * $pixelPerPoint + $r;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$cx = $x * $pixelPerPoint + $r;
				$cy = $y * $pixelPerPoint + $r;
				$output .= $cx.' '.$cy.' '.$r.' 180 270 arc'." \n";		//绘制圆的函数
				$cx = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$cy = $y * $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				break;
			case 1:
				$cx = $x * $pixelPerPoint + $pixelPerPoint - $r;
				$cy = $y * $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$cx = $x * $pixelPerPoint + $pixelPerPoint - $r;
				$cy = $y * $pixelPerPoint + $r;
				$output .= $cx.' '.$cy.' '.$r.' 270 360 arc'." \n";		//绘制圆的函数
				$cx = $x * $pixelPerPoint + $pixelPerPoint;
				$cy = $y * $pixelPerPoint + $pixelPerPoint / 2;
				$output .= $cx.' '.$cy.' lineto'." \n";
				break;
			case 2:
				$cx = $x * $pixelPerPoint + $pixelPerPoint;
				$cy = $y * $pixelPerPoint + $pixelPerPoint - $r;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$cx = $x * $pixelPerPoint + $pixelPerPoint - $r;
				$cy = $y * $pixelPerPoint + $pixelPerPoint - $r;
				$output .= $cx.' '.$cy.' '.$r.' 0 90 arc'." \n";		//绘制圆的函数
				$cx = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$cy = $y * $pixelPerPoint + $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				break;
			case 3:
				$cx = $x * $pixelPerPoint + $r;
				$cy = $y * $pixelPerPoint + $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$cx = $x * $pixelPerPoint + $r;
				$cy = $y * $pixelPerPoint + $pixelPerPoint - $r;
				$output .= $cx.' '.$cy.' '.$r.' 90 180 arc'." \n";		//绘制圆的函数
				$cx = $x * $pixelPerPoint;
				$output .= 'closepath'." \n";
				break;
			default:
			break;	
		}
		
		return $output;
	}
	
	private static function drawRightAngle($x,$y,$pixelPerPoint,$dir){
		$output = '';
		switch($dir){
			case 0:
				$cx = $x * $pixelPerPoint;
				$cy = $y * $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$cx = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$output .= $cx.' '.$cy.' lineto'." \n";
				break;
			case 1:
				$cx = $x * $pixelPerPoint + $pixelPerPoint;
				$cy = $y * $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$cy = $y * $pixelPerPoint + $pixelPerPoint / 2;
				$output .= $cx.' '.$cy.' lineto'." \n";
				break;
			case 2:
				$cx = $x * $pixelPerPoint + $pixelPerPoint;
				$cy = $y * $pixelPerPoint + $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$cx = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$output .= $cx.' '.$cy.' lineto'." \n";
				break;
			case 3:
				$cx = $x * $pixelPerPoint;
				$cy = $y * $pixelPerPoint + $pixelPerPoint;
				$output .= $cx.' '.$cy.' lineto'." \n";
				$output .= 'closepath'." \n";
				break;
			default:
			break;	
		}
		return $output;
	}

	
	//拼合颜色字符串
	public static function getColorStr($color,$mode){
		$colorStr = '';
		if($mode == 'cmyk'){
			//cmyk颜色空间
			$c = $color[0];
			$m = $color[1];
			$y = $color[2];
			$k = $color[3];
			$colorStr = $c.' '.$m.' '.$y.' '.$k.' setcmykcolor'." \n";
		}else if($mode == 'rgb'){
			//rgb颜色空间
			$r = $color[0];
			$g = $color[1];
			$b = $color[2];
			$colorStr = $r.' '.$g.' '.$b.' setrgbcolor'." \n";	
		}
		return $colorStr;
	}
}