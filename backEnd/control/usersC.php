<?php
require "model/usersModel.php";
require "../helpers/password.php";
class chatC
{
	private $usersModel;
	function __construct(){
		$this->usersModel = new usersModel();
	}
   
	private function logIn() {
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		  }

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$error=[];
			$user = $_POST["userName"];
			$email = $_POST["email"];
			$password =$_POST["password"];
			$userPattern ="/^[a-zA-Z0-9,',.,_]";
			preg_match_all($userPattern,$user,$userMatch);	
			// $passPattern=
			preg_match_all($passPattern,$password,);
			
			//validate user name
			if (empty($user) {
				array_push($error,"User name was not inserted.");
			  } else if(!empty($this->usersModel->checkUser($user))){
				array_push($error,"This user already exists!");
			  }else if($user == $userMatch[0][0]) {
				$user = test_input($user);
			  }
			
			  //validate email
			if(empty($email)) {
				array_push($error,"Please enter your email, ");
			  }else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
				 array_push($err,"Invalid email, ");
			  }else if(!empty($this->usersModel->checkEmail($email))){
				 array_push($error,"Ths email already exists!");
			  }else{
				  $email = test_input($user); 
			  }  
			  //Validate password
			if(empty($password)){
				array_push($error,"Please enter your password, ");
			}else if(strlen($password)<6){
				array_push($error,"Your password must be greater than 6 chars");
			}else if(valid_pass($password) == false){
				array_push($error,"Not valid password.");
			}else if(valid_pass($password)){
				$hased_password = valid_pass($password);
				if($hashed_password !== $this->userModel->checkPassword($password)){
					array_push($error,"Your password is incorect");
				}
			}
		 //Final validation-setting session for a specific user
			if(empty($error)){
				$result = $this->usersModel->selectItem($_POST);
				if ($result === false) {array_push($err,"Invalid Log In"); }
				if (empty($error)) {
					$_SESSION["id"]=$result["id"];
					$myAccount = $this->usersModel->selectById($_SESSION["id"]);
					$_SESSION["role"]= $result["role"];
					$_SESSION['LAST_ACTIVITY'] = time();
					return $_SESSION["role"];
				}else{sleep(2);return $err;}
			}
		}
	}
}


}?>