<?php 
	require '../../config_DB/DB_connect.php';
	//var_dump($connect);

	$return = array();
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

	$array_get_user = array();
	$array_get_item = array();
	$array_box = array();
	$year = (isset($_POST['year'])) ? $_POST['year'] : date("Y");

	$sql_get_user = "SELECT CONCAT(user_type.type,' ',COUNT(*),' คน') as user , COUNT(*) as amount FROM `user_acount` INNER JOIN user_type on user_acount.user_type = user_type.user_type WHERE `user_type`.`user_type` != 3 GROUP BY `user_type`.`user_type`";

	if($res = mysqli_query($connect,$sql_get_user)){
		while ($row = mysqli_fetch_assoc($res)) {
			$array_get_user[] = array($row['user'],$row['amount']*1);
		}
		$return['data_user'] = $array_get_user;
	}
	$res = null;
	$sql_get_item_type = "SELECT CONCAT(sport_type.sport_type , ' ',count(*), ' ชิ้น' ) as name , count(*) as amount FROM `sport_inventory` INNER JOIN sport_type on(sport_inventory.item_type=sport_type.sport_type_id) GROUP BY `item_type`";

	if($res = mysqli_query($connect, $sql_get_item_type)){
		while ($row = mysqli_fetch_assoc($res)) {
			$array_get_item[] = array($row['name'],$row['amount']*1);
		}
		$return['data_item'] = $array_get_item;
	}

	$array_br     = array();
	$array_return = array();

	$array_br['name'] = "ยืม";
	$array_return['name'] = "คืน";
	foreach ($array_mount as $index_mount => $value) {
		$sql_br_report = "SELECT * FROM `borrow_table` WHERE  `borrow_date` LIKE '%-{$year}%' AND `borrow_date` LIKE '%-{$index_mount}-%' AND `br_status` >= 3";

		$sql_return_report = "SELECT * FROM `borrow_table` WHERE  `borrow_date` LIKE '%-{$year}%' AND `borrow_date` LIKE '%-{$index_mount}-%' AND `br_status` >= 4";

		if($stm1 = mysqli_query($connect, $sql_br_report)){
			$array_br['data'][] = mysqli_num_rows($stm1);

		}

		if($stm2 = mysqli_query($connect, $sql_return_report)){
			$array_return['data'][] = mysqli_num_rows($stm2);

		}


		//echo $sql_return_report.";"."<br>";
	}
		$stm1 = null;
		$stm2 = null;
		array_push($array_box, $array_br);
		array_push($array_box, $array_return);
		$return['borrow_report'] = $array_box;


	$sql_item_popular = "SELECT sport_inventory.item_name as name ,count(*) as y FROM `borrow_detail` INNER JOIN sport_inventory on(borrow_detail.item_id=sport_inventory.item_id) GROUP BY `borrow_detail`.`item_id`";
	$array_box = array();
	if($res = mysqli_query($connect, $sql_item_popular)){
		while ($row = mysqli_fetch_assoc($res)) {
			$array_box[] = array("name" =>$row['name'],"y"=>$row['y']*1);
		}

		$return['item_popular'] = $array_box;
	}

	
	echo json_encode($return);
?>