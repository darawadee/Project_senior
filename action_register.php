<?php 
	// array(7) { ["fname"]=> string(9) "นวล" ["lname"]=> string(18) "สวยสุด" ["sudent_id"]=> string(10) "1234567899" ["gender"]=> string(1) "M" ["user_name"]=> string(5) "rfrfr" ["password"]=> string(13) "asas@sdsd.com" ["telephone"]=> string(4) "frff" }
	include 'config_DB/DB_connect.php';
	//var_dump($_POST);die();
	//echo $_POST['fname'];
	//var_dump($connect);
	$check_user = "SELECT * FROM `user_acount` WHERE `sudent_id` = '{$_POST['sudent_id']}' ";
	if($res = mysqli_query($connect,$check_user)){
		//var_dump($res);
		if(mysqli_num_rows($res) >0){
			echo "มีผู้ใช้งานแล้ว";
		}else{
			//echo "สามารถสมัครได้";
			$sql_insert ="INSERT INTO `user_acount`  (`email`,`sudent_id`, `fname`, `lname`, `class`, `sec`, `gender`, `username`, `password`, `telephone`) ";
			$sql_insert .="  VALUES ('{$_POST['email']}','{$_POST['sudent_id']}', '{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['class']}', '{$_POST['sec']}', '{$_POST['gender']}', '{$_POST['user_name']}', '{$_POST['password']}', '{$_POST['telephone']}');";
			if(mysqli_query($connect,$sql_insert)){
				echo "สมัครสมาชิกสำเร็จ";

			}else{
				echo "ไม่สามารถสมัครสมาชิกได้";
			}
			//echo $sql_insert;
		}
	}
	//echo $check_user;

 ?>