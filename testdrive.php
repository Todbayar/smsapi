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
		
		if(response=="OK"){
			var credit = parseInt($(".testdrive_credit").text())-1;
			$(".testdrive_credit").text(credit);
			$(".get-quote .btn").text("Кредит: "+credit);
			$(".testdrive_msg").show();
	   	}
		else {
			$(".testdrive_error").show();
		}
	});
}

function massSmsTextSend(token){
	$(".preloader").removeClass("preloader-deactivate");
	const phones = $("textarea[name='mass_sms_phones']").val();
	const msg = $("textarea[name='mass_sms_message']").val();
	const vPhones = phones.split(";");
	var vPhonesCount = vPhones.length;
	vPhones.forEach(function(phone){
		console.log("<massSmsTextSend>:"+phone);
		const vPhone = phone.trim();
		const patternPhone = /^\d+$/i;
		if(vPhone!="" && patternPhone.test(vPhone)){
			$.post("process.php", {"token":token, "phone":vPhone, "msg":msg, "action":"sms_text_send"}).done(function(response){
				console.log("<testSmsTextSend_res>:"+response);
				vPhonesCount--;
				if(vPhonesCount==0){
				   $(".preloader").addClass("preloader-deactivate");
			   	}
				if(response=="OK"){
					var credit = parseInt($(".testdrive_credit").text())-1;
					$(".testdrive_credit").text(credit);
					$(".get-quote .btn").text("Кредит: "+credit);
					$(".mass_sms_msg").show();
				}
				else {
					$(".mass_sms_error").show();
				}
			});
	   	}
	});
}
	
var tmpIndex = 0;
function switchTab(index){
	$(".tabList .tab").eq(tmpIndex).css("background","#1A76D1");
	$(".tabList .tab").eq(index).css("background","#3892eb");
	switch(index){
		case 0:
			$(".row.testdrive").show();
			$(".row.masssms").hide();
			break;
		case 1:
			$(".row.testdrive").hide();
			$(".row.masssms").show();
			break;
	}
	tmpIndex = index;
}
</script>

<?php
$query = "SELECT * FROM user LEFT JOIN apikey ON user.id=apikey.userID WHERE user.id=".$_COOKIE["userID"];
$result = $conn->query($query);
$row = mysqli_fetch_array($result);
?>

<style>
.tabList {
	display: flex;
	padding: 5px;
}
.tabList .tab {
	background: #1A76D1;
	color: #fff;
    padding: 4px 15px;
    border-top-left-radius: 5px;
	border-top-right-radius: 5px;
    font-size: 14px;
	cursor: pointer;
}
</style>

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
							<div class="tabList">
								<div class="tab" style="background: #3892eb" onClick="switchTab(0)">Туршилтаар шалгах</div>
								<div class="tab" style="margin-left: 5px" onClick="switchTab(1)">Масс SMS</div>
							</div>
							<!--test drive-->
							<div class="row testdrive" style="margin-left: 5px">
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
								<div class="testdrive_msg" style="margin-top: 10px; display: none">Амжилттай илгээлээ. Хянах цэсрүү орж дэлгэрэнгүйг харна уу.</div>
								<div class="testdrive_error" style="margin-top: 10px; display: none; color: red">Алдаа гарлаа!</div>
							</div>
							<!--mass sms-->
							<div class="row masssms" style="margin-left: 5px; display: none">
								<div class="form-group" style="width: 95%">
									<i class="icofont-phone"></i>
									<textarea name="mass_sms_phones" rows="7" placeholder="Хүлээн авагчдын утасны дугаарууд (дугаарууд хооронд '; цэг таслал')"></textarea>
									<div>Утасны дугааруудыг оруулах жишээ:99213557;80104547;90000602</div>
								</div>
								<div class="form-group message" style="width: 95%">
									<i class="fa fa-pencil"></i>
									<textarea name="mass_sms_message" rows="7" placeholder="Текст оруулах (160 ascii/latin тэмдэгт)" maxlength="160"></textarea>
								</div>
								<div class="form-group button" style="width: 95%">	
									<button type="submit" class="btn primary" onClick="massSmsTextSend('<?php echo $row["token"]; ?>')">
										<i class="fa fa-send"></i>Илгээх
									</button>
								</div>
								<div class="mass_sms_msg" style="margin-top: 10px; display: none">Амжилттай илгээлээ. Хянах цэсрүү орж дэлгэрэнгүйг харна уу.</div>
								<div class="mass_sms_error" style="margin-top: 10px; display: none; color: red">Алдаа гарлаа!</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>