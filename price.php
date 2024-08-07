<?php
include_once "constants.php";
?>

<script>
function topup(type){
	$(".preloader").removeClass("preloader-deactivate");
	
	$.post("mysql_billing.php", {"type":type}).done(function(response){
		$(".preloader").addClass("preloader-deactivate");
		
		if(response!="FAIL"){
			$("body").css("overflow-y", "hidden");
			window.scrollTo(0, 0);
			$(".popup.billing").show();
			
			console.log("<topup>:"+response);
			
			const userBilling = JSON.parse(response);
			$("#billing_number").html("Хэрэглэгчийн id: <b><?php echo $_COOKIE["userID"]; ?></b>");
			$("#billing_title").html(userBilling.identity);
			$("#billing_price").text("Төлөх дүн:"+userBilling.price+"₮");
			$(".btn.billing_submit").attr("href","javascript:chargeBilling("+type+")");
	   	}
		else {
			alert("Алдаа гарлаа, та дахин оролдоно уу!");
		}
	});
}
	
function chargeBilling(type){
	console.log("<chargeBilling>");
	
	/*document.getElementsByClassName('popup billing')[0].style.display='none'; document.body.style.overflowY='auto';*/
	
	$('.preloader').removeClass('preloader-deactivate');
	
	$.post("mysql_chargeBilling.php", {"type":type}).done(function(response){
		console.log("<chargeBilling>:"+response);
		$('.preloader').addClass('preloader-deactivate');
		
		if(response=="OK"){
	   		$(".billing_msg").show();
	   	}
		else {
			alert("Алдаа гарлаа, та дахин оролдоно уу!");
	   	}
	});
}
</script>

<!-- Pricing Table -->
<section class="pricing-table section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>SMS api үнийн жагсаалт</h2>
					<img src="img/separator.png" style="width:250px; height:2px">
					<p><i class="icofont-info-circle" style="color: #ffa718"></i> 1 SMS = 1 Кредит</p>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- Single Table -->
			<div class="col-lg-4 col-md-12 col-12">
				<div class="single-table">
					<!-- Table Head -->
					<div class="table-head">
						<div class="icon">
							<img src="img/logo_sms_small.png" />
						</div>
						<h4 class="title">Starter plan</h4>
						<h4 class="title"><?php echo floor(CREDIT_STARTER/PRICE_PER_CREDIT); ?> кредит</h4>
						<div class="price">
							<p class="amount"><?php echo CREDIT_STARTER; ?>₮<span>/<?php echo PRICE_PER_CREDIT; ?>₮</span></p>
						</div>
					</div>
					<div class="table-bottom">
						<?php
						if(isset($_COOKIE["userID"])){
						?>
						<a class="btn" href="javascript:topup(1)">Цэнэглэх</a>
						<?php
						}
						else {
						?>
						<a class="btn" href="./?page=signin.php">Цэнэглэх</a>
						<?php
						}
						?>
					</div>
					<!-- Table Bottom -->
				</div>
			</div>
			<!-- End Single Table-->
			<!-- Single Table -->
			<div class="col-lg-4 col-md-12 col-12">
				<div class="single-table">
					<!-- Table Head -->
					<div class="table-head">
						<div class="icon">
							<img src="img/logo_sms_small.png" />
						</div>
						<h4 class="title">Mid plan</h4>
						<h4 class="title"><?php echo floor(CREDIT_MID/PRICE_PER_CREDIT); ?> кредит</h4>
						<div class="price">
							<p class="amount"><?php echo CREDIT_MID; ?>₮<span>/<?php echo PRICE_PER_CREDIT; ?>₮</span></p>
						</div>
					</div>
					<div class="table-bottom">
						<?php
						if(isset($_COOKIE["userID"])){
						?>
						<a class="btn" href="javascript:topup(2)">Цэнэглэх</a>
						<?php
						}
						else {
						?>
						<a class="btn" href="./?page=signin.php">Цэнэглэх</a>
						<?php
						}
						?>
					</div>
					<!-- Table Bottom -->
				</div>
			</div>
			<!-- End Single Table-->
			<!-- Single Table -->
			<div class="col-lg-4 col-md-12 col-12">
				<div class="single-table">
					<!-- Table Head -->
					<div class="table-head">
						<div class="icon">
							<img src="img/logo_sms_small.png" />
						</div>
						<h4 class="title">Pro plan</h4>
						<h4 class="title"><?php echo floor(CREDIT_PRO/PRICE_PER_CREDIT); ?> кредит</h4>
						<div class="price">
							<p class="amount"><?php echo CREDIT_PRO; ?>₮<span>/<?php echo PRICE_PER_CREDIT; ?>₮</span></p>
						</div>	
					</div>
					<div class="table-bottom">
						<?php
						if(isset($_COOKIE["userID"])){
						?>
						<a class="btn" href="javascript:topup(3)">Цэнэглэх</a>
						<?php
						}
						else {
						?>
						<a class="btn" href="./?page=signin.php">Цэнэглэх</a>
						<?php
						}
						?>
					</div>
					<!-- Table Bottom -->
				</div>
			</div>
			<!-- End Single Table-->
		</div>	
	</div>	
</section>	
<!--/ End Pricing Table -->