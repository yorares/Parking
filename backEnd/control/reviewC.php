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
		// $starsPattern ="/^[0-9]/";
		// preg_match_all($starsPattern,$_POST["userId"],$starsMatch);
		if(!empty($_POST["userId"]) ){
			$starsNumber = $this->reviewsModel->starsNumber($_POST["userId"]);
            return $starsNumber;
		}else if (intval($starsNumber) == "NaN") {
            // array_push($error,"The review was not made");
            return "ERROORRR";
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
        if($_SESSION["isLogged"] = true){
            return $this->reviewsModel->selectAll();
        }else{
            return "Please log in";
        }
    }
    function editReview(){
        if($_SESSION["isLogged"] = true){
            $userPattern ="/^[0-9]/";
            preg_match_all($userPattern,$_POST['id'],$idMatch);
            preg_match_all($userPattern,$_POST['starsReview'],$starMatch);
            if($_POST['id'] == $idMatch && $_POST['starsReview'] == $starMatch){
                $_POST['id'] = test_input($_POST['id']);
                $_POST['starsReview'] = test_input($_POST['starsReview']);
                $_POST["message"] = test_input($_POST['message']);
                $control = $this->reviewsModel->editReviewM($_SESSION);
                var_dump($control);
                if($control["id"] == $_POST['id']){
                    $dap = $this->reviewsModel->editReviewM($_POST);
                    if($dap == 1){
                        return "Edit Succesfull";
                    }else{
                        return "Something went wrong!";
                    }
                }
            }
        }else{
            return "Please log in";
        }
    }



}?>