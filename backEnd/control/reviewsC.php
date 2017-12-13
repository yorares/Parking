<?php
require "model/reviewsModel.php";

class chatC
{
	private $reviewsModel;
	function __construct(){
		$this->reviewsModel = new reviewsModel();
	}
   // I create, R delete,R getall,I edit
	function createReview(){
		$error = [];

		function test_input($data){

		}
	}

}?>