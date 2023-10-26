<?php
include "mysql_config.php";
include_once "language/mon.php";

if(isset($_GET["emailverifier"])){
	$query = "SELECT * FROM validater WHERE value='".$_GET["emailverifier"]."' AND type=0 LIMIT 1";
	$result = $conn->query($query);
	if(mysqli_num_rows($result) > 0){
		$userID = intval($_GET["emailverifier"]);
		$query = "UPDATE user SET isactive=1 WHERE id=".$userID;
		if($conn->query($query)){
			$query = "DELETE FROM validater WHERE value='".$userID."' AND type=0";
			if($conn->query($query)){
				$cookieTime = time() + (86400 * 30);	//30 day, 86400=1
				setcookie("userID", $userID, $cookieTime, "/");
				header("location:./?page=profile.php");
			}
			else {
				?>
				<script>failVerifyingEmail(1);</script>
				<?php	
			}
		}
		else {
			?>
			<script>failVerifyingEmail(2);</script>
			<?php
		}
	}
	else {
		?>
		<script>failVerifyingEmail(3);</script>
		<?php
	}
}
?>

<!doctype html>
<html>
    <head>
        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Title -->
        <title><?php echo TITLE; ?></title>
		
		<!-- Favicon -->
        <link rel="icon" href="img/logo_sms.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="css/magnific-popup.css">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
		
		<!-- jquery Min JS -->
        <script src="js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="js/easing.js"></script>
		<!-- Color JS -->
		<script src="js/colors.js"></script>
		<!-- Popper JS -->
		<script src="js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="js/steller.js"></script>
		<!-- Wow JS -->
		<script src="js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="js/main.js"></script>
		
		<style>
		.popup {
			position: absolute;
			width: 100%;
			height: 100%;
			/*	background-color: black;*/
			/*	opacity: 0.73;*/
			top: 0;
			left: 0;
			background: url(img/background.png) repeat;
			z-index: 10000;
		}
		
		.popup .container {
			background:#E8E8E8;
			position:absolute;
			border-radius: 10px;
			padding-bottom: 10px;
			top: 10vh;
		/*	box-shadow: 5px 5px 5px lightblue;*/
			left: 0px;
			right: 0px;
			margin-left: auto;
			margin-right: auto;
			opacity: 1.0;
			width: 240px;
		}
			
		.popup .container .header {
			background: transparent;
			height: 20px;
			text-align: center;
			padding: 5px;
			width: 100%;
		}

		.popup .container .message {
			padding: 5px;
			height: 50px;
			width: 230px;
			text-overflow: ellipsis;
			overflow: hidden;
		/*	white-space: nowrap;*/
			text-align: center;
			vertical-align: middle; 
			display: table-cell;
		}
			
		.popup .container .action {
			margin-top: 5px;
			display: flex;
		}

		.popup .container .action button {
			margin-left: auto; 
			margin-right: auto;
		}

		.popup .container .action button i {
			margin-right: 5px;
		}

		.popup .container .close {
			position: absolute; 
			font-size: 20px; 
		/*	color: #FF4649; */
			color: #256d00;
			right: 5px; 
			top: 5px;
			z-index: 10001;
			cursor: pointer;
		/*	box-shadow: 2px 2px 5px lightblue;*/
		}

		.popup .container .error {
			font: normal 12px Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
			color: #FF4649;
			margin-left: 10px;
			margin-right: 10px;
		}

		.popup .container .msg {
			font: normal 12px Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
			margin-left: 10px;
			margin-right: 10px;
		}
		</style>
		
		<script>
		var prevPage = "index.php";
		$(document).ready(function(){
			currentActivePage();
		});
			
		function currentActivePage(){
			let paramString = window.location.href.split('?')[1];
			let queryString = new URLSearchParams(paramString);
			for (let pair of queryString.entries()) {
				if(pair[0]=="page"){
					$("li."+prevPage.substr(0, prevPage.indexOf('.'))).removeClass("active");
					console.log("<test>:"+"li."+pair[1].substr(0, pair[1].indexOf('.')));
					$("li."+pair[1].substr(0, pair[1].indexOf('.'))).addClass("active");
					prevPage = pair[1];
				}
			}
		}
			
		function failVerifyingEmail(errorID){
			alert("Таны имэйлийг баталгаажуулахад алдаа гарлаа! ("+errorID+")");
		}
			
		function copyToClipboardBankAccountNumber(){
			$(".popup.billing #copyToClipboard").css("color","#FFA718");
			var copyText = document.getElementById("account");
			console.log("<copyToClipboardBankAccountNumber>:"+copyText.text);
			navigator.clipboard.writeText(copyText.text);
		}
		</script>
		
    </head>
    <body>
		<!-- Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>
                <div class="indicator"> 
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <!-- End Preloader -->
		
		<!-- Get Pro Button -->
		<ul class="pro-features">
			<a class="get-pro" href="#">FB</a>
		</ul>
	
		<!-- Header Area -->
		<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact" style="display: flex">
								<li style="display: flex; align-items: center">
									<i class="fa fa-phone"></i>
									<a href="tel:+97699213557">(+976)99213557</a>
								</li>
								<li style="display: flex; align-items: center">
									<i class="fa fa-envelope"></i>
									<a href="mailto:misheelgamestudio@gmail.com">misheelgamestudio@gmail.com</a>
								</li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index.php"><img src="img/logo1.png"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<?php
											if(!isset($_COOKIE["userID"])){
											?>
											<li class="index active"><a href="index.php">Нүүр</i></a></li>
											<li class="signin"><a href="?page=signin.php">Нэвтрэх</a></li>
											<?php
											}
											else {
											?>
<!--										<li class="apikey"><a href="?page=apikey.php">Түлхүүр</a></li>-->
											<li class="testdrive"><a href="?page=testdrive.php">Шалгах</a></li>
											<li class="instructions"><a href="?page=instructions.php">Заавар</a></li>
											<li class="profile"><a href="?page=profile.php">Хэрэглэгч</a></li>
											<li class="price"><a href="?page=price.php">Цэнэглэх</a></li>
											<?php
											}
											?>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
		
        <?php
		if(isset($_GET["page"])){
			include $_GET["page"];
		}
		else {
			//home, no sign-in
			include "instructions.php";
			include "price.php";
		}
		?>
		
		<!-- Footer Area -->
		<footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Бидний тухай</h2>
								<!-- Social -->
								<ul class="social">
									<li><a href="#"><i class="icofont-facebook"></i></a></li>
								</ul>
								<!-- End Social -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Footer Top -->
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>© Copyright 2023  |  All Rights Reserved by</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
		<!--/ End Footer Area -->
		
		<div class="popup billing" style="display: none">
			<div class="container" style="width: 320px; top: 5vh">
				<i class="icofont-close-circled close" onClick="javascript:document.getElementsByClassName('popup billing')[0].style.display='none'; javascript:document.body.style.overflowY='auto'"></i>
				<div class="header">Төлбөр төлөх</div>
				<div style="display:block; margin:10px; font-size: 14px">
					<div id="billing_type">Цэнэглэлт</div>
					<div id="billing_number">Хэрэглэгчийн id: <b>1</b></div>
					<div id="billing_title">Чимгээ</div>
					<div id="billing_price" style="font: bold 16px Arial; margin-top: 10px">7000₮</div>
				</div>
				<div>
					<div id="billing_bank" style="font-size: 14px; margin-left: 10px">
						<div style="margin-bottom: 5px">Дараах данс руу илгээнэ үү.</div>
						<div style="margin-bottom: 5px"><a id="name" style="font-size: 16px"><b>Хаан Банк</b></a>-ны данс:</div>
						<div style="margin-bottom: 5px">
							<a id="account" style="font-size: 16px"><b>5020922323</b></a>
							<i id="copyToClipboard" onclick="copyToClipboardBankAccountNumber()" class="icofont-copy-invert" style="margin-left: 5px; font-size: 16px; cursor: pointer"></i>
						</div>
						<div>Хүлээн авагч: <a id="owner" style="font-size: 16px"><b>Тодбаяр Алтанхуяг</b></a></div>
					</div>
					<div style="font-size: 14px; margin-top: 10px; margin-left: 10px">
						<ul>
							<li><a style="text-decoration: underline">Гүйлгээний утга</a> дээр заавал: <b style="color: red">УТАСНЫ ДУГААР</b> оруулна уу.</li>
						</ul>
					</div>
				</div>
				<a class="btn billing_submit" href="" style="width: 100%; margin-top: 10px"><i class="fa fa-send"></i> Илгээх</a>
				<div class="billing_msg" style="display: none">Амжилттай илгээгдлээ, удахгүй цэнэглэлт орох болно.</div>
			</div>
		</div>
    </body>
</html>