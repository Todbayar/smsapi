<script>
function testSmsTextSend(){
	console.log("<testSmsTextSend>");
	const phone = $("input[name='testdrive_phone']").val();
	const msg = $("textarea[name='testdrive_message']").val();
	/*$.post("process.php", {"token":"<?php echo $_COOKIE["userToken"]; ?>", "phone":phone, "msg":msg, "action":"sms_send"}).done(function(response){
		console.log("<testSmsTextSend>:"+response);
	});*/
	console.log("<input_msg>:"+msg);
	$.post("process.php", {"token":"<?php echo $_COOKIE["userToken"]; ?>", "phone":phone, "msg":msg, "action":"sms_send"}).done(function(response){
		console.log("<testSmsTextSend>:"+response);
	});
}
</script>

<section class="news-single section">
	<div class="container">
		<div class="row" style="max-width: 540px; margin-left: auto; margin-right: auto">
			<div class="col-lg-8 col-12">
				<div class="row">
					<div>Таньд кредит байна: <a class="round_corner_blue" style="color: #fff">10</a></div>
				</div><br/>
				<div class="row">
					<div class="col-12">
						<div class="signin-form">
							<h2>Туршилтаар шалгах</h2><br/>
							<div class="row" style="margin-left: 5px">
								<div class="form-group" style="width: 95%">
									<i class="icofont-phone"></i>
									<input type="tel" name="testdrive_phone" placeholder="Хүлээн авагчийн утасны дугаар" required="required">
								</div>
								<div class="form-group message" style="width: 95%">
									<i class="fa fa-pencil"></i>
									<textarea name="testdrive_message" rows="7" placeholder="Текст оруулах (160 ascii/latin тэмдэгт)" maxlength="160"></textarea>
								</div>
								<div class="form-group button">	
									<button type="submit" class="btn primary" onClick="testSmsTextSend()">
										<i class="fa fa-send"></i>Илгээх
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>