<?php
class Normal extends Type{
	public function getImage(){
		///////////////////////////////////////////////////////////
		$frame = Base::getFrame($this->Parameter["Data"],$this->errorCorrectionLevel);
		$h = count($frame);
		$w = strlen($frame[0]);
		$pixelPerPoint = $this->pixelPerPoint;
		$imgW = $w * $pixelPerPoint + $this->l * 2;
		$imgH = $h * $pixelPerPoint + $this->t * 2;
		$base_image = imagecreate($imgW, $imgH);
		$bgc = imagecolorallocate($base_image,255,255,255);
		///////////////////////////////////////////////////////////
		$col = imagecolorallocate($base_image,0,0,0);
		
		for($y=0; $y<$h; $y++) {
			for($x=0; $x<$w; $x++) {
				if ($frame[$y][$x] == '1'){
					imagefilledrectangle($base_image,($x)* $pixelPerPoint + $this->l,($y) * $pixelPerPoint + $this->t,($x + 1 )* $pixelPerPoint + $this->l,($y+ 1) * $pixelPerPoint + $this->t,$col); 
				}
			}
		}
		
		return $base_image;
	}
}
?>