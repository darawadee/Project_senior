<?php 
	$_itemp_id = $_POST['itemp_id'];
	session_start();
	include '../config_DB/DB_connect.php';
	// echo $_itemp_id;
	$array_day = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");

	$get_time = date("D");
	$class = $_SESSION['data_user']['class'];
	$sec = $_SESSION['data_user']['sec'];

	$sql_check_role_date = "SELECT `teach_day` FROM `subjects_table` WHERE `class` = '{$class}' AND sec = '{$sec}'";

	if($stm = mysqli_query($connect,$sql_check_role_date)){
		$teach_day = mysqli_fetch_assoc($stm)['teach_day'];

		if($get_time == $array_day[$teach_day]){
			//echo "true";
			$sql_select_itemp = "SELECT `item_id`,`item_name`,`item_total`,`item_img` FROM `sport_inventory` WHERE `item_id` = '{$_itemp_id}' LIMIT 1";
			//echo $sql_select_itemp;
			if($res = mysqli_query($connect, $sql_select_itemp)){
				$row = mysqli_fetch_assoc($res);	
				echo json_encode($row);	
			}
		}else{
			echo "กรุณายืมวันที่มีการเรียนการสอนเท่านั้น";
		}
	}


?>