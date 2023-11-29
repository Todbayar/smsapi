<script>
$(document).ready(function(){
	fetchList();
	setInterval(function(){
		fetchList();
	}, 8000);
});
	
function fetchList(){
	$.post("mysql_list.php").done(function(response){
		const objArr = JSON.parse(response);
		objArr.forEach(function(obj, i, arr){
			var vDatetime = arr[i].created;
			var vState = "Waiting";
			if(obj.state==1){
				vState = "Sent";
				vDatetime = arr[i].sent;
		   	}
			else if(obj.state==2){
				vState = "Error";
			}
			   
			if($("table.list tr#"+arr[i].aid).length>0){
				$("table.list tr#"+arr[i].aid+" td").eq(3).html(vState);
				if(obj.state==1){
					$("table.list tr#"+arr[i].aid+" td").eq(3).css("color","green");
			   	}
				else if(obj.state==2){
					$("table.list tr#"+arr[i].aid+" td").eq(3).css("color","red");
				}
		   	}
			else {
				$("table.list tr").eq(0).after("<tr id='"+arr[i].aid+"'><td>"+arr[i].aid+"</td><td>"+arr[i].phone+"</td><td>"+arr[i].msg+"</td><td>"+vState+"</td><td>"+vDatetime+"</td></tr>")	
				if(obj.state==1){
					$("table.list tr#"+arr[i].aid+" td").eq(3).css("color","green");
			   	}
				else if(obj.state==2){
					$("table.list tr#"+arr[i].aid+" td").eq(3).css("color","red");
				}
			}
		});
	});
}
</script>

<section class="services home" style="padding-top:20px; padding-bottom:20px">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>live SMS жагсаалт</h2>
					<img src="img/separator.png" style="width:250px; height:2px">
					<p>Сүүлийн 30 sms-ийг харуулна</p>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- Start Single Service -->
			<div class="single-service" style="padding-left:15px; padding-right:15px">
				<table class="list">
					<tr>
						<th width="12%">№</th>
						<th width="25%">Утас</th>
						<th width="35%">Утга</th>
						<th width="13%">Төлөв</th>
						<th width="13%">Огноо</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>