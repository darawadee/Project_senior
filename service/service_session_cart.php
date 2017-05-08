<?php
session_start();
include '../config_DB/DB_connect.php';
// $connect is connect database

	if($_POST['method'] == 'set'){
		$_SESSION['note'] = $_POST['note'];
		$id_item = $_POST['item_id'];
		$amount  = $_POST['amount'];
		$sqlcheck = "SELECT `item_total` FROM `sport_inventory` WHERE `item_id` = '{$id_item}'";

		$res = mysqli_query($connect, $sqlcheck);

		$data =  mysqli_fetch_assoc($res);

		$amount_in_DB = $data['item_total'];
		//echo "ยืม {$amount} มีอยู่ {$amount_in_DB}";
		if($amount_in_DB*1 >= $amount){
			if(isset($_SESSION['item_cart'][$id_item])){
				if($_SESSION['item_cart'][$id_item]+$amount <= $amount_in_DB){
					$_SESSION['item_cart'][$id_item]+=$amount;
					//var_dump($_SESSION['item_cart']);
					echo "true";
				}else{
					echo "เกินจำนวนที่จำกัด";
					
				}
			}else{
				$_SESSION['item_cart'][$id_item] = $amount;
				// var_dump($_SESSION['item_cart']);
				echo "true";
			}
			
			
		}else{
			echo 'ไม่สามารถยืมได้';
		}

	}elseif($_POST['method'] == 'get'){
		echo count($_SESSION['item_cart']);
	}else{
		echo 'error';
	}
?>