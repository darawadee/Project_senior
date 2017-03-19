<?php 
	require 'config_DB/DB_connect.php';
	$return = array();
	if (isset($_POST['p_code'])) {
		$sql = "DELETE FROM `sport_inventory`WHERE `item_id` = '{$_POST['p_code']}' ;";
		if(mysqli_query($connect, $sql)){
			$return['status']=true;
		}else{
			$return['status']=false;
		}
	}else{
		$return['status']=false;
	}
	
	echo $return['status'];
 ?>