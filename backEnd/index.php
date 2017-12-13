<?php
session_start();
if(empty($_SESSION["role"])){
    $_SESSION["role"] = "quest";
}
// session time expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
require "config/routes.php";
define("APP_FOLDER", "/Parking/backEnd/");
$currentRoute = str_replace(APP_FOLDER, "", $_SERVER["REDIRECT_URL"]);

echo $currentRoute;
//var_dump($_SERVER);

if (!empty($currentRoute)) {

	if(!empty($_SESSION["user_id"])){
	$_SESSION['LAST_ACTIVITY'] = time();}

	if (array_key_exists($currentRoute,$routes)) {

		$class = $routes[$currentRoute]["class"];
        $method = $routes[$currentRoute]["method"];

		require "/control/".$class.".php";
		$controllUser = new $class();
		$response = $controllUser->$method();
		echo json_encode($response);

	}else{http_response_code(404);echo'<h1 style="text-align:center;">page not found</h1>';}
}else{http_response_code(403);echo "Access forbidden";}



?>