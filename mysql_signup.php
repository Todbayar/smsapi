<?php
include "mysql_config.php";
include_once "functions.php";
include_once "constants.php";
include_once "variables.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "./PHPMailer/src/Exception.php";
require_once "./PHPMailer/src/PHPMailer.php";
require_once "./PHPMailer/src/SMTP.php";

if(isset($_POST["email"]) && isset($_POST["pass"])){
	$token = bin2hex(random_bytes(16));
	$query = "INSERT IGNORE INTO user (email, password, ip, token, lastlogged, signedup) VALUES ('".$_POST["email"]."', '".$_POST["pass"]."', '".get_client_ip()."', '".$token."', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'), DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'))";
	if($result = $conn->query($query)){
		$query = "INSERT INTO validater (type, user, token) VALUES (0, ".mysqli_insert_id($conn).", '".$token."')";
		if($result = $conn->query($query)){
			$link = $protocol."://".$domain."/smsapi/?token=".$token;
			$body = "Сайн байна уу? Энэ өдрийн мэндийг хүргье.<br/>Та энд <a href=\"".$link."\">Баталгаажуулах</a> дээр дарж SMSAPI.MN-рүү нэвтрэх имейлээ баталгаажуулна уу";
			echo sendEmailVerification($_POST["email"], "Баталгаажуулалт", $body);
		}
		else {
			echo "FAIL 1";
		}
	}
	else {
		echo "FAIL 2";
	}
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