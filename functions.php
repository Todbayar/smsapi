<?php
include_once "constants.php";
include_once "variables.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "./PHPMailer/src/Exception.php";
require_once "./PHPMailer/src/PHPMailer.php";
require_once "./PHPMailer/src/SMTP.php";

function send_sms($phone, $msg, $token){
	global $conn;
	$query = "SELECT * FROM action WHERE token='".$token."' AND phone='".$phone."' AND msg='".$msg."' AND state=0";
	$result = $conn->query($query);
	if(mysqli_num_rows($result)==0){
		$query = "INSERT INTO action (type, phone, msg, token, created) VALUES (0, '".$phone."', '".$msg."', '".$token."', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'))";
		if($conn->query($query)){
			echo "OK";
		}
		else {
			if(mysqli_errno($conn)==1062){
				echo "FAIL_DUPLICATE";
			}
			else {
				echo "FAIL_REGISTER";
			}
		}
	}
	else {
		echo "FAIL_REGISTERED";
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

function sendEmailVerification($emailReceiver, $title, $body, $isDebug=null){
	//email
	$smtp_host = "smtp.gmail.com";
	$smtp_port = 587;									//tls
	$smpt_secure_type = "tls";
	
	global $domain, $smtp_username, $smtp_password;
	
	$mail = new PHPMailer(true);
	try {
		//Server settings
//		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP(); 
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		
		//Send using SMTP
		$mail->Host       = $smtp_host;                     		//Set the SMTP server to send through
		$mail->Port       = $smtp_port;                             //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->SMTPSecure = $smpt_secure_type;						//ssl/tls
		
		$mail->Username   = $smtp_username;                     	//SMTP username
		$mail->Password   = $smtp_password;                         //SMTP password
		
		//Recipients
		$mail->setFrom($smtp_username, $domain);
		$mail->addAddress($emailReceiver, "");      //Add a recipient

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->CharSet = "UTF-8";
		$mail->Subject = $title;
		
		$mail->Body    = $body;
		$mail->send();
		
		if($isDebug=="CONSOLE"){
			?>
			<script>console.log("Message has been sent to:<?php echo $emailReceiver; ?>");</script>
			<?php
		}
		else if($isDebug=="ECHO"){
			echo "Message has been sent to:{$emailReceiver}<br/>";
		}
		else {
			return true;	
		}
	}
	catch(Exception $e){
		if($isDebug=="CONSOLE"){
			?>
			<script>console.log("<?php echo "Message could not be sent. Mailer Error:{$mail->ErrorInfo}"; ?>");</script>
			<?php
		}
		else if($isDebug=="ECHO"){
			"Message could not be sent. Mailer Error:{$mail->ErrorInfo}<br/>";
		}
		else {
			return false;
		}
	}
}
?>