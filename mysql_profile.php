<?php
include "mysql_config.php";

if(isset($_COOKIE["userID"]) && isset($_POST["phone"]) && isset($_POST["name"])){
	$query = "UPDATE user SET phone='".$_POST["phone"]."', name='".$_POST["name"]."' WHERE id=".$_COOKIE["userID"];
	if($conn->query($query)){
		echo "OK";
	}
	else {
		echo "FAIL";
	}
}
?>