<table class="table">
	<tr>
		<th>ลำดับ</th>
		<th>ชื้อ</th>
		<th>สถานะผู้ใช้</th>
		<th>คำร้อง</th>
	</tr>
<?php 

require '../../config_DB/DB_connect.php';
$date = ($_POST['date'] != '') ? date("d-m-Y",strtotime($_POST['date'])) : date("d-m-Y");
// var_dump($_POST);
//var_dump($date);


$sql = "SELECT CONCAT(IF(user_acount.gender = 'M', 'นาย','นาวสาว'),user_acount.fname,' ',user_acount.lname) as name , IF(user_acount.user_type = 1,'นักเรียน','อาจารย์') as user_status , request_item_table.request_content as content FROM `request_item_table` INNER JOIN user_acount ON (request_item_table.user_id_ref=user_acount.sudent_id) INNER JOIN user_type ON user_acount.user_type = user_type.user_type WHERE date LIKE '%{$date}%'";

if($res = mysqli_query($connect,$sql)){

}else{
	echo "error";
	//die();
}
// strtotime($_POST['date']);
$i=0;
while ($row = mysqli_fetch_assoc($res)) {
	$i++;

?>
<tr>
	<td><?=$i?></td>
	<td><?=$row['name']?></td>
	<td><?=$row['user_status']?></td>
	<td><textarea style="height: 100px;"><?=$row['content']?></textarea></td>
</tr>
<?php 
}

?>
</table>