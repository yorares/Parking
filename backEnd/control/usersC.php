<?php
require "model/usersModel.php";

class chatC
{
	private $usersModel;
	function __construct(){
		$this->usersModel = new usersModel();
	}
   function signUp(){
       $fName = $_POST["firstName"];
       $lname = $_POST["lastName"];
       $userName = $_POST["userName"];
       $email = $_POST["email"];
   }


}?>