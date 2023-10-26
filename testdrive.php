<?php
include "mysql_config.php";
?>

<script>
function testSmsTextSend(token){
	$(".preloader").removeClass("preloader-deactivate");
	
	const phone = $("input[name='testdrive_phone']").val();
	const msg = $("textarea[name='testdrive_message']").val();
	
	console.log("<testSmsTextSend_token>:"+token);
	console.log("<testSmsTextSend_msg>:"+msg);
	
	$.post("process.php", {"token":token, "phone":phone, "msg":msg, "action":"sms_text_send"}).done(function(response){
		$(".preloader").addClass("preloader-deactivate");
		
		console.log("<testSmsTextSend_res>:"+response);
		
		if(response=="successclosedOK"){
			$(".testdrive_credit").text(parseInt($(".testdrive_credit").text())-1);
			$(".testdrive_msg").show();
	   	}
		else {
			alert("Алдаа гарлаа, та дахин оролдоно уу!");
		}
	});
}
</script>

<?php
$query = "SELECT * FROM user LEFT JOIN apikey ON user.id=apikey.userID WHERE user.id=".$_COOKIE["userID"];
$result = $conn->query($query);
$row = mysqli_fetch_array($result);
?>

<section class="news-single section">
	<div class="container">
		<div class="row" style="max-width: 540px; margin-left: auto; margin-right: auto">
			<div class="col-lg-8 col-12">
				<div class="row">
					<div>Таньд кредит байна: <a class="round_corner_blue testdrive_credit" style="color: #fff"><?php echo $row["credit"]; ?></a></div>
				</div><br/>
				<div class="row">
					<div class="col-12">
						<div class="signin-form">
							<h2>Туршилтаар шалгах</h2><br/>
							<div class="row" style="margin-left: 5px">
								<div class="form-group" style="width: 95%">
									<i class="icofont-phone"></i>
									<input type="tel" name="testdrive_phone" placeholder="Хүлээн авагчын утасны дугаар" required="required">
								</div>
								<div class="form-group message" style="width: 95%">
									<i class="fa fa-pencil"></i>
									<textarea name="testdrive_message" rows="7" placeholder="Текст оруулах (160 ascii/latin тэмдэгт)" maxlength="160"></textarea>
								</div>
								<div class="form-group button" style="width: 95%">	
									<button type="submit" class="btn primary" onClick="testSmsTextSend('<?php echo $row["token"]; ?>')">
										<i class="fa fa-send"></i>Илгээх
									</button>
								</div>
								<div class="testdrive_msg" style="margin-top: 10px; display: none">Амжилттай илгээлээ.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>