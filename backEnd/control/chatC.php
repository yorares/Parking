<?php
require "model/chatM.php";
require "helpers/test_input.php";

class chatC
{
	private $chatModel;
	function __construct(){
		$this->chatModel = new chatModel();
	}

    function getChat(){
        if($_SESSION["isLogged"] === true){
            $result = $this->chatModel->getChat($_SESSION);
            if($result != false && $result != null && $result != 0){
                return $result;
            }else{
                return "Something went wrong";
            }
        }else{
            return "Please log In";
        }
    }
    function readChat(){
        if($_SESSION["isLogged"] === true){
            $idPattern ="/^[0-9]*$/";
            preg_match_all($idPattern,$_POST['id'],$idMatch);
            if($_POST["id"] === $idMatch[0][0]){
                $_POST['id'] = test_input($_POST["id"]);
                $result = $this->chatModel->readDate($_POST["id"]);
                if($result === 1){
                    date_default_timezone_set('Europe/Bucharest');
                    return "read at ". date("Y-m-d H:i:s");
                }else{
                    return "Something went wrong";
                }
            }else{
                return "Characters not permited";
            }
        }else{
            return "Please Log In";
        }
    }


}?>