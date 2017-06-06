<?php
	
	require '../../config_DB/DB_connect.php';

	$sql = "SELECT user_acount.sudent_id,concat(user_acount.lname,' ',user_acount.lname) as name , borrow_detail.item_amount as num , borrow_table.borrow_date , borrow_table.return_date FROM `user_acount` INNER JOIN borrow_table on(borrow_table.ref_user_id=user_acount.sudent_id) INNER JOIN borrow_detail ON (borrow_table.borrow_id=borrow_detail.ref_borrow_id) INNER JOIN sport_inventory  ON(borrow_detail.item_id=sport_inventory.item_id) WHERE sport_inventory.item_name = '{$_POST['item']}'";

	if($res = mysqli_query($connect,$sql)){

?>
<table class='table' id='table_br_new'>
	<thead>
	<tr>
		<th>ชื้อ</th>
		<th>รหัส</th>
		<th>จำนวน</th>
		<th>วันที่ยืม</th>
		<th>วันที่คืน</th>

		
	</tr>
	</thead>
	<tbody>
<?php		
		while ($row = mysqli_fetch_assoc($res)) {
			echo "</tr>";
				echo "<td>{$row['name']}</td>";
				echo "<td>{$row['sudent_id']}</td>";
				echo "<td>{$row['num']}</td>";
				echo "<td>{$row['borrow_date']}</td>";
				echo "<td>{$row['return_date']}</td>";

			echo "</tr>";
		}
?>
	</tbody>
</table>
<?php
	}

?>