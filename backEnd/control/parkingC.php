<?php
require "model/parkingModel.php";

class parkingC
{
	private $parkingModel;
	function __construct(){
		$this->parkingModel = new parkingModel();
	}
   // R create, I edit, R delete, I getall


}?>