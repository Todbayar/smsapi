<?php
include "mysql_config.php";
include_once "functions.php";
include_once "variables.php";
include_once "constants.php";

if(isset($_GET["userID"]) && isset($_GET["type"])){
	
	$creditAmount = 0;
	switch($_GET["type"]){
		case 1:
			$creditAmount=floor(CREDIT_STARTER/PRICE_PER_CREDIT);
			break;
		case 2:
			$creditAmount=floor(CREDIT_MID/PRICE_PER_CREDIT);
			break;
		case 3:
			$creditAmount=floor(CREDIT_PRO/PRICE_PER_CREDIT);
			break;
	}
	
	$query = "UPDATE apikey SET credit=credit+".$creditAmount." WHERE userID=".$_GET["userID"];
	if($conn->query($query)){
		echo "Амжилттай нэмэгдлээ.";
	}
	else {
		echo "FAIL";
	}
}
?>