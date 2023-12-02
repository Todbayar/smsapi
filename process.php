<?php
include "mysql_config.php";
require_once "constants.php";
require_once "functions.php";

if(isset($_POST["token"]) && isset($_POST["phone"]) && isset($_POST["msg"]) && isset($_POST["action"])){
	$patternText = "/[a-zA-Z0-9]/i";
	$patternPhone = "/^\d+$/i";
	if(preg_match($patternText, $_POST["msg"])>0 && preg_match($patternPhone, $_POST["phone"])>0){
		$query = "SELECT * FROM apikey AS a LEFT JOIN user AS u ON a.userID=u.id WHERE a.token='".$_POST["token"]."' AND u.isactive=1";
		$result = $conn->query($query);
		if(mysqli_num_rows($result)>0){
			$row = mysqli_fetch_array($result);
			if($row["credit"]>0){
				switch($_POST["action"]){
					case "sms_text_send":
						echo send_sms($_POST["phone"], $_POST["msg"], $_POST["token"]);
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
	else {
		echo "FAIL_PHONE_OR_ASCII";
	}
}
?>