<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php 
		require 'config_DB/DB_connect.php';
		$config = parse_ini_file("config_DB/sport_type.ini"); 
	?>
<style type="text/css">
	.myinput{
		width: 80px;
	}
	.myinputfile{
		width: 150px;
	}
</style>
</head>
<body>

<div class="row">
	<div class="col-md-12"  style="height: 400px;overflow: scroll;">
		<table class="table">

			<tr>
				<td>รหัสอุปกรณ์</td>
				<td>ชื่อ</td>
				<td>รูป</td>
				<td>จำนวนทั้งหมด</td>
				<td>จำนวนคงเหลือ</td>
				<td>ชนิดอุปกรณ์</td>
				<td></td>
			</tr>
			<?php 
				$select_item = "SELECT * FROM `sport_inventory`  ORDER BY `item_type`";
				if($res = mysqli_query($connect, $select_item)){
					
					while ($row = mysqli_fetch_assoc($res)) {
						echo "<tr id='{$row['item_id']}'>";
						echo "<td>{$row['item_id']}</td>";
						echo "<td>{$row['item_name']}</td>";
						echo "<td><img src='img_item/{$row['item_img']}' style='width: 50px;height: 50px;'></td>";
						echo "<td>{$row['item_all']}</td>";
						echo "<td>{$row['item_total']}</td>";
						echo "<td>{$config[$row['item_type']]}</td>";
						echo "<td>";
						echo "<a href='#' class='edit-btn btn btn-warning' p-code='{$row['item_id']}'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>";
						echo "<a href='#' class='delete-btn btn btn-danger' p-code='{$row['item_id']}'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span>";
						echo"</td>";
						echo "</tr>";

						echo "<tr id='edit{$row['item_id']}' style='display:none'>";
						echo "<form id='form{$row['item_id']}' enctype=multipart/form-data>";
						echo "<td> <input class='myinput' value='{$row['item_id']}'></input> </td>";
						echo "<td> <input class='myinput' value='{$row['item_name']}'></input> </td>";
						echo "<td> <input class='' type='file' ></input> </td>";
						echo "<td> <input class='myinput' value='{$row['item_all']}'></input> </td>";
						echo "<td> <input class='myinput' value='{$row['item_total']}'></input> </td>";
						echo "<td> <select>";
						foreach ($config as $key => $value) {
				       	 	echo "   <option value="."{$key} >".$value."</option>";
					   	}
						echo"</select></td>";
						echo "<td>";
						echo "<a href='#' class='save-btn btn btn-success' p-code='{$row['item_id']}'><span class='glyphicon glyphicon-floppy-save' aria-hidden='true'></span></a>";
						echo "<a href='#' class='remove-btn btn btn-danger' p-code='{$row['item_id']}'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></a>";
						echo "</td>";

						
						echo "</form></tr>";	
					}	
					
				}

			?>
		</table>

	</div>
	<a href="sport_equipment.php" class="btn btn-success">
		
		 <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		เพิ่มอุปกรณ์
	</a>
</div>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		$(".delete-btn").click(function(event) {
			var conf = confirm("คุณแรชน่ใจหรือไม่");
			var p_code = $(this).attr("p-code");
			if(conf == true){
				$.post('delete_item.php', 
				{
					p_code: p_code
				}, 
					function() {
					/*optional stuff to do after success */
					}
				).done(function(data){
					if(data == true){
						$("#"+p_code).remove();
						$("#edit"+p_code).remove();
					}else{
						alert("ลบไม่สำเร็จ");
					}
				});	
			}
			
			//alert(p_code);
			//console.log(conf);
		});
		$(".edit-btn").click(function(event) {
			var p_code = $(this).attr('p-code');
			//alert(p_code);
			$("#edit"+p_code).show();

		});

		//hide edit
		$(".remove-btn").click(function(event) {
			var p_code = $(this).attr('p-code');
			//alert(p_code);
			$("#edit"+p_code).hide();

		});

		//hide edit
	});
</script>
</html>