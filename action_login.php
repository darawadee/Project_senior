<?php 
	include 'config_DB/DB_connect.php';
	session_start();
	//var_dump($_POST);
	$sql = "SELECT * FROM `user_acount` WHERE `username` = '{$_POST['username']}' AND `password` = '{$_POST['psw']}' ";	

	if( $res=mysqli_query($connect,$sql)){
		if($res->num_rows >0){
			echo "เข้าสู่ระบบสำเร็จ";
			$data = mysqli_fetch_assoc($res);
			$_SESSION['data_user'] =$data;
			$_SESSION['item_cart'] = array();

			if($_SESSION['data_user']['user_type'] == '3'){
				header('Location: admin/index.php');
			}else {
				header('Location: index.php');

			}
		}else{
			echo "user password ไม่ถูกต้อง";
		}
		//var_dump($res);
	}else{
		echo "ไม่สามารถเข้าสู่ระบบได้";
	}

 ?>