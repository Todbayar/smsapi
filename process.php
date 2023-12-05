<?php
include "mysql_config.php";
require_once "constants.php";
require_once "functions.php";

if(isset($_POST["token"]) && isset($_POST["phone"]) && isset($_POST["action"])){
	if(isUserValid($_POST["token"])){
		if(getUserCredit($_POST["token"])>0){
			switch($_POST["action"]){
				case "sms_text_send":
					echo send_sms($_POST["phone"], $_POST["msg"], $_POST["token"]);
					break;
				case "sms_phone_verifier":
					$code = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
					$msg = "Batalgaajuulah code:".$code;
					echo send_sms($_POST["phone"], $msg, $_POST["token"]);
					break;
			}
		}
		else {
			echo "FAIL_CREDIT";
		}	
	}
	else {
		echo "FAIL_TOKEN_OR_USER";
	}
}
?>