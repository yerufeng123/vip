<?php

class FangFund extends Type {

    public function getImage() {
        ///////////////////////////////////////////////////////////
        $frame = Base::getFrame($this->Parameter["Data"], 0);
        //$logo = imagecreatefrompng("resource/Customized/FangFund/logo.png");
        //$logo_bg = imagecreatefrompng("resource/Customized/FangFund/null_bg.png");
        $h = count($frame);
        $w = strlen($frame[0]);
        $left = 10;
        $top = 10;
        $pixelPerPoint = 13;

        $imgW = $w * $pixelPerPoint + $left * 2;
        $imgH = $h * $pixelPerPoint + $top * 2;


        $base_image = imagecreatetruecolor($imgW, $imgH);
        $bg_col = imagecolorallocate($base_image, 255, 255, 255);
        imagefill($base_image, 0, 0, $bg_col);
        $col = imagecolorallocate($base_image, 0, 0, 0);
        //imagefill($null_bg, 0, 0, $bg_col);

        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                if ($frame[$y][$x] == '1') {
                    imagefilledrectangle($base_image, $x * $pixelPerPoint + $left, $y * $pixelPerPoint + $top, ($x + 1) * $pixelPerPoint + $left, ($y + 1) * $pixelPerPoint + $top, $col);
                }
            }
        }
        return $base_image;
    }

}

?>