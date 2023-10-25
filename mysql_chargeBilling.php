<?php
include "mysql_config.php";
include_once "functions.php";
include_once "variables.php";
include_once "constants.php";

if(isset($_COOKIE["userID"]) && isset($_POST["data"])){
	$objUser = json_decode($_POST["data"]);
	//link for auto topuper here add to bottom	
	
	$body = "SMSAPI Хэрэглэгчийн цэнэглэлт<br/>".$objUser->identity."<br/>".$objUser->charge."<br/>Цэнэглэх дүн:".$charge."₮";

	if(sendEmailVerification(ADMIN_EMAIL, "Цэнэглэлт", $body)){
		echo "OK";
	}
	else {
		echo "FAIL";
	}
}
?>