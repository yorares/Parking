<?php
require "model/parkingM.php";
require "helpers/test_input.php";
class parkingC
{
	private $parkingModel;
	function __construct(){
		$this->parkingModel = new parkingModel();
	}
   function getAll(){
	   return $this->parkingModel->selectAll();
   }

   function editItem(){
if($_SESSION["isLogged"]===true){
	$err = [];
	if(empty($_POST["price"])){
		array_push($err,"Empty price");
	}else if (empty($_POST["longitude"])){
		array_push($err,"Empty longitude");
	}else if(empty($_POST["latitude"])){
		array_push($err,"Empty latitude");
	}else if(empty($_POST["parkingNum"])){
		array_push($err,"Empty parking number");
	}else if(empty($_POST["startDate"])){
		array_push($err,"Empty start date");
	}else if(empty($_POST["endDate"])){
		array_push($err,"Empty end date");
	}else if(empty($_POST["details"])){
		array_push($err,"Empty details");
	}
	if(empty($err)){
		$pricePattern ="/^[0-9,.]*$/";
		$datePattern ="/^[0-9,\-,\:,\ ]*$/";
		$detailPattern = "/^[A-Z,a-z,',\,,.,1-9,0]*$/";
	
   preg_match_all($pricePattern,$_POST['price'],$priceMatch);
   preg_match_all($pricePattern,$_POST['longitude'],$longitudeMatch);
   preg_match_all($pricePattern,$_POST['latitude'],$latitudeMatch);
   preg_match_all($pricePattern,$_POST['parkingNum'],$parkingNumMatch);
   preg_match_all($datePattern,$_POST['startDate'],$startDateMatch);
   preg_match_all($datePattern,$_POST['endDate'],$endDateMatch);
   preg_match_all($detailPattern,$_POST['details'],$detailsMatch);
   if($_POST['price'] == $priceMatch[0][0]){
		$_POST['price'] = test_input($_POST["price"]);
	}else{
		array_push($err,"Invalid Price");
	}

	if($_POST['longitude'] == $longitudeMatch[0][0]){
		$_POST['longitude'] = test_input($_POST["longitude"]);
	}else{
		array_push($err,"Invalid longitude");
	}

	if($_POST['latitude'] == $latitudeMatch[0][0]){
		$_POST['latitude'] = test_input($_POST["latitude"]);
	}else{
	array_push($err,"Invalid latitude");
	}

	if($_POST['parkingNum'] == $parkingNumMatch[0][0]){
		$_POST['parkingNum'] = test_input($_POST["parkingNum"]);
	}else{
		array_push($err,"Invalid parkingNum");
	}

	if($_POST['startDate'] == $startDateMatch[0][0]){
		$_POST['startDate'] = test_input($_POST["startDate"]);
	}else{
		array_push($err,"Invalid start date");
	}

	if($_POST['endDate'] == $endDateMatch[0][0]){
		$_POST['endDate'] = test_input($_POST["endDate"]);
	}else{
		array_push($err,"Invalid end date");
	}

	if($_POST['details'] == $detailsMatch[0][0]){
		$_POST['details'] = test_input($_POST["details"]);
	}else{
		array_push($err,"Invalid details");
	}
	
	$_POST["userId"] = $_SESSION["id"];

	if(empty($err)){
		$result = $this->parkingModel->updateItem($_POST);
		var_dump($result);
		if($result == 0){
			return "Couldn't get the result";
		}else{
			return "Suuccess";
		}
	}else{
		return $err;
	}
	}else{
	return $err;
	}
}else{
	return "You must log in";
}
}
}
?>