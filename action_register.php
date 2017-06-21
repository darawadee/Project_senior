<?php 
	var_dump($_POST);
	include_once 'config_DB/DB_connect.php';
	
	 session_start();

	if($_POST){

		//echo "yes";
		$check_user = "SELECT * FROM `user_acount` WHERE `sudent_id` = '{$_POST['sudent_id']}' ";
		if($res = mysqli_query($connect,$check_user)){
			//var_dump($res);
			if(mysqli_num_rows($res) >0){
				echo $check_user."<br>";
				echo "มีผู้ใช้งานแล้ว";
			}else{
				//echo "สามารถสมัครได้";
				$sql_insert ="INSERT INTO `user_acount`  (`email`,`sudent_id`, `fname`, `lname`, `class`, `sec`, `gender`, `username`, `password`, `telephone`) ";
				$sql_insert .="  VALUES ('{$_POST['email']}','{$_POST['sudent_id']}', '{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['class']}', '{$_POST['sec']}', '{$_POST['gender']}', '{$_POST['user_name']}', '{$_POST['password']}', '{$_POST['telephone']}');";
				if(mysqli_query($connect,$sql_insert)){
					echo "สมัครสมาชิกสำเร็จ";
					var_dump($_SESSION);
					if(isset($_SESSION['data_user'])){
						if($_SESSION['data_user']["user_type"] == "3"){
							header('Location: admin/index.php');
						}else{
							header('Location: login_from.html');
						}
					}else{
						header('Location: login_from.html');
					}
					
					
				}else{
					echo "ไม่สามารถสมัครสมาชิกได้";
					header('Location: action_register.php');

				}
				//echo $sql_insert;
			}
		}
		echo $check_user;
	}else{
		echo "error";
		var_dump($_REQUEST);
		var_dump($_POST);
		var_dump($_GET);
	}

 ?>