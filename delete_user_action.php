<?php 
	require 'config_DB/DB_connect.php';

	if (count($_POST)>0) {
		//var_dump($_POST);
		$sql ="DELETE FROM `user_acount` WHERE `sudent_id` = '{$_POST['uid']}' ";

		if(mysqli_query($connect, $sql)){
			echo "true";
		}else{
			echo  "false";
		}
	}else {
		die;
	}

 ?>