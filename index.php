<?php
include "mysql_config.php";
include "language/mon.php";

if(isset($_GET["token"])){
	$query = "SELECT * FROM validater WHERE token='".$_GET["token"]."' LIMIT 1";
	$result = $conn->query($query);
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$userID = $row["user"];
		$query = "UPDATE user SET isactive=1 WHERE id=".$userID;
		if($conn->query($query)){
			$query = "DELETE FROM validater WHERE user=".$userID." AND type=0";
			if($conn->query($query)){
				$cookieTime = time() + (86400 * 30);	//30 day, 86400=1
				setcookie("userID", $userID, $cookieTime, "/");
				header("location:./");
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
											//else {
											?>
											<li class="testdrive"><a href="?page=testdrive.php">Шалгах</a></li>
											<li class="instructions"><a href="?page=instructions.php">Заавар</a></li>
											<li class="profile"><a href="?page=profile">Хэрэглэгч</a></li>
											<li class="price"><a href="?page=price.php">Цэнэглэх</a></li>
											<?php
											//}
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
    </body>
</html>