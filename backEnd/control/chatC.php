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


}?>