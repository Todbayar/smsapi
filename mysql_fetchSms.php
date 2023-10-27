<?php
include "mysql_config.php";
include_once "constants.php";

if(isset($_POST["token"]) && $_POST["token"]==TOKEN_MASTER){
	$query = "SELECT * FROM validater WHERE type=3";
	$result = $conn->query($query);
	
	$objArr = array();
	while($row = mysqli_fetch_array($result)){
		$obj = json_decode($row["value"]);
		$objMsg = new stdClass();
		$objMsg->phone = $obj->phone;
		$objMsg->msg = $obj->msg;
		$objArr[] = $objMsg;
	}
	
	echo json_encode($objArr);
}
?>