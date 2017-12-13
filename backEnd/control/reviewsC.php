<?php
require "model/reviewsModel.php";
require "helpers/test_input.php";
require "helpers/returnIp.php";


class chatC
{
	private $reviewsModel;
	function __construct(){
		$this->reviewsModel = new reviewsModel();
	}
   // I create, R delete,R getall,I edit
	function createReview(){
		$error = [];
		
	}

}?>