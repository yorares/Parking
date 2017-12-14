<?php
require "model/reviewsM.php";
require "helpers/test_input.php";
require "helpers/returnIp.php";


class reviewC
{
	private $reviewsModel;
	function __construct(){
		$this->reviewsModel = new reviewsModel();
	}
   // I create, R delete,R getall,I edit
	function averageStarsNumber(){
		$error = [];
		$starsPattern ="/^[0-9,.,]/";
		// preg_match_all($starsPattern, $_POST["starsNumbers"], $starsMatch);
		if(!empty($_POST["userId"])){
			$starsNumber = $this->reviewsModel->starsNumber($_POST["userId"]);
			return $starsNumber;
		}else {
			array_push($error,"The review was not made");
		}	
	}

}
?>