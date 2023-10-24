<?php
include_once "variables.php";
?>
<section class="services home" style="padding-top:20px; padding-bottom:20px">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>API заавар</h2>
					<img src="img/separator.png" style="width:250px; height:2px">
					<p>SMS api хэрхэн ашиглах тухай заавар</p>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- Start Single Service -->
			<div class="single-service" style="padding-left:15px; padding-right:15px">
				<h4>SMS текст илгээх</h4>
				<p>Доорх өгөгдлийг <a style="color:#e83e8c"><?php echo $protocol; ?>://<?php echo $domain!="localhost"?$domain:$domain."/sms_gateway"; ?>/process.php</a>-руу <a style="color:#1A76D1; font-weight: bold">post</a> хүсэлт илгээх.</p><br/>
				<h5>form datas</h5><br/>
				<table class="instruction">
					<tr>
						<th width="30%">Параметер</th>
						<th width="30%">Утга</th>
						<th width="40%">Тайлбар</th>
					</tr>
					<tr>
						<td>token</td>
						<td>640a9e663331********************</td>
						<td>API Key бүртгүүлхэд үүснэ</td>
					</tr>
					<tr>
						<td>action</td>
						<td>sms_text_send</td>
						<td>Мессеж төрөл</td>
					</tr>
					<tr>
						<td>phone</td>
						<td>99213557</td>
						<td>хүлээн авагчын утасны дугаар</td>
					</tr>
					<tr>
						<td>msg</td>
						<td>sain baina uu? ene bol test sms msg</td>
						<td>
							Хүлээн авагчруу илгээх текст мессеж.<br/>
							<a style="color:#e83e8c">Анхаарах! Крилл (UTF-8) үсгээр мессеж илгээх боломжгүй.</a> 
							Зөвхөн латин (ASCII)-аар илгээнэ үү.
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h5>Жишээ хэрэглээ</h5>
					<h5>JQuery</h5>
					<img src="img/separator.png" style="width:250px; height:2px">
					<img src="img/jquery.jpg">
				</div>
			</div>
		</div>
	</div>
</section>