<?php 
	require 'config_DB/DB_connect.php';
	// var_dump($_POST);
	// var_dump($_FILES);
	if(isset($_POST['p_name'])){
		if(move_uploaded_file($_FILES["p_img"]["tmp_name"],"img_item/".$_FILES["p_img"]["name"])){
			// echo "Copy/Upload Complete";********************************************************************
			$sql = "INSERT INTO `sport_inventory` (`item_id`, `item_name`, `item_img`, `item_all`, `item_total`, `item_type`) ";
			 $sql.=" VALUES ('{$_POST['p_code']}', '{$_POST['p_name']}', '{$_FILES['p_img']['name']}', '{$_POST['p_unit']}', '{$_POST['p_unit']}', '{$_POST['p_code_type']}');";
			//$sql = $sql."VALUES ('1212', 'dsfsfdsf', 'sdfsdfsdfsd', '11', '11', '1');";
			if(mysqli_query($connect, $sql)){
				echo "เพิ่มอุปกรณ์เรียบร้อยแล้ว";
				header('Location: admin/index.php');
			}else{
				echo "เพิ่มอุปกรณ์ไม่สำเร็จ".mysqli_error($connect);
			}
		}else{
			echo "img_item/".$_FILES["p_img"]["name"];
		}

	}else{
		echo "else";
	}
	

?>