<?php
include "mysql_config.php";
include_once "functions.php";
include_once "constants.php";
include_once "variables.php";

if(isset($_POST["email"]) && isset($_POST["pass"])){
	$query = "SELECT * FROM user WHERE email='".$_POST["email"]."' AND password='".$_POST["pass"]."'";
	$result = $conn->query($query);
	if(mysqli_num_rows($result)>0){
		echo "<OK>:1";
	}
	else {
		$token = bin2hex(random_bytes(16));
		$query = "INSERT IGNORE INTO user (email, password, ip, token, lastlogged, signedup) VALUES ('".$_POST["email"]."', '".$_POST["pass"]."', '".get_client_ip()."', '".$token."', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'), DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'))";
		if($result = $conn->query($query)){
			$query = "INSERT INTO validater (type, user, token) VALUES (0, ".mysqli_insert_id($conn).", '".$token."')";
			if($result = $conn->query($query)){
				$link = $protocol."://".$domain."/smsapi/?token=".$token;
				$body = "Сайн байна уу? Энэ өдрийн мэндийг хүргье.<br/>Та энд <a href=\"".$link."\">Баталгаажуулах</a> дээр дарж SMSAPI.MN-рүү нэвтрэх имейлээ баталгаажуулна уу";
				echo sendEmailVerification($_POST["email"], "Баталгаажуулалт", $body);
			}
			else {
				echo "FAIL 1";
			}
		}
		else {
			echo "FAIL 2";
		}	
	}
}
?>