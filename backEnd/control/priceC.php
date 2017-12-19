<?php
require "model/priceM.php";

class priceC
{
	private $priceModel;
	function __construct(){
		$this->priceModel = new priceModel();
	}
   function historyParking(){
       if(!empty($_SESSION["id"])){
           return $this->priceModel->historyOfParking($_SESSION["id"]);
       }else if (!empty($_POST["userId"])){
           if($_SESSION["role"] == "admin"){
               return $this->priceModel->historyOfParking($_POST["userId"]);
           }
       }
   }
   function payParking(){
       if($_SESSION["isLogged"] == true){
       $err = [];
       if(!empty($_POST["parkingId"])){
           $userPattern ="/^[0-9]/";
           preg_match_all($userPattern,$_POST['parkingId'],$idMatch);
           if($_POST["parkingId"] == $idMatch[0][0]){
               $result = $this->priceModel->getPrice($_POST["parkingId"]);
               $_POST["price"] = $result["price"];
           }else{
               array_push($err,"Invalid parking.");
           }
       }else{
           array_push($err,"Not valid parking.");
       }
       $_POST["userId"] = $_SESSION["id"];
       if(!empty($_POST["carNumber"])){
           $carPattern ="/^[a-z,A-Z,0-9,-]*$/";
           preg_match_all($carPattern,$_POST['carNumber'],$carMatch);
           if($_POST["carNumber"] == $carMatch[0][0]){

           }else{
               array_push($err,"Not valid car number.");
           }
       }else{
           array_push($err,"empty car number");
       }
       if(empty($err)){
           $res = $this->priceModel->payParking($_POST);
           if($res != 0){
               return "Payment Succesfull";
           }else{
               return "Something went Wrong";
           }
       }else{
           return $err;
       }


       }
   }


}?>