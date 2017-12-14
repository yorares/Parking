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

$routes["getAverageReview"] = ["class" => "reviewC", "method" => "averageStarsNumber"];

$routes["getAverageReviews"] = ["class" => "reviewC", "method" => "averageStarsNumber"];

$routes["edit"] = ["class" => "reviewC", "method" => "editReview"];

$routes["edit"] = ["class" => "reviewC", "method" => "createStarsReview"];

$routes["deleteReviews"] = ["class" => "reviewC", "method" => "deleteReviews"];
$routes["getAllReviews"] = ["class" => "reviewC", "method" => "getAll"];

?>
