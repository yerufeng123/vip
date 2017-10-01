<?php
/*
*	Type类：基类，作为Card、Logo、Normal等类的父类
*
*/

class Type{
	public $Parameter;					//参数
	public $errorCorrectionLevel;		//纠错等级
	public $Config;						//Config参数集合
	public $l;							//左（右）边距
	public $t;							//上（下）边距
	public $pixelPerPoint;				//尺寸
	public $Stype;						//子类型

	public function __construct($Parameter){
		//构造函数
		$this->Parameter = $Parameter;

		$this->Config = Base::getConfig($this->Parameter["Config"]);							//格式化Config参数
		$this->errorCorrectionLevel = $this->Config["LEVEL"]?$this->Config["LEVEL"]:0;			//容错等级，默认为0
		$this->pixelPerPoint = $this->Config["SIZE"]?$this->Config["SIZE"]:5;					//码的大小，默认为5				
		$this->l = $this->Config["LEFT"]?$this->Config["LEFT"]:5;
		$this->t = $this->Config["TOP"]?$this->Config["TOP"]:5;
	}
	
	public function getImage(){
		
		///////////////////////////////////////////////////////////
		$frame = Base::getFrame($this->Parameter["Data"],$this->errorCorrectionLevel);
		$h = count($frame);
		$w = strlen($frame[0]);
		$pixelPerPoint = $this->Config["SIZE"]?$this->Config["SIZE"]:5;
		$imgW = $w * $this->pixelPerPoint+ $this->l * 2;
		$imgH = $h * $this->pixelPerPoint + $this->t * 2;
		$base_image = imagecreatetruecolor($imgW, $imgH);
		$bgc = Base::getColor("#".$this->Config["BGC"]);
		$bgc = imagecolorallocate($base_image,$bgc[0],$bgc[1],$bgc[2]);
		//imagefill($base_image,0,0,$bgc);
		///////////////////////////////////////////////////////////
		
		$c = Base::getColor("#".$this->Config["C"]);
		$col = imagecolorallocate($base_image,$c[0],$c[1],$c[2]);
		
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagefilledrectangle($base_image,($x)* $this->pixelPerPoint + $this->l,($y) * $this->pixelPerPoint + $this->t,($x + 1 )* $this->pixelPerPoint + $this->l,($y+ 1) * $this->pixelPerPoint + $this->t,$col); 
				}
			}
		}
		
		return $base_image;
	}
	
	function fillShadow($base_image,$x,$y,$l,$t,$c){
		imagefilledrectangle($base_image,($x)* $this->pixelPerPoint + $this->l + $l,($y) * $this->pixelPerPoint + $this->t + $t,($x + 1 )* $this->pixelPerPoint + $this->l + $l - 1,($y+ 1) * $this->pixelPerPoint + $this->t + $t - 1,$c); 
	}
	
	function fill($base_image,$x,$y,$c){
		self::fillShadow($base_image,$x,$y,0,0,$c);
	}
	
	function gradient($base_image,$frame,$pixelPerPoint,$c1,$c2,$left,$top,$dir=1){
		//返回一个渐变色二维码阵列
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w * $pixelPerPoint;
		$imgH = $h * $pixelPerPoint;
		$c11 = imagecolorallocate($base_image,$c1[0],$c1[1],$c1[2]);
		
		$colArr = Array();
		
		//横向渐变数组
		if(1 == $dir || 3 == $dir){
			for($index = 0 ; $index < $imgW ; $index ++){
				$colArr[$index] = self::getColorByPixel($base_image,0,$index,$c1,$c2);
			}
		}else if(2 == $dir || 4 == $dir){
			for($index = 0 ; $index < $imgH ; $index ++){
				$colArr[$index] = self::getColorByPixel($base_image,0,$index,$c1,$c2);
			}
		}
		
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1') {
					if(1 == $dir || 3 == $dir){
						for($sx = $x * $pixelPerPoint; $sx < ($x + 1) * $pixelPerPoint; $sx ++){
							for($sy = $y * $pixelPerPoint; $sy < ($y + 1) * $pixelPerPoint; $sy ++){
								imagesetpixel($base_image, $sx + $left, $sy + $top, $colArr[$sx]);
							}
						}
					}else{
						for($sy = $y * $pixelPerPoint; $sy < ($y + 1) * $pixelPerPoint; $sy ++){
							for($sx = $x * $pixelPerPoint; $sx < ($x + 1) * $pixelPerPoint; $sx ++){
								imagesetpixel($base_image, $sx + $left, $sy + $top, $colArr[$sy]);
							}
						}
					}
				}
			}
		}
	}
	
	
	function getShadow($frame,$pixelPerPoint,$left,$top){
		//返回3像素的阴影图
		$h = count($frame);
		$w = strlen($frame[0]);
		$imgW = $w * $pixelPerPoint + $left * 2;
		$imgH = $h * $pixelPerPoint + $top * 2;
		$base_image = imagecreatetruecolor($imgW,$imgH);
		$bgc = imagecolorallocatealpha($base_image,255,255,255,127);
		imagefill($base_image,0,0,$bgc);
		$c1 = imagecolorallocatealpha($base_image,33,33,33,0);
		$c2 = imagecolorallocatealpha($base_image,66,66,66,0);
		$c3 = imagecolorallocatealpha($base_image,99,99,99,0);
		$imgS = imagecreatefrompng("resource/InnerS.png");
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1') {
					for($ty = 0 ; $ty < $pixelPerPoint ; $ty ++){
						for($tx = 0 ; $tx < $pixelPerPoint ; $tx ++){
							imagecopy($base_image,$imgS,($x)* $pixelPerPoint + $tx +$left -1,($y) * $pixelPerPoint + $ty + $top -1,0,0,7,7);
						}
					}
				}
			}
		}
		return $base_image;
	}
	
	function getColorByXY($base_image,$x,$y,$c1,$c2){
		//适用于由圆心开始的渐变色
		$height = imagesy($base_image);
		$width = imagesx($base_image);
		
		$cx = $width / 2;
		$cy = $height / 2;
		
		$distance = sqrt(($x - $cx) * ($x - $cx) + ($y - $cy) * ($y - $cy));		//到圆心的距离
		$r = sqrt($cx * $cx + $cy * $cy);
		
		$err = $distance / $r;
		
		$rB = $c1[0];
		$gB = $c1[1];
		$bB = $c1[2];
		
		$rDelta = ($rB - $c2[0]); // change in Red from background
		$rComp = $rB - $rDelta * $err; // mix Red
		$gDelta = ($gB - $c2[1]); // change in Red from background
		$gComp = $gB - $gDelta * $err; // mix Red
		$bDelta = ($bB - $c2[2]); // change in Red from background
		$bComp = $bB - $bDelta * $err; // mix Red
		
		return imagecolorallocate($base_image,$rComp,$gComp,$bComp);
	}
	function getColorByPixel($base_image,$x,$y,$c1,$c2){
		//获取坐标XY处的颜色索引
		$rB = $c1[0];
		$gB = $c1[1];
		$bB = $c1[2];
		
		$height = imagesy($base_image);
		$width = imagesx($base_image);
		
		$err = $y / $height;
		
		$rDelta = ($rB - $c2[0]); // change in Red from background
		$rComp = $rB - $rDelta * $err; // mix Red
		$gDelta = ($gB - $c2[1]); // change in Red from background
		$gComp = $gB - $gDelta * $err; // mix Red
		$bDelta = ($bB - $c2[2]); // change in Red from background
		$bComp = $bB - $bDelta * $err; // mix Red
		
		return imagecolorallocate($base_image,$rComp,$gComp,$bComp);
	}
	
	function RoundRectangle($base_image,$x,$y,$w,$h,$r,$color,$err){
		//圆角矩形
		$base_color = imagecolorallocate($base_image,$color[0],$color[1],$color[2]);
		for($curX = $x - $r - 5;$curX < $x + $w + $r + 5; $curX ++){
			for($curY = $y - $r - 5 ; $curY < $y + $h + $r + 5 ; $curY ++){
				//switch来判断距离边界的距离	
				$distance = 0;
				
				if($curX < $x){
					if($curY < $y){
						$distance = sqrt(pow($curX - $x,2) + pow($curY - $y,2));
					}else if($curY >= $y && $curY <= $y + $h){
						$distance = $x - $curX;
					}else{
						$distance = sqrt(pow($curX - $x,2) + pow($curY - $y - $h,2));
					}
				}else if($curX >= $x && $curX <= $x + $w){
					if($curY < $y){
						$distance = $y - $curY;
					}else if($curY >= $y && $curY <= $y + $h){
						$distance = 0;
					}else{
						$distance = $curY - $y - $h;
					}
				}else{
					if($curY < $y){
						$distance = sqrt(pow($curX - $x - $w,2) + pow($curY - $y,2));
					}else if($curY >= $y && $curY <= $y + $h){
						$distance = $curX - $x - $w;
					}else{
						$distance = sqrt(pow($curX - $x - $w,2) + pow($curY - $y - $h,2));
					}
				}
				$rgb = imagecolorat($base_image, $curX, $curY);	//取当前像素点的颜色
				$rB = ($rgb >> 16) & 0xFF;
				$gB = ($rgb >> 8) & 0xFF;
				$bB = $rgb & 0xFF;
				
				if($distance - $r > $err){
					//to do nothing	
				}else if($distance - $r < -$err){
					//color = color	
					imagesetpixel($base_image,$curX,$curY,$base_color);
				}else{
					$range = $err * 2;
					$value = $distance - $r + $err;
					$per = 1 - $value / $range;
					
					$rDelta = ($rB - $color[0]); // change in Red from background
					$rComp = $rB - $rDelta * $per; // mix Red
					$gDelta = ($gB - $color[1]); // change in Red from background
					$gComp = $gB - $gDelta * $per; // mix Red
					$bDelta = ($bB - $color[2]); // change in Red from background
					$bComp = $bB - $bDelta * $per; // mix Red
					$aaCol = imagecolorallocate($base_image, $rComp, $gComp, $bComp);
					imagesetpixel($base_image,$curX,$curY,$aaCol);
				}
			}
		}
	}
	
	//根据xy坐标，判断当前点的status状况（xy必须是整数）
	function getStatus($frame,$x,$y){
		if ($frame[$y - 1][$x] != '1' || $frame[$y][$x + 1] != '1') {
			return 'LeftTop';		//左上角的点
		}
		if ($frame[$y][$x + 1] != '1') {
			return 'RightEmpty';		//右边是空的(Right Empty)
		}
	}
	
	function fillStartWith($frame,$grid,$startGrid,$currentFrame,$grid_type=0,$values,$isCaled){
		
		//初始化当前frame的四周状态参数
		$f = self::getF($frame,$currentFrame);
		$isCaled[$currentFrame['y']][$currentFrame['x']] = true;
		//判断当前节点是否需要添加到点数组中去
		$isAdd = false;
		$cx;
		$cy;
		switch($grid_type){
			case 0:
				if($f['D'] == $f['A'] || ($f['E'] && $f['D'])|| ($f['E'] && $f['A'])){
					$isAdd = true;	
					$cx = $currentFrame['x'];
					$cy = $currentFrame['y'];
				}
				break;
			case 1:
				if($f['A'] == $f['B'] || ($f['A'] && $f['F'])|| ($f['F'] && $f['B'])){
					$isAdd = true;	
					$cx = $currentFrame['x']+1;
					$cy = $currentFrame['y'];
				}
				break;
			case 2:
				if($f['B'] == $f['C'] || ($f['B'] && $f['G'])|| ($f['C'] && $f['G'])){
					$isAdd = true;	
					$cx = $currentFrame['x']+1;
					$cy = $currentFrame['y']+1;
				}
				break;
			case 3:
				if($f['C'] == $f['D'] || ($f['C'] && $f['H'])|| ($f['H'] && $f['D'])){
					$isAdd = true;	
					$cx = $currentFrame['x'];
					$cy = $currentFrame['y']+1;
				}
				break;
			default:
				break;
		}
		if($isAdd){
			//把当前Grid加入到values组中
			$len = count($values);
			$values[$len] = $grid[$cy][$cx]['x'];
			$values[$len + 1] = $grid[$cy][$cx]['y'];
		}
		
		//判断是否已经结束
		switch($grid_type){
			case 0:
				if($f['A']){
					$currentFrame['y']--;
					if($f['E']){
						$grid_type = 3;
					}
				}else if($f['B']){
					$currentFrame['x']++;
				}else{
					$grid_type = 1;
				}
				break;
			case 1:
				if($f['B']){
					$currentFrame['x']++;
					if($f['F']){
						$grid_type = 0;
					}
				}else if($f['C']){
					$currentFrame['y']++;
				}else{
					$grid_type = 2;
				}
				break;
			case 2:
				if($f['C']){
					$currentFrame['y']++;
					if($f['G']){
						$grid_type = 1;
					}
				}else if($f['D']){
					$currentFrame['x']--;
				}else{
					$grid_type = 3;
				}
				break;
			case 3:
				if($f['D']){
					$currentFrame['x']--;
					if($f['H']){
						$grid_type = 2;
					}
				}else if($f['A']){
					$currentFrame['y']--;
				}else{
					$grid_type = 0;
				}
				break;
			default:
				break;	
		}

		$_g = self::getCurrentGrid($currentFrame,$grid_type);
		if($_g['x'] == $startGrid['x'] && $_g['y'] == $startGrid['y']){
			//如果已经结束，返回生成的点数组values
			return $values;	
		}else{
			//没有结束，继续循环
			return self::fillStartWith($frame,$grid,$startGrid,$currentFrame,$grid_type,$values,$isCaled);	
		}
	}
	
	private function getCurrentGrid($currentFrame,$grid_type){
		$g = Array();
		$g['x'] = -1;
		$g['y'] = -1;
		switch($grid_type){
			case 0:
				$g['x'] = $currentFrame['x'];
				$g['y'] = $currentFrame['y'];
				break;
			case 1:
				$g['x'] = $currentFrame['x']+1;
				$g['y'] = $currentFrame['y'];
				break;
			case 2:
				$g['x'] = $currentFrame['x']+1;
				$g['y'] = $currentFrame['y']+1;
				break;
			case 3:
				$g['x'] = $currentFrame['x'];
				$g['y'] = $currentFrame['y']+1;
				break;
			default:break;	
		}
		return $g;
	}
	
	private function getF($frame,$currentFrame){
		$f = Array();	//ABCD
		$f['A']=false;
		$f['B']=false;
		$f['C']=false;
		$f['D']=false;
		
		$f['E']=false;
		$f['F']=false;
		$f['G']=false;
		$f['H']=false;

		$index = 0;
		
		if($frame[$currentFrame['y'] - 1][$currentFrame['x']] == '1'){
			$f['A'] = true;
		}
		if($frame[$currentFrame['y']][$currentFrame['x'] + 1] == '1'){
			$f['B'] = true;
		}
		if($frame[$currentFrame['y'] + 1][$currentFrame['x']] == '1'){
			$f['C'] = true;
		}
		if($frame[$currentFrame['y']][$currentFrame['x'] - 1] == '1'){
			$f['D'] = true;
		}
		
		if($frame[$currentFrame['y'] - 1][$currentFrame['x'] - 1] == '1'){
			$f['E'] = true;
		}
		if($frame[$currentFrame['y'] - 1][$currentFrame['x'] + 1] == '1'){
			$f['F'] = true;
		}
		if($frame[$currentFrame['y'] + 1][$currentFrame['x'] + 1] == '1'){
			$f['G'] = true;
		}
		if($frame[$currentFrame['y'] + 1][$currentFrame['x'] - 1] == '1'){
			$f['H'] = true;
		}
		return $f;
	}

}
?>