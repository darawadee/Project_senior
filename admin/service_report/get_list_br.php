<?php 

require '../../config_DB/DB_connect.php';
$array_mount = array(
		"01" => "ม.ค.",
		"02" => "ก.พ.",
		"03" => "มี.ค.",
		"04" => "เม.ย.",
		"05" => "พ.ค.",
		"06" => "มิ.ย.",
		"07" => "ก.ค.",
		"08" => "ส.ค.",
		"09" => "ก.ย.",
		"10" => "ต.ค.",
		"11" => "พ.ย.",
		"12" => "ธ.ค."
	);
$year = (!isset($_POST['year'])) ? date('Y') : $_POST['year'];
$m = array_search($_POST['month'],$array_mount);



if($_POST['type'] == 'ยืม'){
	$sql = "SELECT borrow_table.borrow_id,user_acount.sudent_id,CONCAT(user_acount.fname,' ',user_acount.lname,' ',user_acount.class,'/',user_acount.sec) AS name , borrow_table.borrow_date FROM `borrow_table` INNER JOIN user_acount ON(borrow_table.ref_user_id=user_acount.sudent_id) WHERE `br_status` >= 3 and `borrow_date`LIKE '%{$m}-{$year}%'";
?>
<table class='table' id='table_br_new'>
	<thead>
	<tr>
		<th>ชื้อ</th>
		<th>อุปกรณ์ที่ยืม</th>
		<th>วันที่ยืม</th>
		
	</tr>
	</thead>
	<tbody>

<?php

	if($res = mysqli_query($connect,$sql)){
		while ($row = mysqli_fetch_assoc($res)) {
			echo "<tr>";
				echo "<td>{$row['name']}</td>";
				echo "<td>". get_item_by_brID($row['borrow_id'],$row['sudent_id'],$connect) ."</td>";
				echo "<td>{$row['borrow_date']}</td>";
			echo "</tr>";
			//ar_dump($row);
			//echo "<td>5</td><td>5</td><td>5</td>";
		}


	}

?>

	</tbody>
</table>
<?php
}elseif($_POST['type'] == 'คืน'){
?>
<table class='table' id='table_br_new'>
	<thead>
	<tr>
		<th>ชื้อ</th>
		<th>อุปกรณ์ที่คืน</th>
		<th>วันที่ยืม</th>
		
	</tr>
	</thead>
	<tbody>

<?php
	$sql = "SELECT borrow_table.borrow_id,user_acount.sudent_id,CONCAT(user_acount.fname,' ',user_acount.lname,' ',user_acount.class,'/',user_acount.sec) AS name , borrow_table.return_date FROM `borrow_table` INNER JOIN user_acount ON(borrow_table.ref_user_id=user_acount.sudent_id) WHERE `br_status` >= 3 and `borrow_date`LIKE '%{$m}-{$year}%'";
	
	if($res = mysqli_query($connect,$sql)){
		while ($row = mysqli_fetch_assoc($res)) {
			echo "<tr>";
				echo "<td>{$row['name']}</td>";
				echo "<td>". get_item_by_brID($row['borrow_id'],$row['sudent_id'],$connect) ."</td>";
				echo "<td>{$row['return_date']}</td>";
			echo "</tr>";
			//ar_dump($row);
			//echo "<td>5</td><td>5</td><td>5</td>";
		}


	}


}
?>
	</tbody>
</table>

<?php

?>






<?php
function get_item_by_brID($br_id,$user_id,$connect){
		$sql = "SELECT * FROM `borrow_table` INNER JOIN borrow_detail ON (borrow_table.borrow_id=borrow_detail.ref_borrow_id) INNER JOIN sport_inventory ON (borrow_detail.item_id=sport_inventory.item_id) WHERE borrow_table.ref_user_id = '{$user_id}' and borrow_table.borrow_id = '{$br_id}'";
		$item_and_amount = array();
		if($res = mysqli_query($connect, $sql)){
			while ($row = mysqli_fetch_assoc($res)) {
				$item_and_amount[] = $row['item_name']." ".$row['item_amount']." ชิ้น";
			}
		}

		return implode(' , ', $item_and_amount);
	}

?>


