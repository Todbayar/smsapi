<?php
function send_sms($phone, $msg, $address){
	//sending to remote python script with ngrok
	$fp = stream_socket_client($address, $errno, $errstr, 30);
	if (!$fp) {
		echo "$errstr ($errno)";
	} else {
		$json = json_encode(array("action"=>"sms", "phone"=>$phone, "msg"=>$msg));
		fwrite($fp, $json);
		fwrite($fp, "close");
		while (!feof($fp)) {
			echo fgets($fp, 1024);
		}
		fclose($fp);
	}
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>