<?php
require "model/chatM.php";

class chatC
{
	private $chatModel;
	function __construct(){
		$this->chatModel = new chatModel();
	}

    function getChat(){
        if($_SESSION["isLogged"] = true){
            $result = $this->chatModel->getChat($_SESSION);
            return $result;
        }
    }

    function createChat(){
        if($_SESSION("isLogged") === true){
            $date["userId"] = $_POST["userId"];
            $date["content"] = $_POST["content"];
            $date["userIdReceive"] = $_POST["userIdReceive"];
            $patUsersId = "/^[1-9,0]*$/";
            preg_match_all($patUsersId, $_POST["userId"], $match_userId);
            preg_match_all($patUsersId, $_POST["userIdReceive"], $match_userIdReceive);
            if($_POST["userId"] != $match_userId[0][0]){
                array_push($err,"Invalid User Name");
            }else if ($this->usersModel->checkUser($_POST["userName"]) >= 1){
                array_push($err,"User Name already exists");
            }
            
            
            $this->chatModel->InsertChat($date);
        }
    }


}?>