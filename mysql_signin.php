<?php
include "mysql_config.php";
include_once "functions.php";
include_once "constants.php";
include_once "variables.php";

if(isset($_POST["email"]) && isset($_POST["pass"])){
	$query = "SELECT * FROM user WHERE email='".$_POST["email"]."' && password='".$_POST["pass"]."'";
	$result = $conn->query($query);
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_array($result);
		$cookieTime = time() + (86400 * 30);	//30 day, 86400=1
		setcookie("userID", $row["id"], $cookieTime, "/");
		setcookie("userToken", $row["token"], $cookieTime, "/");
		$query = "UPDATE user SET lastlogged=DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i') WHERE id=".$row["id"];
		@$conn->query($query);
		echo "OK";
	}
	else {
		echo "FAIL";
	}
}
?>