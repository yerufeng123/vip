<?php
class Math{
	public $data;//数据
	//data包含内容：一个图形对象$base_image，一个二维码阵列对象$frame
	public $info;//信息
	public function __construct($_data,$_info){
		//构造函数
		$this->data = $_data;
		$this->info = $_info;
		//self::$info = $_info;
	}
	
	public function getShadowByColor($image,$col,$margin,$r,$color){//$r:阴影范围
		//tips：如果对背景颜色使用阴影，你就相当于是内阴影效果了
		$h = imagesy($image) + 2 * $margin;
		$w = imagesx($image) + 2 * $margin;
		
		$base_image = imagecreatetruecolor($w,$h);
		
		$bgc = imagecolorallocate($base_image,$color[0],$color[1],$color[2]);
		imagefill($base_image,0,0,$bgc);
		imagecolortransparent($base_image,$bgc);
		for($y = 0 ; $y < imagesy($image) ; $y ++){
			for($x = 0 ; $x < imagesx($image) ; $x ++){
				if(imagecolorat($image,$x,$y) != $col){
					//如果当前像素点的颜色不等于传入的颜色
					
					$dis = $r + 1;//最近距离
					for($cy = -$r; $cy <= $r; $cy ++){
						for($cx = -$r; $cx <= $r; $cx ++){
							if(imagecolorat($image,$cx + $x,$cy + $y) == $col){//表明附近有需要投影的物体
								$d = sqrt($cx * $cx + $cy * $cy); //与中心点的位置
								if($d <= $r && $d < $dis){
									$dis = $d;	//刷新最近距离
								}
							}
						}
					}
					if($dis <= $r){
						//如果附近有料	
						$dis = $dis / $r;//from 1 to 0
						$aaCol = imagecolorallocatealpha($base_image,0,0,0,127 - (1 - $dis) * 100);
						imagesetpixel($base_image, $x, $y, $aaCol);
					}
				}else{
					$aaCol = imagecolorallocatealpha($base_image,0,0,0,127 - 100);
					imagesetpixel($base_image, $x, $y, $aaCol);
				}
			}
		}
		
		return $base_image;
	}
	
	public function getShadowImage($frame,$pixelPerPoint,$margin,$r){//$r:阴影范围
		$h = count($frame);
		$w = strlen($frame[0]);	
		$imgW = $w * $pixelPerPoint + 2 * $margin;
		$imgH = $h * $pixelPerPoint + 2 * $margin;
		
		$base_image = imagecreatetruecolor($imgW,$imgH);
		
		$bgc = imagecolorallocate($base_image,255,255,255);
		$c = imagecolorallocate($base_image,0,0,0);
		
		imagefill($base_image,0,0,$bgc);
		
		for($y=0; $y < $h; $y++) {
			for($x=0; $x < $w; $x++) {
				if ($frame[$y][$x] == '1' ){
					imagefilledrectangle($base_image,$x * $pixelPerPoint + $margin,$y * $pixelPerPoint + $margin,($x + 1) * $pixelPerPoint + $margin - 1,($y + 1) * $pixelPerPoint + $margin - 1,$c);
				}
			}
		}
		
		$sw = imagesx($base_image);
		$sh = imagesy($base_image);
		
		
		for($y = $margin-$r ; $y < $sh - $margin + $r ; $y ++){
			for($x = $margin-$r ; $x < $sw  - $margin + $r; $x ++){
				if(imagecolorat($base_image,$x,$y) == $bgc){
					$dis = $r;//最近距离
					for($cy = -$r; $cy <= $r; $cy ++){
						for($cx = -$r; $cx <= $r; $cx ++){
							if(imagecolorat($base_image,$cx + $x,$cy + $y) == $c){
								$d = sqrt($cx * $cx + $cy * $cy); //与中心点的位置
								if($d <= $r && $d < $dis){
									$dis = $d;	
								}
							}
						}
					}
					$dis = $dis / $r;//from 1 to 0
					$rgb = imagecolorat($base_image, $x, $y);//获取当前点的背景色
					$rB = ($rgb >> 16) & 0xFF;
					$gB = ($rgb >> 8) & 0xFF;
					$bB = $rgb & 0xFF;
									
					$rComp = $rB * $dis; // mix Red
					$gComp = $gB * $dis; // mix Red
					$bComp = $gB * $dis; // mix Red
					$aaCol = imagecolorallocate($base_image, $rComp, $gComp, $bComp);
					imagesetpixel($base_image, $x, $y, $aaCol);
				}
			}
		}
		imagecolortransparent($base_image,$bgc);
		return $base_image;
	}
	
	public function getRotate45Image($frame,$pixelPerPoint,$margin,$color){
		$h = count($frame);
		$w = strlen($frame[0]);
		
		$imgW = 500;
		$imgH = 500;
		
		
		
		$base_image = imagecreate($imgW,$imgH);
		$bgc = imagecolorallocate($base_image,1,1,1);
		$c = QRimage::getColor($color);
		$c = imagecolorallocate($base_image,$c[0],$c[1],$c[2]);
		
		$cx = 100;
		$cy = 5;
		
		for($y=0; $y < $h; $y++) {
			for($x=0; $x < $w; $x++) {
				if ($frame[$y][$x] == '1' ){
					//进行坐标转换
					$rx = ($x - $y) * $pixelPerPoint;
					$ry = ($x + $y) * $pixelPerPoint;
					
					for($ty = -$pixelPerPoint; $ty <= $pixelPerPoint; $ty ++){
						for($tx = -$pixelPerPoint; $tx <= $pixelPerPoint; $tx ++){
							$abx = $tx < 0?-$tx:$tx;
							$aby = $ty < 0?-$ty:$ty;
							
							if($abx + $aby <= $pixelPerPoint - $margin){
								imagesetpixel($base_image,$rx + $cx + $tx,$ry + $cy + $ty,$c);
							}
						}
					}
				}else{

				}
			}
		}
		imagecolortransparent($base_image,$bgc);
		return $base_image;
	}
	
	public function getImage($frame,$pixelPerPoint,$type = 1,$outer){
		//对外暴露的函数，返回某个效果的二维码图片，默认渲染圆角内阴影
		
		$h = count($frame);
		$w = strlen($frame[0]);
		
		$base_image = imagecreate($w * $pixelPerPoint + $outer * 2,$h * $pixelPerPoint + $outer * 2);
		$bg = imagecolorallocate($base_image,255,255,255);
		$col = imagecolorallocate($base_image,0,0,0);

		if("1" == $this->info["ROUND"]){
			self::randerRound($base_image,$frame,$pixelPerPoint,$col);//渲染圆角效果
		}else{
			for($y=0; $y < $h; $y++) {
				for($x=0; $x < $w; $x++) {
					if ("1" == $frame[$y][$x]){
						self::drawBrick($base_image,$pixelPerPoint,$x,$y,$col);
					}
				}
			}
		}
		
		
		//消除一条异常线段
		imageline($base_image,0,$h * $pixelPerPoint,$w * $pixelPerPoint,$h * $pixelPerPoint,$bg);

		self::randerInnerShadow($base_image,$frame,$col,$pixelPerPoint,$outer);//渲染内阴影效果

		return $base_image;
	}

	private function randerInnerShadow($base_image,$frame,$col,$pixelPerPoint,$outer=50){
		$imgW = imagesx($base_image) + $outer;
		$imgH = imagesy($base_image) + $outer;
		$image_shadow = imagecreatetruecolor($imgW,$imgH);
		$image = imagecreate($imgW,$imgH);
		imagecolorallocate($image,255,255,255);//临时图
		
		$dis = $outer;
		
		imagecopy($image,$base_image,$dis,$dis,0,0,imagesx($base_image),imagesy($base_image));//将图像副本拷贝到临时图像中，向右下各偏移$dis个像素
		
		$c1 = QRimage::getColor($this->info["c1"]);
		$c2 = QRimage::getColor($this->info["c2"]);
		$bgcolor = imagecolorallocate($image_shadow,$c1[0],$c1[1],$c1[2]);
		$bgcolor2 = imagecolorallocate($image_shadow,$c2[0],$c2[1],$c2[2]);
		$bgc = imagecolorallocate($image,255,255,255);
		
		//$col = imagecolorallocate($image,0,0,0);
		
		$bgt = imagecolorallocate($base_image,255,255,255);
		
		//二维码主体颜色填充
		imagefilledrectangle($image_shadow,0,0,$imgW,$imgH,$bgcolor);
		
		
		$h = count($frame);
		$w = strlen($frame[0]);
		
		
		//三个角落的内阴影样式
		imagefilledrectangle($image_shadow,2 * $pixelPerPoint + $dis,2 * $pixelPerPoint + $dis,5 * $pixelPerPoint + $dis + 5,5 * $pixelPerPoint + $dis + 5,$bgcolor2);
		imagefilledrectangle($image_shadow,($w - 5) * $pixelPerPoint + $dis,2 * $pixelPerPoint + $dis,($w - 2)  * $pixelPerPoint + $dis + 5,5 * $pixelPerPoint + $dis + 5,$bgcolor2);
		imagefilledrectangle($image_shadow,2 * $pixelPerPoint + $dis,($h - 5) * $pixelPerPoint + $dis,5 * $pixelPerPoint + $dis + 5,($h - 2) * $pixelPerPoint + $dis + 5,$bgcolor2);
		
		
		
		
		for($y=0; $y < $h; $y++) {
			for($x=0; $x < $w; $x++) {
				if ($frame[$y][$x - 1] == '1' || $frame[$y][$x + 1] == '1' || $frame[$y - 1][$x] == '1' || $frame[$y + 1][$x] == '1'){
					
				}else{
					//如果是孤立点，填充一个方块
					imagefilledrectangle($image_shadow,$x * $pixelPerPoint + $dis + 2,$y * $pixelPerPoint + $dis + 2,($x + 1) * $pixelPerPoint + $dis+2,($y + 1) * $pixelPerPoint + $dis+2,$bgcolor2);
				}
			}
		}

		//阴影图形资源，固定宽高
		$imgS = imagecreatefrompng("resource/card/InnerS2.png");

		if("1" == $this->info["IS"]){
			
			for($y = 0 ; $y < $pixelPerPoint ; $y ++){
				for($x = 0 ; $x < $pixelPerPoint ; $x ++){
					//渲染一个格子的阴影。	
				}
			}
			
			for($y=0; $y < $imgH; $y++) {
				for($x=0; $x < $imgW; $x++) {
					if (imagecolorat($image,$x,$y) != $col){
						//如果该点像素的索引值与$col不相同，则开始下面的流程。
						imagecopy($image_shadow,$imgS,$x,$y,0,0,15,15);//把阴影素材复制到图片中
					}
				}
			}
		}

		imagefilledrectangle($base_image,0,0,imagesx($base_image),imagesy($base_image),$bgt);

		$back = imagecreatefrompng("resource/card/bg13.png");
		$bgccc = imagecolorallocatealpha($base_image,123,0,0,0);
		for($y=0; $y < $imgH; $y++) {
			for($x=0; $x < $imgW; $x++) {
				if (imagecolorat($image,$x,$y) == $col){
					//如果该点像素的索引值与$col不相同，则开始下面的流程。
					imagecopy($base_image,$image_shadow,$x,$y,$x + 2,$y + 2,1,1);//把背景（可能包含阴影）的图复制回来
				}else{
					//imagecopy($base_image,$back,$x,$y,$x,$y,1,1);
					//$c = imagecolorat($back,$x,$y);
					//imagesetpixel($base_image,$x,$y,$c);
				}
			}
		}
		//imagecolortransparent($base_image,$bgccc);
		
	}
	
	public function randerRoundSmooth($base_image,$frame,$pixelPerPoint,$c,$left=0,$top=0){//hasShadow：是否顺带渲染阴影
		$h = count($frame);
		$w = strlen($frame[0]);
		$color = imagecolorallocate($base_image,$c[0],$c[1],$c[2]);
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					//有码的情况，判断该格子是否符合左上||左下||右上||右下的情况，如果符合，则渲染该格子的四分之一为四分之一圆，否则渲染为四分之一个方块
					if($frame[$y][$x + 1] == '1'){
						//Right	
						self::drawBrickAtSmooth($base_image,$pixelPerPoint,$x,$y,1,$color,$left,$top);
					}else{
						self::smoothRound($base_image,($x + 0.5) * $pixelPerPoint + $left,($y + 0.5) * $pixelPerPoint + $top,$pixelPerPoint-1,$c,2);
					}
					if($frame[$y - 1][$x] == '1'){
						//Top
						self::drawBrickAtSmooth($base_image,$pixelPerPoint,$x,$y,2,$color,$left,$top);
					}else{
						self::smoothRound($base_image,($x + 0.5) * $pixelPerPoint + $left,($y + 0.5) * $pixelPerPoint + $top,$pixelPerPoint-1,$c,3);
					}
					if($frame[$y][$x - 1] == '1'){
						//Left
						self::drawBrickAtSmooth($base_image,$pixelPerPoint,$x,$y,3,$color,$left,$top);
					}else{
						self::smoothRound($base_image,($x + 0.5) * $pixelPerPoint + $left,($y + 0.5) * $pixelPerPoint + $top,$pixelPerPoint-1,$c,4);
					}
					if($frame[$y + 1][$x] == '1'){
						//Buttom	
						self::drawBrickAtSmooth($base_image,$pixelPerPoint,$x,$y,4,$color,$left,$top);
					}else{
						self::smoothRound($base_image,($x + 0.5) * $pixelPerPoint + $left,($y + 0.5) * $pixelPerPoint + $top,$pixelPerPoint-1,$c,1);
					}
				}else{
					//无码的情况，判断该格子是否符合左上||左下||右上||右下的情况，如果符合，则渲染该格子的四分之一为四分之一个圆的互补，否则神马也不做。
					
					if($frame[$y][$x - 1] == '1' && $frame[$y - 1][$x] == '1' && $frame[$y - 1][$x - 1] == '1'){
						//如果【左】和【上】两个情况都有问题	
						self::smoothAt($base_image,$pixelPerPoint,$x,$y,1,$c,$left,$top);
					}
					if($frame[$y][$x - 1] == '1' && $frame[$y + 1][$x] == '1' && $frame[$y + 1][$x - 1] == '1'){
						//如果【左】和【下】两个情况都有问题	
						self::smoothAt($base_image,$pixelPerPoint,$x,$y,2,$c,$left,$top);
					}
					if($frame[$y][$x + 1] == '1' && $frame[$y - 1][$x] == '1' && $frame[$y - 1][$x + 1] == '1'){
						//如果【右】和【上】两个情况都有问题	
						self::smoothAt($base_image,$pixelPerPoint,$x,$y,3,$c,$left,$top);
					}
					if($frame[$y][$x + 1] == '1' && $frame[$y + 1][$x] == '1' && $frame[$y + 1][$x + 1] == '1'){
						//如果【右】和【下】两个情况都有问题	
						self::smoothAt($base_image,$pixelPerPoint,$x,$y,4,$c,$left,$top);
					}
				}
			}
		}
	}
	
	private function randerRound($base_image,$frame,$pixelPerPoint,$col){
		//渲染圆角二维码。	
		$h = count($frame);
		$w = strlen($frame[0]);
		
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					//有码的情况，判断该格子是否符合左上||左下||右上||右下的情况，如果符合，则渲染该格子的四分之一为四分之一圆，否则渲染为四分之一个方块
					if($frame[$y][$x + 1] == '1'){
						//Right	
						self::drawBrickAt($base_image,$pixelPerPoint,$x,$y,1,$col);
					}else{
						self::drawRoundAt($base_image,$pixelPerPoint,$x,$y,1,$col);
					}
					if($frame[$y - 1][$x] == '1'){
						//Top
						self::drawBrickAt($base_image,$pixelPerPoint,$x,$y,2,$col);
					}else{
						self::drawRoundAt($base_image,$pixelPerPoint,$x,$y,2,$col);
					}
					if($frame[$y][$x - 1] == '1'){
						//Left
						self::drawBrickAt($base_image,$pixelPerPoint,$x,$y,3,$col);
					}else{
						self::drawRoundAt($base_image,$pixelPerPoint,$x,$y,3,$col);
					}
					if($frame[$y + 1][$x] == '1'){
						//Buttom	
						self::drawBrickAt($base_image,$pixelPerPoint,$x,$y,4,$col);
					}else{
						self::drawRoundAt($base_image,$pixelPerPoint,$x,$y,4,$col);
					}
				}else{
					//无码的情况，判断该格子是否符合左上||左下||右上||右下的情况，如果符合，则渲染该格子的四分之一为四分之一个圆的互补，否则神马也不做。
					
					if($frame[$y][$x - 1] == '1' && $frame[$y - 1][$x] == '1' && $frame[$y - 1][$x - 1] == '1'){
						//如果【左】和【上】两个情况都有问题	
						self::drawAt($base_image,$pixelPerPoint,$x,$y,1,$col);
					}
					if($frame[$y][$x - 1] == '1' && $frame[$y + 1][$x] == '1' && $frame[$y + 1][$x - 1] == '1'){
						//如果【左】和【下】两个情况都有问题	
						self::drawAt($base_image,$pixelPerPoint,$x,$y,2,$col);
					}
					if($frame[$y][$x + 1] == '1' && $frame[$y - 1][$x] == '1' && $frame[$y - 1][$x + 1] == '1'){
						//如果【右】和【上】两个情况都有问题	
						self::drawAt($base_image,$pixelPerPoint,$x,$y,3,$col);
					}
					if($frame[$y][$x + 1] == '1' && $frame[$y + 1][$x] == '1' && $frame[$y + 1][$x + 1] == '1'){
						//如果【右】和【下】两个情况都有问题	
						self::drawAt($base_image,$pixelPerPoint,$x,$y,4,$col);
					}
				}
			}
		}
	}

	private function drawBrick($base_image,$pixelPerPoint,$x,$y,$col){
		/************************绘制一个正方形方块******************************/
		$sx = $x * $pixelPerPoint;
		$sy = $y * $pixelPerPoint;
		$kx = ($x + 1) * $pixelPerPoint;
		$ky = ($y + 1) * $pixelPerPoint;
		imagefilledrectangle($base_image,$sx,$sy,$kx,$ky,$col);
		
	}
	
	private function drawBrickAtSmooth($base_image,$pixelPerPoint,$x,$y,$dir,$col,$left=0,$top=0){
		/************************绘制一个二分之一方块******************************/
		//$dir取值范围：1，2，3，4，分别对应【1.右】【2.上】【3.左】【4.下】
		$sx = $x * $pixelPerPoint + $left;
		$sy = $y * $pixelPerPoint + $top;
		$kx = 0 + $left;
		$ky = 0 + $top;
		switch($dir){
			case "1":
				$sx = $x * $pixelPerPoint + $pixelPerPoint / 2 + $left;
				$sy = $y * $pixelPerPoint + $top;
				$kx = $sx + floor(($pixelPerPoint - 1) / 2);
				$ky = $sy + floor($pixelPerPoint / 2) * 2 ;
				break;
			case "2":
				$sx = $x * $pixelPerPoint + $left;
				$sy = $y * $pixelPerPoint + $top;
				$kx = $sx + floor($pixelPerPoint / 2) * 2 ;
				$ky = $sy + floor(($pixelPerPoint - 1) / 2);
				break;
			case "3":
				$sx = $x * $pixelPerPoint + $left;
				$sy = $y * $pixelPerPoint + $top;
				$kx = $sx + floor(($pixelPerPoint - 1) / 2);
				$ky = $sy + floor($pixelPerPoint / 2) * 2 ;
				break;
			case "4":
				$sx = $x * $pixelPerPoint + $left;
				$sy = $y * $pixelPerPoint + $pixelPerPoint / 2 + $top;
				$kx = $sx + floor($pixelPerPoint / 2) * 2;
				$ky = $sy + floor(($pixelPerPoint - 1) / 2);
				break;
			default:
				break;	
		}
		imagefilledrectangle($base_image,$sx,$sy,$kx,$ky,$col);
	}
	
	private function drawBrickAt($base_image,$pixelPerPoint,$x,$y,$dir,$col){
		/************************绘制一个二分之一方块******************************/
		//$dir取值范围：1，2，3，4，分别对应【1.右】【2.上】【3.左】【4.下】
		$sx = $x * $pixelPerPoint;
		$sy = $y * $pixelPerPoint;
		$kx = 0;
		$ky = 0;
		switch($dir){
			case "1":
				$sx = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$sy = $y * $pixelPerPoint;
				$kx = $sx + $pixelPerPoint / 2;
				$ky = $sy + $pixelPerPoint;
				break;
			case "2":
				$sx = $x * $pixelPerPoint;
				$sy = $y * $pixelPerPoint;
				$kx = $sx + $pixelPerPoint;
				$ky = $sy + $pixelPerPoint / 2;
				break;
			case "3":
				$sx = $x * $pixelPerPoint;
				$sy = $y * $pixelPerPoint;
				$kx = $sx + $pixelPerPoint / 2;
				$ky = $sy + $pixelPerPoint;
				break;
			case "4":
				$sx = $x * $pixelPerPoint;
				$sy = $y * $pixelPerPoint + $pixelPerPoint / 2;
				$kx = $sx + $pixelPerPoint;
				$ky = $sy + $pixelPerPoint / 2;
				break;
			default:
				break;	
		}
		imagefilledrectangle($base_image,$sx,$sy,$kx,$ky,$col);
	}		
	
	private function drawRound($base_image,$pixelPerPoint,$x,$y,$col){
		/***********************绘制一整个圆形******************************/
		$w = $pixelPerPoint;
		$h = $pixelPerPoint;
		imagefilledarc($base_image,$x * $pixelPerPoint + $pixelPerPoint / 2,$y * $pixelPerPoint + $pixelPerPoint / 2,$w,$h,0,360,$col,IMG_ARC_PIE);
	}
	private function drawRoundAt($base_image,$pixelPerPoint,$x,$y,$dir,$col){
		/************************绘制一个半圆形******************************/
		//$dir取值范围：1，2，3，4，分别对应【1.右】【2.上】【3.左】【4.下】
		$w = $pixelPerPoint;
		$h = $pixelPerPoint;
		$start = 0;
		switch($dir){
			case "1":
				$start = 270;
				break;
			case "2":
				$start = 180;
				break;
			case "3":
				$start = 90;
				break;
			case "4":
				$start = 0;
				break;
			default:
				break;	
		}
		imagefilledarc($base_image,$x * $pixelPerPoint + $pixelPerPoint / 2,$y * $pixelPerPoint + $pixelPerPoint / 2,$w,$h,$start,$start + 180,$col,IMG_ARC_PIE);
	}		
	private function smoothRoundAt($base_image,$pixelPerPoint,$x,$y,$dir,$col){
		/************************绘制一个半圆形******************************/
		//$dir取值范围：1，2，3，4，分别对应【1.右】【2.上】【3.左】【4.下】
		$w = $pixelPerPoint;
		$h = $pixelPerPoint;
		$start = 0;
		switch($dir){
			case "1":
				$start = 270;
				break;
			case "2":
				$start = 180;
				break;
			case "3":
				$start = 90;
				break;
			case "4":
				$start = 0;
				break;
			default:
				break;	
		}
		imagefilledarc($base_image,$x * $pixelPerPoint + $pixelPerPoint / 2,$y * $pixelPerPoint + $pixelPerPoint / 2,$w,$h,$start,$start + 180,$col,IMG_ARC_PIE);
	}
	
	private function smoothAt($base_image,$pixelPerPoint,$x,$y,$dir,$col,$left=0,$top=0){


		$startX =  - $pixelPerPoint / 2;
		$startY =  - $pixelPerPoint / 2;
		$endX =  $pixelPerPoint / 2;
		$endY =  $pixelPerPoint / 2;
		$s = 0.6;
		$cx = ($x + 0.5 ) * $pixelPerPoint + $left;
		$cy = ($y + 0.5 ) * $pixelPerPoint + $top;
		
		switch($dir){
			case 0:
				break;
			case 1:
				$startX =  - floor(($pixelPerPoint + 1) / 2);
				$startY =  - floor(($pixelPerPoint + 1) / 2);
				$endX =  0;
				$endY =  0;
				break;
			case 2:
				
				$startX =  - floor(($pixelPerPoint + 1) / 2);
				$startY =  0;
				$endX =  0;
				$endY =  floor(($pixelPerPoint + 1) / 2);
				break;
			case 3:
				$startX =  0;
				$startY =  - floor(($pixelPerPoint + 1) / 2);
				$endX =  floor(($pixelPerPoint + 1) / 2);
				$endY =  0;
				break;
			case 4:
				$startX =  0;
				$startY =  0;
				$endX =  floor(($pixelPerPoint + 1) / 2);
				$endY =  floor(($pixelPerPoint + 1) / 2);
				break;
			default:break;	
		}

		
		for($curX = $startX; $curX <= $endX; $curX++)
		{
			for($curY = $startY; $curY <= $endY; $curY++)
			{
				$distance = sqrt(pow($curX,2) + pow($curY,2));
				$temp = $distance - $pixelPerPoint / 2;		//d-r
				
				if($temp < -$s)
				{
					//无色，什么都不用做
				}
				else if($temp >= $s)
				{
					//填col色
					//$aaCol = $sCol;
					$sCol = imagecolorallocate($base_image, $col[0], $col[1], $col[2]);
					imagesetpixel($base_image, $curX + $cx, $curY + $cy, $sCol);
				}
				else
				{
					//填过渡色					
					$rgb = imagecolorat($base_image, $curX + $cx, $curY + $cy); // Get current background color
					$rB = ($rgb >> 16) & 0xFF;
					$gB = ($rgb >> 8) & 0xFF;
					$bB = $rgb & 0xFF;
					$range = $s * 2;
					$value = $temp + $s;
					$per = $value / $range;
						
					$rDelta = ($rB - $col[0]); // change in Red from background
					$rComp = $rB - $rDelta * $per; // mix Red
					$gDelta = ($gB - $col[1]); // change in Red from background
					$gComp = $gB - $gDelta * $per; // mix Red
					$bDelta = ($bB - $col[2]); // change in Red from background
					$bComp = $bB - $bDelta * $per; // mix Red
					$aaCol = imagecolorallocate($base_image, $rComp, $gComp, $bComp);
					imagesetpixel($base_image, $curX + $cx, $curY + $cy, $aaCol);
				}
			}
		}
	}
	
	private function drawAt($base_image,$pixelPerPoint,$x,$y,$dir,$col){
		/************************绘制一个四分之一圆形互补图形******************************/
		//$dir取值范围：1，2，3，4，分别对应【1.左上】【2.左下】【3.右上】【4.右下】
		$w = $pixelPerPoint;
		$h = $pixelPerPoint;
		
		$p;
		$p1;
		$p2;
		$px;
		
		$start = 0;
		switch($dir){
			case "1":
				$start = 180;
				$p["x"] = $x * $pixelPerPoint;
				$p["y"] = $y * $pixelPerPoint;
				$p1["x"] = $x * $pixelPerPoint;
				$p1["y"] = $y * $pixelPerPoint + $pixelPerPoint / 2;
				$p2["x"] = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$p2["y"] = $y * $pixelPerPoint;
				$px["x"] = $p["x"] + 1;
				$px["y"] = $p["y"] + 1;
				break;
			case "2":
				$start = 90;
				$p["x"] = $x * $pixelPerPoint;
				$p["y"] = $y * $pixelPerPoint + $pixelPerPoint;
				$p1["x"] = $x * $pixelPerPoint;
				$p1["y"] = $y * $pixelPerPoint + $pixelPerPoint / 2;
				$p2["x"] = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$p2["y"] = $y * $pixelPerPoint + $pixelPerPoint;
				$px["x"] = $p["x"] + 1;
				$px["y"] = $p["y"] - 1;
				break;
			case "4":
				$start = 0;
				$p["x"] = $x * $pixelPerPoint + $pixelPerPoint;
				$p["y"] = $y * $pixelPerPoint + $pixelPerPoint;
				$p1["x"] = $x * $pixelPerPoint + $pixelPerPoint;
				$p1["y"] = $y * $pixelPerPoint + $pixelPerPoint / 2;
				$p2["x"] = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$p2["y"] = $y * $pixelPerPoint + $pixelPerPoint;
				$px["x"] = $p["x"] - 1;
				$px["y"] = $p["y"] - 1;
				break;
			case "3":
				$start = 270;
				$p["x"] = $x * $pixelPerPoint + $pixelPerPoint;
				$p["y"] = $y * $pixelPerPoint;
				$p1["x"] = $x * $pixelPerPoint + $pixelPerPoint;
				$p1["y"] = $y * $pixelPerPoint + $pixelPerPoint / 2;
				$p2["x"] = $x * $pixelPerPoint + $pixelPerPoint / 2;
				$p2["y"] = $y * $pixelPerPoint;
				$px["x"] = $p["x"] - 1;
				$px["y"] = $p["y"] + 1;
				break;
			default:
				break;	
		}
		//draw line1
		imageline($base_image,$p["x"],$p["y"],$p1["x"],$p1["y"],$col);
		//draw line2
		imageline($base_image,$p["x"],$p["y"],$p2["x"],$p2["y"],$col);
		//draw pie
		imagefilledarc($base_image,$x * $pixelPerPoint + $pixelPerPoint / 2,$y * $pixelPerPoint + $pixelPerPoint / 2,$w,$h,$start,$start + 90,$col,IMG_ARC_NOFILL);
		//fill to border
		imagefilltoborder($base_image,$px["x"],$px["y"],$col,$col);
	}	
	private function judge($x,$y){
		/************************私有函数，不对外******************************/
		
		
	}
	
	public function smoothRound($img,$cx,$cy,$w,$color,$dir = 0){
		//参数简化的圆形绘制函数
		$r = 0;
		$s = 1;
		$t = 1;
		$adj = $w + $s;
		$sCol = imagecolorallocate($img, $color[0], $color[1], $color[2]);
		
		$startX = -$r - $adj;
		$startY = -$r - $adj;
		$endX = $r + $adj;
		$endY = $r + $adj;
		
		switch($dir){
			case 0:
				break;
			case 1:
				$startX = 0;
				$startY = 0;
				break;
			case 2:
				$startX = 0;
				$endY = 0;
				break;
			case 3:
				$endX = 0;
				$endY = 0;
				break;
			case 4:
				$endX = 0;
				$startY = 0;
				break;
			case 5:
				$startY = 0;
				break;
			case 6:
				$endY = 0;
				break;
			case 7:
				$startX = 0;
				break;
			case 8:
				$endX = 0;
				break;
			default:break;	
		}
		
		for($x = $startX; $x <= $endX; $x++)
		{
			for($y = $startY; $y <= $endY; $y++)
			{
				$d = sqrt($x * $x + $y * $y); // distance from pixel to center
				$err = abs($d - $r); // absolute distance from pixel to circle edge
				if($err < $w / 2 + $s) // within the stroke width + smoothing radius
				{
					if($err < $w / 2) // inside the stroke width so make it solid color
					{
						$aaCol = $sCol;
					}
					else // in the antialisaing region so make it a blended color
					{
						$err -= $w / 2; // adjust to the aliased part
						$err = 1 - $err / $s; // adjust to between 0 and 1
						$err = ($err - 0.5) * $t * 2; // adjust to -$t to +$t for tightness 
						$err = ($err / sqrt(1 + $err * $err) + 1) / 2; // sigmoid curve to smooth edges
						$rgb = imagecolorat($img, $x + $cx, $y + $cy); // Get current background color
						$rB = ($rgb >> 16) & 0xFF;
						$gB = ($rgb >> 8) & 0xFF;
						$bB = $rgb & 0xFF;
						$rDelta = ($rB - $color[0]); // change in Red from background
						$rComp = $rB - $rDelta * $err; // mix Red
						$gDelta = ($gB - $color[1]); // change in Red from background
						$gComp = $gB - $gDelta * $err; // mix Red
						$bDelta = ($bB - $color[2]); // change in Red from background
						$bComp = $bB - $bDelta * $err; // mix Red
						$aaCol = imagecolorallocate($img, $rComp, $gComp, $bComp);
					}
					imagesetpixel($img, $x + $cx, $y + $cy, $aaCol);
				}
			}
		}
	}
	
	public function imagecircleaa($img, $cx, $cy, $r, $w, $s, $t, $color) // image, centerX, centerY, radius, stroke width, aa width, tightness, color
	{
		$adj = $w + $s;
		$sCol = imagecolorallocate($img, $color[0], $color[1], $color[2]);
		for($x = -$r - $adj; $x <= $r + $adj; $x++)
		{
			for($y = -$r - $adj; $y <= $r + $adj; $y++)
			{
				$d = sqrt($x * $x + $y * $y); // distance from pixel to center
				$err = abs($d - $r); // absolute distance from pixel to circle edge
				if($err <= $w / 2 + $s) // within the stroke width + smoothing radius
				{
					if($err <= $w / 2) // inside the stroke width so make it solid color
					{
						$aaCol = $sCol;
					}
					else // in the antialisaing region so make it a blended color
					{
						$err -= $w / 2; // adjust to the aliased part
						$err = 1 - $err / $s; // adjust to between 0 and 1
						$err = ($err - 0.5) * $t * 2; // adjust to -$t to +$t for tightness 
						$err = ($err / sqrt(1 + $err * $err) + 1) / 2; // sigmoid curve to smooth edges
						$rgb = imagecolorat($img, $x + $cx, $y + $cy); // Get current background color
						$rB = ($rgb >> 16) & 0xFF;
						$gB = ($rgb >> 8) & 0xFF;
						$bB = $rgb & 0xFF;
						$rDelta = ($rB - $color[0]); // change in Red from background
						$rComp = $rB - $rDelta * $err; // mix Red
						$gDelta = ($gB - $color[1]); // change in Red from background
						$gComp = $gB - $gDelta * $err; // mix Red
						$bDelta = ($bB - $color[2]); // change in Red from background
						$bComp = $bB - $bDelta * $err; // mix Red
						$aaCol = imagecolorallocate($img, $rComp, $gComp, $bComp);
					}
					imagesetpixel($img, $x + $cx, $y + $cy, $aaCol);
				}
			}
		}
	}
	
	public function imagecircleaaa($img, $cx, $cy, $r, $w, $s, $t, $color,$trans) // image, centerX, centerY, radius, stroke width, aa width, tightness, color
	{
		$adj = $w + $s;
		$sCol = imagecolorallocatealpha($img, $color[0], $color[1], $color[2],$trans);
		for($x = -$r - $adj; $x <= $r + $adj; $x++)
		{
			for($y = -$r - $adj; $y <= $r + $adj; $y++)
			{
				$d = sqrt($x * $x + $y * $y); // distance from pixel to center
				$err = abs($d - $r); // absolute distance from pixel to circle edge
				if($err <= $w / 2 + $s) // within the stroke width + smoothing radius
				{
					if($err <= $w / 2) // inside the stroke width so make it solid color
					{
						$aaCol = $sCol;
					}
					else // in the antialisaing region so make it a blended color
					{
						$err -= $w / 2; // adjust to the aliased part
						$err = 1 - $err / $s; // adjust to between 0 and 1
						$err = ($err - 0.5) * $t * 2; // adjust to -$t to +$t for tightness 
						$err = ($err / sqrt(1 + $err * $err) + 1) / 2; // sigmoid curve to smooth edges
						$rgb = imagecolorat($img, $x + $cx, $y + $cy); // Get current background color
						$rB = ($rgb >> 16) & 0xFF;
						$gB = ($rgb >> 8) & 0xFF;
						$bB = $rgb & 0xFF;
						$rDelta = ($rB - $color[0]); // change in Red from background
						$rComp = $rB - $rDelta * $err; // mix Red
						$gDelta = ($gB - $color[1]); // change in Red from background
						$gComp = $gB - $gDelta * $err; // mix Red
						$bDelta = ($bB - $color[2]); // change in Red from background
						$bComp = $bB - $bDelta * $err; // mix Red
						$aaCol = imagecolorallocatealpha($img, $rComp, $gComp, $bComp,$trans);
					}
					imagesetpixel($img, $x + $cx, $y + $cy, $aaCol);
				}
			}
		}
	}
	
}


?>