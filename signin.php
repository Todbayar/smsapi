<script>
function showSignup(){
	$(".signin-form").hide();
	$(".signup-form").show();
}
	
function showSignin(){
	$(".signin-form").show();
	$(".signup-form").hide();
}
</script>
<section class="news-single section">
	<div class="container">
		<div class="row" style="max-width: 540px; margin-left: auto; margin-right: auto">
			<div class="col-lg-8 col-12">
				<div class="row">
					<div class="col-12">
						<div class="signin-form">
							<h2>Имейлээр нэвтрэх</h2>
							<div class="row" style="margin-left: 5px">
								<div class="form-group" style="width: 95%">
									<i class="icofont-ui-email"></i>
									<input type="text" name="user_signin_email" placeholder="Имейл" required="required">
								</div>
								<div class="form-group" style="width: 95%">
									<i class="icofont-ui-password"></i>
									<input type="text" name="user_signin_password" placeholder="Нууц үг" required="required">
								</div>
								<div class="form-group button">	
									<button type="submit" class="btn primary">OK</button>
									<a href="javascript:showSignup()" style="margin-left: 10px">Шинээр бүртгүүлэх</a>
								</div>
							</div>
						</div>
						<div class="signup-form" style="display: none">
							<h2>Имейлээр бүртгүүлэх</h2>
							<div class="row" style="margin-left: 5px">
								<div class="form-group" style="width: 95%">
									<i class="icofont-ui-email"></i>
									<input type="text" name="user_signup_email" placeholder="Имейл" required="required">
								</div>
								<div class="form-group" style="width: 95%">
									<i class="icofont-ui-password"></i>
									<input type="text" name="user_signup_password1" placeholder="Нууц үг" required="required">
								</div>
								<div class="form-group" style="width: 95%">
									<i class="icofont-ui-password"></i>
									<input type="text" name="user_signup_password2" placeholder="Давтан Нууц үг" required="required">
								</div>
								<div class="form-group button">	
									<button type="submit" class="btn primary">OK</button>
									<a href="javascript:showSignin()" style="margin-left: 10px">Буцах</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>