<?php 
	require '../../config_DB/DB_connect.php';
	//var_dump($connect);

	$return = array();

	$array_get_user = array();
	$array_get_item = array();

	$sql_get_user = "SELECT CONCAT(user_type.type,' ',COUNT(*)) as user , COUNT(*) as amount FROM `user_acount` INNER JOIN user_type on user_acount.user_type = user_type.user_type WHERE `user_type`.`user_type` != 3 GROUP BY `user_type`.`user_type`";

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
	echo json_encode($return);
?>