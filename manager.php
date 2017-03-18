<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php 
		require 'config_DB/DB_connect.php';
		$config = parse_ini_file("config_DB/sport_type.ini"); 
	?>

</head>
<body>

<div class="row">
	<div class="col-md-12" style=" height: auto;">
		<table class="table">

			<tr>
				<td>รหัสอุปกรณ์</td>
				<td>ชื่อ</td>
				<td>รูป</td>
				<td>จำนวนทั้งหมด</td>
				<td>จำนวนคงเหลือ</td>
				<td>ชนิด</td>
			</tr>
			<?php 
				$select_item = "SELECT * FROM `sport_inventory`";
				if($res = mysqli_query($connect, $select_item)){
					
					while ($row = mysqli_fetch_assoc($res)) {
						echo "<tr>";
						echo "<td>{$row['item_id']}</td>";
						echo "<td>{$row['item_name']}</td>";
						echo "<td><img src='img_item/{$row['item_img']}' style='width: 50px;height: 50px;'></td>";
						echo "<td>{$row['item_all']}</td>";
						echo "<td>{$row['item_total']}</td>";
						echo "<td>{$config[$row['item_type']]}</td>";
						echo "</tr>";	
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
</html>