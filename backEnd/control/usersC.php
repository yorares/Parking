<?php
require "model/usersModel.php";
require "../helpers/password.php";

class chatC
{
	private $usersModel;
	function __construct(){
		$this->usersModel = new usersModel();
	}
   private function signUp(){
       $err=[];
       function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
       }
       if(!empty($_POST["firstName"])){
            $fName = test_input($_POST["firstName"]);
       }else{
           array_push($err,"Empty Fisrt Name");
       }
       if(!empty($_POST["lastName"])){
            $lName = test_input($_POST["lastName"]);
       }else{
           array_push($err,"Empty Last Name");
       }
       if(!empty($_POST["userName"])){
           $userName = test_input($_POST["userName"]);
       }else{
           array_push($err,"Empty User Name");
       }
       if(!empty($_POST["email"])){
           $email = test_input($_POST["email"]);
       }else{
           array_push($err,"Empty Email");
       }
       if(!empty($_POST["birthDate"])){
           $birthDate = test_input($_POST["birthDate"]);
       }else{
           array_push($err,"Empty Birth Date");
       }
       if(!empty($_POST["phone"])){
           $phone = test_input($_POST["phone"]);
       }else{
           array_push($err,"Empty Phone Number");
       }

       if(valid_pass($_POST["password"]) == FALSE){
           array_push($err,"Password not valid");
       }else{
            $_POST["password"] = valid_pass($_POST["password"]);
       }

       $patUserName = "/^[A-Z,a-z,',_,.,1-9,0]*$/";
       $patName = "/^[A-Z,a-z, ,']*$/";
       $patPhone = "/^[1-9,0, ,+]*$/";

       if(empty($err)){
            preg_match_all($patUserName, $userName, $match_userName);
            preg_match_all($patName,$fName,$match_fName);
            preg_match_all($patName,$lName,$match_lName);
            preg_match_all($patPhone,$phone,$match_phone);
            if($userName != $match_userName){
                array_push($err,"Invalid User Name");
            }else if (!empty($this->userModel->checkUser($userName))){
                array_push($err,"User Name already exists");
            }
            if($fName != $match_fName){
                array_push($err,"Invalid First Name");
            }
            if($lName != $match_lName){
                array_push($err,"Invalid Last Name");
            }
            if($phone != $match_phone){
                array_push($err,"Invalid phone number");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     		array_push($err,"Invalid email, ");
		    }else if (!empty($this->userModel->checkEmail($email))){
                array_push($err,"Email already exists");
            }
            $test_arr  = explode(':', $birthDate);
            if (checkdate($birthDate[0], $birthDate[1], $birthDate[2]) == FALSE) {
                array_push($err,"Invalid Date");
            }else if(parseInt($birthDate[2]) > 150){
                array_push($err,"Are you really that old ?");
            }

            if(empty($err)){
                $id = $this->usersModel->insertItem($_POST);
                if(parseInt($id) != "NaN" && $id != 0){
                    return "Sign Up Succesfully!";
                }else{
                    return $err;
                }
            }
       }
   }


}?>