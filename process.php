<?php
require_once "config.php";
require_once "functions.php";

if((isset($_SERVER["PHP_AUTH_USER"]) && $_SERVER["PHP_AUTH_USER"]==AUTH_USER) && (isset($_SERVER["PHP_AUTH_PW"]) && $_SERVER["PHP_AUTH_PW"]==AUTH_PASS)){
	switch($_POST["action"]){
		case "sms_send":
			send_sms($_POST["phone"], $_POST["msg"], SERVER_ADDRESS);
			break;
	}
}
?>