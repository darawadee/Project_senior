<?php 
session_start();
include '../config_DB/DB_connect.php';
//var_dump($_POST);
$status = true;
$date = date("d-m-Y H:i:s");
if(check_pass($_POST['password'])){

	$select_item_by_br = "SELECT * FROM `borrow_detail` WHERE `ref_borrow_id` = '{$_POST['br_id']}';";
 		if($_POST['num_status'] == '2'){
		 	if($res = mysqli_query($connect, $select_item_by_br)){
		 		mysqli_autocommit($connect, FALSE);
		 		mysqli_begin_transaction($connect);
		 		while ($data = mysqli_fetch_assoc($res)) {
		 			$item_id = $data['item_id'];
		 			$sql_cut_ = "UPDATE `sport_inventory` SET`item_total`= `item_total` - '{$data['item_amount']}'  WHERE `item_id` = '{$item_id}'";
		 			if( mysqli_query($connect, $sql_cut_)){

		 				$status = true;
		 			}else{
		 				$status = false;
		 				break;
		 			}
		 		}
		 		if($status){
		 			mysqli_commit($connect);
		 			$sql_update_status = "UPDATE `borrow_table` SET`br_status`= '2' WHERE `borrow_id` = '{$_POST['br_id']}'";
		 			mysqli_autocommit($connect, TRUE);
		 			mysqli_query($connect,$sql_update_status);
		 			echo "อัพเดทสำเร็จ";
		 		}else{
		 			mysqli_rollback($connect);
		 			echo "อัพเดทผิดพลาด";
		 		}
		 	}else{
		 		echo "error";
		 	}
 			
 		}elseif ($_POST['num_status'] == '3'){
 			$sql_update_status = "UPDATE `borrow_table` SET `br_status`='3' WHERE `borrow_id` = '{$_POST['br_id']}'" ;

 			if(mysqli_query($connect, $sql_update_status)){
 				echo "อัพเดทสำเร็จ";
 			}else{
 				echo "อัพเดทผิดพลาด";
 			}

 			
 		}elseif($_POST['num_status'] == '5'){
 			$sql_select_item_id = "SELECT `item_id`,`item_amount` FROM `borrow_detail` WHERE `ref_borrow_id` = '{$_POST['br_id']}'";
 			if($res = mysqli_query($connect,$sql_select_item_id)){
 				while ($row = mysqli_fetch_assoc($res)) {
 					$update_item_master = "UPDATE `sport_inventory` SET `item_total`= `item_total`+ '{$row['item_amount']}'  WHERE `item_id` = '{$row['item_id']}'";
 					mysqli_query($connect,$update_item_master);
 				}
 			}
 			$sql_update_return = "UPDATE `borrow_detail` SET `item_return_amount`= `item_amount`WHERE `ref_borrow_id` = '{$_POST['br_id']}'";
 			if(mysqli_query($connect, $sql_update_return)){
 				$sql_check_return = "SELECT * FROM `borrow_detail` WHERE `item_amount` != `item_return_amount`;";
		 				if($stm = mysqli_query($connect, $sql_check_return)){
		 					if(mysqli_num_rows($stm) > 0 ){
		 						echo "คืนของยังไม่ครบ";
		 					}else{

		 						$sql_update_date_return = "UPDATE `borrow_table` SET `br_status`= '5',`return_date`='{$date}' WHERE  `borrow_id` = '{$_POST['br_id']}'";
		 						if(mysqli_query($connect,$sql_update_date_return)){
			 						echo "คืนอุปกรณ์ครบแล้ว";

		 						}
		 					}
		 				}
 			}

 		}else{
 			echo "ยังไม่มีฟังชั้น";
 		}





}else{
	echo "Password ไม่ถูกต้อง";
}




function check_pass($password){
	if($password === $_SESSION['data_user']['password']){
			return  true;
	}else{
			return  false;
	}
}
?>