<?php
function send_sms($phone, $msg){
	$answer = shell_exec(sprintf("C://wamp64/www/sms_gateway/pyapp/sms_gateway/sms_gateway.py %s %s", $phone, $msg));
	echo $answer;
}
?>