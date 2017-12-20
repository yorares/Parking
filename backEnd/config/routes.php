<?php
$routes["signUp"] = ["class" => "usersC", "method" => "signUp"];
$routes["logIn"] = ["class" => "usersC", "method" => "logIn"];
$routes["deleteUser"] = ["class" => "usersC", "method" => "deleteUser"];
$routes["getUser"] = ["class" => "usersC", "method" => "getUser"];
$routes["getAllUsers"] = ["class" => "usersC", "method" => "getAll"];
$routes["updateUser"] = ["class" => "usersC", "method" => "updateUser"];
$routes["banUser"] = ["class" => "usersC", "method" => "banUser"];
$routes["unBanUser"] = ["class" => "usersC", "method" => "unBanUser"];
$routes["logOut"] = ["class" => "userC", "method" => "logOut"];

//Review routes


$routes["getAverageReviews"] = ["class" => "reviewC", "method" => "averageStarsNumber"];
$routes["createReview"] = ["class" => "reviewC", "method" => "createReview"];

$routes["edit"] = ["class" => "reviewC", "method" => "editReview"];
$routes["deleteReviews"] = ["class" => "reviewC", "method" => "deleteReviews"];
$routes["getAllReviews"] = ["class" => "reviewC", "method" => "getAll"];
$routes["totalReviews"] = ["class" => "reviewC", "method" => "totalReviews"];

//Price routes

$routes["historyOfParking"] = ["class" => "priceC", "method" => "historyParking"];
$routes["payParking"] = ["class" => "priceC", "method" => "payParking"];

//PARKING ROUTES
$routes["editParking"] = ["class" => "parkingC", "method" => "editItem"];
$routes["getAllParking"] = ["class" => "parkingC", "method" => "getAll"];
$routes["createParking"] = ["class" => "parkingC", "method" => "createParking"];

// chat routes

$routes["creeateChat"] = ["class" => "chatC", "method" => "createChat"];
$routes["getChat"] = ["class" => "chatC", "method" => "getChat"];


?>
