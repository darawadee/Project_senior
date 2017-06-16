<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title></title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<script type="text/javascript" src="lib/js/jquery-3.2.0.js"></script>
	<script type="text/javascript" src="lib/js/bootstrap.min.js"></script>
	<style type="text/css">
		

		.bg {
		    /* The image used */
		    background-image: url("img/bgV2.png");
		    /* Full height */
		    height: 100%; 

		    /* Center and scale the image nicely */
		   /* background-position: center;
		    background-repeat: no-repeat;
		    */
		    background-size: cover;
		}
		p,b{
			text-shadow: 1px 1px 1px #000000;
		}
		td{
			height: 40px;
		}
		input{
			height: 50px;
		}
	</style>
</head>
<body class="bg">
	<div class="container">
		 <?php 	      
	          	if(isset($_GET['login'])){
	          		if($_GET['login'] == 'false'){
	          	?>
	          	<div class="alert alert-danger alert-dismissable"">
	          	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>เกิดข้อผิดพลาด</strong> ชื้อผู้ใช้งาน หรือ รหัสผ่านผิด กรุณาตรวจสอบ 
				</div>
	          	<?php 

	          		}
	          	}


	          ?>
	</div>
	<div class="row">
		<div align="center" style="padding-top: 150px;"><img src="img/logobsru.png" style="height: 150px; width: 110px;"></div>
		<form action="action_login.php" method="post">
		<table border="0" style="margin-top: 15px;margin-left: auto; margin-right: auto; width: 400px;">
	              <tbody>
	                  <tr>
	                      <td><label><b><h4>ชื่อผู้ใช้</h4></b></label></td>
	                      <td><input class="form-control" type="text" placeholder="รหัสผู้ใช้" class="" name="username" required=""></td>
	                  </tr>
	                  <tr>
	                      <td><label><b><h4>รหัสผ่าน</h4></b></label></td>
	                      <td><input class="form-control" type="password" placeholder="รหัสผ่าน" name="psw" required=""></td>
	                  </tr>
	                  <tr>
	                      <td></td><td align="center">
	                      <button class="btn btn-success"  type="submit" style="font-size: 16px;">เข้าสู่ระบบ</button>
	                      <a class="btn btn-primary" href="from_register.php" style="font-size: 16px; margin-right: 5px;">สมัครสมาชิก</a>
	                      </td>
	                  </tr>
	   		
	              </tbody>
	          </table>
	          </form>
	         
	</div>
</body>
</html>