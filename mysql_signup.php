<?php
include "mysql_config.php";
include_once "functions.php";

if(isset($_POST["email"]) && isset($_POST["pass"])){
	$token = bin2hex(random_bytes(16));
	$query = "INSERT INTO user (email, password, ip, token, lastlogged, signedup) VALUES ('".$_POST["email"]."', '".$_POST["pass"]."', '".get_client_ip()."', '".$token."', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'), DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'))";
	if($result = $conn->query($query)){
		$query = "INSERT INTO validater (type, user, token) VALUES (0, ".mysqli_insert_id($conn).", '".$token."')";
		if($result = $conn->query($query)){
			echo "OK";
		}
		else {
			echo "FAIL 1";
		}
	}
	else {
		echo "FAIL 2";
	}
}
?>