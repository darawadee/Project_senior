<?php 
session_start();
include '../config_DB/DB_connect.php';
//var_dump($_SESSION);



?>

<table class="table table-hover">
	<?php foreach ($_SESSION['item_cart'] as $item_id => $amount) {
		$sql = "SELECT `item_name`,`item_img` FROM `sport_inventory` WHERE `item_id` = '{$item_id}' LIMIT 1";
		$res = mysqli_query($connect, $sql);
		$row = mysqli_fetch_assoc($res);
	?>
		<tr>
			<td><img style="width: 80px;height: 80px;" src="img_item/<?=$row['item_img'] ?>" ></td>
			<td><?=$row['item_name'] ?></td>
			<td><?=$amount?> ชิ้น</td>
		</tr>

	<?php } if(count($_SESSION['item_cart'])==0){echo "<center><h3>ไม่มีรายการ</h3></center>";}?>

</table>