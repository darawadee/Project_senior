<?php
session_start(); 
include '../config_DB/DB_connect.php';
// var_dump($_SESSION);
// die();
$user_id = $_SESSION["data_user"]["sudent_id"];
$_SESSION["item_cart"];
$date = date("d-m-Y H:i:s");
$status = true;
if(count($_SESSION["item_cart"]) > 0){
	

		$create_id_br = "INSERT INTO `borrow_table` ( `ref_user_id`, `borrow_date`,`br_type`) VALUES ('{$user_id}', '{$date}','{$_SESSION['note']}');";
		//echo $create_id_br;
		//die;
		if(mysqli_query($connect, $create_id_br)){
			$get_br_id = "SELECT `borrow_id` FROM `borrow_table` WHERE `ref_user_id` = '{$user_id}' ORDER BY `borrow_id` DESC LIMIT 1";
			
			if($res_get_br_id = mysqli_query($connect, $get_br_id) ){
				
				$data_get_br_id = mysqli_fetch_assoc($res_get_br_id);
				$br_id = $data_get_br_id['borrow_id'];
				$massage = "";
				foreach ($_SESSION["item_cart"] as $item_id => $amount) {
					$sql_select_item = "SELECT `item_total` FROM `sport_inventory` WHERE `item_id` = '{$item_id}' LIMIT 1";	
					$res = mysqli_query($connect, $sql_select_item);
					$data = mysqli_fetch_assoc($res);
					if($data['item_total'] >= $amount ){
						
						$sql_add_item = "INSERT INTO `borrow_detail` (`detail_id`, `ref_borrow_id`, `item_id`, `item_amount`) VALUES (NULL, '{$br_id}', '{$item_id}', '{$amount}');";

						if(mysqli_query($connect, $sql_add_item)){

							unset($_SESSION["item_cart"][$item_id]);
						}else{
							$status = false;
							break;
							//echo "error";
						}
					}else{
						$status = false;
						$massage = "มีอุปกรณ์บางอย่างไม่สามารถทำการยืมได้เนื่องจาก อุปกรณ์ไม่พอ";
					}
				}
				if($status){
					echo "true";
				}else{
					echo "บันทึกข้อมูลเรียบร้อย {$massage}";
				}
			}else{
				echo "ระบบขัดข้องกรุณาลองใหม่";
				die();
			}
		}else{
			echo "ระบบขัดข้องกรุณาลองใหม่";
			//die();
		}
		//echo $create_id_br."\n";
		
	

}else{
	echo "ไม่มีรายการ";
}

// array(2) {
//   ["data_user"]=>
//   array(11) {
//     ["sudent_id"]=>
//     string(10) "1234567883"
//     ["fname"]=>
//     string(18) "สามารถ"
//     ["lname"]=>
//     string(12) "ใจดี"
//     ["email"]=>
//     string(12) "sa@gmail.com"
//     ["class"]=>
//     string(1) "2"
//     ["sec"]=>
//     string(1) "3"
//     ["gender"]=>
//     string(1) "M"
//     ["username"]=>
//     string(2) "sa"
//     ["password"]=>
//     string(2) "sa"
//     ["telephone"]=>
//     string(10) "0965333810"
//     ["user_type"]=>
//     string(1) "1"
//   }
//   ["item_cart"]=>
//   array(3) {
//     ["I003"]=>
//     string(2) "10"
//     ["I005"]=>
//     string(2) "12"
//     ["I007"]=>
//     string(2) "25"
//   }
// }
?>
