<?php
require_once "config.php";
require_once "functions.php";

if((isset($_SERVER["PHP_AUTH_USER"]) && $_SERVER["PHP_AUTH_USER"]==AUTH_USER) && (isset($_SERVER["PHP_AUTH_PW"]) && $_SERVER["PHP_AUTH_PW"]==AUTH_PASS)){
	/*switch($_POST["action"]){
		case "sms_send":
			send_sms($_POST["phone"], $_POST["msg"]);
			break;
	}*/
	$fp = stream_socket_client("tcp://0.tcp.ap.ngrok.io:12576", $errno, $errstr, 30);
	if (!$fp) {
		echo "$errstr ($errno)<br />\n";
	} else {
		fwrite($fp, "GET / HTTP/1.0\r\nHost: www.smsapi.mn\r\nAccept: */*\r\n\r\n");
		while (!feof($fp)) {
			echo fgets($fp, 1024);
		}
		fclose($fp);
	}
}
?>