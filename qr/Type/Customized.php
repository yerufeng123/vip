<?php
include "Customized/FangFund.php";

class Customized extends Type{
	public function getImage(){
		//二次分流	
		$this->Stype = $this->Parameter["Stype"];
		switch($this->Stype){

			case "FangFund":
				$Customized = new FangFund($this->Parameter);
				$base_image = $Customized->getImage();
				break;
			default:
				break;
		}
		return $base_image;
	}
}
?>