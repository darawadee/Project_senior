<?php 
	session_start();
	
	include '../config_DB/DB_connect.php';
	$user_id   = $_SESSION['data_user']['sudent_id'];
	$item_type = $_POST['data'][0]['value'];
	$content   = $_POST['data'][1]['value'];
	$date 	   = date("d-m-Y H:i:s");
	 //echo $user_id." ".$item_type." ".$content;

	$sql_insert = "INSERT INTO `request_item_table`( `item_type`, `request_content`, `user_id_ref`,`date`) VALUES ('{$item_type}','{$content}','{$user_id}','{$date}')";

	//echo $sql_insert;
	if (mysqli_query($connect, $sql_insert)) {
		echo "ส่งคำร้องสำเร็จ";
	}else{
		echo "ส่งคำร้องผิดพลาด";
	}
	 
?>