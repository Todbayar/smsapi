<?php
include "mysql_config.php";
include_once "functions.php";
include_once "variables.php";
include_once "constants.php";

if(isset($_COOKIE["userID"]) && isset($_POST["type"])){
	$query = "SELECT * FROM user WHERE id=".$_COOKIE["userID"];
	$result = $conn->query($query);
	$row = mysqli_fetch_array($result);
		
	$userIdentifier = "id: ".$_COOKIE["userID"];
	
	$userIdentity = $row["email"]; 
	if(!is_null($row["phone"])){
		if(!is_null($row["name"])) $userIdentity = "нэр: ".$row["name"]."<br/>";
		$userIdentity = "утасны дугаар: ".$row["phone"];
	}
	$userIdentity = "Хэрэглэгч<br/>".$userIdentity;
	
	$charge = 0;
	switch($_POST["type"]){
		case 1:
			$charge = 7000;
			break;
		case 2:
			$charge = 10000;
			break;
		case 3:
			$charge = 20000;
			break;
	}
	
	$user = new stdClass();
	$user->identity = $userIdentity;
	$user->price = $charge;
	echo json_encode($user);
}
?>