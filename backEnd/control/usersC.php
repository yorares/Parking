<?php
require "model/usersM.php";
require "helpers/password.php";

class usersC
{
	private $usersModel;
	function __construct(){
		$this->usersModel = new usersModel();
	}
    function getIp(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
   public function signUp(){
       $err=[];
       function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
       }
       if(!empty($_POST["firstName"])){
           $_POST["firstName"] = test_input($_POST["firstName"]);
       }else{
           array_push($err,"Empty Fisrt Name");
       }
       if(!empty($_POST["lastName"])){
           $_POST["lastName"] = test_input($_POST["lastName"]);
       }else{
           array_push($err,"Empty Last Name");
       }
       if(!empty($_POST["userName"])){
           $_POST["userName"] = test_input($_POST["userName"]);
       }else{
           array_push($err,"Empty User Name");
       }
       if(!empty($_POST["email"])){
           $_POST["email"] = test_input($_POST["email"]);
       }else{
           array_push($err,"Empty Email");
       }
       if(!empty($_POST["birthDate"])){
           $_POST["birthDate"] = test_input($_POST["birthDate"]);
       }else{
           array_push($err,"Empty Birth Date");
       }
       if(!empty($_POST["phone"])){
           $_POST["phone"] = test_input($_POST["phone"]);
       }else{
           array_push($err,"Empty Phone Number");
       }
       if(!empty($_POST["password"])){
       if(valid_pass($_POST["password"]) == FALSE){
           array_push($err,"Password not valid");
       }else{
            $_POST["password"] = valid_pass($_POST["password"]);
       }
       }
       $patUserName = "/^[A-Z,a-z,',_,.,1-9,0]*$/";
       $patName = "/^[A-Z,a-z, ,']*$/";
       $patPhone = "/^[1-9,0, ,+]*$/";

       if(empty($err)){
           preg_match_all($patUserName, $_POST["userName"], $match_userName);
           preg_match_all($patName,$_POST["firstName"],$match_fName);
           preg_match_all($patName,$_POST["lastName"],$match_lName);
           preg_match_all($patPhone,$_POST["phone"],$match_phone);
            if($_POST["userName"] != $match_userName){
                array_push($err,"Invalid User Name");
            }else if (!empty($this->userModel->checkUser($_POST["userName"]))){
                array_push($err,"User Name already exists");
            }
            if($_POST["firstName"] != $match_fName){
                array_push($err,"Invalid First Name");
            }
            if($_POST["lastName"] != $match_lName){
                array_push($err,"Invalid Last Name");
            }
            if($_POST["phone"] != $match_phone){
                array_push($err,"Invalid phone number");
            }
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
     		array_push($err,"Invalid email, ");
		    }else if (!empty($this->userModel->checkEmail($_POST["email"]))){
                array_push($err,"Email already exists");
            }
            $test_arr  = explode('-', $_POST["birthDate"]);
            if (checkdate($test_arr[0], $test_arr[1], $test_arr[2]) == FALSE) {
                array_push($err,"Invalid Date");
            }else if(parseInt($test_arr[2]) > 150){
                array_push($err,"Are you really that old ?");
            }

            if(empty($err)){
                $_POST["userIp"] = getIp();
                $_POST["birthDate"] = $test_arr[2] ."-". $test_arr[0] ."-". $test_arr[1];
                $id = $this->usersModel->insertItem($_POST);
                if(parseInt($id) != "NaN" && $id != 0){
                    return "Sign Up Succesfully!";
                }else{
                    return "Internal Server Error";
                }
            }else{
                return $err;
            }
       }else{
           return $err;
       }
   }

    //private scope when you want your variable/function to be visible in its own class only---nu putea sa fie private si sa fie folosita din index
    //protected scope when you want to make your variable/function visible in all classes that extend current class including the parent class.
   public function logIn(){
    $error=[];
    $data['user'] = $_POST["userName"];
    $data['email'] = $_POST["email"];
    $data['password'] =$_POST["password"];
    $userPattern ="/^[a-zA-Z0-9,',.,_]";
    preg_match_all($userPattern,$data['user'],$userMatch);
    // $passPattern=
    // preg_match_all($passPattern,$data['password']);

    //validate user name
    if (empty($data['user'])) {
        array_push($error,"User name was not inserted.");
      } else if(!empty($this->usersModel->checkUser($data['user']))){
        array_push($error,"This user already exists!");
      }else if($data['user'] == $userMatch[0][0]) {
        $data['user'] = test_input($data['user']);
      }

      //validate email
    if(empty($data['email'])) {
        array_push($error,"Please enter your email, ");
      }else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
         array_push($err,"Invalid email, ");
      }else if(!empty($this->usersModel->checkEmail($data['email']))){
         array_push($error,"Ths email already exists!");
      }else{
          $data['email'] = test_input($data['user']);
      }
      //Validate password
    if(empty($data['password'])){
        array_push($error,"Please enter your password, ");
    }else if(strlen($data['password'])<6){
        array_push($error,"Your password must be greater than 6 chars");
    }else if(valid_pass($data['password']) == false){
        array_push($error,"Not valid password.");
    }else if(valid_pass($data['password'])){
        $data["password"] = valid_pass($data['password']);
        if($data['password'] !== $this->userModel->checkPassword($data['password'])){
            array_push($error,"Your password is incorect");
        }
    }
 //Final validation-setting session for a specific user
    if(empty($error)){
        $result = $this->usersModel->selectItem($data);
        if ($result === false) {array_push($err,"Invalid Log In"); }
        if (empty($error)) {
            $_SESSION["id"]=$result["id"];
            $myAccount = $this->usersModel->selectById($_SESSION["id"]);
            $_SESSION["role"]= $result["role"];
            $_SESSION['LAST_ACTIVITY'] = time();
            return $_SESSION["role"];
        }else{
            sleep(2);return $error;
        }
    }
 }

    function deleteUser(){
        if (empty($_POST['id'])) {
            return "Cannot find user id to delete";    
        } else {
            return $this->usersModel->deleteItem($_POST["id"]);     
        }
    }

    function getUser(){
        if (empty($_POST['id'])) {
            return send_error("Cannot get user id");    
        } else {
            return $this->usersModel->selectItem($_GET['id']);    
        }
    }

    function getAll() {
        return $this->usersModel->selectAll();
    }

    // function updateUser() {
    //     if (empty($_POST['id']){
    //         return "Invalid id or id not found!";
    //     }else if(empty($_POST['userName']){
    //         return "Username not found";
    //     }else if($_POST['name']){
    //         return "Empty name field";
    //     }else if(){

    //     }

    //     }
}
?>