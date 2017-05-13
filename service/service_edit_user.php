<?php 
//var_dump($_POST);
include '../config_DB/DB_connect.php';
$sql_update_user = "UPDATE `user_acount` SET `sudent_id`='{$_POST['data'][2]['value']}',`fname`='{$_POST['data'][0]['value']}',`lname`='{$_POST['data'][1]['value']}',`email`='{$_POST['data'][8]['value']}',`class`='{$_POST['data'][3]['value']}',`sec`='{$_POST['data'][4]['value']}',`gender`='{$_POST['data'][5]['value']}',`username`='{$_POST['data'][6]['value']}',`password`='{$_POST['data'][7]['value']}',`telephone`='{$_POST['data'][9]['value']}' WHERE `sudent_id`='{$_POST['data'][10]['value']}'";

if(mysqli_query($connect,$sql_update_user )){
	echo "true";
}else{
	echo "false";
}
?>
