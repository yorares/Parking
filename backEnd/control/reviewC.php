<?php
require "model/reviewsM.php";
require "helpers/test_input.php";
require "helpers/returnIp.php";


class reviewC
{
	private $reviewsModel;
	function __construct(){
		$this->reviewsModel = new reviewsModel();
	}
   // I create, R delete,R getall,I edit
	function averageStarsNumber(){
		$error = [];
		$starsPattern ="/^[0-9,.,]/";
		preg_match_all($starsPattern,$_POST["starsNumber"],$starsMatch);
		if(!empty($_POST["starsNumbers"]) && $starsMatch[0][0] === $_POST["starsNumbers"]){
			$starsNumber = $this->reviewsModel->starsNumber($_POST["userId"]);
			return $starsNumber;
		}else {
			array_push($error,"The review was not made");
		}
	}
    function deleteReviews(){
        if($_SESSION["role"] == "admin"){
            $_POST["id"] = test_input($_POST["id"]);
            $userPattern ="/^[0-9]/";
            preg_match_all($userPattern,$_POST['id'],$idMatch);
            if($_POST['id'] == $idMatch){
                $check = $this->reviewsModel->deteleReviews($_POST["id"]);
                if($check == 1){
                    return "Delete Succesfull";
                }else{
                    return "Semething went wrong";
                }
            }
        }else{
            return "This is not the webpage you are looking for";
        }
    }
    function getAll(){
        var_dump($this->reviewsModel->selectAll());
        return $this->reviewsModel->selectAll();
    }
    function editReview(){
        
    }



}?>