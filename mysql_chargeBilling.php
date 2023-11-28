<?php
include "mysql_config.php";
include_once "functions.php";
include_once "variables.php";
include_once "constants.php";

if(isset($_COOKIE["userID"]) && isset($_POST["type"])){
	//link for auto topuper here add to bottom	
	
	$query = "SELECT * FROM user WHERE id=".$_COOKIE["userID"];
	$result = $conn->query($query);
	$row = mysqli_fetch_array($result);
	
	$userIdentity = $row["email"]; 
	if(!is_null($row["phone"])){
		if(!is_null($row["name"])) $userIdentity = "нэр: ".$row["name"]."<br/>";
		$userIdentity = "утасны дугаар: ".$row["phone"];
	}
	$userIdentity = "Хэрэглэгч<br/>".$userIdentity;
	
	$charge = 0;
	switch($_POST["type"]){
		case 1:
			$charge = CREDIT_STARTER;
			break;
		case 2:
			$charge = CREDIT_MID;
			break;
		case 3:
			$charge = CREDIT_PRO;
			break;
	}
	
	$domain = $_SERVER['SERVER_NAME']!="localhost"?$_SERVER['SERVER_NAME']:$_SERVER['SERVER_NAME']."/smsapi";
	$link = $protocol."://".$domain."/mysql_chargeBillingAuto.php?userID=".$row["id"]."&type=".$_POST["type"];

	$body = "SMSAPI Хэрэглэгчийн цэнэглэлт<br/>Хэрэглэгчийн id:".$row["id"]."<br/>".$userIdentity."<br/>Цэнэглэх дүн:".$charge."₮<br/>Автомат цэнэглэлт хийх линк:".$link;

	if(sendEmailVerification(ADMIN_EMAIL, "Цэнэглэлт", $body)){
		echo "OK";
	}
	else {
		echo "FAIL";
	}
}
?>