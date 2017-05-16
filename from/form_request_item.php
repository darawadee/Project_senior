<!DOCTYPE html>
<html>
<head>
	<?php 
	 include '../config_DB/DB_connect.php';

	 $sql_select_type = "SELECT * FROM `sport_type`";
	 if($res = mysqli_query($connect, $sql_select_type)){

	 }else{
	 	die();
	 }
	?>
</head>
<body>
	<center>
		<h1 style="margin-bottom: 30px;">แบบยื่นขออุปกรณ์กีฬา</h1>	
	</center>
	<form method="post">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-6"><h4 style="text-align: right;"> ประเภทอุปกรณ์กีฬา </h4></div>
					<div class="col-md-6">
						<select class="form-control" name="item-type">
						<?php while ($row = mysqli_fetch_assoc($res)) {
						?>
							<option value="<?=$row['sport_type_id'] ?>"><?=$row['sport_type'] ?></option>
						<?php }?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6"><h4 style="text-align: right;"> รายละเอียดคำร้องขอ </h4></div>
					<div class="col-md-6">
						<textarea class="form-control" rows="8" id="comment" required="" name="content"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="text-align: right;">
						<button class="btn btn-info" style="margin-top: 20px;">ส่งแบบคำร้อง</button>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>

	</form>

</body>
<script type="text/javascript">
	$(function(){
		$("form").submit(function(event) {
			
			var data = $("form").serializeArray();
			$.post('service/save_request_item.php', {data: data}, function(data) {
				
				alert(data);
			});

		});
	});
</script>
</html>