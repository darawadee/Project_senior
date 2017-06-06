<!DOCTYPE html>
<html>
<head>
	<title> </title>
</head>
<body>
<center><h1 style='color: #3333CC'>ระบบรายงาน</center>
<form method="post" action="#">
เลือกวัน <input type="date" id="date_report" name="date_report" /><button type="submit">ค้นหา</button>
</form>
<center>
<table border="1">
		<tr> 
			<td> ผู้ยืม</td>
			<td> อุปกรณ์ที่ยืม</td>
			<td> จำนวนที่ยืม</td>
		</tr>
<?php 
$host = "127.0.0.1";
$user = "root";
$pass = "";
$DB_name = "sports_equipment";
$connect = mysqli_connect($host, $user, $pass, $DB_name);
mysqli_set_charset($connect,"utf8");

if($_SERVER['REQUEST_METHOD'] == "POST"){
		
		$date = $_POST['date_report'];
		$date = date("d-m-Y", strtotime($date));
		echo "วัน/เดือน/ปี ".$date."<br>";

		$sql = "SELECT CONCAT(`user_acount`.`fname`,' ',`user_acount`.`lname`) as name ,sport_inventory.item_name , borrow_detail.item_amount FROM `user_acount` INNER JOIN borrow_table ON (user_acount.sudent_id = borrow_table.ref_user_id) INNER JOIN borrow_detail ON(borrow_table.borrow_id=borrow_detail.ref_borrow_id) INNER JOIN sport_inventory ON (borrow_detail.item_id=sport_inventory.item_id) WHERE borrow_table.borrow_date LIKE '{$date}%'";
		//echo $sql;

		$res = mysqli_query($connect,$sql);
		
	
		while ($row = mysqli_fetch_assoc($res)) {
			echo "<tr>";
				echo "<td>{$row['name']}</td>";
				echo "<td>{$row['item_name']}</td>";
				echo "<td>{$row['item_amount']}</td>";
				//var_dump($row);

			echo "</tr>";
		}

}


?>
</table>
</center>
</body>
</html>


