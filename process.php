<?php
require_once "constants.php";
require_once "functions.php";

if(isset($_POST["token"])){
	echo $_POST["token"];
	/*switch($_POST["action"]){
		case "sms_send":
			send_sms($_POST["phone"], $_POST["msg"], SERVER_ADDRESS);
			break;
	}*/
}
?>