<?php
include "mysql_config.php";
include_once "functions.php";
include_once "constants.php";
include_once "variables.php";

if(isset($_POST["email"]) && isset($_POST["pass"])){
	$query = "SELECT * FROM user WHERE email='".$_POST["email"]."' AND password='".$_POST["pass"]."' AND isactive=1";
	$result = $conn->query($query);
	if(mysqli_num_rows($result)>0){
		echo "<OK>:1";
	}
	else {
		$query = "INSERT IGNORE INTO user (email, password, ip, lastlogged, signedup) VALUES ('".$_POST["email"]."', '".$_POST["pass"]."', '".get_client_ip()."', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'), DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'))";
		if($result = $conn->query($query)){
			$userID = mysqli_insert_id($conn);
			
			$query = "INSERT IGNORE INTO apikey (userID, token, credit) VALUES(".$userID.", '".bin2hex(random_bytes(16))."', 10)";
			if($conn->query($query)){
				
				$query = "INSERT INTO validater (value, state, type) VALUES ('".$userID."', 0, 0)";
				if($result = $conn->query($query)){
					$domain = $_SERVER['SERVER_NAME']!="localhost"?$_SERVER['SERVER_NAME']:$_SERVER['SERVER_NAME']."/smsapi";

					$link = $protocol."://".$domain."/?emailverifier=".$userID;

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
		else {
			echo "FAIL 3";
		}
	}
}
?>