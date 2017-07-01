<?php 
// echo "<pre>";
// var_dump($_POST);
include '../config_DB/DB_connect.php';
include '../lib/php/helper.php';
$item_not_null = array();
$item_return_bad = array();
$date = data_thai(date("d-m-Y H:i:s"));
$return = array();
// check data not null add array

// var_dump($_POST);

foreach ($_POST['data'] as $key => $value) {
	if($value['value'] != null || $value['value']!= ""){
		$item_not_null[] = array(
			"item_id" => str_replace("return-item-", "", $value['name']) ,
			"amount"  => $value['value']
		);
	}
}

foreach ($_POST['item_bad'] as $key => $value) {
	
	$item = str_replace("return-bad-", "", $value['name']);
	$amount = $value['value'];
	$sql_item_bad = "UPDATE `sport_inventory` SET `item_total`= `item_total` - '{$amount}',`item_bad`= `item_bad` + '{$value['value']}' WHERE  `item_id` = '{$item}'";

	mysqli_query($connect,$sql_item_bad);
	//echo $sql_item_bad."\n";
}




//var_dump($item_return_bad);

// check data not null add array 

$status_check_limit = true;
// check item limit
foreach ($item_not_null as $key => $value) {
	//echo $value['item_id']."\n";
	$sql_check_limit = "SELECT * FROM `borrow_detail` WHERE `item_id` = '{$value['item_id']}' AND `ref_borrow_id` = '{$_POST['br_id']}' ";

	// echo $sql_check_limit."\n";
	if($res = mysqli_query($connect,$sql_check_limit )){
		while ($row = mysqli_fetch_assoc($res)) {
			if($value['amount'] > $row['item_amount']){
				$status_check_limit = false;
				break;
			}
		}
	}
}
$res = null;

if($status_check_limit && count($item_not_null) != 0){
	// update item return
	foreach ($item_not_null as $key => $array_item) {
		$sql_update = "UPDATE `borrow_detail` SET `item_return_amount`= `item_return_amount`+'{$array_item['amount']}'  WHERE `ref_borrow_id` = '{$_POST['br_id']}' and `item_id` = '{$array_item['item_id']}'";

		$sql_return_stock = "UPDATE `sport_inventory` SET `item_total`= `item_total`+ {$array_item['amount']}  WHERE `item_id` = '{$array_item['item_id']}'";
		if(mysqli_query($connect, $sql_update)){
			mysqli_query($connect, $sql_return_stock);
		}
	}


	$sql_check_item = "SELECT * FROM `borrow_detail` WHERE `item_amount` != `item_return_amount` and `ref_borrow_id` = '{$_POST['br_id']}'";
	if($res = mysqli_query($connect, $sql_check_item)){
		if(mysqli_num_rows($res) != 0){
			$update_status_br = "UPDATE `borrow_table` SET `br_status`='4' WHERE `borrow_id` = '{$_POST['br_id']}'"; 
			mysqli_query($connect,$update_status_br);
			$return['status'] = true;
			$return['message'] = "เสร็จสิ้น";
			
		}else{
			$update_status_br = "UPDATE `borrow_table` SET `return_date`= '{$date}',`br_status`='5' WHERE `borrow_id` = '{$_POST['br_id']}'"; 
			mysqli_query($connect,$update_status_br);
			$return['status'] = true;
			$return['message'] = "เสร็จสิ้น";
			
		}


	}
	// update item return
	
}elseif( count($item_not_null)==0){
	$return['status'] = false;
	$return['message'] = "ไม่ได้ทำการป้อนจำนวน";
	
}else{
	$return['status'] = false;
	$return['message'] = "ป้อนจำนวนเกิน การยืมกรุณาลองให่ม";
	
}

echo json_encode($return);

// check item limit


?>