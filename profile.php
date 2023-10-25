<?php
include "mysql_config.php";
?>

<script>
function profileSave(){
	const phone = $("input[name='profile_phone']").val();
	const name = $("input[name='profile_name']").val();
	$.post("mysql_profile.php", {"phone":phone, "name":name}).done(function(response){
		console.log("<profileSave>:"+response);
		if(response=="OK"){
		   	$(".profile_info").show();
	   	}
	   	else {
			$(".profile_info").text("Та мэдээллээ засаад дахин оруулна уу!");
			$(".profile_info").show();
	   	}
	});
}
</script>

<?php
$query = "SELECT * FROM user WHERE id=".$_COOKIE["userID"];
$result = $conn->query($query);
$row = mysqli_fetch_array($result);
?>
<section class="news-single section">
	<div class="container">
		<div class="row" style="max-width: 540px; margin-left: auto; margin-right: auto">
			<div class="col-lg-8 col-12">
				<div class="row">
					<div class="col-12">
						<div class="signin-form">
							<h2>Хэрэглэгчийн мэдээлэл</h2><br/>
							<div class="row" style="margin-left: 5px">
								<div class="form-group" style="width: 95%">
									Хэрэглэгчийн id: <?php echo $row["id"]; ?>
								</div>
								<div class="form-group" style="width: 95%">
									<i class="fa fa-envelope"></i>
									<input type="tel" name="profile_email" placeholder="Имейл" required="required" value="<?php echo $row["email"]; ?>" readonly>
								</div>
								<div class="form-group" style="width: 95%">
									<i class="icofont-phone"></i>
									<input type="tel" name="profile_phone" placeholder="Утасны дугаар" required="required" value="<?php echo $row["phone"]; ?>">
								</div>
								<div class="form-group" style="width: 95%">
									<i class="icofont-user"></i>
									<input type="tel" name="profile_name" placeholder="Хэрэглэгчийн нэр" required="required" value="<?php echo $row["name"]; ?>">
								</div>
								<div class="form-group button" style="width: 95%">	
									<button type="submit" class="btn primary" onClick="profileSave()">
										<i class="icofont-save"></i>Хадгалах
									</button>
								</div>
								<div class="profile_info" style="margin-top:10px; display: none">Амжилттай халгалагдлаа.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>