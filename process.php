<?php
require_once "constants.php";
require_once "functions.php";

if(isset($_POST["token"]) && isset($_POST["phone"]) && isset($_POST["msg"]) && isset($_POST["action"])){
	//echo $_POST["token"].", ".$_POST["phone"].", ".$_POST["msg"].", ".$_POST["action"];
	switch($_POST["action"]){
		case "sms_send":
			send_sms($_POST["phone"], $_POST["msg"], SERVER_ADDRESS);
			break;
	}
}
?>