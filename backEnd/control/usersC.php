<?php
require "model/usersM.php";
require "helpers/password.php";
require "helpers/test_input.php";
require "helpers/returnIp.php";

class usersC
{
	private $usersModel;
	function __construct(){
		$this->usersModel = new usersModel();
	}

   public function signUp(){
       $err=[];

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
           if($_POST["userName"] != $match_userName[0][0]){
                array_push($err,"Invalid User Name");
            }else if ($this->usersModel->checkUser($_POST["userName"]) >= 1){
                array_push($err,"User Name already exists");
            }
            if($_POST["firstName"] != $match_fName[0][0]){
                array_push($err,"Invalid First Name");
                echo $_POST["firstName"];
                var_dump( $match_fName[0][0]);
            }
            if($_POST["lastName"] != $match_lName[0][0]){
                array_push($err,"Invalid Last Name");
            }
            if($_POST["phone"] != $match_phone[0][0]){
                array_push($err,"Invalid phone number");
            }
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
     		array_push($err,"Invalid email, ");
		    }else if ($this->usersModel->checkEmail($_POST["email"]) >= 1){
                array_push($err,"Email already exists");
            }
            $test_arr  = explode('-', $_POST["birthDate"]);
            if (checkdate($test_arr[0], $test_arr[1], $test_arr[2]) == FALSE) {
                array_push($err,"Invalid Date");
            }else if(settype($test_arr[2],'integer') > 1900 || settype($test_arr[2],'integer') < date("Y")){
                array_push($err,"Are you really that old ?");
            }

            if(empty($err)){
                $_POST["userIp"] = getIp();
                $_POST["birthDate"] = $test_arr[2] ."-". $test_arr[0] ."-". $test_arr[1];
                $id = $this->usersModel->insertItem($_POST);
                if(settype($id,'integer') != "NaN" || settype($id,'integer') != 0){
                    return "Sign Up Successfully!";
                }else{
                    var_dump($id);
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
   // $data['user'] = $_POST["userName"];
//    $data['email'] = $_POST["email"];
    $data['password'] = $_POST["password"];
    $userPattern ="/^[a-z,A-Z,0-9,',.,_]/";
    preg_match_all($userPattern,$_POST["userName"],$userMatch);
    // $passPattern=
    // preg_match_all($passPattern,$data['password']);

    //validate user name

    if(!empty($_POST["userName"])){
        $data['user'] = $_POST["userName"];
        if($_POST["userName"] == $userMatch[0][0]) {
         $data['user'] = test_input($_POST["userName"]);
      }
    }else if(!empty($_POST["email"])){
        $data['email'] = $_POST["email"];
      //validate email
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
         array_push($err,"Invalid email, ");
      }else{
          $data['email'] = test_input($_POST["email"]);
      }
    }else {
        array_push($error,"User name or Email was not inserted.");
    }
      //Validate password
    if(empty($data['password'])){
        array_push($error,"Please enter your password, ");
    }else if(valid_pass($data['password']) == false){
        array_push($error,"Not valid password.");
    }else if(valid_pass($data['password'])){
        $data["password"] = valid_pass($data['password']);
    }
 //Final validation-setting session for a specific user
    if(empty($error)){
       // var_dump($data['user']);
       // var_dump($data);
        $result = $this->usersModel->selectItem($data);
        if ($result == FALSE) {array_push($error,"Invalid Log In");}
        var_dump($result);
        if($result["active"] == "banned"){array_push($error,"You are Banned!");}
        if (empty($error)) {
            $_SESSION["userName"] = $result["user_name"];
            $_SESSION["email"] = $result["email"];
            $_SESSION["id"] = $result["id"];
            //$myAccount = $this->usersModel->selectById($_SESSION["id"]);
            $this->usersModel->changeStatus($_SESSION["id"]);
            $_SESSION["isLogged"] = true; 
            $_SESSION["role"]= $result["role"];
            $_SESSION['LAST_ACTIVITY'] = time();
            return $_SESSION["id"].$_SESSION["role"];
        }else{
            sleep(2);return $error;
        }
    }
 }

    function logOut(){
        session_unset();
        session_destroy();
        $result = $this->userModel->logOut($_SESSION["id"]);
        if($result !== 1){
            return "Something went wrong";
        }
    }

    function deleteUser(){
        if (empty($_POST['id'])) {
            return "No user id to delete";
        } else {
            $userPattern ="/^[0-9]/";
            preg_match_all($userPattern,$_POST['id'],$idMatch);
            if($_POST["id"] == $idMatch){
                $count = $this->usersModel->deleteItem($_POST["id"]);
            }
            if($count == 1){
                return "User Deleted Succesfully";
            }else{
                return "User id not found";
            }
        }
    }

    function getUser(){
        var_dump( $_POST);
        if (empty($_POST['userName'])) {
            return "Cannot get user id1";
        } else {
            $userPattern ="/^[a-z,A-Z,0-9,',.,_]/";
            preg_match_all($userPattern,$_POST["userName"],$userMatch);
            if($_POST["userName"] == $userMatch){
                $userName = $_POST["userName"];
            }
            $account = $this->usersModel->selectItemByName($userName);
            var_dump($account);
            if($account == FALSE){
                return "Cannot get user id2";
            }else{
                return $account;
            }
        }
    }

     function getAll() {
         return $this->usersModel->selectAll();
     }

     function updateUser() {

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

         $err=[];
         
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
             if($_POST["userName"] != $match_userName[0][0]){
                 array_push($err,"Invalid User Name");
             }else if ($this->usersModel->checkUser($_POST["userName"]) >= 1){
                 array_push($err,"User Name already exists");
             }
             if($_POST["firstName"] != $match_fName[0][0]){
                 array_push($err,"Invalid First Name");
                 echo $_POST["firstName"];
                 var_dump( $match_fName[0][0]);
             }
             if($_POST["lastName"] != $match_lName[0][0]){
                 array_push($err,"Invalid Last Name");
             }
             if($_POST["phone"] != $match_phone[0][0]){
                 array_push($err,"Invalid phone number");
             }
             if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                 array_push($err,"Invalid email, ");
             }else if ($this->usersModel->checkEmail($_POST["email"]) >= 1){
                 array_push($err,"Email already exists");
             }
             $test_arr  = explode('-', $_POST["birthDate"]);
             if (checkdate($test_arr[0], $test_arr[1], $test_arr[2]) == FALSE) {
                 array_push($err,"Invalid Date");
             }else if(settype($test_arr[2],'integer') > 1900 || settype($test_arr[2],'integer') < date("Y")){
                 array_push($err,"Are you really that old ?");
             }

             if(empty($err)){
                 $_POST["userIp"] = getIp();
                 $_POST["birthDate"] = $test_arr[2] ."-". $test_arr[0] ."-". $test_arr[1];
                 $id = $this->usersModel->editItem($_POST);
                 if(settype($id,'integer') != "NaN" || settype($id,'integer') == 1){
                     return "Edit Succesfull!";
                 }else{
                     var_dump($id);
                     return "Internal Server Error";
                 }
             }else{
                 return $err;
             }
         }else{
             return $err;
         }

        //  function birthDate(){

        //     setInterval(function(){
        //         $result = $this->usersModel->checkBirthDate();
        //         if($result !==false) {
        //             $message = "Happy bday".$result["first_name"]." ".$result["last_name"];            
        //         }
        //     }, 86400000);
        //     return $message;
        // }
        
}
}

     function banUser(){         
         if($_SESSION["role"] == "admin"){
             $variabial = $this->usersModel->banUser($_POST);
             if($variabial != 1){
                 return "Something went wrong";
             }else{
                 return $variabial;
             }

         }
     }
     function unBanUser(){
         if($_SESSION["role"] == "admin"){
             $variabial = $this->usersModel->unBanUser($_POST);
             if($variabial != 1){
                 return "Something went wrong";
             }else{
                 return $variabial;
             }

         }
     }


