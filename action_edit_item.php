
<?php 
	require 'config_DB/DB_connect.php';
	//var_dump($_POST);
	//var_dump($_FILES);

	if(count($_POST) > 0 ){
		if($_FILES['p_img']['size'] > 0){
			if(move_uploaded_file($_FILES["p_img"]["tmp_name"],"img_item/".$_FILES["p_img"]["name"])){
				echo "มีไฟล์ อัพแล้ว";
				$sql = " UPDATE `sport_inventory` SET `item_id`='{$_POST['p_code']}', `item_img`='{$_FILES["p_img"]["name"]}',`item_name`='{$_POST['p_name']}',`item_all`='{$_POST['p_unit']}',`item_type`='{$_POST['p_code_type']}' WHERE  `item_id` = '{$_POST['p_code']}' ";
				echo "<br>".$sql;
				if(mysqli_query($connect, $sql)){

					header( "location: index.php" );
				}
			}
			
		}else{
			//echo "ไม่มีไฟล์";
			$sql = " UPDATE `sport_inventory` SET `item_id`='{$_POST['p_code']}',`item_name`='{$_POST['p_name']}',`item_all`='{$_POST['p_unit']}',`item_type`='{$_POST['p_code_type']}' WHERE  `item_id` = '{$_POST['p_code']}' ";
			echo $sql;
			if(mysqli_query($connect, $sql)){
				header( "location: index.php" );
	

			}
		}
	}else{

	}

 ?>

