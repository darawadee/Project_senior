<?php 
	require '../../config_DB/DB_connect.php';
	$word = $_POST['word'];
	$word = explode(" ",$word )[0];
if($_POST['method'] == 'user'){
	
	
	$sql = "SELECT CONCAT(user_acount.fname,' ',user_acount.lname) as name , user_acount.class , user_acount.sec, IF(user_acount.gender='M','ชาย','หญิง') as sex FROM `user_acount` INNER JOIN user_type on (user_acount.user_type=user_type.user_type) WHERE user_type.type = '{$word}' ";


?>
<table class="table" id="table_user">
	<thead>
	<tr>
		<th>ลำดับ</th>
		<th>ชื่อ</th>
		<th>ชั้น</th>
		<th>เพศ</th>
	</tr>
	</thead>
	<tbody>
<?php
	$index = 1;
	if($res = mysqli_query($connect , $sql )){
		while ($row = mysqli_fetch_assoc($res)) {
		echo "<tr>";
			echo "<td>{$index}</td>";
			echo "<td>{$row['name']}</td>";
			echo "<td>{$row['class']}/{$row['sec']}</td>";
			echo "<td>{$row['sex']}</td>";
		echo "</tr>";
		$index++;
		}
	}

?>
	<tbody>
</table>

<?php 
} elseif($_POST['method'] == 'item'){
	
?>
<table class="table" id="table_user">
	<thead>
	<tr>
		<th>รหัสอุปกรณ์</th>
		<th>รูป</th>
		<th>ชื่อ อุปกรณ์</th>
		<th>จำนวนทั้งหมด</th>
		<th>จำนวนคงเหลือ</th>
		<th>จำนวนที่ชำรุด</th>
	</tr>
	</thead>
	<tbody>
<?php 
	$sql = "SELECT * FROM `sport_inventory` INNER JOIN sport_type ON(sport_inventory.item_type = sport_type.sport_type_id) WHERE sport_type.sport_type = '{$word}'";

	if($res = mysqli_query($connect,$sql)){
		while ($row = mysqli_fetch_assoc($res)) {
			echo "<tr>";
				echo "<td>{$row['item_id']}</td>";
				echo "<td><img src='../img_item/{$row['item_img']}' style='width: 70px;height: 70px;'></td>";
				echo "<td>{$row['item_name']}</td>";
				echo "<td>{$row['item_all']}</td>";
				echo "<td>{$row['item_total']}</td>";
				echo "<td>{$row['item_bad']}</td>";

			echo "</tr>";
		}
	}
?>
	</tbody>

</table>
<?php }else{
	echo "else";

} ?>
<script type="text/javascript">
	$(function(){
		$('#table_user').DataTable();
	});
</script>