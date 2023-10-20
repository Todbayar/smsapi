<?php
function send_sms($phone, $msg, $address){
	$fp = stream_socket_client($address, $errno, $errstr, 30);
	if (!$fp) {
		echo "$errstr ($errno)";
	} else {
		$json = json_encode(array("action"=>"sms", "phone"=>$phone, "msg"=>$msg));
//		fwrite($fp, "GET / HTTP/1.0\r\nHost: www.smsapi.mn\r\nAccept: */*\r\n\r\n");
		fwrite($fp, $json);
		fwrite($fp, "close");
		while (!feof($fp)) {
			echo fgets($fp, 1024);
		}
		fclose($fp);
	}
}
?>