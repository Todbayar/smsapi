<?php
include "mysql_config.php";
require_once "constants.php";
require_once "functions.php";

if(isset($_POST["token"]) && isset($_POST["phone"]) && isset($_POST["msg"]) && isset($_POST["action"])){
	$query = "SELECT * FROM apikey AS a LEFT JOIN user AS u ON a.userID=u.id WHERE a.token='".$_POST["token"]."' AND u.isactive=1";
	$result = $conn->query($query);
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_array($result);
		if($row["credit"]>0){
			
			switch($_POST["action"]){
				case "sms_text_send":
					if(send_sms($_POST["phone"], $_POST["msg"], SERVER_ADDRESS)==true){
						$query = "UPDATE apikey SET credit=credit-1 WHERE userID=".$row["userID"];
						if($conn->query($query)){
							echo "OK";
						}
						else {
							echo "FAIL 1";
						}
					}
					break;
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
?>