<script>
function showSignup(){
	$(".signin-form").hide();
	$(".signup-form").show();
}
	
function showSignin(){
	$(".signin-form").show();
	$(".signup-form").hide();
}
	
function signup(){
	const email = $("input[name='user_signup_email']").val();
	const pass1 = $("input[name='user_signup_password1']").val();
	const pass2 = $("input[name='user_signup_password2']").val();
	const patternEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/i;
	
	if(pass1==pass2 && patternEmail.test(email)){
		$(".preloader").removeClass("preloader-deactivate");
	   	$.post("mysql_signup.php", {"email":email, "pass":pass1}).done(function(response){
			$(".preloader").addClass("preloader-deactivate");
			console.log("<signup>:"+response);
			if(response=="<OK>:1"){
				$(".signup_msg").html("<h6>Та аль хэдийн бүртгэлтэй байна. Буцах дээр дарна уу.</h6>");
		   	}
			else if(response!="FAIL"){
				console.log("<res>:"+response);
				if(response==1){
					$(".sign-msg").show();
					$(".signup-form").hide();
					$(".signin-form").hide();  
			   	}
				else {
					alert("Таны бүртгүүлэхэд алдаа гарлаа! (1)");   
			   	}
		   	}
			else {
				alert("Таны бүртгүүлэхэд алдаа гарлаа! (2)");
			}
		});
   	}
	else if(pass1!=pass2){
		alert("Нууц үгээ зөв болгож засна уу!");
	}
	else if(!patternEmail.test(email)) {
	   alert("Имейлээ зөв болгож засна уу!");
   	}
}
	
function signin(){
	const email = $("input[name='user_signin_email']").val();
	const pass = $("input[name='user_signin_password']").val();
	const patternEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/i;
	
	if(patternEmail.test(email) && pass!=""){
		$.post("mysql_signin.php", {"email":email, "pass":pass}).done(function(response){
			console.log("<signin>:"+response);
			if(response=="OK"){
				window.location.href = "./";
	   		}
			else {
				alert("Та шалгаад дахин оролдоно уу!");
			}
		});
   	}
	else {
		alert("Та шалгаад дахин оролдоно уу!");
	}
}
</script>

<section class="news-single section">
	<div class="container">
		<div class="row" style="max-width: 540px; margin-left: auto; margin-right: auto">
			<div class="col-lg-8 col-12">
				<div class="row">
					<div class="col-12">
						<div class="signin-form">
							<h2>Имейлээр нэвтрэх</h2><br/>
							<div class="row" style="margin-left: 5px">
								<div class="form-group" style="width: 95%">
									<i class="fa fa-envelope"></i>
									<input type="text" name="user_signin_email" placeholder="Имейл" required="required" type="email" maxlength="128">
								</div>
								<div class="form-group" style="width: 95%">
									<i class="icofont-ui-password"></i>
									<input name="user_signin_password" placeholder="Нууц үг" required="required" type="password">
								</div>
								<div class="form-group button" style="width: 95%">
									<button type="submit" class="btn primary" onClick="signin()">Нэвтрэх</button>
									<a href="javascript:showSignup()" style="float: right">Шинээр бүртгүүлэх</a>
								</div>
							</div>
						</div>
						<div class="signup-form" style="display: none">
							<h2>Имейлээр бүртгүүлэх</h2><br/>
							<div class="row" style="margin-left: 5px">
								<div class="form-group" style="width: 95%">
									<i class="fa fa-envelope"></i>
									<input type="text" name="user_signup_email" placeholder="Имейл" required="required" type="email" maxlength="128">
								</div>
								<div class="form-group" style="width: 95%">
									<i class="icofont-ui-password"></i>
									<input name="user_signup_password1" placeholder="Нууц үг" required="required" type="password">
								</div>
								<div class="form-group" style="width: 95%">
									<i class="icofont-ui-password"></i>
									<input name="user_signup_password2" placeholder="Нууц үг давтах" required="required" type="password">
								</div>
								<div class="form-group button" style="width: 95%">
									<button type="submit" class="btn primary" onClick="signup()">Бүртгүүлэх</button>
									<a href="javascript:showSignin()" style="float: right">Буцах</a>
								</div>
								<div class="signup_msg" style="margin-top: 10px"></div>
							</div>
						</div>
						<div class="sign-msg" style="display: none">
							<h6>Таны имейлрүү баталгаажуулах линк илгээсэн. Та имейлээ шалгана уу.</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>